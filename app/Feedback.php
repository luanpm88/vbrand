<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = "feedback";
    public function post()
	{
		return $this->belongsTo('App\Posts','post_id');
	}
}
