<?php

use App\Models\Film;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory*/
$factory->define(Film::class, function(Faker $faker)
{
    return [
        'name' => ucfirst($faker->sentence(3)),
        'description' => $faker->text(100),
        'duration' => $faker->numberBetween(80, 240),
    ];
});