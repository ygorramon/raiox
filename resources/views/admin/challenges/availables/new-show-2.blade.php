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
                                            <th>Situação</th>
                                            <th>Associações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sonecas as $soneca)
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
                                                    @if($soneca['janelaSono'] >= 90 && $soneca['janelaSono'] <= 120)
                                                        <span class="badge bg-green">{{ $soneca['janelaSono'] }}min</span>
                                                    @else
                                                        <span class="badge bg-red">{{ $soneca['janelaSono'] }}min</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $soneca['situacao'] == '1.1' ? 'green' : 'orange' }}">
                                                        {{ $soneca['situacao'] }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if(isset($soneca['associacoes']['comoAdormeceu']))
                                                        @foreach($soneca['associacoes']['comoAdormeceu'] as $associacao)
                                                            <span class="badge bg-info">{{ $associacao }}</span>
                                                        @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif

                            <!-- Ritual Noturno -->
                            @if($ritual)
                                <h4>🌙 Ritual Noturno</h4>
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