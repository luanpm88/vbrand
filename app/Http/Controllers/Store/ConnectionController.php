<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\Lazada\LazadaConnection;
use App\User;

class ConnectionController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lazadaConnection = User::first()->getUserConnection('lazada');
        $lazada = new LazadaConnection();

        return view('store.connection.index', [
            'connectionLink' => $lazada->getConnectLink(),
            'lazadaConnection' => $lazadaConnection,
        ]);
    }

    /**
     * Receive code and generate token. 
     *
     * @return \Illuminate\Http\Response
     */
    public function connect(Request $request)
    {
        $userConnection = User::first()->getUserConnection('lazada');

        $lazada = new LazadaConnection();
        $lazada->getAccessToken($request->code);

        // update connection
        $userConnection->setData($lazada->data);

        // redirect
        $request->session()->flash('success', 'Connected to Lazada!');
        return redirect()->action('Store\ConnectionController@index');
    }

    /**
     * Receive code and generate token. 
     *
     * @return \Illuminate\Http\Response
     */
    public function getProducts(Request $request)
    {
        $userConnection = User::first()->getUserConnection('lazada');
        $lazada = new LazadaConnection(false, false, $userConnection->getData());

        // get products
        // var_dump(json_decode($lazada->getProducts()));

        return view('store.connection.getProducts', [
            'products' => json_decode($lazada->getProducts(), true),
        ]);
    }
}
