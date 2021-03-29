<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
    protected $fillable = [
        'product_id', 'name','description','language'
    ];
}
