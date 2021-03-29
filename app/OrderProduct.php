<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 
class OrderProduct extends Model
{
    protected $fillable = [
        'order_id', 'product_id','name', 'model','quantity', 'product_size','product_price','product_branch_id','total', 'status'
    ];
    public function product()
    {
       return $this->belongsTo('App\Product','product_id','id')->with('info','image');
    } 
    public function price()
    {
       return $this->hasMany('App\ProductPrice','product_branch_id','product_branch_id');
    } 
    public function ingredient()
  {
     return $this->hasMany('App\OrderProductIngredient');
  }
}
