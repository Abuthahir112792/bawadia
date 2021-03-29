<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];

    public function ingredient()
    {
       return $this->hasMany('App\CartIngredient');
    }
    public function product()
    {
        return $this->belongsTo('App\Product')->with('image')->with('info')->with('branch');
    }
    public function price()
    {
       return $this->belongsTo('App\ProductPrice','product_price_id','id');
    }
    
}
