<?php

use App\Models\Hall;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory*/

$factory->define(Hall::class, function(Faker $faker) {

    return [
        'name' => 'Зал ' . $faker->randomDigit,
        'standard_seat_price' => 250 * 100,
        'vip_seat_price' => 500 * 100,
    ];
});