<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoubtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doubts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->text('query');
            $table->text('response')->nullable();
            $table->dateTime('sended_at')->nullable();
            $table->dateTime('answered_at')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('doubts');
    }
}
