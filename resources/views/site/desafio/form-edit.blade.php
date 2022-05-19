@extends('site.desafio.layouts.app')
@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
@stop



@section('content')
<form action="{{route('analyze.form.update',$challenge->id)}}" method="POST">
    @csrf
    {{ method_field('PUT') }}
    <div class="row">
        <div class="col s12">
            <div id="input-fields" class="card card-tabs">
                <div class="card-content">
                    <div class="card-title">
                        <div class="row">
                            <div class="col s12 m6 l10">
                                <h4 class="card-title">Formulário Final</h4>
                                Responda às perguntas abaixo para avaliação da rotina:

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
                            <div class="col s12 m6 l6">
                                <h4 class="card-title ">
                                    Você possui um Ritual do Bom Dia bem estabelecido?
                                </h4>
                                <select class="browser-default" name="ritualBomDia">
                                    <option {{ old('ritualBomDia', $form->ritualGoodMorning ) == 'S' ? "selected" : "" }} value="S">SIM</option>
                                    <option {{ old('ritualBomDia', $form->ritualGoodMorning ) == 'N' ? "selected" : "" }} value="N">NÃO</option>

                                </select>
                            </div>

                            <div class="col s12 m6 l6">
                                <h4 class="card-title ">
                                    Quais critérios você cumpre do Ritual do Bom Dia:
                                </h4>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('ritual_luz', $form->ritualGoodMorningLight ) == 'S' ? "checked" : "" }} value="S" name="ritual_luz" />
                                        <span>Só expõe à luz durante/após o ritual.</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('ritual_ruido', $form->ritualGoodMorningNoise ) == 'S' ? "checked" : "" }} value="S" name="ritual_ruido" />
                                        <span>Só expõe aos ruídos durante/após o ritual.</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('ritual_estimulo', $form->ritualGoodMorningStimulus ) == 'S' ? "checked" : "" }} value="S" name="ritual_estimulo" />
                                        <span>Só expõe aos estímulos durante/após o ritual.</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('ritual_retira', $form->ritualGoodMorningRemove ) == 'S' ? "checked" : "" }} value="S" name="ritual_retira" />
                                        <span>Só retira do ambiente após ritual.</span>
                                    </label>
                                </p>
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
                            <h4 class="card-title ">
                                ROTINA ALIMENTAR
                            </h4>
                            <div class="col s12 m6 l6">

                                Qual dessas opções mais se encaixa com a rotina alimentar do seu bebê?
                                <select class="browser-default" name="rotinaAlimentar">
                                    <option {{ old('rotinaAlimentar', $form->typeEatingRoutine ) == '1' ? "selected" : "" }} value="1">Aleitamento Materno Exclusivo</option>
                                    <option {{ old('rotinaAlimentar', $form->typeEatingRoutine ) == '2' ? "selected" : "" }} value="2">Uso exclusivo de Fórmulas Infantis</option>
                                    <option {{ old('rotinaAlimentar', $form->typeEatingRoutine ) == '3' ? "selected" : "" }} value="3">Aleitamento Materno + Uso de Fórmulas Infantis</option>
                                    <option {{ old('rotinaAlimentar', $form->typeEatingRoutine ) == '4' ? "selected" : "" }} value="4">Alimentos Sólidos + Aleitamento Materno.</option>
                                    <option {{ old('rotinaAlimentar', $form->typeEatingRoutine ) == '5' ? "selected" : "" }} value="5">Alimentos Sólidos + Uso de Fórmulas Infantis</option>
                                    <option {{ old('rotinaAlimentar', $form->typeEatingRoutine ) == '6' ? "selected" : "" }} value="6">Alimentos Sólidos + Aleitamento Materno + Uso de Fórmulas Infantis</option>
                                </select>
                            </div>
                            <div class="col s12 m6 l6">
                                Possui alguma dificuldade com Rotina Alimentar? <select class="browser-default" name="dificuldadeRotinaAlimentar">
                                    <option {{ old('dificuldadeRotinaAlimentar', $form->routineDifficulties ) == 'S' ? "selected" : "" }} value="S">SIM</option>
                                    <option {{ old('dificuldadeRotinaAlimentar', $form->routineDifficulties ) == 'N' ? "selected" : "" }} value="N">NÃO</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">

                            <div class="col s12 m6 l6">

                                Qual o ganho de peso do bebê em gramas, nos ultimos 30 dias?
                                <select class="browser-default" name="ganhoPeso">
                                    <option {{ old('ganhoPeso', $form->weightGain ) == 'N' ? "selected" : "" }} value="N">NÃO SEI</option>
                                    <option {{ old('ganhoPeso', $form->weightGain ) == 'NP' ? "selected" : "" }} value="NP"> Não ganhou ou perdeu peso </option>
                                    <option {{ old('ganhoPeso', $form->weightGain ) == '100' ? "selected" : "" }} value="100">Por volta de 100 gramas</option>
                                    <option {{ old('ganhoPeso', $form->weightGain ) == '200' ? "sel ected" : "" }}value="200">Por volta de 200 gramas</option>
                                    <option {{ old('ganhoPeso', $form->weightGain ) == '300' ? "selected" : "" }} value="300">Por volta de 300 gramas</option>
                                    <option {{ old('ganhoPeso', $form->weightGain ) == '400' ? "selected" : "" }} value="400">Por volta de 400 gramas</option>
                                    <option {{ old('ganhoPeso', $form->weightGain ) == '500' ? "selected" : "" }} value="500">Por volta de 500 gramas</option>
                                    <option {{ old('ganhoPeso', $form->weightGain ) == '600' ? "selected" : "" }} value="600">Por volta de 600 gramas</option>
                                    <option {{ old('ganhoPeso', $form->weightGain ) == '700' ? "selected" : "" }} value="700">Por volta de 700 gramas</option>
                                    <option {{ old('ganhoPeso', $form->weightGain ) == '800' ? "selected" : "" }} value="800">Por volta de 800 gramas</option>
                                    <option {{ old('ganhoPeso', $form->weightGain ) == '900' ? "selected" : "" }} value="900">Por volta de 900 gramas</option>
                                    <option {{ old('ganhoPeso', $form->weightGain ) == '1000' ? "selected" : "" }} value="1000">Por volta de 1000 gramas</option>
                                    <option {{ old('ganhoPeso', $form->weightGain ) == '1100' ? "selected" : "" }} value="1100">Por volta de 1100 gramas</option>
                                    <option {{ old('ganhoPeso', $form->weightGain ) == '1200' ? "selected" : "" }} value="1200">Por volta de 1200 gramas</option>
                                    <option {{ old('ganhoPeso', $form->weightGain ) == '1300' ? "selected" : "" }} value="1300">Por volta de 1300 gramas</option>
                                    <option {{ old('ganhoPeso', $form->weightGain ) == '1400' ? "selected" : "" }} value="1400">Por volta de 1400 gramas</option>
                                    <option {{ old('ganhoPeso', $form->weightGain ) == '1500' ? "selected" : "" }} value="1500">Por volta de 1500 gramas</option>
                                    <option {{ old('ganhoPeso', $form->weightGain ) == '1600' ? "selected" : "" }} value="1600">Mais de 1500 gramas</option>
                                </select>
                            </div>

                        </div>
                        <br>

                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div id="input-fields" class="card card-tabs">
                <div class="card-content">
                    <div class="card-title">
                        <div class="row">
                            <h4 class="card-title ">
                                ROTINA DE SONECAS
                            </h4>
                            <div class="col s12 m6 l6">

                                Como está o gasto energético do seu bebê no tempo acordado?
                                <select class="browser-default" name="gastoEnergia">
                                    <option {{ old('gastoEnergia', $form->energyExpenditure ) == 'Adequado' ? "selected" : "" }} value="Adequado">Adequado</option>
                                    <option {{ old('gastoEnergia', $form->energyExpenditure ) == 'Inadequado' ? "selected" : "" }} value="Inadequado">Inadequado</option>
                                    <option {{ old('gastoEnergia', $form->energyExpenditure ) == 'Nao_sabe' ? "selected" : "" }} value="Nao_sabe">Não Sei</option>
                                </select>
                            </div>
                            <div class="col s12 m6 l6">
                                Você consegue perceber os sinais de sono emitidos?
                                <select class="browser-default" name="sinaisSono">
                                    <option {{ old('sinaisSono', $form->noticeSigns ) == 'S' ? "selected" : "" }} value="S">SIM</option>
                                    <option {{ old('sinaisSono', $form->noticeSigns ) == 'N' ? "selected" : "" }} value="N">NÃO</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">

                            <div class="col s12 m6 l6">
                                Você lembrou de “desacelerar" após perceber os sinais de sono?
                                <select class="browser-default" name="desacelera">
                                    <option {{ old('desacelera', $form->slowDown ) == 'S' ? "selected" : "" }} value="S">SIM</option>
                                    <option {{ old('desacelera', $form->slowDown ) == 'N' ? "selected" : "" }} value="N">NÃO</option>
                                </select>
                            </div>
                            <div class="col s12 m6 l6">
                                É um ritual de sonecas tranquilo ou há choro envolvido?
                                <select class="browser-default" name="ritualSonecasChoro">
                                    <option {{ old('ritualSonecasChoro', $form->ritualType ) == 'Sem' ? "selected" : "" }} value="Sem">Sem choro</option>
                                    <option {{ old('ritualSonecasChoro', $form->ritualType ) == 'Com' ? "selected" : "" }} value="Com">Com choro</option>
                                    <option {{ old('ritualSonecasChoro', $form->ritualType ) == 'Eventualmente' ? "selected" : "" }} value="Eventualmente">Eventualmente com choro</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">

                            <div class="col s12 m6 l6">
                                Como está seu ambiente de sonecas? Luzes?
                                <select class="browser-default" name="soneca_luzes">
                                    <option {{ old('soneca_luzes', $form->environmentNapsLights ) == 'T' ? "selected" : "" }} value="T">Totalmente escuro</option>
                                    <option {{ old('soneca_luzes', $form->environmentNapsLights ) == 'P' ? "selected" : "" }} value="P">Parcialmente escuro (Quando as barreiras não vedam 100%)</option>
                                    <option {{ old('soneca_luzes', $form->environmentNapsLights ) == 'C' ? "selected" : "" }} value="C">Ambiente claro</option>
                                </select>
                            </div>
                            <div class="col s12 m6 l6">
                                Como está seu ambiente de sonecas? Ruídos?
                                <select class="browser-default" name="soneca_ruidos">
                                    <option {{ old('soneca_ruidos', $form->environmentNapsNoises ) == 'S' ? "selected" : "" }} value="S">Silencioso (com ou sem a ajuda de música ou ruído branco)</option>
                                    <option {{ old('soneca_ruidos', $form->environmentNapsNoises ) == 'P' ? "selected" : "" }} value="P">Parcialmente silencioso (quando não é capaz de isolar 100%)</option>
                                    <option {{ old('soneca_ruidos', $form->environmentNapsNoises ) == 'C' ? "selected" : "" }} value="C">Com ruídos</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">

                            <div class="col s12 m6 l6">
                                Como está seu ambiente de sonecas? Temperatura?
                                <select class="browser-default" name="soneca_temperatura">
                                    <option {{ old('soneca_temperatura', $form->environmentNapsTemperature ) == 'A' ? "selected" : "" }} value="A">Adequada (variável, mas aproximadamente 24ºC)</option>
                                    <option {{ old('soneca_temperatura', $form->environmentNapsTemperature ) == 'C' ? "selected" : "" }} value="C">Calor</option>
                                    <option {{ old('soneca_temperatura', $form->environmentNapsTemperature ) == 'F' ? "selected" : "" }} value="F">Frio</option>
                                    <option {{ old('soneca_temperatura', $form->environmentNapsTemperature ) == 'N' ? "selected" : "" }} value="N">Não sei</option>
                                </select>
                            </div>
                            <div class="col s12 m6 l6">
                                Onde dorme? (Pode ser mais de uma opção)
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('soneca_acordado_berco', $form->whereSleepCrib ) == 'S' ? "checked" : "" }} value="S" name="soneca_acordado_berco" />
                                        <span>Levado acordado ao berço</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('soneca_dorme_colo_berco', $form->whereSleepLapCrib ) == 'S' ? "checked" : "" }} value="S" name="soneca_dorme_colo_berco" />
                                        <span>Adormece no colo e é levado ao berço</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('soneca_dorme_colo', $form->whereSleepLap ) == 'S' ? "checked" : "" }} value="S" name="soneca_dorme_colo" />
                                        <span>Adormece e dorme toda a soneca no colo</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('soneca_cama_compartilhada', $form->whereSleepSharedBed ) == 'S' ? "checked" : "" }} value="S" name="soneca_cama_compartilhada" />
                                        <span>Cama compartilhada
                                        </span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('soneca_carrinho', $form->whereSleepCar ) == 'S' ? "checked" : "" }} value="S" name="soneca_carrinho" />
                                        <span>Carrinho/Bebê conforto
                                        </span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('soneca_rede', $form->whereSleepRede ) == 'S' ? "checked" : "" }} value="S" name="soneca_rede" />
                                        <span>Rede
                                        </span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" {{ old('soneca_outro', $form->whereSleepOther ) != 'N' ? "checked" : "" }} name="soneca_outro" id="soneca_outro" />
                                        <span>Outro</span>

                                    </label>


                                </p>
                                <div class="input-field " id="outro_onde_dorme">
                                    <input placeholder="Digite outro lugar onde dorme" id="soneca_outro_text" value="{{ old('soneca_outro_text', $form->whereSleepOther ) != 'N' ? $form->whereSleepOther : ""  }}" name="soneca_outro_text" type="text">
                                    <label for="soneca_outro_text">Outro</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col s12 m6 l6">
                                O local das sonecas te incomoda?
                                <select class="browser-default" name="soneca_local_incomoda">
                                    <option {{ old('soneca_local_incomoda', $form->environmentNapBother ) == 'S' ? "selected" : "" }} value="S">SIM</option>
                                    <option {{ old('soneca_local_incomoda', $form->environmentNapBother ) == 'N' ? "selected" : "" }} value="N">NÃO</option>

                                </select>
                            </div>
                            <br>
                            <div class="col s12 m6 l6">
                                Possui mais alguma associação? (Pode ser mais de uma opção)
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('associacao_soneca_ruido_branco', $form->napAssociationWhiteNoise ) == 'S' ? "checked" : "" }} value="S" name="associacao_soneca_ruido_branco" />
                                        <span>Ruído branco</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('associacao_soneca_naninha', $form->napAssociationCloth ) == 'S' ? "checked" : "" }} value="S" name="associacao_soneca_naninha" />
                                        <span>Naninha</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('associacao_soneca_chupeta', $form->napAssociationPacifier ) == 'S' ? "checked" : "" }} value="S" name="associacao_soneca_chupeta" />
                                        <span>Chupeta</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('associacao_soneca_chupar_dedo', $form->napAssociationSuckFinger ) == 'S' ? "checked" : "" }} value="S" name="associacao_soneca_chupar_dedo" />
                                        <span>Chupar dedo
                                        </span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('associacao_soneca_mamar', $form->napAssociationSuckle ) == 'S' ? "checked" : "" }} value="S" name="associacao_soneca_mamar" />
                                        <span>Mamar para dormir
                                        </span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('associacao_soneca_cc', $form->napAssociationCC ) == 'S' ? "checked" : "" }} value="S" name="associacao_soneca_cc" />
                                        <span>Cama Compartilhada
                                        </span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('associacao_soneca_colo', $form->napAssociationLap ) == 'S' ? "checked" : "" }} value="S" name="associacao_soneca_colo" />
                                        <span>Colo
                                        </span>
                                    </label>
                                </p>

                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" value="S" {{ old('associacao_soneca_outro', $form->napAssociationOther ) != 'N' ? "checked" : "" }} name="associacao_soneca_outro" id="associacao_soneca_outro" />
                                        <span>Outro
                                        </span>
                                    </label>
                                </p>
                                <div class="input-field " id="outro_associacao_soneca">
                                    <input placeholder="Digite a outra associação" id="associacao_soneca_outro_text" value="{{ old('associacao_soneca_outro_text', $form->napAssociationOther ) != 'N' ? $form->napAssociationOther : ""  }}" name="associacao_soneca_outro_text" type="text">
                                    <label for="associacao_soneca_outro_text">Outro</label>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col s12 m6 l6">
                                    Acha que essa duração tem sido suficiente pra ele?
                                    <select class="browser-default" name="soneca_suficiente">
                                        <option {{ old('soneca_suficiente', $form->enoughNap ) == 'S' ? "selected" : "" }} value="S">SIM</option>
                                        <option {{ old('soneca_suficiente', $form->enoughNap ) == 'N' ? "selected" : "" }} value="N">NÃO</option>

                                    </select>
                                </div>
                                <br>
                                <div class="col s12 m6 l6">
                                    Como seu bebê costuma acordar das sonecas?
                                    <select class="browser-default" name="soneca_acorda" class="">
                                        <option {{ old('soneca_acorda', $form->wakeUpNap ) == 'A' ? "selected" : "" }} value="A">Sempre alegre e disposto</option>
                                        <option {{ old('soneca_acorda', $form->wakeUpNap ) == 'ES' ? "selected" : "" }} value="ES">Eventualmente acorda ainda com sono</option>
                                        <option {{ old('soneca_acorda', $form->wakeUpNap ) == 'FS' ? "selected" : "" }} value="FS">Frequentemente acorda ainda com sono</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div id="input-fields" class="card card-tabs">
                <div class="card-content">
                    <div class="card-title">
                        <div class="row">
                            <h4 class="card-title ">
                                RITUAL NOTURNO
                            </h4>

                            <div class="col s12 m6 l6">
                                Você faz um ritual para o sono noturno?
                                <select class="browser-default" name="ritaualNoturno">
                                    <option {{ old('ritaualNoturno', $form->nightRitual ) == 'S' ? "selected" : "" }} value="S">SIM</option>
                                    <option {{ old('ritaualNoturno', $form->nightRitual ) == 'N' ? "selected" : "" }} value="N">NÃO</option>
                                </select>
                            </div>
                            <div class="col s12 m6 l6">
                                Como está seu ambiente do sono noturno? Luzes?
                                <select class="browser-default" name="sn_luzes" class="">
                                    <option {{ old('sn_luzes', $form->environmentRitualLights ) == 'E' ? "selected" : "" }} value="E">Totalmente escuro</option>
                                    <option {{ old('sn_luzes', $form->environmentRitualLights ) == 'P' ? "selected" : "" }} value="P">Parcialmente escuro (Quando as barreiras não vedam 100%)</option>
                                    <option {{ old('sn_luzes', $form->environmentRitualLights ) == 'C' ? "selected" : "" }} value="C">Ambiente claros</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">


                            <div class="col s12 m6 l6">
                                Como está seu ambiente do sono noturno? Ruídos?
                                <select class="browser-default" name="sn_ruidos" class="">
                                    <option {{ old('sn_ruidos', $form->environmentRitualNoises ) == 'S' ? "selected" : "" }} value="S">Silencioso (com ou sem a ajuda de música ou ruído branco)</option>
                                    <option {{ old('sn_ruidos', $form->environmentRitualNoises ) == 'P' ? "selected" : "" }} value="P">Parcialmente silencioso (quando não é capaz de isolar 100%)</option>
                                    <option {{ old('sn_ruidos', $form->environmentRitualNoises ) == 'C' ? "selected" : "" }} value="C">Com ruídos</option>
                                </select>
                            </div>

                            <div class="col s12 m6 l6">
                                Como está seu ambiente do sono noturno? Temperatura?
                                <select class="browser-default" name="sn_temperatura" class="">
                                    <option {{ old('sn_temperatura', $form->environmentRitualTemperature ) == 'A' ? "selected" : "" }} value="A">Adequada (variável, mas aproximadamente 24ºC)</option>
                                    <option {{ old('sn_temperatura', $form->environmentRitualTemperature ) == 'C' ? "selected" : "" }} value="C">Calor</option>
                                    <option {{ old('sn_temperatura', $form->environmentRitualTemperature ) == 'F' ? "selected" : "" }} value="F">Frio</option>
                                    <option {{ old('sn_temperatura', $form->environmentRitualTemperature ) == 'N' ? "selected" : "" }} value="N">Não sei</option>
                                </select>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col s12 m6 l6">
                                Possui mais alguma associação no sono soturno? (Pode ser mais de uma opção)
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('associacao_noturno_ruido_branco', $form->ritualAssociationWhiteNoise ) == 'S' ? "checked" : "" }} value="S" name="associacao_noturno_ruido_branco" />
                                        <span>Ruído branco</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('associacao_noturno_naninha', $form->ritualAssociationCloth ) == 'S' ? "checked" : "" }} value="S" name="associacao_noturno_naninha" />
                                        <span>Naninha</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('associacao_noturno_chupeta', $form->ritualAssociationPacifier ) == 'S' ? "checked" : "" }} value="S" name="associacao_noturno_chupeta" />
                                        <span>Chupeta</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('associacao_noturno_chupar_dedo', $form->ritualAssociationSuckFinger ) == 'S' ? "checked" : "" }} value="S" name="associacao_noturno_chupar_dedo" />
                                        <span>Chupar dedo
                                        </span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('associacao_noturno_mamar', $form->ritualAssociationSuckle ) == 'S' ? "checked" : "" }} value="S" name="associacao_noturno_mamar" />
                                        <span>Mamar para dormir
                                        </span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('associacao_noturno_cc', $form->ritualAssociationCC ) == 'S' ? "checked" : "" }} value="S" name="associacao_noturno_cc" />
                                        <span>Cama Compartilhada
                                        </span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('associacao_noturno_colo', $form->ritualAssociationLap ) == 'S' ? "checked" : "" }} value="S" name="associacao_noturno_colo" />
                                        <span>Colo
                                        </span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('associacao_noturno_outro', $form->ritualAssociationOther ) != 'N' ? "checked" : "" }} value="S" name="associacao_noturno_outro" id="associacao_noturno_outro" />
                                        <span>Outro
                                        </span>
                                    </label>
                                </p>
                                <div class="input-field " id="outro_associacao_noturno">
                                    <input placeholder="Digite a outra associação" id="associacao_noturno_outro_text" value="{{ old('associacao_noturno_outro_text', $form->ritualAssociationOther ) != 'N' ? $form->ritualAssociationOther : ""  }}" name="associacao_noturno_outro_text" type="text">
                                    <label for="associacao_noturno_outro_text">Outro</label>
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
                            <h4 class="card-title ">
                                CONCLUSÃO
                            </h4>

                            <div class="col s12 m6 l6">
                                Quais as possíveis causas para os despertares do seu bebê?
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('conclusao_imaturidade', $form->conclusionImmaturity ) != 'N' ? "checked" : "" }} value="S" name="conclusao_imaturidade" />
                                        <span>Exterogestação</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('conclusao_fome', $form->conclusionHungry ) != 'N' ? "checked" : "" }} value="S" name="conclusao_fome" />
                                        <span>Fome</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('conclusao_dor', $form->conclusionAche ) != 'N' ? "checked" : "" }} value="S" name="conclusao_dor" />
                                        <span>Dor</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('conclusao_salto', $form->conclusionJump ) != 'N' ? "checked" : "" }} value="S" name="conclusao_salto" />
                                        <span>Salto de Desenvolvimento</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('conclusao_angustia', $form->conclusionAnguish ) != 'N' ? "checked" : "" }} value="S" name="conclusao_angustia" />
                                        <span>Angústia da separação</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('conclusao_telas', $form->conclusionScreens ) != 'N' ? "checked" : "" }} value="S" name="conclusao_telas" />
                                        <span>Telas</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input type="checkbox" class="filled-in" {{ old('conclusao_estresse', $form->conclusionStress ) != 'N' ? "checked" : "" }} value="S" name="conclusao_estresse" />
                                        <span>Estresse excessivo da mãe</span>
                                    </label>
                                </p>

                            </div>

                        </div>
                        <br>
                        <div class="row">


                            <div class="input-field col s12 m12 l12">

                                <textarea id="observacoes" name="observacoes" maxlength="400" class="materialize-textarea" data-length="400">{{old('conclusao_estresse', $form->comments ) }}</textarea>
                                <label for="observacoes">Observações</label>
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
                        <button class="btn" type="submit">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
</form>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('select').formSelect();
    });

    $(document).ready(function() {
        $('textarea#observacoes').characterCounter();
    });

    $('#outro_associacao_soneca').hide();
    $('#outro_associacao_noturno').hide();
    $('#outro_onde_dorme').hide();

    if ($('#soneca_outro').prop('checked')) {
        $('#outro_onde_dorme').show();
    }

    if ($('#associacao_soneca_outro').prop('checked')) {
        $('#outro_associacao_soneca').show();
    }

    if ($('#associacao_noturno_outro').prop('checked')) {
        $('#outro_associacao_noturno').show();
    }

    $('#soneca_outro').change(function() {
        if ($('#soneca_outro').prop('checked')) {
            $('#outro_onde_dorme').show();
        } else
            $('#outro_onde_dorme').hide();
    });

    $('#associacao_noturno_outro').change(function() {
        if ($('#associacao_noturno_outro').prop('checked')) {
            $('#outro_associacao_noturno').show();
        } else
            $('#outro_associacao_noturno').hide();
    });

    $('#associacao_soneca_outro').change(function() {
        if ($('#associacao_soneca_outro').prop('checked')) {
            $('#outro_associacao_soneca').show();
        } else
            $('#outro_associacao_soneca').hide();
    });
</script>
@endsection