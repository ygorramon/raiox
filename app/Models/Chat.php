<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'status','challenge_id'
    ];

    public function messages(){
        return $this->hasMany(Message::class);
    } 


public function challenge(){
    return $this->belongsTo(Challenge::class);
}

}
