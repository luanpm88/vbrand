<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Jobs\LazadaSync;
use App\Library\Lazada\LazadaConnection;

class ConnectionController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lazadaConnection = $request->user()->getUserConnection('lazada');
        $lazada = new LazadaConnection();
        
        return view('client.connections.index', [
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
        $userConnection = $request->user()->getUserConnection('lazada');

        $lazada = new LazadaConnection();
        $lazada->getAccessToken($request->code);

        // update connection
        $userConnection->updateData($lazada->data);

        // redirect
        $request->session()->flash('success', 'Connected to Lazada!');
        return redirect()->action('Client\ProductController@index');
    }

    /**
     * Receive code and generate token. 
     *
     * @return \Illuminate\Http\Response
     */
    public function getProducts(Request $request)
    {
        $lazadaConnection = $request->user()->getUserConnection('lazada');

        return view('client.connections.getProducts', [
            'products' => $lazadaConnection->service()->getProducts(),
        ]);
    }

    /**
     * Receive code and generate token. 
     *
     * @return \Illuminate\Http\Response
     */
    public function lazadaSync(Request $request)
    {
        $lazadaConnection = $request->user()->getUserConnection('lazada');

        // start import
        if ($request->isMethod('post')) {
            // pending
            $lazadaConnection->updateData([
                'sync' => [
                    'status' => 'pending',
                    'imported' => '--',
                    'total' => '--',
                    'progress' => 0,
                ],
            ]);

            // start
            LazadaSync::dispatch($lazadaConnection, $request->user());
        }

        return view('client.connections.lazadaSync', [
            'lazadaConnection' => $lazadaConnection,
        ]);
    }

    /**
     * Set sync as closed. 
     *
     * @return \Illuminate\Http\Response
     */
    public function lazadaSyncClose(Request $request)
    {
        $lazadaConnection = $request->user()->getUserConnection('lazada');

        // pending
        $lazadaConnection->updateData([
            'sync' => [
                'status' => 'closed',
                'imported' => $lazadaConnection->getData()['sync']['imported'],
                'total' => $lazadaConnection->getData()['sync']['total'],
                'progress' => 100,
            ],
        ]);
    }
}
