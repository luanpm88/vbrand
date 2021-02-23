<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\Lazada\LazadaConnection;
use App\User;
use App\Models\District;
use App\Models\Province;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function selectBox(Request $request)
    {
        $province = Province::find($request->province_id);
        $districts = $province->districts;

        return view('client.districts.selectBox', [
            'districts' => $districts,
        ]);
    }
}