<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\Lazada\LazadaConnection;
use App\User;
use App\Models\Product;
use App\Library\Pagination;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        \Auth::login(User::first());
        $lazadaConnection = $request->user()->getUserConnection('lazada');

        return view('client.products.index', [
            'lazadaConnectLink' => $lazadaConnection->service()->getConnectLink(),
            'lazadaConnection' => $lazadaConnection,
        ]);
    }

    public function list(Request $request)
    {
        list($products, $pagination) = Pagination::get($request, Product::search($request));

        return view('client.products.list', [
            'products' => $products,
            'pagination' => $pagination,
        ]);
    }
    
    public function image(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product->photo) {
            return response()->file(storage_path('app/' . $product->photo));
        } else {
            return response()->file(public_path('images/no-product-image.png'));
        }
    }

    public function select2(Request $request)
    {
        list($products, $pagination) = Pagination::get($request, Product::search($request));

        $result = [
            "results" => [],
            "pagination" => [
                "more" => true
            ]
        ];

        $items = $products->map(function($product) {
            return ['id' => $product->id, 'text' => $product->title];
        })->toArray();

        $result['results'] = $items;
        $result['pagination']['more'] = $pagination['page'] < $pagination['pageCount'];

        return response()->json($result);
    }
}