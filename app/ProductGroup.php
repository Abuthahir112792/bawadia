<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    protected $fillable = [
        'product_id', 'group_id'
    ];  
    public function group()
    {
       return $this->belongsTo('App\Group');
    }
}
