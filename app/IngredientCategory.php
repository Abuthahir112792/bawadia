<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientCategory extends Model
{
    protected $guarded = [];
    public function ingredient()
    {
       return $this->hasMany('App\Ingredient');
    } 
    public function product_ingredient()
    {
       return $this->hasMany('App\ProductIngredient');
    } 
}
