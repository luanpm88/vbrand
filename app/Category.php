<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category"; 

    public function posts(){
    	return $this->hasmany('App\Posts','category_id');
    }
    public function products(){
    	return $this->hasmany('App\Products','category_id');
    }
}
