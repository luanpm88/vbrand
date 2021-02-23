<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\Lazada\LazadaConnection;
use App\User;
use App\Models\District;
use App\Models\Province;

class WardController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function selectBox(Request $request)
    {
        $district = District::find($request->district_id);
        $wards = $district->wards;

        return view('client.wards.selectBox', [
            'wards' => $wards,
        ]);
    }
}