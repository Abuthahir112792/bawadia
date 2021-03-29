<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Ingredient extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    public function category()
    {
       return $this->belongsTo('App\IngredientCategory','ingredient_category_id','id');
    }
}
