<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $fillable = [
        'user_id', 'product_id', 'status'
    ];
    public function product()
    {
       return $this->belongsTo('App\Product')->with('image')->with('branch')->with('info')->with('cart')->with('fav');
    } 
}
