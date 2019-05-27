<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHallsTable extends Migration
{
    public function up(): void
    {
        Schema::create('halls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('vip_seat_price');
            $table->unsignedInteger('standard_seat_price');
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('halls');
    }
}
