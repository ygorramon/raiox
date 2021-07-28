<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('passo1')->nullable();
            $table->text('passo2')->nullable();
            $table->text('passo3_despertar')->nullable();
            $table->text('passo3_rotina_alimentar')->nullable();
            $table->text('passo3_rotina_sonecas')->nullable();
            $table->text('passo3_ambiente_sonecas')->nullable();
            $table->text('passo3_ambiente_noturno')->nullable();
            $table->text('passo3_sono_noturno')->nullable();
            $table->text('passo4_associacoes_sonecas')->nullable();
            $table->text('passo4_associacoes_noturno')->nullable();
            $table->text('conclusao')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('challenges');
    }
}
