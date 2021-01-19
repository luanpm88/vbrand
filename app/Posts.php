<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table ='posts';
    public function category()
	{
		return $this->belongsTo('App\Category','category_id');
	}
	public function users()
	{
		return $this->belongsTo('App\Users','user_id');
	}
	public function photo(){
    	return $this->hasmany('App\Photo','post_id');
    }
    public function video(){
    	return $this->hasmany('App\Photo','post_id');
    }
    public function feedback(){
    	return $this->hasmany('App\Photo','post_id');
    }

}
