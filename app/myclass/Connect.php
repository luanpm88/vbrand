<?php
namespace App\myclass;
use Illuminate\Support\Str;
use App\Products;
use App\Posts;
class Connect
{
    /**
     * @param $title
     * @param int $id
     * @return string
     * @throws \Exception
     */
    public function send_request($url, $request_param){
        //$url = 'http://13.250.104.58:8990/gateway/api/v1/ecotouch'.$gate;
        //$url = 'http://cloud.idshare.info:8081'.$gate;
         
        $client = new Client(['headers' => [ 'Content-Type' => 'application/json' ]]); // ,'channelid'  => 'ECO-TOUCH'
        $request_data = json_encode($request_param);
        try {
            $res = $client->request('POST', $url ,
                [
                    'headers' => [  'Content-Type'     => 'application/json' ], // ,'channelid'  => 'ECO-TOUCH'
                    'body'   => $request_data
                ]);
            $result = $res->getBody()->getContents();
            $data = json_decode($result);

        } catch (ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents(); 
            $data = json_decode($responseBodyAsString); 
            /*
            $message = [
                'email'=>"true",
                'message' => 'The :attribute field is not valid.',
            ];
            return redirect('password.request')->withErrors($message);
            */
        }
        /*
        $res = $client->request('POST', $url ,
                    [
                        'headers' => [  'Content-Type'     => 'application/json','channelid'  => 'ECO-TOUCH' ],
                        'body'   => $request_data
                    ]);
        */
        return $data;
    }


}