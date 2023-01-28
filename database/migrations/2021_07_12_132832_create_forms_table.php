<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('challenge_id');
            $table->string('ritualGoodMorning');
            $table->string('weightGain');
            $table->string('ritualGoodMorningLight');
            $table->string('ritualGoodMorningNoise');
            $table->string('ritualGoodMorningStimulus');
            $table->string('ritualGoodMorningRemove');
            $table->string('typeEatingRoutine');
            $table->string('routineDifficulties');
            
            $table->string('energyExpenditure');
            $table->string('noticeSigns');
            $table->string('slowDown');
            $table->string('ritualType');
            $table->string('environmentNapsLights');
            $table->string('environmentNapsNoises');
            $table->string('environmentNapsTemperature');
            $table->string('whereSleepCrib');
            $table->string('whereSleepLap');
            $table->string('whereSleepLapCrib');
            $table->string('whereSleepSharedBed');
            $table->string('whereSleepCar');
            $table->string('whereSleepRede');
            $table->string('whereSleepOther');
            $table->string('environmentNapBother');
            $table->string('napAssociationWhiteNoise');
            $table->string('napAssociationCloth');
            $table->string('napAssociationPacifier');
            $table->string('napAssociationSuckFinger');
            $table->string('napAssociationSuckle');
            $table->string('napAssociationCC');
            $table->string('napAssociationLap');            
            $table->string('napAssociationOther');
            $table->string('enoughNap');
            $table->string('wakeUpNap');
            $table->string('nightRitual');
            $table->string('environmentRitualLights');
            $table->string('environmentRitualNoises');
            $table->string('environmentRitualTemperature');
            $table->string('ritualAssociationWhiteNoise');
            $table->string('ritualAssociationCloth');
            $table->string('ritualAssociationPacifier');
            $table->string('ritualAssociationSuckFinger');
            $table->string('ritualAssociationSuckle');
            $table->string('ritualAssociationCC');
            $table->string('ritualAssociationLap');
           
            $table->string('ritualAssociationOther');
            $table->string('conclusionImmaturity');
            $table->string('conclusionHungry');
            $table->string('conclusionAche');
            $table->string('conclusionJump');
            $table->string('conclusionAnguish');
            $table->string('conclusionScreens');
            $table->string('conclusionStress');
            $table->text('comments')->nullable();

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
        Schema::dropIfExists('forms');
    }
}
