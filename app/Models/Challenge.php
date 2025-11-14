<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Challenge extends Model
{
    use Notifiable;

    protected $fillable = [
        'status','sended_at','answered_at','user_id','client_id','passo1','passo2',
        'passo3_despertar','passo3_rotina_alimentar',
        'passo3_rotina_sonecas','passo3_rotina_sonecas',
        'passo3_ambiente_sonecas','passo3_ambiente_noturno',
        'passo3_sono_noturno','passo4_associacoes_sonecas',
        'passo4_associacoes_noturno','conclusao','tipo'
    ];

    protected $casts = [
        'analises' => 'array',
    ];
    
    public function analyzes()
    {
        return $this->hasMany('App\Models\Analyze');
    }
    public function rotinas()
    {
        return $this->hasMany('App\Models\Rotina');
    }

    public function form()
    {
        return $this->hasOne('App\Models\Form');
  
    }
    public function formulario()
    {
        return $this->hasOne('App\Models\Formulario');
  
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
    public function chat()
    {
        return $this->hasOne('App\Models\Chat');
  
    }

    public function naps()
    {
        return $this->hasManyThrough('App\Models\Nap', 'App\Models\Analyze',
    
        'challenge_id', // Foreign key on users table...
        'analyze_id', // Foreign key on posts table...
        'id', // Local key on countries table...
        'id' );

    }

    public function rituals()
    {
        return $this->hasManyThrough('App\Models\Ritual', 'App\Models\Analyze',
    
        'challenge_id', // Foreign key on users table...
        'analyze_id', // Foreign key on posts table...
        'id', // Local key on countries table...
        'id' );

    }

    public function wakes()
    {
        return $this->hasManyThrough('App\Models\Wake', 'App\Models\Analyze',
    
        'challenge_id', // Foreign key on users table...
        'analyze_id', // Foreign key on posts table...
        'id', // Local key on countries table...
        'id' );

    }
    public function user(){
        return $this->belongsTo('App\User');

    }

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }
}
