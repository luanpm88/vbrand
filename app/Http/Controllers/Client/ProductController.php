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
    public function index()
    {
        $lazadaConnection = User::first()->getUserConnection('lazada');

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
}