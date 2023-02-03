<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaioxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raioxes', function (Blueprint $table) {
           
                $table->bigIncrements('id');
                $table->string('day');
                $table->date('date');
                $table->time('timeWokeUp');
                $table->string('volcanicEffect');
                $table->unsignedBigInteger('client_id');
                $table->timestamps();
                $table->foreign('client_id')
                ->references('id')->on('clients')
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
        Schema::dropIfExists('raioxes');
    }
}
