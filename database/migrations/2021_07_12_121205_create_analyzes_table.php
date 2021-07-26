<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalyzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analyzes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('day');
            $table->date('date');
            $table->time('timeWokeUp');
            $table->string('volcanicEffect');
            $table->unsignedBigInteger('challenge_id');
            $table->timestamps();
            $table->foreign('challenge_id')
                   ->references('id')->on('challenges')
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
        Schema::dropIfExists('analyzes');
    }
}
