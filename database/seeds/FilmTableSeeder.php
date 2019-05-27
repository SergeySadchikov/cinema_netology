<?php

use App\Models\Film;
use Illuminate\Database\Seeder;

class FilmTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Film::class)
            ->times(10)
            ->create();
    }
}