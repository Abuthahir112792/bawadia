<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TableBooking extends Model
{
    protected $fillable = [
        'admin_id','name','phone_no','no_of_person','time','date','branch_id','status',
    ];
    public function branch()
    {
       return $this->belongsTo('App\Branch','branch_id');
    } 
}
