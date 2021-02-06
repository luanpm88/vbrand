<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function scopeSearch($query, $request)
    {
        $query = $query->where('user_id', '=', $request->user()->id);
        
        // Keyword
        if (!empty(trim($request->keyword))) {
            foreach (explode(' ', trim($request->keyword)) as $keyword) {
                $query = $query->where(function ($q) use ($keyword) {
                    $q->orwhere('products.title', 'like', '%'.$keyword.'%');
                });
            }
        }

        return $query;
    }
}
