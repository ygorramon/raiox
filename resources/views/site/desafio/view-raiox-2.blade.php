@extends('site.desafio.layouts.app')

@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        margin: 0;
        padding: 20px;
        min-height: 100vh;
    }
    
    .container {
        max-width: 1000px;
        margin: 0 auto;
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        overflow: hidden;
    }
    
    .header {
        background: linear-gradient(135deg, #2196F3, #1976D2);
        color: white;
        padding: 25px;
        text-align: center;
    }
    
    .header h1 {
        margin: 0;
        font-size: 28px;
    }
    
    .header .date {
        font-size: 18px;
        opacity: 0.9;
        margin-top: 8px;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        padding: 25px;
        background: #f8f9fa;
    }
    
    .info-card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        border-left: 4px solid #2196F3;
    }
    
    .info-card h3 {
        margin: 0 0 15px 0;
        color: #333;
        font-size: 18px;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 8px;
    }
    
    .info-item {
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
    }
    
    .info-label {
        font-weight: 600;
        color: #555;
    }
    
    .info-value {
        color: #333;
    }
    
    .section {
        padding: 25px;
        border-bottom: 1px solid #eee;
    }
    
    .section:last-child {
        border-bottom: none;
    }
    
    .section h2 {
        color: #2196F3;
        margin: 0 0 20px 0;
        font-size: 22px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .section h2::before {
        content: "●";
        color: #2196F3;
    }
    
    .soneca-item, .despertar-item {
        background: #f8f9fa;
        padding: 20px;
        margin: 15px 0;
        border-radius: 10px;
        border-left: 4px solid #4CAF50;
    }
    
    .soneca-header, .despertar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .soneca-numero {
        background: #4CAF50;
        color: white;
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: bold;
    }
    
    .status-badge {
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: bold;
    }
    
    .status-ideal {
        background: #E8F5E8;
        color: #2E7D32;
    }
    
    .status-reparadora {
        background: #E3F2FD;
        color: #1565C0;
    }
    
    .detalhes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-top: 15px;
    }
    
    .associacoes-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }
    
    .tag {
        background: #E3F2FD;
        color: #1976D2;
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .ritual-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }
    
    .resumo-card {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 25px;
        border-radius: 10px;
        text-align: center;
    }
    
    .resumo-number {
        font-size: 36px;
        font-weight: bold;
        margin: 10px 0;
    }
    
    .avaliacao {
        font-size: 20px;
        font-weight: bold;
        margin-top: 15px;
        padding: 10px;
        background: rgba(255,255,255,0.2);
        border-radius: 10px;
    }

    .card-panel {
        padding: 15px;
        margin: 10px 0;
        border-radius: 8px;
    }

    .green.lighten-4 {
        background-color: #e8f5e8 !important;
    }

    .orange.lighten-4 {
        background-color: #ffe0b2 !important;
    }

    .red.lighten-4 {
        background-color: #ffcdd2 !important;
    }

    .blue.lighten-4 {
        background-color: #bbdefb !important;
    }

    .purple.lighten-4 {
        background-color: #e1bee7 !important;
    }

    .teal.lighten-4 {
        background-color: #b2dfdb !important;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-top: 20px;
    }
</style>
@stop

@section('content')
    <div class="container">
        <!-- Cabeçalho -->
        <div class="header">
            <h1>📊 Análise Individual do Sono</h1>
            <div class="date">
                @if($analise && $analise->data)
                    {{ \Carbon\Carbon::parse($analise->data)->format('d/m/Y') }}
                    @if($analise->titulo)
                        - {{ $analise->titulo }}
                    @endif
                @else
                    Análise não encontrada
                @endif
            </div>
        </div>

        @if($analise)
                                                            <!-- Informações Básicas -->
                                                            <div class="info-grid">
                                                                <div class="info-card">
                                                                    <h3>👶 Informações do Bebê</h3>
                                                                    <div class="info-item">
                                                                        <span class="info-label">Idade:</span>
                                                                        <span class="info-value">{{ $analise->idadeBebe }} meses</span>
                                                                    </div>
                                                                    <div class="info-item">
                                                                        <span class="info-label">Início do Dia:</span>
                                                                        <span class="info-value">{{ $analise->inicioDia }}</span>
                                                                    </div>
                                                                    <div class="info-item">
                                                                        <span class="info-label">Tempo Acordado Esperado:</span>
                                                                        <span class="info-value">{{ $analise->tempoAcordadoEsperado }}min</span>
                                                                    </div>
                                                                </div>

                                                                <div class="info-card">
                                                                    <h3>📝 Observações</h3>
                                                                    <p style="margin: 0; color: #666; line-height: 1.5;">
                                                                        {{ $analise->observacoes ?? 'Nenhuma observação registrada' }}
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <!-- Botões de Ação -->
                                                            <div class="section">
                                                                <div class="action-buttons">
                                                                    <a href="{{ route('analises.individuais.edit', $analise->id) }}" class="btn waves-effect waves-light orange">
                                                                        ✏️ Editar Análise
                                                                    </a>
                                                                    <a href="{{ route('analises.individuais.index') }}" class="btn waves-effect waves-light blue">
                                                                        📋 Voltar para Lista
                                                                    </a>
                                                                    <form action="{{ route('analises.individuais.destroy', $analise->id) }}" method="POST" style="display: inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn waves-effect waves-light red" onclick="return confirm('Tem certeza que deseja excluir esta análise?')">
                                                                            🗑️ Excluir
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>

                                                            <!-- Histórico de Sonecas -->
                                                            
  @php
    $sonecas = json_decode($analise->historicoSonecas, true);
                                                                         @endphp

                                            @if(!empty($sonecas))
                                                <div class="section">
                                                    <h2>💤 Histórico de Sonecas</h2>
                                                    @foreach($sonecas as $index => $soneca)
                                                        <div class="soneca-item">
                                                            <div class="soneca-header">
                                                                <div class="soneca-numero">Soneca #{{ $soneca['numero'] ?? 'N/A' }}</div>
                                                                <div class="status-badge status-ideal">{{ $soneca['detalhes']['janela']['status'] ?? 'Sem status' }}</div>
                                                            </div>

                                                            <div class="detalhes-grid">
                                                                <div>
                                                                    <strong>⏰ Horários:</strong><br>
                                                                    Sentiu sono: {{ $soneca['sentiuSono'] ?? 'N/A' }}<br>
                                                                    Início: {{ $soneca['inicio'] ?? 'N/A' }}<br>
                                                                    Término: {{ $soneca['termino'] ?? 'N/A' }}<br>
                                                                    Duração: {{ $soneca['duracao'] ?? 'N/A' }}min
                                                                </div>

                                                                <div>
                                                                    <strong>📊 Métricas:</strong><br>
                                                                    Janela de sono: {{ $soneca['janelaSono'] ?? 'N/A' }}min<br>
                                                                    Situação: {{ $soneca['situacao'] ?? 'N/A' }}
                                                                </div>

                                                                @if(isset($soneca['associacoes']) && isset($soneca['associacoes']['comoAdormeceu']))
                                                                    <div>
                                                                        <strong>🛌 Associações:</strong><br>
                                                                        <div class="associacoes-list">
                                                                            @php
                        $associacoesComoAdormeceu = $soneca['associacoes']['comoAdormeceu'];
                        $totalAssociacoes = count($associacoesComoAdormeceu);
                                                                            @endphp

                                                                            @foreach(array_slice($associacoesComoAdormeceu, 0, 2) as $associacao)
                                                                                <span class="tag">{{ $associacao }}</span>
                                                                            @endforeach

                                                                            @if($totalAssociacoes > 2)
                                                                                <br>
                                                                                <button type="button" class="btn btn-sm btn-outline-info mt-1" data-toggle="modal"
                                                                                    data-target="#modalAssociacoes{{ $soneca['numero'] ?? $index }}">
                                                                                    +{{ $totalAssociacoes - 2 }} mais
                                                                                </button>
                                                                            @endif
                                                                        </div>

                                                                        @if(isset($soneca['associacoes']['depoisAdormecer']))
                                                                            <div style="margin-top: 8px;">
                                                                                <strong>Local após dormir:</strong>
                                                                                <div class="associacoes-list">
                                                                                    @foreach($soneca['associacoes']['depoisAdormecer'] as $local)
                                                                                        <span class="tag">{{ $local }}</span>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <!-- Botão de Recomendações -->
                                                            <button type="button" onclick="mostrarRecomendacoes({{ $index }})"
                                                                style="margin-top: 15px; padding: 10px 20px; background: #ff9800; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; display: flex; align-items: center; gap: 8px;">
                                                                💡 Ver Recomendações
                                                            </button>

                                                            <!-- Container das Recomendações -->
                                                            <div id="recomendacoes-{{ $index }}" class="recomendacoes-container"
                                                                style="display: none; margin-top: 15px; padding: 20px; background: #f8f9fa; border-radius: 8px; border-left: 4px solid #ff9800;">
                                                            </div>

                                                            @if(isset($soneca['detalhes']['janela']['recomendacao']))
                                                                <div
                                                                    style="margin-top: 15px; padding: 12px; background: #E8F5E8; border-radius: 8px; border-left: 4px solid #4CAF50;">
                                                                    <strong>💡 Recomendação:</strong><br>
                                                                    {{ $soneca['detalhes']['janela']['recomendacao'] }}
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <!-- Modal para Associações -->
                                                        @if(isset($soneca['associacoes']) && isset($soneca['associacoes']['comoAdormeceu']) && count($soneca['associacoes']['comoAdormeceu']) > 2)
                                                            <div class="modal fade" id="modalAssociacoes{{ $soneca['numero'] ?? $index }}" tabindex="-1">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">📋 Associações - Soneca {{ $soneca['numero'] ?? $index }}</h5>
                                                                            <button type="button" class="close" data-dismiss="modal">
                                                                                <span>&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="mb-3">
                                                                                <h6>🛌 Como adormeceu:</h6>
                                                                                <div class="card">
                                                                                    <div class="card-body">
                                                                                        @foreach($soneca['associacoes']['comoAdormeceu'] as $associacao)
                                                                                            @if(strpos($associacao, 'Outro:') !== false || strpos($associacao, 'Outros:') !== false)
                                                                                                <div class="mb-2 p-2 bg-light rounded">
                                                                                                    <strong>Outros:</strong><br>
                                                                                                    <span class="text-dark">
                                                                                                        @php
                                $textoLimpo = str_replace(['Outro:', 'Outros:'], '', $associacao);
                                echo trim($textoLimpo);
                                                                                                        @endphp
                                                                                                    </span>
                                                                                                </div>
                                                                                            @else
                                                                                                <span class="badge bg-info mb-1">{{ $associacao }}</span>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="section">
                                                    <div class="card-panel yellow lighten-4">
                                                        <h6>💤 Histórico de Sonecas</h6>
                                                        <p class="yellow-text darken-4">Nenhuma soneca registrada para esta análise.</p>
                                                    </div>
                                                </div>
                                            @endif
                                                            @if($sonecas)
                                                                                                                          

                                                                                                <div class="section">
                                                                                                    <h2>💤 Histórico de Sonecas</h2>
                                                                                                    @foreach($sonecas as $index => $soneca)
                                                                                                            <div class="soneca-item">
                                                                                                                <div class="soneca-header">
                                                                                                                    <div class="soneca-numero">Soneca #{{ $soneca['numero'] }}</div>
                                                                                                                    <div class="status-badge status-ideal">{{ $soneca['detalhes']['janela']['status'] ?? 'Sem status' }}</div>
                                                                                                                </div>

                                                                                                                <div class="detalhes-grid">
                                                                                                                    <div>
                                                                                                                        <strong>⏰ Horários:</strong><br>
                                                                                                                        Sentiu sono: {{ $soneca['sentiuSono'] ?? 'N/A' }}<br>
                                                                                                                        Início: {{ $soneca['inicio'] }}<br>
                                                                                                                        Término: {{ $soneca['termino'] }}<br>
                                                                                                                        Duração: {{ $soneca['duracao'] }}min
                                                                                                                    </div>

                                                                                                                    <div>
                                                                                                                        <strong>📊 Métricas:</strong><br>
                                                                                                                        Janela de sono: {{ $soneca['janelaSono'] }}min<br>
                                                                                                                        Situação: {{ $soneca['situacao'] ?? 'N/A' }}
                                                                                                                    </div>

                                                                                                                    @if(isset($soneca['associacoes']))
                                                                                                                        <div>
                                                                                                                            <strong>🛌 Associações:</strong><br>
                                                                                                                            <div class="associacoes-list">
                                                                                                                                @foreach(array_slice($soneca['associacoes']['comoAdormeceu'], 0, 2) as $associacao)
                                                                                                                                    <span class="tag">{{ $associacao }}</span>
                                                                                                                                @endforeach

                                                                                                                                @if(count($soneca['associacoes']['comoAdormeceu']) > 2)
                                                                                                                                    <br>
                                                                                                                                    <button type="button" class="btn btn-sm btn-outline-info mt-1" data-toggle="modal" data-target="#modalAssociacoes{{ $soneca['numero'] }}">
                                                                                                                                        +{{ count($soneca['associacoes']['comoAdormeceu']) - 2 }} mais
                                                                                                                                    </button>
                                                                                                                                @endif
                                                                                                                            </div>

                                                                                                                            @if(isset($soneca['associacoes']['depoisAdormecer']))
                                                                                                                                <div style="margin-top: 8px;">
                                                                                                                                    <strong>Local após dormir:</strong>
                                                                                                                                    <div class="associacoes-list">
                                                                                                                                        @foreach($soneca['associacoes']['depoisAdormecer'] as $local)
                                                                                                                                            <span class="tag">{{ $local }}</span>
                                                                                                                                        @endforeach
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            @endif
                                                                                                                        </div>
                                                                                                                    @endif
                                                                                                                </div>

                                                                                                                <!-- Botão de Recomendações -->
                                                                                                                <button type="button" 
                                                                                                                        onclick="mostrarRecomendacoes({{ $index }})"
                                                                                                                        style="margin-top: 15px; padding: 10px 20px; background: #ff9800; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; display: flex; align-items: center; gap: 8px;">
                                                                                                                    💡 Ver Recomendações
                                                                                                                </button>

                                                                                                                <!-- Container das Recomendações -->
                                                                                                                <div id="recomendacoes-{{ $index }}" class="recomendacoes-container" style="display: none; margin-top: 15px; padding: 20px; background: #f8f9fa; border-radius: 8px; border-left: 4px solid #ff9800;">
                                                                                                                </div>

                                                                                                                @if(isset($soneca['detalhes']['janela']['recomendacao']))
                                                                                                                    <div style="margin-top: 15px; padding: 12px; background: #E8F5E8; border-radius: 8px; border-left: 4px solid #4CAF50;">
                                                                                                                        <strong>💡 Recomendação:</strong><br>
                                                                                                                        {{ $soneca['detalhes']['janela']['recomendacao'] }}
                                                                                                                    </div>
                                                                                                                @endif
                                                                                                            </div>

                                                                                                            <!-- Modal para Associações -->
                                                                                                            @if(isset($soneca['associacoes']) && count($soneca['associacoes']['comoAdormeceu']) > 2)
                                                                                                            <div class="modal fade" id="modalAssociacoes{{ $soneca['numero'] }}" tabindex="-1">
                                                                                                                <div class="modal-dialog modal-lg">
                                                                                                                    <div class="modal-content">
                                                                                                                        <div class="modal-header">
                                                                                                                            <h5 class="modal-title">📋 Associações - Soneca {{ $soneca['numero'] }}</h5>
                                                                                                                            <button type="button" class="close" data-dismiss="modal">
                                                                                                                                <span>&times;</span>
                                                                                                                            </button>
                                                                                                                        </div>
                                                                                                                        <div class="modal-body">
                                                                                                                            <div class="mb-3">
                                                                                                                                <h6>🛌 Como adormeceu:</h6>
                                                                                                                                <div class="card">
                                                                                                                                    <div class="card-body">
                                                                                                                                        @foreach($soneca['associacoes']['comoAdormeceu'] as $associacao)
                                                                                                                                            @if(strpos($associacao, 'Outro:') !== false || strpos($associacao, 'Outros:') !== false)
                                                                                                                                                <div class="mb-2 p-2 bg-light rounded">
                                                                                                                                                    <strong>Outros:</strong><br>
                                                                                                                                                    <span class="text-dark">
                                                                                                                                                        @php
                                                                $textoLimpo = str_replace(['Outro:', 'Outros:'], '', $associacao);
                                                                echo trim($textoLimpo);
                                                                                                                                                        @endphp
                                                                                                                                                    </span>
                                                                                                                                                </div>
                                                                                                                                            @else
                                                                                                                                                <span class="badge bg-info mb-1">{{ $associacao }}</span>
                                                                                                                                            @endif
                                                                                                                                        @endforeach
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            @endif
                                                                                                    @endforeach
                                                                                                </div>
                                                            @endif

                                                        <!-- Ritual Noturno -->
                                                        @php
            $ritual = $analise->ritualNoturno;
            // Se for string, tenta converter de JSON para array
            if (is_string($ritual)) {
                $ritual = json_decode($ritual, true);
            }
            // Garantir que seja um array
            $ritual = is_array($ritual) ? $ritual : [];
                                                        @endphp

                                                        

                                                            @if($ritual)
                                                                <div class="section">
                                                                    <h2>🌙 Ritual Noturno</h2>
                                                                    <div class="ritual-grid">
                                                                        <div class="info-card">
                                                                            <strong>Início do Ritual:</strong><br>
                                                                            {{ $ritual['inicioRitual'] }}
                                                                        </div>
                                                                        <div class="info-card">
                                                                            <strong>Sono Noturno:</strong><br>
                                                                            {{ $ritual['sonoNoturno'] }}
                                                                        </div>
                                                                        <div class="info-card">
                                                                            <strong>Duração do Ritual:</strong><br>
                                                                            {{ $ritual['duracaoRitual'] }} minutos
                                                                        </div>
                                                                        <div class="info-card">
                                                                            <strong>Local do Sono:</strong><br>
                                                                            {{ ucfirst(str_replace('-', ' ', $ritual['localSono'])) }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            <!-- Histórico de Despertares -->
                                                            @php
                                                           
     $despertares = json_decode($analise->historicoDespertares, true);
           
                                                            @endphp

                                                            @if($despertares)
                                                                <div class="section">
                                                                    <h2>⏰ Histórico de Despertares</h2>
                                                                    @foreach($despertares as $despertar)
                                                                        <div class="despertar-item">
                                                                            <div class="soneca-header">
                                                                                <div class="soneca-numero">Despertar #{{ $despertar['numero'] }}</div>
                                                                            </div>

                                                                            <div class="detalhes-grid">
                                                                                <div>
                                                                                    <strong>⏰ Horários:</strong><br>
                                                                                    Acordou: {{ $despertar['horaAcordou'] }}<br>
                                                                                    Dormiu: {{ $despertar['horaDormiu'] }}<br>
                                                                                    Duração: {{ $despertar['duracao'] }}min
                                                                                </div>

                                                                                <div>
                                                                                    <strong>🛌 Formas de Voltar a Dormir:</strong><br>
                                                                                    <div class="associacoes-list">
                                                                                        @foreach($despertar['formasVolta'] as $forma)
                                                                                            <span class="tag">{{ $forma }}</span>
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif

                                                        <!-- Resumo do Dia -->
                                                        @php
            $resumo = $analise->resumo;
            // Se for string, tenta converter de JSON para array
            if (is_string($resumo)) {
                $resumo = json_decode($resumo, true);
            }
            // Garantir que seja um array
            $resumo = is_array($resumo) ? $resumo : [];
                                                        @endphp

                                                            @if($resumo)
                                                                <div class="section">
                                                                    <h2>📈 Resumo do Dia</h2>
                                                                    <div class="resumo-card">
                                                                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px;">
                                                                            <div>
                                                                                <div>Total de Sonecas</div>
                                                                                <div class="resumo-number">{{ $resumo['totalSonecas'] }}</div>
                                                                            </div>
                                                                            <div>
                                                                                <div>Total de Despertares</div>
                                                                                <div class="resumo-number">{{ $resumo['totalDespertares'] }}</div>
                                                                            </div>
                                                                            <div>
                                                                                <div>Tempo Total de Sonecas</div>
                                                                                <div class="resumo-number">{{ $resumo['tempoTotalSonecas'] }}min</div>
                                                                            </div>
                                                                        </div>

                                                                        @if(isset($resumo['avaliacao']))
                                                                        <div class="avaliacao">
                                                                            Avaliação: {{ $resumo['avaliacao'] }}
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endif

        @else
            <div class="section">
                <div class="card-panel red lighten-4">
                    <h4>Análise não encontrada</h4>
                    <p>Não foi possível encontrar a análise especificada.</p>
                    <a href="{{ route('analises.individuais.index') }}" class="btn waves-effect waves-light">Voltar para Lista</a>
                </div>
            </div>
        @endif
    </div>

            <!-- Script para carregar recomendações -->
            <script>
            // Dados das sonecas passados do PHP para JavaScript
            const historicoSonecas = @json($sonecas ?? []);

            function mostrarRecomendacoes(sonecaIndex) {
                const container = document.getElementById(`recomendacoes-${sonecaIndex}`);
                const button = container.previousElementSibling;

                if (container.style.display === 'none') {
                    // Carrega as recomendações
                    const soneca = historicoSonecas[sonecaIndex];
                    const codigoAnalise = soneca.situacao || '1.1';
                    const duracao = soneca.duracao || 0;

                    container.innerHTML = carregarRecomendacoesAccordion(codigoAnalise, duracao, sonecaIndex);
                    container.style.display = 'block';
                    button.innerHTML = '▼ Ocultar Recomendações';
                    button.style.background = '#f57c00';
                } else {
                    container.style.display = 'none';
                    button.innerHTML = '💡 Ver Recomendações';
                    button.style.background = '#ff9800';
                }
            }

            // Função para carregar recomendações (sua função original adaptada)
            function carregarRecomendacoesAccordion(codigoAnalise, duracao, sonecaIndex = null) {
                let recomendacoesHTML = '';
                let soneca = null;
                let associacoes = null;

                if (sonecaIndex !== null && historicoSonecas[sonecaIndex]) {
                    soneca = historicoSonecas[sonecaIndex];
                    associacoes = soneca.associacoes;
                }

                // Cabeçalho com informações básicas
                recomendacoesHTML = `
                    <div class="card-panel teal lighten-4">
                        <h5>💡 Recomendações Completas</h5>
                       <strong>Duração:</strong> ${duracao} minutos</p>
                    </div>
                `;

                // Recomendações baseadas no código da análise
                switch (codigoAnalise) {
                    case '1.1':
                        recomendacoesHTML += `
                        <div class="card-panel green lighten-4">
                            <h6>✅ Situação Ideal</h6>
                            <ul>
                                <li>• Sinais de sono e soneca iniciando em bons intervalos! Parabéns!</li>
                                <li>• Continue observando os sinais de sono no mesmo horário</li>
                                <li>• Mantenha o ritual de sono consistente</li>
                                <li>• Registre os horários para identificar padrões</li>
                            </ul>
                        </div>
                    `;
                        break;

                    case '1.2':
                        recomendacoesHTML += `
                           <div class="card-panel orange lighten-4">
                <h6>⚠️ Começou a Fazer Dormir Cedo Demais</h6>
                <ul>
                    <li>• Começou a fazer dormir cedo demais, mas dormiu em tempo adequado</li>
                    <li>• Aguarde sinais mais claros de sono antes de iniciar o ritual</li>
                    <li>• Observe os horários sugeridos para sinais de sono</li>
                    <li>• Não antecipe demais o início do ritual</li>
                </ul>

                <div class="video-recomendacao" style="margin-top: 15px;">
                    <h7>🎥 Vídeos Recomendados:</h7>
                    <div class="video-lista">
                        <div style="padding: 10px; margin: 8px 0; background: rgba(255,255,255,0.7); border-radius: 4px; border-left: 3px solid #2196F3;">
                            <strong>Vídeo: Começou a dormir cedo demais</strong>
                            <br>
                            <button onclick="toggleYouTubeVideo(this, 'AJx1c19xag8')" 
                                    style="margin-top: 8px; padding: 6px 12px; background: #2196F3; color: white; border: none; border-radius: 3px; cursor: pointer;">
                                ▶ Mostrar Vídeo
                            </button>
                          <div class="youtube-container" style="display: none; margin-top: 10px;">
                                <iframe width="100%" height="315" 
                                        src="https://www.youtube.com/embed/AJx1c19xag8" 
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
                            </div>
                    `;
                      case '1.3':
                        recomendacoesHTML += `
                        <div class="card-panel orange lighten-4">
                            <h6>⚠️ Demorou para Fazer Dormir</h6>
                            <ul>
                                <li>• Percebeu sinais de sono em tempo adequado, mas demorou muito a fazer dormir</li>
                                <li>• Tente iniciar o ritual mais rapidamente após os primeiros sinais</li>
                                <li>• Prepare o ambiente com antecedência</li>
                                <li>• Tenha tudo pronto antes de perceber os sinais de sono</li>
                                <li>• Reduza estímulos visuais e sonoros quando perceber os primeiros sinais</li>
                            </ul>

                            <div class="video-recomendacao" style="margin-top: 15px; padding: 15px; background: #e3f2fd; border-radius: 8px;">
                                <h7>🎥 Vídeos Recomendados:</h7>
                                <div class="video-lista">
                                    <p>📹 <a href="https://www.youtube.com/watch?v=qBaLf8aDLg4" target="_blank" style="color: #1565c0; text-decoration: underline;">
                                        <i class="material-icons tiny">play_circle_outline</i> Desacelerar
                                    </a></p>
                                    <p>📹 <a href="https://www.youtube.com/shorts/VAOuMO-9OZE" target="_blank" style="color: #1565c0; text-decoration: underline;">
                                        <i class="material-icons tiny">play_circle_outline</i> Briga para dormir
                                    </a></p>
                                    <p>📹 <a href="https://www.youtube.com/watch?v=-FdKVp5mg4w" target="_blank" style="color: #1565c0; text-decoration: underline;">
                                        <i class="material-icons tiny">play_circle_outline</i> Associações que podem ajudar </a></p>
                                </div>
                            </div>
                        </div>
                    `;
                        break;

                    case '1.4':
                        recomendacoesHTML += `
                        <div class="card-panel orange lighten-4">
                            <h6>⚠️ Demorou a Perceber Sinais de Sono</h6>
                            <ul>
                                <li>• Demorou a perceber sinais de sono, mas dormiu rápido, evitando a exaustão</li>
                                <li>• Fique mais atento aos sinais sutis de cansaço</li>
                                <li>• Observe o bebê mais cuidadosamente próximo ao horário esperado</li>
                                <li>• Conheça os sinais comuns de sono listados abaixo</li>
                                <li>• Estabeleça alertas ou lembretes para observar o bebê</li>
                            </ul>

                            <!-- Lista de Sinais de Sono -->
                            <div class="sinais-sono" style="margin-top: 15px; padding: 15px; background: #fff3e0; border-radius: 8px;">
                                <h7>👀 Sinais de Sono Mais Comuns:</h7>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col s6 m4">
                                        <i class="material-icons tiny">emoji_people</i> Bocejar
                                    </div>
                                    <div class="col s6 m4">
                                        <i class="material-icons tiny">remove_red_eye</i> Olhar parado
                                    </div>
                                    <div class="col s6 m4">
                                        <i class="material-icons tiny">touch_app</i> Esfregar olhos
                                    </div>
                                    <div class="col s6 m4">
                                        <i class="material-icons tiny">gesture</i> Arranhar rosto
                                    </div>
                                    <div class="col s6 m4">
                                        <i class="material-icons tiny">repeat</i> Virar o rosto
                                    </div>
                                    <div class="col s6 m4">
                                        <i class="material-icons tiny">child_care</i> Esconder no peito
                                    </div>
                                </div>
                            </div>

                        </div>
                    `;
                        break;

                    case '1.5':
                        recomendacoesHTML += `
                        <div class="card-panel red lighten-4">
                            <h6>❌ Exaustão - Demorou a Perceber e Dormiu Exausto</h6>
                            <ul>
                                <li>• Demorou a perceber sinais de sono e dormiu exausto</li>
                                <li>• É crucial observar melhor os horários de sono</li>
                                <li>• Inicie o ritual mais cedo na próxima vez</li>
                                <li>• Estabeleça uma rotina mais consistente</li>
                                <li>• Use timer ou alarme para lembrar dos horários de sono</li>
                                <li>• Observe atentamente 15-20 minutos antes do horário esperado</li>
                            </ul>

                            <!-- Lista de Sinais de Sono -->
                            <div class="sinais-sono" style="margin-top: 15px; padding: 15px; background: #ffebee; border-radius: 8px;">
                                <h7>🚨 Sinais de Exaustão (evitar):</h7>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col s12">
                                        <i class="material-icons tiny">warning</i> Choro inconsolável
                                    </div>
                                    <div class="col s12">
                                        <i class="material-icons tiny">warning</i> Agitação excessiva
                                    </div>
                                    <div class="col s12">
                                        <i class="material-icons tiny">warning</i> Dificuldade para acalmar
                                    </div>
                                    <div class="col s12">
                                        <i class="material-icons tiny">warning</i> Arquear as costas
                                    </div>
                                </div>
                            </div>

                            <div class="video-recomendacao" style="margin-top: 15px; padding: 15px; background: #e3f2fd; border-radius: 8px;">
                                <h7>🎥 Vídeos Recomendados:</h7>
                                <div class="video-lista">
                                    <p>📹 <a href="https://www.youtube.com/watch?v=qBaLf8aDLg4" target="_blank" style="color: #1565c0; text-decoration: underline;">
                                        <i class="material-icons tiny">play_circle_outline</i> Desacelerar
                                    </a></p>

                                   <p>📹 <a href="https://www.youtube.com/shorts/VAOuMO-9OZE" target="_blank" style="color: #1565c0; text-decoration: underline;">
                                        <i class="material-icons tiny">play_circle_outline</i> Briga para dormir
                                    </a></p>
                                </div>
                            </div>
                        </div>
                    `;
                        break;

                    // ... (adicione os outros casos conforme seu código original)

                    default:
                        recomendacoesHTML += `<p>Análise em andamento para código: ${codigoAnalise}</p>`;
                }

                // Recomendações baseadas na duração
                if (duracao < 35) {
                    recomendacoesHTML += `
                    <div class="card-panel blue lighten-4" style="margin-top: 20px;">
                        <h6>💡 Estratégias para Sonecas Curtas (${duracao} min)</h6>
                        <ul>
                            <li>• Tente prolongar a soneca com conforto adicional (naninha, ruído branco)</li>
                            <li>• Verifique se o ambiente está adequado (escuro, temperatura agradável)</li>
                            <li>• Considere ajustar o horário da próxima soneca</li>
                            <li>• Observe se há desconforto (fralda, calor, frio)</li>
                            <li>• Tente "salvar a soneca" com intervenção suave ao final</li>
                        </ul>
                    </div>
                `;
                } else {
                    recomendacoesHTML += `
                    <div class="card-panel green lighten-4" style="margin-top: 20px;">
                        <h6>✅ Duração Adequada (${duracao} min) - Mantenha o Bom Trabalho!</h6>
                        <ul>
                            <li>• Soneca com boa duração para restauração energética</li>
                            <li>• Mantenha os mesmos horários e rotina que funcionaram</li>
                            <li>• Continue registrando para identificar padrões de sucesso</li>
                            <li>• Observe se este horário e duração se repetem consistentemente</li>
                        </ul>
                    </div>
                `;
                }

                // Recomendações de associações (se disponível)
                if (associacoes && associacoes.comoAdormeceu && associacoes.comoAdormeceu.length > 0) {
                    recomendacoesHTML += gerarRecomendacoesAssociacoes(associacoes);
                }

                return recomendacoesHTML;
            }

            function gerarRecomendacoesAssociacoes(associacoes) {
                let recomendacoesHTML = '';

                recomendacoesHTML += `
                    <div class="card-panel purple lighten-4" style="margin-top: 20px;">
                        <h6>🌙 Sobre as Associações de Sono</h6>
                        <div class="associacoes-info">
                            <p><strong>É importante deixar claro que adormecer com associações NÃO ATRAPALHARÁ o sono do seu bebê e nem causará despertares.</strong> Na verdade, pode até ajudar, já que te ajudará a conseguir que o bebê durma e a evitar que ele fique exausto.</p>
                            <p>Mas precisa estar bom para você também, claro. Por isso, se quiser começar a desassociar, siga essa técnica explicada nas aulas e ao fim do desafio, eu já analisarei esse ajuste também.</p>
                        </div>
                    </div>
                `;

                // Seção sobre se incomoda
                if (associacoes.incomoda) {
                    recomendacoesHTML += `
                        <div class="card-panel ${associacoes.incomoda === 'Sim' ? 'orange' : 'green'} lighten-4" style="margin-top: 15px;">
                            <h6>${associacoes.incomoda === 'Sim' ? '🤔 Essa associação te incomoda' : '✅ Tudo bem com as associações'}</h6>
                            <p>
                                ${associacoes.incomoda === 'Sim' ? 
                                    'Como você mencionou que essa associação te incomoda, recomendamos focar nas aulas específicas sobre desassociação. Lembre-se: o importante é encontrar um equilíbrio que funcione para você e seu bebê.' : 
                                    'Que bom que as associações atuais estão funcionando bem para você! Continue observando e faça ajustes apenas se sentir necessidade.'}
                            </p>
                        </div>
                    `;
                }

                return recomendacoesHTML;
            }
            function gerarRecomendacoesAssociacoes(associacoes) {
                    let recomendacoesHTML = '';

                    recomendacoesHTML += `
                <div class="card-panel purple lighten-4" style="margin-top: 20px;">
                    <h6>🌙 Sobre as Associações de Sono</h6>
                    <div class="associacoes-info">
                        <p><strong>É importante deixar claro que adormecer com associações NÃO ATRAPALHARÁ o sono do seu bebê e nem causará despertares.</strong> Na verdade, pode até ajudar, já que te ajudará a conseguir que o bebê durma e a evitar que ele fique exausto.</p>
                        <p>Mas precisa estar bom para você também, claro. Por isso, se quiser começar a desassociar, siga essa técnica explicada nas aulas e ao fim do desafio, eu já analisarei esse ajuste também.</p>
                    </div>
                </div>
            `;

                    // Aulas recomendadas baseadas nas associações
                    const aulasRecomendadas = [];

                    // Verificar associações relacionadas a mamar
                    if (associacoes.comoAdormeceu.some(a => a.includes('Mamando')) ||
                        (associacoes.depoisAdormecer && associacoes.depoisAdormecer.some(d => d.includes('Sucção não nutritiva')))) {
                        aulasRecomendadas.push({
                            titulo: "Associação de mamar nas sonecas",
                            descricao: "",
                            video: "videos/associacao_mamar_soneca.mp4"
                        });
                    }

                    // Verificar associações relacionadas a colo/movimento
                    if (associacoes.comoAdormeceu.some(a => a.includes('Ninando') || a.includes('Carrinho') || a.includes('Rede')) ||
                        (associacoes.depoisAdormecer && associacoes.depoisAdormecer.some(d => d.includes('colo') || d.includes('Carrinho') || d.includes('Rede')))) {
                        aulasRecomendadas.push({
                            titulo: "Associação de colo nas sonecas (Protocolo Bebê no berço)",
                            descricao: "",
                            video: "videos/assciacao_colo.mp4"
                        });
                    }

                    // Verificar associações com chupeta
                    if (associacoes.comoAdormeceu.some(a => a.includes('Chupeta'))) {
                        aulasRecomendadas.push({
                            titulo: "Associação de Chupeta",
                            descricao: "",
                            video: "videos/assciacao_colo.mp4"
                        });
                    }

                    // Aulas gerais para todos
                    aulasRecomendadas.push({
                        titulo: "A autonomia do sono",
                        descricao: "",
                        video: "videos/autonomia_sono.mp4"
                    });

                    aulasRecomendadas.push({
                        titulo: "Autonomia nas sonecas",
                        descricao: "",
                        video: "videos/autonomia_sonecas.mp4"
                    });

                    if (aulasRecomendadas.length > 0) {
                        recomendacoesHTML += `
                    <div class="card-panel blue lighten-4" style="margin-top: 15px;">
                        <h6>🎥 Aulas Recomendadas</h6>
                        <p>Baseado nas suas associações registradas, recomendamos estas aulas:</p>
                        <div class="aulas-lista" style="margin-top: 10px;">
                `;

                        aulasRecomendadas.forEach((aula, index) => {
                            recomendacoesHTML += `
                        <div class="aula-item" style="padding: 10px; margin: 8px 0; background: rgba(255,255,255,0.7); border-radius: 4px; border-left: 3px solid #2196F3;">
                            <strong>${index + 1}. ${aula.titulo}</strong>
                            <br><small class="grey-text">${aula.descricao}</small>
                            <br>
                            <button onclick="toggleVideoAula(this, '${aula.video}')" 
                                    style="margin-top: 8px; padding: 6px 12px; background: #2196F3; color: white; border: none; border-radius: 3px; cursor: pointer;">
                                ▶ Mostrar Vídeo
                            </button>
                            <div class="video-container" style="display: none; margin-top: 10px;">
                                <video width="100%" controls>
                                    <source src="{{ asset('storage') }}/${aula.video}" type="video/mp4">
                                    Seu navegador não suporta vídeos.
                                </video>
                            </div>
                        </div>
                    `;
                        });

                        recomendacoesHTML += `
                        </div>
                        <div style="margin-top: 15px; padding: 10px; background: #e3f2fd; border-radius: 4px;">
                            <p><strong>💡 Dica:</strong> Assista as aulas na ordem recomendada para melhor aproveitamento!</p>
                        </div>
                    </div>
                `;
                    }

                    // Seção sobre se incomoda
                    if (associacoes.incomoda) {
                        recomendacoesHTML += `
                    <div class="card-panel ${associacoes.incomoda === 'Sim' ? 'orange' : 'green'} lighten-4" style="margin-top: 15px;">
                        <h6>${associacoes.incomoda === 'Sim' ? '🤔 Essa associação te incomoda' : '✅ Tudo bem com as associações'}</h6>
                        <p>
                            ${associacoes.incomoda === 'Sim' ?
                                'Como você mencionou que essa associação te incomoda, recomendamos focar nas aulas específicas sobre desassociação. Lembre-se: o importante é encontrar um equilíbrio que funcione para você e seu bebê.' :
                                'Que bom que as associações atuais estão funcionando bem para você! Continue observando e faça ajustes apenas se sentir necessidade.'}
                        </p>
                    </div>
                `;
                    }

                    // Materiais de apoio gerais (comentado conforme seu código)
                    /*
                    recomendacoesHTML += `
                        <div class="card-panel purple lighten-4" style="margin-top: 20px;">
                            <h6>📚 Materiais de Apoio Gerais</h6>
                            <div class="video-lista">
                                <p>📹 <a href="https://youtu.be/qBaLf8aDLg4" target="_blank" style="color: #1565c0; text-decoration: underline;">
                                    <i class="material-icons tiny">play_circle_outline</i> Guia Completo de Sinais de Sono
                                </a></p>
                                <p>📹 <a href="https://youtu.be/-FdKVp5mg4w" target="_blank" style="color: #1565c0; text-decoration: underline;">
                                    <i class="material-icons tiny">play_circle_outline</i> Associações de Sono Saudáveis
                                </a></p>
                                <p>📹 <a href="https://youtube.com/shorts/VAOuMO-9OZE?feature=share" target="_blank" style="color: #1565c0; text-decoration: underline;">
                                    <i class="material-icons tiny">play_circle_outline</i> Dicas Rápidas para Rotina de Sono
                                </a></p>
                            </div>
                        </div>
                    `;
                    */

                    return recomendacoesHTML;
                }

                // Função para mostrar/ocultar vídeos das aulas
                function toggleVideoAula(button, videoPath) {
                    const videoContainer = button.nextElementSibling;
                    const isHidden = videoContainer.style.display === 'none';

                    if (isHidden) {
                        videoContainer.style.display = 'block';
                        button.innerHTML = '▼ Ocultar Vídeo';
                        button.style.background = '#ff5722';

                        // Auto-play do vídeo quando aberto
                        const video = videoContainer.querySelector('video');
                        if (video) {
                            video.play().catch(e => console.log('Auto-play prevented:', e));
                        }
                    } else {
                        videoContainer.style.display = 'none';
                        button.innerHTML = '▶ Mostrar Vídeo';
                        button.style.background = '#2196F3';

                        // Pausa o vídeo quando fechado
                        const video = videoContainer.querySelector('video');
                        if (video) {
                            video.pause();
                        }
                    }
                }

                function toggleVideoAula(button, videoPath) {
            const videoContainer = button.nextElementSibling;
            const isHidden = videoContainer.style.display === 'none';

            if (isHidden) {
                videoContainer.style.display = 'block';
                button.innerHTML = '▼ Ocultar Vídeo';
                button.style.background = '#ff5722';

                // Auto-play do vídeo quando aberto
                const video = videoContainer.querySelector('video');
                if (video) {
                    video.play().catch(e => console.log('Auto-play prevented:', e));
                }
            } else {
                videoContainer.style.display = 'none';
                button.innerHTML = '▶ Mostrar Vídeo';
                button.style.background = '#2196F3';

                // Pausa o vídeo quando fechado
                const video = videoContainer.querySelector('video');
                if (video) {
                    video.pause();
                }
            }
        }

        function toggleYouTubeVideo(button, videoId, isShort = false) {
                const container = button.nextElementSibling;
                const isHidden = container.style.display === 'none';

                if (isHidden) {
                    // Se o container já tem um iframe, apenas mostra
                    if (!container.querySelector('iframe')) {
                        const embedUrl = isShort
                            ? `https://www.youtube.com/embed/${videoId}`
                            : `https://www.youtube.com/embed/${videoId}`;

                        container.innerHTML = `
                    <iframe width="100%" height="${isShort ? '315' : '315'}" 
                            src="${embedUrl}" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                `;
                    }
                    container.style.display = 'block';
                    button.innerHTML = '▼ Ocultar Vídeo';
                    button.style.background = '#ff5722';
                } else {
                    container.style.display = 'none';
                    button.innerHTML = '▶ Mostrar Vídeo';
                    button.style.background = '#2196F3';
                }
            }
            </script>
@endsection