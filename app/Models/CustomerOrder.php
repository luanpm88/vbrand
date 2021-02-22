<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class CustomerOrder extends Model
{
    const STATUS_NEW = 'new';

    public function details()
	{
		return $this->hasMany('App\Models\CustomerOrderDetail', 'order_id');
	}

    public function addProduct($product_id)
    {
        $product = Product::find($product_id);

        $detail = $this->details()->where('product_id', '=', $product_id)->first();

        // if exist then increase 1
        if ($detail) {
            $detail->quantity += 1;
            $detail->save();
        } else {
            $this->details()->create([
                'product_id' => $product_id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }
    }

    public function itemsTotal()
	{
		$total = 0;

        foreach ($this->details as $detail) {
            $total += $detail->itemsTotal();
        }

        return $total;
	}

    public function updateQuantity($detail_id, $quantity)
	{
		$detail = $this->details()->find($detail_id);

        if (!$quantity) {
            $detail->delete();
            return;
        }

        $detail->quantity = $quantity;
        $detail->save();
	}

    public function allTotal()
	{
		$total = $this->itemsTotal();

        return $total;
	}
}
