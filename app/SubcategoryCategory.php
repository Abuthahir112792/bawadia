<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubcategoryCategory extends Model
{
    protected $fillable = [
        'subcategory_id', 'category_id','status'
    ];
    public function category()
    {
       return $this->belongsTo('App\Category');
    } 
    public function subcategory()
    {
       return $this->belongsTo('App\Subcategory');
    } 
}
