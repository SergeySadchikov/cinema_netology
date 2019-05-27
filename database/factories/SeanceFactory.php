<?php

use App\Models\Film;
use App\Models\Hall;
use App\Models\Seance;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory*/
$factory->define(Seance::class, function(Faker $faker, array $attributes = [])
{
    if (empty($attributes)) {
        /** @var Film $film */
        $film = factory(Film::class);
        $filmId =$film->id;

        /** @var Hall $hall */
        $hall =  factory(Hall::class);
        $hallId = $hall->id;

        $startTime = $faker->randomDigit * 60;
        $endTime = $startTime + $film->duration;
    } else {
         $filmId = $attributes['film_id'];
         $hallId = $attributes['hall_id'];
         $startTime = $attributes['start_time'];
         $endTime = $attributes['end_time'];
    }

    return [
        'start_time' => $startTime,
        'end_time' => $endTime,
        'hall_id' => $hallId,
        'film_id' => $filmId,
    ];

});