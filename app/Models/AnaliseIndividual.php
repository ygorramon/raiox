<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnaliseIndividual extends Model
{
    protected $fillable = [
        'data',
        'titulo',
        'inicioDia',
        'observacoes',
        'historicoSonecas',
        'ritualNoturno',
        'historicoDespertares',
        'resumo',
        'idadeBebe',
        'tempoAcordadoEsperado',
        'client_id'
    ];

    protected $casts = [
        'data' => 'date',
        'historicoSonecas' => 'array',
        'ritualNoturno' => 'array',
        'historicoDespertares' => 'array',
        'resumo' => 'array',
    ];

    // Relacionamento com Client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
