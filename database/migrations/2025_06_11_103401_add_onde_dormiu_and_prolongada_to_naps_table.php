<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOndeDormiuAndProlongadaToNapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('naps', function (Blueprint $table) {
            $table->string('onde_dormiu')->nullable();
            $table->boolean('prolongada')->default(false);
        });
    }

    public function down()
    {
        Schema::table('naps', function (Blueprint $table) {
            $table->dropColumn(['onde_dormiu', 'prolongada']);
        });
    }
}
