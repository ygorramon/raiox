<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $fillable = [
        'status','user_id','client_id'
    ];
    public function analyzes()
    {
        return $this->hasMany('App\Models\Analyze');
    }

    public function form()
    {
        return $this->hasOne('App\Models\Form');
  
    }

}
