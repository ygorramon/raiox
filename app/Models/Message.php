<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'content','type','chat_id'
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
