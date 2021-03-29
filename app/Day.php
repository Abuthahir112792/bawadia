<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $fillable = [
        'day',
    ]; 
    public function messbooking()
    {
       return $this->hasMany('App\MessBooking','day_id');
    } 
    public function breakfast()
    {
       return $this->hasMany('App\MessBooking','day_id')->where('menu','breakfast')->with('product');
    }
    public function lunch()
    {
       return $this->hasMany('App\MessBooking','day_id')->where('menu','lunch')->with('product');
    }
    public function dinner()
    {
       return $this->hasMany('App\MessBooking','day_id')->where('menu','dinner')->with('product');
    }
}
