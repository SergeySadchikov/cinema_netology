<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeancesTable extends Migration
{
    public function up(): void
    {
        Schema::create('seances', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('start_time');
            $table->unsignedInteger('end_time');
            $table->unsignedInteger('film_id');
            $table->unsignedInteger('hall_id');
            $table->timestamps();

            $table->unique(['hall_id', 'start_time', 'end_time'], 'hall_time_unique');

            $table->foreign('film_id')
                ->references('id')
                ->on('films')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('hall_id')
                ->references('id')
                ->on('halls')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seances');
    }
}
