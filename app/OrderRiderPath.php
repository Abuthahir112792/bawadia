<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderRiderPath extends Model
{
    protected $guarded = [ ];
    protected $visible = ['lat','lon'];
}
