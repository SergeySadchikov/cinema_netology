<?php

use App\Models\HallSeatSetting;
use Illuminate\Database\Seeder;
use App\Models\Hall;
use App\Models\Seat;

class HallSeatSettingsSeeder extends Seeder
{
    public function run(): void
    {
        Hall::query()
            ->each(function (Hall $hall) {
                Seat::query()
                    ->each(function (Seat $seat) use ($hall) {
                        factory(HallSeatSetting::class)
                            ->create(
                                [
                                    'hall_id' => $hall,
                                    'seat_id' => $seat,
                                ]
                            );
                    });
            });
    }
}