<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   protected $guarded = [];
  public function product()
  {
     return $this->hasMany('App\OrderProduct')->with('product')->with('price')->with('ingredient');
  } 
  public function delivery()
  {
     return $this->belongsTo('App\User','delivery_agent','id');
  } 
  public function order_status()
  {
     return $this->belongsTo('App\OrderStatus','order_status_id','id');
  } 
  public function branch()
  {
     return $this->belongsTo('App\Branch');
  } 
  public function customer()
  {
     return $this->belongsTo('App\User','user_id');
  } 
  public function path()
  {
     return $this->hasMany('App\OrderRiderPath');
  } 
  
}
