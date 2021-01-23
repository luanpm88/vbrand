<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table ='package';
    public function users(){
    	return $this->hasmany('App\Users','package_id');
    }
}
