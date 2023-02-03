<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaioxNapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raiox_naps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number');
            $table->time('signalSlept');
            $table->time('timeSlept');
            $table->time('timeWokeUp');
            $table->integer('duration');
            $table->integer('window');
            $table->integer('windowSignalSlept');
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
        Schema::dropIfExists('raiox_naps');
    }
}
