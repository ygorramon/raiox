<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaioxWakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raiox_wakes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number');
            $table->time('timeWokeUp');
            $table->time('timeSlept');
            $table->integer('duration');
            $table->text('sleepingMode');
            $table->unsignedBigInteger('raiox_id');
            $table->timestamps();
            $table->foreign('raiox_id')
                ->references('id')->on('raioxes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raiox_wakes');
    }
}
