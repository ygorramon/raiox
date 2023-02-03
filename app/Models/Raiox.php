<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Raiox extends Model
{
    protected $fillable = [
        'day',
        'date',
        'timeWokeUp',
        'volcanicEffect',
    ];

    public function naps()
    {
        return $this->hasMany('App\Models\RaioxNap');
    }
    public function wakes()
    {
        return $this->hasMany('App\Models\RaioxWake');
    }

    public function rituals()
    {
        return $this->hasMany('App\Models\RaioxRitual');
    }
}
