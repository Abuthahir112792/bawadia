<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCuisine extends Model
{
    protected $fillable = [
        'product_id', 'cuisine_id'
    ];    
    public function cuisine()
    {
       return $this->belongsTo('App\Cuisine');
    }
}
