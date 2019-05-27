<?php

use App\Models\Hall;
use Illuminate\Database\Seeder;

class HallTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Hall::class)
            ->times(5)
            ->create();
    }
}