@extends('site.desafio.layouts.app')

@section('css')

        <!-- Materialize CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
        <!-- Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <style>
        #container-finalizar-dia {
        border-radius: 10px;
        padding: 20px;
    }

    #container-finalizar-dia .card-panel {
        border-left: 5px solid #ff9800;
    }

    #container-finalizar-dia h5 {
        color: #ff9800;
        margin-top: 0;
    }

    #container-finalizar-dia .btn-large {
        margin-top: 15px;
        background-color: #ff9800;
    }

    #container-finalizar-dia .btn-large:hover {
        background-color: #f57c00;
    }
            .sub-opcoes {
        border-left: 3px solid #26a69a;
        padding-left: 15px;
        margin: 10px 0;
    }

    .associacoes-info p {
        margin: 5px 0;
        padding: 5px;
        background: rgba(255,255,255,0.7);
        border-radius: 4px;
    }

    .outra-detalhe {
        margin-top: 5px;
        margin-left: 25px;
        width: calc(100% - 25px);
    }

    .hidden {
        display: none;
    }
            .accordion.despertar .accordion-header {
        background-color: #f3e5f5;
        border-left: 5px solid #7e57c2;
    }

    .detalhes-despertar {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }

    @media (max-width: 600px) {
        .detalhes-despertar {
            grid-template-columns: 1fr;
        }
    }
    .hidden { display: none; }
    .green-text { color: #4caf50 !important; }
    .red-text { color: #f44336 !important; }
    .blue-text { color: #2196f3 !important; }



    .pergunta-card {
        margin: 20px 0;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid #26a69a;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .opcoes-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
    }

    .opcao-btn {
        transition: all 0.3s ease;
        white-space: normal;
        word-wrap: break-word;
        height: auto;
        min-height: 36px;
        line-height: 1.4;
        padding: 8px 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        flex: 1;
        min-width: 120px;
        max-width: 200px;
    }

    .opcao-btn.quebra-linha {
        flex-basis: 100%;
        max-width: none;
    }

    .opcao-btn:hover:not(.disabled) {
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .opcao-btn.disabled {
        cursor: not-allowed;
        opacity: 0.7;
    }

    .opcao-btn.selected {
        box-shadow: 0 2px 8px rgba(0,0,0,0.3) !important;
    }

    .ambiente-btn, .ruido-btn {
        margin: 4px;
        flex: 1;
        min-width: 100px;
        text-align: center;
    }

    /* Responsividade */
    @media (max-width: 600px) {
        .pergunta-card {
            padding: 15px;
            margin: 15px 0;
        }

        .opcoes-container {
            flex-direction: column;
            gap: 8px;
        }

        .opcao-btn {
            width: 100%;
            max-width: none;
            margin: 4px 0 !important;
        }

        .ambiente-options, .ruidos-options {
            flex-direction: column;
        }

        .ambiente-btn, .ruido-btn {
            width: 100%;
            margin: 4px 0 !important;
        }

        .pergunta-number {
            top: 5px;
            right: 10px;
            font-size: 10px;
            padding: 1px 6px;
        }
        .opcao-btn.longa {
            font-size: 13px;
            padding: 8px 10px;
        }
    }

    @media (min-width: 601px) and (max-width: 992px) {
         .opcao-btn.longa {
            font-size: 13.5px;
            padding: 9px 11px;
        }
        .opcao-btn {
            min-width: 140px;
            max-width: 180px;
            font-size: 14px;
            padding: 8px 12px;
        }
    }

    .pergunta-number {
        position: absolute;
        top: 10px;
        right: 15px;
        background: #26a69a;
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: bold;
    }

    .pergunta-header {
        position: relative;
        padding-right: 60px;
        margin-bottom: 15px;
    }

    .pergunta-header h6 {
        margin: 0;
        color: #26a69a;
        font-weight: 500;
    }
    .opcao-btn.longa {
        font-size: 14px;
        padding: 10px 12px;
        line-height: 1.3;
    }

    /* Estilos para o accordion */
    .accordion {
        border-radius: 8px;
        overflow: hidden;
        margin: 10px 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .accordion-header {
        padding: 15px 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.3s ease;
    }

    .accordion-header:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
        background: white;
    }

    .accordion-content-inner {
        padding: 20px;
        border-top: 1px solid #eee;
    }

    .accordion.open .accordion-content {
        max-height: 700px;
    }

    .accordion.open .accordion-header {
        border-bottom: 1px solid #eee;
    }

    .accordion-icon {
        transition: transform 0.3s ease;
    }

    .accordion.open .accordion-icon {
        transform: rotate(180deg);
    }

    /* Estilos específicos para os tipos de status */
    .accordion.adequado .accordion-header {
        background-color: #e8f5e9;
        border-left: 5px solid #4caf50;
    }

    .accordion.atencao .accordion-header {
        background-color: #fffde7;
        border-left: 5px solid #ffc107;
    }

    .accordion.vazio .accordion-header {
        background-color: #f5f5f5;
        border-left: 5px solid #9e9e9e;
    }

    /* Detalhes da soneca */
    .detalhes-soneca {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }

    .detalhe-item {
        padding: 10px;
        background: #f9f9f9;
        border-radius: 4px;
    }

    .detalhe-item strong {
        display: block;
        color: #666;
        font-size: 0.9em;
        margin-bottom: 5px;
    }

    .recomendacao {
        background: #e3f2fd;
        padding: 15px;
        border-radius: 8px;
        margin: 15px 0;
        border-left: 4px solid #2196f3;
    }

    .respostas-questionario {
        margin-top: 20px;
        margin-bottom: 20px;
    }


    .resposta-item {
        padding: 10px;
        margin: 5px 0;
        background: #f5f5f5;
        border-radius: 4px;
        border-left: 3px solid #26a69a;
    }

    @media (max-width: 768px) {


        .accordion-header {
            padding: 12px 15px;
        }

        .accordion-content-inner {
            padding: 15px;
        }
    }
    .resposta-item {
        padding: 10px;
        margin: 5px 0;
        background: #f5f5f5;
        border-radius: 4px;
        border-left: 3px solid #26a69a;
    }

    .resposta-sim {
        color: #4caf50;
        font-weight: bold;
    }

    .resposta-nao {
        color: #f44336;
        font-weight: bold;
    }

    .detalhes-resposta {
        font-size: 0.9em;
        color: #666;
    }

    .resposta-timestamp {
        margin-top: 5px;
        font-size: 0.8em;
        color: #999;
    }

    #modal-analise-soneca .modal-content {
        max-height: 85vh;
        overflow-y: auto;
    }

    .video-recomendacao {
        border-left: 4px solid #2196F3;
    }

    .video-lista a {
        display: block;
        padding: 8px;
        margin: 5px 0;
        background: white;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .video-lista a:hover {
        background: #bbdefb;
        transform: translateX(5px);
    }

    .sinais-sono {
        border-left: 4px solid #FF9800;
    }

    .sinais-sono .col {
        padding: 5px;
        font-size: 0.9em;
    }

    /* Ícones materiais */
    .material-icons.tiny {
        font-size: 16px;
        vertical-align: middle;
        margin-right: 5px;
    }

    #registro-despertares .accordion .accordion-header {
        cursor: pointer;
        transition: all 0.3s ease;
    }

    #registro-despertares .accordion .accordion-header:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    #registro-despertares .accordion .accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
        background: white;
    }

    #registro-despertares .accordion .accordion-content-inner {
        padding: 20px;
        border-top: 1px solid #eee;
    }

    #registro-despertares .accordion.open .accordion-content {
        max-height: 800px; /* Altura suficiente para o conteúdo */
    }

    #registro-despertares .accordion.open .accordion-header {
        border-bottom: 1px solid #eee;
    }

    #registro-despertares .accordion-icon {
        transition: transform 0.3s ease;
    }

    #registro-despertares .accordion.open .accordion-icon {
        transform: rotate(180deg);
    }

    /* Estilos específicos para os tipos de status dos despertares */
    #registro-despertares .accordion.adequado .accordion-header {
        background-color: #e8f5e9;
        border-left: 5px solid #4caf50;
    }

    #registro-despertares .accordion.atencao .accordion-header {
        background-color: #fffde7;
        border-left: 5px solid #ffc107;
    }

    #registro-despertares .accordion.vazio .accordion-header {
        background-color: #f5f5f5;
        border-left: 5px solid #9e9e9e;
    }

    /* Detalhes do despertar */
    .detalhes-despertar {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }

    .detalhes-despertar .detalhe-item {
        padding: 10px;
        background: #f9f9f9;
        border-radius: 4px;
    }

    .detalhes-despertar .detalhe-item strong {
        display: block;
        color: #666;
        font-size: 0.9em;
        margin-bottom: 5px;
    }

    @media (max-width: 768px) {
        .detalhes-despertar {
            grid-template-columns: 1fr;
        }

        #registro-despertares .accordion .accordion-header {
            padding: 12px 15px;
        }

        #registro-despertares .accordion .accordion-content-inner {
            padding: 15px;
        }
    }
    </style>
        <style>

            body {
                background-color: #f5f5f5;
                padding: 20px;
            }



            .card {
                border-radius: 8px;
                overflow: hidden;
            }

            .progress {
                margin: 20px 0;
            }

            .btn-large {
                margin: 10px;
            }

            .modal {
                max-height: 80%;
                overflow-y: auto;
            }

            .time-input {
                max-width: 120px;
                display: inline-block;
            }

            .sugestao-horario {
                font-weight: bold;
                color: #00796b;
            }

            .hidden {
                display: none;
            }

            input[type="time"] {
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 16px;
            }

            .time-input-container {
                margin: 15px 0;
            }

            .time-input-container label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            .item-rotina {
                display: flex;
                align-items: center;
                padding: 15px;
                margin: 10px 0;
                border-radius: 8px;
                background-color: white;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: relative;
            }
            .rotina-icon {
                margin-right: 15px;
                font-size: 24px;
            }
            .rotina-info {
                flex-grow: 1;
            }
            .rotina-status {
                padding: 5px 10px;
                border-radius: 15px;
                font-size: 12px;
                font-weight: bold;
            }
            .item-vazio {
                background-color: #f9f9f9;
                border: 1px dashed #ccc;
            }
            .status-vazio {
                background-color: #e0e0e0;
                color: #757575;
            }
            .item-adequado {
                background-color: #e8f5e9;
                border-left: 4px solid #4caf50;
            }
            .status-adequado {
                background-color: #4caf50;
                color: white;
            }
            .item-atencao {
                background-color: #fff8e1;
                border-left: 4px solid #ffc107;
            }
            .status-atencao {
                background-color: #ffc107;
                color: #333;
            }
            .horario-sugerido {
                background-color: #e3f2fd;
                padding: 8px 12px;
                border-radius: 4px;
                margin-bottom: 8px;
                font-size: 14px;
                display: flex;
                align-items: center;
            }
            .horario-sugerido i {
                margin-right: 8px;
                font-size: 16px;
            }
            .btn-continuar-rotina {
                margin-top: 20px;
                display: flex;
                justify-content: center;
            }
            .btn-excluir {
                position: absolute;
                top: 10px;
                right: 10px;
                padding: 5px;
                border-radius: 50%;
                width: 30px;
                height: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .btn-excluir i {
                font-size: 16px;
                margin: 0;
            }
            .acoes-rotina {
                display: flex;
                justify-content: center;
                margin-top: 20px;
                gap: 10px;
            }
        </style>
@endsection

@section('content')
    <div class="container">
        <h4 class="center-align">Rotina de Sono - Desafio de 7 Dias</h4>
        
        <!-- Barra de progresso -->
        <div class="progress">
            <div class="determinate" style="width: 0%" id="progress-bar"></div>
        </div>
        <!--
        <div class="card">
    <div class="card-content">
        <span class="card-title">Informações do Bebê</span>
        <p>Idade: {{ \Carbon\Carbon::parse($client->birthBaby)->diffInMonths() }} meses | Tempo acordado esperado: {{ calcularTempoAcordado($client->birthBaby) }} minutos</p>
        
        <div class="center-align" id="container-botao-iniciar">
            <a class="waves-effect waves-light btn-large teal modal-trigger" href="#modal-inicio-dia" id="btn-iniciar-rotina">
                <i class="material-icons left">access_time</i>Iniciar Dia
            </a>
        </div>

        <!-- BOTÕES DE AÇÃO - AGORA APARECEM DIRETAMENTE APÓS INICIAR O DIA 
        <div class="acoes-rotina hidden" id="container-botoes-acao">
            <div class="row center-align">
                <div class="col s12 m4">
                    <a class="waves-effect waves-light btn-large blue modal-trigger" href="#modal-preenchimento-soneca" onclick="prepararNovaSoneca()">
                        <i class="material-icons left">hotel</i>Adicionar Soneca
                    </a>
                </div>
                <div class="col s12 m4">
                    <a class="waves-effect waves-light btn-large purple modal-trigger" href="#modal-ritual-noturno">
                        <i class="material-icons left">check_circle</i>Ritual Noturno
                    </a>
                </div>
                <div class="col s12 m4">
                    <a class="waves-effect waves-light btn-large orange" onclick="finalizarDiaCompleto()">
                        <i class="material-icons left">check_circle</i>Finalizar Dia
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
-->
       <!-- Registro visual da rotina -->
    <div class="registro-rotina">
        <h5>Registro da Rotina</h5>
    
        <!-- Início do dia -->
        <div class="accordion vazio" id="accordion-inicio-dia">
            <div class="accordion-header">
                <div style="display: flex; align-items: center; flex-grow: 1;">
                    <i class="material-icons rotina-icon">wb_sunny</i>
                    <div class="rotina-info" style="margin-left: 15px;">
                        <strong>Início do dia:</strong>
                        <span class="rotina-detalhe">Não registrado</span>
                    </div>
                </div>
                <div style="display: flex; align-items: center;">
                    <span class="rotina-status status-vazio">Pendente</span>
                    <i class="material-icons accordion-icon" style="margin-left: 10px;">expand_more</i>
                </div>
            </div>
            <div class="accordion-content">
                <div class="accordion-content-inner">
                    <p>Clique em "Iniciar Rotina" para começar o registro do dia.</p>
                </div>
            </div>
        </div>
    
        <!-- Sonecas -->
        <div id="registro-sonecas">
            <div class="accordion vazio" id="accordion-soneca-1">
                <div class="accordion-header">
                    <div style="display: flex; align-items: center; flex-grow: 1;">
                        <i class="material-icons rotina-icon">hotel</i>
                        <div class="rotina-info" style="margin-left: 15px;">
                            <strong>Primeira soneca:</strong>
                            <span class="rotina-detalhe">Não registrada</span>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <span class="rotina-status status-vazio">Pendente</span>
                        <i class="material-icons accordion-icon" style="margin-left: 10px;">expand_more</i>
                    </div>
                </div>
                <div class="accordion-content">
                    <div class="accordion-content-inner">
                        <p>Esta soneca ainda não foi registrada.</p>
                        <div class="center-align" style="margin: 15px 0;">
                            <a class="waves-effect waves-light btn blue modal-trigger" href="#modal-preenchimento-soneca"
                                onclick="prepararNovaSoneca()">
                                <i class="material-icons left">add</i>Adicionar Soneca
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="accordion vazio" id="accordion-ritual">
    <div class="accordion-header">
        <div style="display: flex; align-items: center; flex-grow: 1;">
            <i class="material-icons rotina-icon">check_circle</i>
            <div class="rotina-info" style="margin-left: 15px;">
                <strong>Ritual noturno:</strong>
                <span class="rotina-detalhe">Não registrado</span>
            </div>
        </div>
        <div style="display: flex; align-items: center;">
            <span class="rotina-status status-vazio">Pendente</span>
            <i class="material-icons accordion-icon" style="margin-left: 10px;">expand_more</i>
        </div>
    </div>
    <div class="accordion-content">
        <div class="accordion-content-inner">
            <p>O ritual noturno ainda não foi registrado.</p>
            <div class="center-align" style="margin: 15px 0;">
                <a class="waves-effect waves-light btn purple modal-trigger" href="#modal-ritual-noturno">
                    <i class="material-icons left">add</i>Registrar Ritual Noturno
                </a>
            </div>
        </div>
    </div>
</div>

        <div id="registro-despertares">
            <!-- Os despertares serão adicionados dinamicamente aqui -->
        </div>

       <div id="container-finalizar-dia" class="hidden" style="margin: 30px 0; text-align: center;">
    <div class="card-panel green lighten-4">
        <h5>🎉 Dia Quase Concluído!</h5>
        <p>Você registrou todas as informações do dia. Clique no botão abaixo para finalizar.</p>
        <a class="waves-effect waves-light btn-large orange modal-trigger" href="#modal-observacoes-dia">
            <i class="material-icons left">check_circle</i>Finalizar Dia Completo
        </a>
        <p style="margin-top: 10px;"><small>Esta ação salvará todos os dados e preparará um novo dia.</small></p>
    </div>
</div>

    </div>
        
        <!-- Seção para mostrar histórico detalhado -->
        <div id="historico-detalhado" class="hidden"></div>
    </div>

    <!-- Modal 1: Início do Dia -->
    <div id="modal-inicio-dia" class="modal">
        <div class="modal-content">
            <h4>Início do Dia</h4>
            <p>Que horas seu bebê iniciou o dia hoje?</p>
            
            <div class="time-input-container">
                <label for="inicio-dia">Horário que iniciou o dia</label>
                <input type="time" id="inicio-dia" class="time-input" value="07:00">
            </div>
        </div>
        <div class="modal-footer">
           
            <a href="#!" class="waves-effect waves-green btn" onclick="salvarInicioDia()">Salvar e Continuar</a>
             <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
        </div>
    </div>
<!-- Modal de confirmação para ritual noturno sem sonecas -->
<div id="modal-ritual-sem-sonecas" class="modal">
    <div class="modal-content">
        <h4>Ritual Noturno Sem Sonecas</h4>
        <p>Você está indo direto para o ritual noturno sem registrar nenhuma soneca.</p>
        
        <div class="card-panel yellow lighten-4">
            <i class="material-icons left">warning</i>
            <span>Isso é incomum para bebês. Certifique-se de que é isso que deseja fazer.</span>
        </div>
        
        <p>Horário atual: <span id="horario-atual-ritual"></span></p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
        <a href="#!" class="waves-effect waves-green btn teal" onclick="abrirRitualNoturno()">Continuar</a>
    </div>
</div>
    <!-- Modal 4: Sugestões para Soneca -->
    <div id="modal-sugestao-soneca" class="modal">
        <div class="modal-content">
            <h4 id="titulo-sugestao-soneca">Sugestões para Primeira Soneca</h4>
            <p>Com base no último horário que acordou <b>(<span id="horario-ultimo-acordou"></span>) </b>, sugerimos:</p>
            
            <div class="card-panel blue lighten-4">
                <p>📋 <strong>Próximo passo:</strong> Anotar que horas seu bebê começou a sentir sono.</p>
                <p>⏰ <strong>Sugestão de horário para início dos sinais de sono:</strong> <span class="sugestao-horario" id="sugestao-sono"></span></p>
                <p>🛌 <strong>Sugestão de horário para início da soneca: Até</strong> <span class="sugestao-horario" id="sugestao-soneca"></span></p>
            </div>
            
            <p class="grey-text">Estes horários são aproximados e refletem as necessidades de sono da maioria dos bebês com idade similar.</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="waves-effect waves-green btn teal" onclick="abrirModalPreenchimentoSoneca()">Preencher Soneca</a>
        </div>
    </div>

<!-- Modal 5: Preenchimento da Soneca (ATUALIZADO) -->
<div id="modal-preenchimento-soneca" class="modal" style="max-height: 90%;">
    <div class="modal-content">
        <h4 id="titulo-preenchimento-soneca">Registro da Primeira Soneca</h4>

        <div class="row">
            <div class="col s12 m4 time-input-container">
                <div class="horario-sugerido" id="sugestao-sentiu-sono">
                    <i class="material-icons">access_time</i>
                    <span>Sugestão: <strong id="sugestao-sentiu-sono-horario"></strong></span>
                </div>
                <label for="hora-sentiu-sono">Que horas sentiu sono</label>
                <input type="time" id="hora-sentiu-sono" class="time-input">
            </div>
            <div class="col s12 m4 time-input-container">
                <div class="horario-sugerido" id="sugestao-inicio-soneca">
                    <i class="material-icons">access_time</i>
                    <span>Sugestão: <strong id="sugestao-inicio-soneca-horario"></strong></span>
                </div>
                <label for="inicio-soneca">Início da soneca</label>
                <input type="time" id="inicio-soneca" class="time-input">
            </div>
            <div class="col s12 m4 time-input-container">
                <div class="horario-sugerido">
                    <i class="material-icons">info</i>
                    <span>Registre quando acordar</span>
                </div>
                <label for="hora-acordou">Que horas acordou</label>
                <input type="time" id="hora-acordou" class="time-input">
            </div>
        </div>

        <!-- ASSOCIAÇÕES DE SONO - ADICIONADO AQUI -->
        <div class="divider" style="margin: 20px 0;"></div>

        <h5>🌙 Associações de Sono</h5>

        <!-- Como adormeceu -->
        <div class="card-panel blue lighten-5">
            <h6>Como o seu bebê adormeceu? (marque todas que aplicar)</h6>
            <div class="opcoes-adormecer">
                <p>
                    <label>
                        <input type="checkbox" class="filled-in" id="adormeceu-mamando" />
                        <span>Dormiu mamando</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input type="checkbox" class="filled-in" id="adormeceu-ninando" />
                        <span>Dormiu ninando</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input type="checkbox" class="filled-in" id="adormeceu-carrinho" />
                        <span>Dormiu no carrinho</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input type="checkbox" class="filled-in" id="adormeceu-rede" />
                        <span>Balançando na rede</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input type="checkbox" class="filled-in" id="adormeceu-chupeta" />
                        <span>Dormiu com chupeta</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input type="checkbox" class="filled-in" id="adormeceu-outro" />
                        <span>Outro</span>
                    </label>
                    <input type="text" id="adormeceu-outro-detalhe" class="outra-detalhe hidden" placeholder="Qual?">
                </p>
            </div>
        </div>

        <!-- Depois de adormecer -->
        <div class="card-panel green lighten-5" style="margin-top: 15px;">
            <h6>E depois de adormecer? (marque todas que aplicar)</h6>
            <div class="opcoes-depois-adormecer">
                <p>
                    <label>
                        <input type="checkbox" class="filled-in" id="sucao-nao-nutritiva" />
                        <span>Ficou fazendo sucção não nutritiva durante boa parte da soneca</span>
                    </label>
                </p>
                <div class="sub-opcoes" id="sub-sucao" style="margin-left: 20px; display: none;">
                    <p>
                        <label>
                            <input type="radio" name="sucao-opcao" id="sucao-tentou-tirar" />
                            <span>Você tentou tirar do peito? Sim, mas não consegui.</span>
                        </label>
                    </p>
                    <p>
                        <label>
                            <input type="radio" name="sucao-opcao" id="sucao-nao-tentou" />
                            <span>Não tentei mais, pois sempre acorda</span>
                        </label>
                    </p>
                </div>

                <p>
                    <label>
                        <input type="checkbox" class="filled-in" id="colo-soneca" />
                        <span>Ficou no colo durante boa parte da soneca</span>
                    </label>
                </p>
                <div class="sub-opcoes" id="sub-colo" style="margin-left: 20px; display: none;">
                    <p>
                        <label>
                            <input type="radio" name="colo-opcao" id="colo-tentou-tirar" />
                            <span>Você tentou tirar do colo? Sim, mas não consegui.</span>
                        </label>
                    </p>
                    <p>
                        <label>
                            <input type="radio" name="colo-opcao" id="colo-nao-tentou" />
                            <span>Não tentei mais, pois sempre acorda</span>
                        </label>
                    </p>
                </div>

                <p>
                    <label>
                        <input type="checkbox" class="filled-in" id="berco-soneca" />
                        <span>Ficou no berço ou cama durante boa parte da soneca</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input type="checkbox" class="filled-in" id="carrinho-soneca" />
                        <span>Ficou no carrinho durante boa parte da soneca</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input type="checkbox" class="filled-in" id="rede-soneca" />
                        <span>Ficou na rede durante boa parte da soneca</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input type="checkbox" class="filled-in" id="outro-soneca" />
                        <span>Outro?</span>
                    </label>
                    <input type="text" id="outro-soneca-detalhe" class="outra-detalhe hidden" placeholder="Qual?">
                </p>
            </div>
        </div>

        <!-- Incomoda -->
        <div class="card-panel amber lighten-5" style="margin-top: 15px; display: none;" id="card-incomoda">
            <h6>Essa associação te incomoda?</h6>
            <div class="opcoes-incomoda">
                <p>
                    <label>
                        <input type="radio" name="incomoda-opcao" id="incomoda-sim" />
                        <span>Sim</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input type="radio" name="incomoda-opcao" id="incomoda-nao" />
                        <span>Não</span>
                    </label>
                </p>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
        <a href="#!" class="waves-effect waves-green btn teal" onclick="analisarSonecaComAssociacoes()">Analisar
            Soneca</a>
    </div>
</div>

    <!-- Modal 6: Análise da Soneca -->
<div id="modal-analise-soneca" class="modal">
    <div class="modal-content">
        <h4>Análise da <span id="titulo-analise-soneca">Primeira</span> Soneca</h4>
        <div id="resultado-analise"></div>
        
        <div class="btn-continuar-rotina">
            <a class="waves-effect waves-light btn-large teal" onclick="finalizarAnaliseSoneca()">
                <i class="material-icons left">check</i>Finalizar Análise
            </a>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Fechar</a>
    </div>
</div>

<div id="modal-ritual-noturno" class="modal">
    <div class="modal-content">
        <h4>Ritual Noturno</h4>
        <p>Preencha as informações do ritual noturno:</p>

        <div class="time-input-container">
            <label for="inicio-ritual">Horário de início do ritual</label>
            <input type="time" id="inicio-ritual" class="time-input">
        </div>

        <div class="time-input-container">
            <label for="sono-noturno">Horário que adormeceu</label>
            <input type="time" id="sono-noturno" class="time-input">
        </div>

        <div class="input-field">
            <select id="local-sono">
                <option value="" disabled selected>Onde dormiu?</option>
                <option value="berço">Berço próprio</option>
                <option value="quarto-pais">Quarto dos pais</option>
                <option value="cama-compartilhada">Cama compartilhada</option>
                <option value="outro">Outro local</option>
            </select>
            <label>Local do sono</label>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
        <a href="#!" class="waves-effect waves-green btn teal" onclick="finalizarRitualNoturno()">Salvar e Registrar
            Despertares</a>
    </div>
</div>
<!-- Modal 9: Recomendações Detalhadas -->
<div id="modal-recomendacoes" class="modal">
    <div class="modal-content">
        <h4>Recomendações Detalhadas</h4>
        <div id="conteudo-recomendacoes"></div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn teal">Fechar</a>
    </div>
</div>

<!-- Modal 10: Respostas do Questionário -->
<div id="modal-respostas" class="modal">
    <div class="modal-content">
        <h4>Respostas do Questionário</h4>
        <div id="conteudo-respostas"></div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn teal">Fechar</a>
    </div>
</div>

<!-- Modal 11: Registrar Despertar -->
<div id="modal-despertar" class="modal">
    <div class="modal-content">
        <h4 id="titulo-despertar">Registrar Despertar</h4>

        <div class="row">
            <div class="col s12 m6 time-input-container">
                <label for="hora-acordou-despertar">Horário que acordou</label>
                <input type="time" id="hora-acordou-despertar" class="time-input">
            </div>

            <div class="col s12 m6 time-input-container">
                <label for="hora-dormiu-despertar">Horário que voltou a dormir</label>
                <input type="time" id="hora-dormiu-despertar" class="time-input">
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <label><strong>Como voltou a dormir?</strong> (marque todas que aplicar)</label>
                <div class="opcoes-volta-sono" style="margin-top: 15px;">
                    <p>
                        <label>
                            <input type="checkbox" class="filled-in" id="sozinho-despertar" />
                            <span>Sozinho (sem ninar, mamar, chupeta etc)</span>
                        </label>
                    </p>
                    <p>
                        <label>
                            <input type="checkbox" class="filled-in" id="mamando-despertar" />
                            <span>Mamando</span>
                        </label>
                    </p>
                    <p>
                        <label>
                            <input type="checkbox" class="filled-in" id="cama-compartilhada-despertar" />
                            <span>Levando para cama compartilhada</span>
                        </label>
                    </p>
                    <p>
                        <label>
                            <input type="checkbox" class="filled-in" id="ninando-despertar" />
                            <span>Ninando</span>
                        </label>
                    </p>
                    <p>
                        <label>
                            <input type="checkbox" class="filled-in" id="chupeta-despertar" />
                            <span>Com chupeta</span>
                        </label>
                    </p>
                    <p>
                        <label>
                            <input type="checkbox" class="filled-in" id="rede-despertar" />
                            <span>Balançando na rede</span>
                        </label>
                    </p>
                    <p>
                        <label>
                            <input type="checkbox" class="filled-in" id="outra-despertar" class="outra-opcao" />
                            <span>Outra forma</span>
                        </label>
                        <input type="text" id="outra-detalhe-despertar" class="outra-detalhe hidden"
                            placeholder="Qual?">
                    </p>
                </div>
            </div>
        </div>

        <div class="card-panel blue lighten-4">
            <i class="material-icons tiny">info</i>
            <span>Se após seu bebê acordar, você precisou amamentar, niná-lo e oferecer a chupeta, selecione todas as
                opções. Quanto mais precisa for sua resposta, mais precisas serão nossas análises e sugestões.</span>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
        <a href="#!" class="waves-effect waves-green btn teal" onclick="salvarDespertar()">Salvar Despertar</a>
    </div>
</div>

<!-- Modal 13: Observações Finais do Dia -->
<div id="modal-observacoes-dia" class="modal">
    <div class="modal-content">
        <h4>📝 Observações do Dia</h4>
        <p>Antes de finalizar, gostaria de adicionar alguma observação sobre o dia do seu bebê?</p>
        
<form id="formFinalizarDia" method="POST" action="{{ route('rotinas.store', ['id' => $challenge->id, 'day' => $day]) }}">
            @csrf
            <input type="hidden" name="data" id="data-dia">
            <input type="hidden" name="inicioDia" id="inicio-dia-form">
            <input type="hidden" name="historicoSonecas" id="historico-sonecas">
            <input type="hidden" name="ritualNoturno" id="ritual-noturno">
            <input type="hidden" name="historicoDespertares" id="historico-despertares">
            <input type="hidden" name="resumo" id="resumo">
            <input type="hidden" name="idadeBebe" id="idade-bebe">
            <input type="hidden" name="tempoAcordadoEsperado" id="tempo-acordado">

            {{-- Observações do modal --}}
            <div class="input-field">
                <textarea id="observacoes-dia" name="observacoes" class="materialize-textarea" maxlength="200"
                    placeholder="Ex: Bebê estava mais agitado hoje, teve cólicas, dormiu melhor que ontem, etc..."></textarea>
                <label for="observacoes-dia">Observações (opcional)</label>
            </div>

            <div class="contador-caracteres grey-text" style="text-align: right; margin-top: -10px;">
                <span id="contador-observacoes">0</span>/200 caracteres
            </div>
        </form>

        <div class="card-panel blue lighten-5">
            <i class="material-icons tiny">info</i>
            <span>Estas observações ajudarão a entender melhor os padrões do seu bebê ao longo do tempo.</span>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
        <button type="button" class="waves-effect waves-green btn teal" onclick="confirmarFinalizarDia()">
            <i class="material-icons left">check</i>Finalizar Dia
        </button>
    </div>
</div>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    
    <script>
        // Variáveis globais
        let ritualNoturnoRegistrado = false;

        let inicioDia = '';
        let dia = '';
        let tempoAcordado = {{ calcularTempoAcordado($client->birthBaby) }};
        let sonecasRealizadas = 0;
        let historicoSonecas = [];
        let idadeBebe = {{ \Carbon\Carbon::parse($client->birthBaby)->diffInMonths() }};
        let horarioSugeridoSono = '';
        let horarioSugeridoSoneca = '';
        let ultimoHorarioAcordou = '';
        let sonecaAtual = 1;
        let rotinaIniciada = false;

        let historicoDespertares = [];
            let despertarAtual = 1;

        // Variáveis para análise de soneca
const parametrosJanelaSono = {
       // janela ideal em minutos
    maxima: {{ calcularTempoAcordado($client->birthBaby) }} + 40,     // janela máxima em minutos
};

    const parametrosJanelaSinalSono = {
        // janela ideal em minutos
        maxima: {{ calcularTempoAcordado($client->birthBaby) }},     // janela máxima em minutos
    };

const parametrosDuracaoSoneca = {
    curta: 40,     // abaixo disso é soneca curta
    ideal: 60,     // duração ideal
    longa: 120     // acima disso é soneca longa
};
        
        // Inicialização quando o documento estiver pronto
        $(document).ready(function(){
             configurarContadorObservacoes();

            // Inicializar modal de observações
            $('#modal-observacoes-dia').modal();
            $('.modal').modal();
            $('select').formSelect();
            
            // Definir valores padrão para os inputs de tempo
            const agora = new Date();
            const horas = agora.getHours().toString().padStart(2, '0');
            const minutos = agora.getMinutes().toString().padStart(2, '0');
            const horaAtual = `${horas}:${minutos}`;
            
            $('#inicio-dia').val('07:00');
          //  $('#hora-sentiu-sono').val(horaAtual);
           // $('#inicio-soneca').val(horaAtual);
            $('#inicio-ritual').val(horaAtual);
            
            // Verificar se já existe dados salvos
            verificarEstadoSalvo();
            
            // Abrir primeiro modal automaticamente se não houver dados salvos
            if (!rotinaIniciada) {
                setTimeout(function() {
                    $('#modal-inicio-dia').modal('open');
                }, 500);
            }
        });
        
      function prepararNovaSoneca() {
    sonecaAtual = historicoSonecas.length + 1;
    
    // Calcular sugestões baseadas no último horário que acordou
    const [hora, minuto] = ultimoHorarioAcordou.split(':');
    const minutosInicio = parseInt(hora) * 60 + parseInt(minuto);
    const minutosSugestaoSono = minutosInicio + tempoAcordado;
    const minutosSugestaoSoneca = minutosSugestaoSono + 40;

    // Formatar horários
    const formatarHora = (minutos) => {
        const horas = Math.floor(minutos / 60) % 24;
        const mins = minutos % 60;
        return `${horas.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')}`;
    };

    // Preencher sugestões
    horarioSugeridoSono = formatarHora(minutosSugestaoSono);
    horarioSugeridoSoneca = formatarHora(minutosSugestaoSoneca);

    // Atualizar título
    const tituloSoneca = sonecaAtual === 1 ? 'Primeira' : (sonecaAtual === 2 ? 'Segunda' : (sonecaAtual === 3 ? 'Terceira' : 'Quarta'));
    $('#titulo-preenchimento-soneca').text(`Registro da ${tituloSoneca} Soneca`);
    
    // Atualizar os horários sugeridos
    $('#sugestao-sentiu-sono-horario').text(horarioSugeridoSono);
    $('#sugestao-inicio-soneca-horario').text(horarioSugeridoSoneca);
    
    // Preencher os campos com os horários sugeridos
  //  $('#hora-sentiu-sono').val(horarioSugeridoSono);
 //   $('#inicio-soneca').val(horarioSugeridoSoneca);
    
    // Limpar campo de acordou e associações
    $('#hora-acordou').val('');
    $('.opcoes-adormecer input[type="checkbox"]').prop('checked', false);
    $('.opcoes-depois-adormecer input[type="checkbox"]').prop('checked', false);
    $('.sub-opcoes input[type="radio"]').prop('checked', false);
    $('.outra-detalhe').addClass('hidden').val('');
    $('#card-incomoda').hide();
}  
        // Verificar se há estado salvo
function verificarEstadoSalvo() {
    const estadoSalvo = localStorage.getItem('rotinaSono');
    if (estadoSalvo) {
        try {
            const estado = JSON.parse(estadoSalvo);
            inicioDia = estado.inicioDia || '';
            historicoSonecas = estado.historicoSonecas || [];
            ultimoHorarioAcordou = estado.ultimoHorarioAcordou || '';
            sonecaAtual = estado.sonecaAtual || 1;
            rotinaIniciada = estado.rotinaIniciada || false;
            ritualNoturnoRegistrado = estado.ritualNoturnoRegistrado || false;
            respostasQuestionarioAtual = estado.respostasQuestionarioAtual || {};
            
            if (rotinaIniciada) {
                $('#btn-iniciar-rotina').html('<i class="material-icons left">play_arrow</i>Continuar Rotina');
                $('#container-botoes-acao').removeClass('hidden');
                
                // FORÇAR ATUALIZAÇÃO VISUAL AO CARREGAR
                forcarAtualizacaoCompleta();
                
                if (historicoSonecas.length > 0) {
                    ultimoHorarioAcordou = historicoSonecas[historicoSonecas.length - 1].termino;
                }
            }
        } catch (e) {
            console.error('Erro ao carregar estado salvo:', e);
            // Se der erro, limpar tudo
            localStorage.removeItem('rotinaSono');
        }
    }
}
        
        function salvarEstado() {
    console.log('SALVANDO ESTADO COMPLETO...');
    const estado = {
        inicioDia,
        sonecasRealizadas: historicoSonecas.length,
        historicoSonecas,
        ultimoHorarioAcordou,
        sonecaAtual,
        rotinaIniciada,
        ritualNoturnoRegistrado,
        respostasQuestionarioAtual
    };
    console.log('Estado:', estado);
    localStorage.setItem('rotinaSono', JSON.stringify(estado));
    console.log('Estado salvo com sucesso');
}
        


function finalizarDiaCompleto(observacoes = '') {
   
   // alert(historicoSonecas);

    const diaCompleto = {
        data: dia,
        timestamp: new Date().toISOString(),
        inicioDia,
        historicoSonecas,
        ritualNoturno: JSON.parse(localStorage.getItem('ritualNoturno')),
        historicoDespertares,
        observacoes: observacoes,
        resumo: gerarResumoDia(),
        idadeBebe: idadeBebe,
        tempoAcordadoEsperado: tempoAcordado
    };
    
   
    // Salvar histórico de dias
    let historicoDias = JSON.parse(localStorage.getItem('historicoDias') || '[]');
    historicoDias.push(diaCompleto);
    localStorage.setItem('historicoDias', JSON.stringify(historicoDias));
    
    // Salvar dia completo individualmente também
    localStorage.setItem('diaCompleto', JSON.stringify(diaCompleto));
    
    // Limpar dados temporários do dia atual
    localStorage.removeItem('ritualNoturno');
    localStorage.removeItem('despertares');
    localStorage.removeItem('rotinaSono');
    
    // Resetar variáveis
    inicioDia = '';
    historicoSonecas = [];
    historicoDespertares = [];
    sonecaAtual = 1;
    rotinaIniciada = false;
    
    M.toast({html: 'Dia finalizado com sucesso! 🎉'});
    
    // Mostrar resumo do dia
    
    function gerarResumoDia() {
    const totalSonecas = historicoSonecas.length;
    const totalDespertares = historicoDespertares.length;
    const tempoTotalSonecas = historicoSonecas.reduce((total, soneca) => total + soneca.duracao, 0);
    
    return {
        totalSonecas,
        totalDespertares,
        tempoTotalSonecas,
        avaliacao: totalDespertares <= 2 ? 'Boa noite' : 'Noite agitada'
    };
}

    diaCompleto.observacoes = document.getElementById("observacoes-dia").value;

    // Preenche os inputs hidden
    document.getElementById("data-dia").value = diaCompleto.data;
    document.getElementById("inicio-dia-form").value = diaCompleto.inicioDia;
    document.getElementById("historico-sonecas").value = JSON.stringify(diaCompleto.historicoSonecas);
    document.getElementById("ritual-noturno").value = JSON.stringify(diaCompleto.ritualNoturno);
    document.getElementById("historico-despertares").value = JSON.stringify(diaCompleto.historicoDespertares);
    document.getElementById("resumo").value = JSON.stringify(diaCompleto.resumo);
    document.getElementById("idade-bebe").value = diaCompleto.idadeBebe;
    document.getElementById("tempo-acordado").value = diaCompleto.tempoAcordadoEsperado;

    // Envia o form
    document.getElementById("formFinalizarDia").submit();
}






        
        // Função para salvar início do dia
       // Função para salvar início do dia - MODIFICADA
function salvarInicioDia() {
    inicioDia = $('#inicio-dia').val();
    dia = new Date().toLocaleDateString('pt-BR');
    if (!inicioDia) {
        M.toast({html: 'Por favor, informe o horário que iniciou o dia'});
        return;
    }
    
    // Definir o último horário acordado como o início do dia
    ultimoHorarioAcordou = inicioDia;
    rotinaIniciada = true;
    
    // OCULTAR botão de iniciar e MOSTRAR botões de ação
    $('#container-botao-iniciar').addClass('hidden');
    $('#container-botoes-acao').removeClass('hidden');
    
    // Atualizar registro visual do início do dia
    atualizarRegistroVisual();
    
    // Fechar modal atual
    $('#modal-inicio-dia').modal('close');
    
    // Salvar estado
    salvarEstado();
    
    // Atualizar barra de progresso
    atualizarProgresso(10);
    
    M.toast({html: 'Dia iniciado! Agora você pode adicionar sonecas e registrar o ritual noturno.'});
}        
        // Função para iniciar processo de soneca
        function iniciarSoneca() {
            // Calcular sugestões baseadas no último horário que acordou
            const [hora, minuto] = ultimoHorarioAcordou.split(':');
            const minutosInicio = parseInt(hora) * 60 + parseInt(minuto);
            const minutosSugestaoSono = minutosInicio + tempoAcordado;
            const minutosSugestaoSoneca = minutosSugestaoSono + 40;

            // Formatar horários
            const formatarHora = (minutos) => {
                const horas = Math.floor(minutos / 60) % 24;
                const mins = minutos % 60;
                return `${horas.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')}`;
            };

            // Salvar horários sugeridos para usar no modal de preenchimento
            horarioSugeridoSono = formatarHora(minutosSugestaoSono);
            horarioSugeridoSoneca = formatarHora(minutosSugestaoSoneca);

            // Atualizar título e modal de sugestões
            const tituloSoneca = sonecaAtual === 1 ? 'Primeira' : (sonecaAtual === 2 ? 'Segunda' : (sonecaAtual === 3 ? 'Terceira' : 'Quarta'));
            $('#titulo-sugestao-soneca').text(`Sugestões para ${tituloSoneca} Soneca`);
            $('#horario-ultimo-acordou').text(ultimoHorarioAcordou);
            $('#sugestao-sono').text(horarioSugeridoSono);
            $('#sugestao-soneca').text(horarioSugeridoSoneca);
            $('#sugestao-limite').text(formatarHora(minutosSugestaoSoneca + 40));

            // Abrir modal de sugestões
            $('#modal-sugestao-soneca').modal('open');
        }
        
        // Função para iniciar próxima soneca
        function iniciarProximaSoneca() {
            sonecaAtual = historicoSonecas.length + 1;
            iniciarSoneca();
        }
        
        // Função para abrir modal de preenchimento da soneca
        function abrirModalPreenchimentoSoneca() {
            // Atualizar título
            const tituloSoneca = sonecaAtual === 1 ? 'Primeira' : (sonecaAtual === 2 ? 'Segunda' : (sonecaAtual === 3 ? 'Terceira' : 'Quarta'));
            $('#titulo-preenchimento-soneca').text(`Registro da ${tituloSoneca} Soneca`);
            
            // Atualizar os horários sugeridos no modal de preenchimento
            $('#sugestao-sentiu-sono-horario').text(horarioSugeridoSono);
            $('#sugestao-inicio-soneca-horario').text(horarioSugeridoSoneca);
            
            // Preencher os campos com os horários sugeridos
         //   $('#hora-sentiu-sono').val(horarioSugeridoSono);
         //   $('#inicio-soneca').val(horarioSugeridoSoneca);
            
            $('#modal-sugestao-soneca').modal('close');
            setTimeout(function() {
                $('#modal-preenchimento-soneca').modal('open');
            }, 300);
        }

        
        // Função para analisar a soneca
        
function adicionarRespostaQuestionario(pergunta, resposta, detalhes = null) {
    respostasQuestionarioAtual[pergunta] = {
        resposta: resposta,
        detalhes: detalhes,
        timestamp: new Date().toLocaleTimeString('pt-BR')
    };
}    
        
        // Função para continuar a rotina após análise da soneca
        function continuarRotina() {
            $('#modal-analise-soneca').modal('close');
            
            // Incrementar o contador de sonecas
            sonecaAtual++;
            
            // Salvar estado
            salvarEstado();
        }
        
        // Função para excluir a última soneca
        function excluirUltimaSoneca() {
            if (historicoSonecas.length === 0) {
                M.toast({html: 'Não há sonecas para excluir'});
                return;
            }
            
            // Remover a última soneca
            const ultimaSoneca = historicoSonecas.pop();
            
            // Atualizar o último horário que acordou
            if (historicoSonecas.length > 0) {
                ultimoHorarioAcordou = historicoSonecas[historicoSonecas.length - 1].termino;
            } else {
                ultimoHorarioAcordou = inicioDia;
            }
            
            // Atualizar contador de sonecas
            sonecaAtual = historicoSonecas.length + 1;
            
            // Atualizar interface
            atualizarRegistroVisual();
            
            // Atualizar barra de progresso
            atualizarProgresso(25 + (historicoSonecas.length * 15));
            
            // Salvar estado
            salvarEstado();
            
            M.toast({html: 'Última soneca excluída com sucesso'});
        }
        
        // Função para excluir soneca específica
       
        
        // Função para iniciar ritual noturno
       function iniciarRitualNoturno() {
    if (historicoSonecas.length === 0) {
        // Mostrar modal de confirmação se não houver sonecas
        const agora = new Date();
        const horas = agora.getHours().toString().padStart(2, '0');
        const minutos = agora.getMinutes().toString().padStart(2, '0');
        const horaAtual = `${horas}:${minutos}`;
        
        $('#horario-atual-ritual').text(horaAtual);
        $('#modal-ritual-sem-sonecas').modal('open');
    } else {
        // Se houver sonecas, ir direto para o ritual
        abrirRitualNoturno();
    }
}

    function abrirRitualNoturno() {
        // Fechar modais abertos
        $('.modal').modal('close');

        // Preencher com horário atual
        const agora = new Date();
        const horas = agora.getHours().toString().padStart(2, '0');
        const minutos = agora.getMinutes().toString().padStart(2, '0');
        const horaAtual = `${horas}:${minutos}`;

        $('#inicio-ritual').val(horaAtual);
        $('#sono-noturno').val(horaAtual);

        // Abrir modal de ritual noturno
        setTimeout(function () {
            $('#modal-ritual-noturno').modal('open');
        }, 300);

        // Atualizar barra de progresso
        atualizarProgresso(90);
    }

    function atualizarBotoesAcao() {
    if (rotinaIniciada) {
        $('#container-botoes-acao').removeClass('hidden');
        
        // Se não há sonecas, destacar o botão de ritual noturno
        if (historicoSonecas.length === 0) {
            $('#container-botoes-acao .btn').addClass('disabled');
            $('#container-botoes-acao .btn:nth-child(2)').removeClass('disabled').addClass('pulse');
        } else {
            $('#container-botoes-acao .btn').removeClass('disabled pulse');
        }
    }
}

        
        // Função para finalizar ritual noturno
   function finalizarRitualNoturno() {
    const inicioRitual = $('#inicio-ritual').val();
    const sonoNoturno = $('#sono-noturno').val();
    const localSono = $('#local-sono').val();
    
    if (!inicioRitual || !sonoNoturno || !localSono) {
        M.toast({html: 'Por favor, preencha todos os campos do ritual noturno'});
        return;
    }
    
    // Calcular duração do ritual
    const duracaoRitual = calcularDuracao(inicioRitual, sonoNoturno);
    
    // Salvar ritual noturno
    const ritualNoturno = {
        inicioRitual,
        sonoNoturno,
        duracaoRitual,
        localSono,
        data: new Date().toLocaleDateString('pt-BR'),
        timestamp: new Date().toISOString()
    };
    
    localStorage.setItem('ritualNoturno', JSON.stringify(ritualNoturno));
    
    // ATUALIZAR O ACCORDION DO RITUAL NOTURNO
    $('#accordion-ritual')
        .removeClass('vazio')
        .addClass('adequado')
        .find('.rotina-detalhe').text(`${inicioRitual} - ${sonoNoturno} (${duracaoRitual} min) | ${localSono}`);
    
    $('#accordion-ritual .rotina-status')
        .removeClass('status-vazio')
        .addClass('status-adequado')
        .text('Concluído');

    // ATUALIZAR O CONTEÚDO DO ACCORDION
    $('#accordion-ritual .accordion-content-inner').html(`
        <div class="detalhes-ritual">
            <div class="detalhe-item">
                <strong>🕒 Início do ritual</strong>
                ${inicioRitual}
            </div>
            <div class="detalhe-item">
                <strong>😴 Adormeceu</strong>
                ${sonoNoturno}
            </div>
            <div class="detalhe-item">
                <strong>⏱️ Duração do ritual</strong>
                ${duracaoRitual} minutos
            </div>
            <div class="detalhe-item">
                <strong>🛏️ Local</strong>
                ${localSono}
            </div>
            <div class="detalhe-item">
                <strong>🌙 Despertares</strong>
                ${historicoDespertares.length} registrado(s)
            </div>
        </div>
        
        <!-- Botão para adicionar despertar -->
        <div class="center-align" style="margin: 20px 0;">
            <a class="waves-effect waves-light btn purple modal-trigger" href="#modal-despertar" onclick="abrirModalDespertar()">
                <i class="material-icons left">add</i>Adicionar Despertar
            </a>
        </div>
    `);
  $('#container-finalizar-dia').removeClass('hidden');
    // ATUALIZAR BOTÕES PRINCIPAIS
    atualizarBotoesAposRitual();
    
    M.toast({html: 'Ritual noturno salvo! Agora você pode registrar os despertares.'});
    $('#modal-ritual-noturno').modal('close');
    
    // Atualizar barra de progresso
    atualizarProgresso(80);
    
    // Salvar estado
    salvarEstado();
    console.log(estado);
}

    function atualizarBotoesAposRitual() {
        $('#container-botoes-acao').html(`
        <div class="row center-align">
            <div class="col s12 m6">
                <a class="waves-effect waves-light btn-large purple modal-trigger" href="#modal-despertar" onclick="abrirModalDespertar()">
                    <i class="material-icons left">add</i>Adicionar Despertar
                </a>
            </div>
            <div class="col s12 m6">
                <a class="waves-effect waves-light btn-large orange" onclick="finalizarDiaCompleto()">
                    <i class="material-icons left">check_circle</i>Finalizar Dia
                </a>
            </div>
        </div>
        <div class="row center-align" style="margin-top: 10px;">
            <div class="col s12">
                <small class="grey-text">Despertares registrados: <span id="contador-despertares">${historicoDespertares.length}</span></small>
            </div>
        </div>
    `);
    }

function salvarDespertar() {
    const horaAcordou = $('#hora-acordou-despertar').val();
    const horaDormiu = $('#hora-dormiu-despertar').val();
    
    if (!horaAcordou || !horaDormiu) {
        M.toast({html: 'Por favor, preencha os horários do despertar'});
        return;
    }
    
    // Coletar formas de voltar a dormir
    const formasVolta = [];
    
    if ($('#sozinho-despertar').is(':checked')) formasVolta.push('Sozinho');
    if ($('#mamando-despertar').is(':checked')) formasVolta.push('Mamando');
    if ($('#cama-compartilhada-despertar').is(':checked')) formasVolta.push('Cama compartilhada');
    if ($('#ninando-despertar').is(':checked')) formasVolta.push('Ninando');
    if ($('#chupeta-despertar').is(':checked')) formasVolta.push('Chupeta');
    if ($('#rede-despertar').is(':checked')) formasVolta.push('Rede');
    if ($('#outra-despertar').is(':checked')) {
        const outraDetalhe = $('#outra-detalhe-despertar').val();
        formasVolta.push(`Outra: ${outraDetalhe || 'Não especificado'}`);
    }
    
    if (formasVolta.length === 0) {
        M.toast({html: 'Selecione pelo menos uma forma como o bebê voltou a dormir'});
        return;
    }
    
    // Calcular duração
    const duracao = calcularDuracao(horaAcordou, horaDormiu);
    
    // CORREÇÃO: Usar historicoDespertares.length + 1 em vez de despertarAtual
    const numeroDespertar = historicoDespertares.length + 1;
    
    // Salvar no histórico - CORRIGIDO
    historicoDespertares.push({
        numero: numeroDespertar, // ← CORREÇÃO AQUI
        horaAcordou,
        horaDormiu,
        duracao,
        formasVolta,
        timestamp: new Date().toLocaleTimeString('pt-BR')
    });
    
    // ATUALIZAR O CONTADOR NO ACCORDION DO RITUAL
    const ritualSalvo = localStorage.getItem('ritualNoturno');
    if (ritualSalvo) {
        $('#accordion-ritual .detalhe-item:contains("Despertares")').html(`
            <strong>🌙 Despertares</strong>
            ${historicoDespertares.length} registrado(s)
        `);
    }
    
    // Atualizar registro visual dos despertares
    atualizarRegistroDespertares();
    
    // ATUALIZAR CONTADOR NOS BOTÕES
    $('#contador-despertares').text(historicoDespertares.length);
    
    // Fechar modal
    $('#modal-despertar').modal('close');
    
    M.toast({html: `Despertar ${numeroDespertar} salvo!`});
    
    // Salvar estado
    salvarEstado();
}
        // Função para mostrar resumo final
        function mostrarResumoFinal() {
            let resumoHTML = `
                <div class="card-panel teal lighten-2 white-text">
                    <h5>Rotina Concluída com Sucesso!</h5>
                    <p>📅 <strong>Data:</strong> ${new Date().toLocaleDateString('pt-BR')}</p>
                    <p>👶 <strong>Idade do bebê:</strong> ${idadeBebe} meses</p>
                    <p>🌅 <strong>Início do dia:</strong> ${inicioDia}</p>
                    <p>📊 <strong>Sonecas registradas:</strong> ${historicoSonecas.length}</p>
                </div>
            `;
            
           if (historicoSonecas.length > 0) {
        resumoHTML += `
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Histórico Detalhado de Sonecas</span>
                    <table class="striped">
                        <thead>
                            <tr>
                                <th>Soneca</th>
                                <th>Início</th>
                                <th>Término</th>
                                <th>Duração</th>
                                <th>Janela</th>
                                <th>Status</th>
                                <th>Situação</th>
                            </tr>
                        </thead>
                        <tbody>
        `;
        
        historicoSonecas.forEach(soneca => {
            // Determinar ícone e cor com base na situação
            let statusIcon, statusClass;
            
            if (soneca.situacao.includes('1.2/2.3')) {
                statusIcon = 'check_circle';
                statusClass = 'green-text';
            } else if (soneca.situacao.includes('1.1/2.1')) {
                statusIcon = 'warning';
                statusClass = 'red-text';
            } else {
                statusIcon = 'info';
                statusClass = 'blue-text';
            }
            
            resumoHTML += `
                <tr>
                    <td>${soneca.numero}ª</td>
                    <td>${soneca.inicio}</td>
                    <td>${soneca.termino}</td>
                    <td>${soneca.duracao} min</td>
                    <td>${soneca.janelaSono} min</td>
                    <td class="${statusClass}"><i class="material-icons">${statusIcon}</i></td>
                    <td>${soneca.situacao}</td>
                </tr>
            `;
        });
                
                resumoHTML += `
                                </tbody>
                            </table>
                        </div>
                    </div>
                `;
            }
            
            $('#historico-detalhado').html(resumoHTML).removeClass('hidden');

            
        }
        
        // Função para calcular duração entre dois horários
        function calcularDuracao(inicio, fim) {
            const [horaInicio, minutoInicio] = inicio.split(':').map(Number);
            const [horaFim, minutoFim] = fim.split(':').map(Number);
            
            const minutosInicio = horaInicio * 60 + minutoInicio;
            const minutosFim = horaFim * 60 + minutoFim;
            
            // Se o término for no dia seguinte
            if (minutosFim < minutosInicio) {
                return (1440 - minutosInicio) + minutosFim;
            }
            
            return minutosFim - minutosInicio;
        }
        
        // Função para atualizar barra de progresso
        function atualizarProgresso(percentual) {
            $('#progress-bar').css('width', `${percentual}%`);
        }
 let respostasQuestionarioAtual = {};

function analisarSonecaComAssociacoes() {
    const horaSentiuSono = $('#hora-sentiu-sono').val();
    const inicioSoneca = $('#inicio-soneca').val();
    const horaAcordou = $('#hora-acordou').val();
    
    if (!horaSentiuSono || !inicioSoneca || !horaAcordou) {
        M.toast({html: 'Por favor, preencha todos os campos da soneca'});
        return;
    }
    
    // Coletar associações de sono ANTES de fechar o modal
    const associacoes = coletarAssociacoesSoneca();
    
    // Calcular duração
    const duracao = calcularDuracao(inicioSoneca, horaAcordou);
    
    // Calcular janelas
    const janelaSono = calcularDuracao(ultimoHorarioAcordou, inicioSoneca);
    const janelaSinalSono = calcularDuracao(ultimoHorarioAcordou, horaSentiuSono);
    const ritualSono = calcularDuracao(horaSentiuSono, inicioSoneca);
    
    // Analisar
    const analiseJanela = analisarJanelaSono(janelaSono, janelaSinalSono, ritualSono);
    const analiseDuracao = analisarDuracaoSoneca(duracao, janelaSono, janelaSinalSono, ritualSono);
    const situacaoGeral = determinarSituacaoGeral(analiseJanela, analiseDuracao);
    
    // Salvar dados temporários para usar depois
    sonecaTemporaria = {
        horaSentiuSono,
        inicioSoneca,
        horaAcordou,
        duracao,
        janelaSono,
        janelaSinalSono,
        ritualSono,
        analiseJanela,
        analiseDuracao,
        situacaoGeral,
        associacoes
    };
    
    // Fechar modal de preenchimento
    $('#modal-preenchimento-soneca').modal('close');
    
    // Mostrar análise primeiro (como estava antes)
    mostrarResultadoAnalise(analiseJanela, analiseDuracao, situacaoGeral, horaSentiuSono, inicioSoneca, horaAcordou, duracao, janelaSono, janelaSinalSono, ultimoHorarioAcordou, associacoes);
    
    // Abrir modal de análise
    setTimeout(function() {
        $('#modal-analise-soneca').modal('open');
    }, 300);
}

// Função para coletar associações da soneca
function coletarAssociacoesSoneca() {
    // Coletar dados de como adormeceu
    const comoAdormeceu = [];
    if ($('#adormeceu-mamando').is(':checked')) comoAdormeceu.push('Mamando');
    if ($('#adormeceu-ninando').is(':checked')) comoAdormeceu.push('Ninando');
    if ($('#adormeceu-carrinho').is(':checked')) comoAdormeceu.push('Carrinho');
    if ($('#adormeceu-rede').is(':checked')) comoAdormeceu.push('Rede');
    if ($('#adormeceu-chupeta').is(':checked')) comoAdormeceu.push('Chupeta');
    if ($('#adormeceu-outro').is(':checked')) {
        const outroDetalhe = $('#adormeceu-outro-detalhe').val();
        comoAdormeceu.push(`Outro: ${outroDetalhe || 'Não especificado'}`);
    }

    // Coletar dados do depois de adormecer
    const depoisAdormecer = [];
    const detalhesAdormecer = {};
    
    if ($('#sucao-nao-nutritiva').is(':checked')) {
        depoisAdormecer.push('Sucção não nutritiva');
        if ($('#sucao-tentou-tirar').is(':checked')) {
            detalhesAdormecer.sucao = 'Tentou tirar do peito';
        } else if ($('#sucao-nao-tentou').is(':checked')) {
            detalhesAdormecer.sucao = 'Não tentou tirar do peito';
        }
    }
    
    if ($('#colo-soneca').is(':checked')) {
        depoisAdormecer.push('Ficou no colo');
        if ($('#colo-tentou-tirar').is(':checked')) {
            detalhesAdormecer.colo = 'Tentou tirar do colo';
        } else if ($('#colo-nao-tentou').is(':checked')) {
            detalhesAdormecer.colo = 'Não tentou tirar do colo';
        }
    }
    
    if ($('#berco-soneca').is(':checked')) depoisAdormecer.push('Berço/cama');
    if ($('#carrinho-soneca').is(':checked')) depoisAdormecer.push('Carrinho');
    if ($('#rede-soneca').is(':checked')) depoisAdormecer.push('Rede');
    if ($('#outro-soneca').is(':checked')) {
        const outroDetalhe = $('#outro-soneca-detalhe').val();
        depoisAdormecer.push(`Outro: ${outroDetalhe || 'Não especificado'}`);
    }

    // Coletar se incomoda
    let incomoda = null;
    if ($('#incomoda-sim').is(':checked')) incomoda = 'Sim';
    if ($('#incomoda-nao').is(':checked')) incomoda = 'Não';

    return {
        comoAdormeceu,
        depoisAdormecer,
        detalhesAdormecer,
        incomoda,
        timestamp: new Date().toLocaleTimeString('pt-BR')
    };
}

// Função para mostrar análise incluindo associações
function mostrarResultadoAnaliseComAssociacoes(analiseJanela, analiseDuracao, situacaoGeral, sentiuSono, inicio, termino, duracao, janelaSono, janelaSinalSono, ultimoHorarioAcordou, associacoes) {
    
    // ... (mantenha toda a lógica original da função mostrarResultadoAnalise)
    
 const associacoesHTML = associacoes && associacoes.comoAdormeceu.length > 0 ? gerarHTMLAssociacoes(associacoes) : '';
    
    // Incluir no HTML do resultado (adicione esta variável no HTML da análise)
     $('#resultado-analise').html(`
        <div class="card-panel ${situacaoGeral.classe} lighten-4">
            <h5>${situacaoGeral.titulo || situacaoGeral.mensagem}</h5>
            <p><strong>Código:</strong> ${situacaoGeral.codigo}</p>
            
            <div class="divider"></div>
            
            <h6>Detalhes da Soneca</h6>
            <div class="row">
                <div class="col s12 m6">
                    <p><strong>🕒 Acordou da última soneca:</strong><br>${ultimoHorarioAcordou}</p>
                    <p><strong>😴 Sentiu sono:</strong><br>
                        <span class="${classeSentiuSono}">${sentiuSono || 'Não registrado'}</span>
                        ${horarioSugeridoSono ? `<br><small>Sugerido: ${horarioSugeridoSono}</small>` : ''}
                    </p>
                </div>
                <div class="col s12 m6">
                    <p><strong>🛌 Início da soneca:</strong><br>
                        <span class="${classeDormiu}">${inicio}</span>
                        ${horarioSugeridoSoneca ? `<br><small>Sugerido: ${horarioSugeridoSoneca}</small>` : ''}
                    </p>
                    <p><strong>⏰ Término da soneca:</strong><br>${termino}</p>
                </div>
            </div>
            
            <div class="divider"></div>
            
            <div class="row">
                <div class="col s12 m6">
                    <h6>📊 Análise da Janela</h6>
                    <p><strong>Duração sinal→sono:</strong> ${janelaSinalSono} min</p>
                    <p><strong>Status:</strong> ${analiseJanela.mensagem}</p>
                    <p><strong>Recomendação:</strong><br>${analiseJanela.recomendacao}</p>
                </div>
                <div class="col s12 m6">
                    <h6>⏱️ Análise da Duração</h6>
                    <p><strong>Duração total:</strong> ${duracao} min</p>
                    <p><strong>Status:</strong> ${analiseDuracao.mensagem}</p>
                    <p><strong>Recomendação:</strong><br>${analiseDuracao.recomendacao}</p>
                </div>
            </div>
            
            ${associacoesHTML}
            
            ${perguntasExtras}
            
            <div class="divider"></div>
            
            <h6>👶 Próximos Passos</h6>
            <div class="row">
                <div class="col s12 m4">
                    <p><strong>Idade:</strong> ${idadeBebe} meses</p>
                </div>
                <div class="col s12 m4">
                    <p><strong>Tempo acordado:</strong> ${tempoAcordado} min</p>
                </div>
                <div class="col s12 m4">
                    <p><strong>Próxima janela:</strong><br>${calcularProximaJanela()}</p>
                </div>
            </div>
            
            <div class="center-align" style="margin-top: 20px;">
                <a class="waves-effect waves-light btn green" onclick="finalizarAnaliseSoneca()">
                    <i class="material-icons left">check</i>Finalizar Soneca
                </a>
            </div>
        </div>
    `);
}
function gerarHTMLAssociacoes(associacoes) {
    if (!associacoes.comoAdormeceu || associacoes.comoAdormeceu.length === 0) {
        return '';
    }

    return `
        <div class="divider"></div>
        <div class="card-panel purple lighten-5">
            <h6>🌙 Associações Registradas</h6>
            <div class="associacoes-info">
                <p><strong>Como adormeceu:</strong> ${associacoes.comoAdormeceu.join(', ')}</p>
                ${associacoes.depoisAdormecer && associacoes.depoisAdormecer.length > 0 ? 
                    `<p><strong>Durante a soneca:</strong> ${associacoes.depoisAdormecer.join(', ')}</p>` : ''}
                ${associacoes.incomoda ? `<p><strong>Incomoda?</strong> ${associacoes.incomoda}</p>` : ''}
            </div>
        </div>
    `;
}
function analisarSoneca() {
    const horaSentiuSono = $('#hora-sentiu-sono').val();
    const inicioSoneca = $('#inicio-soneca').val();
    const horaAcordou = $('#hora-acordou').val();
    
    if (!horaSentiuSono || !inicioSoneca || !horaAcordou) {
        M.toast({html: 'Por favor, preencha todos os campos da soneca'});
        return;
    }
            
    // Calcular duração da soneca
    const duracao = calcularDuracao(inicioSoneca, horaAcordou);
    
    // Calcular janelas
    const janelaSono = calcularDuracao(ultimoHorarioAcordou, inicioSoneca);
    const janelaSinalSono = calcularDuracao(ultimoHorarioAcordou, horaSentiuSono);
    const ritualSono = calcularDuracao(horaSentiuSono, inicioSoneca);
    
    // Analisar
    const analiseJanela = analisarJanelaSono(janelaSono, janelaSinalSono, ritualSono);
    const analiseDuracao = analisarDuracaoSoneca(duracao, janelaSono, janelaSinalSono, ritualSono);
    const situacaoGeral = determinarSituacaoGeral(analiseJanela, analiseDuracao);
    
    // SALVAR OS DADOS TEMPORARIAMENTE (não fazer push ainda)
    sonecaTemporaria = {
        numero: historicoSonecas.length + 1,
        sentiuSono: horaSentiuSono,
        inicio: inicioSoneca,
        termino: horaAcordou,
        duracao: duracao,
        janelaSono: janelaSono,
        situacao: situacaoGeral.codigo,
        detalhes: {
            janela: analiseJanela,
            duracao: analiseDuracao
        }
    };
    
    // Mostrar análise PRIMEIRO
    mostrarResultadoAnalise(analiseJanela, analiseDuracao, situacaoGeral, horaSentiuSono, inicioSoneca, horaAcordou, duracao, janelaSono, janelaSinalSono, ultimoHorarioAcordou);
    
    // NÃO fazer push ainda - só depois que responder as perguntas
    $('#modal-preenchimento-soneca').modal('close');
    setTimeout(function() {
        $('#modal-analise-soneca').modal('open');
    }, 300);
}

// ADICIONAR esta função para finalizar a soneca após as perguntas
function finalizarAnaliseSoneca() {
    if (!sonecaTemporaria) {
        M.toast({html: 'Erro: dados da soneca não encontrados'});
        return;
    }
    
    const {
        horaSentiuSono,
        inicioSoneca,
        horaAcordou,
        duracao,
        janelaSono,
        analiseJanela,
        analiseDuracao,
        situacaoGeral,
        associacoes
    } = sonecaTemporaria;
    
    // Registrar no histórico
    historicoSonecas.push({
        numero: historicoSonecas.length + 1,
        sentiuSono: horaSentiuSono,
        inicio: inicioSoneca,
        termino: horaAcordou,
        duracao: duracao,
        janelaSono: janelaSono,
        situacao: situacaoGeral.codigo,
        detalhes: {
            janela: analiseJanela,
            duracao: analiseDuracao
        },
        associacoes: associacoes,
        respostas: { ...respostasQuestionarioAtual }
    });

    // Limpar temporários
    sonecaTemporaria = null;
    respostasQuestionarioAtual = {};
    
    // Atualizar o último horário que acordou
    ultimoHorarioAcordou = horaAcordou;
    
    // Atualizar registro visual
    atualizarRegistroVisual();
    
    // Fechar modal
    $('#modal-analise-soneca').modal('close');
    
    M.toast({html: 'Soneca salva no histórico!'});
    
    // Salvar estado
    salvarEstado();
    
    // Atualizar barra de progresso
    atualizarProgresso(25 + (historicoSonecas.length * 15));
}
let sonecaTemporaria = null;
// Função para analisar a janela de sono
function analisarJanelaSono(janela, janelaSinalSono,ritualSono) {
    if (janela <= parametrosJanelaSono.maxima && janelaSinalSono <= parametrosJanelaSinalSono.maxima && ritualSono <= 40 ) {
        return {
            status: 'ideal',
            mensagem: 'Janela de sono ideal',
            codigo: '1.1',
            recomendacao: 'Sinais de sono e soneca iniciando em bons intervalos! Parabéns!'
        };
    } else if (janela <= parametrosJanelaSono.maxima && janelaSinalSono <= parametrosJanelaSinalSono.maxima && ritualSono > 40) {
        return {
            status: 'ideal',
            mensagem: 'Começou a fazer dormir cedo demais, mas dormiu em tempo adequado',
            codigo: '1.2',
            recomendacao: 'Começou a fazer dormir cedo demais, mas dormiu em tempo adequado'
        };
    } else if (janela > parametrosJanelaSono.maxima && janelaSinalSono <= parametrosJanelaSinalSono.maxima && ritualSono > 40) {
        return {
            status: 'longa',
            mensagem: 'Percebeu sinais de sono em tempo adequado, mas demorou muito a fazer dormir',
            codigo: '1.3',
            recomendacao: 'Percebeu sinais de sono em tempo adequado, mas demorou muito a fazer dormir'
        };
    } 
     else if (janela <= parametrosJanelaSono.maxima && janelaSinalSono > parametrosJanelaSinalSono.maxima ) {
        return {
            status: 'longa',
            mensagem: 'Demorou a perceber sinais de sono, mas dormiu rápido, evitando a exaustão',
            codigo: '1.4',
            recomendacao: 'Demorou a perceber sinais de sono, mas dormiu rápido, evitando a exaustão'
        };
    } 
     else if (janela > parametrosJanelaSono.maxima && janelaSinalSono > parametrosJanelaSinalSono.maxima ) {
        return {
            status: 'longa',
            mensagem: 'Demorou a perceber sinais de sono e dormiu exausto',
            codigo: '1.5',
            recomendacao: 'Demorou a perceber sinais de sono e dormiu exausto'
        };
    } 
}

// Função para analisar a duração da soneca
function analisarDuracaoSoneca(duracao, janelaSono, janelaSinalSono,ritualSono) {
     const analiseJanela = analisarJanelaSono(janelaSono,janelaSinalSono,ritualSono);
    if (duracao >= parametrosDuracaoSoneca.curta) {
        return   {
            status: 'Reparadora',
            mensagem: 'Soneca de duração adequada',
            codigo: '2.1',
            recomendacao: 'Duração boa para esta soneca'
        };
    }  else if (duracao < parametrosDuracaoSoneca.curta && ["1.1", "1.2", "1.4"].includes(analiseJanela.codigo)) {
 return   {
            status: 'Curta',
            mensagem: 'Soneca de curta adequada',
            codigo: '2.2G1',
            recomendacao: 'Duração curta para esta soneca'
      };
    }
      else if (duracao < parametrosDuracaoSoneca.curta && ["1.3", "1.5"].includes(analiseJanela.codigo)) {
 return   {
            status: 'Curta',
            mensagem: 'Soneca de curta adequada',
            codigo: '2.2G2',
            recomendacao: 'Duração curta para esta soneca'
      };
    }



  
    
}

// Função para determinar a situação geral
function determinarSituacaoGeral(analiseJanela, analiseDuracao) {
    // Lógica baseada nas combinações de janela e duração
    if (analiseJanela.status === 'ideal' && analiseDuracao.status === 'ideal') {
        return {
            status: 'excelente',
            mensagem: 'Soneca perfeita!',
            codigo: `${analiseJanela.codigo}`,
            classe: 'green'
        };
    } else if (analiseJanela.status === 'curta' && analiseDuracao.status === 'curta') {
        return {
            status: 'critica',
            mensagem: 'Soneca precisa de ajustes',
            codigo: `${analiseJanela.codigo}`,
            classe: 'red'
        };
    } else if (analiseJanela.status === 'muito_longa' || analiseDuracao.status === 'longa') {
        return {
            status: 'atencao',
            mensagem: 'Soneca requer atenção',
            codigo: `${analiseJanela.codigo}`,
            classe: 'orange'
        };
    } else {
        return {
            status: 'boa',
            mensagem: 'Soneca boa',
            codigo: `${analiseJanela.codigo}`,
            classe: 'blue'
        };
    }
}


function mostrarResultadoAnalise(analiseJanela, analiseDuracao, situacaoGeral, sentiuSono, inicio, termino, duracao, janelaSono, janelaSinalSono, ultimoHorarioAcordou) {
    
    // Função auxiliar para verificar se está atrasado
    function isAtrasado(real, sugerido) {
        if (!real || !sugerido) return false;
        return real > sugerido;
    }
    
    // Calcular horários sugeridos
    const formatarHora = (minutos) => {
        const horas = Math.floor(minutos / 60) % 24;
        const mins = minutos % 60;
        return `${horas.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')}`;
    };
    
    const [hora, minuto] = ultimoHorarioAcordou.split(':');
    const minutosInicio = parseInt(hora) * 60 + parseInt(minuto);
    const minutosSugestaoSono = minutosInicio + tempoAcordado;
    const minutosSugestaoSoneca = minutosSugestaoSono + 40;
    
    const horarioSugeridoSono = formatarHora(minutosSugestaoSono);
    const horarioSugeridoSoneca = formatarHora(minutosSugestaoSoneca);
    
    // Determinar classes de cor
    let classeSentiuSono = isAtrasado(sentiuSono, horarioSugeridoSono) ? "red-text" : "green-text";
    let classeDormiu = isAtrasado(inicio, horarioSugeridoSoneca) ? "red-text" : "green-text";
    
    // Preparar perguntas extras baseadas no código
    let perguntasExtras = "";
    
    // Caso código 1.2
    if (analiseJanela.codigo === "1.2") {
        perguntasExtras = `
            <div class="divider"></div>
            <h6>Orientações Adicionais</h6>
            <div class="video-container">
                <p>Assista ao vídeo sobre sinais de sono:</p>
                <div class="video-placeholder" style="background: #f5f5f5; padding: 20px; text-align: center; border-radius: 8px;">
                    <i class="material-icons large">play_circle_filled</i>
                    <p>Vídeo: Entendendo os Sinais de Sono</p>
                    <small class="grey-text">janela1-2.mp4</small>
                </div>
            </div>
            
            <div class="center-align" style="margin: 20px 0;">
                <a class="waves-effect waves-light btn teal" id="btn-sinais-sono">
                    <i class="material-icons left">visibility</i>Ver Sinais de Sono Comuns
                </a>
            </div>
            
            <div id="lista-sinais-sono" class="hidden" style="margin-top: 20px;">
                <div class="card-panel blue lighten-5">
                    <h6>Sinais de Sono Mais Comuns:</h6>
                    <div class="row"">
                        <div class="col s12"><i class="material-icons tiny">emoji_people</i> Bocejar</div>
                        <div class="col s12"><i class="material-icons tiny">directions_run</i> Se agitar</div>
                        <div class="col s12"><i class="material-icons tiny">remove_red_eye</i> Abrir bem os olhos</div>
                        <div class="col s12"><i class="material-icons tiny">volume_up</i> Fazer barulhinhos</div>
                        <div class="col s12"><i class="material-icons tiny">repeat</i> Virar o rosto</div>
                        <div class="col s12"><i class="material-icons tiny">child_care</i> Esconder o rosto no peito</div>
                        <div class="col s12"><i class="material-icons tiny">pan_tool</i> Movimentos involuntários</div>
                        <div class="col s12"><i class="material-icons tiny">touch_app</i> Esfregar os olhos</div>
                        <div class="col s12"><i class="material-icons tiny">visibility</i> Olhar parado/fixo</div>
                        <div class="col s12"><i class="material-icons tiny">content_cut</i> Puxar orelhas/cabelos</div>
                        <div class="col s12"><i class="material-icons tiny">gesture</i> Arranhar o rosto</div>
                        <div class="col s12"><i class="material-icons tiny">accessibility</i> Movimentos descoordenados</div>
                        <div class="col s12"><i class="material-icons tiny">airline_seat_flat</i> Arquear o corpo</div>
                        <div class="col s12"><i class="material-icons tiny">toys</i> Perder interesse em brinquedos</div>
                        <div class="col s12"><i class="material-icons tiny">warning</i> Esbarrar em coisas</div>
                    </div>
                </div>
            </div>
        `;
    }
    
    // Caso código 1.3
    if (analiseJanela.codigo === "1.3") {
        perguntasExtras = `
            <div class="divider"></div>
            <h6>Investigação Adicional</h6>
            <p class="grey-text">Vamos entender melhor o que aconteceu nesta soneca:</p>
            <div id="fluxo-perguntas"></div>
        `;
    }
    
     if (analiseJanela.codigo === "1.4") {
        perguntasExtras = `
            <div class="divider"></div>
            <h6>Investigação Adicional</h6>
            <p class="grey-text">Vamos entender melhor o que aconteceu nesta soneca:</p>
            <div id="fluxo-perguntas"></div>
           
        `;
    }
     if (analiseJanela.codigo === "1.5") {
        perguntasExtras = `
            <div class="divider"></div>
            <h6>Investigação Adicional</h6>
            <p class="grey-text">Vamos entender melhor o que aconteceu nesta soneca:</p>
            <div id="fluxo-perguntas"></div>
           
        `;
    }
    // Gerar HTML do resultado
    $('#resultado-analise').html(`
        <div class="card-panel ${situacaoGeral.classe} lighten-4">
            <h5>${situacaoGeral.titulo || situacaoGeral.mensagem}</h5>
            <p><strong>Código:</strong> ${situacaoGeral.codigo}</p>
            
            <div class="divider"></div>
            
            <h6>Detalhes da Soneca</h6>
            <div class="row">
                <div class="col s12 m6">
                    <p><strong>🕒 Acordou da última soneca:</strong><br>${ultimoHorarioAcordou}</p>
                    <p><strong>😴 Sentiu sono:</strong><br>
                        <span class="${classeSentiuSono}">${sentiuSono || 'Não registrado'}</span>
                        ${horarioSugeridoSono ? `<br><small>Sugerido: ${horarioSugeridoSono}</small>` : ''}
                    </p>
                </div>
                <div class="col s12 m6">
                    <p><strong>🛌 Início da soneca:</strong><br>
                        <span class="${classeDormiu}">${inicio}</span>
                        ${horarioSugeridoSoneca ? `<br><small>Sugerido: ${horarioSugeridoSoneca}</small>` : ''}
                    </p>
                    <p><strong>⏰ Término da soneca:</strong><br>${termino}</p>
                </div>
            </div>
            
            <div class="divider"></div>
            
            <div class="row">
                <div class="col s12 m6">
                    <h6>📊 Análise da Janela</h6>
                    <p><strong>Duração sinal→sono:</strong> ${janelaSinalSono} min</p>
                    <p><strong>Status:</strong> ${analiseJanela.mensagem}</p>
                    <p><strong>Recomendação:</strong><br>${analiseJanela.recomendacao}</p>
                </div>
                <div class="col s12 m6">
                    <h6>⏱️ Análise da Duração</h6>
                    <p><strong>Duração total:</strong> ${duracao} min</p>
                    <p><strong>Status:</strong> ${analiseDuracao.mensagem}</p>
                    <p><strong>Recomendação:</strong><br>${analiseDuracao.recomendacao}</p>
                </div>
            </div>
            
            ${perguntasExtras}
            
            <div class="divider"></div>
            
            
            
            
        </div>
    `);
    
    // Configurar interações
    if (analiseJanela.codigo === "1.2") {
        $('#btn-sinais-sono').on('click', function() {
            $('#lista-sinais-sono').toggleClass('hidden');
            $(this).find('i').text(
                $('#lista-sinais-sono').hasClass('hidden') ? 'visibility' : 'visibility_off'
            );
            $(this).find('span').text(
                $('#lista-sinais-sono').hasClass('hidden') ? 'Ver Sinais de Sono Comuns' : 'Ocultar Sinais de Sono'
            );
        });
    }
    
    if (analiseJanela.codigo === "1.3") {
        setTimeout(() => {
            iniciarFluxoPerguntas();
        }, 100);
    }
    if (analiseJanela.codigo === "1.4") {
       
        setTimeout(() => {
           // iniciarFluxoPerguntas14(sentiuSono);
                   iniciarFluxoPerguntas1_4(sentiuSono, horarioSugeridoSono, tempoAcordado);

        }, 100);
        
    }


    if (analiseJanela.codigo === "1.5") {
       console.log("ok");
        setTimeout(() => {
           // iniciarFluxoPerguntas14(sentiuSono);
                   iniciarFluxoPerguntas1_5(sentiuSono, horarioSugeridoSono, tempoAcordado);

        }, 100);
        
    }
}

    function iniciarFluxoPerguntas() {
        const container = $("#fluxo-perguntas");
        container.empty();

        // Texto introdutório
        container.append(`
        <div class="card-panel orange lighten-4">
            <p><strong>Demorou muito entre o início dos sinais de sono até a soneca, né?</strong></p>
            <p>Seu bebê provavelmente ficou exausto. Para tentar entender as possíveis causas, responda:</p>
        </div>
    `);

        let etapa = 0;
        let respostas = {};

        const perguntas = [
            {
                id: "fora-rotina",
                texto: "O bebê estava fora da rotina, nessa soneca?",
                obs: "<small class='grey-text'>Obs: Não significa necessariamente 'fora de casa', pois alguns vão com frequência para a casa da avó, creche etc e esses locais passam a ser também a rotina do bebê.</small>",
                opcoes: [
                    { texto: "Sim", classe: "green" },
                    { texto: "Não", classe: "red" }
                ],
                handler: (resposta, perguntaEl) => {
                    respostas.foraRotina = resposta;
                     adicionarRespostaQuestionario("Fora da rotina", resposta);
                    if (resposta === "Sim") {
                        perguntaEl.append(`
                        <div class="card-panel green lighten-4" style="margin-top: 15px;">
                            <p><i class="material-icons tiny">check</i> Tudo bem! Sair da rotina faz parte e vamos tentar melhorar na próxima soneca.</p>
                        </div>
                    `);
                        // Pular para análise de duração
                        setTimeout(() => {
                            container.append(`
                            <div class="card-panel blue lighten-4">
                                <p>Continuando para análise da duração das sonecas...</p>
                            </div>
                        `);
                        }, 1000);
                        return true; // Finaliza fluxo
                    }
                    return false; // Continua para próxima pergunta
                }
            },
            {
                id: "dor-atrapalhou",
                texto: "Acha que a dor pode ter atrapalhado essa soneca?",
                opcoes: [
                    { texto: "Sim", classe: "green" },
                    { texto: "Não", classe: "red" },
                    { texto: "Não sei", classe: "blue" }
                ],
                condicao: () => respostas.foraRotina === "Não",
                handler: (resposta, perguntaEl) => {
                               adicionarRespostaQuestionario("Dor atrapalhou", resposta);
 
                    respostas.dorAtrapalhou = resposta;

                    if (resposta === "Sim") {
                        const selectId = `tipo-dor-${Math.random().toString(36).substr(2, 9)}`;

                        perguntaEl.append(`
                        <label>Qual tipo de dor?</label>
                        <div class="input-field" style="margin-top: 15px;">
                            <select id="${selectId}" class="browser-default">
                                
                                <option value="colicas">Cólicas</option>
                                <option value="gases">Gases</option>
                                <option value="disquesia">Disquesia</option>
                                <option value="dentes">Nascimento de dentes</option>
                                <option value="refluxo">Doença do refluxo</option>
                                <option value="outra">Outra</option>
                            </select>
                            
                        </div>
                        <div id="outra-dor-${selectId}" class="hidden" style="margin-top: 10px;">
                            <input type="text" placeholder="Especifique qual outra dor">
                        </div>
                    `);

                        setTimeout(() => {
                            $(`#${selectId}`).formSelect();
                            $(`#${selectId}`).on('change', function () {
                                if (this.value === 'outra') {
                                    $(`#outra-dor-${selectId}`).removeClass('hidden');
                                } else {
                                    $(`#outra-dor-${selectId}`).addClass('hidden');
                                    adicionarRespostaQuestionario("Tipo de dor", tipoDor);
                                }
                            });
                        }, 100);

                        perguntaEl.append(`
                        <div class="card-panel blue lighten-4" style="margin-top: 15px;">
                            <p><i class="material-icons tiny">info</i> A dor pode mesmo estressar o bebê e dificultar bastante seu relaxamento. Se possível, converse com seu pediatra sobre formas de aliviar esse desconforto, para que não atrapalhe mais seu sono.</p>
                            <p><small>Na sessão "Por que o bebê está acordando?" falaremos mais sobre isso.</small></p>
                        </div>
                    `);
                    }
                    return false;
                }
            },
            {
                id: "horario-inicio",
                texto: "Que horas começou a fazer o bebê dormir?",
                opcoes: [
                    { texto: "Imediatamente após sinais", classe: "green", compacto: "Imediatamente" },
                    { texto: "Após 15-20 minutos", classe: "orange", compacto: "15-20 min depois" }
                ],
                condicao: () => respostas.foraRotina === "Não",
                extra: `<p style="margin-top: 10px;"><a href="https://youtu.be/qBaLf8aDLg4" target="_blank" class="teal-text"><i class="material-icons tiny">play_circle_outline</i> Assistir vídeo explicativo</a></p>`,
                handler: (resposta, perguntaEl) => {

                    respostas.horarioInicio = resposta;
                                                    adicionarRespostaQuestionario("Horário de início do ritual", resposta);

                    return false;
                }
            },
            {
                id: "gatilho-choro",
                texto: "Consegue identificar algum gatilho do choro?",
                subtexto: "Ou seja, tem algo que você faz, com a intenção de relaxar o bebê, mas que ele já percebe que fará dormir e se irrita?",
                opcoes: [
                    { texto: "Sim", classe: "green" },
                    { texto: "Não", classe: "red" }
                ],
                condicao: () => respostas.foraRotina === "Não",
                handler: (resposta, perguntaEl) => {
                                adicionarRespostaQuestionario("Gatilho de choro", resposta);

                    respostas.gatilhoChoro = resposta;

                    if (resposta === "Sim") {
                        perguntaEl.append(`
                        <div style="margin-top: 15px;">
                            <input type="text" placeholder="Qual gatilho?" class="browser-default" style="width: 100%; padding: 10px;">
                        </div>
                        <div class="card-panel blue lighten-4" style="margin-top: 15px;">
                            <p><i class="material-icons tiny">lightbulb_outline</i> Sim, eles realmente percebem que estão sendo colocados para dormir e isso pode ser bem assustador e/ou estressante, além de dificultar bastante seu relaxamento.</p>
                            <p>Por isso, se tiver algo que você faz, mas que seu bebê já percebe e se estressa, não haverá outra alternativa, além de alterar essa forma.</p>
                            <p><small>Ex: Se chora ao entrar no quarto escuro, passe a entrar no quarto e escurecer depois, ou mesmo até fazê-lo dormir em outro local.</small></p>
                        </div>
                    `);
                    }
                    return false;
                }
            },
            {
                id: "local-sono",
                texto: "Onde ele dormiu?",
                opcoes: [
                    { texto: "No quarto dos pais", classe: "blue", compacto: "Quarto pais" },
                    { texto: "No próprio quarto", classe: "blue", compacto: "Seu quarto" },
                    { texto: "Outro local", classe: "blue", compacto: "Outro" }
                ],
                condicao: () => respostas.foraRotina === "Não",
                handler: (resposta, perguntaEl) => {
                    respostas.localSono = resposta;
                                adicionarRespostaQuestionario("Local do sono", resposta);


                    // Perguntas subsequentes sobre ambiente
                    perguntaEl.append(`
                    <div style="margin-top: 20px;">
                        <p><strong>Como está o ambiente?</strong></p>
                        <div class="ambiente-options" style="display: flex; flex-wrap: wrap; gap: 8px; margin: 10px 0;">
                            <a class="waves-effect waves-light btn-small blue ambiente-btn" data-valor="claro">Claro</a>
                            <a class="waves-effect waves-light btn-small blue ambiente-btn" data-valor="parcial-escuro">Parc. escuro</a>
                            <a class="waves-effect waves-light btn-small blue ambiente-btn" data-valor="escuro">Escuro</a>
                        </div>
                    </div>
                    <div style="margin-top: 15px;">
                        <p><strong>E quanto aos ruídos?</strong></p>
                        <div class="ruidos-options" style="display: flex; flex-wrap: wrap; gap: 8px; margin: 10px 0;">
                            <a class="waves-effect waves-light btn-small blue ruido-btn" data-valor="barulhento">Barulhento</a>
                            <a class="waves-effect waves-light btn-small blue ruido-btn" data-valor="parcial-silencioso">Parc. silêncio</a>
                            <a class="waves-effect waves-light btn-small blue ruido-btn" data-valor="silencioso">Silencioso</a>
                        </div>
                    </div>
                    <div id="sugestao-ambiente" class="card-panel blue lighten-4 hidden" style="margin-top: 15px;">
                        <p><i class="material-icons tiny">info</i> Alguns bebês realmente precisam de um ambiente mais ajustado, para que possam relaxar sem distrações. Experimente escurecer um pouco mais ou usar um ruído branco, caso não seja possível deixar mais silencioso.</p>
                    </div>
                `);

                    // Configurar eventos para ambiente e ruídos
                    setTimeout(() => {
                        $('.ambiente-btn, .ruido-btn').on('click', function () {
                            $(this).addClass('green').siblings().removeClass('green');

                            // Verificar se precisa mostrar sugestão
                            const ambiente = $('.ambiente-btn.green').data('valor');
                                                adicionarRespostaQuestionario("Ambiente", ambiente);

                            const ruido = $('.ruido-btn.green').data('valor');
                    adicionarRespostaQuestionario("Ruídos", ruido);

                            if ((ambiente === 'claro' || ruido === 'barulhento')) {
                                $('#sugestao-ambiente').removeClass('hidden');
                            } else {
                                $('#sugestao-ambiente').addClass('hidden');
                            }
                        });
                    }, 100);

                    return false;
                }
            },
            {
                id: "briga-dormir",
                texto: "Houve 'briga para dormir' ou muito choro?",
                opcoes: [
                    { texto: "Sim", classe: "green" },
                    { texto: "Não", classe: "red" }
                ],
                condicao: () => respostas.foraRotina === "Não",
                extra: `<p style="margin-top: 10px;"><a href="https://youtube.com/shorts/VAOuMO-9OZE?feature=share" target="_blank" class="teal-text"><i class="material-icons tiny">play_circle_outline</i> Vídeo sobre brigas para dormir</a></p>`,
                handler: (resposta, perguntaEl) => {
                    respostas.brigaDormir = resposta;
                                adicionarRespostaQuestionario("Briga para dormir", resposta);

                    return false;
                }
            },
            {
                id: "associacao-sono",
                texto: "Você tentou fazê-lo dormir sem alguma associação que sabe que o bebê tem?",
                subtexto: "Ex: Se tivesse mamado, ficado na cama compartilhada ou ficado no colo, teria dormido mais rápido?",
                opcoes: [
                    { texto: "Sim", classe: "green" },
                    { texto: "Não", classe: "red" }
                ],
                condicao: () => respostas.foraRotina === "Não",
                extra: `<p style="margin-top: 10px;"><a href="https://youtu.be/-FdKVp5mg4w" target="_blank" class="teal-text"><i class="material-icons tiny">play_circle_outline</i> Vídeo sobre associações de sono</a></p>`,
                handler: (resposta, perguntaEl) => {
                    respostas.associacaoSono = resposta;
                                adicionarRespostaQuestionario("Tentou sem associação", resposta);

                    perguntaEl.append(`<p class="green-text" style="margin-top: 15px;"><i class="material-icons tiny">check_circle</i> Continuando para análise da duração das sonecas...</p>`);
                    return true;
                }
            }
        ];

        function renderizarPergunta() {
            // Encontrar próxima pergunta que atenda às condições
            let proximaPergunta = null;
            let proximoIndex = -1;

            for (let i = etapa; i < perguntas.length; i++) {
                if (!perguntas[i].condicao || perguntas[i].condicao()) {
                    proximaPergunta = perguntas[i];
                    proximoIndex = i;
                    break;
                }
            }

            if (!proximaPergunta) {
                // Fim do fluxo
                container.append(`<div class="card-panel green lighten-4"><p>Análise concluída!</p></div>`);
                return;
            }

            etapa = proximoIndex;
            const pergunta = proximaPergunta;
            const perguntaId = `pergunta-${etapa}`;

            const perguntaHtml = `
            <div id="${perguntaId}" class="pergunta-card">
                <div class="pergunta-header">
                    <span class="pergunta-number">${etapa + 1}/${perguntas.filter(p => !p.condicao || p.condicao()).length}</span>
                    <h6>${pergunta.texto}</h6>
                    ${pergunta.subtexto ? `<p class="grey-text">${pergunta.subtexto}</p>` : ''}
                    ${pergunta.obs ? `<div>${pergunta.obs}</div>` : ''}
                </div>
                <div class="opcoes-container">
                    ${pergunta.opcoes.map(opcao => {
                const textoExibicao = window.innerWidth < 768 && opcao.compacto ? opcao.compacto : opcao.texto;
                return `
                            <a class="waves-effect waves-light btn opcao-btn ${opcao.quebra ? 'quebra-linha' : ''}" 
                               data-resposta="${opcao.texto}" 
                               data-texto-original="${opcao.texto}"
                               data-texto-compacto="${opcao.compacto || opcao.texto}">
                                ${textoExibicao}
                            </a>`;
            }).join('')}
                </div>
                ${pergunta.extra || ''}
            </div>
        `;

            container.append(perguntaHtml);

            // Aplicar classes de cor
            pergunta.opcoes.forEach((opcao, index) => {
                const $botao = $(`#${perguntaId} .opcao-btn`).eq(index);
                $botao.addClass(opcao.classe);
            });

            // Configurar evento de clique
            $(`#${perguntaId} .opcao-btn`).on('click', function () {
                const resposta = $(this).data('resposta');
                const perguntaEl = $(this).closest('.pergunta-card');

                // Marcar como selecionado
                $(this).addClass('darken-2 selected')
                    .html(`${$(this).text()} <i class="material-icons right" style="font-size: 18px;">check</i>`);

                // Desabilitar outros botões
                $(this).siblings('.opcao-btn')
                    .addClass('disabled lighten-2')
                    .off('click')
                    .css('opacity', '0.7');

                // Adicionar check na pergunta
                perguntaEl.find('.pergunta-header h6').append(' <i class="material-icons green-text" style="font-size: 20px; vertical-align: middle;">check_circle</i>');

                // Executar handler
                const finalizar = pergunta.handler(resposta, perguntaEl);

                setTimeout(() => {
                    if (!finalizar) {
                        etapa++;
                        renderizarPergunta();
                    }
                }, 800);
            });
        }

        // Iniciar primeira pergunta
        renderizarPergunta();
    }

    function iniciarFluxoPerguntas14(sentiuSono) {
      
    const container = $("#fluxo-perguntas");
    container.empty();

    // Texto introdutório
    container.append(`
        <div class="card-panel orange lighten-4">
            <p><strong>Demorou a perceber sinais de sono, mas dormiu rápido, evitando a exaustão.</strong></p>
             
            <p>Demorou muito entre o início dos sinais de sono até a soneca, né?</p>
            <p>Pelo menos conseguiu adormecer o bebê rapidamente e provavelmente evitou a exaustão, que é o grande objetivo de uma soneca.</p>
            <p>Mas eu sei que muitas mães preenchem errado nesse momento, colocando o horário que começou a fazer o bebê dormir, e não o horário que ele realmente começou a sentir sono.</p>
        </div>
    `);

    let etapa = 0;
    let respostas = {};

    const perguntas = [
        {
            id: "momento-correto",
            texto: "Esse foi o seu caso?",
            opcoes: [
                { texto: "Esse foi o momento que comecei a fazer dormir, mas começou a sentir sono antes disso.", classe: "orange" },
                { texto: "Esse foi mesmo o momento que começou a sentir sono.", classe: "green" }
            ],
            handler: (resposta, perguntaEl) => {
                respostas.momentoCorreto = resposta;

                if (resposta.includes("comecei a fazer dormir")) {
                    // Perguntar novo horário
                    perguntaEl.append(`
                        <div style="margin-top: 15px;">
                            <label>Em qual momento seu bebê realmente começou a sentir sono?</label>
                            <input type="time" id="hora-sono-real" class="browser-default" style="margin-top: 5px;">
                        </div>
                        <div id="avaliacao-sono-real" style="margin-top: 15px;"></div>
                    `);

                    $("#hora-sono-real").on("change", function () {
                        const valorDigitado = this.value; 
                        // Aqui você precisará calcular se é "acima" ou "abaixo" do limite (ZZ+XX)
                        // Simulação:
                        const acimaLimite = compararHorarios(valorDigitado, horarioSugeridoSono);
                        if (!acimaLimite) {
                            $("#avaliacao-sono-real").html(`
                                <div class="card-panel green lighten-4">
                                    <p><i class="material-icons tiny">check_circle</i> Boa, está dentro do esperado para a idade.</p>
                                    <p><strong>Continuar para a análise da duração das sonecas...</strong></p>
                                </div>
                            `);
                        } else {
                            $("#avaliacao-sono-real").html(`
                                <div class="card-panel red lighten-4">
                                    <p><i class="material-icons tiny">info</i> Ainda demorou mais que <strong>XX</strong> para sentir sono, que costuma ser o intervalo acordado da maioria dos bebês dessa idade.</p>
                                    <p>Existem exceções, mas fica aqui o alerta de observar com mais cuidado.</p>
                                    <p><strong>Continuar para a análise da duração das sonecas...</strong></p>
                                </div>
                            `);
                        }
                    });

                    return true; // Encerrar fluxo aqui porque a próxima depende do input
                }

                if (resposta.includes("mesmo o momento")) {
                    perguntaEl.append(`
                        <div class="card-panel red lighten-4" style="margin-top: 15px;">
                            <p><i class="material-icons tiny">info</i> Tudo bem, mas demorou mais que <strong>XX</strong> para sentir sono, que costuma ser o intervalo acordado da maioria dos bebês dessa idade.</p>
                            <p>Existem exceções, mas fica aqui o alerta de observar com mais cuidado.</p>
                            <p><strong>Continuar para a análise da duração das sonecas...</strong></p>
                        </div>
                    `);
                    return true; // finaliza fluxo
                }

                return false;
            }
        }
    ];

    function renderizarPergunta() {
        if (etapa >= perguntas.length) {
            container.append(`<div class="card-panel green lighten-4"><p>Análise concluída!</p></div>`);
            return;
        }

        const pergunta = perguntas[etapa];
        const perguntaId = `pergunta-${etapa}`;

        const perguntaHtml = `
            <div id="${perguntaId}" class="pergunta-card">
                <div class="pergunta-header">
                    <h6>${pergunta.texto}</h6>
                </div>
                <div class="opcoes-container" style="margin-top: 10px;">
                    ${pergunta.opcoes.map(opcao => `
                        <a class="waves-effect waves-light btn opcao-btn ${opcao.classe}" data-resposta="${opcao.texto}">
                            ${opcao.texto}
                        </a>
                    `).join('')}
                </div>
            </div>
        `;

        container.append(perguntaHtml);

        $(`#${perguntaId} .opcao-btn`).on("click", function () {
            const resposta = $(this).data("resposta");
            const perguntaEl = $(this).closest(".pergunta-card");

            $(this).addClass("darken-2 selected")
                .append(' <i class="material-icons right">check</i>');
            $(this).siblings(".opcao-btn")
                .addClass("disabled lighten-2")
                .off("click");

            perguntaEl.find(".pergunta-header h6").append(' <i class="material-icons green-text">check_circle</i>');

            const finalizar = pergunta.handler(resposta, perguntaEl);
            if (!finalizar) {
                etapa++;
                setTimeout(renderizarPergunta, 800);
            }
        });
    }

    renderizarPergunta();
}

    function iniciarFluxoPerguntas1_4(sentiuSono, horarioSugeridoSono, tempoAcordado) {
        const container = $("#fluxo-perguntas");
        container.empty();

        // Texto introdutório
        container.append(`
        <div class="card-panel yellow lighten-4">
            <p><strong>Demorou a perceber sinais de sono, mas dormiu rápido, evitando a exaustão</strong></p>
            <p>Pelo menos conseguiu adormecer o bebê rapidamente e provavelmente evitou a exaustão, que é o grande objetivo de uma soneca.</p>
            <p><em>Mas eu sei que muitas mães preenchem errado nesse momento, preenchendo, na verdade o horário que começou a fazer o bebê dormir, e não o horário que ele realmente começou a sentir sono.</em></p>
        </div>
    `);

        let etapa = 0;
        let respostas = {};

        const perguntas = [
            {
                id: "confirmacao-horario",
                texto: "Esse foi o seu caso?",
                opcoes: [
                    {
                        texto: "Esse foi o momento que comecei a fazer dormir, mas começou a sentir sono antes disso",
                        classe: "blue",
                        compacto: "Sono foi antes"
                    },
                    {
                        texto: "Esse foi mesmo o momento que começou a sentir sono",
                        classe: "orange",
                        compacto: "Foi esse momento"
                    }
                ],
                handler: (resposta, perguntaEl) => {
                    respostas.confirmacaoHorario = resposta;

                    if (resposta === "Esse foi o momento que comecei a fazer dormir, mas começou a sentir sono antes disso") {
                        // Caso 1: Sono foi antes
                        perguntaEl.append(`
                        <div class="card-panel blue lighten-4" style="margin-top: 15px;">
                            <p><i class="material-icons tiny">thumb_up</i> Tudo bem! Acontece bastante.</p>
                            <p>Me diz aqui em qual momento seu bebê realmente começou a sentir sono:</p>
                        </div>
                        <div class="input-field" style="margin-top: 15px;">
                            <input type="time" id="horario-real-sono" value="${sentiuSono}" class="browser-default">
                            <label for="horario-real-sono">Horário real que sentiu sono</label>
                        </div>
                        <div class="center-align" style="margin-top: 15px;">
                            <a class="waves-effect waves-light btn green" onclick="validarHorarioReal()">
                                <i class="material-icons left">check</i>Validar Horário
                            </a>
                        </div>
                        <div id="resultado-validacao" style="margin-top: 15px;"></div>
                    `);

                        // Configurar função de validação
                        window.validarHorarioReal = function () {
                            const horarioReal = $('#horario-real-sono').val();
                            if (!horarioReal) {
                                M.toast({ html: 'Por favor, informe o horário real' });
                                return;
                            }

                            const resultado = compararHorarios(horarioReal, horarioSugeridoSono, tempoAcordado);
                            $('#resultado-validacao').html(resultado.mensagem);

                            // Habilitar próxima etapa após validação
                            setTimeout(() => {
                                etapa++;
                                renderizarProximaPergunta();
                            }, 1500);
                        };

                        return false; // Aguardar validação do horário
                    } else {
                        // Caso 2: Foi mesmo esse momento
                        const resultado = compararHorarios(sentiuSono, horarioSugeridoSono, tempoAcordado);
                        perguntaEl.append(`
                        <div class="card-panel ${resultado.classe} lighten-4" style="margin-top: 15px;">
                            ${resultado.mensagem}
                        </div>
                    `);

                        // Continuar automaticamente após 2 segundos
                        setTimeout(() => {
                            etapa++;
                            renderizarProximaPergunta();
                        }, 2000);
                    }
                    return false;
                }
            },
            {
                id: "finalizacao",
                texto: "Análise concluída",
                handler: (resposta, perguntaEl) => {
                    perguntaEl.append(`
                    <div class="card-panel green lighten-4">
                        <p><i class="material-icons tiny">check_circle</i> Continuando para análise da duração das sonecas...</p>
                    </div>
                `);
                    return true;
                }
            }
        ];

        // Função para comparar horários e gerar resultado
        function compararHorarios(horarioReal, horarioSugerido, tempoEsperado) {
            const minutosReal = converterHoraParaMinutos(horarioReal);
            const minutosSugerido = converterHoraParaMinutos(horarioSugerido);

            if (minutosReal <= minutosSugerido) {
                return {
                    classe: "green",
                    mensagem: `
                    <p><i class="material-icons">emoji_events</i> <strong>Boa, está dentro do esperado para a idade!</strong></p>
                    <p>O horário que sentiu sono (${horarioReal}) está dentro do intervalo esperado (até ${horarioSugerido}).</p>
                `
                };
            } else {
                const diferenca = minutosReal - minutosSugerido;
                return {
                    classe: "orange",
                    mensagem: `
                    <p><i class="material-icons">warning</i> <strong>Atenção: precisa observar com mais cuidado</strong></p>
                    <p>Ainda demorou mais que ${tempoEsperado} minutos para sentir sono, que costuma ser o intervalo que a maioria dos bebês com essa mesma idade levaria para sentir sono novamente.</p>
                    <p><small>Existem exceções, mas fica aqui o alerta de observar com um pouco mais de cuidado.</small></p>
                `
                };
            }
        }

        // Função auxiliar para converter hora para minutos
        function converterHoraParaMinutos(horaString) {
            const [horas, minutos] = horaString.split(':').map(Number);
            return horas * 60 + minutos;
        }

        function renderizarProximaPergunta() {
            if (etapa >= perguntas.length) {
                // Fim do fluxo
                container.append(`<div class="card-panel green lighten-4"><p>Análise concluída!</p></div>`);
                return;
            }

            const pergunta = perguntas[etapa];
            const perguntaId = `pergunta-1-4-${etapa}`;

            const perguntaHtml = `
            <div id="${perguntaId}" class="pergunta-card" style="margin: 20px 0; padding: 20px; background: #f8f9fa; border-radius: 8px; border-left: 4px solid #ff9800;">
                <div class="pergunta-header">
                    <span class="pergunta-number">${etapa + 1}/${perguntas.length}</span>
                    <h6 style="color: #ff9800;">${pergunta.texto}</h6>
                </div>
                ${pergunta.opcoes ? `
                <div class="opcoes-container" style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; margin: 15px 0;">
                    ${pergunta.opcoes.map(opcao => {
                const textoExibicao = window.innerWidth < 768 && opcao.compacto ? opcao.compacto : opcao.texto;
                return `
                            <a class="waves-effect waves-light btn opcao-btn ${opcao.quebra ? 'quebra-linha' : ''}" 
                               data-resposta="${opcao.texto}"
                               style="margin: 5px; min-width: 140px; text-align: center; white-space: normal; word-wrap: break-word; height: auto; min-height: 36px; line-height: 1.4; padding: 8px 12px;">
                                ${textoExibicao}
                            </a>`;
            }).join('')}
                </div>
                ` : ''}
            </div>
        `;

            container.append(perguntaHtml);

            // Aplicar classes de cor aos botões
            if (pergunta.opcoes) {
                pergunta.opcoes.forEach((opcao, index) => {
                    $(`#${perguntaId} .opcao-btn`).eq(index).addClass(opcao.classe);
                });

                // Configurar evento de clique
                $(`#${perguntaId} .opcao-btn`).on('click', function () {
                    const resposta = $(this).data('resposta');
                    const perguntaEl = $(this).closest('.pergunta-card');

                    // Marcar como selecionado
                    $(this).addClass('darken-2 selected')
                        .html(`${$(this).text()} <i class="material-icons right" style="font-size: 18px;">check</i>`);

                    // Desabilitar outros botões
                    $(this).siblings('.opcao-btn')
                        .addClass('disabled lighten-2')
                        .off('click')
                        .css('opacity', '0.7');

                    // Adicionar check na pergunta
                    perguntaEl.find('.pergunta-header h6').append(' <i class="material-icons green-text" style="font-size: 20px; vertical-align: middle;">check_circle</i>');

                    // Executar handler
                    const finalizar = pergunta.handler(resposta, perguntaEl);

                    if (finalizar) {
                        setTimeout(() => {
                            etapa++;
                            renderizarProximaPergunta();
                        }, 1000);
                    }
                });
            } else {
                // Para perguntas sem opções (como a finalização)
                setTimeout(() => {
                    pergunta.handler(null, $(`#${perguntaId}`));
                }, 500);
            }
        }

        // Iniciar primeira pergunta
        renderizarProximaPergunta();
    }

    function iniciarFluxoPerguntas1_5(sentiuSono, horarioSugeridoSono, tempoAcordado) {
    const container = $("#fluxo-perguntas");
    container.empty();
    
    // Texto introdutório
    container.append(`
        <div class="card-panel red lighten-4">
            <p><strong>Demorou a perceber sinais de sono e dormiu exausto</strong></p>
            <p>Demorou muito para perceber o início dos sinais de sono e para conseguir a soneca, né? Seu bebê provavelmente ficou exausto.</p>
            <p>Para tentar entender as possíveis causas para isso, responda:</p>
        </div>
    `);
    
    let etapa = 0;
    let respostas = {};
    let horarioRealSono = sentiuSono; // Inicialmente usa o horário informado

    const perguntas = [
        {
            id: "fora-rotina",
            texto: "O bebê estava fora da rotina, nessa soneca?",
            obs: "<small class='grey-text'>Obs: Não significa necessariamente 'fora de casa', pois alguns vão com frequência para a casa da avó, creche etc e esses locais passam a ser também a rotina do bebê.</small>",
            opcoes: [
                { texto: "Sim", classe: "green" },
                { texto: "Não", classe: "red" }
            ],
            handler: (resposta, perguntaEl) => {
                respostas.foraRotina = resposta;
                
                if (resposta === "Sim") {
                    perguntaEl.append(`
                        <div class="card-panel green lighten-4" style="margin-top: 15px;">
                            <p><i class="material-icons tiny">check</i> Tudo bem! Sair da rotina faz parte e vamos tentar melhorar na próxima soneca.</p>
                        </div>
                    `);
                    // Pular para análise de duração
                    setTimeout(() => {
                        container.append(`
                            <div class="card-panel blue lighten-4">
                                <p>Continuando para análise da duração das sonecas...</p>
                            </div>
                        `);
                    }, 1000);
                    return true; // Finaliza fluxo
                }
                return false; // Continua para próxima pergunta
            }
        },
        {
            id: "confirmacao-horario",
            texto: "Sobre a demora a perceber os sinais de sono, eu sei que muitas mães preenchem errado nesse momento, preenchendo, na verdade o horário que começou a fazer o bebê dormir, e não o horário que ele realmente começou a sentir sono. Esse foi o seu caso?",
            opcoes: [
                { 
                    texto: "Esse foi o momento que comecei a fazer dormir, mas começou a sentir sono antes disso", 
                    classe: "blue",
                    compacto: "Sono foi antes"
                },
                { 
                    texto: "Esse foi mesmo o momento que começou a sentir sono", 
                    classe: "orange",
                    compacto: "Foi esse momento"
                }
            ],
            condicao: () => respostas.foraRotina === "Não",
            handler: (resposta, perguntaEl) => {
                respostas.confirmacaoHorario = resposta;
                
                if (resposta === "Esse foi o momento que comecei a fazer dormir, mas começou a sentir sono antes disso") {
                    // Caso 1: Sono foi antes
                    perguntaEl.append(`
                        <div class="card-panel blue lighten-4" style="margin-top: 15px;">
                            <p><i class="material-icons tiny">thumb_up</i> Tudo bem! Acontece bastante.</p>
                            <p>Me diz aqui em qual momento seu bebê realmente começou a sentir sono:</p>
                        </div>
                        <div class="input-field" style="margin-top: 15px;">
                            <input type="time" id="horario-real-sono-1-5" value="${sentiuSono}" class="browser-default">
                            <label for="horario-real-sono-1-5">Horário real que sentiu sono</label>
                        </div>
                        <div class="center-align" style="margin-top: 15px;">
                            <a class="waves-effect waves-light btn green" onclick="validarHorarioReal1_5()">
                                <i class="material-icons left">check</i>Validar Horário
                            </a>
                        </div>
                        <div id="resultado-validacao-1-5" style="margin-top: 15px;"></div>
                    `);
                    
                    // Configurar função de validação
                    window.validarHorarioReal1_5 = function() {
                        const horarioReal = $('#horario-real-sono-1-5').val();
                        if (!horarioReal) {
                            M.toast({html: 'Por favor, informe o horário real'});
                            return;
                        }
                        
                        horarioRealSono = horarioReal; // Atualiza o horário real
                        const resultado = compararHorarios1_5(horarioReal, horarioSugeridoSono, tempoAcordado);
                        $('#resultado-validacao-1-5').html(resultado.mensagem);
                        
                        // Habilitar próxima etapa após validação
                        setTimeout(() => {
                            etapa++;
                            renderizarProximaPergunta();
                        }, 1500);
                    };
                    
                    return false; // Aguardar validação do horário
                } else {
                    // Caso 2: Foi mesmo esse momento
                    const resultado = compararHorarios1_5(sentiuSono, horarioSugeridoSono, tempoAcordado);
                    perguntaEl.append(resultado.mensagem);
                    
                    // Continuar automaticamente após 2 segundos
                    setTimeout(() => {
                        etapa++;
                        renderizarProximaPergunta();
                    }, 2000);
                }
                return false;
            }
        },
        {
            id: "dor-atrapalhou",
            texto: "Acha que a dor pode ter atrapalhado essa soneca?",
            opcoes: [
                { texto: "Sim", classe: "green" },
                { texto: "Não", classe: "red" },
                { texto: "Não sei", classe: "blue" }
            ],
            condicao: () => respostas.foraRotina === "Não",
            handler: (resposta, perguntaEl) => {
                respostas.dorAtrapalhou = resposta;
                
                if (resposta === "Sim") {
                    const selectId = `tipo-dor-1-5-${Math.random().toString(36).substr(2, 9)}`;
                    
                    perguntaEl.append(`
                        <div class="input-field" style="margin-top: 15px;">
                            <select id="${selectId}" class="browser-default">
                                <option value="" disabled selected>Qual tipo de dor?</option>
                                <option value="colicas">Cólicas</option>
                                <option value="gases">Gases</option>
                                <option value="disquesia">Disquesia</option>
                                <option value="dentes">Nascimento de dentes</option>
                                <option value="refluxo">Doença do refluxo</option>
                                <option value="outra">Outra</option>
                            </select>
                            <label>Tipo de dor</label>
                        </div>
                        <div id="outra-dor-${selectId}" class="hidden" style="margin-top: 10px;">
                            <input type="text" placeholder="Especifique qual outra dor" class="browser-default">
                        </div>
                    `);
                    
                    setTimeout(() => {
                        $(`#${selectId}`).formSelect();
                        $(`#${selectId}`).on('change', function() {
                            if (this.value === 'outra') {
                                $(`#outra-dor-${selectId}`).removeClass('hidden');
                            } else {
                                $(`#outra-dor-${selectId}`).addClass('hidden');
                            }
                        });
                    }, 100);
                    
                    perguntaEl.append(`
                        <div class="card-panel blue lighten-4" style="margin-top: 15px;">
                            <p><i class="material-icons tiny">info</i> A dor pode mesmo estressar o bebê e dificultar bastante seu relaxamento. Se possível, converse com seu pediatra sobre formas de aliviar esse desconforto, para que não atrapalhe mais seu sono.</p>
                            <p><small>Na sessão "Por que o bebê está acordando?" falaremos mais sobre isso.</small></p>
                        </div>
                    `);
                }
                return false;
            }
        },
        {
            id: "gatilho-choro",
            texto: "Consegue identificar algum gatilho do choro?",
            subtexto: "Ou seja, tem algo que você faz, com a intenção de relaxar o bebê, mas que ele já percebe que fará dormir e se irrita?",
            opcoes: [
                { texto: "Sim", classe: "green" },
                { texto: "Não", classe: "red" }
            ],
            condicao: () => respostas.foraRotina === "Não",
            handler: (resposta, perguntaEl) => {
                respostas.gatilhoChoro = resposta;
                
                if (resposta === "Sim") {
                    perguntaEl.append(`
                        <div style="margin-top: 15px;">
                            <input type="text" placeholder="Qual gatilho?" class="browser-default" style="width: 100%; padding: 10px;">
                        </div>
                        <div class="card-panel blue lighten-4" style="margin-top: 15px;">
                            <p><i class="material-icons tiny">lightbulb_outline</i> Sim, eles realmente percebem que estão sendo colocados para dormir e isso pode ser bem assustador e/ou estressante, além de dificultar bastante seu relaxamento.</p>
                            <p>Por isso, se tiver algo que você faz, mas que seu bebê já percebe e se estressa, não haverá outra alternativa, além de alterar essa forma.</p>
                            <p><small>Ex: Se chora ao entrar no quarto escuro, passe a entrar no quarto e escurecer depois, ou mesmo até fazê-lo dormir em outro local.</small></p>
                        </div>
                    `);
                }
                return false;
            }
        },
        {
            id: "local-sono",
            texto: "Onde ele dormiu?",
            opcoes: [
                { texto: "No quarto dos pais", classe: "blue", compacto: "Quarto pais" },
                { texto: "No próprio quarto", classe: "blue", compacto: "Seu quarto" },
                { texto: "Outro local", classe: "blue", compacto: "Outro" }
            ],
            condicao: () => respostas.foraRotina === "Não",
            handler: (resposta, perguntaEl) => {
                respostas.localSono = resposta;
                
                // Perguntas subsequentes sobre ambiente
                perguntaEl.append(`
                    <div style="margin-top: 20px;">
                        <p><strong>Como está o ambiente?</strong></p>
                        <div class="ambiente-options" style="display: flex; flex-wrap: wrap; gap: 8px; margin: 10px 0;">
                            <a class="waves-effect waves-light btn-small blue ambiente-btn" data-valor="claro">Claro</a>
                            <a class="waves-effect waves-light btn-small blue ambiente-btn" data-valor="parcial-escuro">Parc. escuro</a>
                            <a class="waves-effect waves-light btn-small blue ambiente-btn" data-valor="escuro">Escuro</a>
                        </div>
                    </div>
                    <div style="margin-top: 15px;">
                        <p><strong>E quanto aos ruídos?</strong></p>
                        <div class="ruidos-options" style="display: flex; flex-wrap: wrap; gap: 8px; margin: 10px 0;">
                            <a class="waves-effect waves-light btn-small blue ruido-btn" data-valor="barulhento">Barulhento</a>
                            <a class="waves-effect waves-light btn-small blue ruido-btn" data-valor="parcial-silencioso">Parc. silêncio</a>
                            <a class="waves-effect waves-light btn-small blue ruido-btn" data-valor="silencioso">Silencioso</a>
                        </div>
                    </div>
                    <div id="sugestao-ambiente-1-5" class="card-panel blue lighten-4 hidden" style="margin-top: 15px;">
                        <p><i class="material-icons tiny">info</i> Alguns bebês realmente precisam de um ambiente mais ajustado, para que possam relaxar sem distrações. Experimente escurecer um pouco mais ou usar um ruído branco, caso não seja possível deixar mais silencioso.</p>
                    </div>
                `);
                
                // Configurar eventos para ambiente e ruídos
                setTimeout(() => {
                    $('.ambiente-btn, .ruido-btn').on('click', function() {
                        $(this).addClass('green').siblings().removeClass('green');
                        
                        // Verificar se precisa mostrar sugestão
                        const ambiente = $('.ambiente-btn.green').data('valor');
                        const ruido = $('.ruido-btn.green').data('valor');
                        
                        if ((ambiente === 'claro' || ruido === 'barulhento')) {
                            $('#sugestao-ambiente-1-5').removeClass('hidden');
                        } else {
                            $('#sugestao-ambiente-1-5').addClass('hidden');
                        }
                    });
                }, 100);
                
                return false;
            }
        },
        {
            id: "briga-dormir",
            texto: "Houve 'briga para dormir' ou muito choro?",
            opcoes: [
                { texto: "Sim", classe: "green" },
                { texto: "Não", classe: "red" }
            ],
            condicao: () => respostas.foraRotina === "Não",
            extra: `<p style="margin-top: 10px;"><a href="https://youtube.com/shorts/VAOuMO-9OZE?feature=share" target="_blank" class="teal-text"><i class="material-icons tiny">play_circle_outline</i> Vídeo sobre brigas para dormir</a></p>`,
            handler: (resposta, perguntaEl) => {
                respostas.brigaDormir = resposta;
                return false;
            }
        },
        {
            id: "associacao-sono",
            texto: "Você tentou fazê-lo dormir sem alguma associação que sabe que o bebê tem?",
            subtexto: "Ex: Se tivesse mamado, ficado na cama compartilhada ou ficado no colo, teria dormido mais rápido?",
            opcoes: [
                { texto: "Sim", classe: "green" },
                { texto: "Não", classe: "red" }
            ],
            condicao: () => respostas.foraRotina === "Não",
            extra: `<p style="margin-top: 10px;"><a href="https://youtu.be/-FdKVp5mg4w" target="_blank" class="teal-text"><i class="material-icons tiny">play_circle_outline</i> Vídeo sobre associações de sono</a></p>`,
            handler: (resposta, perguntaEl) => {
                respostas.associacaoSono = resposta;
                perguntaEl.append(`<p class="green-text" style="margin-top: 15px;"><i class="material-icons tiny">check_circle</i> Continuando para análise da duração das sonecas...</p>`);
                return true;
            }
        }
    ];

    // Função para comparar horários (similar à 1.4 mas com mensagens específicas)
    function compararHorarios1_5(horarioReal, horarioSugerido, tempoEsperado) {
        const minutosReal = converterHoraParaMinutos(horarioReal);
        const minutosSugerido = converterHoraParaMinutos(horarioSugerido);
        
        if (minutosReal <= minutosSugerido) {
            return {
                mensagem: `
                    <div class="card-panel green lighten-4" style="margin-top: 15px;">
                        <p><i class="material-icons">emoji_events</i> <strong>Boa, está dentro do esperado para a idade!</strong></p>
                        <p>O horário que sentiu sono (${horarioReal}) está dentro do intervalo esperado (até ${horarioSugerido}).</p>
                        <p><strong>Mas atenção:</strong> Lembre que se demorar demais para fazer dormir, você pode iniciar em um momento que o bebê já estará estressado, devido ao cansaço excessivo, o que dificultará bastante o seu ritual da soneca.</p>
                    </div>
                `
            };
        } else {
            const diferenca = minutosReal - minutosSugerido;
            return {
                mensagem: `
                    <div class="card-panel orange lighten-4" style="margin-top: 15px;">
                        <p><i class="material-icons">warning</i> <strong>Atenção: precisa observar com mais cuidado</strong></p>
                        <p>Ainda demorou mais que ${tempoEsperado} minutos para sentir sono, que costuma ser o intervalo que a maioria dos bebês com essa mesma idade levaria para sentir sono novamente.</p>
                        <p><strong>Isso é importante pois</strong> se demorar demais para fazer dormir, você pode iniciar em um momento que o bebê já estará estressado, devido ao cansaço excessivo, o que dificultará bastante o seu ritual da soneca.</p>
                        <p><small>Existem exceções, mas fica aqui o alerta de observar com um pouco mais de cuidado e se certificar do horário que seu bebê começou a sentir sono.</small></p>
                    </div>
                `
            };
        }
    }

    function converterHoraParaMinutos(horaString) {
        const [horas, minutos] = horaString.split(':').map(Number);
        return horas * 60 + minutos;
    }

    function renderizarProximaPergunta() {
        // Encontrar próxima pergunta que atenda às condições
        let proximaPergunta = null;
        let proximoIndex = -1;
        
        for (let i = etapa; i < perguntas.length; i++) {
            if (!perguntas[i].condicao || perguntas[i].condicao()) {
                proximaPergunta = perguntas[i];
                proximoIndex = i;
                break;
            }
        }
        
        if (!proximaPergunta) {
            container.append(`<div class="card-panel green lighten-4"><p>Análise da situação 1.5 concluída!</p></div>`);
            return;
        }
        
        etapa = proximoIndex;
        const pergunta = proximaPergunta;
        const perguntaId = `pergunta-1-5-${etapa}`;
        
        const perguntaHtml = `
            <div id="${perguntaId}" class="pergunta-card" style="margin: 20px 0; padding: 20px; background: #f8f9fa; border-radius: 8px; border-left: 4px solid #f44336;">
                <div class="pergunta-header">
                    <span class="pergunta-number">${etapa + 1}/${perguntas.filter(p => !p.condicao || p.condicao()).length}</span>
                    <h6 style="color: #f44336;">${pergunta.texto}</h6>
                    ${pergunta.subtexto ? `<p class="grey-text">${pergunta.subtexto}</p>` : ''}
                    ${pergunta.obs ? `<div>${pergunta.obs}</div>` : ''}
                </div>
                ${pergunta.opcoes ? `
                <div class="opcoes-container" style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; margin: 15px 0;">
                    ${pergunta.opcoes.map(opcao => {
                        const textoExibicao = window.innerWidth < 768 && opcao.compacto ? opcao.compacto : opcao.texto;
                        return `
                            <a class="waves-effect waves-light btn opcao-btn ${opcao.quebra ? 'quebra-linha' : ''}" 
                               data-resposta="${opcao.texto}"
                               style="margin: 5px; min-width: 140px; text-align: center; white-space: normal; word-wrap: break-word; height: auto; min-height: 36px; line-height: 1.4; padding: 8px 12px;">
                                ${textoExibicao}
                            </a>`;
                    }).join('')}
                </div>
                ` : ''}
                ${pergunta.extra || ''}
            </div>
        `;
        
        container.append(perguntaHtml);
        
        // Aplicar classes de cor e configurar eventos
        if (pergunta.opcoes) {
            pergunta.opcoes.forEach((opcao, index) => {
                $(`#${perguntaId} .opcao-btn`).eq(index).addClass(opcao.classe);
            });
            
            $(`#${perguntaId} .opcao-btn`).on('click', function() {
                const resposta = $(this).data('resposta');
                const perguntaEl = $(this).closest('.pergunta-card');
                
                $(this).addClass('darken-2 selected')
                       .html(`${$(this).text()} <i class="material-icons right" style="font-size: 18px;">check</i>`);
                
                $(this).siblings('.opcao-btn')
                    .addClass('disabled lighten-2')
                    .off('click')
                    .css('opacity', '0.7');
                
                perguntaEl.find('.pergunta-header h6').append(' <i class="material-icons green-text" style="font-size: 20px; vertical-align: middle;">check_circle</i>');
                
                const finalizar = pergunta.handler(resposta, perguntaEl);
                
                if (!finalizar) {
                    setTimeout(() => {
                        etapa++;
                        renderizarProximaPergunta();
                    }, 800);
                }
            });
        }
    }
    
    // Iniciar primeira pergunta
    renderizarProximaPergunta();
}

// Função auxiliar para calcular próxima janela
function calcularProximaJanela() {
    if (!ultimoHorarioAcordou) return "Aguardando dados...";
    
    const [hora, minuto] = ultimoHorarioAcordou.split(':');
    const minutos = parseInt(hora) * 60 + parseInt(minuto);
    const proximaJanela = minutos + tempoAcordado;
    
    const horasProxima = Math.floor(proximaJanela / 60) % 24;
    const minutosProxima = proximaJanela % 60;
    
    return `${horasProxima.toString().padStart(2, '0')}:${minutosProxima.toString().padStart(2, '0')}`;
}

// Função para fechar análise
function fecharAnalise() {
    
    $('#modal-analise-soneca').modal('close');
}



// Função para calcular próxima janela de sono
function calcularProximaJanela() {
    const [hora, minuto] = ultimoHorarioAcordou.split(':');
    const minutosAcordou = parseInt(hora) * 60 + parseInt(minuto);
    const minutosProximaJanela = minutosAcordou + tempoAcordado;
    
    const horasProxima = Math.floor(minutosProximaJanela / 60) % 24;
    const minutosProxima = minutosProximaJanela % 60;
    
    return `${horasProxima.toString().padStart(2, '0')}:${minutosProxima.toString().padStart(2, '0')}`;
}

function compararHorarios(sentiuSono, horarioSugeridoSono) {
    
    const [horaSono, minSono] = sentiuSono.split(':').map(Number);
    const [horaSug, minSug] = horarioSugeridoSono.split(':').map(Number);

    const dataSono = new Date();
    dataSono.setHours(horaSono, minSono, 0, 0);

    const dataSug = new Date();
    dataSug.setHours(horaSug, minSug, 0, 0);

    return dataSono > dataSug; // true se sentiuSono ocorreu depois do sugerido
}

function atualizarRegistroVisual() {
    // Atualizar início do dia
    if (inicioDia) {
        const $accordion = $('#accordion-inicio-dia');
        $accordion.removeClass('vazio').addClass('adequado')
            .find('.rotina-detalhe').text(inicioDia);
        $accordion.find('.rotina-status')
            .removeClass('status-vazio').addClass('status-adequado')
            .text('Registrado');

        $accordion.find('.accordion-content-inner').html(`
            <div class="detalhes-soneca">
                <div class="detalhe-item">
                    <strong>🕒 Início do dia</strong>
                    ${inicioDia}
                </div>
                <div class="detalhe-item">
                    <strong>👶 Idade do bebê</strong>
                    ${idadeBebe} meses
                </div>
                <div class="detalhe-item">
                    <strong>⏰ Tempo acordado esperado</strong>
                    ${tempoAcordado} minutos
                </div>
                <div class="detalhe-item">
                    <strong>📅 Data</strong>
                    ${new Date().toLocaleDateString('pt-BR')}
                </div>
            </div>
            <div class="row center-align" style="margin: 20px 0;">
                <div class="col s12">
                    <a class="waves-effect waves-light btn red" onclick="excluirInicioDia()">
                        <i class="material-icons left">delete</i>Excluir Início do Dia
                    </a>
                </div>
            </div>
        `);
    }

    // Atualizar sonecas
    $('#registro-sonecas').empty();
    
    historicoSonecas.forEach((soneca, index) => {
        const sonecaId = index + 1;
        
        const isAdequada = ['1.1', '1.2'].includes(soneca.situacao) && soneca.duracao >= 40;
        const statusClasse = isAdequada ? 'adequado' : 'atencao';
        const statusTexto = isAdequada ? 'Adequada' : 'Atenção';
        const statusLabel = isAdequada ? 'status-adequado' : 'status-atencao';

        const detalhes = soneca.sentiuSono ?
            `Sono: ${soneca.sentiuSono} | Soneca: ${soneca.inicio} - ${soneca.termino} (${soneca.duracao} min)` :
            `Soneca: ${soneca.inicio} - ${soneca.termino} (${soneca.duracao} min)`;

        $('#registro-sonecas').append(`
            <div class="accordion ${statusClasse}" id="accordion-soneca-${sonecaId}">
                <div class="accordion-header">
                    <div style="display: flex; align-items: center; flex-grow: 1;">
                        <i class="material-icons rotina-icon">hotel</i>
                        <div class="rotina-info" style="margin-left: 15px;">
                            <strong>${sonecaId}ª soneca:</strong>
                            <span class="rotina-detalhe">${detalhes}</span>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <span class="rotina-status ${statusLabel}">${statusTexto}</span>
                        <i class="material-icons accordion-icon" style="margin-left: 10px;">expand_more</i>
                    </div>
                </div>
                <div class="accordion-content">
                    <div class="accordion-content-inner">
                        <div class="detalhes-soneca">
                            <div class="detalhe-item">
                                <strong>😴 Sentiu sono</strong>
                                ${soneca.sentiuSono || 'Não registrado'}
                            </div>
                            <div class="detalhe-item">
                                <strong>🛌 Início da soneca</strong>
                                ${soneca.inicio}
                            </div>
                            <div class="detalhe-item">
                                <strong>⏰ Término</strong>
                                ${soneca.termino}
                            </div>
                            <div class="detalhe-item">
                                <strong>⏱️ Duração</strong>
                                ${soneca.duracao} minutos
                            </div>
                            <div class="detalhe-item">
                                <strong>📊 Situação</strong>
                                ${soneca.situacao}
                            </div>
                            <div class="detalhe-item">
                                <strong>🎯 Status</strong>
                                ${statusTexto}
                            </div>
                        </div>
                        
                        <div class="row center-align" style="margin: 20px 0;">
                            <div class="col s12 m6">
                                <a class="waves-effect waves-light btn blue modal-trigger" href="#modal-recomendacoes" 
                                   onclick="carregarRecomendacoesAccordion('${soneca.situacao}', ${soneca.duracao}, ${index})">
                                    <i class="material-icons left">lightbulb_outline</i>Recomendações
                                </a>
                            </div>
                            <div class="col s12 m6">
                                <a class="waves-effect waves-light btn red" onclick="excluirSoneca(${index})">
                                    <i class="material-icons left">delete</i>Excluir
                                </a>
                            </div>
                        </div>
                        
                        ${soneca.associacoes && soneca.associacoes.comoAdormeceu && soneca.associacoes.comoAdormeceu.length > 0 ? `
                        <div class="associacoes-soneca" style="margin: 15px 0; padding: 15px; background: #f3e5f5; border-radius: 8px; border-left: 4px solid #7e57c2;">
                            <h6 style="margin-top: 0; color: #7e57c2;">Associações de Sono</h6>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                ${soneca.associacoes.comoAdormeceu.length > 0 ? `
                                <div>
                                    <strong>🌙 Como adormeceu:</strong><br>
                                    ${soneca.associacoes.comoAdormeceu.join(', ')}
                                </div>
                                ` : ''}
                                
                                ${soneca.associacoes.depoisAdormecer && soneca.associacoes.depoisAdormecer.length > 0 ? `
                                <div>
                                    <strong>😴 Durante a soneca:</strong><br>
                                    ${soneca.associacoes.depoisAdormecer.join(', ')}
                                </div>
                                ` : ''}
                                
                                ${soneca.associacoes.detalhesAdormecer && Object.keys(soneca.associacoes.detalhesAdormecer).length > 0 ? `
                                <div>
                                    <strong>📝 Detalhes:</strong><br>
                                    ${Object.values(soneca.associacoes.detalhesAdormecer).join(', ')}
                                </div>
                                ` : ''}
                                
                                ${soneca.associacoes.incomoda ? `
                                <div>
                                    <strong>🤔 Incomoda?</strong><br>
                                    ${soneca.associacoes.incomoda}
                                </div>
                                ` : ''}
                            </div>
                        </div>
                        ` : ''}
                        
                        <div class="recomendacao">
                            <h6><i class="material-icons tiny">lightbulb_outline</i> Recomendações Resumidas</h6>
                            ${gerarRecomendacaoSoneca(soneca)}
                        </div>
                        
                        ${gerarRespostasQuestionario(soneca)}
                    </div>
                </div>
            </div>
        `);
    });

    // Adicionar próxima soneca vazia
    const proximaSonecaId = historicoSonecas.length + 1;
    if (proximaSonecaId <= 4) {
        $('#registro-sonecas').append(`
            <div class="accordion vazio" id="accordion-soneca-${proximaSonecaId}">
                <div class="accordion-header">
                    <div style="display: flex; align-items: center; flex-grow: 1;">
                        <i class="material-icons rotina-icon">hotel</i>
                        <div class="rotina-info" style="margin-left: 15px;">
                            <strong>${proximaSonecaId}ª soneca:</strong>
                            <span class="rotina-detalhe">Não registrada</span>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <span class="rotina-status status-vazio">Pendente</span>
                        <i class="material-icons accordion-icon" style="margin-left: 10px;">expand_more</i>
                    </div>
                </div>
                <div class="accordion-content">
                    <div class="accordion-content-inner">
                        <p>Esta soneca ainda não foi registrada.</p>
                        <div class="center-align" style="margin: 15px 0;">
                            <a class="waves-effect waves-light btn blue modal-trigger" href="#modal-preenchimento-soneca" onclick="prepararNovaSoneca()">
                                <i class="material-icons left">add</i>Adicionar Soneca
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        `);
    }

    // ATUALIZAR RITUAL NOTURNO
     const ritualSalvo = localStorage.getItem('ritualNoturno');
    if (ritualSalvo) {
        try {
            const ritual = JSON.parse(ritualSalvo);
            const $accordionRitual = $('#accordion-ritual');
            
            $accordionRitual.removeClass('vazio').addClass('adequado')
                .find('.rotina-detalhe').text(`${ritual.inicioRitual} - ${ritual.sonoNoturno} (${ritual.duracaoRitual} min) | ${ritual.localSono}`);
            
            $accordionRitual.find('.rotina-status')
                .removeClass('status-vazio').addClass('status-adequado')
                .text('Concluído');

            $accordionRitual.find('.accordion-content-inner').html(`
                <div class="detalhes-ritual">
                    <div class="detalhe-item">
                        <strong>🕒 Início do ritual</strong>
                        ${ritual.inicioRitual}
                    </div>
                    <div class="detalhe-item">
                        <strong>😴 Adormeceu</strong>
                        ${ritual.sonoNoturno}
                    </div>
                    <div class="detalhe-item">
                        <strong>⏱️ Duração do ritual</strong>
                        ${ritual.duracaoRitual} minutos
                    </div>
                    <div class="detalhe-item">
                        <strong>🛏️ Local</strong>
                        ${ritual.localSono}
                    </div>
                    <div class="detalhe-item">
                        <strong>🌙 Despertares</strong>
                        ${historicoDespertares.length} registrado(s)
                    </div>
                </div>
                
                <div class="center-align" style="margin: 20px 0;">
                    <a class="waves-effect waves-light btn purple modal-trigger" href="#modal-despertar" onclick="abrirModalDespertar()">
                        <i class="material-icons left">add</i>Adicionar Despertar
                    </a>
                </div>

                <div class="row center-align" style="margin: 20px 0;">
                    <div class="col s12">
                        <a class="waves-effect waves-light btn red" onclick="excluirRitualNoturno()">
                            <i class="material-icons left">delete</i>Excluir Ritual Noturno
                        </a>
                    </div>
                </div>
            `);
        } catch (e) {
            console.error('Erro ao carregar ritual:', e);
        }
    }

    // ATUALIZAR DESPERTARES
    atualizarRegistroDespertares();

    // MOSTRAR/OCULTAR CONTAINER DE FINALIZAR DIA
    if (inicioDia && historicoSonecas.length > 0 && ritualSalvo) {
        $('#container-finalizar-dia').removeClass('hidden');
    } else {
        $('#container-finalizar-dia').addClass('hidden');
    }

    // Configurar eventos de clique para os accordions
    $('.accordion .accordion-header').off('click').on('click', function () {
        const $accordion = $(this).closest('.accordion');
        const isOpen = $accordion.hasClass('open');
        $('.accordion').removeClass('open');
        if (!isOpen) {
            $accordion.addClass('open');
        }
    });
}



// FUNÇÕES AUXILIARES QUE PRECISAM SER CRIADAS

function excluirRitualNoturno() {
    if (confirm('Tem certeza que deseja excluir o ritual noturno?')) {
        localStorage.removeItem('ritualNoturno');
        $('#accordion-ritual')
            .removeClass('adequado')
            .addClass('vazio')
            .find('.rotina-detalhe').text('Não registrado');
        
        $('#accordion-ritual .rotina-status')
            .removeClass('status-adequado')
            .addClass('status-vazio')
            .text('Pendente');
        
        $('#accordion-ritual .accordion-content-inner').html(`
            <p>O ritual noturno ainda não foi registrado.</p>
            <div class="center-align" style="margin: 15px 0;">
                <a class="waves-effect waves-light btn purple modal-trigger" href="#modal-ritual-noturno">
                    <i class="material-icons left">add</i>Registrar Ritual Noturno
                </a>
            </div>
        `);
        
        M.toast({html: 'Ritual noturno excluído com sucesso!'});
        atualizarRegistroVisual();
    }
}

function excluirDespertar(index) {
    if (confirm('Tem certeza que deseja excluir este despertar?')) {
        historicoDespertares.splice(index, 1);
        
        // Reorganizar números dos despertares
        historicoDespertares.forEach((despertar, i) => {
            despertar.numero = i + 1;
        });
        
        M.toast({html: 'Despertar excluído com sucesso!'});
        salvarEstado();
        atualizarRegistroVisual();
    }
}

function verRecomendacoesDespertar(index) {
    const despertar = historicoDespertares[index];
    
    let recomendacoesHTML = `
        <div class="card-panel teal lighten-4">
            <h5>💡 Recomendações - ${despertar.numero}º Despertar</h5>
            <p><strong>Horário:</strong> ${despertar.horaAcordou} - ${despertar.horaDormiu} (${despertar.duracao} min)</p>
            <p><strong>Formas de voltar:</strong> ${despertar.formasVolta.join(', ')}</p>
        </div>
    `;
    
    // Lógica de recomendações específicas para despertares
    if (despertar.duracao <= 30) {
        recomendacoesHTML += `
            <div class="card-panel green lighten-4">
                <h6>✅ Despertar Rápido</h6>
                <ul>
                    <li>• O tempo para voltar a dormir está adequado</li>
                    <li>• Continue com as estratégias que estão funcionando</li>
                    <li>• Mantenha o ambiente consistente</li>
                </ul>
            </div>
        `;
    } else {
        recomendacoesHTML += `
            <div class="card-panel orange lighten-4">
                <h6>⚠️ Despertar Longo</h6>
                <ul>
                    <li>• O tempo acordado pode estar afetando o descanso</li>
                    <li>• Tente intervir mais rapidamente nos próximos despertares</li>
                    <li>• Verifique se há desconfortos (fralda, temperatura, etc.)</li>
                </ul>
            </div>
        `;
    }
    
    if (despertar.formasVolta.includes('Sozinho')) {
        recomendacoesHTML += `
            <div class="card-panel green lighten-4">
                <h6>🎉 Autonomia do Sono</h6>
                <p>Seu bebê voltou a dormir sozinho - excelente sinal de autonomia!</p>
            </div>
        `;
    } else {
        recomendacoesHTML += `
            <div class="card-panel blue lighten-4">
                <h6>🔧 Associações de Sono</h6>
                <p>Seu bebê precisa de ajuda para voltar a dormir. Considere:</p>
                <ul>
                    <li>• Gradualmente reduzir a intervenção</li>
                    <li>• Criar associações mais independentes</li>
                    <li>• Trabalhar a autonomia do sono durante o dia</li>
                </ul>
            </div>
        `;
    }
    
    $('#conteudo-recomendacoes').html(recomendacoesHTML);
    $('#modal-recomendacoes').modal('open');
}

function configurarAccordionsDespertares() {
    $('#registro-despertares .accordion .accordion-header').off('click').on('click', function () {
        const $accordion = $(this).closest('.accordion');
        const isOpen = $accordion.hasClass('open');
        $('#registro-despertares .accordion').removeClass('open');
        if (!isOpen) {
            $accordion.addClass('open');
        }
    });
}

    // Função para carregar recomendações do accordion
function carregarRecomendacoesAccordion(codigoAnalise, duracao, sonecaIndex = null) {
    let recomendacoesHTML = '';
  let soneca = null;
    let associacoes = null;
    if (sonecaIndex !== null && historicoSonecas[sonecaIndex]) {
        soneca = historicoSonecas[sonecaIndex];
        associacoes = soneca.associacoes;
    }
        // Cabeçalho com informações básicas
        recomendacoesHTML = `
        <div class="card-panel teal lighten-4">
            <h5>💡 Recomendações Completas</h5>
            <p><strong>Situação:</strong> ${codigoAnalise} | <strong>Duração:</strong> ${duracao} minutos</p>
        </div>
    `;

        // Recomendações baseadas no código da análise
        switch (codigoAnalise) {
            case '1.1':
                recomendacoesHTML += `
                <div class="card-panel green lighten-4">
                    <h6>✅ Situação Ideal</h6>
                    <ul>
                        <li>• Sinais de sono e soneca iniciando em bons intervalos! Parabéns!</li>
                        <li>• Continue observando os sinais de sono no mesmo horário</li>
                        <li>• Mantenha o ritual de sono consistente</li>
                        <li>• Registre os horários para identificar padrões</li>
                    </ul>
                </div>
            `;
                break;

            case '1.2':
                recomendacoesHTML += `
                <div class="card-panel orange lighten-4">
                    <h6>⚠️ Começou a Fazer Dormir Cedo Demais</h6>
                    <ul>
                        <li>• Começou a fazer dormir cedo demais, mas dormiu em tempo adequado</li>
                        <li>• Aguarde sinais mais claros de sono antes de iniciar o ritual</li>
                        <li>• Observe os horários sugeridos para sinais de sono</li>
                        <li>• Não antecipe demais o início do ritual</li>
                    </ul>
                    
                    <div class="video-recomendacao" style="margin-top: 15px; padding: 15px; background: #e3f2fd; border-radius: 8px;">
                        <h7>🎥 Vídeos Recomendados:</h7>
                        <div class="video-lista">
                            <p>📹 <a href="https://www.youtube.com/shorts/AJx1c19xag8" target="_blank" style="color: #1565c0; text-decoration: underline;">
                                <i class="material-icons tiny">play_circle_outline</i> Vídeo: Começou a dormir cedo demais
                            </a></p>
                           </p>
                        </div>
                    </div>
                </div>
            `;
                break;

            case '1.3':
                recomendacoesHTML += `
                <div class="card-panel orange lighten-4">
                    <h6>⚠️ Demorou para Fazer Dormir</h6>
                    <ul>
                        <li>• Percebeu sinais de sono em tempo adequado, mas demorou muito a fazer dormir</li>
                        <li>• Tente iniciar o ritual mais rapidamente após os primeiros sinais</li>
                        <li>• Prepare o ambiente com antecedência</li>
                        <li>• Tenha tudo pronto antes de perceber os sinais de sono</li>
                        <li>• Reduza estímulos visuais e sonoros quando perceber os primeiros sinais</li>
                    </ul>
                    
                    <div class="video-recomendacao" style="margin-top: 15px; padding: 15px; background: #e3f2fd; border-radius: 8px;">
                        <h7>🎥 Vídeos Recomendados:</h7>
                        <div class="video-lista">
                            <p>📹 <a href="https://www.youtube.com/watch?v=qBaLf8aDLg4" target="_blank" style="color: #1565c0; text-decoration: underline;">
                                <i class="material-icons tiny">play_circle_outline</i> Desacelerar
                            </a></p>
                            <p>📹 <a href="https://www.youtube.com/shorts/VAOuMO-9OZE" target="_blank" style="color: #1565c0; text-decoration: underline;">
                                <i class="material-icons tiny">play_circle_outline</i> Briga para dormir
                            </a></p>
                            <p>📹 <a href="https://www.youtube.com/watch?v=-FdKVp5mg4w" target="_blank" style="color: #1565c0; text-decoration: underline;">
                                <i class="material-icons tiny">play_circle_outline</i> Associações que podem ajudar </a></p>
                        </div>
                    </div>
                </div>
            `;
                break;

            case '1.4':
                recomendacoesHTML += `
                <div class="card-panel orange lighten-4">
                    <h6>⚠️ Demorou a Perceber Sinais de Sono</h6>
                    <ul>
                        <li>• Demorou a perceber sinais de sono, mas dormiu rápido, evitando a exaustão</li>
                        <li>• Fique mais atento aos sinais sutis de cansaço</li>
                        <li>• Observe o bebê mais cuidadosamente próximo ao horário esperado</li>
                        <li>• Conheça os sinais comuns de sono listados abaixo</li>
                        <li>• Estabeleça alertas ou lembretes para observar o bebê</li>
                    </ul>
                    
                    <!-- Lista de Sinais de Sono -->
                    <div class="sinais-sono" style="margin-top: 15px; padding: 15px; background: #fff3e0; border-radius: 8px;">
                        <h7>👀 Sinais de Sono Mais Comuns:</h7>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col s6 m4">
                                <i class="material-icons tiny">emoji_people</i> Bocejar
                            </div>
                            <div class="col s6 m4">
                                <i class="material-icons tiny">remove_red_eye</i> Olhar parado
                            </div>
                            <div class="col s6 m4">
                                <i class="material-icons tiny">touch_app</i> Esfregar olhos
                            </div>
                            <div class="col s6 m4">
                                <i class="material-icons tiny">gesture</i> Arranhar rosto
                            </div>
                            <div class="col s6 m4">
                                <i class="material-icons tiny">repeat</i> Virar o rosto
                            </div>
                            <div class="col s6 m4">
                                <i class="material-icons tiny">child_care</i> Esconder no peito
                            </div>
                        </div>
                    </div>
                    
                </div>
            `;
                break;

            case '1.5':
                recomendacoesHTML += `
                <div class="card-panel red lighten-4">
                    <h6>❌ Exaustão - Demorou a Perceber e Dormiu Exausto</h6>
                    <ul>
                        <li>• Demorou a perceber sinais de sono e dormiu exausto</li>
                        <li>• É crucial observar melhor os horários de sono</li>
                        <li>• Inicie o ritual mais cedo na próxima vez</li>
                        <li>• Estabeleça uma rotina mais consistente</li>
                        <li>• Use timer ou alarme para lembrar dos horários de sono</li>
                        <li>• Observe atentamente 15-20 minutos antes do horário esperado</li>
                    </ul>
                    
                    <!-- Lista de Sinais de Sono -->
                    <div class="sinais-sono" style="margin-top: 15px; padding: 15px; background: #ffebee; border-radius: 8px;">
                        <h7>🚨 Sinais de Exaustão (evitar):</h7>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col s12">
                                <i class="material-icons tiny">warning</i> Choro inconsolável
                            </div>
                            <div class="col s12">
                                <i class="material-icons tiny">warning</i> Agitação excessiva
                            </div>
                            <div class="col s12">
                                <i class="material-icons tiny">warning</i> Dificuldade para acalmar
                            </div>
                            <div class="col s12">
                                <i class="material-icons tiny">warning</i> Arquear as costas
                            </div>
                        </div>
                    </div>
                    
                    <div class="video-recomendacao" style="margin-top: 15px; padding: 15px; background: #e3f2fd; border-radius: 8px;">
                        <h7>🎥 Vídeos Recomendados:</h7>
                        <div class="video-lista">
                            <p>📹 <a href="https://www.youtube.com/watch?v=qBaLf8aDLg4" target="_blank" style="color: #1565c0; text-decoration: underline;">
                                <i class="material-icons tiny">play_circle_outline</i> Desacelerar
                            </a></p>
                            
                           <p>📹 <a href="https://www.youtube.com/shorts/VAOuMO-9OZE" target="_blank" style="color: #1565c0; text-decoration: underline;">
                                <i class="material-icons tiny">play_circle_outline</i> Briga para dormir
                            </a></p>
                        </div>
                    </div>
                </div>
            `;
                break;

            default:
                recomendacoesHTML += `<p>Análise em andamento para código: ${codigoAnalise}</p>`;
        }

        // Recomendações baseadas na duração
        if (duracao < 35) {
            recomendacoesHTML += `
            <div class="card-panel blue lighten-4" style="margin-top: 20px;">
                <h6>💡 Estratégias para Sonecas Curtas (${duracao} min)</h6>
                <ul>
                    <li>• Tente prolongar a soneca com conforto adicional (naninha, ruído branco)</li>
                    <li>• Verifique se o ambiente está adequado (escuro, temperatura agradável)</li>
                    <li>• Considere ajustar o horário da próxima soneca</li>
                    <li>• Observe se há desconforto (fralda, calor, frio)</li>
                    <li>• Tente "salvar a soneca" com intervenção suave ao final</li>
                </ul>
                
                <div class="video-recomendacao" style="margin-top: 15px; padding: 15px; background: #e3f2fd; border-radius: 8px;">
                    <h7>🎥 Vídeos para Sonecas Curtas:</h7>
                    <div class="video-lista">
                        <p>📹 <a href="https://www.youtube.com/watch?v=AaKqnJ1j_SM" target="_blank" style="color: #1565c0; text-decoration: underline;">
                            <i class="material-icons tiny">play_circle_outline</i> Como Prolongar Sonecas Curtas
                        </a></p>
                       
                    </div>
                </div>
            </div>
        `;
        } else {
            recomendacoesHTML += `
            <div class="card-panel green lighten-4" style="margin-top: 20px;">
                <h6>✅ Duração Adequada (${duracao} min) - Mantenha o Bom Trabalho!</h6>
                <ul>
                    <li>• Soneca com boa duração para restauração energética</li>
                    <li>• Mantenha os mesmos horários e rotina que funcionaram</li>
                    <li>• Continue registrando para identificar padrões de sucesso</li>
                    <li>• Observe se este horário e duração se repetem consistentemente</li>
                </ul>
            </div>
        `;
        }

            if (associacoes && associacoes.comoAdormeceu && associacoes.comoAdormeceu.length > 0) {
        recomendacoesHTML += gerarRecomendacoesAssociacoes(associacoes);
    }

    function gerarRecomendacoesAssociacoes(associacoes) {
    let recomendacoesHTML = '';
    
    recomendacoesHTML += `
        <div class="card-panel purple lighten-4" style="margin-top: 20px;">
            <h6>🌙 Sobre as Associações de Sono</h6>
            <div class="associacoes-info">
                <p><strong>É importante deixar claro que adormecer com associações NÃO ATRAPALHARÁ o sono do seu bebê e nem causará despertares.</strong> Na verdade, pode até ajudar, já que te ajudará a conseguir que o bebê durma e a evitar que ele fique exausto.</p>
                <p>Mas precisa estar bom para você também, claro. Por isso, se quiser começar a desassociar, siga essa técnica explicada nas aulas e ao fim do desafio, eu já analisarei esse ajuste também.</p>
            </div>
        </div>
    `;
    
    // Aulas recomendadas baseadas nas associações
    const aulasRecomendadas = [];
    
    // Verificar associações relacionadas a mamar
    if (associacoes.comoAdormeceu.some(a => a.includes('Mamando')) || 
        (associacoes.depoisAdormecer && associacoes.depoisAdormecer.some(d => d.includes('Sucção não nutritiva')))) {
        aulasRecomendadas.push({
            titulo: "Associação de mamar nas sonecas",
            descricao: "",
            video: "videos/associacao_mamar_soneca.mp4"
        });
    }
    
    // Verificar associações relacionadas a colo/movimento
    if (associacoes.comoAdormeceu.some(a => a.includes('Ninando') || a.includes('Carrinho') || a.includes('Rede')) ||
        (associacoes.depoisAdormecer && associacoes.depoisAdormecer.some(d => d.includes('colo') || d.includes('Carrinho') || d.includes('Rede')))) {
        aulasRecomendadas.push({
            titulo: "Associação de colo nas sonecas (Protocolo Bebê no berço)",
            descricao: "",
            video: "videos/assciacao_colo.mp4"
        
        });
    }
    
    // Verificar associações com chupeta
    if (associacoes.comoAdormeceu.some(a => a.includes('Chupeta'))) {
        aulasRecomendadas.push({
            titulo: "Associação de Chupeta",
            descricao: "",
             video: "videos/assciacao_colo.mp4"
        });
    }
    
    // Aulas gerais para todos
    aulasRecomendadas.push({
        titulo: "A autonomia do sono",
        descricao: "",
        video: "videos/"

    });
    
    aulasRecomendadas.push({
        titulo: "Autonomia nas sonecas", 
        descricao: "",
        video: "videos/"
    });
    
    if (aulasRecomendadas.length > 0) {
        recomendacoesHTML += `
            <div class="card-panel blue lighten-4" style="margin-top: 15px;">
                <h6>🎥 Aulas Recomendadas</h6>
                <p>Baseado nas suas associações registradas, recomendamos estas aulas:</p>
                <div class="aulas-lista" style="margin-top: 10px;">
        `;
        
        aulasRecomendadas.forEach((aula, index) => {
            recomendacoesHTML += `
                    <div class="aula-item" style="padding: 10px; margin: 8px 0; background: rgba(255,255,255,0.7); border-radius: 4px; border-left: 3px solid #2196F3;">
    <strong>${index + 1}. ${aula.titulo}</strong>
    <br><small class="grey-text">${aula.descricao}</small>
    <br>
    <button onclick="toggleVideo(this)" 
            style="margin-top: 8px; padding: 6px 12px; background: #2196F3; color: white; border: none; border-radius: 3px; cursor: pointer;">
        ▶ Mostrar Vídeo
    </button>
    <div class="video-container" style="display: none; margin-top: 10px;">
        <video width="100%" controls>
            <source src="{{ asset('storage') }}/${aula.video}" type="video/mp4">
            Seu navegador não suporta vídeos.
        </video>
    </div>
</div>
            `;
        });
        
        recomendacoesHTML += `
                </div>
                <div style="margin-top: 15px; padding: 10px; background: #e3f2fd; border-radius: 4px;">
                    <p><strong>💡 Dica:</strong> Assista as aulas na ordem recomendada para melhor aproveitamento!</p>
                </div>
            </div>
        `;
    }
    
    // Seção sobre se incomoda
    if (associacoes.incomoda) {
        recomendacoesHTML += `
            <div class="card-panel ${associacoes.incomoda === 'Sim' ? 'orange' : 'green'} lighten-4" style="margin-top: 15px;">
                <h6>${associacoes.incomoda === 'Sim' ? '🤔 Essa associação te incomoda' : '✅ Tudo bem com as associações'}</h6>
                <p>
                    ${associacoes.incomoda === 'Sim' ? 
                        'Como você mencionou que essa associação te incomoda, recomendamos focar nas aulas específicas sobre desassociação. Lembre-se: o importante é encontrar um equilíbrio que funcione para você e seu bebê.' : 
                        'Que bom que as associações atuais estão funcionando bem para você! Continue observando e faça ajustes apenas se sentir necessidade.'}
                </p>
            </div>
        `;
    }
      return recomendacoesHTML;
}   
        // Recomendações gerais para todas as situações
      /*  recomendacoesHTML += `
        <div class="card-panel purple lighten-4" style="margin-top: 20px;">
            <h6>📚 Materiais de Apoio Gerais</h6>
            <div class="video-lista">
                <p>📹 <a href="https://youtu.be/qBaLf8aDLg4" target="_blank" style="color: #1565c0; text-decoration: underline;">
                    <i class="material-icons tiny">play_circle_outline</i> Guia Completo de Sinais de Sono
                </a></p>
                <p>📹 <a href="https://youtu.be/-FdKVp5mg4w" target="_blank" style="color: #1565c0; text-decoration: underline;">
                    <i class="material-icons tiny">play_circle_outline</i> Associações de Sono Saudáveis
                </a></p>
                <p>📹 <a href="https://youtube.com/shorts/VAOuMO-9OZE?feature=share" target="_blank" style="color: #1565c0; text-decoration: underline;">
                    <i class="material-icons tiny">play_circle_outline</i> Dicas Rápidas para Rotina de Sono
                </a></p>
            </div>
        </div>
    `;
*/
        $('#conteudo-recomendacoes').html(recomendacoesHTML);
    }
// Função para carregar respostas do accordion
function carregarRespostasAccordion(indexSoneca) {
    let respostasHTML = '';
    const soneca = historicoSonecas[indexSoneca];
    
    if (!soneca.respostas || Object.keys(soneca.respostas).length === 0) {
        respostasHTML = `
            <div class="card-panel grey lighten-4">
                <h5>📋 Questionário - Soneca ${soneca.numero}</h5>
                <p>Nenhuma resposta de questionário registrada para esta soneca.</p>
                <p><strong>Horário:</strong> ${soneca.inicio} - ${soneca.termino}</p>
                <p><strong>Duração:</strong> ${soneca.duracao} minutos</p>
                <p><strong>Situação:</strong> ${soneca.situacao}</p>
            </div>
        `;
    } else {
        respostasHTML = `
            <div class="card-panel teal lighten-4">
                <h5>📋 Questionário - Soneca ${soneca.numero}</h5>
                <p><strong>Total de perguntas:</strong> ${Object.keys(soneca.respostas).length}</p>
                <p><strong>Horário:</strong> ${soneca.inicio} - ${soneca.termino}</p>
                <p><strong>Duração:</strong> ${soneca.duracao} minutos | <strong>Situação:</strong> ${soneca.situacao}</p>
            </div>
        `;
        
        Object.keys(soneca.respostas).forEach(pergunta => {
            const resposta = soneca.respostas[pergunta];
            respostasHTML += `
                <div class="resposta-item card-panel" style="padding: 15px; margin: 10px 0;">
                    <div class="resposta-header">
                        <strong>${pergunta}</strong>
                        <span class="badge ${resposta.resposta === 'Sim' ? 'green' : resposta.resposta === 'Não' ? 'red' : 'blue'} white-text">
                            ${resposta.resposta}
                        </span>
                    </div>
                    ${resposta.detalhes ? `<p class="detalhes-resposta" style="margin: 5px 0; padding-left: 10px; border-left: 3px solid #26a69a;">${resposta.detalhes}</p>` : ''}
                    <div class="resposta-timestamp grey-text" style="font-size: 0.8em;">
                        <i class="material-icons tiny">access_time</i> ${resposta.timestamp}
                    </div>
                </div>
            `;
        });
    }
    
    $('#conteudo-respostas').html(respostasHTML);
}
    // Função para gerar recomendações baseadas na soneca
    function gerarRecomendacaoSoneca(soneca) {
        let recomendacoes = [];

        if (soneca.duracao < 35) {
            recomendacoes.push('• ⏱️ <strong>Soneca curta:</strong> Tente prolongar a próxima soneca');
           
        } else {
            recomendacoes.push('• ✅ <strong>Duração adequada:</strong> Mantenha o bom trabalho!');
        }

        if (soneca.situacao === '1.3' || soneca.situacao === '1.5') {
            recomendacoes.push('• ⚠️ <strong>Janela extendida:</strong> Observar sinais de sono mais atentamente');
        }
        if (soneca.situacao === '1.4') {
            recomendacoes.push('• ⚠️ <strong>Sinais de Sono:</strong> Observar sinais de sono mais atentamente');
        }

        if (soneca.situacao === '1.2') {
            recomendacoes.push('• 👀 <strong>Sinais de sono:</strong> Aguardar sinais claros antes de iniciar o ritual');
        }

        return recomendacoes.join('<br>');
    }

    // Função para gerar resumo das respostas do questionário
    function gerarRespostasQuestionario(soneca) {
           if (!soneca.respostas || Object.keys(soneca.respostas).length === 0) {
            console.log('Respostas vazias:', soneca);
            return '<p class="grey-text">Nenhuma resposta de questionário registrada</p>';
        }

            let respostasHTML = ``;

            return respostasHTML;
        }

function abrirModalDespertar() {
    // Preencher com horário atual
    const agora = new Date();
    const horas = agora.getHours().toString().padStart(2, '0');
    const minutos = agora.getMinutes().toString().padStart(2, '0');
    const horaAtual = `${horas}:${minutos}`;
    
    $('#hora-acordou-despertar').val(horaAtual);
    $('#hora-dormiu-despertar').val(horaAtual);
    
    // Limpar checkboxes
    $('.opcoes-volta-sono input[type="checkbox"]').prop('checked', false);
    $('#outra-detalhe-despertar').val('').addClass('hidden');
    
    // Atualizar título com o próximo número
    const proximoNumero = historicoDespertares.length + 1;
    $('#titulo-despertar').text(`Registrar ${proximoNumero}º Despertar`);
    
    $('#modal-despertar').modal('open');
}

// Função para salvar despertar
function salvarDespertar() {
    const horaAcordou = $('#hora-acordou-despertar').val();
    const horaDormiu = $('#hora-dormiu-despertar').val();
    
    if (!horaAcordou || !horaDormiu) {
        M.toast({html: 'Por favor, preencha os horários do despertar'});
        return;
    }
    
    // Coletar formas de voltar a dormir
    const formasVolta = [];
    
    if ($('#sozinho-despertar').is(':checked')) formasVolta.push('Sozinho');
    if ($('#mamando-despertar').is(':checked')) formasVolta.push('Mamando');
    if ($('#cama-compartilhada-despertar').is(':checked')) formasVolta.push('Cama compartilhada');
    if ($('#ninando-despertar').is(':checked')) formasVolta.push('Ninando');
    if ($('#chupeta-despertar').is(':checked')) formasVolta.push('Chupeta');
    if ($('#rede-despertar').is(':checked')) formasVolta.push('Rede');
    if ($('#outra-despertar').is(':checked')) {
        const outraDetalhe = $('#outra-detalhe-despertar').val();
        formasVolta.push(`Outra: ${outraDetalhe || 'Não especificado'}`);
    }
    
    if (formasVolta.length === 0) {
        M.toast({html: 'Selecione pelo menos uma forma como o bebê voltou a dormir'});
        return;
    }
    
    // Calcular duração
    const duracao = calcularDuracao(horaAcordou, horaDormiu);
    
    // CORREÇÃO: Usar o número correto do despertar
    const numeroDespertar = historicoDespertares.length + 1;
    
    // Salvar no histórico
    historicoDespertares.push({
        numero: numeroDespertar,
        horaAcordou,
        horaDormiu,
        duracao,
        formasVolta,
        timestamp: new Date().toLocaleTimeString('pt-BR')
    });
    
    console.log('Despertar salvo:', historicoDespertares); // Debug
    
    // Fechar modal
    $('#modal-despertar').modal('close');
    
    // Limpar formulário
    $('#hora-acordou-despertar').val('');
    $('#hora-dormiu-despertar').val('');
    $('.opcoes-volta-sono input[type="checkbox"]').prop('checked', false);
    $('#outra-detalhe-despertar').val('').addClass('hidden');
    
    M.toast({html: `Despertar ${numeroDespertar} salvo com sucesso!`});
    
    // Salvar estado e atualizar visual
    salvarEstado();
    atualizarRegistroVisual();
}

function atualizarRegistroDespertares() {
    $('#registro-despertares').empty();
    
    // MOSTRAR APENAS DESPERTARES EXISTENTES
    historicoDespertares.forEach((despertar, index) => {
        const formasTexto = despertar.formasVolta.join(', ');
        const statusClasse = despertar.duracao <= 30 ? 'adequado' : 'atencao';
        const statusTexto = despertar.duracao <= 30 ? 'Rápido' : 'Demorado';
        const statusLabel = despertar.duracao <= 30 ? 'status-adequado' : 'status-atencao';
        
        $('#registro-despertares').append(`
            <div class="accordion ${statusClasse}" id="accordion-despertar-${despertar.numero}">
                <div class="accordion-header">
                    <div style="display: flex; align-items: center; flex-grow: 1;">
                       🌙
                        <div class="rotina-info" style="margin-left: 15px;">
                            <strong>${despertar.numero}º despertar:</strong>
                            <span class="rotina-detalhe">${despertar.horaAcordou} - ${despertar.horaDormiu} (${despertar.duracao} min)</span>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <span class="rotina-status ${statusLabel}">${statusTexto}</span>
                        <i class="material-icons accordion-icon" style="margin-left: 10px;">expand_more</i>
                    </div>
                </div>
                <div class="accordion-content">
                    <div class="accordion-content-inner">
                        <div class="detalhes-despertar">
                            <div class="detalhe-item">
                                <strong>🕒 Acordou</strong>
                                ${despertar.horaAcordou}
                            </div>
                            <div class="detalhe-item">
                                <strong>😴 Voltou a dormir</strong>
                                ${despertar.horaDormiu}
                            </div>
                            <div class="detalhe-item">
                                <strong>⏱️ Tempo acordado</strong>
                                ${despertar.duracao} minutos
                            </div>
                            <div class="detalhe-item">
                                <strong>🔄 Como voltou</strong>
                                ${formasTexto}
                            </div>
                            <div class="detalhe-item">
                                <strong>🎯 Status</strong>
                                ${statusTexto}
                            </div>
                        </div>
                        
                        <!-- Botões para ver detalhes -->
                        <div class="row center-align" style="margin: 20px 0;">
                            <div class="col s12 m6">
                                <a class="waves-effect waves-light btn blue" onclick="verRecomendacoesDespertar(${index})">
                                    <i class="material-icons left">lightbulb_outline</i>Recomendações
                                </a>
                            </div>
                        </div>
                        
                        <div class="recomendacao">
                            <h6><i class="material-icons tiny">lightbulb_outline</i> Recomendações</h6>
                            ${gerarRecomendacaoDespertar(despertar)}
                        </div>
                    </div>
                </div>
            </div>
        `);
    });
    
    // ADICIONAR APENAS UM ACCORDION VAZIO PARA O PRÓXIMO DESPERTAR
    // O número do próximo despertar é sempre históricoDespertares.length + 1
    const proximoDespertarNumero = historicoDespertares.length + 1;
    
    if (historicoDespertares.length < 10) { // limite de 10 despertares por noite
        $('#registro-despertares').append(`
            <div class="accordion vazio" id="accordion-despertar-${proximoDespertarNumero}">
                <div class="accordion-header">
                    <div style="display: flex; align-items: center; flex-grow: 1;">
                        🌙
                        <div class="rotina-info" style="margin-left: 15px;">
                            <strong>${proximoDespertarNumero}º despertar:</strong>
                            <span class="rotina-detalhe">Não registrado</span>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <span class="rotina-status status-vazio">Pendente</span>
                        <i class="material-icons accordion-icon" style="margin-left: 10px;">expand_more</i>
                    </div>
                </div>
                <div class="accordion-content">
                    <div class="accordion-content-inner">
                        <p>Este despertar ainda não foi registrado.</p>
                        <div class="center-align" style="margin: 15px 0;">
                            <a class="waves-effect waves-light btn purple modal-trigger" href="#modal-despertar" onclick="abrirModalDespertar()">
                                <i class="material-icons left">add</i>Registrar Despertar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        `);
    } else {
        // Se atingiu o limite, mostrar mensagem
        $('#registro-despertares').append(`
            <div class="card-panel green lighten-4">
                <p>✅ Todos os despertares registrados para esta noite.</p>
                <p><small>Máximo de 10 despertares por noite atingido.</small></p>
            </div>
        `);
    }
    
    // CONFIGURAR EVENTOS DOS ACCORDIONS DOS DESPERTARES
    configurarAccordionsDespertares();
}

    // Função para configurar os eventos dos accordions dos despertares
    function configurarAccordionsDespertares() {
        // Configurar eventos de clique para os accordions dos despertares
        $('#registro-despertares .accordion .accordion-header').off('click').on('click', function () {
            const $accordion = $(this).closest('.accordion');
            const isOpen = $accordion.hasClass('open');

            // Fechar todos os accordions dos despertares
            $('#registro-despertares .accordion').removeClass('open');

            // Abrir este accordion se não estava aberto
            if (!isOpen) {
                $accordion.addClass('open');
            }
        });
    }

// Função para gerar recomendações do despertar
function gerarRecomendacaoDespertar(despertar) {
    let recomendacoes = [];
    
    if (despertar.duracao <= 30) {
        recomendacoes.push('• ⏱️ <strong>Despertar rápido:</strong> Bom tempo para voltar a dormir');
    } else {
        recomendacoes.push('• ⏱️ <strong>Despertar longo:</strong> Tente reduzir o tempo acordado');
    }
    
    if (despertar.formasVolta.includes('Sozinho')) {
        recomendacoes.push('• ✅ <strong>Voltou sozinho:</strong> Excelente autonomia do sono');
    } else {
        if (despertar.formasVolta.includes('Mamando')) {
            recomendacoes.push('• 🍼 <strong>Associação com mamada:</strong> Pode criar dependência noturna');
        }
        if (despertar.formasVolta.includes('Ninando')) {
            recomendacoes.push('• 🤱 <strong>Associação com ninar:</strong> Considere reduzir gradualmente');
        }
        if (despertar.formasVolta.includes('Chupeta')) {
            recomendacoes.push('• 🎯 <strong>Chupeta:</strong> Pode precisar de ajuda para recolocar');
        }
    }
    
    if (despertar.formasVolta.length > 2) {
        recomendacoes.push('• 🔄 <strong>Múltiplas associações:</strong> Tente simplificar o ritual de volta ao sono');
    }
    
    return recomendacoes.join('<br>');
}

// Função para ver recomendações detalhadas
function verRecomendacoesDespertar(index) {
    const despertar = historicoDespertares[index];
    let recomendacoesHTML = `
        <div class="card-panel teal lighten-4">
            <h5>💡 Recomendações - ${despertar.numero}º Despertar</h5>
            <p><strong>Horário:</strong> ${despertar.horaAcordou} - ${despertar.horaDormiu} (${despertar.duracao} min)</p>
            <p><strong>Formas de voltar:</strong> ${despertar.formasVolta.join(', ')}</p>
        </div>
    `;
    
    if (despertar.duracao <= 30) {
        recomendacoesHTML += `
            <div class="card-panel green lighten-4">
                <h6>✅ Despertar Rápido</h6>
                <ul>
                    <li>• O tempo para voltar a dormir está adequado</li>
                    <li>• Continue com as estratégias que estão funcionando</li>
                    <li>• Mantenha o ambiente consistente</li>
                </ul>
            </div>
        `;
    } else {
        recomendacoesHTML += `
            <div class="card-panel orange lighten-4">
                <h6>⚠️ Despertar Longo</h6>
                <ul>
                    <li>• O tempo acordado pode estar afetando o descanso</li>
                    <li>• Tente intervir mais rapidamente nos próximos despertares</li>
                    <li>• Verifique se há desconfortos (fralda, temperatura, etc.)</li>
                </ul>
            </div>
        `;
    }
    
    if (despertar.formasVolta.includes('Sozinho')) {
        recomendacoesHTML += `
            <div class="card-panel green lighten-4">
                <h6>🎉 Autonomia do Sono</h6>
                <ul>
                    <li>• Excelente que o bebê voltou a dormir sozinho!</li>
                    <li>• Isso indica boa capacidade de autoacalmamento</li>
                    <li>• Continue incentivando essa independência</li>
                </ul>
            </div>
        `;
    } else {
        recomendacoesHTML += `
            <div class="card-panel blue lighten-4">
                <h6>🔄 Associações de Sono</h6>
                <ul>
                    ${despertar.formasVolta.includes('Mamando') ? '<li>• Mamada noturna: Considere reduzir gradualmente se for muito frequente</li>' : ''}
                    ${despertar.formasVolta.includes('Ninando') ? '<li>• Ninar: Tente colocar no berço mais acordado</li>' : ''}
                    ${despertar.formasVolta.includes('Chupeta') ? '<li>• Chupeta: Ensine o bebê a recolocar sozinho</li>' : ''}
                    ${despertar.formasVolta.includes('Cama compartilhada') ? '<li>• Cama compartilhada: Estabeleça limites claros se necessário</li>' : ''}
                    <li>• Tente reduzir uma associação por vez</li>
                </ul>
            </div>
        `;
    }
    
    $('#conteudo-recomendacoes').html(recomendacoesHTML);
    $('#modal-recomendacoes').modal('open');
}
    // Inicializar accordions quando o documento estiver pronto
    $(document).ready(function () {
        // Fechar accordion quando clicar fora
        $(document).on('click', function (e) {
            if (!$(e.target).closest('.accordion').length) {
                $('.accordion').removeClass('open');
            }
        });
         $('#outra-despertar').on('change', function() {
        if (this.checked) {
            $('#outra-detalhe-despertar').removeClass('hidden');
        } else {
            $('#outra-detalhe-despertar').addClass('hidden').val('');
        }
        });

          $('#adormeceu-outro, #outro-soneca').on('change', function() {
        const targetId = this.id === 'adormeceu-outro' ? 'adormeceu-outro-detalhe' : 'outro-soneca-detalhe';
        if (this.checked) {
            $(`#${targetId}`).removeClass('hidden');
        } else {
            $(`#${targetId}`).addClass('hidden').val('');
        }
    });

    // Mostrar/ocultar sub-opções
    $('#sucao-nao-nutritiva').on('change', function() {
        if (this.checked) {
            $('#sub-sucao').slideDown();
        } else {
            $('#sub-sucao').slideUp().find('input[type="radio"]').prop('checked', false);
        }
        verificarSeMostrarIncomoda();
    });

    $('#colo-soneca').on('change', function() {
        if (this.checked) {
            $('#sub-colo').slideDown();
        } else {
            $('#sub-colo').slideUp().find('input[type="radio"]').prop('checked', false);
        }
        verificarSeMostrarIncomoda();
    });

    // Verificar se deve mostrar "incomoda"
    $('.opcoes-adormecer input, .opcoes-depois-adormecer input').on('change', function() {
        verificarSeMostrarIncomoda();
    });

      function verificarSeMostrarIncomoda() {
    const temAssociacao = $('.opcoes-adormecer input:checked').length > 0 || 
                         $('.opcoes-depois-adormecer input:checked').length > 0;
    
    if (temAssociacao) {
        $('#card-incomoda').slideDown();
    } else {
        $('#card-incomoda').slideUp().find('input[type="radio"]').prop('checked', false);
    }
      }
    });

   function atualizarConteudoAccordion(soneca) {
    const recomendacao = gerarRecomendacaoSoneca(soneca);
    const respostasHTML = gerarRespostasQuestionario(soneca);
    const associacoesHTML = soneca.associacoes ? gerarHTMLAssociacoes(soneca.associacoes) : '';
    
    return `
        <div class="detalhes-soneca">
            <div class="detalhe-item">
                <strong>😴 Sentiu sono</strong>
                ${soneca.sentiuSono || 'Não registrado'}
            </div>
            <div class="detalhe-item">
                <strong>🛌 Início da soneca</strong>
                ${soneca.inicio}
            </div>
            <div class="detalhe-item">
                <strong>⏰ Término</strong>
                ${soneca.termino}
            </div>
            <div class="detalhe-item">
                <strong>⏱️ Duração</strong>
                ${soneca.duracao} minutos
            </div>
            <div class="detalhe-item">
                <strong>📊 Situação</strong>
                ${soneca.situacao}
            </div>
            <div class="detalhe-item">
                <strong>🎯 Status</strong>
                ${soneca.duracao >= 35 ? 'Adequada' : 'Atenção'}
            </div>
        </div>
        
        ${associacoesHTML}
        
        <div class="recomendacao">
            <h6><i class="material-icons tiny">lightbulb_outline</i> Recomendações</h6>
            ${recomendacao}
        </div>
        
        ${respostasHTML}
    `;
}
    function excluirInicioDia() {
        if (confirm('Tem certeza que deseja excluir o início do dia? Isso reiniciará toda a rotina.')) {
            // Limpar todos os dados
            inicioDia = '';
            sonecasRealizadas = 0;
            historicoSonecas = [];
            ultimoHorarioAcordou = '';
            sonecaAtual = 1;
            rotinaIniciada = false;
            respostasQuestionarioAtual = {};
            ritualNoturnoRegistrado = false;

            // Limpar localStorage
            localStorage.removeItem('rotinaSono');

            // Resetar interface
            $('#btn-iniciar-rotina').html('<i class="material-icons left">access_time</i>Iniciar Rotina');
            $('#container-botoes-acao').addClass('hidden');

            // FORÇAR ATUALIZAÇÃO VISUAL
            forcarAtualizacaoCompleta();

            M.toast({ html: 'Início do dia excluído. Rotina reiniciada.' });
        }
    }

    // Função para excluir soneca específica (ATUALIZADA)
    function excluirSoneca(index) {
        if (index >= 0 && index < historicoSonecas.length) {
            if (confirm(`Tem certeza que deseja excluir a ${index + 1}ª soneca?`)) {
                // 1. Remover a soneca
                historicoSonecas.splice(index, 1);

                // 2. Atualizar variáveis
                if (historicoSonecas.length > 0) {
                    ultimoHorarioAcordou = historicoSonecas[historicoSonecas.length - 1].termino;
                } else {
                    ultimoHorarioAcordou = inicioDia || '';
                }
                sonecaAtual = historicoSonecas.length + 1;

                // 3. SALVAR ESTADO
                salvarEstado();

                // 4. FORÇAR ATUALIZAÇÃO VISUAL
                forcarAtualizacaoSonecas();

                M.toast({ html: `Soneca excluída com sucesso` });
            }
        }
    }

    // Função para excluir ritual noturno (ATUALIZADA)
    function excluirRitualNoturno() {
        if (confirm('Tem certeza que deseja excluir o ritual noturno?')) {
            // Limpar variável do ritual
            ritualNoturnoRegistrado = false;

            // SALVAR ESTADO
            salvarEstado();

            // FORÇAR ATUALIZAÇÃO VISUAL
            forcarAtualizacaoRitual();

            M.toast({ html: 'Ritual noturno excluído com sucesso' });
        }
    }

    // Função para excluir último despertar (ATUALIZADA)
    function excluirUltimaSoneca() {
        if (historicoSonecas.length === 0) {
            M.toast({ html: 'Não há sonecas para excluir' });
            return;
        }

        if (confirm('Tem certeza que deseja excluir a última soneca?')) {
            // Remover a última soneca
            historicoSonecas.pop();

            // Atualizar variáveis
            if (historicoSonecas.length > 0) {
                ultimoHorarioAcordou = historicoSonecas[historicoSonecas.length - 1].termino;
            } else {
                ultimoHorarioAcordou = inicioDia || '';
            }
            sonecaAtual = historicoSonecas.length + 1;

            // SALVAR ESTADO
            salvarEstado();

            // FORÇAR ATUALIZAÇÃO VISUAL
            forcarAtualizacaoSonecas();

            M.toast({ html: 'Última soneca excluída com sucesso' });
        }
    }

    function forcarAtualizacaoCompleta() {
            console.log('FORÇANDO ATUALIZAÇÃO COMPLETA');

            // Limpar tudo
            $('#registro-sonecas').empty();

            // Recriar tudo baseado no estado atual
            atualizarRegistroVisual();
            atualizarProgresso(0);

            // Resetar botões
            $('#btn-iniciar-rotina').html('<i class="material-icons left">access_time</i>Iniciar Rotina');
            $('#container-botoes-acao').addClass('hidden');

            // Forçar redesenho
            setTimeout(() => {
                $('.accordion').removeClass('open');
            }, 50);
        }

        // Função para forçar atualização das sonecas
        function forcarAtualizacaoSonecas() {
            console.log('FORÇANDO ATUALIZAÇÃO SONECAS');

            // Limpar sonecas
            $('#registro-sonecas').empty();

            // Recriar sonecas baseado no estado atual
            atualizarRegistroVisual();
            atualizarProgresso(25 + (historicoSonecas.length * 15));

            // Atualizar botões de ação se necessário
            if (historicoSonecas.length === 0 && inicioDia) {
                $('#container-botoes-acao').removeClass('hidden');
            }

            // Forçar redesenho
            setTimeout(() => {
                $('.accordion').removeClass('open');
            }, 50);
        }

        // Função para forçar atualização do ritual noturno
        function forcarAtualizacaoRitual() {
            console.log('FORÇANDO ATUALIZAÇÃO RITUAL');

            // Atualizar accordion do ritual
            const $accordion = $('#accordion-ritual');
            $accordion.removeClass('adequado atencao').addClass('vazio')
                .find('.rotina-detalhe').text('Não registrado');
            $accordion.find('.rotina-status')
                .removeClass('status-adequado status-atencao')
                .addClass('status-vazio')
                .text('Pendente');

            // Atualizar conteúdo do accordion
            $accordion.find('.accordion-content-inner').html(`
        <p>O ritual noturno será registrado ao final do dia.</p>
    `);

            // Atualizar progresso
            if (historicoSonecas.length > 0) {
                atualizarProgresso(25 + (historicoSonecas.length * 15));
            } else if (inicioDia) {
                atualizarProgresso(25);
            } else {
                atualizarProgresso(0);
            }

            // Forçar redesenho
            setTimeout(() => {
                $accordion.removeClass('open');
            }, 50);
        }

        // Função para forçar atualização do início do dia
        function forcarAtualizacaoInicioDia() {
            console.log('FORÇANDO ATUALIZAÇÃO INÍCIO DIA');

            // Atualizar accordion do início do dia
            const $accordion = $('#accordion-inicio-dia');
            $accordion.removeClass('adequado atencao').addClass('vazio')
                .find('.rotina-detalhe').text('Não registrado');
            $accordion.find('.rotina-status')
                .removeClass('status-adequado status-atencao')
                .addClass('status-vazio')
                .text('Pendente');

            // Atualizar conteúdo do accordion
            $accordion.find('.accordion-content-inner').html(`
        <p>Clique em "Iniciar Rotina" para começar o registro do dia.</p>
    `);

            // Atualizar progresso
            atualizarProgresso(0);

            // Resetar botões
            $('#btn-iniciar-rotina').html('<i class="material-icons left">access_time</i>Iniciar Rotina');
            $('#container-botoes-acao').addClass('hidden');

            // Forçar redesenho
            setTimeout(() => {
                $accordion.removeClass('open');
            }, 50);
        }

        function abrirModalObservacoes() {
                // Limpar observações anteriores
                $('#observacoes-dia').val('');
                $('#contador-observacoes').text('0');
                
                // Abrir modal
              
                $('#modal-observacoes-dia').modal('open');
            }

            function configurarContadorObservacoes() {
                    $('#observacoes-dia').on('input', function () {
                        const texto = $(this).val();
                        const caracteres = texto.length;
                        $('#contador-observacoes').text(caracteres);

                        // Mudar cor se estiver perto do limite
                        if (caracteres > 180) {
                            $('#contador-observacoes').addClass('red-text');
                        } else {
                            $('#contador-observacoes').removeClass('red-text');
                        }
                    });
                }
function confirmarFinalizarDia() {
    const observacoes = $('#observacoes-dia').val().trim();
    
    // Verificar se tem ritual noturno
    const ritualSalvo = localStorage.getItem('ritualNoturno');
    if (!ritualSalvo) {
        M.toast({html: 'Complete o ritual noturno primeiro'});
        return;
    }
    
    

    // Fechar modal
    $('#modal-observacoes-dia').modal('close');
    
    // Finalizar dia com observações
    finalizarDiaCompleto(observacoes);
}

    document.getElementById("btnFinalizarDia").addEventListener("click", function () {
        fetch("/rotinas", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify( diaCompleto) // aqui vai o JSON do console.log
        })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
            })
            .catch(err => console.error(err));
    });
function toggleVideo(button) {
    const videoContainer = button.nextElementSibling;
    const isHidden = videoContainer.style.display === 'none';
    
    if (isHidden) {
        videoContainer.style.display = 'block';
        button.innerHTML = '▼ Ocultar Vídeo';
        button.style.background = '#ff5722';
    } else {
        videoContainer.style.display = 'none';
        button.innerHTML = '▶ Mostrar Vídeo';
        button.style.background = '#2196F3';
    }
}
    </script>

   
@stop