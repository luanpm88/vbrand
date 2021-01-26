<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserConnection extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function getData()
    {
        if (!$this->data) {
            return [];
        }

        return json_decode($this->data, true);
    }

    public function setData($data)
    {
        $this->data = json_encode($data);
        $this->save();
    }
}
