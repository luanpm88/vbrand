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

    public function fetchData()
    {
        $data = $this->messenger->makeRequest(
            '/' . $this->id . '?fields=name,picture',
            $this->accessToken,
        );

        $this->data = $data;
    }

    public function getConversations()
    {
        $data = $this->messenger->makeRequest(
            '/' . $this->id . '/conversations',
            $this->accessToken,
            true
        );

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
}