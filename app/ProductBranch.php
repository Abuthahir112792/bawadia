<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class ProductBranch extends Model
{
   protected $fillable = [
      'product_id', 'branch_id','price'
   ];
   public function branch()
   {
      return $this->belongsTo('App\Branch');
   }
   public function price()
   {
      return $this->hasMany('App\ProductPrice');
   }
   public function product()
   {
      return $this->belongsTo('App\Product')->with('info')->with('image');
   }
}
