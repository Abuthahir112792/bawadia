<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OrderStatus extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'status'
    ];
    protected $dates = ['deleted_at'];
}
