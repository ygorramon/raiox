<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Challenge;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function challenges(){
        return $this->hasMany(Challenge::class);
    }
    public function chats(){
        return $this->hasManyThrough('App\Models\Chat', 'App\Models\Challenge',
    
        'user_id', // Foreign key on users table...
        'challenge_id', // Foreign key on posts table...
        'id', // Local key on countries table...
        'id' );
    }

    public function messages()
    {
        return $this->hasManyThrough(
            'App\Models\Message',
            'App\Models\Chat',
            'App\Models\Challenge',
            'message_id',
            'user_id', // Foreign key on users table...
            'challenge_id', // Foreign key on posts table...
            'id', // Local key on countries table...
            'id',
            'id'
        );
    }

    

    
}
