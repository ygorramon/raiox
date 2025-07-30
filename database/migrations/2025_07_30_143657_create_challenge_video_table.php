<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengeVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenge_video', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('challenge_id');
            $table->unsignedBigInteger('video_id');

            $table->foreign('challenge_id')
                ->references('id')
                ->on('challenges')
                ->onDelete('cascade');
            $table->foreign('video_id')
                ->references('id')
                ->on('videos')
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
        Schema::dropIfExists('challenge_video');
    }
}
