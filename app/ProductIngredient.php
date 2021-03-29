<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductIngredient extends Model
{
    protected $guarded = [];   
    public function ingredient()
    {
       return $this->belongsTo('App\Ingredient');
    }
}
