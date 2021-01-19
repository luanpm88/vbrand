<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = "photo";
    public function posts()
	{
		return $this->belongsTo('App\Posts','post_id');
	}
	public function products()
	{
		return $this->belongsTo('App\Products','product_id');
	}
}
