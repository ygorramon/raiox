@extends('site.desafio.layouts.app')
@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
@stop



@section('content')




    <div class="row">
        <div class="col s12">
        <div id="modal1" class="modal">
        <div class="modal-content">
          <h4>PASSO 1 - VÍDEO EXPLICATIVO</h4>
          <div class="video-container">
          <iframe height="250"  src="https://www.youtube.com/embed/heyGFKnpYP0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>

        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </div>
      </div>

            <div class="card">
                @if ($errors->any())
                <div class="row">
                    <div class="col s12">

                        <div class="card-panel red">
                            <span class="white-text">
                                @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                                @endforeach</span>
                        </div>
                    </div>
                </div>

                @endif
                <div class="card-content pb-0">
                    <div class="card-header mb-2">

                        <h4 class="card-title">Dia {{$day}}</h4>
                    </div>
                    <form action="{{route('analyze.store', [$challenge->id, $day])}}" method="POST" id="form">
                        @csrf
                        <ul class="stepper horizontal" id="horizStepper">
                            <li class="step active">
                                <div class="step-title waves-effect">Informações </div>
                               <div class="step-content" id="step-avaliacao">
    <div class="row">
        <div class="input-field col m6 s12">
    <input type="text" id="date" name="date"
        @if (isset($challenge->analyzes()->where('day', $day)->first()->dados()->first()->date))
            value="{{ old('date', formatDateAndTime($challenge->analyzes()->where('day', $day)->first()->dados()->first()->date)) }}"
        @else
            value="{{ old('date') }}"
        @endif
        class="datepicker">
    <label for="date">Data da Avaliação</label>
</div>

        <div class="input-field col m6 s12">
            <input id="timeWokeUp" type="text" name="timeWokeUp"
                @if (isset($challenge->analyzes()->where('day', $day)->first()->dados()->first()->timeWokeUp))
                    value="{{ old('timeWokeUp', getAnalyzedTime($challenge, $day)) }}"
                @else
                    value="{{ old('timeWokeUp') }}"
                @endif
                class="timepicker">
            <label for="timeWokeUp">Horário que Acordou</label>
        </div>
    </div>

    <div class="row">
        <div class="input-field col m6 s12">
            <div class="switch">
                <label>
                    Efeito Vulcânico?: Não
                    <input type="checkbox" name="volcanicEffect" value="S" @if(old('volcanicEffect') == "S") checked @endif>
                    <span class="lever"></span>
                    Sim
                </label>
            </div>
        </div>
    </div>

    <div class="step-actions">
        <div class="row">
            <div class="col m3 s12 mb-4">
                <button class="red btn btn-reset" type="reset">
                    Reset
                    <i class="material-icons left">clear</i>
                </button>
            </div>

            <div class="col m3 s12 mb-4">
                <button type="button" id="btn-clear-avaliacao" class="btn grey">
                    Apagar
                    <i class="material-icons left">delete</i>
                </button>
            </div>

            <div class="col m3 s12 mb-4">
                <button class="btn btn-light previous-step" disabled>
                    <i class="material-icons left">arrow_back</i>
                    Prev
                </button>
            </div>
            <div class="col m3 s12 mb-4">
                <button class="waves-effect waves dark btn btn-primary next-step" type="submit">
                    Next
                    <i class="material-icons right">arrow_forward</i>
                </button>
            </div>
        </div>
    </div>
</div>
                            </li>
                            <li class="step">
                                <div class="step-title waves-effect">Rotina de Sonecas</div>
                                <div class="step-content">
                                    <div class="row soneca1-section">
                                        <div class="card card card-default scrollspy">

                                            <div class="card-content">
                                                <h5>Soneca 1</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="time" name="soneca1_ss" 
                                                       @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_signalSlept_1
)
) 
                                                        value="{{old('soneca1_ss', getAnalyzedTime($challenge, $day, 'nap_signalSlept_1')) }}"
                                                        @else
                                                        value="{{old('soneca1_ss')}}"
                                                        @endif
                                                        class="timepicker">
                                                        <label for="soneca1_ss">Horário que sentiu sono</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="soneca1_hd" name="soneca1_hd"
                                                         @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_timeSlept_1
)
) 
                                                        value="{{ old('soneca1_hd', getAnalyzedTime($challenge, $day, 'nap_timeSlept_1')) }}"
                                                        @else
                                                        value="{{ old('soneca1_hd') }}"
                                                        @endif
                                                        class="timepicker">
                                                        <label for="soneca1_hd">Horário que dormiu</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text"  name="soneca1_ha" 
                                                         @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_timeWokeUp_1
)
) 
                                                        value="{{ old('soneca1_ha', getAnalyzedTime($challenge, $day, 'nap_timeWokeUp_1')) }}"
                                                        @else
                                                        value="{{ old('soneca1_ha') }}"
                                                        @endif
                                                         class="timepicker">
                                                        <label for="soneca1_ha">Horário que acordou</label>

                                                    </div>
                                                     <div class="input-field col m2 s12">
                                                            <label>Onde dormiu?</label>
                                                           <br>

                                                            <select class="browser-default" name="soneca1_onde_dormiu">
                                                                <option value="" disabled selected>Escolha onde dormiu</option>
                                                                <option
                                                                 @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_1
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_1 == "colo"
)
                                                        selected value="colo"
                                                        @else
                                                                value="colo" {{ old('soneca1_onde_dormiu') == 'colo' ? 'selected' : '' }}
                                                                @endif
                                                                >Colo</option>
                                                                 <option
                                                                 @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_1
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_1 == "berco"
)
                                                        selected value="berco"
                                                        @else
                                                                value="berco" {{ old('soneca1_onde_dormiu') == 'berco' ? 'selected' : '' }}
                                                                @endif >Berço</option>
                                                                <option
                                                                 @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_1
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_1 == "cama_compartilhada"
)
                                                        selected value="cama_compartilhada"
                                                        @else
                                                                value="cama_compartilhada" {{ old('soneca1_onde_dormiu') == 'cama_compartilhada' ? 'selected' : '' }}
                                                                @endif >Cama Compartilhada</option>
                                                                <option    @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_1
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_1 == "carrinho"
)
                                                        selected value="carrinho"
                                                        @else
                                                                value="carrinho" {{ old('soneca1_onde_dormiu') == 'carrinho' ? 'selected' : '' }}
                                                                @endif>Carrinho</option>
                                                            </select>

                                                        </div>

                                                        <div class="input-field col m1 s12">
                                                            <div class="switch">
                                                                <label>
                                                                    Precisou intervir para prolongar a soneca?


                                                                    <input type="checkbox" name="soneca1_prolongada" value="1" 
                                                                     @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_prolongada_1
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_prolongada_1 == 1
)
                                                                            checked
                                                                            @endif
                                                                    >
                                                                    <span class="lever"></span>

                                                                </label>
                                                            </div>
                                                        </div>
                                                        <!-- Botão de limpar -->
                                                        <div class="row">
                                                            <div class="col s12">
                                                                <button type="button" class="btn red lighten-1 clear-soneca1">
                                                                    Limpar Soneca 1
                                                                </button>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                   <div class="row soneca2-section">
                                        <div class="card card card-default scrollspy">

                                            <div class="card-content">
                                                <h5>Soneca 2</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="time" name="soneca2_ss" 
                                                       @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_signalSlept_2
)
) 
                                                        value="{{old('soneca2_ss', getAnalyzedTime($challenge, $day, 'nap_signalSlept_2')) }}"
                                                        @else
                                                        value="{{old('soneca2_ss')}}"
                                                        @endif
                                                        class="timepicker">
                                                        <label for="soneca2_ss">Horário que sentiu sono</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="soneca2_hd" name="soneca2_hd"
                                                         @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_timeSlept_2
)
) 
                                                        value="{{ old('soneca2_hd', getAnalyzedTime($challenge, $day, 'nap_timeSlept_2')) }}"
                                                        @else
                                                        value="{{ old('soneca2_hd') }}"
                                                        @endif
                                                        class="timepicker">
                                                        <label for="soneca2_hd">Horário que dormiu</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text"  name="soneca2_ha" 
                                                         @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_timeWokeUp_2
)
) 
                                                        value="{{ old('soneca2_ha', getAnalyzedTime($challenge, $day, 'nap_timeWokeUp_2')) }}"
                                                        @else
                                                        value="{{ old('soneca2_ha') }}"
                                                        @endif
                                                         class="timepicker">
                                                        <label for="soneca2_ha">Horário que acordou</label>

                                                    </div>
                                                     <div class="input-field col m2 s12">
                                                            <label>Onde dormiu?</label>
                                                           <br>

                                                            <select class="browser-default" name="soneca2_onde_dormiu">
                                                                <option value="" disabled selected>Escolha onde dormiu</option>
                                                                <option
                                                                 @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_2
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_2 == "colo"
)
                                                        selected value="colo"
                                                        @else
                                                                value="colo" {{ old('soneca2_onde_dormiu') == 'colo' ? 'selected' : '' }}
                                                                @endif
                                                                >Colo</option>
                                                                 <option
                                                                 @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_2
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_2 == "berco"
)
                                                        selected value="berco"
                                                        @else
                                                                value="berco" {{ old('soneca2_onde_dormiu') == 'berco' ? 'selected' : '' }}
                                                                @endif >Berço</option>
                                                                <option
                                                                 @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_2
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_2 == "cama_compartilhada"
)
                                                        selected value="cama_compartilhada"
                                                        @else
                                                                value="cama_compartilhada" {{ old('soneca2_onde_dormiu') == 'cama_compartilhada' ? 'selected' : '' }}
                                                                @endif >Cama Compartilhada</option>
                                                                <option    @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_2
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_2 == "carrinho"
)
                                                        selected value="carrinho"
                                                        @else
                                                                value="carrinho" {{ old('soneca2_onde_dormiu') == 'carrinho' ? 'selected' : '' }}
                                                                @endif>Carrinho</option>
                                                            </select>

                                                        </div>

                                                        <div class="input-field col m1 s12">
                                                            <div class="switch">
                                                                <label>
                                                                    Precisou intervir para prolongar a soneca?


                                                                    <input type="checkbox" name="soneca2_prolongada" value="1" 
                                                                     @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_prolongada_2
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_prolongada_2 == 1
)
                                                                            checked
                                                                            @endif
                                                                    >
                                                                    <span class="lever"></span>

                                                                </label>
                                                            </div>
                                                        </div>
                                                         <div class="row">
                                                            <div class="col s12">
                                                                <button type="button" class="btn red lighten-1 clear-soneca2">
                                                                    Limpar Soneca 2
                                                                </button>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                     <div class="row soneca3-section">
                                        <div class="card card card-default scrollspy">

                                            <div class="card-content">
                                                <h5>Soneca 3</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="time" name="soneca3_ss" 
                                                       @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_signalSlept_3
)
) 
                                                        value="{{old('soneca3_ss', getAnalyzedTime($challenge, $day, 'nap_signalSlept_3')) }}"
                                                        @else
                                                        value="{{old('soneca3_ss')}}"
                                                        @endif
                                                        class="timepicker">
                                                        <label for="soneca3_ss">Horário que sentiu sono</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="soneca3_hd" name="soneca3_hd"
                                                         @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_timeSlept_3
)
) 
                                                        value="{{ old('soneca3_hd', getAnalyzedTime($challenge, $day, 'nap_timeSlept_3')) }}"
                                                        @else
                                                        value="{{ old('soneca3_hd') }}"
                                                        @endif
                                                        class="timepicker">
                                                        <label for="soneca3_hd">Horário que dormiu</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text"  name="soneca3_ha" 
                                                         @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_timeWokeUp_3
)
) 
                                                        value="{{ old('soneca3_ha', getAnalyzedTime($challenge, $day, 'nap_timeWokeUp_3')) }}"
                                                        @else
                                                        value="{{ old('soneca3_ha') }}"
                                                        @endif
                                                         class="timepicker">
                                                        <label for="soneca3_ha">Horário que acordou</label>

                                                    </div>
                                                     <div class="input-field col m2 s12">
                                                            <label>Onde dormiu?</label>
                                                           <br>

                                                            <select class="browser-default" name="soneca3_onde_dormiu">
                                                                <option value="" disabled selected>Escolha onde dormiu</option>
                                                                <option
                                                                 @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_3
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_3 == "colo"
)
                                                        selected  value="colo"
                                                        @else
                                                                value="colo" {{ old('soneca3_onde_dormiu') == 'colo' ? 'selected' : '' }}
                                                                @endif
                                                                >Colo</option>
                                                                 <option
                                                                 @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_3
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_3 == "berco"
)
                                                        selected value="berco"
                                                        @else
                                                                value="berco" {{ old('soneca3_onde_dormiu') == 'berco' ? 'selected' : '' }}
                                                                @endif >Berço</option>
                                                                <option
                                                                 @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_3
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_3 == "cama_compartilhada"
)
                                                        selected  value="cama_compartilhada"
                                                        @else
                                                                value="cama_compartilhada" {{ old('soneca3_onde_dormiu') == 'cama_compartilhada' ? 'selected' : '' }}
                                                                @endif >Cama Compartilhada</option>
                                                                <option    @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_3
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_3 == "carrinho"
)
                                                        selected  value="carrinho"
                                                        @else
                                                                value="carrinho" {{ old('soneca3_onde_dormiu') == 'carrinho' ? 'selected' : '' }}
                                                                @endif>Carrinho</option>
                                                            </select>

                                                        </div>

                                                        <div class="input-field col m1 s12">
                                                            <div class="switch">
                                                                <label>
                                                                    Precisou intervir para prolongar a soneca?


                                                                    <input type="checkbox" name="soneca3_prolongada" value="1" 
                                                                     @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_prolongada_3
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_prolongada_3 == 1
)
                                                                            checked
                                                                            @endif
                                                                    >
                                                                    <span class="lever"></span>

                                                                </label>
                                                            </div>
                                                        </div>
                                                         <div class="row">
                                                            <div class="col s12">
                                                                <button type="button" class="btn red lighten-1 clear-soneca3">
                                                                    Limpar Soneca 3
                                                                </button>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row soneca4-section">
                                        <div class="card card card-default scrollspy">

                                            <div class="card-content">
                                                <h5>Soneca 4</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="time" name="soneca4_ss" 
                                                       @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_signalSlept_4
)
) 
                                                        value="{{old('soneca4_ss', getAnalyzedTime($challenge, $day, 'nap_signalSlept_4')) }}"
                                                        @else
                                                        value="{{old('soneca4_ss')}}"
                                                        @endif
                                                        class="timepicker">
                                                        <label for="soneca4_ss">Horário que sentiu sono</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="soneca4_hd" name="soneca4_hd"
                                                         @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_timeSlept_4
)
) 
                                                        value="{{ old('soneca4_hd', getAnalyzedTime($challenge, $day, 'nap_timeSlept_4')) }}"
                                                        @else
                                                        value="{{ old('soneca4_hd') }}"
                                                        @endif
                                                        class="timepicker">
                                                        <label for="soneca4_hd">Horário que dormiu</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text"  name="soneca4_ha" 
                                                         @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_timeWokeUp_4
)
) 
                                                        value="{{ old('soneca4_ha', getAnalyzedTime($challenge, $day, 'nap_timeWokeUp_4')) }}"
                                                        @else
                                                        value="{{ old('soneca4_ha') }}"
                                                        @endif
                                                         class="timepicker">
                                                        <label for="soneca4_ha">Horário que acordou</label>

                                                    </div>
                                                     <div class="input-field col m2 s12">
                                                            <label>Onde dormiu?</label>
                                                           <br>

                                                            <select class="browser-default" name="soneca4_onde_dormiu">
                                                                <option value="" disabled selected>Escolha onde dormiu</option>
                                                                <option
                                                                 @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_4
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_4 == "colo"
)
                                                        selected value="colo"
                                                        @else
                                                                value="colo" {{ old('soneca4_onde_dormiu') == 'colo' ? 'selected' : '' }}
                                                                @endif
                                                                >Colo</option>
                                                                 <option
                                                                 @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_4
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_4 == "berco"
)
                                                        selected value="berco"
                                                        @else
                                                                value="berco" {{ old('soneca4_onde_dormiu') == 'berco' ? 'selected' : '' }}
                                                                @endif >Berço</option>
                                                                <option
                                                                 @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_4
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_4 == "cama_compartilhada"
)
                                                        selected value="cama_compartilhada" 
                                                        @else
                                                                value="cama_compartilhada" {{ old('soneca4_onde_dormiu') == 'cama_compartilhada' ? 'selected' : '' }}
                                                                @endif >Cama Compartilhada</option>
                                                                <option    @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_4
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_4 == "carrinho"
)
                                                        selected  value="carrinho"
                                                        @else
                                                                value="carrinho" {{ old('soneca4_onde_dormiu') == 'carrinho' ? 'selected' : '' }}
                                                                @endif>Carrinho</option>
                                                            </select>

                                                        </div>

                                                        <div class="input-field col m1 s12">
                                                            <div class="switch">
                                                                <label>
                                                                    Precisou intervir para prolongar a soneca?


                                                                    <input type="checkbox" name="soneca4_prolongada" value="1" 
                                                                     @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_prolongada_4
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_prolongada_4 == 1
)
                                                                            checked
                                                                            @endif
                                                                    >
                                                                    <span class="lever"></span>

                                                                </label>
                                                            </div>
                                                        </div>
                                                         <div class="row">
                                                            <div class="col s12">
                                                                <button type="button" class="btn red lighten-1 clear-soneca4">
                                                                    Limpar Soneca 4
                                                                </button>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                      <div class="row soneca5-section">
                                        <div class="card card card-default scrollspy">

                                            <div class="card-content">
                                                <h5>Soneca 5</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="time" name="soneca5_ss" 
                                                       @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_signalSlept_5
)
) 
                                                        value="{{old('soneca5_ss', getAnalyzedTime($challenge, $day, 'nap_signalSlept_5')) }}"
                                                        @else
                                                        value="{{old('soneca5_ss')}}"
                                                        @endif
                                                        class="timepicker">
                                                        <label for="soneca5_ss">Horário que sentiu sono</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="soneca5_hd" name="soneca5_hd"
                                                         @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_timeSlept_5
)
) 
                                                        value="{{ old('soneca5_hd', getAnalyzedTime($challenge, $day, 'nap_timeSlept_5')) }}"
                                                        @else
                                                        value="{{ old('soneca5_hd') }}"
                                                        @endif
                                                        class="timepicker">
                                                        <label for="soneca5_hd">Horário que dormiu</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text"  name="soneca5_ha" 
                                                         @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_timeWokeUp_5
)
) 
                                                        value="{{ old('soneca5_ha', getAnalyzedTime($challenge, $day, 'nap_timeWokeUp_5')) }}"
                                                        @else
                                                        value="{{ old('soneca5_ha') }}"
                                                        @endif
                                                         class="timepicker">
                                                        <label for="soneca5_ha">Horário que acordou</label>

                                                    </div>
                                                     <div class="input-field col m2 s12">
                                                            <label>Onde dormiu?</label>
                                                           <br>

                                                            <select class="browser-default" name="soneca5_onde_dormiu">
                                                                <option value="" disabled selected>Escolha onde dormiu</option>
                                                                <option
                                                                 @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_5
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_5 == "colo"
)
                                                        selected value="colo"
                                                        @else
                                                                value="colo" {{ old('soneca5_onde_dormiu') == 'colo' ? 'selected' : '' }}
                                                                @endif
                                                                >Colo</option>
                                                                 <option
                                                                 @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_5
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_5 == "berco"
)
                                                        selected  value="berco"
                                                        @else
                                                                value="berco" {{ old('soneca5_onde_dormiu') == 'berco' ? 'selected' : '' }}
                                                                @endif >Berço</option>
                                                                <option
                                                                 @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_5
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_5 == "cama_compartilhada"
)
                                                        selected value="cama_compartilhada"
                                                        @else
                                                                value="cama_compartilhada" {{ old('soneca5_onde_dormiu') == 'cama_compartilhada' ? 'selected' : '' }}
                                                                @endif >Cama Compartilhada</option>
                                                                <option    @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_5
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_5 == "carrinho"
)
                                                        selected  value="carrinho"
                                                        @else
                                                                value="carrinho" {{ old('soneca5_onde_dormiu') == 'carrinho' ? 'selected' : '' }}
                                                                @endif>Carrinho</option>
                                                            </select>

                                                        </div>

                                                        <div class="input-field col m1 s12">
                                                            <div class="switch">
                                                                <label>
                                                                    Precisou intervir para prolongar a soneca?


                                                                    <input type="checkbox" name="soneca5_prolongada" value="1" 
                                                                     @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_prolongada_5
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_prolongada_5 == 1
)
                                                                            checked
                                                                            @endif
                                                                    >
                                                                    <span class="lever"></span>

                                                                </label>
                                                            </div>
                                                        </div>
                                                         <div class="row">
                                                            <div class="col s12">
                                                                <button type="button" class="btn red lighten-1 clear-soneca5">
                                                                    Limpar Soneca 5
                                                                </button>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                     <div class="row soneca6-section">
                                        <div class="card card card-default scrollspy">

                                            <div class="card-content">
                                                <h5>Soneca 6</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="time" name="soneca6_ss" 
                                                       @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_signalSlept_6
)
) 
                                                        value="{{old('soneca6_ss', getAnalyzedTime($challenge, $day, 'nap_signalSlept_6')) }}"
                                                        @else
                                                        value="{{old('soneca6_ss')}}"
                                                        @endif
                                                        class="timepicker">
                                                        <label for="soneca6_ss">Horário que sentiu sono</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="soneca6_hd" name="soneca6_hd"
                                                         @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_timeSlept_6
)
) 
                                                        value="{{ old('soneca6_hd', getAnalyzedTime($challenge, $day, 'nap_timeSlept_6')) }}"
                                                        @else
                                                        value="{{ old('soneca6_hd') }}"
                                                        @endif
                                                        class="timepicker">
                                                        <label for="soneca6_hd">Horário que dormiu</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text"  name="soneca6_ha" 
                                                         @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_timeWokeUp_6
)
) 
                                                        value="{{ old('soneca6_ha', getAnalyzedTime($challenge, $day, 'nap_timeWokeUp_6')) }}"
                                                        @else
                                                        value="{{ old('soneca6_ha') }}"
                                                        @endif
                                                         class="timepicker">
                                                        <label for="soneca6_ha">Horário que acordou</label>

                                                    </div>
                                                     <div class="input-field col m2 s12">
                                                            <label>Onde dormiu?</label>
                                                           <br>

                                                            <select class="browser-default" name="soneca6_onde_dormiu">
                                                                <option value="" disabled selected>Escolha onde dormiu</option>
                                                                <option
                                                                 @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_6
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_6 == "colo"
)
                                                        selected value="colo"
                                                        @else
                                                                value="colo" {{ old('soneca6_onde_dormiu') == 'colo' ? 'selected' : '' }}
                                                                @endif
                                                                >Colo</option>
                                                                 <option
                                                                 @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_6
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_6 == "berco"
)
                                                        selected value="berco"
                                                        @else
                                                                value="berco" {{ old('soneca6_onde_dormiu') == 'berco' ? 'selected' : '' }}
                                                                @endif >Berço</option>
                                                                <option
                                                                 @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_6
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_6 == "cama_compartilhada"
)
                                                        selected value="cama_compartilhada"
                                                        @else
                                                                value="cama_compartilhada" {{ old('soneca6_onde_dormiu') == 'cama_compartilhada' ? 'selected' : '' }}
                                                                @endif >Cama Compartilhada</option>
                                                                <option    @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_6
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_onde_dormiu_6 == "carrinho"
)
                                                        selected  value="carrinho"
                                                        @else
                                                                value="carrinho" {{ old('soneca6_onde_dormiu') == 'carrinho' ? 'selected' : '' }}
                                                                @endif>Carrinho</option>
                                                            </select>

                                                        </div>

                                                        <div class="input-field col m1 s12">
                                                            <div class="switch">
                                                                <label>
                                                                    Precisou intervir para prolongar a soneca?


                                                                    <input type="checkbox" name="soneca6_prolongada" value="1" 
                                                                     @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_prolongada_6
)
    &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->nap_prolongada_6 == 1
)
                                                                            checked
                                                                            @endif
                                                                    >
                                                                    <span class="lever"></span>

                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col s12">
                                                                <button type="button" class="btn red lighten-1 clear-soneca6">
                                                                    Limpar Soneca 6
                                                                </button>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <!-- 
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Soneca 2</h5>
                                                <div class="row">
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="time" name="soneca2_ss" value="{{ old('soneca2_ss') }}" class="timepicker">
                                                        <label for="soneca2_ss">Horário que sentiu sono</label>

                                                    </div>
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="soneca1_hd" name="soneca2_hd" value="{{ old('soneca2_hd') }}" class="timepicker">
                                                        <label for="soneca2_hd">Horário que dormiu</label>

                                                    </div>
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="time" name="soneca2_ha" value="{{ old('soneca2_ha') }}" class="timepicker">
                                                        <label for="soneca2_ha">Horário que acordou</label>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Soneca 3</h5>
                                                <div class="row">
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="time" name="soneca3_ss" value="{{ old('soneca3_ss') }}" class="timepicker">
                                                        <label for="soneca3_ss">Horário que sentiu sono</label>

                                                    </div>
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="soneca1_hd" name="soneca3_hd" value="{{ old('soneca3_hd') }}" class="timepicker">
                                                        <label for="soneca3_hd">Horário que dormiu</label>

                                                    </div>
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="time" name="soneca3_ha" value="{{ old('soneca3_ha') }}" class="timepicker">
                                                        <label for="soneca3_ha">Horário que acordou</label>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Soneca 4</h5>
                                                <div class="row">
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="time" name="soneca4_ss" value="{{ old('soneca4_ss') }}" class="timepicker">
                                                        <label for="soneca4_ss">Horário que sentiu sono</label>

                                                    </div>
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="soneca1_hd" name="soneca4_hd" value="{{ old('soneca4_hd') }}" class="timepicker">
                                                        <label for="soneca4_hd">Horário que dormiu</label>

                                                    </div>
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="time" name="soneca4_ha" value="{{ old('soneca4_ha') }}" class="timepicker">
                                                        <label for="soneca4_ha">Horário que acordou</label>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Soneca 5</h5>
                                                <div class="row">
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="time" name="soneca5_ss" value="{{ old('soneca5_ss') }}" class="timepicker">
                                                        <label for="soneca5_ss">Horário que sentiu sono</label>

                                                    </div>
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="soneca1_hd" name="soneca5_hd" value="{{ old('soneca5_hd') }}" class="timepicker">
                                                        <label for="soneca5_hd">Horário que dormiu</label>

                                                    </div>
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="time" name="soneca5_ha" value="{{ old('soneca5_ha') }}" class="timepicker">
                                                        <label for="soneca5_ha">Horário que acordou</label>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Soneca 6</h5>
                                                <div class="row">
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="time" name="soneca6_ss" value="{{ old('soneca6_ss') }}" class="timepicker">
                                                        <label for="soneca6_ss">Horário que sentiu sono</label>

                                                    </div>
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="soneca1_hd" name="soneca6_hd" value="{{ old('soneca6_hd') }}"  class="timepicker">
                                                        <label for="soneca6_hd">Horário que dormiu</label>

                                                    </div>
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="time" name="soneca6_ha" value="{{ old('soneca6_ha') }}" class="timepicker">
                                                        <label for="soneca6_ha">Horário que acordou</label>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                -->
                                    <div class="row">
                                        <div class="step-actions" style="position:relative">
                                            <div class="row">
                                                <div class="col m4 s12 mb-3">
                                                    <button class="red btn btn-reset" type="reset">
                                                        <i class="material-icons left">clear</i>Reset
                                                    </button>
                                                </div>
                                                <div class="col m4 s12 mb-3">
                                                    <button class="btn btn-light previous-step">
                                                        <i class="material-icons left">arrow_back</i>
                                                        Prev
                                                    </button>
                                                </div>
                                                <div class="col m4 s12 mb-3">
                                                    <button class="waves-effect waves dark btn btn-primary next-step" type="submit">
                                                        Next
                                                        <i class="material-icons right">arrow_forward</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="step">
                                <div class="step-title waves-effect">Ritual Noturno</div>
                                <div class="step-content">
                                    <div class="row section-ritual">
                                        <div class="card card card-default scrollspy">

                                            <div class="card-content">
                                                <h5>Ritual / Observações</h5>
                                                <div class="row">
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="ritual_ss" name="ritual_ss"
                                                        @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->ritual_signalSlept
)
) 
                                                        value="{{old('ritual_ss', getAnalyzedTime($challenge, $day, 'ritual_signalSlept')) }}"
                                                        @else
                                                        value="{{ old('ritual_ss') }}" 
                                                        @endif
                                                        class="timepicker">
                                                        <label for="ritual_ss">Horário que sentiu sono</label>

                                                    </div>
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="time" name="ritual_in"
                                                         @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->ritual_start
)
) 
                                                        value="{{ old('ritual_in', getAnalyzedTime($challenge, $day, 'ritual_start')) }}"
                                                        @else
                                                         value="{{ old('ritual_in') }}"
                                                      @endif 
                                                         class="timepicker">
                                                        <label for="ritual_in">Horário que iniciou</label>

                                                    </div>
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="ritual_d" name="ritual_d"
                                                          @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->ritual_end
)
) 
                                                        value="{{ old('ritual_d', getAnalyzedTime($challenge, $day, 'ritual_end')) }}"
                                                        @else value="{{ old('ritual_d') }}"
    @endif
                                                         class="timepicker">
                                                        <label for="ritual_d">Horário que dormiu</label>

                                                    </div>

                                                </div>
                                                 <div class="row">
                                                        <div class="input-field col s12">
                                                            <label> Observação sobre o dia.</label>
                                                            <br>
                                                                <textarea class="materialize-textarea" id="observacao" name="observacao" maxlength="200"
                                                                    data-length="200">@if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->observacoes
)
) {{ $challenge->analyzes()->where('day', $day)->first()->dados()->first()->observacoes}} @endif </textarea>                         
                                                            </div>
                                                            </div>
                                                             <div class="row">
                                                            <div class="col s12">
                                                                <button type="button" class="btn red lighten-1 clear-ritual">
                                                                    Limpar Ritual
                                                                </button>
                                                            </div>
                                                        </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 1</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar1_a" name="despertar1_a"
                                                          @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeWokeUp1
)
) 
                                                        value="{{ old('despertar1_a', getAnalyzedTime($challenge, $day, 'wake_timeWokeUp1')) }}"
                                                        @else
                                                        value="{{ old('despertar1_a') }}"
                                                        @endif class="timepicker">
                                                        <label for="despertar1_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar1_d" name="despertar1_d"
                                                          @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeSlept1
)
) 
                                                        value="{{ old('despertar1_d', getAnalyzedTime($challenge, $day, 'wake_timeSlept1')) }}"
                                                        @else
                                                        value="{{ old('despertar1_d') }}" 
                                                        @endif
                                                        class="timepicker">
                                                        <label for="despertar1_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                    <br>
                                                        <select class="browser-default" name="despertar1_fd" id="despertar1_fd">
                                                            <option  value="" disabled selected>Selecione uma opção</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode1
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode1 == 1
) 
                                                                            selected
                                                                            @else
                                                                            {{ old('despertar1_fd') == 2 ? "selected" : "" }}
                                                                            @endif
                                                             value="1">Sozinho</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode1
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode1 == 2
) 
                                                                            selected
                                                                            @else {{ old('despertar1_fd') == 2 ? "selected" : "" }} @endif  value="2">Ninando no berço/cama</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode1
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode1 == 3
) 
                                                                            selected
                                                                            @else {{ old('despertar1_fd') == 3 ? "selected" : "" }} @endif value="3">Mamando</option>


                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode1
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode1) == false
) 
                                                                            selected
                                                                            @else {{  is_numeric(old('despertar1_fd') == false) ? "selected" : "" }}@endif value="4">Outro</option>
                                                        </select>

                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar1_fd_outro">
                                                        <input  type="text" id="despertar1_fd_outro" name=" despertar1_fd_outro"
                                                        @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode1
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode1) == false
)

                                                        value="{{ old('wake_sleepingMode1', getAnalyzedTime($challenge, $day, 'wake_sleepingMode1')) }}"
                                                        @else
                                                        {{old('despertar1_fd_outro')}}
                                                        @endif
                                                        >
                                                        <label for="despertar1_fd_outro">Como Dormiu</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                     <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 2</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar2_a" name="despertar2_a"
                                                          @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeWokeUp2
)
) 
                                                        value="{{ old('despertar2_a', getAnalyzedTime($challenge, $day, 'wake_timeWokeUp2')) }}"
                                                        @else
                                                        value="{{ old('despertar2_a') }}"
                                                        @endif class="timepicker">
                                                        <label for="despertar2_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar2_d" name="despertar2_d"
                                                          @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeSlept2
)
) 
                                                        value="{{ old('despertar2_d', getAnalyzedTime($challenge, $day, 'wake_timeSlept2')) }}"
                                                        @else
                                                        value="{{ old('despertar2_d') }}" 
                                                        @endif
                                                        class="timepicker">
                                                        <label for="despertar2_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                    <br>
                                                        <select class="browser-default" name="despertar2_fd" id="despertar2_fd">
                                                            <option  value="" disabled selected>Selecione uma opção</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode2
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode2 == 1
) 
                                                                            selected
                                                                            @else
                                                                            {{ old('despertar2_fd') == 2 ? "selected" : "" }}
                                                                            @endif
                                                             value="1">Sozinho</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode2
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode2 == 2
) 
                                                                            selected
                                                                            @else {{ old('despertar2_fd') == 2 ? "selected" : "" }} @endif  value="2">Ninando no berço/cama</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode2
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode2 == 3
) 
                                                                            selected
                                                                            @else {{ old('despertar2_fd') == 3 ? "selected" : "" }} @endif value="3">Mamando</option>


                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode2
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode2) == false
) 
                                                                            selected
                                                                            @else {{  is_numeric(old('despertar2_fd') == false) ? "selected" : "" }}@endif value="4">Outro</option>
                                                        </select>

                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar2_fd_outro">
                                                        <input  type="text" id="despertar2_fd_outro" name=" despertar2_fd_outro"
                                                        @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode2
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode2) == false
)

                                                        value="{{ old('wake_sleepingMode2', getAnalyzedTime($challenge, $day, 'wake_sleepingMode2')) }}"
                                                        @else
                                                        {{old('despertar2_fd_outro')}}
                                                        @endif
                                                        >
                                                        <label for="despertar2_fd_outro">Como Dormiu</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                     <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 3</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar3_a" name="despertar3_a"
                                                          @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeWokeUp3
)
) 
                                                        value="{{ old('despertar3_a', getAnalyzedTime($challenge, $day, 'wake_timeWokeUp3')) }}"
                                                        @else
                                                        value="{{ old('despertar3_a') }}"
                                                        @endif class="timepicker">
                                                        <label for="despertar3_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar3_d" name="despertar3_d"
                                                          @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeSlept3
)
) 
                                                        value="{{ old('despertar3_d', getAnalyzedTime($challenge, $day, 'wake_timeSlept3')) }}"
                                                        @else
                                                        value="{{ old('despertar3_d') }}" 
                                                        @endif
                                                        class="timepicker">
                                                        <label for="despertar3_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                    <br>
                                                        <select class="browser-default" name="despertar3_fd" id="despertar3_fd">
                                                            <option  value="" disabled selected>Selecione uma opção</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode3
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode3 == 1
) 
                                                                            selected
                                                                            @else
                                                                            {{ old('despertar3_fd') == 2 ? "selected" : "" }}
                                                                            @endif
                                                             value="1">Sozinho</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode3
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode3 == 2
) 
                                                                            selected
                                                                            @else {{ old('despertar3_fd') == 2 ? "selected" : "" }} @endif  value="2">Ninando no berço/cama</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode3
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode3 == 3
) 
                                                                            selected
                                                                            @else {{ old('despertar3_fd') == 3 ? "selected" : "" }} @endif value="3">Mamando</option>


                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode3
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode3) == false
) 
                                                                            selected
                                                                            @else {{  is_numeric(old('despertar3_fd') == false) ? "selected" : "" }}@endif value="4">Outro</option>
                                                        </select>

                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar3_fd_outro">
                                                        <input  type="text" id="despertar3_fd_outro" name=" despertar3_fd_outro"
                                                        @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode3
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode3) == false
)

                                                        value="{{ old('wake_sleepingMode3', getAnalyzedTime($challenge, $day, 'wake_sleepingMode3')) }}"
                                                        @else
                                                        {{old('despertar3_fd_outro')}}
                                                        @endif
                                                        >
                                                        <label for="despertar3_fd_outro">Como Dormiu</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                     <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 4</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar4_a" name="despertar4_a"
                                                          @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeWokeUp4
)
) 
                                                        value="{{ old('despertar4_a', getAnalyzedTime($challenge, $day, 'wake_timeWokeUp4')) }}"
                                                        @else
                                                        value="{{ old('despertar4_a') }}"
                                                        @endif class="timepicker">
                                                        <label for="despertar4_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar4_d" name="despertar4_d"
                                                          @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeSlept4
)
) 
                                                        value="{{ old('despertar4_d', getAnalyzedTime($challenge, $day, 'wake_timeSlept4')) }}"
                                                        @else
                                                        value="{{ old('despertar4_d') }}" 
                                                        @endif
                                                        class="timepicker">
                                                        <label for="despertar4_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                    <br>
                                                        <select class="browser-default" name="despertar4_fd" id="despertar4_fd">
                                                            <option  value="" disabled selected>Selecione uma opção</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode4
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode4 == 1
) 
                                                                            selected
                                                                            @else
                                                                            {{ old('despertar4_fd') == 2 ? "selected" : "" }}
                                                                            @endif
                                                             value="1">Sozinho</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode4
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode4 == 2
) 
                                                                            selected
                                                                            @else {{ old('despertar4_fd') == 2 ? "selected" : "" }} @endif  value="2">Ninando no berço/cama</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode4
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode4 == 3
) 
                                                                            selected
                                                                            @else {{ old('despertar4_fd') == 3 ? "selected" : "" }} @endif value="3">Mamando</option>


                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode4
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode4) == false
) 
                                                                            selected
                                                                            @else {{  is_numeric(old('despertar4_fd') == false) ? "selected" : "" }}@endif value="4">Outro</option>
                                                        </select>

                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar4_fd_outro">
                                                        <input  type="text" id="despertar4_fd_outro" name=" despertar4_fd_outro"
                                                        @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode4
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode4) == false
)

                                                        value="{{ old('wake_sleepingMode4', getAnalyzedTime($challenge, $day, 'wake_sleepingMode4')) }}"
                                                        @else
                                                        {{old('despertar4_fd_outro')}}
                                                        @endif
                                                        >
                                                        <label for="despertar4_fd_outro">Como Dormiu</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                     <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 5</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar5_a" name="despertar5_a"
                                                          @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeWokeUp5
)
) 
                                                        value="{{ old('despertar5_a', getAnalyzedTime($challenge, $day, 'wake_timeWokeUp5')) }}"
                                                        @else
                                                        value="{{ old('despertar5_a') }}"
                                                        @endif class="timepicker">
                                                        <label for="despertar5_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar5_d" name="despertar5_d"
                                                          @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeSlept5
)
) 
                                                        value="{{ old('despertar5_d', getAnalyzedTime($challenge, $day, 'wake_timeSlept5')) }}"
                                                        @else
                                                        value="{{ old('despertar5_d') }}" 
                                                        @endif
                                                        class="timepicker">
                                                        <label for="despertar5_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                    <br>
                                                        <select class="browser-default" name="despertar5_fd" id="despertar5_fd">
                                                            <option  value="" disabled selected>Selecione uma opção</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode5
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode5 == 1
) 
                                                                            selected
                                                                            @else
                                                                            {{ old('despertar5_fd') == 2 ? "selected" : "" }}
                                                                            @endif
                                                             value="1">Sozinho</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode5
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode5 == 2
) 
                                                                            selected
                                                                            @else {{ old('despertar5_fd') == 2 ? "selected" : "" }} @endif  value="2">Ninando no berço/cama</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode5
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode5 == 3
) 
                                                                            selected
                                                                            @else {{ old('despertar5_fd') == 3 ? "selected" : "" }} @endif value="3">Mamando</option>


                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode5
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode5) == false
) 
                                                                            selected
                                                                            @else {{  is_numeric(old('despertar5_fd') == false) ? "selected" : "" }}@endif value="4">Outro</option>
                                                        </select>

                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar5_fd_outro">
                                                        <input  type="text" id="despertar5_fd_outro" name=" despertar5_fd_outro"
                                                        @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode5
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode5) == false
)

                                                        value="{{ old('wake_sleepingMode5', getAnalyzedTime($challenge, $day, 'wake_sleepingMode5')) }}"
                                                        @else
                                                        {{old('despertar5_fd_outro')}}
                                                        @endif
                                                        >
                                                        <label for="despertar5_fd_outro">Como Dormiu</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                     <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 6</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar6_a" name="despertar6_a"
                                                          @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeWokeUp6
)
) 
                                                        value="{{ old('despertar6_a', getAnalyzedTime($challenge, $day, 'wake_timeWokeUp6')) }}"
                                                        @else
                                                        value="{{ old('despertar6_a') }}"
                                                        @endif class="timepicker">
                                                        <label for="despertar6_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar6_d" name="despertar6_d"
                                                          @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeSlept6
)
) 
                                                        value="{{ old('despertar6_d', getAnalyzedTime($challenge, $day, 'wake_timeSlept6')) }}"
                                                        @else
                                                        value="{{ old('despertar6_d') }}" 
                                                        @endif
                                                        class="timepicker">
                                                        <label for="despertar6_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                    <br>
                                                        <select class="browser-default" name="despertar6_fd" id="despertar6_fd">
                                                            <option  value="" disabled selected>Selecione uma opção</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode6
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode6 == 1
) 
                                                                            selected
                                                                            @else
                                                                            {{ old('despertar6_fd') == 2 ? "selected" : "" }}
                                                                            @endif
                                                             value="1">Sozinho</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode6
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode6 == 2
) 
                                                                            selected
                                                                            @else {{ old('despertar6_fd') == 2 ? "selected" : "" }} @endif  value="2">Ninando no berço/cama</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode6
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode6 == 3
) 
                                                                            selected
                                                                            @else {{ old('despertar6_fd') == 3 ? "selected" : "" }} @endif value="3">Mamando</option>


                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode6
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode6) == false
) 
                                                                            selected
                                                                            @else {{  is_numeric(old('despertar6_fd') == false) ? "selected" : "" }}@endif value="4">Outro</option>
                                                        </select>

                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar6_fd_outro">
                                                        <input  type="text" id="despertar6_fd_outro" name=" despertar6_fd_outro"
                                                        @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode6
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode6) == false
)

                                                        value="{{ old('wake_sleepingMode6', getAnalyzedTime($challenge, $day, 'wake_sleepingMode6')) }}"
                                                        @else
                                                        {{old('despertar6_fd_outro')}}
                                                        @endif
                                                        >
                                                        <label for="despertar6_fd_outro">Como Dormiu</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                     <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 7</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar7_a" name="despertar7_a"
                                                          @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeWokeUp7
)
) 
                                                        value="{{ old('despertar7_a', getAnalyzedTime($challenge, $day, 'wake_timeWokeUp7')) }}"
                                                        @else
                                                        value="{{ old('despertar7_a') }}"
                                                        @endif class="timepicker">
                                                        <label for="despertar7_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar7_d" name="despertar7_d"
                                                          @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeSlept7
)
) 
                                                        value="{{ old('despertar7_d', getAnalyzedTime($challenge, $day, 'wake_timeSlept7')) }}"
                                                        @else
                                                        value="{{ old('despertar7_d') }}" 
                                                        @endif
                                                        class="timepicker">
                                                        <label for="despertar7_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                    <br>
                                                        <select class="browser-default" name="despertar7_fd" id="despertar7_fd">
                                                            <option  value="" disabled selected>Selecione uma opção</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode7
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode7 == 1
) 
                                                                            selected
                                                                            @else
                                                                            {{ old('despertar7_fd') == 2 ? "selected" : "" }}
                                                                            @endif
                                                             value="1">Sozinho</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode7
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode7 == 2
) 
                                                                            selected
                                                                            @else {{ old('despertar7_fd') == 2 ? "selected" : "" }} @endif  value="2">Ninando no berço/cama</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode7
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode7 == 3
) 
                                                                            selected
                                                                            @else {{ old('despertar7_fd') == 3 ? "selected" : "" }} @endif value="3">Mamando</option>


                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode7
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode7) == false
) 
                                                                            selected
                                                                            @else {{  is_numeric(old('despertar7_fd') == false) ? "selected" : "" }}@endif value="4">Outro</option>
                                                        </select>

                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar7_fd_outro">
                                                        <input  type="text" id="despertar7_fd_outro" name=" despertar7_fd_outro"
                                                        @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode7
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode7) == false
)

                                                        value="{{ old('wake_sleepingMode7', getAnalyzedTime($challenge, $day, 'wake_sleepingMode7')) }}"
                                                        @else
                                                        {{old('despertar7_fd_outro')}}
                                                        @endif
                                                        >
                                                        <label for="despertar7_fd_outro">Como Dormiu</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                     <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 8</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar8_a" name="despertar8_a"
                                                          @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeWokeUp8
)
) 
                                                        value="{{ old('despertar8_a', getAnalyzedTime($challenge, $day, 'wake_timeWokeUp8')) }}"
                                                        @else
                                                        value="{{ old('despertar8_a') }}"
                                                        @endif class="timepicker">
                                                        <label for="despertar8_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar8_d" name="despertar8_d"
                                                          @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeSlept8
)
) 
                                                        value="{{ old('despertar8_d', getAnalyzedTime($challenge, $day, 'wake_timeSlept8')) }}"
                                                        @else
                                                        value="{{ old('despertar8_d') }}" 
                                                        @endif
                                                        class="timepicker">
                                                        <label for="despertar8_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                    <br>
                                                        <select class="browser-default" name="despertar8_fd" id="despertar8_fd">
                                                            <option  value="" disabled selected>Selecione uma opção</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode8
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode8 == 1
) 
                                                                            selected
                                                                            @else
                                                                            {{ old('despertar8_fd') == 2 ? "selected" : "" }}
                                                                            @endif
                                                             value="1">Sozinho</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode8
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode8 == 2
) 
                                                                            selected
                                                                            @else {{ old('despertar8_fd') == 2 ? "selected" : "" }} @endif  value="2">Ninando no berço/cama</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode8
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode8 == 3
) 
                                                                            selected
                                                                            @else {{ old('despertar8_fd') == 3 ? "selected" : "" }} @endif value="3">Mamando</option>


                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode8
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode8) == false
) 
                                                                            selected
                                                                            @else {{  is_numeric(old('despertar8_fd') == false) ? "selected" : "" }}@endif value="4">Outro</option>
                                                        </select>

                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar8_fd_outro">
                                                        <input  type="text" id="despertar8_fd_outro" name=" despertar8_fd_outro"
                                                        @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode8
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode8) == false
)

                                                        value="{{ old('wake_sleepingMode8', getAnalyzedTime($challenge, $day, 'wake_sleepingMode8')) }}"
                                                        @else
                                                        {{old('despertar8_fd_outro')}}
                                                        @endif
                                                        >
                                                        <label for="despertar8_fd_outro">Como Dormiu</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                     <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 9</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar9_a" name="despertar9_a"
                                                          @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeWokeUp9
)
) 
                                                        value="{{ old('despertar9_a', getAnalyzedTime($challenge, $day, 'wake_timeWokeUp9')) }}"
                                                        @else
                                                        value="{{ old('despertar9_a') }}"
                                                        @endif class="timepicker">
                                                        <label for="despertar9_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar9_d" name="despertar9_d"
                                                          @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeSlept9
)
) 
                                                        value="{{ old('despertar9_d', getAnalyzedTime($challenge, $day, 'wake_timeSlept9')) }}"
                                                        @else
                                                        value="{{ old('despertar9_d') }}" 
                                                        @endif
                                                        class="timepicker">
                                                        <label for="despertar9_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                    <br>
                                                        <select class="browser-default" name="despertar9_fd" id="despertar9_fd">
                                                            <option  value="" disabled selected>Selecione uma opção</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode9
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode9 == 1
) 
                                                                            selected
                                                                            @else
                                                                            {{ old('despertar9_fd') == 2 ? "selected" : "" }}
                                                                            @endif
                                                             value="1">Sozinho</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode9
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode9 == 2
) 
                                                                            selected
                                                                            @else {{ old('despertar9_fd') == 2 ? "selected" : "" }} @endif  value="2">Ninando no berço/cama</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode9
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode9 == 3
) 
                                                                            selected
                                                                            @else {{ old('despertar9_fd') == 3 ? "selected" : "" }} @endif value="3">Mamando</option>


                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode9
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode9) == false
) 
                                                                            selected
                                                                            @else {{  is_numeric(old('despertar9_fd') == false) ? "selected" : "" }}@endif value="4">Outro</option>
                                                        </select>

                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar9_fd_outro">
                                                        <input  type="text" id="despertar9_fd_outro" name=" despertar9_fd_outro"
                                                        @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode9
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode9) == false
)

                                                        value="{{ old('wake_sleepingMode9', getAnalyzedTime($challenge, $day, 'wake_sleepingMode9')) }}"
                                                        @else
                                                        {{old('despertar9_fd_outro')}}
                                                        @endif
                                                        >
                                                        <label for="despertar9_fd_outro">Como Dormiu</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                     <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 10</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar10_a" name="despertar10_a"
                                                          @if (
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeWokeUp10
)
) 
                                                        value="{{ old('despertar10_a', getAnalyzedTime($challenge, $day, 'wake_timeWokeUp10')) }}"
                                                        @else
                                                        value="{{ old('despertar10_a') }}"
                                                        @endif class="timepicker">
                                                        <label for="despertar10_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar10_d" name="despertar10_d"
                                                          @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_timeSlept10
)
) 
                                                        value="{{ old('despertar10_d', getAnalyzedTime($challenge, $day, 'wake_timeSlept10')) }}"
                                                        @else
                                                        value="{{ old('despertar10_d') }}" 
                                                        @endif
                                                        class="timepicker">
                                                        <label for="despertar10_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                    <br>
                                                        <select class="browser-default" name="despertar10_fd" id="despertar10_fd">
                                                            <option  value="" disabled selected>Selecione uma opção</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode10
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode10 == 1
) 
                                                                            selected
                                                                            @else
                                                                            {{ old('despertar10_fd') == 2 ? "selected" : "" }}
                                                                            @endif
                                                             value="1">Sozinho</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode10
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode10 == 2
) 
                                                                            selected
                                                                            @else {{ old('despertar10_fd') == 2 ? "selected" : "" }} @endif  value="2">Ninando no berço/cama</option>
                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode10
) &&
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode10 == 3
) 
                                                                            selected
                                                                            @else {{ old('despertar10_fd') == 3 ? "selected" : "" }} @endif value="3">Mamando</option>


                                                            <option  @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode10
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode10) == false
) 
                                                                            selected
                                                                            @else {{  is_numeric(old('despertar10_fd') == false) ? "selected" : "" }}@endif value="4">Outro</option>
                                                        </select>

                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar10_fd_outro">
                                                        <input  type="text" id="despertar10_fd_outro" name=" despertar10_fd_outro"
                                                        @if(
    isset(
    $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode10
) &&
    is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode10) == false
)

                                                        value="{{ old('wake_sleepingMode10', getAnalyzedTime($challenge, $day, 'wake_sleepingMode10')) }}"
                                                        @else
                                                        {{old('despertar10_fd_outro')}}
                                                        @endif
                                                        >
                                                        <label for="despertar10_fd_outro">Como Dormiu</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <!--
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 2</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar2_a" name="despertar2_a"  value="{{ old('despertar2_a') }}" class="timepicker">
                                                        <label for="despertar2_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar2_d" name="despertar2_d" value="{{ old('despertar2_d') }}" class="timepicker">
                                                        <label for="despertar2_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                        <select class="browser-default" name="despertar2_fd" id="despertar2_fd">
                                                            <option  value="" disabled selected>Selecione uma opção</option>
                                                            <option {{ old('despertar2_fd')==1 ? "selected" : "" }} value="1">Sozinho</option>
                                                            <option {{ old('despertar2_fd')==2 ? "selected" : "" }} value="2">Ninando no berço/cama</option>
                                                            <option {{ old('despertar2_fd')==3 ? "selected" : "" }} value="3">Mamando</option>
                                                            <option {{ is_numeric(old('despertar2_fd')==false) ? "selected" : "" }} value="4">Outro</option>
                                                        </select>

                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar2_fd_outro">
                                                        <input type="text" id="despertar2_fd_outro"" value="{{ old('despertar2_fd_outro') }}" name=" despertar2_fd_outro">
                                                        <label for="despertar2_fd_outro">Como Dormiu</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 3</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar3_a" name="despertar3_a" value="{{ old('despertar3_a') }}"  class="timepicker">
                                                        <label for="despertar3_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar3_d" name="despertar3_d" value="{{ old('despertar3_d') }}" class="timepicker">
                                                        <label for="despertar3_d">Horário que dormiu</label>

                                                    </div>

                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                        <select class="browser-default" name="despertar3_fd" id="despertar3_fd">
                                                            <option value="" disabled selected>Selecione uma opção</option>
                                                            <option {{ old('despertar3_fd')==1 ? "selected" : "" }} value="1">Sozinho</option>
                                                            <option {{ old('despertar3_fd')==2 ? "selected" : "" }} value="2">Ninando no berço/cama</option>
                                                            <option {{ old('despertar3_fd')==3 ? "selected" : "" }} value="3">Mamando</option>
                                                            <option {{ is_numeric(old('despertar3_fd')==false) ? "selected" : "" }} value="4">Outro</option>
                                                        </select>

                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar3_fd_outro">
                                                        <input  type="text" id="despertar3_fd_outro"" name=" despertar3_fd_outro" value="{{ old('despertar3_fd_outro') }}">
                                                        <label for="despertar3_fd_outro">Como Dormiu</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 4</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar4_a" name="despertar4_a" value="{{ old('despertar4_a') }}" class="timepicker">
                                                        <label for="despertar4_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar4_d" name="despertar4_d" value="{{ old('despertar4_d') }}" class="timepicker">
                                                        <label for="despertar4_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>                                                    <select class="browser-default" name="despertar4_fd" id="despertar4_fd">
                                                            <option value="" disabled selected>Selecione uma opção</option>
                                                            <option {{ old('despertar4_fd')==1 ? "selected" : "" }} value="1">Sozinho</option>
                                                            <option {{ old('despertar4_fd')==2 ? "selected" : "" }} value="2">Ninando no berço/cama</option>
                                                            <option {{ old('despertar4_fd')==3 ? "selected" : "" }} value="3">Mamando</option>
                                                            <option {{is_numeric(old('despertar4_fd')==false) ? "selected" : "" }} value="4">Outro</option>
                                                        </select>

                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar4_fd_outro">
                                                        <input type="text" id="despertar4_fd_outro"" name=" despertar4_fd_outro" value="{{ old('despertar4_fd_outro') }}">
                                                        <label for="despertar4_fd_outro">Como Dormiu</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 5</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar5_a" name="despertar5_a" value="{{ old('despertar5_a') }}" class="timepicker">
                                                        <label for="despertar5_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar5_d" name="despertar5_d" value="{{ old('despertar5_d') }}" class="timepicker">
                                                        <label for="despertar5_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>                                                    <select class="browser-default" name="despertar5_fd" id="despertar5_fd">
                                                            <option value="" disabled selected>Selecione uma opção</option>
                                                            <option {{ old('despertar5_fd')==1 ? "selected" : "" }} value="1">Sozinho</option>
                                                            <option {{ old('despertar5_fd')==2 ? "selected" : "" }} value="2">Ninando no berço/cama</option>
                                                            <option {{ old('despertar5_fd')==3 ? "selected" : "" }} value="3">Mamando</option>
                                                            <option {{ is_numeric(old('despertar5_fd')==false) ? "selected" : "" }}value="4">Outro</option>
                                                        </select>

                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar5_fd_outro">
                                                        <input  type="text" id="despertar5_fd_outro"" name=" despertar5_fd_outro" value="{{ old('despertar5_fd_outro') }}">
                                                        <label for="despertar5_fd_outro">Como Dormiu</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 6</h5>
                                                <div class="row">
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar6_a" name="despertar6_a" value="{{ old('despertar6_a') }}" class="timepicker">
                                                        <label for="despertar6_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar6_d" name="despertar6_d" value="{{ old('despertar6_d') }}" class="timepicker">
                                                        <label for="despertar6_d">Horário que dormiu</label>

                                                    </div>

                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>                                                    <select class="browser-default" name="despertar6_fd" id="despertar6_fd">
                                                            <option value="" disabled selected>Selecione uma opção</option>
                                                            <option {{ old('despertar6_fd')==1 ? "selected" : "" }} value="1">Sozinho</option>
                                                            <option {{ old('despertar6_fd')==2 ? "selected" : "" }} value="2">Ninando no berço/cama</option>
                                                            <option {{ old('despertar6_fd')==3 ? "selected" : "" }} value="3">Mamando</option>
                                                            <option {{ is_numeric(old('despertar6_fd')==false) ? "selected" : "" }} value="4">Outro</option>
                                                        </select>

                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar6_fd_outro">
                                                        <input  type="text" id="despertar6_fd_outro"" name=" despertar6_fd_outro" value="{{ old('despertar6_fd_outro') }}">
                                                        <label for="despertar6_fd_outro">Como Dormiu</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                -->
                                    <div class="row">
                                        <div class="step-actions" style="position:relative">
                                            <div class="row">
                                                <div class="col m4 s12 mb-3">
                                                    <button class="red btn btn-reset" type="reset">
                                                        <i class="material-icons left">clear</i>Reset
                                                    </button>
                                                </div>
                                                <div class="col m4 s12 mb-3">
                                                    <button class="btn btn-light previous-step">
                                                        <i class="material-icons left">arrow_back</i>
                                                        Prev
                                                    </button>
                                                </div>
                                                <div class="col m4 s12 mb-3">
                                                    <button class="waves-effect waves dark btn btn-primary " type="submit">
                                                        Enviar
                                                        <i class="material-icons right">arrow_forward</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                    </form>
                    </ul>
        <div class="fixed-action-btn direction-top" style="bottom: 45px; right: 24px;">
              <a class="btn-floating btn-large red" id="salvar">
                <i class="material-icons">save</i>
              </a>

            <div>

                </div>

            </div>

        </div>


@endsection

    @section('js')
                                    <script>
                                        $(document).ready(function() {
                                            
                                            $('.timepicker').timepicker({
                                                twelveHour: false
                                            });

                                            $("select").formSelect();
                                        });

                                        $('#despertar1_fd_outro').hide();

                                         @if(
            isset(
            $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode1
        )
            &&
            is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode1) == false
        )
                                 $('#despertar1_fd_outro').show();
                                @endif



                                        $('#despertar1_fd').change(function() {
                                            if ($(this).val() === '4') {
                                                $('#despertar1_fd_outro').show();
                                            }
                                            if ($(this).val() != '4') {
                                                $('#despertar1_fd_outro').hide();
                                            }
                                        });
                                        $('#despertar2_fd_outro').hide();
                                 @if(
            isset(
            $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode2
        )
            &&
            is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode2) == false
        )
                                 $('#despertar2_fd_outro').show();
                                @endif

                                        $('#despertar2_fd').change(function() {
                                            if ($(this).val() === '4') {
                                                $('#despertar2_fd_outro').show();
                                            }
                                            if ($(this).val() != '4') {
                                                $('#despertar2_fd_outro').hide();
                                            }
                                        });

                                        $('#despertar3_fd_outro').hide();
                                  $('#despertar2_fd_outro').hide();
                                 @if(
            isset(
            $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode3
        )
            &&
            is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode3) == false
        )
                                 $('#despertar3_fd_outro').show();
                                @endif

                                        $('#despertar3_fd').change(function() {
                                            if ($(this).val() === '4') {
                                                $('#despertar3_fd_outro').show();
                                            }
                                            if ($(this).val() != '4') {
                                                $('#despertar3_fd_outro').hide();
                                            }
                                        });

                                        $('#despertar4_fd_outro').hide();

                                  $('#despertar4_fd_outro').hide();
                                 @if(
            isset(
            $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode4
        )
            &&
            is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode4) == false
        )
                                 $('#despertar4_fd_outro').show();
                                @endif

                                        $('#despertar4_fd').change(function() {
                                            if ($(this).val() === '4') {
                                                $('#despertar4_fd_outro').show();
                                            }
                                            if ($(this).val() != '4') {
                                                $('#despertar4_fd_outro').hide();
                                            }
                                        });
                                        $('#despertar5_fd_outro').hide();

                                @if(
            isset(
            $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode5
        )
            &&
            is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode5) == false
        )
                                 $('#despertar5_fd_outro').show();
                                @endif

                                        $('#despertar5_fd').change(function() {
                                            if ($(this).val() === '4') {
                                                $('#despertar5_fd_outro').show();
                                            }
                                            if ($(this).val() != '4') {
                                                $('#despertar5_fd_outro').hide();
                                            }
                                        });

                                        $('#despertar6_fd_outro').hide();

                                @if(
            isset(
            $challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode6
        )
            &&
            is_numeric($challenge->analyzes()->where('day', $day)->first()->dados()->first()->wake_sleepingMode6) == false
        )
                                 $('#despertar6_fd_outro').show();
                                @endif

                                        $('#despertar6_fd').change(function() {
                                            if ($(this).val() === '4') {
                                                $('#despertar6_fd_outro').show();
                                            }
                                            if ($(this).val() != '4') {
                                                $('#despertar6_fd_outro').hide();
                                            }
                                        });
                                                       $('#despertar7_fd_outro').hide();

                                                $('#despertar7_fd').change(function() {
                                                    if ($(this).val() === '4') {
                                                        $('#despertar7_fd_outro').show();
                                                    }
                                                    if ($(this).val() != '4') {
                                                        $('#despertar7_fd_outro').hide();
                                                    }
                                                });
                                                $('#despertar8_fd_outro').hide();

                                                $('#despertar8_fd').change(function() {
                                                    if ($(this).val() === '4') {
                                                        $('#despertar8_fd_outro').show();
                                                    }
                                                    if ($(this).val() != '4') {
                                                        $('#despertar8_fd_outro').hide();
                                                    }
                                                });
                                                $('#despertar9_fd_outro').hide();

                                                $('#despertar9_fd').change(function() {
                                                    if ($(this).val() === '4') {
                                                        $('#despertar9_fd_outro').show();
                                                    }
                                                    if ($(this).val() != '4') {
                                                        $('#despertar9_fd_outro').hide();
                                                    }
                                                });
                                                $('#despertar10_fd_outro').hide();

                                                $('#despertar10_fd').change(function() {
                                                    if ($(this).val() === '4') {
                                                        $('#despertar10_fd_outro').show();
                                                    }
                                                    if ($(this).val() != '4') {
                                                        $('#despertar10_fd_outro').hide();
                                                    }
                                                });
                                                 $('textarea#observacao').characterCounter();
                                    </script>


                                 <div id="confirmSalvo" class="modal">
                                   <div class="modal-content">
                                      <h5>Seu progresso foi salvo!</h5>
                                      <p>Você pode continuar editanto... <br>Ao terminar clique em <b>Enviar</b></p>
                                    </div>
                                    <div class="modal-footer">
                                      <a href="#!" class="modal-close waves-effect waves-green btn-flat">OK</a>
                                    </div>
                                  </div>
                                <script>



                                $(document).ready(function(){
                                    $('.modal').modal({

                                    });
                                 //   $('#modal1').modal('open');
                                  });

                                   $(document).ready(function(){
                                    $('.fixed-action-btn').floatingActionButton();
                                  });
                                  </script>
                                <script>
                                $(document).on("click", "#salvar" , function() {

                                    //
                                    const form = document.getElementById("form");
                                   $.ajax({
                                               type:'POST',
                                               url:'{{route('analyze.store.json', [$challenge->id, $day])}}',
                                              data: new FormData(form),
                                              dataType: 'JSON',
                                            contentType: false,
                                            cache: false,
                                            processData: false,
                                               success:function(response) {

                                              $('#confirmSalvo').modal('open');

                                               }, error: function(response) {
                                            }

                                            }); 
                                });

                                </script>
                                <script>
                                  document.addEventListener("DOMContentLoaded", function () {
                                        document.getElementById("btn-clear-avaliacao").addEventListener("click", function () {
                                            let section = document.getElementById("step-avaliacao");

                                            // limpar inputs de texto dentro da seção
                                            section.querySelectorAll("input[type=text]").forEach(function (input) {
                                                input.value = "";
                                            });

                                            // limpar checkboxes dentro da seção
                                            section.querySelectorAll("input[type=checkbox]").forEach(function (checkbox) {
                                                checkbox.checked = false;
                                            });

                                            // atualizar labels
                                            M.updateTextFields();
                                        });
                                    });

                                </script>
                                <script>
                document.addEventListener("DOMContentLoaded", function() {
                    document.querySelector(".clear-soneca1").addEventListener("click", function() {
                        let section = this.closest(".soneca1-section");

                        // limpa inputs de texto
                        section.querySelectorAll("input[type='text']").forEach(input => input.value = "");

                        // desmarca checkbox
                        section.querySelectorAll("input[type='checkbox']").forEach(checkbox => checkbox.checked = false);

                        // reseta selects
                        section.querySelectorAll("select").forEach(select => select.selectedIndex = 0);
                    });
                });
                document.addEventListener("DOMContentLoaded", function() {
                    document.querySelector(".clear-soneca2").addEventListener("click", function() {
                        let section = this.closest(".soneca2-section");

                        // limpa inputs de texto
                        section.querySelectorAll("input[type='text']").forEach(input => input.value = "");

                        // desmarca checkbox
                        section.querySelectorAll("input[type='checkbox']").forEach(checkbox => checkbox.checked = false);

                        // reseta selects
                        section.querySelectorAll("select").forEach(select => select.selectedIndex = 0);
                    });
                });
                document.addEventListener("DOMContentLoaded", function() {
                    document.querySelector(".clear-soneca3").addEventListener("click", function() {
                        let section = this.closest(".soneca3-section");

                        // limpa inputs de texto
                        section.querySelectorAll("input[type='text']").forEach(input => input.value = "");

                        // desmarca checkbox
                        section.querySelectorAll("input[type='checkbox']").forEach(checkbox => checkbox.checked = false);

                        // reseta selects
                        section.querySelectorAll("select").forEach(select => select.selectedIndex = 0);
                    });
                });
                document.addEventListener("DOMContentLoaded", function() {
                    document.querySelector(".clear-soneca4").addEventListener("click", function() {
                        let section = this.closest(".soneca4-section");

                        // limpa inputs de texto
                        section.querySelectorAll("input[type='text']").forEach(input => input.value = "");

                        // desmarca checkbox
                        section.querySelectorAll("input[type='checkbox']").forEach(checkbox => checkbox.checked = false);

                        // reseta selects
                        section.querySelectorAll("select").forEach(select => select.selectedIndex = 0);
                    });
                });
                document.addEventListener("DOMContentLoaded", function() {
                    document.querySelector(".clear-soneca5").addEventListener("click", function() {
                        let section = this.closest(".soneca5-section");

                        // limpa inputs de texto
                        section.querySelectorAll("input[type='text']").forEach(input => input.value = "");

                        // desmarca checkbox
                        section.querySelectorAll("input[type='checkbox']").forEach(checkbox => checkbox.checked = false);

                        // reseta selects
                        section.querySelectorAll("select").forEach(select => select.selectedIndex = 0);
                    });
                });
                document.addEventListener("DOMContentLoaded", function() {
                    document.querySelector(".clear-soneca6").addEventListener("click", function() {
                        let section = this.closest(".soneca6-section");

                        // limpa inputs de texto
                        section.querySelectorAll("input[type='text']").forEach(input => input.value = "");

                        // desmarca checkbox
                        section.querySelectorAll("input[type='checkbox']").forEach(checkbox => checkbox.checked = false);

                        // reseta selects
                        section.querySelectorAll("select").forEach(select => select.selectedIndex = 0);
                    });
                });

                 document.addEventListener("DOMContentLoaded", function () {
                                        document.querySelector(".clear-ritual").addEventListener("click", function () {
                                          let section = this.closest(".section-ritual");


                                            // limpar inputs de texto dentro da seção
                                            section.querySelectorAll("input[type=text]").forEach(function (input) {
                                                input.value = "";
                                            });

                                            // limpar checkboxes dentro da seção
                                            section.querySelectorAll("input[type=checkbox]").forEach(function (checkbox) {
                                                checkbox.checked = false;
                                            });

                                            // atualizar labels
                                            M.updateTextFields();
                                        });
                                    });


                </script>

                <script>
document.addEventListener('DOMContentLoaded', function() {
    const elems = document.querySelectorAll('.datepicker');

    // pega a data de hoje
    let hoje = new Date();

    // cria a data mínima = hoje - 30 dias
    let minDate = new Date();
    minDate.setDate(hoje.getDate() - 30);

    // inicializa o datepicker com restrição
    M.Datepicker.init(elems, {
        format: 'dd/mm/yyyy',
        i18n: {
            cancel: 'Cancelar',
            clear: 'Limpar',
            done: 'OK'
        },
        minDate: minDate,
        maxDate: hoje,
        defaultDate: hoje,
        setDefaultDate: true
    });
});
</script>

    @endsection