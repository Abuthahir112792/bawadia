<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessBooking extends Model
{
    protected $fillable = [
        'admin_id','day_id', 'menu', 'product_id','status'
    ];
    public function product()
    {
       return $this->belongsTo('App\Product','product_id')->with('info');
    } 
}
