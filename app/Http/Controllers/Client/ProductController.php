<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\Lazada\LazadaConnection;
use App\User;
use App\Models\Product;

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
            'products' => Product::all(),
        ]);
    }
    
    public function image(Request $request, $id)
    {
        $product = Product::find($id);

        return response()->file(storage_path('app/' . $product->photo));
    }
}