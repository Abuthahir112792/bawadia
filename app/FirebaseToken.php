<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirebaseToken extends Model
{
    protected $fillable = [
        'user_id', 'token', 'ip','device_name'
    ];
}

