<?php
namespace App\Library\Lazada;

use App\Http\Controllers\Controller;
use App\Library\Lazada\Lazop\LazopClient;
use App\Library\Lazada\Lazop\LazopRequest;
use App\Library\Lazada\Lazop\UrlConstants;
use App\Library\Lazada\Lazop\LazopLogger;
use App\Library\Lazada\Lazop\Constants;

if (!defined("LAZOP_SDK_WORK_DIR"))
{
	define("LAZOP_SDK_WORK_DIR", dirname(__FILE__));
}

if (!defined("LAZOP_AUTOLOADER_PATH"))
{
	define("LAZOP_AUTOLOADER_PATH", dirname(__FILE__));
}

class LazadaConnection
{
	public $appKey='125327';
    public $appSecret='OqIyH3WMSHBFob9kRwN1fXX0FyYnIlsc'; 
    public $service;
    public $data;
    public $endpoint="https://api.lazada.vn/rest";

    public function __construct($appKey=false, $appSecret=false, $data=[])
	{
		if ($appKey) {
            $this->appKey = $appKey;
        }
		if ($appKey) {
            $this->appSecret = $appSecret;
        }
        if ($data) {
            $this->data = $data;
        }
	}

    public function getConnectLink() {
        return "https://auth.lazada.com/oauth/authorize?response_type=code&force_auth=true&redirect_uri=" . action('Store\ConnectionController@connect') . "&client_id=" . $this->appKey;
    }

    public function getAccessToken($code)
    {
        $this->service = new LazopClient("https://auth.lazada.com/rest",$this->appKey,$this->appSecret);

        $re = new LazopRequest('/auth/token/create');
        $re->addApiParam('code', $code);
        $res = $this->service->execute($re);

        $this->data = json_decode($res, true);

        return $this->data['access_token'];
    }

    public function refreshToken()
    {
        $this->service = new LazopClient("https://auth.lazada.com/rest",$this->appKey,$this->appSecret);

        $re = new LazopRequest('/auth/token/refresh');
        $re->addApiParam('refresh_token', $this->data['refresh_token']);

        $res = $this->service->execute($re);

        $this->data = json_decode($res, true);
    }

    public function makeRequest($url, $params, $method='GET') {
        $this->service = new LazopClient("https://api.lazada.vn/rest",$this->appKey,$this->appSecret);
        
        $request = new LazopRequest($url, $method);

        foreach($params as $key => $value) {
            $request->addApiParam($key, $value);
        }

        return $this->service->execute($request, $this->data['access_token']);
    }

    public function getProducts()
    {
        return $this->makeRequest('/products/get',[
            'startRow' => '0',
            'pageSize' => '2',  
        ]);
    }
    
    public function getBrands()
    {
        return $this->makeRequest('/category/brands/query',[
            'startRow' => '0',
            'pageSize' => '20',  
        ]);
    }
}