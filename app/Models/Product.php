<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function scopeSearch($query, $request)
    {
        return $query;
    }
}
