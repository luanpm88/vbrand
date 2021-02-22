<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerOrderDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'quantity', 'price'
    ];

    public function product()
	{
		return $this->belongsTo('App\Models\Product');
	}

    public function itemsTotal()
	{
		return $this->price * $this->quantity;
	}
}
