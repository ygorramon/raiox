<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analyze extends Model
{
    protected $fillable = [
        'day',
        'date',
        'started_at', 
        'timeWokeUp', 
        'volcanicEffect', 
           ];

    protected $casts = [
        'started_at' => 'date',
    ];
    

        public function naps()
        {
            return $this->hasMany('App\Models\Nap');
        }
        public function wakes()
        {
            return $this->hasMany('App\Models\Wake');
        }

        public function rituals()
        {
            return $this->hasMany('App\Models\Ritual');
        }
    
}
