<?php
namespace App\Library\Facebook;
use App\Library\Facebook\Conversation;

class Page
{
    public $messenger;
    public $id;
    public $accessToken;
    public $data;

    public function __construct($messenger)
	{
		$this->messenger = $messenger;
	}

    public function subscribeHooks() {
        $data = $this->messenger->makeRequest([
            'path' => '/' . $this->id . '/subscribed_apps',
            'params' => [
                'subscribed_fields' => 'messages',
            ],
            'token' => $this->accessToken,
            'method' => 'post',
        ]);
    }

    public function fetchData()
    {
        $data = $this->messenger->makeRequest([
            'path' => '/' . $this->id . '?fields=name,picture',
            'token' => $this->accessToken,
        ]);

        $this->data = $data;
    }

    public function getConversations()
    {
        $data = $this->messenger->makeRequest([
            'path' => '/' . $this->id . '/conversations',
            'token' => $this->accessToken,
            'list' => true,
        ]);

        $func = function($item) {
            $conversation = new Conversation($this);
            $conversation->id = $item['id'];

            $conversation->fetchData();

            return $conversation;
        };

        return array_map($func, $data);
    }

    public function getConversation($id)
    {
        $conversation = new Conversation($this);
        $conversation->id = $id;

        $conversation->fetchData();

        return $conversation;
    }

    public function sendMessage($to, $message) {
        return $this->messenger->makeRequest([
            'path' => '/me/messages',
            'method' => 'post',
            'params' => [
                'recipient' => [
                    'id' => $to
                ],
                "message" => [
                    "text" => $message,
                ],
            ],
            'token' => $this->accessToken,
        ]);
    }

    public function contactProfile($contactId)
    {
        return $this->messenger->makeRequest([
            'path' => '/' . $contactId . '?fields=first_name,last_name,profile_pic',
            'token' => $this->accessToken,
        ]);
    }
}