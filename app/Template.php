<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = "template";
    public function user(){
    	return $this->hasOne(User::class);
    } 
    public function category()
	{
		return $this->belongsTo('App\Category','category_id');
	}
}
