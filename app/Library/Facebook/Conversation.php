<?php
namespace App\Library\Facebook;

use App\Library\Facebook\Message;

class Conversation
{
    public $page;
    public $id;
    public $data;
    public $picture;
    public $name;
    public $to;
    public $updatedTime;
    public $contact;

    public function __construct($page)
	{
		$this->page = $page;
	}

    public function fetchData()
    {
        \Carbon\Carbon::setLocale('vi');

        $data = $this->page->messenger->makeRequest([
            'path' => '/' . $this->id . '?fields=snippet,senders,unread_count,updated_time,participants',
            'token' => $this->page->accessToken,
        ]);

        // get pic
        foreach($data['participants'] as $sender) {
            if ($sender["id"] != $this->id) {
                $this->contact = $this->page->contactProfile($sender['id']);
                $this->picture = $this->page->contactProfile($sender['id'])['profile_pic'];
                $this->name = $sender['name'];
                $this->to = $sender['id'];
                break;
            }
        }

        // update time
        $this->updatedTime = \Carbon\Carbon::parse($data['updated_time'])->diffForHumans();

        // get last sender

        $this->data = $data;
    }

    public function getMessages()
    {
        $data = $this->page->messenger->makeRequest([
            'path' => '/' . $this->id . '/messages?fields=from,to,message,created_time',
            'token' => $this->page->accessToken,
            'list' => true,
        ]);

        $func = function($item) {
            $message = new Message($this);
            $message->id = $item['id'];
            $message->from = $item['from'];
            $message->to = $item['to'];
            $message->message = $item['message'];
            return $message;
        };

        $data = array_map($func, $data);

        return array_reverse($data);
    }
}