<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Cuisine extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title', 'description', 'status'
    ];
    protected $dates = ['deleted_at'];
}
