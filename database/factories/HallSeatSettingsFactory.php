<?php

use App\Models\Hall;
use App\Models\HallSeatSetting;
use App\Models\Seat;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Arr;

/** @var Factory $factory*/
$factory->define(HallSeatSetting::class, function(Faker $faker, array $attributes = [])
{
    $seatId = Arr::get($attributes, 'seat_id', factory(Seat::class));
    $hallId = Arr::get($attributes, 'hall_id', factory(Hall::class));

    $isVip = $faker->boolean;

    return [
        'hall_id' => $hallId,
        'seat_id' => $seatId,
        'is_active' => $faker->boolean,
        'is_vip' => $faker->boolean,
        'price' => $isVip ? 500 * 100 : 250 * 100,
    ];
});