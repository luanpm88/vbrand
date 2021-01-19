<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = "video";
    public function post()
	{
		return $this->belongsTo('App\Post','pid');
	}
}
