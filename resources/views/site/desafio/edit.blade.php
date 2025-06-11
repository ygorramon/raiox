@extends('site.desafio.layouts.app')
@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
@stop



@section('content')




    <div class="row">
        <div class="col s12">
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
                    <form action="{{route('analyze.update', [$challenge->id, $day])}}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <ul class="stepper horizontal" id="horizStepper">
                            <li class="step active">
                                <div class="step-title waves-effect">Informações</div>
                                <div class="step-content">
                                    <div class="row">
                                        <div class="input-field col m6 s12">

                                            <input type="text" id="date" name="date" value="{{ old('date', date_format(\Carbon\Carbon::parse($analyze->date), 'd/m/Y')) }}" class="datepicker">
                                            <label for="date">Data da Avaliação</label>


                                        </div>
                                        <div class="input-field col m6 s12">
                                            <input id="timeWokeUp" type="text" name="timeWokeUp" value="{{ old('timeWokeUp', date_format(\Carbon\Carbon::parse($analyze->timeWokeUp), 'H:i')) }}" class="timepicker">
                                            <label for="timeWokeUp">Horário que Acordou</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col m6 s12">
                                            <div class="switch">
                                                <label>
                                                    Efeito Vulcânico?: Não
                                                    <input type="checkbox" name="volcanicEffect" value="S" @if(old('volcanicEffect', $analyze->volcanicEffect) == "S") checked @endif>
                                                    <span class="lever"></span>
                                                    Sim
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="step-actions">
                                        <div class="row">
                                            <div class="col m4 s12 mb-4">
                                                <button class="red btn btn-reset" type="reset">
                                                    Reset
                                                    <i class="material-icons left">clear</i>

                                                </button>
                                            </div>
                                            <div class="col m4 s12 mb-4">
                                                <button class="btn btn-light previous-step" disabled>
                                                    <i class="material-icons left">arrow_back</i>
                                                    Prev
                                                </button>
                                            </div>
                                            <div class="col m4 s12 mb-4">
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
                                    <div class="row">
                                        <div class="card card card-default scrollspy">

                                            <div class="card-content">
                                                <h5>Soneca 1</h5>
                                                <div class="row">
                                                    @if(isset($naps[0]))
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca1_ss" class="timepicker" value="{{ old('soneca1_ss', date_format(\Carbon\Carbon::parse($naps[0]->signalSlept), 'H:i')) }}">
                                                            <label for="soneca1_ss">Horário que sentiu sono</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="soneca1_hd" name="soneca1_hd" class="timepicker" value="{{ old('soneca1_hd', date_format(\Carbon\Carbon::parse($naps[0]->timeSlept), 'H:i')) }}">
                                                            <label for="soneca1_hd">Horário que dormiu</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca1_ha" class="timepicker" value="{{ old('soneca1_ha', date_format(\Carbon\Carbon::parse($naps[0]->timeWokeUp), 'H:i')) }}">
                                                            <label for="soneca1_ha">Horário que acordou</label>

                                                        </div>
                                                        <div class="input-field col m3 s12">
                                                            <label>Onde dormiu?</label>
                                                            <br>
                                                            <select class="browser-default" name="soneca1_onde_dormiu">
                                                                <option value="" disabled selected>Escolha onde dormiu</option>
                                                                <option value="colo" {{ old('soneca1_onde_dormiu') == 'colo' ? 'selected' : '' }}>Colo</option>
                                                                <option value="berco" {{ old('soneca1_onde_dormiu') == 'berco' ? 'selected' : '' }}>Berço</option>
                                                                <option value="cama_compartilhada" {{ old('soneca1_onde_dormiu') == 'cama_compartilhada' ? 'selected' : '' }}>Cama
                                                                    Compartilhada</option>
                                                                <option value="carrinho" {{ old('soneca1_onde_dormiu') == 'carrinho' ? 'selected' : '' }}>Carrinho</option>
                                                            </select>

                                                        </div>

                                                        <div class="input-field col m3 s12">
                                                            <div class="switch">
                                                                <label>
                                                                    Prolongada?
                                                                    <input type="checkbox" name="soneca1_prolongada" value="1" {{ old('soneca1_prolongada') ? 'checked' : '' }}>
                                                                    <span class="lever"></span>
                                                                    Sim
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca1_ss" class="timepicker" value="{{ old('soneca1_ss') }}">
                                                            <label for="soneca1_ss">Horário que sentiu sono</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="soneca1_hd" name="soneca1_hd" class="timepicker" value="{{ old('soneca1_hd') }}">
                                                            <label for="soneca1_hd">Horário que dormiu</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca1_ha" class="timepicker" value="{{ old('soneca1_ha') }}">
                                                            <label for="soneca1_ha">Horário que acordou</label>

                                                        </div>
                                                        <div class="input-field col m3 s12">
                                                            <label>Onde dormiu?</label>
                                                            <br>
                                                            <select class="browser-default" name="soneca1_onde_dormiu">
                                                                <option value="" disabled selected>Escolha onde dormiu</option>
                                                                <option value="colo" {{ old('soneca1_onde_dormiu') == 'colo' ? 'selected' : '' }}>Colo</option>
                                                                <option value="berco" {{ old('soneca1_onde_dormiu') == 'berco' ? 'selected' : '' }}>Berço</option>
                                                                <option value="cama_compartilhada" {{ old('soneca1_onde_dormiu') == 'cama_compartilhada' ? 'selected' : '' }}>Cama
                                                                    Compartilhada</option>
                                                                <option value="carrinho" {{ old('soneca1_onde_dormiu') == 'carrinho' ? 'selected' : '' }}>Carrinho</option>
                                                            </select>

                                                        </div>

                                                        <div class="input-field col m3 s12">
                                                            <div class="switch">
                                                                <label>
                                                                    Prolongada?
                                                                    <input type="checkbox" name="soneca1_prolongada" value="1" {{ old('soneca1_prolongada') ? 'checked' : '' }}>
                                                                    <span class="lever"></span>
                                                                    Sim
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Soneca 2</h5>
                                                <div class="row">
                                                    @if(isset($naps[1]))
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca2_ss" class="timepicker" value="{{ old('soneca2_ss', date_format(\Carbon\Carbon::parse($naps[1]->signalSlept), 'H:i')) }}">
                                                            <label for="soneca2_ss">Horário que sentiu sono</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="soneca1_hd" name="soneca2_hd" class="timepicker" value="{{ old('soneca2_hd', date_format(\Carbon\Carbon::parse($naps[1]->timeSlept), 'H:i')) }}">
                                                            <label for="soneca2_hd">Horário que dormiu</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca2_ha" class="timepicker" value="{{ old('soneca2_ha', date_format(\Carbon\Carbon::parse($naps[1]->timeWokeUp), 'H:i')) }}">
                                                            <label for="soneca2_ha">Horário que acordou</label>

                                                        </div>
                                                        <div class="input-field col m3 s12">
                                                            <label>Onde dormiu?</label>
                                                            <br>
                                                            <select class="browser-default" name="soneca2_onde_dormiu">
                                                                <option value="" disabled selected>Escolha onde dormiu</option>
                                                                <option value="colo" {{ old('soneca2_onde_dormiu') == 'colo' ? 'selected' : '' }}>Colo</option>
                                                                <option value="berco" {{ old('soneca2_onde_dormiu') == 'berco' ? 'selected' : '' }}>Berço</option>
                                                                <option value="cama_compartilhada" {{ old('soneca2_onde_dormiu') == 'cama_compartilhada' ? 'selected' : '' }}>Cama
                                                                    Compartilhada</option>
                                                                <option value="carrinho" {{ old('soneca2_onde_dormiu') == 'carrinho' ? 'selected' : '' }}>Carrinho</option>
                                                            </select>
                                                        </div>

                                                        <div class="input-field col m3 s12">
                                                            <div class="switch">
                                                                <label>
                                                                    Prolongada?
                                                                    <input type="checkbox" name="soneca2_prolongada" value="1" {{ old('soneca2_prolongada') ? 'checked' : '' }}>
                                                                    <span class="lever"></span>
                                                                    Sim
                                                                </label>
                                                            </div>
                                                        </div>

                                                    @else
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca2_ss" class="timepicker" value="{{ old('soneca2_ss') }}">
                                                            <label for="soneca2_ss">Horário que sentiu sono</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="soneca2_hd" name="soneca2_hd" class="timepicker" value="{{ old('soneca2_hd') }}">
                                                            <label for="soneca2_hd">Horário que dormiu</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca2_ha" class="timepicker" value="{{ old('soneca2_ha') }}">
                                                            <label for="soneca2_ha">Horário que acordou</label>

                                                        </div>
                                                        <div class="input-field col m3 s12">
                                                            <label>Onde dormiu?</label>
                                                            <br>
                                                            <select class="browser-default" name="soneca2_onde_dormiu">
                                                                <option value="" disabled selected>Escolha onde dormiu</option>
                                                                <option value="colo" {{ old('soneca2_onde_dormiu') == 'colo' ? 'selected' : '' }}>Colo</option>
                                                                <option value="berco" {{ old('soneca2_onde_dormiu') == 'berco' ? 'selected' : '' }}>Berço</option>
                                                                <option value="cama_compartilhada" {{ old('soneca2_onde_dormiu') == 'cama_compartilhada' ? 'selected' : '' }}>Cama
                                                                    Compartilhada</option>
                                                                <option value="carrinho" {{ old('soneca2_onde_dormiu') == 'carrinho' ? 'selected' : '' }}>Carrinho</option>
                                                            </select>
                                                        </div>

                                                        <div class="input-field col m3 s12">
                                                            <div class="switch">
                                                                <label>
                                                                    Prolongada?
                                                                    <input type="checkbox" name="soneca2_prolongada" value="1" {{ old('soneca2_prolongada') ? 'checked' : '' }}>
                                                                    <span class="lever"></span>
                                                                    Sim
                                                                </label>
                                                            </div>
                                                        </div>

                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Soneca 3</h5>
                                                <div class="row">
                                                    @if(isset($naps[2]))
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca3_ss" class="timepicker" value="{{ old('soneca3_ss', date_format(\Carbon\Carbon::parse($naps[2]->signalSlept), 'H:i')) }}">
                                                            <label for="soneca3_ss">Horário que sentiu sono</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="soneca1_hd" name="soneca3_hd" class="timepicker" value="{{ old('soneca3_hd', date_format(\Carbon\Carbon::parse($naps[2]->timeSlept), 'H:i')) }}">
                                                            <label for="soneca3_hd">Horário que dormiu</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca3_ha" class="timepicker" value="{{ old('soneca3_ha', date_format(\Carbon\Carbon::parse($naps[2]->timeWokeUp), 'H:i')) }}">
                                                            <label for="soneca3_ha">Horário que acordou</label>

                                                        </div>
                                                        <div class="input-field col m3 s12">
                                                            <label>Onde dormiu?</label>
                                                            <br>
                                                            <select class="browser-default" name="soneca3_onde_dormiu">
                                                                <option value="" disabled selected>Escolha onde dormiu</option>
                                                                <option value="colo" {{ old('soneca3_onde_dormiu') == 'colo' ? 'selected' : '' }}>Colo</option>
                                                                <option value="berco" {{ old('soneca3_onde_dormiu') == 'berco' ? 'selected' : '' }}>Berço</option>
                                                                <option value="cama_compartilhada" {{ old('soneca3_onde_dormiu') == 'cama_compartilhada' ? 'selected' : '' }}>Cama
                                                                    Compartilhada</option>
                                                                <option value="carrinho" {{ old('soneca3_onde_dormiu') == 'carrinho' ? 'selected' : '' }}>Carrinho</option>
                                                            </select>
                                                        </div>

                                                        <div class="input-field col m3 s12">
                                                            <div class="switch">
                                                                <label>
                                                                    Prolongada?
                                                                    <input type="checkbox" name="soneca3_prolongada" value="1" {{ old('soneca3_prolongada') ? 'checked' : '' }}>
                                                                    <span class="lever"></span>
                                                                    Sim
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca3_ss" class="timepicker" value="{{ old('soneca3_ss') }}">
                                                            <label for="soneca3_ss">Horário que sentiu sono</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="soneca3_hd" name="soneca3_hd" class="timepicker" value="{{ old('soneca3_hd') }}">
                                                            <label for="soneca3_hd">Horário que dormiu</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca3_ha" class="timepicker" value="{{ old('soneca3_ha') }}">
                                                            <label for="soneca3_ha">Horário que acordou</label>

                                                        </div>
                                                        <div class="input-field col m3 s12">
                                                            <label>Onde dormiu?</label>
                                                            <br>
                                                            <select class="browser-default" name="soneca3_onde_dormiu">
                                                                <option value="" disabled selected>Escolha onde dormiu</option>
                                                                <option value="colo" {{ old('soneca3_onde_dormiu') == 'colo' ? 'selected' : '' }}>Colo</option>
                                                                <option value="berco" {{ old('soneca3_onde_dormiu') == 'berco' ? 'selected' : '' }}>Berço</option>
                                                                <option value="cama_compartilhada" {{ old('soneca3_onde_dormiu') == 'cama_compartilhada' ? 'selected' : '' }}>Cama
                                                                    Compartilhada</option>
                                                                <option value="carrinho" {{ old('soneca3_onde_dormiu') == 'carrinho' ? 'selected' : '' }}>Carrinho</option>
                                                            </select>
                                                        </div>

                                                        <div class="input-field col m3 s12">
                                                            <div class="switch">
                                                                <label>
                                                                    Prolongada?
                                                                    <input type="checkbox" name="soneca3_prolongada" value="1" {{ old('soneca3_prolongada') ? 'checked' : '' }}>
                                                                    <span class="lever"></span>
                                                                    Sim
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Soneca 4</h5>
                                                <div class="row">
                                                    @if(isset($naps[3]))
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca4_ss" class="timepicker" value="{{ old('soneca4_ss', date_format(\Carbon\Carbon::parse($naps[3]->signalSlept), 'H:i')) }}">
                                                            <label for="soneca4_ss">Horário que sentiu sono</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="soneca1_hd" name="soneca4_hd" class="timepicker" value="{{ old('soneca4_hd', date_format(\Carbon\Carbon::parse($naps[3]->timeSlept), 'H:i')) }}">
                                                            <label for="soneca4_hd">Horário que dormiu</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca4_ha" class="timepicker" value="{{ old('soneca4_ha', date_format(\Carbon\Carbon::parse($naps[3]->timeWokeUp), 'H:i')) }}">
                                                            <label for="soneca4_ha">Horário que acordou</label>

                                                        </div>
                                                        <div class="input-field col m3 s12">
                                                            <label>Onde dormiu?</label>
                                                            <br>
                                                            <select class="browser-default" name="soneca4_onde_dormiu">
                                                                <option value="" disabled selected>Escolha onde dormiu</option>
                                                                <option value="colo" {{ old('soneca4_onde_dormiu') == 'colo' ? 'selected' : '' }}>Colo</option>
                                                                <option value="berco" {{ old('soneca4_onde_dormiu') == 'berco' ? 'selected' : '' }}>Berço</option>
                                                                <option value="cama_compartilhada" {{ old('soneca4_onde_dormiu') == 'cama_compartilhada' ? 'selected' : '' }}>Cama
                                                                    Compartilhada</option>
                                                                <option value="carrinho" {{ old('soneca4_onde_dormiu') == 'carrinho' ? 'selected' : '' }}>Carrinho</option>
                                                            </select>
                                                        </div>

                                                        <div class="input-field col m3 s12">
                                                            <div class="switch">
                                                                <label>
                                                                    Prolongada?
                                                                    <input type="checkbox" name="soneca4_prolongada" value="1" {{ old('soneca4_prolongada') ? 'checked' : '' }}>
                                                                    <span class="lever"></span>
                                                                    Sim
                                                                </label>
                                                            </div>
                                                        </div>


                                                    @else
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca4_ss" class="timepicker" value="{{ old('soneca4_ss') }}">
                                                            <label for="soneca4_ss">Horário que sentiu sono</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="soneca4_hd" name="soneca4_hd" class="timepicker" value="{{ old('soneca4_hd') }}">
                                                            <label for="soneca4_hd">Horário que dormiu</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca4_ha" class="timepicker" value="{{ old('soneca4_ha') }}">
                                                            <label for="soneca4_ha">Horário que acordou</label>

                                                        </div>
                                                        <div class="input-field col m3 s12">
                                                            <label>Onde dormiu?</label>
                                                            <br>
                                                            <select class="browser-default" name="soneca4_onde_dormiu">
                                                                <option value="" disabled selected>Escolha onde dormiu</option>
                                                                <option value="colo" {{ old('soneca4_onde_dormiu') == 'colo' ? 'selected' : '' }}>Colo</option>
                                                                <option value="berco" {{ old('soneca4_onde_dormiu') == 'berco' ? 'selected' : '' }}>Berço</option>
                                                                <option value="cama_compartilhada" {{ old('soneca4_onde_dormiu') == 'cama_compartilhada' ? 'selected' : '' }}>Cama
                                                                    Compartilhada</option>
                                                                <option value="carrinho" {{ old('soneca4_onde_dormiu') == 'carrinho' ? 'selected' : '' }}>Carrinho</option>
                                                            </select>
                                                        </div>

                                                        <div class="input-field col m3 s12">
                                                            <div class="switch">
                                                                <label>
                                                                    Prolongada?
                                                                    <input type="checkbox" name="soneca4_prolongada" value="1" {{ old('soneca4_prolongada') ? 'checked' : '' }}>
                                                                    <span class="lever"></span>
                                                                    Sim
                                                                </label>
                                                            </div>
                                                        </div>

                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Soneca 5</h5>
                                                <div class="row">
                                                    @if(isset($naps[4]))
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca5_ss" class="timepicker" value="{{ old('soneca5_ss', date_format(\Carbon\Carbon::parse($naps[4]->signalSlept), 'H:i')) }}">
                                                            <label for="soneca5_ss">Horário que sentiu sono</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="soneca1_hd" name="soneca5_hd" class="timepicker" value="{{ old('soneca5_hd', date_format(\Carbon\Carbon::parse($naps[4]->timeSlept), 'H:i')) }}">
                                                            <label for="soneca5_hd">Horário que dormiu</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca5_ha" class="timepicker" value="{{ old('soneca5_ha', date_format(\Carbon\Carbon::parse($naps[4]->timeWokeUp), 'H:i')) }}">
                                                            <label for="soneca5_ha">Horário que acordou</label>

                                                        </div>
                                                        <div class="input-field col m3 s12">
                                                            <label>Onde dormiu?</label>
                                                            <br>
                                                            <select class="browser-default" name="soneca5_onde_dormiu">
                                                                <option value="" disabled selected>Escolha onde dormiu</option>
                                                                <option value="colo" {{ old('soneca5_onde_dormiu') == 'colo' ? 'selected' : '' }}>Colo</option>
                                                                <option value="berco" {{ old('soneca5_onde_dormiu') == 'berco' ? 'selected' : '' }}>Berço</option>
                                                                <option value="cama_compartilhada" {{ old('soneca5_onde_dormiu') == 'cama_compartilhada' ? 'selected' : '' }}>Cama
                                                                    Compartilhada</option>
                                                                <option value="carrinho" {{ old('soneca5_onde_dormiu') == 'carrinho' ? 'selected' : '' }}>Carrinho</option>
                                                            </select>
                                                        </div>

                                                        <div class="input-field col m3 s12">
                                                            <div class="switch">
                                                                <label>
                                                                    Prolongada?
                                                                    <input type="checkbox" name="soneca5_prolongada" value="1" {{ old('soneca5_prolongada') ? 'checked' : '' }}>
                                                                    <span class="lever"></span>
                                                                    Sim
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca5_ss" class="timepicker" value="{{ old('soneca5_ss') }}">
                                                            <label for="soneca5_ss">Horário que sentiu sono</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="soneca5_hd" name="soneca5_hd" class="timepicker" value="{{ old('soneca5_hd') }}">
                                                            <label for="soneca5_hd">Horário que dormiu</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca5_ha" class="timepicker" value="{{ old('soneca5_ha') }}">
                                                            <label for="soneca5_ha">Horário que acordou</label>

                                                        </div>
                                                        <div class="input-field col m3 s12">
                                                            <label>Onde dormiu?</label>
                                                            <br>
                                                            <select class="browser-default" name="soneca5_onde_dormiu">
                                                                <option value="" disabled selected>Escolha onde dormiu</option>
                                                                <option value="colo" {{ old('soneca5_onde_dormiu') == 'colo' ? 'selected' : '' }}>Colo</option>
                                                                <option value="berco" {{ old('soneca5_onde_dormiu') == 'berco' ? 'selected' : '' }}>Berço</option>
                                                                <option value="cama_compartilhada" {{ old('soneca5_onde_dormiu') == 'cama_compartilhada' ? 'selected' : '' }}>Cama
                                                                    Compartilhada</option>
                                                                <option value="carrinho" {{ old('soneca5_onde_dormiu') == 'carrinho' ? 'selected' : '' }}>Carrinho</option>
                                                            </select>
                                                        </div>

                                                        <div class="input-field col m3 s12">
                                                            <div class="switch">
                                                                <label>
                                                                    Prolongada?
                                                                    <input type="checkbox" name="soneca5_prolongada" value="1" {{ old('soneca5_prolongada') ? 'checked' : '' }}>
                                                                    <span class="lever"></span>
                                                                    Sim
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Soneca 6</h5>
                                                <div class="row">
                                                    @if(isset($naps[5]))
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca6_ss" class="timepicker" value="{{ old('soneca6_ss', date_format(\Carbon\Carbon::parse($naps[5]->signalSlept), 'H:i')) }}">
                                                            <label for="soneca6_ss">Horário que sentiu sono</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="soneca1_hd" name="soneca6_hd" class="timepicker" value="{{ old('soneca6_hd', date_format(\Carbon\Carbon::parse($naps[5]->timeSlept), 'H:i')) }}">
                                                            <label for="soneca6_hd">Horário que dormiu</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca6_ha" class="timepicker" value="{{ old('soneca6_ha', date_format(\Carbon\Carbon::parse($naps[5]->timeWokeUp), 'H:i')) }}">
                                                            <label for="soneca6_ha">Horário que acordou</label>

                                                        </div>
                                                        <div class="input-field col m3 s12">
                                                            <label>Onde dormiu?</label>
                                                            <br>
                                                            <select class="browser-default" name="soneca6_onde_dormiu">
                                                                <option value="" disabled selected>Escolha onde dormiu</option>
                                                                <option value="colo" {{ old('soneca6_onde_dormiu') == 'colo' ? 'selected' : '' }}>Colo</option>
                                                                <option value="berco" {{ old('soneca6_onde_dormiu') == 'berco' ? 'selected' : '' }}>Berço</option>
                                                                <option value="cama_compartilhada" {{ old('soneca6_onde_dormiu') == 'cama_compartilhada' ? 'selected' : '' }}>Cama
                                                                    Compartilhada</option>
                                                                <option value="carrinho" {{ old('soneca6_onde_dormiu') == 'carrinho' ? 'selected' : '' }}>Carrinho</option>
                                                            </select>
                                                        </div>

                                                        <div class="input-field col m3 s12">
                                                            <div class="switch">
                                                                <label>
                                                                    Prolongada?
                                                                    <input type="checkbox" name="soneca6_prolongada" value="1" {{ old('soneca6_prolongada') ? 'checked' : '' }}>
                                                                    <span class="lever"></span>
                                                                    Sim
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca6_ss" class="timepicker" value="{{ old('soneca6_ss') }}">
                                                            <label for="soneca6_ss">Horário que sentiu sono</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="soneca6_hd" name="soneca6_hd" class="timepicker" value="{{ old('soneca6_hd') }}">
                                                            <label for="soneca6_hd">Horário que dormiu</label>

                                                        </div>
                                                        <div class="input-field col m2 s12">
                                                            <input type="text" id="time" name="soneca6_ha" class="timepicker" value="{{ old('soneca6_ha') }}">
                                                            <label for="soneca6_ha">Horário que acordou</label>

                                                        </div>
                                                        <div class="input-field col m3 s12">
                                                            <label>Onde dormiu?</label>
                                                            <br>
                                                            <select class="browser-default" name="soneca6_onde_dormiu">
                                                                <option value="" disabled selected>Escolha onde dormiu</option>
                                                                <option value="colo" {{ old('soneca6_onde_dormiu') == 'colo' ? 'selected' : '' }}>Colo</option>
                                                                <option value="berco" {{ old('soneca6_onde_dormiu') == 'berco' ? 'selected' : '' }}>Berço</option>
                                                                <option value="cama_compartilhada" {{ old('soneca6_onde_dormiu') == 'cama_compartilhada' ? 'selected' : '' }}>Cama
                                                                    Compartilhada</option>
                                                                <option value="carrinho" {{ old('soneca6_onde_dormiu') == 'carrinho' ? 'selected' : '' }}>Carrinho</option>
                                                            </select>
                                                        </div>

                                                        <div class="input-field col m3 s12">
                                                            <div class="switch">
                                                                <label>
                                                                    Prolongada?
                                                                    <input type="checkbox" name="soneca6_prolongada" value="1" {{ old('soneca6_prolongada') ? 'checked' : '' }}>
                                                                    <span class="lever"></span>
                                                                    Sim
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                    </div>

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
                                    <div class="row">
                                        <div class="card card card-default scrollspy">

                                            <div class="card-content">
                                                <h5>Ritual</h5>
                                                <div class="row">
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="ritual_ss" name="ritual_ss" class="timepicker" value="{{ old('ritual_ss', date_format(\Carbon\Carbon::parse($ritual->signalSlept), 'H:i')) }}">
                                                        <label for="ritual_ss">Horário que sentiu sono</label>

                                                    </div>
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="time" name="ritual_in" class="timepicker" value="{{ old('ritual_in', date_format(\Carbon\Carbon::parse($ritual->start), 'H:i')) }}">
                                                        <label for="ritual_in">Horário que iniciou</label>

                                                    </div>
                                                    <div class="input-field col m4 s12">
                                                        <input type="text" id="ritual_d" name="ritual_d" class="timepicker" value="{{ old('ritual_d', date_format(\Carbon\Carbon::parse($ritual->end), 'H:i')) }}">
                                                        <label for="ritual_d">Horário que dormiu</label>

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
                                                    @if(isset($wakes[0]))
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar1_a" name="despertar1_a" class="timepicker" value="{{ old('despertar1_a', date_format(\Carbon\Carbon::parse($wakes[0]->timeWokeUp), 'H:i')) }}">
                                                        <label for="despertar1_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar1_d" name="despertar1_d" class="timepicker" value="{{ old('despertar1_d', date_format(\Carbon\Carbon::parse($wakes[0]->timeSlept), 'H:i')) }}">
                                                        <label for="despertar1_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                        <select class="browser-default" name="despertar1_fd" id="despertar1_fd">
                                                            <option value="" disabled selected>Selecione uma opção</option>
                                                            <option {{ old('despertar1_fd', $wakes[0]->sleepingMode) == 1 ? "selected" : "" }} value="1">Sozinho</option>
                                                            <option {{ old('despertar1_fd', $wakes[0]->sleepingMode) == 2 ? "selected" : "" }} value="2">Ninando no berço/cama</option>
                                                            <option {{ old('despertar1_fd', $wakes[0]->sleepingMode) == 3 ? "selected" : "" }} value="3">Mamando</option>
                                                            <option {{ is_numeric(old('despertar1_fd', $wakes[0]->sleepingMode)) == false ? "selected" : "" }} value="4">Outro</option>
                                                        </select>
                                                    </div>

                                                    <div class="input-field col m3 s12" id="despertar1_fd_outro">
                                                        <input type="text" id="despertar1_fd_outro" name=" despertar1_fd_outro" value="{{ old('despertar1_fd_outro', $wakes[0]->sleepingMode)}}">
                                                        <label for="despertar1_fd_outro">Como Dormiu</label>
                                                    </div>
                                                    @else

                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar1_a" name="despertar1_a" class="timepicker" value="{{ old('despertar1_a')}}">
                                                        <label for="despertar1_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar1_d" name="despertar1_d" class="timepicker" value="{{ old('despertar1_d')}}">
                                                        <label for="despertar1_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>

                                                    <select class="browser-default" name="despertar1_fd" id="despertar1_fd">
                                                            <option value="" disabled selected>Selecione uma opção</option>
                                                            <option {{ old('despertar1_fd') == 1 ? "selected" : "" }} value="1">Sozinho</option>
                                                            <option {{ old('despertar1_fd') == 2 ? "selected" : "" }} value="2">Ninando no berço/cama</option>
                                                            <option {{ old('despertar1_fd') == 3 ? "selected" : "" }} value="3">Mamando</option>
                                                            <option {{ old('despertar1_fd') == 4 ? "selected" : "" }} value="4">Outro</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar1_fd_outro">
                                                        <input type="text" id="despertar1_fd_outro" name=" despertar1_fd_outro" value="{{ old('despertar1_fd_outro')}}">
                                                        <label for="despertar1_fd_outro">Como Dormiu</label>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 2</h5>
                                                <div class="row">
                                                    @if(isset($wakes[1]))
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar2_a" name="despertar2_a" class="timepicker" value="{{ old('despertar2_a', date_format(\Carbon\Carbon::parse($wakes[1]->timeWokeUp), 'H:i')) }}">
                                                        <label for="despertar2_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar2_d" name="despertar2_d" class="timepicker" value="{{ old('despertar2_d', date_format(\Carbon\Carbon::parse($wakes[1]->timeSlept), 'H:i')) }}">
                                                        <label for="despertar2_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                    <select class="browser-default" name="despertar2_fd" id="despertar2_fd">
                                                            <option value="" disabled selected>Selecione uma opção</option>
                                                            <option {{ old('despertar2_fd', $wakes[1]->sleepingMode) == 1 ? "selected" : "" }} value="1">Sozinho</option>
                                                            <option {{ old('despertar2_fd', $wakes[1]->sleepingMode) == 2 ? "selected" : "" }} value="2">Ninando no berço/cama</option>
                                                            <option {{ old('despertar2_fd', $wakes[1]->sleepingMode) == 3 ? "selected" : "" }} value="3">Mamando</option>
                                                            <option {{ is_numeric(old('despertar2_fd', $wakes[1]->sleepingMode)) == false ? "selected" : "" }} value="4">Outro</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar2_fd_outro">
                                                        <input type="text" id="despertar2_fd_outro" name=" despertar2_fd_outro" value="{{ old('despertar2_fd_outro', $wakes[1]->sleepingMode)}}">
                                                        <label for="despertar2_fd_outro">Como Dormiu</label>
                                                    </div>
                                                    @else

                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar2_a" name="despertar2_a" class="timepicker" value="{{ old('despertar2_a')}}">
                                                        <label for="despertar2_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar2_d" name="despertar2_d" class="timepicker" value="{{ old('despertar2_d')}}">
                                                        <label for="despertar2_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                    <select class="browser-default" name="despertar2_fd" id="despertar2_fd">
                                                            <option value="" disabled selected>Selecione uma opção</option>
                                                            <option {{ old('despertar2_fd') == 1 ? "selected" : "" }} value="1">Sozinho</option>
                                                            <option {{ old('despertar2_fd') == 2 ? "selected" : "" }} value="2">Ninando no berço/cama</option>
                                                            <option {{ old('despertar2_fd') == 3 ? "selected" : "" }} value="3">Mamando</option>
                                                            <option {{ old('despertar2_fd') == 4 ? "selected" : "" }} value="4">Outro</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar2_fd_outro">
                                                        <input type="text" id="despertar2_fd_outro" name=" despertar2_fd_outro" value="{{ old('despertar2_fd_outro')}}">
                                                        <label for="despertar2_fd_outro">Como Dormiu</label>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 3</h5>
                                                <div class="row">
                                                    @if(isset($wakes[2]))
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar3_a" name="despertar3_a" class="timepicker" value="{{ old('despertar3_a', date_format(\Carbon\Carbon::parse($wakes[2]->timeWokeUp), 'H:i')) }}">
                                                        <label for="despertar3_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar3_d" name="despertar3_d" class="timepicker" value="{{ old('despertar3_d', date_format(\Carbon\Carbon::parse($wakes[2]->timeSlept), 'H:i')) }}">
                                                        <label for="despertar3_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                    <select class="browser-default" name="despertar3_fd" id="despertar3_fd">
                                                            <option value="" disabled selected>Selecione uma opção</option>
                                                            <option {{ old('despertar3_fd', $wakes[2]->sleepingMode) == 1 ? "selected" : "" }} value="1">Sozinho</option>
                                                            <option {{ old('despertar3_fd', $wakes[2]->sleepingMode) == 2 ? "selected" : "" }} value="2">Ninando no berço/cama</option>
                                                            <option {{ old('despertar3_fd', $wakes[2]->sleepingMode) == 3 ? "selected" : "" }} value="3">Mamando</option>
                                                            <option {{ is_numeric(old('despertar3_fd', $wakes[2]->sleepingMode)) == false ? "selected" : "" }} value="4">Outro</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar3_fd_outro">
                                                        <input type="text" id="despertar3_fd_outro" name=" despertar3_fd_outro" value="{{ old('despertar3_fd_outro', $wakes[2]->sleepingMode)}}">
                                                        <label for="despertar3_fd_outro">Como Dormiu</label>
                                                    </div>
                                                    @else

                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar3_a" name="despertar3_a" class="timepicker" value="{{ old('despertar3_a')}}">
                                                        <label for="despertar3_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar3_d" name="despertar3_d" class="timepicker" value="{{ old('despertar3_d')}}">
                                                        <label for="despertar3_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                    <select class="browser-default" name="despertar3_fd" id="despertar3_fd">
                                                            <option value="" disabled selected>Selecione uma opção</option>
                                                            <option {{ old('despertar3_fd') == 1 ? "selected" : "" }} value="1">Sozinho</option>
                                                            <option {{ old('despertar3_fd') == 2 ? "selected" : "" }} value="2">Ninando no berço/cama</option>
                                                            <option {{ old('despertar3_fd') == 3 ? "selected" : "" }} value="3">Mamando</option>
                                                            <option {{ old('despertar3_fd') == 4 ? "selected" : "" }} value="4">Outro</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar3_fd_outro">
                                                        <input type="text" id="despertar3_fd_outro" name=" despertar3_fd_outro" value="{{ old('despertar3_fd_outro')}}">
                                                        <label for="despertar3_fd_outro">Como Dormiu</label>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 4</h5>
                                                <div class="row">
                                                    @if(isset($wakes[3]))
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar4_a" name="despertar4_a" class="timepicker" value="{{ old('despertar4_a', date_format(\Carbon\Carbon::parse($wakes[3]->timeWokeUp), 'H:i')) }}">
                                                        <label for="despertar4_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar4_d" name="despertar4_d" class="timepicker" value="{{ old('despertar4_d', date_format(\Carbon\Carbon::parse($wakes[3]->timeSlept), 'H:i')) }}">
                                                        <label for="despertar4_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                        <select class="browser-default" name="despertar4_fd" id="despertar4_fd">
                                                            <option value="" disabled selected>Selecione uma opção</option>
                                                            <option {{ old('despertar4_fd', $wakes[3]->sleepingMode) == 1 ? "selected" : "" }} value="1">Sozinho</option>
                                                            <option {{ old('despertar4_fd', $wakes[3]->sleepingMode) == 2 ? "selected" : "" }} value="2">Ninando no berço/cama</option>
                                                            <option {{ old('despertar4_fd', $wakes[3]->sleepingMode) == 3 ? "selected" : "" }} value="3">Mamando</option>
                                                            <option {{ is_numeric(old('despertar4_fd', $wakes[3]->sleepingMode)) == false ? "selected" : "" }} value="4">Outro</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar4_fd_outro">
                                                        <input type="text" id="despertar4_fd_outro" name=" despertar4_fd_outro" value="{{ old('despertar4_fd_outro', $wakes[3]->sleepingMode)}}">
                                                        <label for="despertar4_fd_outro">Como Dormiu</label>
                                                    </div>
                                                    @else

                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar4_a" name="despertar4_a" class="timepicker" value="{{ old('despertar4_a')}}">
                                                        <label for="despertar4_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar4_d" name="despertar4_d" class="timepicker" value="{{ old('despertar4_d')}}">
                                                        <label for="despertar4_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                    <select class="browser-default" name="despertar4_fd" id="despertar4_fd">
                                                            <option value="" disabled selected>Selecione uma opção</option>
                                                            <option {{ old('despertar4_fd') == 1 ? "selected" : "" }} value="1">Sozinho</option>
                                                            <option {{ old('despertar4_fd') == 2 ? "selected" : "" }} value="2">Ninando no berço/cama</option>
                                                            <option {{ old('despertar4_fd') == 3 ? "selected" : "" }} value="3">Mamando</option>
                                                            <option {{ old('despertar4_fd') == 4 ? "selected" : "" }} value="4">Outro</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar4_fd_outro">
                                                        <input type="text" id="despertar4_fd_outro" name=" despertar4_fd_outro" value="{{ old('despertar4_fd_outro')}}">
                                                        <label for="despertar4_fd_outro">Como Dormiu</label>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 5</h5>
                                                <div class="row">
                                                    @if(isset($wakes[4]))
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar5_a" name="despertar5_a" class="timepicker" value="{{ old('despertar5_a', date_format(\Carbon\Carbon::parse($wakes[4]->timeWokeUp), 'H:i')) }}">
                                                        <label for="despertar5_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar5_d" name="despertar5_d" class="timepicker" value="{{ old('despertar5_d', date_format(\Carbon\Carbon::parse($wakes[4]->timeSlept), 'H:i')) }}">
                                                        <label for="despertar5_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                    <select class="browser-default" name="despertar5_fd" id="despertar5_fd">
                                                            <option value="" disabled selected>Selecione uma opção</option>
                                                            <option {{ old('despertar5_fd', $wakes[4]->sleepingMode) == 1 ? "selected" : "" }} value="1">Sozinho</option>
                                                            <option {{ old('despertar5_fd', $wakes[4]->sleepingMode) == 2 ? "selected" : "" }} value="2">Ninando no berço/cama</option>
                                                            <option {{ old('despertar5_fd', $wakes[4]->sleepingMode) == 3 ? "selected" : "" }} value="3">Mamando</option>
                                                            <option {{ is_numeric(old('despertar5_fd', $wakes[4]->sleepingMode)) == false ? "selected" : "" }} value="4">Outro</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar5_fd_outro">
                                                        <input type="text" id="despertar5_fd_outro" name=" despertar5_fd_outro" value="{{ old('despertar5_fd_outro', $wakes[4]->sleepingMode)}}">
                                                        <label for="despertar5_fd_outro">Como Dormiu</label>
                                                    </div>
                                                    @else

                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar5_a" name="despertar5_a" class="timepicker" value="{{ old('despertar5_a')}}">
                                                        <label for="despertar5_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar5_d" name="despertar5_d" class="timepicker" value="{{ old('despertar5_d')}}">
                                                        <label for="despertar5_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                    <select class="browser-default" name="despertar5_fd" id="despertar5_fd">
                                                            <option value="" disabled selected>Selecione uma opção</option>
                                                            <option {{ old('despertar5_fd') == 1 ? "selected" : "" }} value="1">Sozinho</option>
                                                            <option {{ old('despertar5_fd') == 2 ? "selected" : "" }} value="2">Ninando no berço/cama</option>
                                                            <option {{ old('despertar5_fd') == 3 ? "selected" : "" }} value="3">Mamando</option>
                                                            <option {{ old('despertar5_fd') == 4 ? "selected" : "" }} value="4">Outro</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar5_fd_outro">
                                                        <input type="text" id="despertar5_fd_outro" name=" despertar5_fd_outro" value="{{ old('despertar5_fd_outro')}}">
                                                        <label for="despertar5_fd_outro">Como Dormiu</label>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="card card card-default ">

                                            <div class="card-content">
                                                <h5>Despertar 6</h5>
                                                <div class="row">
                                                    @if(isset($wakes[5]))
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar6_a" name="despertar6_a" class="timepicker" value="{{ old('despertar6_a', date_format(\Carbon\Carbon::parse($wakes[5]->timeWokeUp), 'H:i')) }}">
                                                        <label for="despertar6_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar6_d" name="despertar6_d" class="timepicker" value="{{ old('despertar6_d', date_format(\Carbon\Carbon::parse($wakes[5]->timeSlept), 'H:i')) }}">
                                                        <label for="despertar6_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                    <select class="browser-default" name="despertar6_fd" id="despertar6_fd">
                                                            <option value="" disabled selected>Selecione uma opção</option>
                                                            <option {{ old('despertar6_fd', $wakes[5]->sleepingMode) == 1 ? "selected" : "" }} value="1">Sozinho</option>
                                                            <option {{ old('despertar6_fd', $wakes[5]->sleepingMode) == 2 ? "selected" : "" }} value="2">Ninando no berço/cama</option>
                                                            <option {{ old('despertar6_fd', $wakes[5]->sleepingMode) == 3 ? "selected" : "" }} value="3">Mamando</option>
                                                            <option {{ is_numeric(old('despertar6_fd', $wakes[5]->sleepingMode)) == false ? "selected" : "" }} value="4">Outro</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar6_fd_outro">
                                                        <input type="text" id="despertar6_fd_outro" name=" despertar6_fd_outro" value="{{ old('despertar6_fd_outro', $wakes[5]->sleepingMode)}}">
                                                        <label for="despertar6_fd_outro">Como Dormiu</label>
                                                    </div>
                                                    @else

                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar6_a" name="despertar6_a" class="timepicker" value="{{ old('despertar6_a')}}">
                                                        <label for="despertar6_a">Horário que acordou</label>

                                                    </div>
                                                    <div class="input-field col m3 s12">
                                                        <input type="text" id="despertar6_d" name="despertar6_d" class="timepicker" value="{{ old('despertar6_d')}}">
                                                        <label for="despertar6_d">Horário que dormiu</label>

                                                    </div>
                                                    <div class="col m3 s12">
                                                    <label>Como dormiu</label>
                                                    <select class="browser-default" name="despertar6_fd" id="despertar6_fd">
                                                            <option value="" disabled selected>Selecione uma opção</option>
                                                            <option {{ old('despertar6_fd') == 1 ? "selected" : "" }} value="1">Sozinho</option>
                                                            <option {{ old('despertar6_fd') == 2 ? "selected" : "" }} value="2">Ninando no berço/cama</option>
                                                            <option {{ old('despertar6_fd') == 3 ? "selected" : "" }} value="3">Mamando</option>
                                                            <option {{ old('despertar6_fd') == 4 ? "selected" : "" }} value="4">Outro</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-field col m3 s12" id="despertar6_fd_outro">
                                                        <input type="text" id="despertar6_fd_outro" name=" despertar6_fd_outro" value="{{ old('despertar6_fd_outro')}}">
                                                        <label for="despertar6_fd_outro">Como Dormiu</label>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                    </div>

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

                </div>
            </div>
        </div>


@endsection

    @section('js')
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy'
            });
            $('.timepicker').timepicker({
                twelveHour: false
            });

            $("select").formSelect();
        });


        $('#despertar1_fd_outro').hide();

        $('#despertar1_fd').change(function() {
            if ($(this).val() === '4') {
                $('#despertar1_fd_outro').show();
            }
        });

        if ($('#despertar1_fd').val() === '4') {
            $('#despertar1_fd_outro').show();
        }

        $('#despertar1_fd').change(function() {
            if ($(this).val() != '4') {
                $('#despertar1_fd_outro').hide();
            }
        });

        $('#despertar2_fd_outro').hide();

        $('#despertar2_fd').change(function() {
            if ($(this).val() === '4') {
                $('#despertar2_fd_outro').show();
            }
        });

        if ($('#despertar2_fd').val() === '4') {
            $('#despertar2_fd_outro').show();
        }

        $('#despertar2_fd').change(function() {
            if ($(this).val() != '4') {
                $('#despertar2_fd_outro').hide();
            }
        });

        $('#despertar3_fd_outro').hide();


        $('#despertar3_fd').change(function() {
            if ($(this).val() === '4') {
                $('#despertar3_fd_outro').show();
            }
        });

        if ($('#despertar3_fd').val() === '4') {
            $('#despertar3_fd_outro').show();
        }

        $('#despertar3_fd').change(function() {
            if ($(this).val() != '4') {
                $('#despertar3_fd_outro').hide();
            }
        });

        $('#despertar4_fd_outro').hide();


        $('#despertar4_fd').change(function() {
            if ($(this).val() === '4') {
                $('#despertar4_fd_outro').show();
            }
        });

        if ($('#despertar4_fd').val() === '4') {
            $('#despertar4_fd_outro').show();
        }

        $('#despertar4_fd').change(function() {
            if ($(this).val() != '4') {
                $('#despertar4_fd_outro').hide();
            }
        });

        $('#despertar5_fd_outro').hide();


        $('#despertar5_fd').change(function() {
            if ($(this).val() === '4') {
                $('#despertar5_fd_outro').show();
            }
        });

        if ($('#despertar5_fd').val() === '4') {
            $('#despertar5_fd_outro').show();
        }

        $('#despertar5_fd').change(function() {
            if ($(this).val() != '4') {
                $('#despertar5_fd_outro').hide();
            }
        });

        $('#despertar6_fd_outro').hide();

        
        $('#despertar6_fd').change(function() {
            if ($(this).val() === '4') {
                $('#despertar6_fd_outro').show();
            }
        });

        if ($('#despertar6_fd').val() === '4') {
            $('#despertar6_fd_outro').show();
        }

        $('#despertar6_fd').change(function() {
            if ($(this).val() != '4') {
                $('#despertar65_fd_outro').hide();
            }
        });




    </script>
    @endsection