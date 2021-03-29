<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Setting extends Model
{
    protected $fillable = [
        'name', 'description', 'image','currency', 'language','language_status','language_admin', 'branch_status','order_status','status'
    ];
}
