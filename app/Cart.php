<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "cart";
    public function users()
	{
		return $this->belongsTo('App\Users','user_id');
	}
	public function template()
    {
        return $this->belongsTo(Template::class,'relation_id');
    }
    public function package()
    {
        return $this->belongsTo(Package::class,'relation_id');
    }
}
