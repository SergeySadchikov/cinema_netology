<?php

use App\Models\Seat;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Arr;

/** @var Factory $factory*/
$factory->define(Seat::class, function(Faker $faker, array $attributes = [])
{
    $row = Arr::get($attributes, 'row', $faker->randomDigit);
    $seatNumber = Arr::get($attributes, 'seat_number', $faker->randomDigit);

    return [
        'row' => $row,
        'seat_number' => $seatNumber,
    ];
});