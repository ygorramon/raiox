@extends('site.desafio.layouts.app')
@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
@stop



@section('content')
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>PRÉ-ANÁLISE</h4>
        <textarea class="materialize-textarea">Olá, essa é uma pré-análise do seu desafio e a cada dia você terá uma diferente para agilizar ainda mais a sua análise definitiva e os seus resultados.

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

                            <input id="nameBaby" type="text" name="nameBaby" value="{{ old('nameBaby', $client->nameBaby) }}" class="validate">
                            <label for="nameBaby" class="center-align">Nome do Bebê</label>
                        </div>

                        <div class="input-field col s12 m6">

                            <input id="birthBaby" type="text" name="birthBaby" class="datepicker" value="{{ now()->diffInDays(\Carbon\Carbon::parse($client->birthBaby)) }} Dias / {{ now()->diffInMonths(\Carbon\Carbon::parse($client->birthBaby)) }} Meses" required="">
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
                            <h4 class="card-title" Meus Dados</h4>
                                Causa dos Despertares:

                        </div>
                    </div>
                </div>
                @if ($babyAge < 90) <div class="card">
                    <div class="card-content">
                        <label>Exterogestação:</label>
                        <textarea class="materialize-textarea">Seu bebê ainda está na exterogestação. Lembre que ele ainda possui uma imaturidade intensa e muita necessidade de contato e sucção, o que pode causar alguns despertares, mas a tendência é melhorar progressivamente.</textarea>
                    </div>
            </div>

            @endif
            <div class="card">
                <div class="card-content">
                    Fome:
                    <div class="row ">
                        <div class="col s12 m6 l6">
                            <h4 class="card-title ">
                                Você foi ao pediatra nos últimos 30 dias?
                            </h4>
                            <select class="browser-default" name="fome_pediatra" id="fome_pediatra">
                                <option value="" disabled selected>Selecione</option>
                                <option value="S">SIM</option>
                                <option value="N">NÃO</option>
                            </select>
                        </div>

                        <div class="col s12 m6 l6" id="fome_pediatra_peso">
                            <h4 class="card-title ">
                                O peso atual do seu bebê está adequado?
                            </h4>
                            <select class="browser-default" name="fome_peso_atual" id="fome_peso_atual">
                                <option value="" disabled selected>Selecione</option>
                                <option value="S">SIM</option>
                                <option value="N">NÃO</option>
                                <option value="N">NÃO SEI</option>
                            </select>
                        </div>
                        <div class="col s12 m6 l6" id="fome_pediatra_peso_atual_nao">

                            <textarea class="materialize-textarea">É muito importante saber se o peso atual está adequado para podermos descartar fome. Se não estiver, não poderemos descartar essa possível causa. Recomendo levar ao pediatra assim que possível para continuarmos.</textarea>

                        </div>
                        <div class="col s12 m6 l6" id="fome_pediatra_ganho_peso">
                            <h4 class="card-title ">
                                O GANHO de peso do seu bebê nos últimos 30 dais está adequado?
                            </h4>
                            <select class="browser-default" name="fome_peso_atual" id="fome_ganho_peso">
                                <option value="" disabled selected>Selecione</option>
                                <option value="S">SIM</option>
                                <option value="N">NÃO</option>
                                <option value="N">NÃO SEI</option>
                            </select>
                        </div>
                        <div class="col s12 m6 l6" id="fome_pediatra_ganho_peso_nao">

                            <textarea class="materialize-textarea">É muito importante saber se o ganho de peso está adequado para podermos descartar fome. Se não estiver, não poderemos descartar essa possível causa. Recomendo levar ao pediatra assim que possível para continuarmos.</textarea>

                        </div>

                        <div class="col s12 m6 l6" id="fome_pediatra_fraldas">
                            <h4 class="card-title ">
                                Você troca de mais de 4 fraldas cheias de urina por dia?
                            </h4>
                            <select class="browser-default" name="fome_peso_atual" id="fome_fraldas">
                                <option value="" disabled selected>Selecione</option>
                                <option value="S">SIM</option>
                                <option value="N">NÃO</option>

                            </select>
                        </div>
                        <div class="col s12 m6 l6" id="fome_fraldas_nao">

                            <textarea class="materialize-textarea">Como o principal alimento do bebê é o leite, sabe-se que sempre que houver algum prejuízo na alimentação, a diurese será o primeiro sinal a ser alterado.
Como você referiu diminuição na diurese, o ideal é que procure seu pediatra para avaliar o seu bebê e retornaremos a avaliação após.
</textarea>

                        </div>
                        <div class="col s12 m6 l6" id="fome_pediatra_evacuacao">
                            <h4 class="card-title ">
                                Você consegue identificar um padrão nas evacuações do seu bebê?
                            </h4>
                            <select class="browser-default" name="fome_peso_atual" id="fome_evacuacao">
                                <option value="" disabled selected>Selecione</option>
                                <option value="S">SIM</option>
                                <option value="N">NÃO</option>

                            </select>
                        </div>
                        <div class="col s12 m6 l6" id="fome_pediatra_evacuacao_nao">

                            <textarea class="materialize-textarea">Esse é um achado mais tardio, em relação ao padrão de diurese, mas que também estará alterado em casos de prejuízos na alimentação do bebê.
Como você referiu não identificar facilmente o padrão de evacuações do seu bebê, o ideal é que procure seu pediatra para avaliar o seu bebê e retornaremos a avaliação após

</textarea>

                        </div>
                        <div class="col s12 m6 l6" id="fome_final">

                            <textarea class="materialize-textarea">Conclusão: Ótimo! Todos os critérios de eficácia na alimentação estão adequados, o que nos leva a concluir que você está com uma boa rotina alimentar, mas como ele ainda é muito pequeno, pode ainda apresentar alguns despertares por fome. Lembrando que dificilmente terá mais do que 2 ou 3 despertares por isso e caso seu bebê acorde mais vezes, devemos continuar buscando novas causas.


</textarea>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="card">
        <div class="card-content row">
            <div class="col s12 m6 l6">
                <label>Ajustes Fome:</label>
                <textarea class="materialize-textarea" id="conclusao"></textarea>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('js')

<script>
    $(document).ready(function() {
        $('.modal').modal({

        });
        //$('#modal1').modal('open');


        $('#fome_pediatra_não').hide();
        $('#fome_pediatra_peso').hide();
        $('#fome_pediatra_peso_atual_nao').hide();
        $('#fome_pediatra_ganho_peso').hide();
        $('#fome_pediatra_ganho_peso_nao').hide();
        $('#fome_pediatra_fraldas').hide();
        $('#fome_fraldas_nao').hide();
        $('#fome_pediatra_evacuacao').hide();
        $('#fome_pediatra_evacuacao_nao').hide();
        $('#fome_final').hide();





        $('#fome_pediatra').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {
                $('#fome_pediatra_não').hide();
                $('#fome_pediatra_peso_atual_nao').hide();
                $('#fome_pediatra_peso').show();
                $('#fome_pediatra_ganho_peso').hide();
                $('#fome_pediatra_ganho_peso_nao').hide();
                $('#fome_pediatra_fraldas').hide();
                $('#fome_fraldas_nao').hide();
                $('#conclusao').val('');
                M.textareaAutoResize($('#conclusao'));
            }
            if (opt == 'N') {
                $('#fome_pediatra_não').show();
                $('#fome_pediatra_peso_atual_nao').hide();
                $('#fome_pediatra_peso').hide();
                $('#fome_pediatra_ganho_peso').hide();
                $('#fome_pediatra_ganho_peso_nao').hide();
                $('#fome_pediatra_fraldas').hide();
                $('#fome_fraldas_nao').hide();
                $('#conclusao').val('É muito importante ter a avaliação do seu pediatra para podermos descartar fome. Se ele não avaliou, não poderemos descartar essa possível causa. Recomendo levar ao pediatra assim que possível para continuarmos.');
                M.textareaAutoResize($('#conclusao'));
            }

        });

        $('#fome_peso_atual').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {
                $('#fome_pediatra_peso_atual_nao').hide();
                $('#fome_pediatra_ganho_peso').show();
                $('#fome_pediatra_ganho_peso_nao').hide();
                $('#fome_pediatra_fraldas').hide();
                $('#fome_fraldas_nao').hide();
                $('#conclusao').val('');
                M.textareaAutoResize($('#conclusao'));
            }
            if (opt == 'N') {

                $('#fome_pediatra_ganho_peso').hide();
                $('#fome_pediatra_ganho_peso_nao').hide();
                $('#fome_pediatra_fraldas').hide();
                $('#fome_fraldas_nao').hide();
                $('#conclusao').val('É muito importante saber se o peso atual está adequado para podermos descartar fome. Se não estiver, não poderemos descartar essa possível causa. Recomendo levar ao pediatra assim que possível para continuarmos.');
                M.textareaAutoResize($('#conclusao'));
            }

        });

        $('#fome_ganho_peso').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {
                $('#fome_pediatra_peso_atual_nao').hide();
                $('#fome_pediatra_fraldas').show();
                $('#fome_fraldas_nao').hide();
                $('#conclusao').val('');
                M.textareaAutoResize($('#conclusao'));
            }
            if (opt == 'N') {

                $('#fome_pediatra_fraldas').hide();
                $('#fome_fraldas_nao').hide();
                $('#conclusao').val('É muito importante saber se o ganho de peso está adequado para podermos descartar fome. Se não estiver, não poderemos descartar essa possível causa. Recomendo levar ao pediatra assim que possível para continuarmos.');
                M.textareaAutoResize($('#conclusao'));

            }

        });

        $('#fome_fraldas').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {

                $('#fome_pediatra_evacuacao').show();
                $('#conclusao').val('');
                M.textareaAutoResize($('#conclusao'));
            }
            if (opt == 'N') {
                $('#fome_pediatra_ganho_peso_nao').hide();
                $('#fome_pediatra_evacuacao').hide();
                $('#fome_pediatra_evacuacao_nao').hide();
                $('#conclusao').val('Como o principal alimento do bebê é o leite, sabe-se que sempre que houver algum prejuízo na alimentação, a diurese será o primeiro sinal a ser alterado. Como você referiu diminuição na diurese, o ideal é que procure seu pediatra para avaliar o seu bebê e retornaremos a avaliação após.');
                M.textareaAutoResize($('#conclusao'));

            }

        });
        $('#fome_evacuacao').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {
                @if ($babyAge < 90)
                $('#conclusao').val('Esse é um achado mais tardio, em relação ao padrão de diurese, mas que também estará alterado em casos de prejuízos na alimentação do bebê. Como você referiu não identificar facilmente o padrão de evacuações do seu bebê, o ideal é que procure seu pediatra para avaliar o seu bebê e retornaremos a avaliação após');
                @endif
                
                M.textareaAutoResize($('#conclusao'));

            }
            if (opt == 'N') {
               
              
                $('#conclusao').val('Conclusão: Ótimo! Todos os critérios de eficácia na alimentação estão adequados, o que nos leva a concluir que você está com uma boa rotina alimentar, mas como ele ainda é muito pequeno, pode ainda apresentar alguns despertares por fome. Lembrando que dificilmente terá mais do que 2 ou 3 despertares por isso e caso seu bebê acorde mais vezes, devemos continuar buscando novas causas.');
                M.textareaAutoResize($('#conclusao'));

            }

        });
    });
</script>

@endsection