<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Branch;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Branch::class, function (Faker $faker) {
    return [
        'name' => 'TasTaz',
        'address' => 'Al Sadd, Doha, Qatar',
        'email' => $faker->unique()->safeEmail,
        'contact_1' => '974',
        'contact_2' => '974',
        'icon' => '/icon.png',
        'pickup_time' => '20',
        'preparetion_time' => '15',
        'delivery_time' => '45',
        'invoice_prefix' => '2019-',
        'lat' => 25.285446,
        'lng' => 51.531040,

    ];
});
