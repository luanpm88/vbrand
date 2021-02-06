<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\User;

class DeliveryController extends Controller
{
     public function send_request($url, $request_param){        
        $client = new Client(['headers' => [ 'Content-Type' => 'application/json', 'ShopId'   => '885','Token'=>'637170d5-942b-11ea-9821-0281a26fb5d4'  ]]);
        $request_data = json_encode($request_param);
        try {
            $res = $client->request('POST', $url ,
                [
                    'headers' => [  'Content-Type'     => 'text/plain', 'ShopId'   => '885','Token'=>'637170d5-942b-11ea-9821-0281a26fb5d4' ],
                    'body'   => $request_data
                ]);
            $result = $res->getBody()->getContents();
            $data = json_decode($result);

        } catch (ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents(); 
            $data = json_decode($responseBodyAsString);
        }
        return $data;
    }
    public function show(){
    	return view('fontend.Member.delivery',['user'=> Auth::user()]);
    }
    public function show_details(){
    	$url    =   'https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee';
        $request_param = [
						"from_district_id"	=> 1454,
						"service_id"		=> 53320,
						"service_type_id"	=> 'null',
						"to_district_id"	=> 1452,
						"to_ward_code"		=> "21012",
						"height"			=> 50,
						"length"			=> 20,
						"weight"			=> 200,
						"width"				=> 20,
						"insurance_fee"		=> 10000,
						"coupon"			=> 'null'
                	]; 
        $data = $this->send_request($url, $request_param);
        echo "<pre>";print_r($data);echo "</pre>";
    	return view('fontend.Member.delivery',[ 'user'=> Auth::user(),'data'=>$data ]);
    }
}
