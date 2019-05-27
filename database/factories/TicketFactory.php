<?php

use App\Models\Seance;
use App\Models\Ticket;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Arr;

/** @var Factory $factory*/
$factory->define(Ticket::class, function(Faker $faker, array $attributes = [])
{
    $seanceId = Arr::get($attributes, 'seance_id', factory(Seance::class));

    return [
        'qr_code' => $faker->randomNumber(),
        'seance_id' => $seanceId,
    ];
});