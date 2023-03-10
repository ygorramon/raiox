@extends('site.desafio.layouts.app')
@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
@stop



@section('content')
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>PASSO 2 - Causa dos Despertares</h4>

        
<div class="video-container">
<iframe width="560" height="315" src="https://www.youtube.com/embed/Z7hVH-ElzdE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>      </div>
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
                            <label for="nameBaby" class="center-align">Nome do Beb??</label>
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
        <form action="{{route('analyze.formulario.create', $challenge->id)}}" method="post">
           @csrf
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
                        <label>Exterogesta????o:</label>
                        <textarea class="materialize-textarea" name="ajuste_exterogestacao">Seu beb?? ainda est?? na exterogesta????o. Lembre que ele ainda possui uma imaturidade intensa e muita necessidade de contato e suc????o, o que pode causar alguns despertares, mas a tend??ncia ?? melhorar progressivamente.</textarea>
                    </div>
            </div>
            @endif
            @if($babyAge < 365) <div class="card">
                <div class="card-content">
                    Fome:
                    <div class="row ">
                        <div class="col s12 m6 l6">
                            <h4 class="card-title ">
                                Voc?? foi ao pediatra nos ??ltimos 30 dias?
                            </h4>
                            <select class="browser-default" name="fome_pediatra" id="fome_pediatra" >
                                <option value="" disabled selected>Selecione</option>
                                <option value="S">SIM</option>
                                <option value="N">N??O</option>
                            </select>
                        </div>

                        <div class="col s12 m6 l6" id="fome_pediatra_peso">
                            <h4 class="card-title ">
                                O peso atual do seu beb?? est?? adequado?
                            </h4>
                            <select class="browser-default" name="fome_peso_atual" id="fome_peso_atual">
                                <option value="" disabled selected>Selecione</option>
                                <option value="S">SIM</option>
                                <option value="N">N??O</option>
                                <option value="N">N??O SEI</option>
                            </select>
                        </div>
                        <div class="col s12 m6 l6" id="fome_pediatra_peso_atual_nao">

                            <textarea class="materialize-textarea">?? muito importante saber se o peso atual est?? adequado para podermos descartar fome. Se n??o estiver, n??o poderemos descartar essa poss??vel causa. Recomendo levar ao pediatra assim que poss??vel para continuarmos.</textarea>

                        </div>
                        <div class="col s12 m6 l6" id="fome_pediatra_ganho_peso">
                            <h4 class="card-title ">
                                O GANHO de peso do seu beb?? nos ??ltimos 30 dais est?? adequado?
                            </h4>
                            <select class="browser-default" name="fome_ganho_peso" id="fome_ganho_peso" >
                                <option value="" disabled selected>Selecione</option>
                                <option value="S">SIM</option>
                                <option value="N">N??O</option>
                                <option value="N">N??O SEI</option>
                            </select>
                        </div>
                        <div class="col s12 m6 l6" id="fome_pediatra_ganho_peso_nao">

                            <textarea class="materialize-textarea">?? muito importante saber se o ganho de peso est?? adequado para podermos descartar fome. Se n??o estiver, n??o poderemos descartar essa poss??vel causa. Recomendo levar ao pediatra assim que poss??vel para continuarmos.</textarea>

                        </div>

                        <div class="col s12 m6 l6" id="fome_pediatra_fraldas" >
                            <h4 class="card-title ">
                                Voc?? troca de mais de 4 fraldas cheias de urina por dia?
                            </h4>
                            <select class="browser-default" name="fome_fraldas" id="fome_fraldas">
                                <option value="" disabled selected>Selecione</option>
                                <option value="S">SIM</option>
                                <option value="N">N??O</option>

                            </select>
                        </div>
                        <div class="col s12 m6 l6" id="fome_fraldas_nao">

                            <textarea class="materialize-textarea">Como o principal alimento do beb?? ?? o leite, sabe-se que sempre que houver algum preju??zo na alimenta????o, a diurese ser?? o primeiro sinal a ser alterado.
Como voc?? referiu diminui????o na diurese, o ideal ?? que procure seu pediatra para avaliar o seu beb?? e retornaremos a avalia????o ap??s.
</textarea>

                        </div>
                        <div class="col s12 m6 l6" id="fome_pediatra_evacuacao">
                            <h4 class="card-title ">
                                Voc?? consegue identificar um padr??o nas evacua????es do seu beb???
                            </h4>
                            <select class="browser-default" name="fome_evacuacao" id="fome_evacuacao">
                                <option value=""  selected>Selecione</option>
                                <option value="S">SIM</option>
                                <option value="N">N??O</option>

                            </select>
                        </div>
                        <div class="col s12 m6 l6" id="fome_pediatra_evacuacao_nao">

                            <textarea class="materialize-textarea">Esse ?? um achado mais tardio, em rela????o ao padr??o de diurese, mas que tamb??m estar?? alterado em casos de preju??zos na alimenta????o do beb??.
Como voc?? referiu n??o identificar facilmente o padr??o de evacua????es do seu beb??, o ideal ?? que procure seu pediatra para avaliar o seu beb?? e retornaremos a avalia????o ap??s

</textarea>

                        </div>
                        <div class="col s12 m6 l6" id="fome_final">

                            <textarea class="materialize-textarea">Conclus??o: ??timo! Todos os crit??rios de efic??cia na alimenta????o est??o adequados, o que nos leva a concluir que voc?? est?? com uma boa rotina alimentar, mas como ele ainda ?? muito pequeno, pode ainda apresentar alguns despertares por fome. Lembrando que dificilmente ter?? mais do que 2 ou 3 despertares por isso e caso seu beb?? acorde mais vezes, devemos continuar buscando novas causas.


</textarea>

                        </div>

                    </div>
                </div>
        </div>
        @endif
        @if($babyAge > 365 && $babyAge < 730) <div class="card">
            <div class="card-content">
                Fome:
                <div class="row ">
                    <div class="col s12 m6 l6" id="fome_pediatra_peso_medio">
                        <h4 class="card-title ">
                            O peso atual do seu beb?? est?? adequado?
                        </h4>
                        <select class="browser-default" name="fome_peso_atual" id="fome_peso_atual_medio" >
                            <option value="" disabled selected>Selecione</option>
                            <option value="S">SIM</option>
                            <option value="N">N??O</option>
                            <option value="N">N??O SEI</option>
                        </select>
                    </div>
                    <div class="col s12 m6 l6" id="fome_pediatra_fraldas_medio">
                        <h4 class="card-title ">
                            Voc?? troca de mais de 4 fraldas cheias de urina por dia?
                        </h4>
                        <select class="browser-default" name="fome_fraldas" id="fome_fraldas_medio" >
                            <option value="" disabled selected>Selecione</option>
                            <option value="S">SIM</option>
                            <option value="N">N??O</option>

                        </select>
                    </div>
                    <div class="col s12 m6 l6" id="fome_pediatra_evacuacao_medio">
                        <h4 class="card-title ">
                            Voc?? consegue identificar um padr??o nas evacua????es do seu beb???
                        </h4>
                        <select class="browser-default" name="fome_evacuacoes" id="fome_evacuacao_medio" >
                            <option value="" disabled selected>Selecione</option>
                            <option value="S">SIM</option>
                            <option value="N">N??O</option>

                        </select>
                    </div>
                </div>
            </div>
    </div>
    @endif
    @if($babyAge >= 730) <div class="card">
        <div class="card-content">
            Fome:
            <div class="row ">
                <div class="col s12 m6 l6" id="fome_pediatra_peso_maior" >
                    <h4 class="card-title ">
                        O peso atual do seu beb?? est?? adequado?
                    </h4>
                    <select class="browser-default" name="fome_peso_atual" id="fome_peso_atual_maior" >
                        <option value="" disabled selected>Selecione</option>
                        <option value="S">SIM</option>
                        <option value="N">N??O</option>
                        <option value="N">N??O SEI</option>
                    </select>
                </div>

            </div>
        </div>
    </div>
    @endif
    <div class="card">
        <div class="card-content">
            Dor:
            <div class="row ">
                <div class="col s12 ">
                    <h4 class="card-title ">
                        Voc?? acha que o seu beb?? est?? acordando atualmente por causa de alguma dor ou
                        desconforto? Ex: gases, c??licas, disquesia, refluxo, nascimento de dentes,
                        resfriado, gripe..
                    </h4>
                    <select class="browser-default" name="dor" id="dor" >
                        <option value="" disabled selected>Selecione</option>
                        <option value="S">SIM</option>
                        <option value="N">N??O</option>
                    </select>
                    <div class="col s12 " id="dor_causa">
                        <h4 class="card-title ">
                            Qual?
                        </h4>
                        <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_colica" id="dor_colica"/>
                                        <span>C??licas, gases ou disquesia</span>
                                    </label>
                                </p>
                        <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_refluxo" id="dor_refluxo"/>
                                        <span>Refluxo patol??gico (doen??a do refluxo)</span>
                                    </label>
                                </p>
                        <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_dente" id="dor_dente"/>
                                        <span>Nascimento de Dentes</span>
                                    </label>
                                </p>
                        <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" name="dor_outra" id="dor_outra" />
                                        <span>Outra</span>
                                    </label>
                                </p>
                                <div id="dor_outro_desc">
                            <label>Descreva abaixo a dor ou desconforto que voc?? acha que est?? causando despertares</label>
                        <textarea class="materialize-textarea" name="dor_outra_descricao" id="dor_outra_descricao"></textarea>
                                </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @if($babyAge <= 540)
    <div class="card">
        <div class="card-content">
            Salto de desenvolvimento:
            <div class="row ">
                <div class="col s12 ">
                    <h4 class="card-title ">
                        Voc?? acha que o seu beb?? est?? acordando atualmente por causa de um salto de
                        desenvolvimento?
                    </h4>
                    <select class="browser-default" name="salto" id="salto">
                        <option value="" disabled selected>Selecione</option>
                        <option value="S">SIM</option>
                        <option value="N">N??O</option>
                    </select>
                    <div class="col s12 " id="salto_sim">
                        <h4 class="card-title ">
                            Voc?? consegue perceber novos marcos de desenvolvimento?
                        </h4>
                        <select class="browser-default" name="salto_marcos" id="salto_marcos">
                            <option value="" disabled selected>Selecione</option>
                            <option value="S">SIM</option>
                            <option value="N">N??O</option>
                        </select>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>
    @endif
    @if ($babyAge > 180 && $babyAge < 540) <div class="card">
        <div class="card-content">
            Ang??stia da separa????o:
            <div class="row ">
                <div class="col s12 ">
                    <h4 class="card-title ">
                        Voc?? acha que o seu beb?? est?? acordando atualmente por causa da ang??stia da separa????o?
                    </h4>
                    <select class="browser-default" name="angustia" id="angustia">
                        <option value="" disabled selected>Selecione</option>
                        <option value="S">SIM</option>
                        <option value="N">N??O</option>
                    </select>
                    <div class="col s12 " id="angustia_sim">
                        <h4 class="card-title ">
                            Ele passou a chorar forte QUANDO VOC?? SAI DO CAMPO DE VIS??O?
                        </h4>
                        <select class="browser-default" name="angustia_sim_campo" id="angustia_sim_campo">
                            <option value="" disabled selected>Selecione</option>
                            <option value="S">SIM</option>
                            <option value="N">N??O</option>
                        </select>
                        <h4 class="card-title ">
                            Se o pai for atender algum despertar ?? noite, o choro aumenta?
                        </h4>
                        <select class="browser-default" name="angustia_sim_pai" id="angustia_sim_pai">
                            <option value="" disabled selected>Selecione</option>
                            <option value="S">SIM</option>
                            <option value="N">N??O</option>
                        </select>
                    </div>


                </div>
            </div>
        </div>
</div>
@endif
<div class="card">
    <div class="card-content">
        Telas:
        <div class="row ">
            <div class="col s12 ">
                <h4 class="card-title ">
                    Seu beb?? ?? exposto ??s telas?
                </h4>
                <select class="browser-default" name="telas" id="telas">
                    <option value="" disabled selected>Selecione</option>
                    <option value="S">SIM</option>
                    <option value="N">N??O</option>
                </select>


            </div>
        </div>
    </div>
</div>
<button type="submit" class="btn"> Enviar</button>

</div>

</div>
<div class="card">
    <div class="card-content row">
        <div class="col s12 m6 l6">
            <label>Ajustes Fome:</label>
            <textarea class="materialize-textarea" id="conclusao_fome" name="conclusao_fome"></textarea>
        </div>
    </div>
    <div class="card-content row">
        <div class="col s12 m6 l6">
            <label>Ajustes Dor:</label>
            <textarea class="materialize-textarea" id="conclusao_dor"  name="conclusao_dor"></textarea>
            <textarea class="materialize-textarea" id="conclusao_dor_colica"  name="conclusao_dor_colica"></textarea>
            <textarea class="materialize-textarea" id="conclusao_dor_refluxo" name="conclusao_dor_refluxo"></textarea>
            <textarea class="materialize-textarea" id="conclusao_dor_dente" name="conclusao_dor_dente"></textarea>
        </div>
    </div>
    <div class="card-content row">
        <div class="col s12 m6 l6">
            <label>Ajustes Salto:</label>
            <textarea class="materialize-textarea" id="conclusao_salto" name="conclusao_salto"></textarea>
        </div>
    </div>
    @if ($babyAge > 180 && $babyAge < 540) <div class="card-content row">
        <div class="col s12 m6 l6">
            <label>Ajustes Angustia da Separa????o:</label>
            <textarea class="materialize-textarea" id="conclusao_angustia" name="conclusao_angustia"></textarea>
        </div>
</div>
@endif
<div class="card-content row">
    <div class="col s12 m6 l6">
        <label>Ajustes Telas:</label>
        <textarea class="materialize-textarea" id="conclusao_telas" name="conclusao_telas"></textarea>
    </div>
</div>
</div>
</form>
</div>
</div>

@endsection
@section('js')

<script>
    $(document).ready(function() {
        $('.modal').modal({

        });
        //$('#modal1').modal('open');


        $('#fome_pediatra_n??o').hide();
        $('#fome_pediatra_peso').hide();
        $('#fome_pediatra_peso_atual_nao').hide();
        $('#fome_pediatra_ganho_peso').hide();
        $('#fome_pediatra_ganho_peso_nao').hide();
        $('#fome_pediatra_fraldas').hide();
        $('#fome_fraldas_nao').hide();
        $('#fome_pediatra_evacuacao').hide();
        $('#fome_pediatra_evacuacao_nao').hide();
        $('#fome_final').hide();
        $('#dor_causa').hide();
        $('#salto_sim').hide();
        $('#salto_marcos_sim').hide();
        $('#angustia_sim').hide();
        $('#fome_pediatra_fraldas_medio').hide();
        $('#fome_pediatra_evacuacao_medio').hide();
        $('#fome_pediatra_peso_maior').hide();
        $('#conclusao_dor_colica').hide();
        $('#conclusao_dor_refluxo').hide();
        $('#conclusao_dor_dente').hide();
        $('#dor_outro_desc').hide();
        @if($babyAge >= 730)
        $('#fome_pediatra_peso_maior').show();
        $('#fome_peso_atual_maior').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {

                $('#conclusao_fome').val(
                    '??timo! Nessa idade ?? bem improv??vel que o seu filho ainda acorde por fome.Seus principais Desafios agora s??o outros, principalmente gasto de energia, birras, falta de bons h??bitos e associa????es. Mas caso suspeite de que a alimenta????o do seu filho n??o est?? sendo o suficiente, me comunique por aqui e passe por uma consulta com seu pediatra ou nutricionista. Trabalharemos em conjunto para te ajudar.'
                );

                M.textareaAutoResize($('#conclusao_fome'));
            }
            if (opt == 'N') {


                $('#conclusao_fome').val(
                    '?? muito importante saber se o peso atual est?? adequado para podermos descartar fome. Se n??o estiver, n??o poderemos descartar essa poss??vel causa. Recomendo levar ao pediatra as-sim que poss??vel para continuarmos.'
                );
                M.textareaAutoResize($('#conclusao_fome'));

            }

        });
        @endif



        @if($babyAge > 365 && $babyAge < 730)
        $('#fome_pediatra_peso_medio').show();

        $('#fome_peso_atual_medio').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {
                $('#fome_pediatra_peso_atual_nao').hide();
                $('#fome_pediatra_fraldas_medio').show();
                $('#fome_pediatra_ganho_peso_nao').hide();
                $('#fome_pediatra_fraldas').hide();
                $('#fome_fraldas_nao').hide();
                $('#conclusao_fome').val('');
                M.textareaAutoResize($('#conclusao_fome'));
            }
            if (opt == 'N') {

                $('#fome_pediatra_ganho_peso').hide();
                $('#fome_pediatra_ganho_peso_nao').hide();
                $('#fome_pediatra_fraldas_medio').hide();
                $('#fome_fraldas_nao').hide();
                $('#conclusao_fome').val(
                    '?? muito importante saber se o peso atual est?? adequado para podermos descartar fome. Se n??o estiver, n??o poderemos descartar essa poss??vel causa. Recomendo levar ao pediatra assim que poss??vel para continuarmos.'
                );
                M.textareaAutoResize($('#conclusao_fome'));
            }

        });

        $('#fome_fraldas_medio').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {

                $('#fome_pediatra_evacuacao_medio').show();
                $('#conclusao_fome').val('');
                M.textareaAutoResize($('#conclusao_fome'));
            }
            if (opt == 'N') {
                $('#fome_pediatra_ganho_peso_nao').hide();
                $('#fome_pediatra_evacuacao').hide();
                $('#fome_pediatra_evacuacao_nao').hide();
                $('#conclusao_fome').val(
                    'Como o principal alimento do beb?? ?? o leite, sabe-se que sempre que houver algum preju??zo na alimenta????o, a diurese ser?? o primeiro sinal a ser alterado. Como voc?? referiu diminui????o na diurese, o ideal ?? que procure seu pediatra para avaliar o seu beb?? e retornaremos a avalia????o ap??s.'
                );
                M.textareaAutoResize($('#conclusao_fome'));

            }

        });

        $('#fome_evacuacao_medio').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {

                $('#conclusao_fome').val(
                    'Conclus??o: ??timo! Todos os crit??rios de efic??cia na alimenta????o est??o adequados, o que nos leva a concluir que voc?? est?? com uma boa rotina alimentar e podemos descartar a fome como causa de despertares. E se caso surgir a d??vida pois ele s?? volta a dormir mamando, lembre que o beb?? mama por v??rias raz??es, n??o apenas a fome. Mamar relaxa, acolhe, alivia a dor e a associa????o. N??s encontraremos a causa para esses despertares.'
                );

                M.textareaAutoResize($('#conclusao_fome'));
            }
            if (opt == 'N') {


                $('#conclusao_fome').val(
                    'Esse ?? um achado mais tardio, em rela????o ao padr??o de diurese, mas que tamb??m estar?? alterado em casos de preju??zos na alimenta????o do beb??. Como voc?? referiu n??o identificar facilmente o padr??o de evacua????es do seu beb??, o ideal ?? que procure seu pediatra para avaliar o seu beb?? e retornaremos a avalia????o ap??s.'
                );
                M.textareaAutoResize($('#conclusao_fome'));

            }

        });

        @endif








        $('#fome_pediatra').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {
                $('#fome_pediatra_n??o').hide();
                $('#fome_pediatra_peso_atual_nao').hide();
                $('#fome_pediatra_peso').show();
                $('#fome_pediatra_ganho_peso').hide();
                $('#fome_pediatra_ganho_peso_nao').hide();
                $('#fome_pediatra_fraldas').hide();
                $('#fome_fraldas_nao').hide();
                $('#conclusao_fome').val('');
                M.textareaAutoResize($('#conclusao_fome'));
            }
            if (opt == 'N') {
                $('#fome_pediatra_n??o').show();
                $('#fome_pediatra_peso_atual_nao').hide();
                $('#fome_pediatra_peso').hide();
                $('#fome_pediatra_ganho_peso').hide();
                $('#fome_pediatra_ganho_peso_nao').hide();
                $('#fome_pediatra_fraldas').hide();
                $('#fome_fraldas_nao').hide();
                $('#conclusao_fome').val(
                    '?? muito importante ter a avalia????o do seu pediatra para podermos descartar fome. Se ele n??o avaliou, n??o poderemos descartar essa poss??vel causa. Recomendo levar ao pediatra assim que poss??vel para continuarmos.'
                );
                M.textareaAutoResize($('#conclusao_fome'));
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
                $('#conclusao_fome').val('');
                M.textareaAutoResize($('#conclusao_fome'));
            }
            if (opt == 'N') {

                $('#fome_pediatra_ganho_peso').hide();
                $('#fome_pediatra_ganho_peso_nao').hide();
                $('#fome_pediatra_fraldas').hide();
                $('#fome_fraldas_nao').hide();
                $('#conclusao_fome').val(
                    '?? muito importante saber se o peso atual est?? adequado para podermos descartar fome. Se n??o estiver, n??o poderemos descartar essa poss??vel causa. Recomendo levar ao pediatra assim que poss??vel para continuarmos.'
                );
                M.textareaAutoResize($('#conclusao_fome'));
            }

        });

        $('#fome_ganho_peso').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {
                $('#fome_pediatra_peso_atual_nao').hide();
                $('#fome_pediatra_fraldas').show();
                $('#fome_fraldas_nao').hide();
                $('#conclusao_fome').val('');
                M.textareaAutoResize($('#conclusao_fome'));
            }
            if (opt == 'N') {

                $('#fome_pediatra_fraldas').hide();
                $('#fome_fraldas_nao').hide();
                $('#conclusao_fome').val(
                    '?? muito importante saber se o ganho de peso est?? adequado para podermos descartar fome. Se n??o estiver, n??o poderemos descartar essa poss??vel causa. Recomendo levar ao pediatra assim que poss??vel para continuarmos.'
                );
                M.textareaAutoResize($('#conclusao_fome'));

            }

        });

        $('#fome_fraldas').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {

                $('#fome_pediatra_evacuacao').show();
                $('#conclusao_fome').val('');
                M.textareaAutoResize($('#conclusao_fome'));
            }
            if (opt == 'N') {
                $('#fome_pediatra_ganho_peso_nao').hide();
                $('#fome_pediatra_evacuacao').hide();
                $('#fome_pediatra_evacuacao_nao').hide();
                $('#conclusao_fome').val(
                    'Como o principal alimento do beb?? ?? o leite, sabe-se que sempre que houver algum preju??zo na alimenta????o, a diurese ser?? o primeiro sinal a ser alterado. Como voc?? referiu diminui????o na diurese, o ideal ?? que procure seu pediatra para avaliar o seu beb?? e retornaremos a avalia????o ap??s.'
                );
                M.textareaAutoResize($('#conclusao_fome'));

            }

        });
        $('#fome_evacuacao').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {
                @if($babyAge <= 90)
                $('#conclusao_fome').val(
                    'Conclus??o: ??timo! Todos os crit??rios de efic??cia na alimenta????o est??o adequados, o que nos leva a concluir que voc?? est?? com uma boa rotina alimentar, mas como ele ainda ?? muito pequeno, pode ainda apresentar alguns despertares por fome. Lembrando que dificilmente ter?? mais do que 2 ou 3 despertares por isso e caso seu beb?? acorde mais vezes, devemos continuar buscando novas causas.'
                );
                @endif
                @if($babyAge > 90)
                $('#conclusao_fome').val(
                    'Conclus??o: ??timo! Todos os crit??rios de efic??cia na alimenta????o est??o adequados, o que nos leva a concluir que voc?? est?? com uma boa rotina alimentar e podemos descartar a fome como causa de despertares. E se caso surgir a d??vida pois ele s?? volta a dormir mamando, lembre que o beb?? mama por v??rias raz??es, n??o apenas a fome. Mamar relaxa, acolhe, alivia a dor e a associa????o. N??s encontraremos a causa para esses despertares.'
                );
                @endif
                M.textareaAutoResize($('#conclusao_fome'));
            }
            if (opt == 'N') {


                $('#conclusao_fome').val(
                    'Esse ?? um achado mais tardio, em rela????o ao padr??o de diurese, mas que tamb??m estar?? alterado em casos de preju??zos na alimenta????o do beb??. Como voc?? referiu n??o identificar facilmente o padr??o de evacua????es do seu beb??, o ideal ?? que procure seu pediatra para avaliar o seu beb?? e retornaremos a avalia????o ap??s.'
                );
                M.textareaAutoResize($('#conclusao_fome'));

            }

        });

        $('#dor').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {


                $('#conclusao_dor').val('?? importante descartar todo tipo de desconforto do beb??!');
                M.textareaAutoResize($('#conclusao_dor'));
                $('#dor_causa').show();

            }
            if (opt == 'N') {

                $('#conclusao_dor').val('Conclus??o: ??timo! Ent??o est?? descartada como poss??vel causa de despertares!');
                M.textareaAutoResize($('#conclusao_dor'));
                $('#dor_causa').hide();
            }

        });

        $('#dor_colica').click(function() {
            if($('#dor_colica').is(':checked')){
                $('#conclusao_dor_colica').show();
            $('#conclusao_dor_colica').val('C??licas, gases e disquesia realmente podem causar dor e desconforto no beb??, consequentemente, pode causar despertares. Por isso eu criei o curso gratuito "Descomplicando as c??licas do beb?????, no qual eu ensino tudo sobre essa importante causa de dor. Voc?? j?? assistiu? Se n??o, vou deixar aqui o link para voc??: https://youtube.com/playlist?list=PLaQhiV_BorwFDdu3bs90TQfZCTVoSJtQx Al??m disso, ?? muito importante que o seu pediatra esteja ciente do que est?? acontecendo porque infe-lizmente n??s n??o podemos abordar alguns temas como diagn??stico e tratamento individuais aqui. Mas ?? muito importante que voc?? entenda que a dor n??o pode ser uma raz??o para voc?? abandonar os ajustes e o acompanhamento. Na verdade, o ideal ?? que, se poss??vel, voc?? atue paralelamente no al??vio do desconforto e nos ajustes de sono. Conta conosco para isso!');
                M.textareaAutoResize($('#conclusao_dor_colica'));
               
            }else
            {
                $('#conclusao_dor_colica').hide();
               
            }
               
});
        $('#dor_refluxo').click(function() {
            
            if($('#dor_refluxo').is(':checked')){
                $('#conclusao_dor_refluxo').show();
            $('#conclusao_dor_refluxo').val('Quanto ao refluxo, ?? importante lembrar que existe uma grande diferen??a entre ???refluxo fisiol??gico???, que ?? aquele beb?? que golfa, n??o causa grandes desconfortos ou comprometimento no ganho de peso, logo, tamb??m n??o ?? o suficiente para causar despertares. Enquanto a doen??a do refluxo ?? a condi????o patol??gica que realmente pode trazer preju??zos ?? sa??de do seu filho, como dor e perda de peso, re-sultando em despertares ?? noite bastante desconfort??veis. Se o seu caso realmente for doen??a do refluxo, sugiro fazer os ajustes de sono concomitantes ao seu tratamento afim de estabilizar o desconforto, ou seja, n??o ?? preciso esperar a cura desse refluxo para come??ar a ter melhorias no sono do beb??.');
                M.textareaAutoResize($('#conclusao_dor_refluxo'));
               
            }else
            {
                $('#conclusao_dor_refluxo').hide();
               
            }
               
});
        $('#dor_dente').click(function() {
            
            if($('#dor_dente').is(':checked')){
                $('#conclusao_dor_dente').show();
            $('#conclusao_dor_dente').val('Quanto ao nascimento de dentes, essa ?? outra importante causa de dor, desconforto e de despertares, mas que costuma ser facilmente resolvida com medidas n??o medicamentosas como mordedores gela-dos. Se a dor estiver muito intensa, voc?? pode oferecer analg??sicos simples prescritos pelo seu pedi-atra. OBS: N??o ?? comum que seja causa de muitos despertares noturnos.');
                M.textareaAutoResize($('#conclusao_dor_dente'));
               
            }else
            {
                $('#conclusao_dor_dente').hide();
               
            }
               
});
        $('#dor_outra').click(function() {
            
            if($('#dor_outra').is(':checked')){
                $('#dor_outro_desc').show();
           
               
            }else
            {
                $('#dor_outro_desc').hide();
               
            }
               
});



        $('#salto').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {


                $('#conclusao_salto').val('');
                M.textareaAutoResize($('#conclusao_salto'));
                $('#salto_sim').show();

            }
            if (opt == 'N') {

                $('#conclusao_salto').val('Conclus??o: ??timo! Os saltos s??o momentos especiais de desenvolvimento do beb??, mas que podem vir acompanhados de despertares. Que bom que n??o ?? o seu caso, vamos passar para a pr??xima!');
                M.textareaAutoResize($('#conclusao_salto'));
                $('#salto_sim').hide();
                $('#salto_marcos_sim').hide();

            }

        });

        $('#salto_marcos').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {


                $('#conclusao_salto').val('Os saltos s??o mesmo importantes causas de despertares porque o beb?? pode ficar mais alerta ou assus-tado devido a tantas novidades. Pode ser que fique inevit??vel desenvolver associa????es nesse per??odo, mas se esse for o caso, n??s iremos desfaze-la assim que o salto acabar. Al??m disso, ?? importante verificarmos quais necessidades de sono do seu beb?? est??o mudan-do. E o Desafio ?? fundamental para isso! Conte conosco.');
                M.textareaAutoResize($('#conclusao_salto'));
                $('#salto_sim').show();
                $('#salto_marcos_sim').show();


            }
            if (opt == 'N') {

                $('#conclusao_salto').val('Lembra que o salto de desenvolvimento ?? identificado pelos novos marcos de desenvolvimento! E n??o pelo aumento de despertares, ok?');
                M.textareaAutoResize($('#conclusao_salto'));

                $('#salto_marcos_sim').hide();

            }

        });

        $('#angustia').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {


                $('#conclusao_angustia').val('');
                M.textareaAutoResize($('#conclusao_angustia'));
                $('#angustia_sim').show();

            }
            if (opt == 'N') {

                $('#conclusao_angustia').val('Conclus??o: ??timo! A ang??stia da separa????o n??o costuma causar tantos despertares assim. O mais comum ?? haver o aumento da intensidade do choro durante esses despertares que foram causados por outras raz??es. Vamos continuar nossa an??lise!');
                M.textareaAutoResize($('#conclusao_angustia'));
                $('#angustia_sim').hide();


            }

        });

        $('#angustia_sim_pai').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {
                if ($('#angustia_sim_campo').children("option:selected").val() == 'S') {

                    $('#conclusao_angustia').val('Pela idade e pelas suas respostas, faz sentido pensar em ang??stia da separa????o, mas preciso te lembrar que ela n??o costuma causar tantos despertares assim. O mais comum ?? haver o aumento da intensidade do choro durante esses despertares que foram causados por outras raz??es. Vamos continuar nossa an??lise!');
                    M.textareaAutoResize($('#conclusao_angustia'));
                    $('#angustia_sim').show();
                }
            }
            if (opt == 'N') {

                $('#conclusao_angustia').val('Pela idade, at?? faz sentido pensar, mas pelas suas respostas, n??o ficou muito claro se realmente se trata de ang??stia da separa????o. De qualquer forma, preciso te lembrar que ela n??o costuma causar tantos despertares assim. O mais comum ?? haver o aumento da intensidade do choro durante esses despertares que foram causados por outras raz??es. Vamos continuar nossa an??lise!');
                M.textareaAutoResize($('#conclusao_angustia'));



            }

        });

        $('#angustia_sim_campo').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {
                if ($('#angustia_sim_pai').children("option:selected").val() == 'S') {

                    $('#conclusao_angustia').val('Pela idade e pelas suas respostas, faz sentido pensar em ang??stia da separa????o, mas preciso te lembrar que ela n??o costuma causar tantos despertares assim. O mais comum ?? haver o aumento da intensidade do choro durante esses despertares que foram causados por outras raz??es. Vamos continuar nossa an??lise!');
                    M.textareaAutoResize($('#conclusao_angustia'));
                    $('#angustia_sim').show();
                }
            }
            if (opt == 'N') {

                $('#conclusao_angustia').val('Pela idade, at?? faz sentido pensar, mas pelas suas respostas, n??o ficou muito claro se realmente se trata de ang??stia da separa????o. De qualquer forma, preciso te lembrar que ela n??o costuma causar tantos despertares assim. O mais comum ?? haver o aumento da intensidade do choro durante esses despertares que foram causados por outras raz??es. Vamos continuar nossa an??lise!');
                M.textareaAutoResize($('#conclusao_angustia'));



            }

        });

        $('#telas').on('change', function() {

            var opt = $(this).children("option:selected").val();
            if (opt == 'S') {


                $('#conclusao_telas').val('Lembre que as telas podem atrapalhar o sono do beb?? de 2 formas:   Pela exposi????o ?? luz azul, que prejudica o sono e a produ????o de melatonina;   Pelo hiperest??mulo que ocorre devido ao excesso de dopamina liberado no organismo quando o beb?? ?? exposto. A Sociedade Brasileira de Pediatria e a Academia Americana de Pediatria recomendam que o beb?? n??o deve ser exposto ??s telas antes dos 2 anos de idade.');
                M.textareaAutoResize($('#conclusao_telas'));


            }
            if (opt == 'N') {

                $('#conclusao_telas').val('Conclus??o: ??timo! A Sociedade Brasileira de Pediatria e a Academia Americana de Pediatria recomendam que o beb?? n??o deve ser exposto ??s telas antes dos 2 anos de idade.');
                M.textareaAutoResize($('#conclusao_telas'));

            }

        });


    });
</script>


<script>
    $(document).ready(function() {
        $('.modal').modal({

        });
        $('#modal1').modal('open');



    });
</script>


@endsection