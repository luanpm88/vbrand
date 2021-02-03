<?php
namespace App\Library\Facebook;

use App\Library\Facebook\Page;

class Messenger
{
    public $appId='891398811623458';
    public $appSecret='9f86dd56e21868ae49d4ce891c971645';
    public $accessToken;
    public $fb;
    public $userId;

    public function __construct($accessToken=null)
	{
		$this->accessToken = $accessToken;

        if ($this->accessToken) {
            $this->fb = new \Facebook\Facebook([
                'app_id' => $this->appId,
                'app_secret' => $this->appSecret,
                'default_graph_version' => 'v9.0',
                'default_access_token' => $this->accessToken,
            ]);

            // get user id
            $this->userId = $this->makeRequest('/me', $this->accessToken)['id'];
        }
	}

    public function makeRequest($path, $token, $list=false)
    {
        // FIND USER ID
        try {
            // Returns a `FacebookFacebookResponse` object
            $response = $this->fb->get(
                $path,
                $token
            );
        } catch(FacebookExceptionsFacebookResponseException $e) {
            throw new \Exception('Graph returned an error: ' . $e->getMessage());
            exit;
        } catch(FacebookExceptionsFacebookSDKException $e) {
            throw new \Exception('Facebook SDK returned an error: ' . $e->getMessage());
            exit;
        }

        if ($list) {
            $graphEdge = $response->getGraphEdge();
            return $graphEdge->asArray();
        } else {
            $graphNode = $response->getGraphNode();
            return $graphNode->asArray();
        }
    }

    public function getPages()
    {
        $data = $this->makeRequest('/' . $this->userId . '/accounts',
            $this->accessToken,
            true
        );

        $func = function($item) {
            $page = new Page($this);
            $page->id = $item['id'];
            $page->accessToken = $item['access_token'];
            return $page;
        };

        return array_map($func, $data);
    }

    public function getConversations($page)
    {
        return $this->makeRequest(
            '/' . $page->id . '/conversations',
            $page->accessToken,
            true
        );
    }

    public function getMessages($page, $conversationId)
    {
        return $this->makeRequest(
            '/' . $conversationId . '/messages?fields=from,to,message,created_time',
            $page['access_token'],
            true
        );
    }
}