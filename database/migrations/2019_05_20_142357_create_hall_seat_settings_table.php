<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHallSeatSettingsTable extends Migration
{
    public function up(): void
    {
        Schema::create('hall_seat_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hall_id');
            $table->unsignedInteger('seat_id');
            $table->boolean('is_vip')->default(false);
            $table->boolean('is_active')->default(true);
            $table->float('price', 8, 2);
            $table->timestamps();
            $table->unique(['hall_id', 'seat_id'], 'hall_seat_unique');

            $table->foreign('hall_id')
                ->references('id')
                ->on('seats')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('seat_id')
                ->references('id')
                ->on('seats')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hall_seat_settings');
    }
}
