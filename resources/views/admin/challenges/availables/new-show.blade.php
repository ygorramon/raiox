@extends('adminlte::page')

@section('title', 'Desafios disponiveis')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('challenge.availables') }}" class="active">Desafios Diponíveis</a></li>
</ol>

@stop

@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Dados Pessoais  </h3>
    </div>
    <div class="card-body">

        <div class="form-group">
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
            <textarea class="form-control" style="height:auto"> {{ $challenge2->anotacoes }} {{ $challenge2->chat->messages->first()->content ?? '' }}</textarea>
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
            @foreach($challenge->analyzes as $analyze)

                                                                    <div class="col-md-12">
                                                                        <div class="card card-info">
                                                                            <div class="card-header">
                                                                                <h3 class="card-title">DIA {{$analyze->day}} - {{\Carbon\Carbon::parse($analyze->date)->format('d/m/Y')}}</h3>

                                                                            </div>

                                                                            <div class="card-body">
                                                                                <h5>Horário que acordou:
                                                                                    @if($analyze->timeWokeUp >= '06:00:00' && $analyze->timeWokeUp <= '08:00:00') <span class="badge bg-green">{{$analyze->timeWokeUp}}</span>
                                                                                        @else
                                                                                        <span class="badge bg-red">{{$analyze->timeWokeUp}}</span>
                                                                                        @endif

                                                                                </h5>
                                                                                <h5>Efeito Vulcânico:
                                                                                    @if($analyze->volcanicEffect == 'N')
                                                                                    <span class="badge bg-green">NÃO</span>
                                                                                    @else
                                                                                    <span class="badge bg-red">SIM</span>
                                                                                    @endif
                                                                                    Janela para a Idade <span class="badge bg-green">({{getIdade($challenge->client->birthBaby)}}) DIAS</span>
                                                                                    MIN: <span class="badge bg-green">{{getJanela(getIdade($challenge->client->birthBaby))->janelaIdealInicio}}</span> - MAX: <span class="badge bg-green">{{getJanela(now()->diffInDays(\Carbon\Carbon::parse($challenge->client->birthBaby)))->janelaIdealFim}}</span>
                                                                                    MAX Sinal de Sono: <span class="badge bg-green">{{getJanela(getIdade($challenge->client->birthBaby))->janelaIdealFim - 30}}</span>

                                                                                </h5>


                                                                                <table class="table table-bordered">

                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <th>#</th>
                                                                                                    <th>Sinal de Sono </th>
                                                                                                    <th>Horário Dormiu </th>
                                                                                                    <th>Horário Acordou</th>
                                                <th>Onde Dormiu </th>
                                                                                                    <th>Prolongada </th>

                                                                                                    <th>Duração </th>
                                                                                                    <th>Janela</th>
                                                                                                    <th>Janela Sinal de Sono </th>
                                                                                                    <th>  Duração Ritual </th>
                                                                                                </tr>
                                                                                                @foreach ($analyze->naps as $nap)
                                                                                                                                                                                                                                    <tr>
                                                                                                                                                                                                                                        <td>Soneca {{ $nap->number }}</td>
                                                                                                                                                                                                                                        <td> {{ $nap->signalSlept }}</td>
                                                                                                                                                                                                                                        <td> {{ $nap->timeSlept }}</td>
                                                                                                                                                                                                                                        <td> {{ $nap->timeWokeUp }}</td>
                                                                                                                                                                                                                                        <td> {{ $nap->onde_dormiu }}</td>
                                                                                                                                                                                                                                        <td>  @if ($nap->prolongada == 1)
                                                                                                                                                                                                                                                <span class="badge bg-red">SIM</span>
                                                                                                                                                                                                                                            @endif
                                                                                                                                                                                                                                            @if ($nap->prolongada == 0)
                                                                                                                                                                                                                                                <span class="badge bg-green">NÃO</span>
                                                                                                                                                                                                                                            @endif </td>

                                                                                                                                                                                                                                        <td>
                                                                                                                                                                                                                                            @if ($nap->duration < 35)
                                                                                                                                                                                                                                                <span class="badge bg-red">{{ $nap->duration }}</span>
                                                                                                                                                                                                                                            @endif
                                                                                                                                                                                                                                            @if ($nap->duration >= 35 && $nap->duration <= 40)
                                                                                                                                                                                                                                                <span class="badge bg-yellow">{{ $nap->duration }}</span>
                                                                                                                                                                                                                                            @endif

                                                                                                                                                                                                                                            @if ($nap->duration > 40)

                                                                                                                                                                                                                                                @if ($nap->duration > 120 && now()->diffInDays(\Carbon\Carbon::parse($challenge->client->birthBaby)) > 180)
                                                                                                                                                                                                                                                    <span class="badge bg-orange">{{ $nap->duration }}</span>
                                                                                                                                                                                                                                                @else
                                                                                                                                                                                                                                                    <span class="badge bg-green">{{ $nap->duration }}</span>
                                                                                                                                                                                                                                                      {{$challenge->client->babyAge}}
                                                                                                                                                                                                                                                @endif
                                                                                                                                                                                                                                            @endif

                                                                                                                                                                                                                                        </td>
                                                                                                                                                                                                                                        <td>

                                                                                                                                                                                                                                            @if ($nap->window >= getJanela(getIdade($challenge->client->birthBaby))->janelaIdealInicio && $nap->window <= getJanela(getIdade($challenge->client->birthBaby))->janelaIdealFim)
                                                                                                                                                                                                                                                <span class="badge bg-green">{{ $nap->window }}</span>
                                                                                                                                                                                                                                            @else
                                                                                                                                                                                                                                                @if ($nap->window < getJanela(getIdade($challenge->client->birthBaby))->janelaIdealInicio)
                                                                                                                                                                                                                                                    <span class="badge bg-yellow">{{ $nap->window }}</span>
                                                                                                                                                                                                                                                @endif

                                                                                                                                                                                                                                                @if ($nap->window > getJanela(getIdade($challenge->client->birthBaby))->janelaIdealInicio)
                                                                                                                                                                                                                                                    <span class="badge bg-red">{{ $nap->window }}</span>
                                                                                                                                                                                                                                                @endif
                                                                                                                                                                                                                                            @endif



                                                                                                                                                                                                                                        </td>
                                                                                                                                                                                                                                        @php

        $var = getJanela(getIdade($challenge->client->birthBaby))->janelaIdealFim;

                                                                                                                                                                                                                                        @endphp
                                                                                                                                                                                                                                        <td>
                                                                                                                                                                                                                                            @if ($var - ($nap->window - $nap->windowSignalSlept) >= 30)
                                                                                                                                                                                                                                                <span class="badge bg-green">
                                                                                                                                                                                                                                                    {{ $nap->window - $nap->windowSignalSlept }}</span>
                                                                                                                                                                                                                                            @else
                                                                                                                                                                                                                                                <span class="badge bg-red">
                                                                                                                                                                                                                                                    {{ $nap->window - $nap->windowSignalSlept }} </span>
                                                                                                                                                                                                                                            @endif
                                                                                                                                                                                                                                        </td>
                                                                                                                                                                                                                                        <td>
                                                                                                                                                                                                                                            @if($nap->windowSignalSlept >= 35)
                                                                                                                                                                                                                                            <span class="badge bg-red"> {{ $nap->windowSignalSlept }} </span>
                                                                                                                                                                                                                                            @endif

                                                                                                                                                                                                                                             @if($nap->windowSignalSlept < 35 && $nap->windowSignalSlept >= 30)
                                                                                                                                                                                                                                            <span class="badge bg-yellow"> {{ $nap->windowSignalSlept }} </span>
                                                                                                                                                                                                                                            @endif

                                                                                                                                                                                                                                              @if($nap->windowSignalSlept < 30)
                                                                                                                                                                                                                                            <span class="badge bg-green"> {{ $nap->windowSignalSlept }} </span>
                                                                                                                                                                                                                                            @endif

                                                                                                                                                                                                                                        </td>
                                                                                                                                                                                                                                    </tr>
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>
                                                                                        <br>
                                                                                        <table class="table table-bordered">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <th>#</th>
                                                                                                    <th>Sinal de Sono </th>
                                                                                                    <th>Horário Início </th>
                                                                                                    <th>Horário Dormiu</th>
                                                                                                    <th>Duração </th>
                                                                                                    <th>Janela</th>
                                                                                                    <th>Janela Sinal de Sono  </th>
                                                                                                    <th>  T. Sinal de Sono até Início do Ritual </th>
                                                                                                </tr>
                                                                                                @foreach ($analyze->rituals as $ritual)
                                                                                                    <tr>
                                                                                                        <td>Ritual</td>
                                                                                                        <td> {{ $ritual->signalSlept }}</td>
                                                                                                        <td>{{ $ritual->start }}</td>
                                                                                                        <td>{{ $ritual->end }}</td>
                                                                                                        <td>
                                                                                                            @if ($ritual->duration > 30)
                                                                                                                <span class="badge bg-red">{{ $ritual->duration }}</span>
                                                                                                            @else
                                                                                                                <span class="badge bg-green">{{ $ritual->duration }}</span>
                                                                                                            @endif
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            @if ($ritual->window >= getJanela(getIdade($challenge->client->birthBaby))->janelaIdealInicio && $ritual->window <= getJanela(getIdade($challenge->client->birthBaby))->janelaIdealFim)
                                                                                                                <span class="badge bg-green">{{ $ritual->window }}</span>
                                                                                                            @else
                                                                                                                <span class="badge bg-red">{{ $ritual->window }}</span>
                                                                                                            @endif

                                                                                                        </td>
                                                                                                        <td>
                                                                                                            @php

        $var = getJanela(getIdade($challenge->client->birthBaby))->janelaIdealFim;

                                                                                                            @endphp

                                                                                                            @if ($var - ($ritual->window - $ritual->windowSignalSlept) >= 30)
                                                                                                                <span class="badge bg-green">
                                                                                                                    {{ $ritual->window - $ritual->windowSignalSlept }}</span>
                                                                                                            @else
                                                                                                                <span class="badge bg-red">
                                                                                                                    {{ $ritual->window - $ritual->windowSignalSlept }} </span>
                                                                                                            @endif
                                                                                                                </td>
                                                                                                               <td>
                                                                                                           @if($ritual->windowSignalSlept >= 35)
                                                                                                            <span class="badge bg-red"> {{ $ritual->windowSignalSlept }} </span>
                                                                                                            @endif

                                                                                                             @if($ritual->windowSignalSlept < 35 && $ritual->windowSignalSlept >= 30)
                                                                                                            <span class="badge bg-yellow"> {{ $ritual->windowSignalSlept}} </span>
                                                                                                            @endif

                                                                                                              @if($ritual->windowSignalSlept < 30)
                                                                                                            <span class="badge bg-green"> {{ $ritual->windowSignalSlept }} </span>
                                                                                                            @endif


                                                                                                        </td>

                                                                                                    </tr>
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>
                                                                                        <br>
                                                                                        <table class="table table-bordered">

                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <th>#</th>
                                                                                                    <th>Horário que Acordou </th>
                                                                                                    <th>Horário que Dormiu</th>
                                                                                                    <th>Duração Acordado</th>
                                                                                                    <th>Como dormiu</th>

                                                                                                </tr>
                                                                                                @foreach ($analyze->wakes as $wake)
                                                                                                    <tr>
                                                                                                        <td>Despertar {{ $wake->number }}</td>
                                                                                                        <td> {{ $wake->timeWokeUp }}</td>
                                                                                                        <td> {{ $wake->timeSlept }}</td>
                                                                                                        <td> {{ $wake->duration }}</td>

                                                                                                        <td>
                                                                                                            @if ($wake->sleepingMode == 1)
                                                                                                                Sozinho
                                                                                                            @endif
                                                                                                            @if ($wake->sleepingMode == 2)
                                                                                                                Ninando no berço/cama
                                                                                                            @endif
                                                                                                            @if ($wake->sleepingMode == 3)
                                                                                                                Mamando
                                                                                                            @endif
                                                                                                            @if (is_numeric($wake->sleepingMode) == false)
                                                                                                                {{ $wake->sleepingMode }}
                                                                                                            @endif
                                                                                                        </td>

                                                                                                    </tr>
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>



                                                                                    </div>



                                                                                </div>
                                                                                <div class="card-body">

                                                                                    <div class="form-group">
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 ">
                                                                                                <label for="nomeMae">Observações:</label>
                                                                                <textarea class="form-control" style="height:auto">{{ $analyze->observacoes ?? '' }}</textarea>
                                                                            </div>
                                                                            </div>
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
                    <div class="card-body text-center">
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
</style>
@if(!$challenge->chat()->first())
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#aprovarGepex">
        Responder
    </button>
@endif
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

                    <label>Mensagem</label>
                    <textarea name="message" required class="form-control" style="height:auto" rows="10"></textarea>
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
                    <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>
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
    $(document).ready(function() {
        $(".form-control").overlayScrollbars({

            textarea: {
                dynHeight: true,
                
            }

        });
    });
</script>
@endsection
@stop