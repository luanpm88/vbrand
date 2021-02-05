<?php
namespace App\Library\Facebook;

class Message
{
    public $conversation;
    public $id;
    public $from;
    public $to;
    public $message;
    public $data;

    public function __construct($conversation)
	{
		$this->conversation = $conversation;
	}
}