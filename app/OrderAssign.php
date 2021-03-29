<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderAssign extends Model
{
    protected $fillable = [
        'order_id', 'user_id', 'status'
    ];
}
