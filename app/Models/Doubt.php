<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doubt extends Model
{

    protected $fillable = [
        'status', 'query', 'response', 'sended_at', 'answered_at', 'client_id', 'user_id'
    ];

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
