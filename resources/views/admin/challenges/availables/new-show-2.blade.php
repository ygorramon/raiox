@extends('adminlte::page')

@section('title', 'Desafios disponiveis')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('challenge.availables') }}" class="active">Desafios
            Diponíveis</a></li>
</ol>

@stop

@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Dados Pessoais</h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-4 ">
                    <label for="nomeMae">Nome da Mãe/Pai:</label>
                    <div>
                        <input type="text" readonly class="form-control" id="nomeMae"
                            value="{{$challenge->client->name}}" placeholder="nomeMae">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="nomeBebe">Nome do(a) Bebê:</label>
                    <div>
                        <input type="text" readonly class="form-control" id="nomeBebe"
                            value="{{$challenge->client->nameBaby}}" placeholder="nomeMae">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="nomeBebe">Email:</label>
                    <div>
                        <input type="text" readonly class="form-control" id="nomeBebe"
                            value="{{$challenge->client->email}}" placeholder="nomeMae">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 ">
                    <label for="nascimentoBebe">Data de Nascimento do Bebê:</label>
                    <div>
                        <input type="text" readonly class="form-control" id="nascimentoBebe"
                            value="{{\Carbon\Carbon::parse($challenge->client->birthBaby)->format('d/m/Y')}}"
                            placeholder="nomeMae">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="idadeBebe">Idade do Bebê: (DIAS / MESES)</label>
                    <div>
                        <input type="text" readonly class="form-control" id="idadeBebe"
                            value="{{now()->diffInDays(\Carbon\Carbon::parse($challenge->client->birthBaby))}} / {{now()->diffInMonths(\Carbon\Carbon::parse($challenge->client->birthBaby))}}"
                            placeholder="nomeMae">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="sexoBebe">Sexo do Bebê:</label>
                    <div>
                        <input type="text" readonly class="form-control" id="sexoBebe"
                            value="{{$challenge->client->sexBaby == 'M' ? "MASCULINO" : "FEMININO"}}"
                            placeholder="nomeMae">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Informações Anteriores</h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12 ">
                    <label for="nomeMae">Informações:</label>
                    @if(count($challenge->client->challenges->where('status', 'FINALIZADO')) > 1)
                        @foreach($challenge->client->challenges->where('status', 'FINALIZADO') as $challenge2)
                            @if($challenge2->chat != null)
                                <textarea class="form-control"
                                    style="height:auto"> {{ $challenge2->anotacoes }} {{ $challenge2->chat->messages->first()->content ?? '' }}</textarea>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            @foreach($challenge->rotinas as $rotina)
                                                                                @php
                $sonecas = json_decode($rotina->historicoSonecas, true);
                $ritual = json_decode($rotina->ritualNoturno, true);
                $despertares = json_decode($rotina->historicoDespertares, true);
                $resumo = json_decode($rotina->resumo, true);
                                                                                @endphp

                                                                                <div class="col-md-12">
                                                                                    <div class="card card-info">
                                                                                        <div class="card-header">
                                                                                            <h3 class="card-title">DIA {{$rotina->day}} -
                                                                                                {{\Carbon\Carbon::parse($rotina->data)->format('d/m/Y')}}</h3>
                                                                                        </div>

                                                                                        <div class="card-body">
                                                                                            <h5>Início do Dia:
                                                                                                <span
                                                                                                    class="badge bg-{{ $rotina->inicioDia >= '06:00:00' && $rotina->inicioDia <= '08:00:00' ? 'green' : 'red' }}">
                                                                                                    {{$rotina->inicioDia}}
                                                                                                </span>
                                                                                            </h5>

                                                                                            <h5>Idade do Bebê: <span class="badge bg-blue">{{$rotina->idadeBebe}} meses</span></h5>
                                                                                            <h5>Tempo Acordado Esperado: <span class="badge bg-blue">{{$rotina->tempoAcordadoEsperado}}
                                                                                                    min</span></h5>


                                                                                           <!-- Histórico de Sonecas -->
                                                    @if($sonecas)
                                                        <div class="card card-info mb-3">
                                                            <div class="card-header">
                                                                <h5 class="card-title">📊 Informações da Janela de Sono</h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row text-center">
                                                                    <div class="col-md-3">
                                                                        <h6>Idade do Bebê</h6>
                                                                        <span class="badge bg-green" style="font-size: 14px;">
                                                                            {{ now()->diffInDays(\Carbon\Carbon::parse($challenge->client->birthBaby)) }} DIAS
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <h6>Janela Mínima</h6>
                                                                        <span class="badge bg-green" style="font-size: 14px;">
                                                                            {{ getJanela(now()->diffInDays(\Carbon\Carbon::parse($challenge->client->birthBaby)))->janelaIdealInicio }}min
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <h6>Janela Máxima</h6>
                                                                        <span class="badge bg-green" style="font-size: 14px;">
                                                                            {{ getJanela(now()->diffInDays(\Carbon\Carbon::parse($challenge->client->birthBaby)))->janelaIdealFim }}min
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <h6>Máx. Sinal de Sono</h6>
                                                                        <span class="badge bg-green" style="font-size: 14px;">
                                                                            {{ getJanela(now()->diffInDays(\Carbon\Carbon::parse($challenge->client->birthBaby)))->janelaIdealFim - 30 }}min
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <h4>💤 Sonecas</h4>
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Sinal de Sono</th>
                                                                    <th>Início</th>
                                                                    <th>Término</th>
                                                                    <th>Duração</th>
                                                                    <th>Janela</th>
                                                                    <th>Status Janela</th>
                                                                    <th>Situação</th>
                                                                    <th>Associações</th>
                                                                    <th>Questionário</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($sonecas as $soneca)
                                                                                                                                                                            @php
                                                                                $idadeBebe = now()->diffInDays(\Carbon\Carbon::parse($challenge->client->birthBaby));
                                                                                $janelaIdeal = getJanela($idadeBebe);
                                                                                $janelaMin = $janelaIdeal->janelaIdealInicio;
                                                                                $janelaMax = $janelaIdeal->janelaIdealFim;
                                                                                $statusJanela = 'ideal';

                                                                                if ($soneca['janelaSono'] < $janelaMin) {
                                                                                    $statusJanela = 'curta';
                                                                                } elseif ($soneca['janelaSono'] > $janelaMax) {
                                                                                    $statusJanela = 'longa';
                                                                                }
                                                                                                                                                                            @endphp

                                                                                                                                                                            <tr>
                                                                                                                                                                                <td>Soneca {{ $soneca['numero'] }}</td>
                                                                                                                                                                                <td>{{ $soneca['sentiuSono'] ?? 'N/A' }}</td>
                                                                                                                                                                                <td>{{ $soneca['inicio'] }}</td>
                                                                                                                                                                                <td>{{ $soneca['termino'] }}</td>
                                                                                                                                                                                <td>
                                                                                                                                                                                    @if($soneca['duracao'] < 35)
                                                                                                                                                                                        <span class="badge bg-red">{{ $soneca['duracao'] }}min</span>
                                                                                                                                                                                    @elseif($soneca['duracao'] >= 35 && $soneca['duracao'] <= 40)
                                                                                                                                                                                        <span class="badge bg-yellow">{{ $soneca['duracao'] }}min</span>
                                                                                                                                                                                    @else
                                                                                                                                                                                        <span class="badge bg-green">{{ $soneca['duracao'] }}min</span>
                                                                                                                                                                                    @endif
                                                                                                                                                                                </td>
                                                                                                                                                                                <td>
                                                                                                                                                                                    {{ $soneca['janelaSono'] }}min
                                                                                                                                                                                </td>
                                                                                                                                                                                <td>
                                                                                                                                                                                    @if($statusJanela == 'ideal')
                                                                                                                                                                                        <span class="badge bg-green">✅ Ideal</span>
                                                                                                                                                                                    @elseif($statusJanela == 'curta')
                                                                                                                                                                                        <span class="badge bg-yellow">⚠️ Curta</span>
                                                                                                                                                                                    @else
                                                                                                                                                                                        <span class="badge bg-red">❌ Longa</span>
                                                                                                                                                                                    @endif
                                                                                                                                                                                    <br>
                                                                                                                                                                                    <small class="text-muted">
                                                                                                                                                                                        ({{ $janelaMin }} - {{ $janelaMax }}min)
                                                                                                                                                                                    </small>
                                                                                                                                                                                </td>
                                                                                                                                                                                <td>
                                                                                                                                                                                    <span class="badge bg-{{ $soneca['situacao'] == '1.1' ? 'green' : 'orange' }}">
                                                                                                                                                                                        {{ $soneca['situacao'] }}
                                                                                                                                                                                    </span>
                                                                                                                                                                                </td>
                                                                                                                                                                                <td style="max-width: 150px; min-width: 120px;">
                                                                        @if(isset($soneca['associacoes']['comoAdormeceu']))
                                                                            @php
                                                                                $associacoesParaMostrar = [];
                                                                                $totalAssociacoes = count($soneca['associacoes']['comoAdormeceu']);
                                                                                $temOutrosLongo = false;
                                                                                $textoOutros = '';

                                                                                // Filtra as associações
                                                                                foreach ($soneca['associacoes']['comoAdormeceu'] as $associacao) {
                                                                                    if (strpos($associacao, 'Outro:') !== false || strpos($associacao, 'Outros:') !== false) {
                                                                                        $temOutrosLongo = true;
                                                                                        $textoOutros = $associacao;
                                                                                    } else {
                                                                                        $associacoesParaMostrar[] = $associacao;
                                                                                    }
                                                                                }

                                                                                // Limita para mostrar no máximo 2 associações normais
                                                                                $associacoesParaMostrar = array_slice($associacoesParaMostrar, 0, 2);
                                                                                $totalParaMostrar = count($associacoesParaMostrar);
                                                                                $mostrarBotao = $totalAssociacoes > $totalParaMostrar || $temOutrosLongo;
                                                                            @endphp

                                                                            <!-- Mostra associações normais -->
                                                                            @foreach($associacoesParaMostrar as $associacao)
                                                                                <span class="badge bg-info mb-1 d-inline-block text-truncate" style="max-width: 120px; font-size: 11px;">
                                                                                    {{ $associacao }}
                                                                                </span>
                                                                                <br>
                                                                            @endforeach

                                                                            <!-- Botão para modal se tiver "Outros" ou muitas associações -->
                                                                            @if($mostrarBotao)
                                                                                <button type="button" class="btn btn-sm btn-outline-info mt-1" data-toggle="modal" data-target="#modalAssociacoes{{ $soneca['numero'] }}">
                                                                                    @if($temOutrosLongo)
                                                                                        📝 Ver detalhes
                                                                                    @else
                                                                                        +{{ $totalAssociacoes - $totalParaMostrar }} mais
                                                                                    @endif
                                                                                </button>
                                                                            @endif

                                                                            <!-- Modal para associações -->
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
                                                                                            <!-- Como adormeceu -->
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
                                                                                                                            // Remove "Outro:" ou "Outros:" do texto
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

                                                                                            <!-- Depois de adormecer -->
                                                                                            @if(isset($soneca['associacoes']['depoisAdormecer']) && count($soneca['associacoes']['depoisAdormecer']) > 0)
                                                                                                <div class="mb-3">
                                                                                                    <h6>📍 Após adormecer:</h6>
                                                                                                    <div class="d-flex flex-wrap gap-2">
                                                                                                        @foreach($soneca['associacoes']['depoisAdormecer'] as $local)
                                                                                                            @if(strpos($local, 'Outro:') !== false || strpos($local, 'Outros:') !== false)
                                                                                                                <div class="w-100 mb-2 p-2 bg-light rounded">
                                                                                                                    <strong>Outros:</strong> 
                                                                                                                    @php
                                                                                                                        $textoLimpo = str_replace(['Outro:', 'Outros:'], '', $local);
                                                                                                                        echo trim($textoLimpo);
                                                                                                                    @endphp
                                                                                                                </div>
                                                                                                            @else
                                                                                                                <span class="badge bg-success">{{ $local }}</span>
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif

                                                                                            <!-- Se incomoda -->
                                                                                            @if(isset($soneca['associacoes']['incomoda']))
                                                                                                <div class="alert alert-{{ $soneca['associacoes']['incomoda'] == 'Sim' ? 'warning' : 'success' }}">
                                                                                                    <strong>💭 Essa associação incomoda?</strong> 
                                                                                                    {{ $soneca['associacoes']['incomoda'] }}
                                                                                                </div>
                                                                                            @endif
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <span class="text-muted">-</span>
                                                                        @endif
                                                                    </td>
                                                                                                                                                                                <td>
                                                                                                                                                                                    @if(isset($soneca['respostas']) && count($soneca['respostas']) > 0)
                                                                                                                                                                                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#questionarioSoneca{{ $soneca['numero'] }}">
                                                                                                                                                                                            Ver Respostas
                                                                                                                                                                                        </button>
                                                                                                                                                                                    @else
                                                                                                                                                                                        <span class="text-muted">Nenhuma</span>
                                                                                                                                                                                    @endif
                                                                                                                                                                                </td>
                                                                                                                                                                            </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        @foreach($sonecas as $soneca)
                                                            @if(isset($soneca['respostas']) && count($soneca['respostas']) > 0)
                                                                <div class="modal fade" id="questionarioSoneca{{ $soneca['numero'] }}" tabindex="-1" role="dialog">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Questionário - Soneca {{ $soneca['numero'] }}</h5>
                                                                                <button type="button" class="close" data-dismiss="modal">
                                                                                    <span>&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    @foreach($soneca['respostas'] as $pergunta => $resposta)
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <div class="card">
                                                                                                <div class="card-body">
                                                                                                    <h6 class="card-title text-primary">{{ $pergunta }}</h6>
                                                                                                    <p class="card-text">
                                                                                                        <strong>Resposta:</strong>
                                                                                                        <span
                                                                                                            class="badge bg-{{ $resposta['resposta'] == 'Sim' ? 'success' : ($resposta['resposta'] == 'Não' ? 'danger' : 'info') }}">
                                                                                                            {{ $resposta['resposta'] }}
                                                                                                        </span>
                                                                                                    </p>
                                                                                                    @if(isset($resposta['detalhes']) && $resposta['detalhes'])
                                                                                                        <p class="card-text">
                                                                                                            <strong>Detalhes:</strong> {{ $resposta['detalhes'] }}
                                                                                                        </p>
                                                                                                    @endif
                                                                                                    @if(isset($resposta['timestamp']))
                                                                                                        <small class="text-muted">
                                                                                                            Registrado: {{ \Carbon\Carbon::parse($resposta['timestamp'])->format('H:i') }}
                                                                                                        </small>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>

                                                                                <!-- Associações da Soneca -->
                                                                                @if(isset($soneca['associacoes']))
                                                                                    <div class="mt-4">
                                                                                        <h6>Associações de Sono</h6>
                                                                                        <div class="row">
                                                                                            <div class="col-md-6">
                                                                                                <strong>Como adormeceu:</strong>
                                                                                                <ul>
                                                                                                    @foreach($soneca['associacoes']['comoAdormeceu'] as $associacao)
                                                                                                        <li>{{ $associacao }}</li>
                                                                                                    @endforeach
                                                                                                </ul>
                                                                                            </div>
                                                                                            @if(isset($soneca['associacoes']['depoisAdormecer']))
                                                                                                <div class="col-md-6">
                                                                                                    <strong>Após adormecer:</strong>
                                                                                                    <ul>
                                                                                                        @foreach($soneca['associacoes']['depoisAdormecer'] as $local)
                                                                                                            <li>{{ $local }}</li>
                                                                                                        @endforeach
                                                                                                    </ul>
                                                                                                </div>
                                                                                            @endif
                                                                                        </div>
                                                                                        @if(isset($soneca['associacoes']['incomoda']))
                                                                                            <div class="alert alert-{{ $soneca['associacoes']['incomoda'] == 'Sim' ? 'warning' : 'success' }}">
                                                                                                <strong>Essa associação incomoda?</strong> {{ $soneca['associacoes']['incomoda'] }}
                                                                                            </div>
                                                                                        @endif
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                                                            <!-- Ritual Noturno -->
                                                                                            <!-- Ritual Noturno -->
                                                    @if($ritual)
                                                    <h4>🌙 Ritual Noturno</h4>
                                                    <div class="alert alert-warning mb-3">
                                                        <strong>Referência para Ritual Noturno:</strong>
                                                        Janela ideal: {{ getJanela(now()->diffInDays(\Carbon\Carbon::parse($challenge->client->birthBaby)))->janelaIdealInicio }} - {{ getJanela(now()->diffInDays(\Carbon\Carbon::parse($challenge->client->birthBaby)))->janelaIdealFim }}min
                                                    </div>

                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td><strong>Início do Ritual</strong></td>
                                                                <td>{{ $ritual['inicioRitual'] }}</td>
                                                                <td><strong>Sono Noturno</strong></td>
                                                                <td>{{ $ritual['sonoNoturno'] }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Duração do Ritual</strong></td>
                                                                <td>
                                                                    @if($ritual['duracaoRitual'] > 30)
                                                                        <span class="badge bg-red">{{ $ritual['duracaoRitual'] }}min</span>
                                                                    @else
                                                                        <span class="badge bg-green">{{ $ritual['duracaoRitual'] }}min</span>
                                                                    @endif
                                                                </td>
                                                                <td><strong>Local do Sono</strong></td>
                                                                <td>{{ ucfirst(str_replace('-', ' ', $ritual['localSono'])) }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    @endif

                                                                                            <!-- Histórico de Despertares -->
                                                                                            @if($despertares)
                                                                                                <h4>⏰ Despertares Noturnos</h4>
                                                                                                <table class="table table-bordered">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th>#</th>
                                                                                                            <th>Acordou</th>
                                                                                                            <th>Dormiu</th>
                                                                                                            <th>Duração</th>
                                                                                                            <th>Formas de Voltar a Dormir</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                        @foreach($despertares as $despertar)
                                                                                                            <tr>
                                                                                                                <td>Despertar {{ $despertar['numero'] }}</td>
                                                                                                                <td>{{ $despertar['horaAcordou'] }}</td>
                                                                                                                <td>{{ $despertar['horaDormiu'] }}</td>
                                                                                                                <td>
                                                                                                                    @if($despertar['duracao'] > 30)
                                                                                                                        <span class="badge bg-red">{{ $despertar['duracao'] }}min</span>
                                                                                                                    @else
                                                                                                                        <span class="badge bg-green">{{ $despertar['duracao'] }}min</span>
                                                                                                                    @endif
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    @foreach($despertar['formasVolta'] as $forma)
                                                                                                                        <span class="badge bg-secondary">{{ $forma }}</span>
                                                                                                                    @endforeach
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        @endforeach
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            @endif

                                                                                            <!-- Resumo do Dia -->
                                                                                            @if($resumo)
                                                                                                <h4>📈 Resumo do Dia</h4>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-4 text-center">
                                                                                                        <div class="card bg-primary text-white">
                                                                                                            <div class="card-body">
                                                                                                                <h3>{{ $resumo['totalSonecas'] }}</h3>
                                                                                                                <p>Total de Sonecas</p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-4 text-center">
                                                                                                        <div class="card bg-info text-white">
                                                                                                            <div class="card-body">
                                                                                                                <h3>{{ $resumo['totalDespertares'] }}</h3>
                                                                                                                <p>Total de Despertares</p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-4 text-center">
                                                                                                        <div class="card bg-success text-white">
                                                                                                            <div class="card-body">
                                                                                                                <h3>{{ $resumo['tempoTotalSonecas'] }}min</h3>
                                                                                                                <p>Tempo Total de Sonecas</p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="mt-3 text-center">
                                                                                                    <h4 class="badge bg-{{ $resumo['avaliacao'] == 'Boa noite' ? 'success' : 'warning' }} p-2">
                                                                                                        Avaliação: {{ $resumo['avaliacao'] }}
                                                                                                    </h4>
                                                                                                </div>
                                                                                            @endif

                                                                                            <!-- Observações -->
                                                                                            @if($rotina->observacoes)
                                                                                                <div class="mt-3">
                                                                                                    <h5>📝 Observações:</h5>
                                                                                                    <textarea class="form-control" readonly
                                                                                                        style="height:auto">{{ $rotina->observacoes }}</textarea>
                                                                                                </div>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Formulário</h3>
    </div>
    <div class="card-body">
<h5>PASSO 2 - FOME:</h5>
<label>Peso Adequado:</label> <span class="badge  {{setStatus($challenge->formulario->fome_peso_adequado)->color}}">{{setStatus($challenge->formulario->fome_peso_adequado)->value}}</span> <br>
<label>Ganho de Peso Adequado:</label> <span class="badge  {{setStatus($challenge->formulario->fome_peso_adequado)->color}}">{{setStatus($challenge->formulario->fome_peso_adequado)->value}}</span> <br>
<label>Urina:</label> <span class="badge  {{setStatus($challenge->formulario->fome_urina)->color}}">{{setStatus($challenge->formulario->fome_urina)->value}}</span> <br>
<label>Evacuações:</label> <span class="badge  {{setStatus($challenge->formulario->fome_evacuacoes)->color}}">{{setStatus($challenge->formulario->fome_evacuacoes)->value}}</span> <br>


<label> Ajustes Fome: </label>
<textarea class="form-control" style="height:auto">{{$challenge->formulario->ajustes_fome}}</textarea>

<h5>PASSO 2 -  DOR:</h5>

<label> Ajustes Dor - Geral: </label>
<textarea class="form-control" style="height:auto">{{$challenge->formulario->ajustes_dor}}</textarea>
<label> Ajustes Dor -Cólicas: </label>

<textarea class="form-control" style="height:auto">{{$challenge->formulario->ajustes_dor_colica}}</textarea>

<label> Ajustes Dor - Refluxo: </label>

<textarea class="form-control" style="height:auto">{{$challenge->formulario->ajustes_dor_refluxo}}</textarea>

<label> Ajustes Dor - Dentes: </label>

<textarea class="form-control textarea" style="height:auto">{{$challenge->formulario->ajustes_dor_dentes}}</textarea>

<h5>PASSO 2 - Salto de Desenvolvimento:</h5>

<label>Salto ?:</label> <span class="badge  {{setStatus($challenge->formulario->salto)->color}}">{{setStatus($challenge->formulario->salto)->value}}</span> <br>
<label>Marcos:</label> <span class="badge  {{setStatus($challenge->formulario->salto_marcos)->color}}">{{setStatus($challenge->formulario->salto_marcos)->value}}</span> <br>
<label> Ajustes Salto: </label>
<textarea class="form-control textarea" style="height:auto">{{$challenge->formulario->ajustes_salto}}</textarea>  
<h5>PASSO 2 - Angustia da Separação:</h5>

<label>Angustia ?:</label> <span class="badge  {{setStatus($challenge->formulario->angustia)->color}}">{{setStatus($challenge->formulario->angustia)->value}}</span> <br>
<label>Chora quando sai do campo de visão:</label> <span class="badge  {{setStatus($challenge->formulario->angustia_campo_visao)->color}}">{{setStatus($challenge->formulario->angustia_campo_visao)->value}}</span> <br>
<label>Chora quando pai atende:</label> <span class="badge  {{setStatus($challenge->formulario->angustia_pai_atende)->color}}">{{setStatus($challenge->formulario->angustia_pai_atende)->value}}</span> <br>
 <label> Ajustes Angustia: </label>
<textarea class="form-control textarea" style="height:auto">{{$challenge->formulario->ajustes_angustia}}</textarea>    
<h5>PASSO 2 - Telas:</h5>

<label>Telas ?:</label> <span class="badge  {{setStatus($challenge->formulario->telas)->color}}">{{setStatus($challenge->formulario->telas)->value}}</span> <br>

<label> Ajustes Telas: </label>
<textarea class="form-control textarea" style="height:auto">{{$challenge->formulario->ajustes_telas}}</textarea>
<h5>PASSO 3 :</h5>

<label>Ritual do Bom Dia ?:</label> <span class="badge  {{setStatus($challenge->formulario->ritual_bom_dia)->color}}">{{setStatus($challenge->formulario->ritual_bom_dia)->value}}</span> <br>

<label> Ajustes Ritual do Bom dia: </label>
<textarea class="form-control textarea" style="height:auto">{{$challenge->formulario->ajustes_ritual_bom_dia}}</textarea>
<label> Ajustes Despertar: </label>
<textarea class="form-control" style="height:auto">{{$challenge->formulario->ajustes_despertar}}</textarea>
<label> Ajustes Duração de Sonecas: </label>
<textarea class="form-control" style="height:auto">{{$challenge->formulario->ajuste_duracao_sonecas}}</textarea>
<label> Ajustes Rotina de Sonecas: </label>
<textarea class="form-control" style="height:auto">{{$challenge->formulario->ajuste_rotina_sonecas}}</textarea>
<label> Ajustes Ritual do Sono: </label>
<textarea class="form-control" style="height:auto">{{$challenge->formulario->ritual_sono_ajuste}}</textarea>
<label>Ambiente - Luminosidade: </label><span >{{$challenge->formulario->ambiente_luz}}</span> <br>
<label>Ambiente - Sons: </label><span >{{$challenge->formulario->ambiente_barulho}}</span> <br>
<label>Ambiente - Temperatura: </label><span >{{$challenge->formulario->ambiente_temperatura}}</span> <br>
<label>Choro no Ritual: </label><span class="badge  {{setStatus($challenge->formulario->ritual_choro)->color}}">{{setStatus($challenge->formulario->ritual_choro)->value}}</span> <br>
<label>Desacelera: </label><span class="badge  {{setStatus($challenge->formulario->desacelera)->color}}">{{setStatus($challenge->formulario->desacelera)->value}}</span> <br>

<h5>PASSO 4 - Associações -  Soneca: </h5>
Colo
<span class="badge  {{setStatus($challenge->formulario->associacao_soneca_colo)->color}}">{{setStatus($challenge->formulario->associacao_soneca_colo)->value}}</span>
   
Mamar
<span class="badge  {{setStatus($challenge->formulario->associacao_soneca_mamar)->color}}">{{setStatus($challenge->formulario->associacao_soneca_mamar)->value}}</span>
   
Cama Compartilhada
<span class="badge  {{setStatus($challenge->formulario->associacao_soneca_cc)->color}}">{{setStatus($challenge->formulario->associacao_soneca_cc)->value}}</span>
 
Rede
    <span class="badge  {{setStatus($challenge->formulario->associacao_soneca_rede)->color}}">{{setStatus($challenge->formulario->associacao_soneca_rede)->value}}</span>
   
    Chupar Dedo
    <span class="badge  {{setStatus($challenge->formulario->associacao_soneca_chupar_dedo)->color}}">{{setStatus($challenge->formulario->associacao_soneca_chupar_dedo)->value}}</span>
   
    Naninha
    <span class="badge  {{setStatus($challenge->formulario->associacao_soneca_naninha)->color}}">{{setStatus($challenge->formulario->associacao_soneca_naninha)->value}}</span>
   
    Ruído Branco
    <span class="badge  {{setStatus($challenge->formulario->associacao_soneca_ruido)->color}}">{{setStatus($challenge->formulario->associacao_soneca_ruido)->value}}</span>
<br><br>

<h5>PASSO 4 - Associações -  Sono Noturno: </h5>
Colo
<span class="badge  {{setStatus($challenge->formulario->associacao_sono_colo)->color}}">{{setStatus($challenge->formulario->associacao_sono_colo)->value}}</span>
   
Mamar
<span class="badge  {{setStatus($challenge->formulario->associacao_sono_mamar)->color}}">{{setStatus($challenge->formulario->associacao_sono_mamar)->value}}</span>
   
Cama Compartilhada
<span class="badge  {{setStatus($challenge->formulario->associacao_sono_cc)->color}}">{{setStatus($challenge->formulario->associacao_sono_cc)->value}}</span>
 
Rede
    <span class="badge  {{setStatus($challenge->formulario->associacao_sono_rede)->color}}">{{setStatus($challenge->formulario->associacao_sono_rede)->value}}</span>
   
    Chupar Do
    <span class="badge  {{setStatus($challenge->formulario->associacao_sono_chupar_dedo)->color}}">{{setStatus($challenge->formulario->associacao_sono_chupar_dedo)->value}}</span>
   
    Naninha
    <span class="badge  {{setStatus($challenge->formulario->associacao_sono_naninha)->color}}">{{setStatus($challenge->formulario->associacao_sono_naninha)->value}}</span>
   
    Ruído Branco
    <span class="badge  {{setStatus($challenge->formulario->associacao_sono_ruido)->color}}">{{setStatus($challenge->formulario->associacao_sono_ruido)->value}}</span>

<br><br>
<label>Associações Incomodam ?:</label> <span class="badge  {{setStatus($challenge->formulario->associacao_incomoda)->color}}">{{setStatus($challenge->formulario->associacao_incomoda)->value}}</span> <br>

<label> Comentários Finais: </label>
<textarea class="form-control" style="height:auto">{{$challenge->formulario->associacao_descricao}}</textarea>

</div>
@if(!$challenge->chat()->first())
     <button type="button" class="btn btn-success" data-toggle="modal" data-target="#aprovarGepex">
                               Responder
                            </button>
@endif
 <div class="modal fade" id="aprovarGepex" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form action="{{route('challenge.meus.iniciarchat', $challenge->id)}}" method="post">
                                    {!! csrf_field() !!}
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Iniciar CHAT</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
 <div class="row">
                <div class="col-md-4 ">
                    <label for="nomeMae">Nome da Mãe/Pai:</label>

                    <div>
                        <input type="text" readonly class="form-control" id="nomeMae" value="{{$challenge->client->name}}" placeholder="nomeMae">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="nomeBebe">Nome do(a) Bebê:</label>

                    <div>
                        <input type="text" readonly class="form-control" id="nomeBebe" value="{{$challenge->client->nameBaby}}" placeholder="nomeMae">
                    </div>
                </div>
                 <div class="col-md-4">
                    <label for="nomeBebe">Email:</label>

                    <div>
                        <input type="text" readonly class="form-control" id="nomeBebe" value="{{$challenge->client->email}}" placeholder="nomeMae">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 ">
                    <label for="nascimentoBebe">Data de Nascimento do Bebê:</label>

                    <div>
                        <input type="text" readonly class="form-control" id="nascimentoBebe" value="{{\Carbon\Carbon::parse($challenge->client->birthBaby)->format('d/m/Y')}}" placeholder="nomeMae">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="idadeBebe">Idade do Bebê: (DIAS / MESES)</label>

                    <div>
                        <input type="text" readonly class="form-control" id="idadeBebe" value="{{now()->diffInDays(\Carbon\Carbon::parse($challenge->client->birthBaby))}} / {{now()->diffInMonths(\Carbon\Carbon::parse($challenge->client->birthBaby))}}" placeholder="nomeMae">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="sexoBebe">Sexo do Bebê:</label>

                    <div>
                        <input type="text" readonly class="form-control" id="sexoBebe" value="{{$challenge->client->sexBaby == 'M' ? "MASCULINO" : "FEMININO"}}" placeholder="nomeMae">
                    </div>
                </div>
            </div>
                                            
                                            <label>Mensagem</label>
                                            <textarea name="message" required class="form-control" style="height:auto"  rows="10"></textarea>
                                            <div class="form-group">
                                                <label>Selecionar Vídeos</label>
                                                <div class="row">
                                                    @foreach($videos as $video)
                                                        <div class="col-md-4">
                                                            <label>
                                                                <input type="checkbox" name="videos[]" value="{{ $video->id }}"> {{ $video->title }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button  class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            <button name="status" value="APROVADO" class="btn btn-primary">ENVIAR</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
    </div>
<!-- Restante do código do formulário (mantido igual) -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Formulário</h3>
    </div>
    <div class="card-body">
        <!-- ... (mantenha o código do formulário existente) ... -->
    </div>
</div>

@if(!$challenge->chat()->first())
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#aprovarGepex">
        Responder
    </button>
@endif

<!-- Modal (mantido igual) -->
<div class="modal fade" id="aprovarGepex" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('challenge.meus.iniciarchat', $challenge->id)}}" method="post">
                {!! csrf_field() !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Iniciar CHAT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ... (mantenha o código do modal existente) ... -->
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button name="status" value="APROVADO" class="btn btn-primary">ENVIAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('js')
    <script>
        $(document).ready(function () {
            $(".form-control").overlayScrollbars({
                textarea: {
                    dynHeight: true,
                }
            });
        });
    </script>
@endsection
@stop