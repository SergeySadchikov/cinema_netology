<?php

use App\Models\Film;
use App\Models\Hall;
use App\Models\Seance;
use Illuminate\Database\Seeder;

class SeanceTableSeeder extends Seeder
{
    public $startingTime = [
        9 * 60,
        12 * 60,
        15 * 60,
        18 * 60,
    ];

    public function run(): void
    {
        Hall::query()
            ->limit(3)
            ->get()
            ->each(function (Hall $hall) {

                /** @var Film $film */
                $film = Film::query()
                    ->inRandomOrder()
                    ->first();

                foreach ($this->startingTime as $startTime) {
                    factory(Seance::class)->create([
                        'hall_id' => $hall,
                        'film_id' => $film,
                        'start_time' => $startTime,
                        'end_time' => $startTime + $film->duration,
                    ]);
                }

            });
    }
}