<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (App::environment(['local', 'staging'])) {
            $this->call(AuthTableSeeder::class);
        }

        // $this->call(UsersTableSeeder::class);
        $this->call(HallTableSeeder::class);
        $this->call(SeatTableSeeder::class);
        $this->call(HallSeatSettingsSeeder::class);
        $this->call(FilmTableSeeder::class);
        $this->call(SeanceTableSeeder::class);
        $this->call(TicketTableSeeder::class);
        $this->call(AdminMenuSectionsSeeder::class);
    }
}
