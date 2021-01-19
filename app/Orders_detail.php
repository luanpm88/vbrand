<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders_detail extends Model
{
    protected $table ='orders_detail';
    public function orders()
	{
		return $this->belongsTo('App\orders','order_id');
	}
	public function products()
	{
		return $this->belongsTo('App\products','product_id');
	}



	/*
		
	*/
}
