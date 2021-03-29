<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffRequest extends Model
{
    protected $fillable = [
         'name','email'
    ];
}
