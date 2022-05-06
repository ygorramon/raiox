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
        <h3 class="card-title">Dados Pessoais</h3>
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
        <h3 class="card-title">Formulário</h3>
    </div>
    <div class="card-body">

        <div class="form-group">
            <div class="row">
                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia">Ritual do Bom dia:</label>
                        @if($challenge->form->ritualGoodMorning=='S' )
                        <span class="badge bg-green">SIM</span>
                        @else
                        <span class="badge bg-red">NÃO</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-2 ">


                    <div>
                        <label for="ritualBomDia">Ritual -Luzes:</label>
                        @if($challenge->form->ritualGoodMorningLight=='S' )
                        <span class="badge bg-green">SIM</span>
                        @else
                        <span class="badge bg-red">NÃO</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-2 ">


                    <div>
                        <label for="ritualBomDia">Ritual-Ruídos:</label>
                        @if($challenge->form->ritualGoodMorningNoise=='S' )
                        <span class="badge bg-green">SIM</span>
                        @else
                        <span class="badge bg-red">NÃO</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-2 ">


                    <div>
                        <label for="ritualBomDia">Ritual-Estímulos:</label>
                        @if($challenge->form->ritualGoodMorningStimulus=='S' )
                        <span class="badge bg-green">SIM</span>
                        @else
                        <span class="badge bg-red">NÃO</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-2 ">


                    <div>
                        <label for="ritualBomDia">Ritual-Remove:</label>
                        @if($challenge->form->ritualGoodMorningRemove=='S' )
                        <span class="badge bg-green">SIM</span>
                        @else
                        <span class="badge bg-red">NÃO</span>
                        @endif
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6 ">
                    <label for="nomeMae">Tipo de Rotina Alimentar:</label>

                    <div>
                        <input type="text" readonly class="form-control" id="nomeMae" @if($challenge->form->typeEatingRoutine==1) value="Aleitamento Materno Exclusivo" @endif
                        @if($challenge->form->typeEatingRoutine==2) value="Uso exclusivo de Fórmulas Infantis" @endif
                        @if($challenge->form->typeEatingRoutine==3) value="Aleitamento Materno + Uso de Fórmulas Infantis" @endif
                        @if($challenge->form->typeEatingRoutine==4) value="Introdução Alimentar + Aleitamento Materno" @endif
                        @if($challenge->form->typeEatingRoutine==5) value="Introdução Alimentar + Uso de Fórmulas Infantis" @endif
                        @if($challenge->form->typeEatingRoutine==6) value="Introdução Alimentar + Aleitamento Materno + Uso de Fórmulas Infantis" @endif


                        placeholder="nomeMae">
                    </div>
                </div>
                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia">Dificuldades da Rotina Alimentar</label>
                        @if($challenge->form->routineDifficulties=='S' )
                        <span class="badge bg-red">SIM</span>
                        @else
                        <span class="badge bg-green">NÃO</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia">Ganho de Peso:</label>
                        @if(is_numeric($challenge->form->weightGain ))
                        <span class="badge bg-green">{{$challenge->form->weightGain}}</span>
                        @else
                        <span class="badge bg-red">Não Sabe ou Perdeu Peso</span>
                        @endif
                    </div>
                </div>


            </div>
            <hr>
            <div class="row">

                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia">Gasto de Energia:</label>
                        @if($challenge->form->energyExpenditure=='Adequado' )
                        <span class="badge bg-green">Adequado</span>
                        @else
                        <span class="badge bg-red">{{$challenge->form->energyExpenditure}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia">Sinais de Sono:</label>
                        @if($challenge->form->noticeSigns=='S')
                        <span class="badge bg-green">Sim</span>
                        @else
                        <span class="badge bg-red">Não</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia">Desacelerou:</label>
                        @if($challenge->form->slowDown=='S')
                        <span class="badge bg-green">Sim</span>
                        @else
                        <span class="badge bg-red">Não</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia">Tipo de Ritual de Sonecas:</label>
                        @if($challenge->form->ritualType=='Sem')
                        <span class="badge bg-green">Sem Choro</span>
                        @endif
                        @if($challenge->form->ritualType=='Eventualmente')
                        <span class="badge bg-yellow">Eventualmente com Choro</span>
                        @endif
                        @if($challenge->form->ritualType=='Com')
                        <span class="badge bg-red">Com Choro</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia">Ambiente das Sonecas - Luzes:</label>
                        @if($challenge->form->environmentNapsLights=='T')
                        <span class="badge bg-green">Totalmente escuro</span>
                        @endif
                        @if($challenge->form->environmentNapsLights=='P')
                        <span class="badge bg-yellow">Parcialmente escuro</span>
                        @endif
                        @if($challenge->form->environmentNapsLights=='C')
                        <span class="badge bg-red">Ambiente claro</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia">Ambiente das Sonecas - Ruídos:</label>
                        @if($challenge->form->environmentNapsNoises=='S')
                        <span class="badge bg-green">Silencioso</span>
                        @endif
                        @if($challenge->form->environmentNapsNoises=='P')
                        <span class="badge bg-yellow">Parcialmente silencioso</span>
                        @endif
                        @if($challenge->form->environmentNapsNoises=='C')
                        <span class="badge bg-red">Com ruídos</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia">Ambiente das Sonecas - Temperatura:</label>
                        @if($challenge->form->environmentNapsTemperature=='A')
                        <span class="badge bg-green">Adequada</span>
                        @endif
                        @if($challenge->form->environmentNapsTemperature=='C')
                        <span class="badge bg-red">Calor</span>
                        @endif
                        @if($challenge->form->environmentNapsTemperature=='F')
                        <span class="badge bg-blue">Frio</span>
                        @endif
                        @if($challenge->form->environmentNapsTemperature=='N')
                        <span class="badge bg-red">Não sei</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia">Onde dorme:</label>
                        @if($challenge->form->whereSleepCrib=='S')
                        <span class="badge bg-green">Adormece no colo e é levado ao berço</span>
                        <br>
                        @endif
                        @if($challenge->form->whereSleepLap=='S')
                        <span class="badge bg-green">Adormece e dorme toda a soneca no colo</span>
                        <br>
                        @endif
                        @if($challenge->form->whereSleepLapCrib=='S')
                        <span class="badge bg-green">dormece no colo e é levado ao berço</span>
                        <br>
                        @endif
                        @if($challenge->form->whereSleepLap=='S')
                        <span class="badge bg-green">Adormece e dorme toda a soneca no colo</span>
                        <br>
                        @endif
                        @if($challenge->form->whereSleepSharedBed=='S')
                        <span class="badge bg-green">Cama compartilhada</span>
                        <br>
                        @endif
                        @if($challenge->form->whereSleepCar=='S')
                        <span class="badge bg-green">Carrinho/Bebê conforto</span>
                        <br>
                        @endif
                        @if($challenge->form->whereSleepRede=='S')
                        <span class="badge bg-green">Rede</span>
                        <br>
                        @endif
                        @if($challenge->form->whereSleepOther!='N')
                        <span class="badge bg-green">{{$challenge->form->whereSleepOther}}</span>
                        <br>
                        @endif


                    </div>
                </div>

                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia"> Local da Soneca Incomoda:</label>
                        @if($challenge->form->environmentNapBother=='N')
                        <span class="badge bg-green">NÃO</span>
                        @endif
                        @if($challenge->form->environmentNapBother=='S')
                        <span class="badge bg-red">SIM</span>
                        @endif

                    </div>
                </div>

                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia">Associações da Soneca:</label>
                        @if($challenge->form->napAssociationWhiteNoise=='S')
                        <span class="badge bg-green">Ruído Branco</span>
                        <br>
                        @endif
                        @if($challenge->form->whereSleepLap=='S')
                        <span class="badge bg-green">Adormece e dorme toda a soneca no colo</span>
                        <br>
                        @endif
                        @if($challenge->form->napAssociationCloth=='S')
                        <span class="badge bg-green">Naninha</span>
                        <br>
                        @endif
                        @if($challenge->form->napAssociationPacifier=='S')
                        <span class="badge bg-green">Chupeta</span>
                        <br>
                        @endif
                        @if($challenge->form->napAssociationSuckFinger=='S')
                        <span class="badge bg-green">Chupar dedo</span>
                        <br>
                        @endif
                        @if($challenge->form->whereSleepCar=='S')
                        <span class="badge bg-green">Carrinho/Bebê conforto</span>
                        <br>
                        @endif
                        @if($challenge->form->napAssociationSuckle=='S')
                        <span class="badge bg-green">Mamar para dormir</span>
                        <br>
                        @endif
                        @if($challenge->form->napAssociationCC=='S')
                        <span class="badge bg-green">Cama Compartilhada</span>
                        <br>
                        @endif
                        @if($challenge->form->napAssociationLap=='S')
                        <span class="badge bg-green">Colo</span>
                        <br>
                        @endif
                        @if($challenge->form->napAssociationOther!='N')
                        <span class="badge bg-green">{{$challenge->form->napAssociationOther}}</span>
                        <br>
                        @endif


                    </div>
                </div>

                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia"> Duração das Sonecas Suficiente:</label>
                        @if($challenge->form->enoughNap=='N')
                        <span class="badge bg-red">NÃO</span>
                        @endif
                        @if($challenge->form->enoughNap=='S')
                        <span class="badge bg-green">SIM</span>
                        @endif

                    </div>
                </div>
                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia"> Como Acorda das Sonecas:</label>
                        @if($challenge->form->wakeUpNap=='A')
                        <span class="badge bg-green">Sempre alegre e disposto</span>
                        @endif
                        @if($challenge->form->wakeUpNap=='ES')
                        <span class="badge bg-yellow">Eventualmente acorda ainda com sono</span>
                        @endif
                        @if($challenge->form->wakeUpNap=='FS')
                        <span class="badge bg-red">Frequentemente acorda ainda com sono</span>
                        @endif

                    </div>
                </div>



            </div>
            <hr>
            <div class="row">
                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia"> Faz ritual noturno:</label>
                        @if($challenge->form->nightRitual=='N')
                        <span class="badge bg-red">NÃO</span>
                        @endif
                        @if($challenge->form->nightRitual=='S')
                        <span class="badge bg-green">SIM</span>
                        @endif

                    </div>
                </div>
                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia"> Tipo de ritual noturno:</label>
                        @if($challenge->form->ritualType=='Sem')
                        <span class="badge bg-green">Sem Choro</span>
                        @endif
                        @if($challenge->form->ritualType=='Eventualmente')
                        <span class="badge bg-yellow">Eventualmente com Choro</span>
                        @endif
                        @if($challenge->form->ritualType=='Com')
                        <span class="badge bg-red">Com Choro</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia">Ambiente Noturno - Luzes:</label>
                        @if($challenge->form->environmentRitualLights=='E')
                        <span class="badge bg-green">Totalmente escuro</span>
                        @endif
                        @if($challenge->form->environmentRitualLights=='P')
                        <span class="badge bg-yellow">Parcialmente escuro</span>
                        @endif
                        @if($challenge->form->environmentRitualLights=='C')
                        <span class="badge bg-red">Ambiente claro</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia">Ambiente Noturno - Ruídos:</label>
                        @if($challenge->form->environmentRitualNoises=='S')
                        <span class="badge bg-green">Silencioso</span>
                        @endif
                        @if($challenge->form->environmentRitualNoises=='P')
                        <span class="badge bg-yellow">Parcialmente silencioso</span>
                        @endif
                        @if($challenge->form->environmentRitualNoises=='C')
                        <span class="badge bg-red">Com ruídos</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia">Ambiente Noturno - Temperatura:</label>
                        @if($challenge->form->environmentRitualTemperature=='A')
                        <span class="badge bg-green">Adequada</span>
                        @endif
                        @if($challenge->form->environmentRitualTemperature=='C')
                        <span class="badge bg-red">Calor</span>
                        @endif
                        @if($challenge->form->environmentRitualTemperature=='F')
                        <span class="badge bg-blue">Frio</span>
                        @endif
                        @if($challenge->form->environmentRitualTemperature=='N')
                        <span class="badge bg-red">Não sei</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia">Associações do Sono Noturno:</label>
                        @if($challenge->form->ritualAssociationWhiteNoise=='S')
                        <span class="badge bg-green">Ruído Branco</span>
                        <br>
                        @endif

                        @if($challenge->form->napAssociationCloth=='S')
                        <span class="badge bg-green">Naninha</span>
                        <br>
                        @endif
                        @if($challenge->form->ritualAssociationPacifier=='S')
                        <span class="badge bg-green">Chupeta</span>
                        <br>
                        @endif
                        @if($challenge->form->ritualAssociationSuckFinger=='S')
                        <span class="badge bg-green">Chupar dedo</span>
                        <br>
                        @endif

                        @if($challenge->form->ritualAssociationSuckle=='S')
                        <span class="badge bg-green">Mamar para dormir</span>
                        <br>
                        @endif
                        @if($challenge->form->ritualAssociationCC=='S')
                        <span class="badge bg-green">Cama Compartilhada</span>
                        <br>
                        @endif
                        @if($challenge->form->ritualAssociationLap=='S')
                        <span class="badge bg-green">Colo</span>
                        <br>
                        @endif
                        @if($challenge->form->ritualAssociationOther!='N')
                        <span class="badge bg-green">{{$challenge->form->ritualAssociationOther}}</span>
                        <br>
                        @endif


                    </div>
                </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 ">


                    <div>
                        <label for="ritualBomDia">Causa dos Despertares:</label>
                        @if($challenge->form->conclusionImmaturity=='S')
                        <span class="badge bg-green">Imaturidade</span>

                        @endif

                        @if($challenge->form->conclusionHungry=='S')
                        <span class="badge bg-green">Fome</span>

                        @endif
                        @if($challenge->form->conclusionAche=='S')
                        <span class="badge bg-green">Dor</span>

                        @endif
                        @if($challenge->form->conclusionJump=='S')
                        <span class="badge bg-green">Salto de Desenvolvimento</span>

                        @endif

                        @if($challenge->form->conclusionAnguish=='S')
                        <span class="badge bg-green">Angústia da Separação</span>

                        @endif
                        @if($challenge->form->conclusionScreens=='S')
                        <span class="badge bg-green">Telas</span>

                        @endif
                        @if($challenge->form->conclusionScreens=='S')
                        <span class="badge bg-green">Estresse excessivo</span>

                        @endif



                    </div>
                </div>
            </div>
            <hr>
            <div class="col-md-12 ">


                <div>
                    <label for="ritualBomDia">Observações:</label>
                    <textarea class="form-control" rows="6">{{ $challenge->form->comments }}</textarea>


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
                            @if($analyze->timeWokeUp>='06:00:00' && $analyze->timeWokeUp<='08:00:00' ) <span class="badge bg-green">{{$analyze->timeWokeUp}}</span>
                                @else
                                <span class="badge bg-red">{{$analyze->timeWokeUp}}</span>
                                @endif

                        </h5>
                        <h5>Efeito Vulcânico:
                            @if($analyze->volcanicEffect=='N' )
                            <span class="badge bg-green">NÃO</span>
                            @else
                            <span class="badge bg-red">SIM</span>
                            @endif
                            Janela para a Idade <span class="badge bg-green">({{getIdade($challenge->client->birthBaby)}}) DIAS</span>
                            MIN: <span class="badge bg-green">{{getJanela(getIdade($challenge->client->birthBaby))->janelaIdealInicio}}</span> - MAX: <span class="badge bg-green">{{getJanela(now()->diffInDays(\Carbon\Carbon::parse($challenge->client->birthBaby)))->janelaIdealFim}}</span>
                            MAX Sinal de Sono: <span class="badge bg-green">{{getJanela(getIdade($challenge->client->birthBaby))->janelaIdealFim-30}}</span>

                        </h5>


                        <table class="table table-bordered">

                                    <tbody>
                                        <tr>
                                            <th>#</th>
                                            <th>Sinal de Sono </th>
                                            <th>Horário Dormiu </th>
                                            <th>Horário Acordou</th>
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

                                                <td>
                                                    @if ($nap->duration < 35)
                                                        <span class="badge bg-red">{{ $nap->duration }}</span>
                                                    @endif
                                                    @if ($nap->duration >= 35 && $nap->duration <= 40)
                                                        <span class="badge bg-yellow">{{ $nap->duration }}</span>
                                                    @endif

                                                    @if ($nap->duration > 40)
                                                  
                                                        @if ($nap->duration > 120 &&  now()->diffInDays(\Carbon\Carbon::parse($challenge->client->birthBaby))  > 180)
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
                                                    @if($nap->windowSignalSlept >=35)
                                                    <span class="badge bg-red"> {{ $nap->windowSignalSlept }} </span>
                                                    @endif

                                                     @if($nap->windowSignalSlept < 35 &&  $nap->windowSignalSlept >= 30)
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
                                                   @if($ritual->windowSignalSlept >=35)
                                                    <span class="badge bg-red"> {{ $ritual->windowSignalSlept }} </span>
                                                    @endif

                                                     @if($ritual->windowSignalSlept < 35 &&  $ritual->windowSignalSlept >= 30)
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
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    </div>
@stop