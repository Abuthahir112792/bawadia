<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSubcategory extends Model
{
    protected $fillable = [
        'product_id', 'subcategory_id'
    ];  
    public function subcategory()
    {
       return $this->belongsTo('App\Subcategory');
    }
}
