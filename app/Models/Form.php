<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [

        'ritualGoodMorning',
        'weightGain',
        'ritualGoodMorningLight',
        'ritualGoodMorningNoise',
        'ritualGoodMorningStimulus',
        'ritualGoodMorningRemove',
        'typeEatingRoutine',
        'routineDifficulties',
        'weightGain',

        'energyExpenditure',
        'noticeSigns',
        'slowDown',
        'ritualType',
        'environmentNapsLights',
        'environmentNapsNoises',
        'environmentNapsTemperature',
        'whereSleepCrib',
        'whereSleepLap',
        'whereSleepLapCrib',
        'whereSleepSharedBed',
        'whereSleepCar',
        'whereSleepRede',
        'whereSleepOther',
        'environmentNapBother',
        'napAssociationWhiteNoise',
        'napAssociationCloth',
        'napAssociationPacifier',
        'napAssociationSuckFinger',
        'napAssociationSuckle',
        'napAssociationCC',
        'napAssociationLap',
        'napAssociationOther',
        'enoughNap',
        'wakeUpNap',
        'nightRitual',
        'environmentRitualLights',
        'environmentRitualNoises',
        'environmentRitualTemperature',
        'ritualAssociationWhiteNoise',
        'ritualAssociationCloth',
        'ritualAssociationPacifier',
        'ritualAssociationSuckFinger',
        'ritualAssociationSuckle',

        'ritualAssociationCC',
        'ritualAssociationLap',
        'ritualAssociationOther',
        'conclusionImmaturity',
        'conclusionHungry',
        'conclusionAche',
        'conclusionJump',
        'conclusionAnguish',
        'conclusionScreens',
        'conclusionStress',
        'comments',
    ];
}
