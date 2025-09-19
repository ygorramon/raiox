<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rotina de Sono - Desafio 7 Dias</title>

    <!-- Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        body {
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
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
</head>
<body>
    <div class="container">
        <h4 class="center-align">Rotina de Sono - Desafio de 7 Dias</h4>
        
        <!-- Barra de progresso -->
        <div class="progress">
            <div class="determinate" style="width: 0%" id="progress-bar"></div>
        </div>
        
        <!-- Card principal -->
        <div class="card">
            <div class="card-content">
                <span class="card-title">Informações do Bebê</span>
                <p>Idade: {{ \Carbon\Carbon::parse($client->birthBaby)->diffInMonths() }} meses | Tempo acordado esperado: {{ calcularTempoAcordado($client->birthBaby) }} minutos</p>
                
                <div class="center-align" id="container-botao-iniciar">
                    <a class="waves-effect waves-light btn-large teal modal-trigger" href="#modal-inicio-dia" id="btn-iniciar-rotina">
                        <i class="material-icons left">access_time</i>Iniciar Rotina
                    </a>
                </div>

                <div class="acoes-rotina hidden" id="container-botoes-acao">
                    <a class="waves-effect waves-light btn blue" onclick="iniciarProximaSoneca()">
                        <i class="material-icons left">hotel</i>Adicionar Soneca
                    </a>
                    <a class="waves-effect waves-light btn purple" onclick="iniciarRitualNoturno()">
                        <i class="material-icons left">nights_stay</i>Ritual Noturno
                    </a>
                    <a class="waves-effect waves-light btn red" onclick="excluirUltimaSoneca()">
                        <i class="material-icons left">delete</i>Excluir Última Soneca
                    </a>
                </div>
            </div>
        </div>
        
       <!-- Registro visual da rotina -->
        <div class="registro-rotina">
            <h5>Registro da Rotina</h5>
            
            <!-- Início do dia -->
            <div class="item-rotina item-vazio" id="registro-inicio-dia">
                <i class="material-icons rotina-icon">wb_sunny</i>
                <div class="rotina-info">
                    <strong>Início do dia:</strong>
                    <span class="rotina-detalhe">Não registrado</span>
                </div>
                <span class="rotina-status status-vazio">Pendente</span>
            </div>
            
            <!-- Sonecas -->
            <div id="registro-sonecas">
                <div class="item-rotina item-vazio" id="registro-soneca-1">
                    <i class="material-icons rotina-icon">hotel</i>
                    <div class="rotina-info">
                        <strong>Primeira soneca:</strong>
                        <span class="rotina-detalhe">Não registrada</span>
                    </div>
                    <span class="rotina-status status-vazio">Pendente</span>
                </div>
            </div>
            
            <!-- Ritual noturno -->
            <div class="item-rotina item-vazio" id="registro-ritual">
                <i class="material-icons rotina-icon">nights_stay</i>
                <div class="rotina-info">
                    <strong>Ritual noturno:</strong>
                    <span class="rotina-detalhe">Não registrado</span>
                </div>
                <span class="rotina-status status-vazio">Pendente</span>
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
            <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
            <a href="#!" class="waves-effect waves-green btn teal" onclick="salvarInicioDia()">Salvar e Continuar</a>
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
                <p>⏰ <strong>Sugestão de horário para sinais de sono:</strong> <span class="sugestao-horario" id="sugestao-sono"></span></p>
                <p>🛌 <strong>Sugestão de horário para início da soneca: Até</strong> <span class="sugestao-horario" id="sugestao-soneca"></span></p>
            </div>
            
            <p class="grey-text">Estes horários são aproximados e refletem as necessidades de sono da maioria dos bebês com idade similar.</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-red btn-flat">Entendido</a>
            <a href="#!" class="waves-effect waves-green btn teal" onclick="abrirModalPreenchimentoSoneca()">Preencher Soneca</a>
        </div>
    </div>

    <!-- Modal 5: Preenchimento da Soneca -->
    <div id="modal-preenchimento-soneca" class="modal">
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
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
            <a href="#!" class="waves-effect waves-green btn teal" onclick="analisarSoneca()">Analisar Soneca</a>
        </div>
    </div>

    <!-- Modal 6: Análise da Soneca -->
    <div id="modal-analise-soneca" class="modal">
        <div class="modal-content">
            <h4>Análise da <span id="titulo-analise-soneca">Primeira</span> Soneca</h4>
            <div id="resultado-analise"></div>
            
            <div class="btn-continuar-rotina">
                <a class="waves-effect waves-light btn-large teal" onclick="continuarRotina()">
                    <i class="material-icons left">play_arrow</i>Continuar Rotina
                </a>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-red btn-flat">Fechar</a>
        </div>
    </div>

    <!-- Modal 8: Ritual Noturno -->
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
            <a href="#!" class="waves-effect waves-green btn teal" onclick="finalizarRitualNoturno()">Finalizar</a>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    
    <script>
        // Variáveis globais
        let inicioDia = '';
        let tempoAcordado = {{ calcularTempoAcordado($client->birthBaby) }};
        let sonecasRealizadas = 0;
        let historicoSonecas = [];
        let idadeBebe = {{ \Carbon\Carbon::parse($client->birthBaby)->diffInMonths() }};
        let horarioSugeridoSono = '';
        let horarioSugeridoSoneca = '';
        let ultimoHorarioAcordou = '';
        let sonecaAtual = 1;
        let rotinaIniciada = false;

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
            $('.modal').modal();
            $('select').formSelect();
            
            // Definir valores padrão para os inputs de tempo
            const agora = new Date();
            const horas = agora.getHours().toString().padStart(2, '0');
            const minutos = agora.getMinutes().toString().padStart(2, '0');
            const horaAtual = `${horas}:${minutos}`;
            
            $('#inicio-dia').val('07:00');
            $('#hora-sentiu-sono').val(horaAtual);
            $('#inicio-soneca').val(horaAtual);
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
        
        // Verificar se há estado salvo
        function verificarEstadoSalvo() {
            const estadoSalvo = localStorage.getItem('rotinaSono');
            if (estadoSalvo) {
                const estado = JSON.parse(estadoSalvo);
                inicioDia = estado.inicioDia;
                sonecasRealizadas = estado.sonecasRealizadas;
                historicoSonecas = estado.historicoSonecas;
                ultimoHorarioAcordou = estado.ultimoHorarioAcordou;
                sonecaAtual = estado.sonecaAtual;
                rotinaIniciada = estado.rotinaIniciada;
                
                if (rotinaIniciada) {
                    // Atualizar interface para modo "continuar"
                    $('#btn-iniciar-rotina').html('<i class="material-icons left">play_arrow</i>Continuar Rotina');
                    $('#container-botoes-acao').removeClass('hidden');
                    atualizarRegistroVisual();
                    atualizarProgresso(25 + (sonecasRealizadas * 15));
                    
                    if (historicoSonecas.length > 0) {
                        ultimoHorarioAcordou = historicoSonecas[historicoSonecas.length - 1].termino;
                    }
                }
            }
        }
        
        // Salvar estado atual
        function salvarEstado() {
            const estado = {
                inicioDia,
                sonecasRealizadas,
                historicoSonecas,
                ultimoHorarioAcordou,
                sonecaAtual,
                rotinaIniciada
            };
            localStorage.setItem('rotinaSono', JSON.stringify(estado));
        }
        
        // Função para atualizar registro visual
        function atualizarRegistroVisual() {
            // Atualizar início do dia
            if (inicioDia) {
                $('#registro-inicio-dia')
                    .removeClass('item-vazio')
                    .addClass('item-adequado')
                    .find('.rotina-detalhe').text(inicioDia);
                $('#registro-inicio-dia .rotina-status')
                    .removeClass('status-vazio')
                    .addClass('status-adequado')
                    .text('Registrado');
            }
            
            // Limpar sonecas existentes
            $('#registro-sonecas').empty();
            
            // Adicionar sonecas do histórico
            historicoSonecas.forEach((soneca, index) => {
                const sonecaId = index + 1;
                const isAdequada = soneca.duracao >= 35;
                const statusClasse = isAdequada ? 'item-adequado' : 'item-atencao';
                const statusTexto = isAdequada ? 'Adequada' : 'Atenção';
                const statusLabel = isAdequada ? 'status-adequado' : 'status-atencao';
                
               $('#registro-sonecas').append(`
    <div class="item-rotina ${statusClasse}" id="registro-soneca-${sonecaId}">
        <a class="btn-excluir red" onclick="excluirSoneca(${index})">
            <i class="material-icons">close</i>
        </a>
        <i class="material-icons rotina-icon">hotel</i>
        <div class="rotina-info">
            <strong>${sonecaId}ª soneca:</strong>
            <span class="rotina-detalhe"> - Sentiu sono: ${soneca.sentiuSono} - ${soneca.inicio} - ${soneca.termino} (${soneca.duracao} min)</span>
        </div>
        <span class="rotina-status ${statusLabel}">${statusTexto}</span>
    </div>
`);
            });
            
            // Adicionar próxima soneca vazia se necessário
            const proximaSonecaId = historicoSonecas.length + 1;
            if (proximaSonecaId <= 4) {
                $('#registro-sonecas').append(`
                    <div class="item-rotina item-vazio" id="registro-soneca-${proximaSonecaId}">
                        <i class="material-icons rotina-icon">hotel</i>
                        <div class="rotina-info">
                            <strong>${proximaSonecaId}ª soneca:</strong>
                            <span class="rotina-detalhe">Não registrada</span>
                        </div>
                        <span class="rotina-status status-vazio">Pendente</span>
                    </div>
                `);
            }
            
            // Atualizar botões de ação
            if (historicoSonecas.length > 0) {
                $('#container-botoes-acao').removeClass('hidden');
            }
historicoSonecas.forEach((soneca, index) => {
        const sonecaId = index + 1;
        
        // Determinar status com base na situação geral
        let statusClasse, statusTexto, statusLabel;
        
        if (soneca.situacao.includes('1.2/2.3')) {
            statusClasse = 'item-adequado';
            statusTexto = 'Excelente';
            statusLabel = 'status-adequado';
        } else if (soneca.situacao.includes('1.1/2.1')) {
            statusClasse = 'item-atencao';
            statusTexto = 'Crítica';
            statusLabel = 'status-atencao';
        } else {
            statusClasse = 'item-adequado';
            statusTexto = 'Boa';
            statusLabel = 'status-adequado';
        }
        
        // ... (resto do código)
    });

        }
        
        // Função para salvar início do dia
        function salvarInicioDia() {
            inicioDia = $('#inicio-dia').val();
            if (!inicioDia) {
                M.toast({html: 'Por favor, informe o horário que iniciou o dia'});
                return;
            }
            
            // Definir o último horário acordado como o início do dia
            ultimoHorarioAcordou = inicioDia;
            rotinaIniciada = true;
            
            // Atualizar botão para "Continuar Rotina"
            $('#btn-iniciar-rotina').html('<i class="material-icons left">play_arrow</i>Continuar Rotina');
            $('#container-botoes-acao').removeClass('hidden');
            
            // Atualizar registro visual
            atualizarRegistroVisual();
            
            // Fechar modal atual
            $('#modal-inicio-dia').modal('close');
            
            // Salvar estado
            salvarEstado();
            
            // Atualizar barra de progresso
            atualizarProgresso(25);
            
            // Iniciar primeira soneca
            setTimeout(function() {
                iniciarSoneca();
            }, 300);
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
            $('#hora-sentiu-sono').val(horarioSugeridoSono);
            $('#inicio-soneca').val(horarioSugeridoSoneca);
            
            $('#modal-sugestao-soneca').modal('close');
            setTimeout(function() {
                $('#modal-preenchimento-soneca').modal('open');
            }, 300);
        }
        
        // Função para analisar a soneca
        function analisarSoneca() {
            const horaSentiuSono = $('#hora-sentiu-sono').val();
            const inicioSoneca = $('#inicio-soneca').val();
            const horaAcordou = $('#hora-acordou').val();
            let sentiuSono = $('#hora-sentiu-sono').val();
            if (!horaSentiuSono || !inicioSoneca || !horaAcordou) {
                M.toast({html: 'Por favor, preencha todos os campos da soneca'});
                return;
            }
            
            // Calcular duração
            const duracao = calcularDuracao(inicioSoneca, horaAcordou);
            
            // Determinar situação
            let situacao = '1.1'; // Padrão
            let mensagem = 'Soneca dentro dos parâmetros esperados';
            let isAdequada = duracao >= 35;
            
            if (!isAdequada) {
                situacao = '2.2';
                mensagem = 'Soneca curta - pode ser necessário ajustar';
            }
       
            // Registrar no histórico
            historicoSonecas.push({
                numero: historicoSonecas.length + 1,
                
                inicio: inicioSoneca,
                termino: horaAcordou,
                duracao: duracao,
                situacao: situacao
            });
            
            // Atualizar o último horário que acordou para a próxima soneca
            ultimoHorarioAcordou = horaAcordou;
            
            // Atualizar registro visual
            atualizarRegistroVisual();
            
            // Atualizar título da análise
            const tituloSoneca = sonecaAtual === 1 ? 'Primeira' : (sonecaAtual === 2 ? 'Segunda' : (sonecaAtual === 3 ? 'Terceira' : 'Quarta'));
            $('#titulo-analise-soneca').text(tituloSoneca);
            
            // Mostrar resultado
            $('#resultado-analise').html(`
                <div class="card-panel ${isAdequada ? 'green' : 'orange'} lighten-4">
                    <h5>Análise Concluída</h5>
                    <p>${isAdequada ? '✅ Soneca registrada com sucesso!' : '⚠️ Soneca precisa de atenção'}</p>
                    <p>📊 <strong>Duração:</strong> ${duracao} minutos</p>
                    <p>📈 <strong>Situação:</strong> ${mensagem}</p>
                    <p>🔢 <strong>Código:</strong> ${situacao}</p>
                </div>
            `);
            
            // Fechar modal atual e abrir análise
            $('#modal-preenchimento-soneca').modal('close');
            setTimeout(function() {
                $('#modal-analise-soneca').modal('open');
            }, 300);
            
            // Salvar estado
            salvarEstado();
            
            // Atualizar barra de progresso
            atualizarProgresso(25 + (historicoSonecas.length * 15));

           
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
        function excluirSoneca(index) {
            if (confirm('Tem certeza que deseja excluir esta soneca?')) {
                // Remover a soneca
                historicoSonecas.splice(index, 1);
                
                // Renumerar as sonecas
                historicoSonecas.forEach((soneca, i) => {
                    soneca.numero = i + 1;
                });
                
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
                
                M.toast({html: 'Soneca excluída com sucesso'});
            }
        }
        
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
            const isAdequado = duracaoRitual <= 60; // Ritual até 1h é considerado adequado
            
            // Atualizar registro do ritual
            $('#registro-ritual')
                .removeClass('item-vazio')
                .addClass(isAdequado ? 'item-adequado' : 'item-atencao')
                .find('.rotina-detalhe').text(`${inicioRitual} - ${sonoNoturno} (${duracaoRitual} min) | ${localSono}`);
            
            $('#registro-ritual .rotina-status')
                .removeClass('status-vazio')
                .addClass(isAdequado ? 'status-adequado' : 'status-atencao')
                .text(isAdequado ? 'Adequado' : 'Longo');
            
            // Registrar ritual noturno
            M.toast({html: 'Ritual noturno registrado com sucesso!'});
            
            // Fechar modal
            $('#modal-ritual-noturno').modal('close');
            
            // Atualizar barra de progresso
            atualizarProgresso(100);
            
            // Limpar estado salvo
            localStorage.removeItem('rotinaSono');
            
            // Mostrar resumo final
            setTimeout(function() {
                mostrarResumoFinal();
            }, 1000);
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
    
    // Calcular janela de sono (tempo entre sentir sono e início da soneca)
    const janelaSono = calcularDuracao(ultimoHorarioAcordou, inicioSoneca);
    const janelaSinalSono = calcularDuracao(ultimoHorarioAcordou, horaSentiuSono);
    const ritualSono = calcularDuracao(horaSentiuSono, inicioSoneca);
    // Analisar janela de sono
    const analiseJanela = analisarJanelaSono(janelaSono,janelaSinalSono,ritualSono);
    
    // Analisar duração da soneca
    const analiseDuracao = analisarDuracaoSoneca(duracao,janelaSono,janelaSinalSono,ritualSono);
    
    // Determinar situação geral
    const situacaoGeral = determinarSituacaoGeral(analiseJanela, analiseDuracao);
    
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
        }
    });
    
    // Atualizar o último horário que acordou para a próxima soneca
   
    // Atualizar título da análise
    const tituloSoneca = sonecaAtual === 1 ? 'Primeira' : (sonecaAtual === 2 ? 'Segunda' : (sonecaAtual === 3 ? 'Terceira' : 'Quarta'));
    $('#titulo-analise-soneca').text(tituloSoneca);
    
    // Mostrar resultado detalhado
    mostrarResultadoAnalise(analiseJanela, analiseDuracao, situacaoGeral, horaSentiuSono, inicioSoneca, horaAcordou, duracao, janelaSono,janelaSinalSono, ultimoHorarioAcordou);
     ultimoHorarioAcordou = horaAcordou;
    
    // Atualizar registro visual
    atualizarRegistroVisual();
    
    // Fechar modal atual e abrir análise
    $('#modal-preenchimento-soneca').modal('close');
    setTimeout(function() {
        $('#modal-analise-soneca').modal('open');
    }, 300);
    
    // Salvar estado
    salvarEstado();
    
    // Atualizar barra de progresso
    atualizarProgresso(25 + (historicoSonecas.length * 15));
}

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
            mensagem: 'Começou a fazer dormir cedo demais, mas dormiu em tempo adequad',
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
     else if (janela < parametrosJanelaSono.maxima && janelaSinalSono > parametrosJanelaSinalSono.maxima ) {
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
            codigo: `${analiseJanela.codigo}/${analiseDuracao.codigo}`,
            classe: 'green'
        };
    } else if (analiseJanela.status === 'curta' && analiseDuracao.status === 'curta') {
        return {
            status: 'critica',
            mensagem: 'Soneca precisa de ajustes',
            codigo: `${analiseJanela.codigo}/${analiseDuracao.codigo}`,
            classe: 'red'
        };
    } else if (analiseJanela.status === 'muito_longa' || analiseDuracao.status === 'longa') {
        return {
            status: 'atencao',
            mensagem: 'Soneca requer atenção',
            codigo: `${analiseJanela.codigo}/${analiseDuracao.codigo}`,
            classe: 'orange'
        };
    } else {
        return {
            status: 'boa',
            mensagem: 'Soneca boa',
            codigo: `${analiseJanela.codigo}/${analiseDuracao.codigo}`,
            classe: 'blue'
        };
    }
}

// Função para mostrar resultado detalhado da análise
function mostrarResultadoAnalise(analiseJanela, analiseDuracao, situacaoGeral, sentiuSono, inicio, termino, duracao, janelaSono, janelaSinalSono, ultimoHorarioAcordou) {
    function isAtrasado(real, sugerido) {
        if (!real || !sugerido) return false;
        return real > sugerido; // compara strings HH:MM (funciona pois formato é padronizado)
    }
    let classeSentiuSono = isAtrasado(sentiuSono, horarioSugeridoSono) ? "red" : "";
    let classeDormiu = isAtrasado(inicio, horarioSugeridoSoneca) ? "red" : "";

    const formatarHora = (minutos) => {
                const horas = Math.floor(minutos / 60) % 24;
                const mins = minutos % 60;
                return `${horas.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')}`;
            };
    const [hora, minuto] = ultimoHorarioAcordou.split(':');
            const minutosInicio = parseInt(hora) * 60 + parseInt(minuto);
            const minutosSugestaoSono = minutosInicio + tempoAcordado;
            const minutosSugestaoSoneca = minutosSugestaoSono + 40;
            horarioSugeridoSono = formatarHora(minutosSugestaoSono);
            horarioSugeridoSoneca = formatarHora(minutosSugestaoSoneca);
            
    $('#resultado-analise').html(`
        <div class="card-panel ${situacaoGeral.classe} lighten-4">
            <h5>${situacaoGeral.mensagem}</h5>
            <p><strong>Código:</strong> ${situacaoGeral.codigo}</p>
            
            <div class="divider"></div>

            <p><strong>Horário que Acordou da última Soneca:</strong> ${ultimoHorarioAcordou}</p>
         <p><strong>Horário que Sentiu Sono:</strong> 
                <span class="${classeSentiuSono}">${sentiuSono}</span> 
                (Sugerido: ${horarioSugeridoSono})
            </p>
            <p><strong>Horário que Dormiu:</strong> 
                <span class="${classeDormiu}">${inicio}</span> 
                (Sugerido: ${horarioSugeridoSoneca})
            </p>
            <p><strong>Horário que Acordou:</strong> ${termino}</p>
            
           
            <div class="divider"></div>

            <h6>Análise da Janela de Sono</h6>
            <p>⏱️ <strong>Duração:</strong> ${janelaSono} minutos</p>
            <p>⏱️ <strong>Duração:</strong> ${janelaSinalSono} minutos</p>
            <p>📊 <strong>Status:</strong> ${analiseJanela.mensagem}</p>
            <p>💡 <strong>Recomendação:</strong> ${analiseJanela.recomendacao}</p>
            
            <div class="divider"></div>
            
            <h6>Análise da Duração da Soneca</h6>
            <p>⏱️ <strong>Duração:</strong> ${duracao} minutos</p>
            <p>📊 <strong>Status:</strong> ${analiseDuracao.mensagem}</p>
            <p>💡 <strong>Recomendação:</strong> ${analiseDuracao.recomendacao}</p>
            
            <div class="divider"></div>
            
            <h6>Próximos Passos</h6>
            <p>👶 <strong>Idade do bebê:</strong> ${idadeBebe} meses</p>
            <p>⏰ <strong>Tempo acordado esperado:</strong> ${tempoAcordado} minutos</p>
            <p>📋 <strong>Próxima janela sugerida:</strong> ${calcularProximaJanela()}</p>
        </div>
    `);
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
    </script>
</body>
</html>