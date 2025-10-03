<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rotina extends Model
{
    protected $fillable = [
        'day',
        'challenge_id',
        'data',
        'inicioDia',
        'observacoes',
        'historicoSonecas',
        'ritualNoturno',
        'historicoDespertares',
        'resumo',
        'idadeBebe',
        'tempoAcordadoEsperado'
    ];

    protected $casts = [
        'historicoSonecas' => 'array',
        'ritualNoturno' => 'array',
        'historicoDespertares' => 'array',
        'resumo' => 'array',
        'data' => 'date',
    ];

    public function challenge(){
        $this->belongsTo('App\Models\Challenge');
    }
}
