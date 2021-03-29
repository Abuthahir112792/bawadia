<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductPrice extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $visible = ['id','tag', 'price', 'description'];
    protected $dates = ['deleted_at'];
}
