<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();;
            $table->time('timeWokeUp')->nullable();;
            $table->string('volcanicEffect')->nullable();;
            $table->time('nap_signalSlept_1')->nullable();;
            $table->time('nap_timeSlept_1')->nullable();;
            $table->time('nap_timeWokeUp_1')->nullable();;
            $table->text('nap_onde_dormiu_1')->nullable();;
            $table->text('nap_prolongada_1')->nullable();;
            $table->time('nap_signalSlept_2')->nullable();;
            $table->time('nap_timeSlept_2')->nullable();;
            $table->time('nap_timeWokeUp_2')->nullable();;
            $table->text('nap_onde_dormiu_2')->nullable();;
            $table->text('nap_prolongada_2')->nullable();;
            $table->time('nap_signalSlept_3')->nullable();;
            $table->time('nap_timeSlept_3')->nullable();;
            $table->time('nap_timeWokeUp_3')->nullable();;
            $table->text('nap_onde_dormiu_3')->nullable();;
            $table->text('nap_prolongada_3')->nullable();;
            $table->time('nap_signalSlept_4')->nullable();;
            $table->time('nap_timeSlept_4')->nullable();;
            $table->time('nap_timeWokeUp_4')->nullable();;
            $table->text('nap_onde_dormiu_4')->nullable();;
            $table->text('nap_prolongada_4')->nullable();;
            $table->time('nap_signalSlept_5')->nullable();;
            $table->time('nap_timeSlept_5')->nullable();;
            $table->time('nap_timeWokeUp_5')->nullable();;
            $table->text('nap_onde_dormiu_5')->nullable();;
            $table->text('nap_prolongada_5')->nullable();;
            $table->time('nap_signalSlept_6')->nullable();;
            $table->time('nap_timeSlept_6')->nullable();;
            $table->time('nap_timeWokeUp_6')->nullable();;
            $table->text('nap_onde_dormiu_6')->nullable();;
            $table->text('nap_prolongada_6')->nullable();;
            $table->time('ritual_signalSlept')->nullable();;
            $table->time('ritual_start')->nullable();;
            $table->time('ritual_end')->nullable();;
            $table->text('observacoes')->nullable();;
            $table->time('wake_timeWokeUp1')->nullable();;
            $table->time('wake_timeSlept1')->nullable();;
            $table->text('wake_sleepingMode1')->nullable();;
            $table->time('wake_timeWokeUp2')->nullable();
            ;
            $table->time('wake_timeSlept2')->nullable();
            ;
            $table->text('wake_sleepingMode2')->nullable();
            ;
            $table->time('wake_timeWokeUp3')->nullable();
            ;
            $table->time('wake_timeSlept3')->nullable();
            ;
            $table->text('wake_sleepingMode3')->nullable();
            ;
            $table->time('wake_timeWokeUp4')->nullable();
            ;
            $table->time('wake_timeSlept4')->nullable();
            ;
            $table->text('wake_sleepingMode4')->nullable();
            ;
            $table->time('wake_timeWokeUp5')->nullable();
            ;
            $table->time('wake_timeSlept5')->nullable();
            ;
            $table->text('wake_sleepingMode5')->nullable();
            ;
            $table->time('wake_timeWokeUp6')->nullable();
            ;
            $table->time('wake_timeSlept6')->nullable();
            ;
            $table->text('wake_sleepingMode6')->nullable();
            ;
            $table->unsignedBigInteger('analyze_id');
            $table->foreign('analyze_id')
            ->references('id')->on('analyzes')
                ->onDelete('cascade');
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dados');
    }
}
