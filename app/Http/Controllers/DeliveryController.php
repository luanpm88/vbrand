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
    //---- for ghn.vn
	public function send_request($url, $request_param){
         
        $client = new Client(['headers' => [ 'Content-Type' => 'application/json', 'Token'=> 'fccc21b9-6847-11eb-86b9-8a61086fe5fd','ShopId' =>'1449088'  ]]); 
        $request_data = json_encode($request_param);
        try {
            $res = $client->request('POST', $url ,
                [
                    'headers' => [  'Content-Type'     => 'application/json', 'Token'=> 'fccc21b9-6847-11eb-86b9-8a61086fe5fd','ShopId' =>'1449088' ],
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
    public function show_details_ghn(){
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
   	 
    public function show_details(Request $request){
    	$url    =   'https://services.giaohangtietkiem.vn/services/shipment/fee';
        // /services/shipment/fee?address=P.503%20t%C3%B2a%20nh%C3%A0%20Auu%20Vi%E1%BB%87t,%20s%E1%BB%91%201%20L%C3%AA%20%C4%90%E1%BB%A9c%20Th%E1%BB%8D&province=H%C3%A0%20n%E1%BB%99i&district=Qu%E1%BA%ADn%20C%E1%BA%A7u%20Gi%E1%BA%A5y&pick_province=H%C3%A0%20N%E1%BB%99i&pick_district=Qu%E1%BA%ADn%20Hai%20B%C3%A0%20Tr%C6%B0ng&weight=1000&value=3000000&deliver_option=xteam

        $request_param = [ 
                "pick_province" =>  "Hồ Chí Minh",
                "pick_district" =>  "Quận 12",
                "province"      =>  "Hà Nội",
                "district"      =>  "Quận Hoàn Kiếm",
                "address"       =>  "1202 nguyễn Văn Quá, số 1 Tân Kỳ Tân Quý",
                "weight"        =>  200,
                "value"         =>  300000,
                "transport"     =>  "fly",
                "deliver_option"=>  "xteam"
            ];
        $data = $this->send_request_ghtk($url, $request_param);

        print_r($data);
        return view('fontend.Member.delivery',['user'=> Auth::user(),'data'=>$data ]);

        //return $data;
    }
    //---------------ninja van
    public function send_request_ghtk($url, $request_param){
        
        $client = new Client(
            ['headers' => [ 'Content-Type' => 'application/json','Token'=> '11f3A71b6ee9FfA389B7E9d15EEc04AE52782135','Host' =>'services.giaohangtietkiem.vn'  ]]
        ); 
        $request_data = json_encode($request_param);
        try {
            $res = $client->request('GET', $url ,
                [
                    //'headers' => [  'Content-Type'     => 'application/json', 'Token'=> '11f3A71b6ee9FfA389B7E9d15EEc04AE52782135','Host' =>'services.giaohangtietkiem.vn' ],
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



     
}
