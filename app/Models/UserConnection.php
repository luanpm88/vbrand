<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Library\Lazada\LazadaConnection;
use App\Models\Product;

class UserConnection extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

    /**
     * Get data.
     *
     * @var object | collect
     */
    public function getData()
    {
        if (!$this['data']) {
            return json_decode('{}', true);
        }

        return json_decode($this['data'], true);
    }

    /**
     * Update data.
     *
     * @var object | collect
     */
    public function updateData($data)
    {
        $data = (object) array_merge((array) $this->getData(), $data);
        $this['data'] = json_encode($data);

        $this->save();
    }

    public function connected()
    {
        return isset($this->id);
    }

    public function service()
    {
        return new LazadaConnection(false, false, $this->getData());
    }

    public function importProducts($user) {
        $data = $this->service()->getProducts(['offset' => 0, 'limit' => 1])['data'];
        $total = $data['total_products'];

        // starting
        $this->updateData([
            'sync' => [
                'status' => 'starting',
                'imported' => 0,
                'total' => $total,
                'progress' => 0,
            ]
        ]);
        
        $perPage = 12;
        $pages = ceil($total/$perPage);
        $imported = 0;
        for ($i=0; $i < $pages; $i++) {
            $products = $this->service()->getProducts(['offset' => $i*$perPage, 'limit' => $perPage])['data']['products'];
            foreach ($products as $key => $product) {
                try {
                    // find exist product
                    $p = Product::where('lazada_id', '=', $product["item_id"])->first();

                    if (!$p) {
                        $p = new Product();
                        $p->lazada_id = $product["item_id"];
                        $p->user_id = $user->id;
                    }

                    $p->title = $product["attributes"]["name"];
                    if (isset($product["attributes"]["short_description"])) {
                        $p->description = $product["attributes"]["short_description"];
                    }
                    $p->lazada_data = json_encode($product);
                    if (isset($product["skus"][0]["Images"]) && isset($product["skus"][0]["Images"][0])) {
                        $photo = 'products/' . $p->lazada_id;
                        copy($product["skus"][0]["Images"][0], storage_path('app/' . $photo));
                        $p->photo = $photo;
                    }

                    // get price
                    if (isset($product["skus"][0]["price"])) {
                        $p->price = $product["skus"][0]["price"];
                    }

                    $p->save();

                    $imported++;
                    // importing
                    $this->updateData([
                        'sync' => [
                            'status' => 'importing',
                            'imported' => $imported,
                            'total' => $total,
                            'progress' => round(($imported / $total) * 100, 2),
                        ]
                    ]);
                } catch(\Exception $e) {
                    // write error
                    \Log::error($e->getMessage());
                }
                    
            }

            sleep(3);
        } 

        // done
        $this->updateData([
            'sync' => [
                'status' => 'done',
                'imported' => $this->getData()['sync']['imported'],
                'total' => $this->getData()['sync']['total'],
                'progress' => 100,
            ]
        ]);
    }
}
