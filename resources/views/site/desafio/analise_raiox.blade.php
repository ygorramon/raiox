@extends('site.desafio.layouts.app')
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
@stop



@section('content')
<!--
<div id="modal1" class="modal">
    <div class="modal-content">
      <h4>PRÉ-ANÁLISE</h4>
      <textarea class="materialize-textarea">Olá, essa é uma pré-análise do seu Desafio e a cada dia você terá uma diferente para agilizar ainda mais a sua análise definitiva e os seus resultados.

Nessa pré-análise, nós avaliaremos o critérios do Passo 1, do método dos 4 Passos do sono do bebê, que consta em avaliar se o sono do bebê está sendo reparador.

E para isso, é preciso avaliar os seguintes pontos:

- O bebê dorme ao sentir sono?
Saberemos ao avaliar as suas anotações sobre sinais de sono;

- O bebê dorme sem briga?
Saberemos ao avaliar as suas anotações sobre rituais do sono;

- A duração do sono foi o suficiente?
Saberemos ao avaliar as suas anotações sobre a duração das sonecas;</textarea>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ok</a>
    </div>
  </div>
-->
    <div class="row">








        <div class="col s12">
            <div id="input-fields" class="card card-tabs">
                <div class="card-content">
                    <div class="card-title">
                        <div class="row">

                            <div class="col s12 m6 l10">
                                <h4 class="card-title"Meus Dados</h4>
                                    PRÉ-ANÁLISE:

                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div id="input-fields" class="card card-tabs">
                @if ($errors->any())
                    <div class="row">
                        <div class="col s12">
                            <div class="card-panel red">
                                <span class="white-text">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}<br>
                                    @endforeach
                                </span>
                            </div>
                        </div>
                    </div>

                @endif
                <div class="card-content">
                    <div class="card-title">
                        <div class="row">

                            <div class="col s12 m6 l10">
                                <h4 class="card-title"Meus Dados</h4>
                                    Dados:

                            </div>
                        </div>
                        <div class="row margin">

                        </div>
                        <div class="row margin">
                            <div class="input-field col s12 m6">

                                <input id="nameBaby" type="text" name="nameBaby"
                                    value="{{ old('nameBaby', $client->nameBaby) }}" class="validate">
                                <label for="nameBaby" class="center-align">Nome do Bebê</label>
                            </div>

                            <div class="input-field col s12 m6">

                                <input id="birthBaby" type="text" name="birthBaby" class="datepicker"
                                    value="{{ now()->diffInDays(\Carbon\Carbon::parse($client->birthBaby)) }} Dias / {{ now()->diffInMonths(\Carbon\Carbon::parse($client->birthBaby)) }} Meses"
                                    required="">
                                <label for="birthBaby" class="center-align">Idade</label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div id="input-fields" class="card card-tabs">
                <div class="card-content">
                    <div class="card-title">
                        <div class="row">
                              @foreach ($analyze->naps as $nap)
                            <div class="col s12 m6">
                                <div class="card">
                                    <div class="card-content">
                                        <h5>Soneca {{ $nap->number }}</h5>
                                        <table>
                                           
                                             <tr><td><h6>Sinal de Sono:</h6></td>  <td><h6>{{ $nap->signalSlept }}</h6></td>  </tr>
                                             <tr><td><h6>Horário Dormiu:</h6></td>  <td><h6>{{ $nap->timeSlept }}</h6></td>  </tr>
                                             <tr><td><h6>Horário Acordou:</h6></td>  <td><h6>{{ $nap->timeWokeUp }}</h6></td>  </tr>
                                            <tr><td><h6>Duração de Soneca:</h6></td>  <td>
                                                 @if ($nap->duration < 35)
                                                    <span class="new badge red"
                                                        data-badge-caption="min">{{ $nap->duration }}</span>
                                                @endif
                                                @if ($nap->duration >= 35 && $nap->duration <= 40)
                                                    <span class="new badge yellow"
                                                        data-badge-caption="min">{{ $nap->duration }}</span>
                                                @endif

                                                @if ($nap->duration > 40)
                                                    @if ($nap->duration > 120 && now()->diffInDays(\Carbon\Carbon::parse($client->birthBaby)) > 180)
                                                        <span class="new badge orange"
                                                            data-badge-caption="min">{{ $nap->duration }}</span>
                                                    @else
                                                        <span class="new badge green"
                                                            data-badge-caption="min">{{ $nap->duration }}</span>
                                                        {{ $client->babyAge }}
                                                    @endif
                                                @endif</td>  </tr>
                                            <tr><td><h6>Janela de Sono:</h6></td> <td>

                                                @if ($nap->window >= getJanela(getIdade($client->birthBaby))->janelaIdealInicio && $nap->window <= getJanela(getIdade($client->birthBaby))->janelaIdealFim)
                                                    <span class="new badge green"
                                                        data-badge-caption="min">{{ $nap->window }}</span>
                                                @else
                                                    @if ($nap->window < getJanela(getIdade($client->birthBaby))->janelaIdealInicio)
                                                        <span class="new badge orange"
                                                            data-badge-caption="min">{{ $nap->window }}</span>
                                                    @endif

                                                    @if ($nap->window > getJanela(getIdade($client->birthBaby))->janelaIdealInicio)
                                                        <span class="new badge red"
                                                            data-badge-caption="min">{{ $nap->window }}</span>
                                                    @endif
                                                @endif



                                            </td> 
                                        
                                               </tr>
                                            <tr><td><h6>Janela de Sinal de  Sono:</h6></td>
                                         @php
                                                
                                                $var = getJanela(getIdade($client->birthBaby))->janelaIdealFim;
                                                
                                            @endphp
                                            <td>
                                                @if ($var - ($nap->window - $nap->windowSignalSlept) >= 30)
                                                    <span class="new badge green" data-badge-caption="min">
                                                        {{ $nap->window - $nap->windowSignalSlept }}</span>
                                                @else
                                                    <span class="new badge red" data-badge-caption="min">
                                                        {{ $nap->window - $nap->windowSignalSlept }} </span>
                                                @endif
                                            </td></tr>
                                            <tr><td><h6>Duração de Ritual:</h6></td>  <td>
                                                @if ($nap->windowSignalSlept >= 35)
                                                    <span class="new badge red" data-badge-caption="min">
                                                        {{ $nap->windowSignalSlept }} </span>
                                                @endif

                                                @if ($nap->windowSignalSlept < 35 && $nap->windowSignalSlept >= 30)
                                                    <span class="new badge orange" data-badge-caption="min">
                                                        {{ $nap->windowSignalSlept }} </span>
                                                @endif

                                                @if ($nap->windowSignalSlept < 30)
                                                    <span class="new badge green" data-badge-caption="min">
                                                        {{ $nap->windowSignalSlept }} </span>
                                                @endif

                                            </td>  </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                           <div class="col s12 m6">
                                <div class="card">
                                    <div class="card-content">
                                        <h5>Ritual do Sono Noturno</h5>
                                        @foreach ($analyze->rituals as $ritual)
                                         <table>
                                             <tr>
                                            <td> Sinal de Sono </td><td>{{ $ritual->signalSlept }}</td>
                                                
                                             </tr>
                                             <tr>
                                             <td> Início do Ritual </td><td>{{ $ritual->start }}</td></tr>
                                             <tr>
                                                <td>Horário que Dormiu </td><td>{{ $ritual->end }}</td>  </tr>
                                                <tr><td>Duração do Ritual</td>
                                                <td>
                                                    @if ($ritual->duration > 30)
                                                     <span class="new badge red" data-badge-caption="min">{{ $ritual->duration }}</span>
                                                    @else
                                                         <span class="new badge green" data-badge-caption="min">{{ $ritual->duration }}</span>
                                                    @endif
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td> Janela de Sono </td>
                                                       
                                         
                                                <td>
                                                    @if ($ritual->window >= getJanela(getIdade($client->birthBaby))->janelaIdealInicio && $ritual->window <= getJanela(getIdade($client->birthBaby))->janelaIdealFim)
                                                        <span class="new badge green" data-badge-caption="min">{{ $ritual->window }}</span>
                                                    @else
                                                       <span class="new badge red" data-badge-caption="min">{{ $ritual->window }}</span>
                                                    @endif

                                                </td>
                                                </tr>
                                                <tr><td>Janela Sinal de Sono </td>
                                                    
                                                <td>
                                                    @php
                                                        
                                                        $var = getJanela(getIdade($client->birthBaby))->janelaIdealFim;
                                                        
                                                    @endphp
                                                   
                                                    @if ($var - ($ritual->window - $ritual->windowSignalSlept) >= 30)
                                                        <span class="new badge green" data-badge-caption="min">
                                                            {{ $ritual->window - $ritual->windowSignalSlept }}</span>
                                                    @else
                                                        <span class="new badge red" data-badge-caption="min">
                                                            {{ $ritual->window - $ritual->windowSignalSlept }} </span>
                                                    @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Tempo de Sinal de Sono Até iniciar Ritual</td>
                                                    
                                           
                                                       <td>
                                                   @if($ritual->windowSignalSlept >=35)
                                                     <span class="new badge red" data-badge-caption="min"> {{ $ritual->windowSignalSlept }} </span>
                                                    @endif

                                                     @if($ritual->windowSignalSlept < 35 &&  $ritual->windowSignalSlept >= 30)
                                                     <span class="new badge orange" data-badge-caption="min"> {{ $ritual->windowSignalSlept}} </span>
                                                    @endif

                                                      @if($ritual->windowSignalSlept < 30)
                                                    <span class="new badge green" data-badge-caption="min"> {{ $ritual->windowSignalSlept }} </span>
                                                    @endif
                                                     

                                                </td>

                                            </tr>
                                         </table>
                                        @endforeach
                                       
                                    </div>
                                </div>
                           </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col s12">
            <div id="input-fields" class="card card-tabs">
                <div class="card-content">
                    <div class="card-title">
                        <div class="row">
                            <h5>Análise</h5>
                            Sinais de sono: <textarea class="materialize-textarea">{{$sinais_sono_resposta}}</textarea><br>
                            Ritual do sono: (sonecas e sono noturno) <textarea class="materialize-textarea">{{$rituais_sono_resposta}}
                            </textarea>
                            Duração das sonecas: <textarea class="materialize-textarea">{{$duracao_sonecas_resposta}}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@section('js')

<script>
$(document).ready(function(){
    $('.modal').modal({
       
    });
    $('#modal1').modal('open');

    

  });
  </script>

@endsection