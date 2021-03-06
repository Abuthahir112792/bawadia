<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = [];
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    } 
}
