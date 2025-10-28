<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnaliseIndividualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analise_individuals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('data');
            $table->string('titulo')->nullable();
            $table->time('inicioDia')->nullable();
            $table->text('observacoes')->nullable();
            $table->json('historicoSonecas')->nullable();
            $table->json('ritualNoturno')->nullable();
            $table->json('historicoDespertares')->nullable();
            $table->json('resumo')->nullable();
            $table->integer('idadeBebe')->nullable();
            $table->integer('tempoAcordadoEsperado')->nullable();
            $table->unsignedBigInteger('client_id');

            $table->foreign('client_id')
                ->references('id')->on('clients')
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
        Schema::dropIfExists('analise_individuals');
    }
}
