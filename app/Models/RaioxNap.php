<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaioxNap extends Model
{
    protected $fillable = [
        'number',
        'timeSlept',
        'timeWokeUp',
        'window',
        'duration',
        'signalSlept',
        'windowSignalSlept'
    ];
}
