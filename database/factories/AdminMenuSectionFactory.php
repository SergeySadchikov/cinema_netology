<?php

use App\Models\AdminMenuSection;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Arr;

/** @var Factory $factory*/
$factory->define(AdminMenuSection::class, function(Faker $faker, array $attributes = [])
{
    $name = Arr::get($attributes, 'name', $faker->randomElement(AdminMenuSection::MENU_ITEMS));

    return [
        'name' => $name,
    ];
});