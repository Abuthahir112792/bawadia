<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'order_id', 'user_id','name', 'text','rating','status'
    ];
}
