@extends('site.desafio.layouts.app')
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
@stop



@section('content')


    <div class="row">

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
                                <h4 class="card-title" Meus Dados</h4>
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

                            <div class="col s12 m6 l10">
                                <h4 class="card-title"> Associações:</h4>
                                <h4 class="card-title" Meus Dados> Quais associações do sono o seu bebê tem nas SONECAS?
                                </h4>

                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_colica"
                                            id="dor_colica" />
                                        <span>Colo/ninar</span>

                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_colica"
                                            id="dor_colica" />

                                        <span>Mamar</span>
                                        <span></span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_colica"
                                            id="dor_colica" />

                                        <span>Cama Compartilhada</span>
                                        <span></span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_colica"
                                            id="dor_colica" />

                                        <span>Rede</span>
                                        <span></span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_colica"
                                            id="dor_colica" />

                                        <span>Chupar Dedo</span>
                                        <span></span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_colica"
                                            id="dor_colica" />

                                        <span>Chupeta</span>
                                        <span></span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_colica"
                                            id="dor_colica" />

                                        <span>Naninha</span>
                                        <span></span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_colica"
                                            id="dor_colica" />

                                        <span>Ruído Branco</span>
                                        <span></span>
                                    </label>
                                </p>
                            </div>

                            <div class="col s12 m6 l10">
                                <h4 class="card-title" Meus Dados> Quais associações do sono o seu bebê tem no SONO NOTURNO?
                                </h4>


                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_colica"
                                            id="dor_colica" />
                                        <span>Colo/ninar</span>

                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_colica"
                                            id="dor_colica" />

                                        <span>Mamar</span>
                                        <span></span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_colica"
                                            id="dor_colica" />

                                        <span>Cama Compartilhada</span>
                                        <span></span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_colica"
                                            id="dor_colica" />

                                        <span>Rede</span>
                                        <span></span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_colica"
                                            id="dor_colica" />

                                        <span>Chupar Dedo</span>
                                        <span></span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_colica"
                                            id="dor_colica" />

                                        <span>Chupeta</span>
                                        <span></span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_colica"
                                            id="dor_colica" />

                                        <span>Naninha</span>
                                        <span></span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_colica"
                                            id="dor_colica" />

                                        <span>Ruído Branco</span>
                                        <span></span>
                                    </label>
                                </p>
                            </div>
                            <div class="col s12 m6 l10">
                                <h4 class="card-title"> As associações do sono te incomodam?
                                </h4>
                                <select class="browser-default" name="associacoes_incomodam" id="associacoes_incomodam">
                                    <option value="" disabled selected>Selecione</option>
                                    <option value="S">SIM</option>
                                    <option value="N">NÃO</option>
                                </select>
                                <div id="associacoes_incomodam_sim">
                                    <label> Descreva abaixo qual associação mais te incomoda e o porquê.
                                    <textarea class="materialize-textarea" name="associacoes_descricao"></textarea>
                                </div>


                            </div>
                        </div>
                    </div>



                </div>

            </div>
        </div>
    </div>

@endsection
@section('js')




    <script>
         $(document).ready(function() {
        $('#associacoes_incomodam_sim').hide();

        $('#associacoes_incomodam').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {
                $('#associacoes_incomodam_sim').show();

            }
            if (opt == 'N') {


            }

        });
    });
    </script>


@endsection
