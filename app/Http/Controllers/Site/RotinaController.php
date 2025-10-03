<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Rotina;
use Illuminate\Http\Request;

class RotinaController extends Controller
{
   public function store(Request $request, $id, $day)
{
    $data = $request->all();

    // Ajusta formato da data (se vier dd/mm/yyyy)
    if (isset($data['data'])) {

        $data['data'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['data'])->format('Y-m-d');
    }
//dd($data);
        Rotina::create([
            'day' => $day,
            'challenge_id' => $id, // vem do form ou sessão
            'data' => $data['data'],
            'inicioDia' => $request->input('inicioDia'),
            'historicoSonecas' => $request->input('historicoSonecas'),
            'ritualNoturno' => $request->input('ritualNoturno'),
            'historicoDespertares' => $request->input('historicoDespertares'),
            'resumo' => $request->input('resumo'),
            'idadeBebe' => $request->input('idadeBebe'),
            'tempoAcordadoEsperado' => $request->input('tempoAcordadoEsperado'),
            'observacoes' => $request->input('observacoes'),
            
        ]);

        return redirect()->route('desafio.show', $id)->with('success', 'Rotina salva com sucesso!');
        ;
}

    public function show($id, $day)
    {
        $rotina = Rotina::first();

        return view('site.desafio.view6', compact('rotina'));
    }
}
