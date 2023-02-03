<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaioxRitual extends Model
{
    protected $fillable = [
        'start',
        'end',
        'duration',
        'window',
        'signalSlept',
        'windowSignalSlept'
    ];
}
