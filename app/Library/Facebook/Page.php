<?php
namespace App\Library\Facebook;
use App\Library\Facebook\Conversation;

class Page
{
    public $messenger;
    public $id;

    public function __construct($messenger)
	{
		$this->messenger = $messenger;
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
            return $conversation;
        };

        return array_map($func, $data);
    }
}