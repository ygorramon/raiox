<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ClientResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;

class Client extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password','nameBaby','ageBaby',
        'sexBaby','active','expireAt','birthBaby','phone'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function challenges(){
        return $this->hasMany(Challenge::class);
    }

    public function sendPasswordResetNotification($token)
  {
      $this->notify(new ClientResetPasswordNotification($token));
  }
}
