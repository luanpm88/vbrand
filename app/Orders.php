<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table ='orders';
    public function users()
	{
		return $this->belongsTo('App\users','user_id');
	}
	public function photo(){
    	return $this->hasmany('App\Orderdetail','order_id');
    }
}
