<?php

namespace App\Http\Controllers;

use App\Models\AnaliseIndividual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnaliseIndividualController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $client = Auth::guard('clients')->user();

        // Ajusta formato da data (se vier dd/mm/yyyy)
        if (isset($data['data']) && !empty($data['data'])) {
            try {
                $data['data'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['data'])->format('Y-m-d');
            } catch (\Exception $e) {
                // Se houver erro na conversão, usa data atual
                $data['data'] = now()->format('Y-m-d');
            }
        } else {
            $data['data'] = now()->format('Y-m-d');
        }

        AnaliseIndividual::create([
            'client_id' => $client->id,
            'data' => $data['data'],
            'titulo' => $request->input('titulo', 'Análise do Dia'),
            'inicioDia' => $request->input('inicioDia'),
            'historicoSonecas' => $request->input('historicoSonecas'),
            'ritualNoturno' => $request->input('ritualNoturno'),
            'historicoDespertares' => $request->input('historicoDespertares'),
            'resumo' => $request->input('resumo'),
            'idadeBebe' => $request->input('idadeBebe'),
            'tempoAcordadoEsperado' => $request->input('tempoAcordadoEsperado'),
            'observacoes' => $request->input('observacoes'),
        ]);

        return redirect()->route('analises.individuais.index')->with('success', 'Análise individual salva com sucesso!');
    }

    public function show($id)
    {
        $analise = AnaliseIndividual::with('client')->findOrFail($id);

       
        return view('site.desafio.view-raiox-2', compact('analise'));
    }

    // Método para listar todas as análises do cliente
    public function index()
    {
        $client = Auth::guard('clients')->user();
        $analises = $client->analisesIndividuais()->orderBy('data', 'desc')->get();

        return view('site.desafio.index-raiox-2', compact('analises'));
    }

    // Método para editar
    public function edit($id)
    {
        $analise = AnaliseIndividual::findOrFail($id);

        return view('analises.individuais.edit', compact('analise'));
    }

    // Método para atualizar
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $analise = AnaliseIndividual::findOrFail($id);

        // Ajusta formato da data (se vier dd/mm/yyyy)
        if (isset($data['data']) && !empty($data['data'])) {
            try {
                $data['data'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['data'])->format('Y-m-d');
            } catch (\Exception $e) {
                $data['data'] = now()->format('Y-m-d');
            }
        } else {
            $data['data'] = now()->format('Y-m-d');
        }

        $analise->update([
            'data' => $data['data'],
            'titulo' => $request->input('titulo'),
            'inicioDia' => $request->input('inicioDia'),
            'historicoSonecas' => $request->input('historicoSonecas'),
            'ritualNoturno' => $request->input('ritualNoturno'),
            'historicoDespertares' => $request->input('historicoDespertares'),
            'resumo' => $request->input('resumo'),
            'idadeBebe' => $request->input('idadeBebe'),
            'tempoAcordadoEsperado' => $request->input('tempoAcordadoEsperado'),
            'observacoes' => $request->input('observacoes'),
        ]);

        return redirect()->route('analises.individuais.show', $analise->id)->with('success', 'Análise atualizada com sucesso!');
    }

    // Método para deletar
    public function destroy($id)
    {
        $analise = AnaliseIndividual::findOrFail($id);
        $analise->delete();

        return redirect()->route('analises.individuais.index')->with('success', 'Análise excluída com sucesso!');
    }
    public function create()
    {
        $client = Auth::guard('clients')->user();
       

        return view('site.desafio.create-raiox-2', compact('client'));
    }
}