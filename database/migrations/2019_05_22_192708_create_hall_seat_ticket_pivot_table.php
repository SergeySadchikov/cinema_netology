<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHallSeatTicketPivotTable extends Migration
{
    public function up(): void
    {
        Schema::create('hall_seat_ticket_pivot', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ticket_id');
            $table->unsignedInteger('hall_seat_setting_id');

            $table->unique(['ticket_id', 'hall_seat_setting_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hall_seat_ticket_pivot');
    }
}
