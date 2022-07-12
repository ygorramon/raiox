@extends('site.desafio.layouts.app')
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
@stop



@section('content')
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>PASSO 2 - Causa dos Despertares</h4>
            <textarea class="materialize-textarea">Agora vamos analisar o Passo 2, que é entender por que o seu bebê está acordando e aqui vamos fazer uma revisão detalhada de cada uma das principais causas:

E após o preenchimento do seu desafio, você poderá tirar todas as suas dúvidas, dificuldades, particularidades e resultados no seu chat exclusivo. Não se preocupe, que o seu desafio não se resume a uma pré-análise automática!
</textarea>
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
                                <h4 class="card-title" Meus Dados</h4>
                                    Causa dos Despertares:

                            </div>
                        </div>
                    </div>
                    @if ($babyAge < 90)
                        <div class="card">
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
                    <div class="card">
                        <div class="card-content">
                            Dor:
                            <div class="row ">
                                <div class="col s12 ">
                                    <h4 class="card-title ">
                                        Você acha que o seu bebê está acordando atualmente por causa de alguma dor ou
                                        desconforto? Ex: gases, cólicas, disquesia, refluxo, nascimento de dentes,
                                        resfriado, gripe..
                                    </h4>
                                    <select class="browser-default" name="dor" id="dor">
                                        <option value="" disabled selected>Selecione</option>
                                        <option value="S">SIM</option>
                                        <option value="N">NÃO</option>
                                    </select>
                                    <div class="col s12 " id="dor_causa">
                                        <h4 class="card-title ">
                                            Que desconforto você acha que está acordando seu bebê?
                                        </h4>


                                        <textarea class="materialize-textarea"></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            Salto de desenvolvimento:
                            <div class="row ">
                                <div class="col s12 ">
                                    <h4 class="card-title ">
                                        Você acha que o seu bebê está acordando atualmente por causa de um salto de
                                        desenvolvimento?
                                    </h4>
                                    <select class="browser-default" name="salto" id="salto">
                                        <option value="" disabled selected>Selecione</option>
                                        <option value="S">SIM</option>
                                        <option value="N">NÃO</option>
                                    </select>
                                    <div class="col s12 " id="salto_sim">
                                        <h4 class="card-title ">
                                            Você consegue perceber novos marcos de desenvolvimento?
                                        </h4>
                                        <select class="browser-default" name="salto_marcos" id="salto_marcos">
                                            <option value="" disabled selected>Selecione</option>
                                            <option value="S">SIM</option>
                                            <option value="N">NÃO</option>
                                        </select>
                                    </div>
                                    <div class="col s12 " id="salto_marcos_sim">
                                        <h4 class="card-title ">
                                            Quais marcos?
                                        </h4>


                                        <textarea class="materialize-textarea"></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                     @if ($babyAge > 180 && $babyAge < 540)
                       <div class="card">
                        <div class="card-content">
                            Angústia da separação:
                            <div class="row ">
                                <div class="col s12 ">
                                    <h4 class="card-title ">
                                       Você acha que o seu bebê está acordando atualmente por causa da angústia da separação?
                                    </h4>
                                    <select class="browser-default" name="angustia" id="angustia">
                                        <option value="" disabled selected>Selecione</option>
                                        <option value="S">SIM</option>
                                        <option value="N">NÃO</option>
                                    </select>
                                    <div class="col s12 " id="angustia_sim">
                                        <h4 class="card-title ">
                                           Ele passou a chorar forte QUANDO VOCÊ SAI DO CAMPO DE VISÃO? 
                                        </h4>
                                        <select class="browser-default" name="angustia_sim_campo" id="angustia_sim_campo">
                                            <option value="" disabled selected>Selecione</option>
                                            <option value="S">SIM</option>
                                            <option value="N">NÃO</option>
                                        </select>
                                         <h4 class="card-title ">
                                           Se o pai for atender algum despertar à noite, o choro aumenta?
                                        </h4>
                                         <select class="browser-default" name="angustia_sim_pai" id="angustia_sim_pai">
                                            <option value="" disabled selected>Selecione</option>
                                            <option value="S">SIM</option>
                                            <option value="N">NÃO</option>
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
                                        Seu bebê é exposto às telas?
                                    </h4>
                                    <select class="browser-default" name="telas" id="telas">
                                        <option value="" disabled selected>Selecione</option>
                                        <option value="S">SIM</option>
                                        <option value="N">NÃO</option>
                                    </select>
                                    

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-content">
                            Outros:
                            <div class="row ">
                                <div class="col s12 ">
                                    <h4 class="card-title ">
                                       Você acha que outro fator esteja influenciando nos despertares do seu bebê?
                                    </h4>
                                    


                                        <textarea class="materialize-textarea"></textarea>
                                    
                                    

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
                        <textarea class="materialize-textarea" id="conclusao_fome"></textarea>
                    </div>
                </div>
                <div class="card-content row">
                    <div class="col s12 m6 l6">
                        <label>Ajustes Dor:</label>
                        <textarea class="materialize-textarea" id="conclusao_dor"></textarea>
                    </div>
                </div>
                 <div class="card-content row">
                    <div class="col s12 m6 l6">
                        <label>Ajustes Salto:</label>
                        <textarea class="materialize-textarea" id="conclusao_salto"></textarea>
                    </div>
                </div>
                   @if ($babyAge > 180 && $babyAge < 540)
                     <div class="card-content row">
                    <div class="col s12 m6 l6">
                        <label>Ajustes Angustia da Separação:</label>
                        <textarea class="materialize-textarea" id="conclusao_angustia"></textarea>
                    </div>
                </div>
                @endif
                 <div class="card-content row">
                    <div class="col s12 m6 l6">
                        <label>Ajustes Telas:</label>
                        <textarea class="materialize-textarea" id="conclusao_telas"></textarea>
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
            $('#dor_causa').hide();
            $('#salto_sim').hide();
            $('#salto_marcos_sim').hide();
            $('#angustia_sim').hide();

            
           






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
                    $('#conclusao_fome').val('');
                    M.textareaAutoResize($('#conclusao_fome'));
                }
                if (opt == 'N') {
                    $('#fome_pediatra_não').show();
                    $('#fome_pediatra_peso_atual_nao').hide();
                    $('#fome_pediatra_peso').hide();
                    $('#fome_pediatra_ganho_peso').hide();
                    $('#fome_pediatra_ganho_peso_nao').hide();
                    $('#fome_pediatra_fraldas').hide();
                    $('#fome_fraldas_nao').hide();
                    $('#conclusao_fome').val(
                        'É muito importante ter a avaliação do seu pediatra para podermos descartar fome. Se ele não avaliou, não poderemos descartar essa possível causa. Recomendo levar ao pediatra assim que possível para continuarmos.'
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
                        'É muito importante saber se o peso atual está adequado para podermos descartar fome. Se não estiver, não poderemos descartar essa possível causa. Recomendo levar ao pediatra assim que possível para continuarmos.'
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
                        'É muito importante saber se o ganho de peso está adequado para podermos descartar fome. Se não estiver, não poderemos descartar essa possível causa. Recomendo levar ao pediatra assim que possível para continuarmos.'
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
                        'Como o principal alimento do bebê é o leite, sabe-se que sempre que houver algum prejuízo na alimentação, a diurese será o primeiro sinal a ser alterado. Como você referiu diminuição na diurese, o ideal é que procure seu pediatra para avaliar o seu bebê e retornaremos a avaliação após.'
                    );
                    M.textareaAutoResize($('#conclusao_fome'));

                }

            });
            $('#fome_evacuacao').on('change', function() {

                var opt = $(this).children("option:selected").val();
                if (opt == 'S') {
                    @if ($babyAge <= 90)
                        $('#conclusao_fome').val(
                            'Conclusão: Ótimo! Todos os critérios de eficácia na alimentação estão adequados, o que nos leva a concluir que você está com uma boa rotina alimentar, mas como ele ainda é muito pequeno, pode ainda apresentar alguns despertares por fome. Lembrando que dificilmente terá mais do que 2 ou 3 despertares por isso e caso seu bebê acorde mais vezes, devemos continuar buscando novas causas.'
                        );
                    @endif
                    @if ($babyAge > 90)
                        $('#conclusao_fome').val(
                            'Conclusão: Ótimo! Todos os critérios de eficácia na alimentação estão adequados, o que nos leva a concluir que você está com uma boa rotina alimentar e podemos descartar a fome como causa de despertares. E se caso surgir a dúvida pois ele só volta a dormir mamando, lembre que o bebê mama por várias razões, não apenas a fome. Mamar relaxa, acolhe, alivia a dor e a associação. Nós encontraremos a causa para esses despertares.'
                        );
                    @endif
                    M.textareaAutoResize($('#conclusao_fome'));
                }
                if (opt == 'N') {


                    $('#conclusao_fome').val(
                        'Esse é um achado mais tardio, em relação ao padrão de diurese, mas que também estará alterado em casos de prejuízos na alimentação do bebê. Como você referiu não identificar facilmente o padrão de evacuações do seu bebê, o ideal é que procure seu pediatra para avaliar o seu bebê e retornaremos a avaliação após.'
                    );
                    M.textareaAutoResize($('#conclusao_fome'));

                }

            });

            $('#dor').on('change', function() {

                var opt = $(this).children("option:selected").val();
                if (opt == 'S') {


                    $('#conclusao_dor').val('É importante descartar todo tipo de desconforto do bebê!');
                    M.textareaAutoResize($('#conclusao_dor'));
                    $('#dor_causa').show();

                }
                if (opt == 'N') {

                    $('#conclusao_dor').val('Conclusão: Ótimo! Então está descartada!');
                    M.textareaAutoResize($('#conclusao_dor'));
                    $('#dor_causa').hide();
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

                    $('#conclusao_salto').val('Conclusão: Ótimo! Os saltos são momentos especiais de desenvolvimento do bebê, mas que podem vir acompanhados de despertares. Que bom que não é o seu caso, vamos passar para a próxima!');
                    M.textareaAutoResize($('#conclusao_salto'));
                    $('#salto_sim').hide();
                     $('#salto_marcos_sim').hide();
                    
                }

            });

            $('#salto_marcos').on('change', function() {

                var opt = $(this).children("option:selected").val();
                if (opt == 'S') {


                    $('#conclusao_salto').val('É importante avaliar se os saltos de desenvolvimento estão sendo responsáveis pelos despertares do bebê');
                    M.textareaAutoResize($('#conclusao_salto'));
                    $('#salto_sim').show();
                    $('#salto_marcos_sim').show();


                }
                if (opt == 'N') {

                    $('#conclusao_salto').val('Lembra que o salto de desenvolvimento é identificado pelos novos marcos de desenvolvimento! E não pelo aumento de despertares, ok?');
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

                    $('#conclusao_angustia').val('Conclusão: Ótimo! A angústia da separação não costuma causar tantos despertares assim. O mais comum é haver o aumento da intensidade do choro durante esses despertares que foram causados por outras razões. Vamos continuar nossa análise!');
                    M.textareaAutoResize($('#conclusao_angustia'));
                    $('#angustia_sim').hide();
                   
                    
                }

            });

            $('#angustia_sim_pai').on('change', function() {

                var opt = $(this).children("option:selected").val();
                if (opt == 'S') {
                    if($('#angustia_sim_campo').children("option:selected").val() == 'S'){

                    $('#conclusao_angustia').val('Pela idade e pelas suas respostas, faz sentido pensar em angústia da separação, mas preciso te lembrar que ela não costuma causar tantos despertares assim. O mais comum é haver o aumento da intensidade do choro durante esses despertares que foram causados por outras razões. Vamos continuar nossa análise!');
                    M.textareaAutoResize($('#conclusao_angustia'));
                    $('#angustia_sim').show();
                }
                }
                if (opt == 'N') {

                    $('#conclusao_angustia').val('Pela idade, até faz sentido pensar, mas pelas suas respostas, não ficou muito claro se realmente se trata de angústia da separação. De qualquer forma, preciso te lembrar que ela não costuma causar tantos despertares assim. O mais comum é haver o aumento da intensidade do choro durante esses despertares que foram causados por outras razões. Vamos continuar nossa análise!');
                    M.textareaAutoResize($('#conclusao_angustia'));
                   
                   
                    
                }

            });

               $('#angustia_sim_campo').on('change', function() {

                var opt = $(this).children("option:selected").val();
                if (opt == 'S') {
                    if($('#angustia_sim_pai').children("option:selected").val() == 'S'){

                    $('#conclusao_angustia').val('Pela idade e pelas suas respostas, faz sentido pensar em angústia da separação, mas preciso te lembrar que ela não costuma causar tantos despertares assim. O mais comum é haver o aumento da intensidade do choro durante esses despertares que foram causados por outras razões. Vamos continuar nossa análise!');
                    M.textareaAutoResize($('#conclusao_angustia'));
                    $('#angustia_sim').show();
                }
                }
                if (opt == 'N') {

                    $('#conclusao_angustia').val('Pela idade, até faz sentido pensar, mas pelas suas respostas, não ficou muito claro se realmente se trata de angústia da separação. De qualquer forma, preciso te lembrar que ela não costuma causar tantos despertares assim. O mais comum é haver o aumento da intensidade do choro durante esses despertares que foram causados por outras razões. Vamos continuar nossa análise!');
                    M.textareaAutoResize($('#conclusao_angustia'));
                   
                   
                    
                }

            });

            $('#telas').on('change', function() {

                var opt = $(this).children("option:selected").val();
                if (opt == 'S') {


                    $('#conclusao_telas').val('Lembre que as telas podem atrapalhar o sono do bebê de 2 formas:   Pela exposição à luz azul, que prejudica o sono e a produção de melatonina;   Pelo hiperestímulo que ocorre devido ao excesso de dopamina liberado no organismo quando o bebê é exposto. A Sociedade Brasileira de Pediatria e a Academia Americana de Pediatria recomendam que o bebê não deve ser exposto às telas antes dos 2 anos de idade.');
                    M.textareaAutoResize($('#conclusao_telas'));
                   

                }
                if (opt == 'N') {

                    $('#conclusao_telas').val('Conclusão: Ótimo! A Sociedade Brasileira de Pediatria e a Academia Americana de Pediatria recomendam que o bebê não deve ser exposto às telas antes dos 2 anos de idade.');
                    M.textareaAutoResize($('#conclusao_telas'));
                    
                }

            });


        });
    </script>


<script>
$(document).ready(function(){
    $('.modal').modal({
       
    });
    $('#modal1').modal('open');

    

  });
  </script>


@endsection
