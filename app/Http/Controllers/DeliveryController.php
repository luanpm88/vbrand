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
use App\myclass\Connect;

class DeliveryController extends Controller
{
	public function send_request($url, $request_param){
         
        $client = new Client(['headers' => [ 'Content-Type' => 'application/json', 'token'=> 'c90c2263-684c-11eb-8cc1-aa9213cc179e','shop_id' =>'77855'  ]]); 
        $request_data = json_encode($request_param);
        try {
            $res = $client->request('POST', $url ,
                [
                    'headers' => [  'Content-Type'     => 'application/json', 'token'=> 'fccc21b9-6847-11eb-86b9-8a61086fe5fd','shop_id' =>'77855' ],
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
   	private function _login_1($email,$password){
        $url    =   '/user/security-code';
        $request_param = [
                    'email' => $email,
                    'phoneNumber' => '',
                    'securityCode' => '',
                    'receiveCodeBy' => 1,
                    'verificationType' => 2
                ]; 
        
        $data = $this->send_request($url, $request_param);
       // echo '<script>console.log('.$data->data.');</script>';
        return $data;
    }
    public function show_price(Request $request){
    	$url    =   'https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee';
        $request_param = [
						'service_id'		=>	53321,
						"service_type_id" 	=> 'null',
						'insurance_value'	=>	500000,
						'coupon'			=>	 'null',
						'from_district_id'	=>	1542,
						'to_district_id'	=>	1444,
						'to_ward_code'		=>	20314,
						'height'			=>	15,
						'length'			=>	15,
						'weight'			=>	1000,
						'width'				=>	15
                	]; 
        
        $data = $this->send_request($url, $request_param);
        print_r($data);
        //echo '<script>console.log('.$data->data.');</script>';
        
        return view('fontend.Member.delivery',['user'=> Auth::user(),'data'=>$data ]);

        //return $data;
    }
    public function show(){
    	return view('fontend.Member.delivery',['user'=> Auth::user() ]);
         
    }
}
