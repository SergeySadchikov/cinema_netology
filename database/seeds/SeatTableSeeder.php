<?php

use App\Models\Seat;
use Illuminate\Database\Seeder;

class SeatTableSeeder extends Seeder
{
    public $maxRowCount = 10;
    public $maxSeatCount = 12;

    public function run(): void
    {
        for ($row = 1; $row <= $this->maxRowCount; $row++) {
            for ($seat = 1; $seat <= $this->maxSeatCount; $seat++) {
                factory(Seat::class)->create([
                    'row' => $row,
                    'seat_number' => $seat,
                ]);
            }
        }
    }
}