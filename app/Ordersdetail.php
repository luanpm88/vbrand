<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Orders;
use App\Products;
class Ordersdetail extends Model
{
    protected $table ='orders_detail';
    public function orders()
	{
		return $this->belongsTo('App\orders','order_id');
	}
	public function products()
	{
		return $this->belongsTo('App\Products','product_id');
	}
}
