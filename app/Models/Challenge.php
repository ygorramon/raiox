<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $fillable = [
        'status','user_id','client_id','passo1','passo2',
        'passo3_despertar','passo3_rotina_alimentar',
        'passo3_rotina_sonecas','passo3_rotina_sonecas',
        'passo3_ambiente_sonecas','passo3_ambiente_noturno',
        'passo3_sono_noturno','passo4_associacoes_sonecas',
        'passo4_associacoes_noturno','conclusao'
    ];


    
    public function analyzes()
    {
        return $this->hasMany('App\Models\Analyze');
    }

    public function form()
    {
        return $this->hasOne('App\Models\Form');
  
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
    public function chat()
    {
        return $this->hasOne('App\Models\Chat');
  
    }
}
