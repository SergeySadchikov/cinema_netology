<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatsTable extends Migration
{
    public function up(): void
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('row');
            $table->integer('seat_number');
            $table->timestamps();

            $table->unique(['row', 'seat_number'], 'row_seat_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
}
