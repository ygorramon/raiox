<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaioxWake extends Model
{
    protected $fillable = [
        'number',
        'timeWokeUp',
        'timeSlept',
        'duration',
        'sleepingMode',
    ];
}
