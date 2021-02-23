<?php
namespace App\Library\GHN;

class Service
{
    protected $endpoint;
    protected $token;
    protected $domain;

    public function __construct()
	{
		$this->token = env('GHN_TOKEN');

        if (env('GHN_ENV') == 'development') {
            $this->endpoint = 'https://dev-online-gateway.ghn.vn/shiip/public-api/';
        } else {
            $this->endpoint = 'https://online-gateway.ghn.vn/shiip/public-api/';
        }
	}

    public function getProvinces()
    {
        return $this->makeRequest([
            'path' => 'master-data/province',
        ]);
    }

    public function getDistricts($province_id)
    {
        return $this->makeRequest([
            'path' => 'master-data/district',
            'data' => '{
                "province_id":' . $province_id . '
            }',
        ]);
    }

    public function getWards($district_id)
    {
        return $this->makeRequest([
            'path' => 'master-data/ward?district_id',
            'data' => '{
                "district_id":' . $district_id . '
            }',
        ]);
    }

    public function getFee($options=[])
    {
        $default = [
            "from_district_id" => 1454,
            "service_id" => null,
            "service_type_id" => 2,
            "to_district_id" => 1452,
            "to_ward_code" => "21012",
            "height" => 50,
            "length" => 20,
            "weight" => 200,
            "width" => 20,
            "insurance_fee" => 10000,
            "coupon" =>  null
        ];

        $options = array_merge($default, $options);

        return $this->makeRequest([
            'path' => 'v2/shipping-order/fee',
            'data' => json_encode($options),
        ]);
    }

    public function makeRequest($options=[])
    {
        $url = $this->endpoint;
        
        // final request url
        if (isset($options['path'])) {
            $url .= $options['path'];
        }

        $headers = array( 
            "Content-type: application/json", 
            "Token: " . $this->token, 
            "Content-Type: text/plain",
        ); 
       
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL,$url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
        
        // Apply the XML to our curl call 
        curl_setopt($ch, CURLOPT_POST, 1); 

        if (isset($options['data'])) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $options['data']); 
        }

        $result = json_decode(curl_exec($ch), true);

        if ($result['code'] != 200) {
            throw new \Exception(json_encode($result));
        }

        return $result;
    }
}