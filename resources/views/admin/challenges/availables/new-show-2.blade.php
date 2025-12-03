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
                                                                                                                                                                    <th>Janela Soneca</th>
                                                                                                                                                                    <th>Janela Sinal Sono</th>
                                                                                                                                                                    <th>Status Janela</th>
                                                                                                                                                                    <th>Situação</th>
                                                                                                                                                                    <th>Associações</th>
                                                                                                                                                                    <th>Questionário</th>
                                                                                                                                                                </tr>
                                                                                                                                                            </thead>
                                                                                                                                                            <tbody>
                                                                                                                                                                @foreach($sonecas as $index => $soneca)
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

            // CALCULAR JANELA DO SINAL DE SONO - CORREÇÃO AQUI
            $janelaSinalSono = null;
            $statusJanelaSinal = 'nao-registrado';

            if (isset($soneca['sentiuSono']) && $soneca['sentiuSono']) {
                // Encontrar horário que acordou da soneca anterior
                $horarioAcordouAnterior = null;

                if ($index == 0) {
                    // CORREÇÃO: Usar $rotina->inicioDia que está no escopo do foreach principal
                    $horarioAcordouAnterior = $rotina->inicioDia ?? '07:00';
                } else {
                    // Usar horário que terminou a soneca anterior
                    $horarioAcordouAnterior = $sonecas[$index - 1]['termino'];
                }

                if ($horarioAcordouAnterior) {
                    // Calcular diferença em minutos entre acordar e sentir sono
                    $janelaSinalSono = calcularDiferencaMinutos($horarioAcordouAnterior, $soneca['sentiuSono']);

                    // Determinar status da janela do sinal de sono
                    $maxSinalSono = $janelaMax - 30; // Máximo sugerido para sinal de sono

                    if ($janelaSinalSono <= $maxSinalSono) {
                        $statusJanelaSinal = 'ideal';
                    } else {
                        $statusJanelaSinal = 'longa';
                    }
                }
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
                                                                                                                                                                        <!-- COLUNA: JANELA SINAL SONO -->
                                                                                                                                                                        <td>
                                                                                                                                                                            @if($janelaSinalSono !== null)
                                                                                                                                                                                @if($statusJanelaSinal == 'ideal')
                                                                                                                                                                                    <span class="badge bg-green">{{ $janelaSinalSono }}min</span>
                                                                                                                                                                                @elseif($statusJanelaSinal == 'longa')
                                                                                                                                                                                    <span class="badge bg-red">{{ $janelaSinalSono }}min</span>
                                                                                                                                                                                @else
                                                                                                                                                                                    <span class="badge bg-secondary">{{ $janelaSinalSono }}min</span>
                                                                                                                                                                                @endif
                                                                                                                                                                                <br>
                                                                                                                                                                                <small class="text-muted">
                                                                                                                                                                                    @if($index == 0)
                                                                                                                                                                                        Acordou: {{ $horarioAcordouAnterior }}
                                                                                                                                                                                    @else
                                                                                                                                                                                        Soneca {{ $index }}: {{ $horarioAcordouAnterior }}
                                                                                                                                                                                    @endif
                                                                                                                                                                                </small>
                                                                                                                                                                            @else
                                                                                                                                                                                <span class="text-muted">-</span>
                                                                                                                                                                                @if(!isset($soneca['sentiuSono']))
                                                                                                                                                                                    <br><small class="text-muted">Sinal não registrado</small>
                                                                                                                                                                                @endif
                                                                                                                                                                            @endif
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

                foreach ($soneca['associacoes']['comoAdormeceu'] as $associacao) {
                    if (strpos($associacao, 'Outro:') !== false || strpos($associacao, 'Outros:') !== false) {
                        $temOutrosLongo = true;
                        $textoOutros = $associacao;
                    } else {
                        $associacoesParaMostrar[] = $associacao;
                    }
                }

                $associacoesParaMostrar = array_slice($associacoesParaMostrar, 0, 2);
                $totalParaMostrar = count($associacoesParaMostrar);
                $mostrarBotao = $totalAssociacoes > $totalParaMostrar || $temOutrosLongo;
                                                                                                                                                                                @endphp

                                                                                                                                                                                @foreach($associacoesParaMostrar as $associacao)
                                                                                                                                                                                    <span class="badge bg-info mb-1 d-inline-block text-truncate" style="max-width: 120px; font-size: 11px;">
                                                                                                                                                                                        {{ $associacao }}
                                                                                                                                                                                    </span>
                                                                                                                                                                                    <br>
                                                                                                                                                                                @endforeach

                                                                                                                                                                                @if($mostrarBotao)
                                                                                                                                                                                    <button type="button" class="btn btn-sm btn-outline-info mt-1" data-toggle="modal" data-target="#modalAssociacoes{{ $soneca['numero'] }}">
                                                                                                                                                                                        @if($temOutrosLongo)
                                                                                                                                                                                            📝 Ver detalhes
                                                                                                                                                                                        @else
                                                                                                                                                                                            +{{ $totalAssociacoes - $totalParaMostrar }} mais
                                                                                                                                                                                        @endif
                                                                                                                                                                                    </button>
                                                                                                                                                                                @endif

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
                                                                                                                                                                                                            @if(isset($resposta['resposta']))
                                                                                                                                                                                                                <span
                                                                                                                                                                                                                    class="badge bg-{{ $resposta['resposta'] == 'Sim' ? 'success' : ($resposta['resposta'] == 'Não' ? 'danger' : 'info') }}">
                                                                                                                                                                                                                    {{ $resposta['resposta'] }}
                                                                                                                                                                                                                </span>
                                                                                                                                                                                                            @else
                                                                                                                                                                                                            <span class="badge bg-secondary">Não respondido</span>
                                                                                                                                                                                                            @endif
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
        <h3 class="card-title"><i class="fas fa-file-medical-alt mr-2"></i>Formulário de Avaliação</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- FOME -->
            <div class="col-md-6 mb-4">
                <div class="card card-hover">
                    <div class="card-header bg-danger text-white">
                        <h5 class="card-title mb-0"><i class="fas fa-utensils mr-2"></i>FOME</h5>
                    </div>
                    <div class="status-indicator 
                        {{ is_null($challenge->formulario->fome_peso_adequado)
    ? 'status-warning'
    : ($challenge->formulario->fome_peso_adequado == 'S' ? 'status-success' : 'status-danger') }}">
                    
                        @if(is_null($challenge->formulario->fome_peso_adequado))
                            <i class="fas fa-question-circle fa-2x mb-2 text-warning"></i>
                            <h6 class="text-warning">NÃO AVALIADO</h6>
                        @else
                            <i
                                class="fas {{ $challenge->formulario->fome_peso_adequado == 'S' ? 'fa-check-circle text-success' : 'fa-exclamation-circle text-danger' }} fa-2x mb-2"></i>
                            <h6 class="{{ $challenge->formulario->fome_peso_adequado == 'S' ? 'text-success' : 'text-danger' }}">
                                {{ $challenge->formulario->fome_peso_adequado == 'S' ? 'SEM PROBLEMAS' : 'ATENÇÃO NECESSÁRIA' }}
                            </h6>
                        @endif
                    </div>
                </div>
            </div>

            <!-- DOR -->
            <div class="col-md-6 mb-4">
                <div class="card card-hover">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="card-title mb-0"><i class="fas fa-first-aid mr-2"></i>DOR</h5>
                    </div>
                    <div class="card-body text-center">
                        <div
                            class="status-indicator {{ str_contains($challenge->formulario->ajustes_dor, 'Ótimo') ? 'status-success' : 'status-danger' }}">
                            <i
                                class="fas {{ str_contains($challenge->formulario->ajustes_dor, 'Ótimo') ? 'fa-check-circle' : 'fa-exclamation-circle' }} fa-2x mb-2"></i>
                            <h6>{{ str_contains($challenge->formulario->ajustes_dor, 'Ótimo') ? 'SEM DOR' : 'QUEIXA DE DOR' }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SALTO DE DESENVOLVIMENTO -->
        <div class="card card-hover mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0"><i class="fas fa-chart-line mr-2"></i>SALTO DE DESENVOLVIMENTO</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Salto Identificado:</label>
                            <span
                                class="badge badge-pill {{ $challenge->formulario->salto == 'SIM' ? 'badge-warning' : 'badge-success' }} ml-2 p-2">
                                {{ $challenge->formulario->salto == 'SIM' ? 'SIM' : 'NÃO' }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Marcos:</label>
                            <span
                                class="badge badge-pill {{ setStatus($challenge->formulario->salto_marcos)->color }} ml-2 p-2">
                                {{ setStatus($challenge->formulario->salto_marcos)->value }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROTINA E AMBIENTE -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card card-hover h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0"><i class="fas fa-sun mr-2"></i>ROTINA</h5>
                    </div>
                    <div class="card-body">
                        <div class="routine-item mb-3">
                            <label class="font-weight-bold">Ritual do Bom Dia:</label>
                            <span
                                class="badge badge-pill {{ setStatus($challenge->formulario->ritual_bom_dia)->color }} float-right">
                                {{ setStatus($challenge->formulario->ritual_bom_dia)->value }}
                            </span>
                        </div>
                        <div class="routine-item mb-3">
                            <label class="font-weight-bold">Telas:</label>
                            <span
                                class="badge badge-pill {{ setStatus($challenge->formulario->telas)->color }} float-right">
                                {{ setStatus($challenge->formulario->telas)->value }}
                            </span>
                        </div>
                        <div class="routine-item mb-3">
                            <label class="font-weight-bold">Desacelera:</label>
                            <span
                                class="badge badge-pill {{ setStatus($challenge->formulario->desacelera)->color }} float-right">
                                {{ setStatus($challenge->formulario->desacelera)->value }}
                            </span>
                        </div>
                        <div class="routine-item">
                            <label class="font-weight-bold">Choro no Ritual:</label>
                            <span
                                class="badge badge-pill {{ setStatus($challenge->formulario->ritual_choro)->color }} float-right">
                                {{ setStatus($challenge->formulario->ritual_choro)->value }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- AMBIENTE -->
            <div class="col-md-6 mb-4">
                <div class="card card-hover h-100">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0"><i class="fas fa-bed mr-2"></i>AMBIENTE</h5>
                    </div>
                    <div class="card-body text-center">
                        @if($challenge->formulario->ambiente_luz == 'escuro' && in_array($challenge->formulario->ambiente_barulho, ['silencio', 'ruido_branco']) && $challenge->formulario->ambiente_temperatura == 'agradavel')
                            <div class="status-indicator status-success">
                                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                                <h5 class="text-success">AMBIENTE AGRADÁVEL</h5>
                                <small class="text-muted">Luz, som e temperatura adequados</small>
                            </div>
                        @else
                            <div class="status-indicator status-danger">
                                <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                                <h5 class="text-danger">AMBIENTE DESAJUSTADO</h5>
                                <div class="mt-3 text-left">
                                    @if($challenge->formulario->ambiente_luz != 'escuro')
                                        <small class="d-block"><i class="fas fa-lightbulb text-warning"></i> Luz:
                                            {{ $challenge->formulario->ambiente_luz }}</small>
                                    @endif
                                    @if($challenge->formulario->ambiente_barulho != 'silencio')
                                        <small class="d-block"><i class="fas fa-volume-up text-warning"></i> Som:
                                            {{ $challenge->formulario->ambiente_barulho }}</small>
                                    @endif
                                    @if($challenge->formulario->ambiente_temperatura != 'agradavel')
                                        <small class="d-block"><i class="fas fa-thermometer-half text-warning"></i> Temperatura:
                                            {{ $challenge->formulario->ambiente_temperatura }}</small>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- ASSOCIAÇÕES - SONECA -->
        <div class="card card-hover mb-4">
            <div class="card-header bg-purple text-white">
                <h5 class="card-title mb-0"><i class="fas fa-moon mr-2"></i>ASSOCIAÇÕES - SONECA</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @php
$associacoesSoneca = [
    'Colo' => $challenge->formulario->associacao_soneca_colo,
    'Mamar' => $challenge->formulario->associacao_soneca_mamar,
    'Cama Compartilhada' => $challenge->formulario->associacao_soneca_cc,
    'Rede' => $challenge->formulario->associacao_soneca_rede,
    'Chupar Dedo' => $challenge->formulario->associacao_soneca_chupar_dedo,
    'Naninha' => $challenge->formulario->associacao_soneca_naninha,
    'Ruído Branco' => $challenge->formulario->associacao_soneca_ruido
];
                    @endphp

                    @foreach($associacoesSoneca as $nome => $valor)
                        <div class="col-md-4 mb-3">
                            <div
                                class="associacao-item d-flex justify-content-between align-items-center p-2 border rounded">
                                <span class="font-weight-bold">{{ $nome }}:</span>
                                <span class="badge {{ setStatus($valor)->color }}">{{ setStatus($valor)->value }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- ASSOCIAÇÕES - SONO NOTURNO -->
        <div class="card card-hover mb-4">
            <div class="card-header bg-indigo text-white">
                <h5 class="card-title mb-0"><i class="fas fa-star mr-2"></i>ASSOCIAÇÕES - SONO NOTURNO</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @php
$associacoesSono = [
    'Colo' => $challenge->formulario->associacao_sono_colo,
    'Mamar' => $challenge->formulario->associacao_sono_mamar,
    'Cama Compartilhada' => $challenge->formulario->associacao_sono_cc,
    'Rede' => $challenge->formulario->associacao_sono_rede,
    'Chupar Dedo' => $challenge->formulario->associacao_sono_chupar_dedo,
    'Naninha' => $challenge->formulario->associacao_sono_naninha,
    'Ruído Branco' => $challenge->formulario->associacao_sono_ruido
];
                    @endphp

                    @foreach($associacoesSono as $nome => $valor)
                        <div class="col-md-4 mb-3">
                            <div
                                class="associacao-item d-flex justify-content-between align-items-center p-2 border rounded">
                                <span class="font-weight-bold">{{ $nome }}:</span>
                                <span class="badge {{ setStatus($valor)->color }}">{{ setStatus($valor)->value }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Associações Incomodam:</label>
                            <span
                                class="badge badge-pill {{ setStatus($challenge->formulario->associacao_incomoda)->color }} ml-2 p-2">
                                {{ setStatus($challenge->formulario->associacao_incomoda)->value }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- COMENTÁRIOS FINAIS -->
        <div class="card card-hover">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title mb-0"><i class="fas fa-comments mr-2"></i>COMENTÁRIOS FINAIS</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <textarea class="form-control" rows="4" readonly
                        style="background-color: #f8f9fa; border: 1px solid #e3e6f0;">{{ $challenge->formulario->associacao_descricao ?: 'Nenhum comentário adicional' }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .status-indicator {
        padding: 20px;
        border-radius: 10px;
    }

    .status-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
    }

    .status-danger {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
    }

    .routine-item {
        padding: 10px;
        border-bottom: 1px solid #f0f0f0;
    }

    .routine-item:last-child {
        border-bottom: none;
    }

    .associacao-item:hover {
        background-color: #f8f9fa;
        transition: background-color 0.3s ease;
    }

    .bg-purple {
        background-color: #6f42c1 !important;
    }

    .bg-indigo {
        background-color: #6610f2 !important;
    }

    .badge-pill {
        font-size: 0.85em;
        padding: 0.5em 1em;
    }
    .status-warning {
    background-color: #fff3cd;
    border: 1px solid #ffeaa7;
}
</style>

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