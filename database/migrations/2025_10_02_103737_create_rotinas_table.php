<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRotinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rotinas', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->date('data');
            $table->string( 'day');
            $table->time('inicioDia')->nullable();
            $table->text('observacoes')->nullable();
            $table->json('historicoSonecas')->nullable();
            $table->json('ritualNoturno')->nullable();
            $table->json('historicoDespertares')->nullable();
            $table->json('resumo')->nullable();
            $table->integer('idadeBebe')->nullable();
            $table->integer('tempoAcordadoEsperado')->nullable();
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
        Schema::dropIfExists('rotinas');
    }
}
