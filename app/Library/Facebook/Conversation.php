<?php
namespace App\Library\Facebook;

use App\Library\Facebook\Message;

class Conversation
{
    public $page;
    public $id;
    public $data;

    public function __construct($page)
	{
		$this->page = $page;
	}

    public function fetchData()
    {
        $data = $this->page->messenger->makeRequest(
            '/' . $this->id . '?fields=snippet,senders,unread_count,updated_time,participants',
            $this->page->accessToken
        );

        $this->data = $data;
    }

    public function getMessages()
    {
        $data = $this->page->messenger->makeRequest(
            '/' . $this->id . '/messages?fields=from,to,message,created_time',
            $this->page->accessToken,
            true
        );

        $func = function($item) {
            $message = new Message($this);
            $message->id = $item['id'];
            $message->from = $item['from'];
            $message->to = $item['to'];
            $message->message = $item['message'];
            return $message;
        };

        return array_map($func, $data);
    }
}