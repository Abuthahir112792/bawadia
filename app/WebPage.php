<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebPage extends Model
{
    protected $fillable = [
        'page', 'title','image','description', 'status'
    ];
}
