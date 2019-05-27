<?php

use App\Models\HallSeatSetting;
use App\Models\Seance;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketTableSeeder extends Seeder
{
    public function run(): void
    {
        Seance::query()
            ->get()
            ->each(function (Seance $seance) {

                /** @var Ticket $ticket */
               $ticket = factory(Ticket::class)->create([
                   'seance_id' => $seance,
               ]);

               /** @var HallSeatSetting $setting */
                $setting = HallSeatSetting::query()
                    ->inRandomOrder()
                    ->first();

                $ticket->settings()
                    ->attach($setting->id);
            });
    }
}