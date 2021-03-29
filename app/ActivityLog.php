<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
                'admin_id','user_id','flag','ip',
    ];
    public function user()
    {
       return $this->belongsTo('App\User','user_id');
    } 
    public function admin()
    {
       return $this->belongsTo('App\User','admin_id');
    } 
}
