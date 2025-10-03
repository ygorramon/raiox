<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Rotina - {{ $rotina->data }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #2196F3, #1976D2);
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        
        .header .date {
            font-size: 18px;
            opacity: 0.9;
            margin-top: 8px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 25px;
            background: #f8f9fa;
        }
        
        .info-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-left: 4px solid #2196F3;
        }
        
        .info-card h3 {
            margin: 0 0 15px 0;
            color: #333;
            font-size: 18px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 8px;
        }
        
        .info-item {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
        }
        
        .info-label {
            font-weight: 600;
            color: #555;
        }
        
        .info-value {
            color: #333;
        }
        
        .section {
            padding: 25px;
            border-bottom: 1px solid #eee;
        }
        
        .section:last-child {
            border-bottom: none;
        }
        
        .section h2 {
            color: #2196F3;
            margin: 0 0 20px 0;
            font-size: 22px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section h2::before {
            content: "●";
            color: #2196F3;
        }
        
        .soneca-item, .despertar-item {
            background: #f8f9fa;
            padding: 20px;
            margin: 15px 0;
            border-radius: 10px;
            border-left: 4px solid #4CAF50;
        }
        
        .soneca-header, .despertar-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .soneca-numero {
            background: #4CAF50;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
        }
        
        .status-badge {
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .status-ideal {
            background: #E8F5E8;
            color: #2E7D32;
        }
        
        .status-reparadora {
            background: #E3F2FD;
            color: #1565C0;
        }
        
        .detalhes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .associacoes-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }
        
        .tag {
            background: #E3F2FD;
            color: #1976D2;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .ritual-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .resumo-card {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 25px;
            border-radius: 10px;
            text-align: center;
        }
        
        .resumo-number {
            font-size: 36px;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .avaliacao {
            font-size: 20px;
            font-weight: bold;
            margin-top: 15px;
            padding: 10px;
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Cabeçalho -->
        <div class="header">
            <h1>📊 Detalhes da Rotina do Bebê</h1>
            <div class="date">
                {{ \Carbon\Carbon::parse($rotina->data)->format('d/m/Y') }} - 
                Dia {{ $rotina->day }} do Desafio
            </div>
        </div>
        
        <!-- Informações Básicas -->
        <div class="info-grid">
            <div class="info-card">
                <h3>👶 Informações do Bebê</h3>
                <div class="info-item">
                    <span class="info-label">Idade:</span>
                    <span class="info-value">{{ $rotina->idadeBebe }} meses</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Início do Dia:</span>
                    <span class="info-value">{{ $rotina->inicioDia }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Tempo Acordado Esperado:</span>
                    <span class="info-value">{{ $rotina->tempoAcordadoEsperado }}min</span>
                </div>
            </div>
            
            <div class="info-card">
                <h3>📝 Observações</h3>
                <p style="margin: 0; color: #666; line-height: 1.5;">
                    {{ $rotina->observacoes ?? 'Nenhuma observação registrada' }}
                </p>
            </div>
        </div>
        
        <!-- Histórico de Sonecas -->
        @if($sonecas = json_decode($rotina->historicoSonecas, true))
        <div class="section">
            <h2>💤 Histórico de Sonecas</h2>
            @foreach($sonecas as $soneca)
            <div class="soneca-item">
                <div class="soneca-header">
                    <div class="soneca-numero">Soneca #{{ $soneca['numero'] }}</div>
                    <div class="status-badge status-ideal">{{ $soneca['detalhes']['janela']['status'] ?? 'Sem status' }}</div>
                </div>
                
                <div class="detalhes-grid">
                    <div>
                        <strong>⏰ Horários:</strong><br>
                        Sentiu sono: {{ $soneca['sentiuSono'] ?? 'N/A' }}<br>
                        Início: {{ $soneca['inicio'] }}<br>
                        Término: {{ $soneca['termino'] }}<br>
                        Duração: {{ $soneca['duracao'] }}min
                    </div>
                    
                    <div>
                        <strong>📊 Métricas:</strong><br>
                        Janela de sono: {{ $soneca['janelaSono'] }}min<br>
                        Situação: {{ $soneca['situacao'] ?? 'N/A' }}<br>
                        Status: {{ $soneca['detalhes']['duracao']['status'] ?? 'N/A' }}
                    </div>
                    
                    @if(isset($soneca['associacoes']))
                    <div>
                        <strong>🛌 Associações:</strong><br>
                        <div class="associacoes-list">
                            @foreach($soneca['associacoes']['comoAdormeceu'] as $associacao)
                                <span class="tag">{{ $associacao }}</span>
                            @endforeach
                        </div>
                        @if(isset($soneca['associacoes']['depoisAdormecer']))
                        <div style="margin-top: 8px;">
                            <strong>Local após dormir:</strong>
                            <div class="associacoes-list">
                                @foreach($soneca['associacoes']['depoisAdormecer'] as $local)
                                    <span class="tag">{{ $local }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
                
                @if(isset($soneca['detalhes']['janela']['recomendacao']))
                <div style="margin-top: 15px; padding: 12px; background: #E8F5E8; border-radius: 8px; border-left: 4px solid #4CAF50;">
                    <strong>💡 Recomendação:</strong><br>
                    {{ $soneca['detalhes']['janela']['recomendacao'] }}
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @endif
        
        <!-- Ritual Noturno -->
        @if($ritual = json_decode($rotina->ritualNoturno, true))
        <div class="section">
            <h2>🌙 Ritual Noturno</h2>
            <div class="ritual-grid">
                <div class="info-card">
                    <strong>Início do Ritual:</strong><br>
                    {{ $ritual['inicioRitual'] }}
                </div>
                <div class="info-card">
                    <strong>Sono Noturno:</strong><br>
                    {{ $ritual['sonoNoturno'] }}
                </div>
                <div class="info-card">
                    <strong>Duração do Ritual:</strong><br>
                    {{ $ritual['duracaoRitual'] }} minutos
                </div>
                <div class="info-card">
                    <strong>Local do Sono:</strong><br>
                    {{ ucfirst(str_replace('-', ' ', $ritual['localSono'])) }}
                </div>
            </div>
        </div>
        @endif
        
        <!-- Histórico de Despertares -->
        @if($despertares = json_decode($rotina->historicoDespertares, true))
        <div class="section">
            <h2>⏰ Histórico de Despertares</h2>
            @foreach($despertares as $despertar)
            <div class="despertar-item">
                <div class="soneca-header">
                    <div class="soneca-numero">Despertar #{{ $despertar['numero'] }}</div>
                </div>
                
                <div class="detalhes-grid">
                    <div>
                        <strong>⏰ Horários:</strong><br>
                        Acordou: {{ $despertar['horaAcordou'] }}<br>
                        Dormiu: {{ $despertar['horaDormiu'] }}<br>
                        Duração: {{ $despertar['duracao'] }}min
                    </div>
                    
                    <div>
                        <strong>🛌 Formas de Voltar a Dormir:</strong><br>
                        <div class="associacoes-list">
                            @foreach($despertar['formasVolta'] as $forma)
                                <span class="tag">{{ $forma }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        
        <!-- Resumo do Dia -->
        @if($resumo = json_decode($rotina->resumo, true))
        <div class="section">
            <h2>📈 Resumo do Dia</h2>
            <div class="resumo-card">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px;">
                    <div>
                        <div>Total de Sonecas</div>
                        <div class="resumo-number">{{ $resumo['totalSonecas'] }}</div>
                    </div>
                    <div>
                        <div>Total de Despertares</div>
                        <div class="resumo-number">{{ $resumo['totalDespertares'] }}</div>
                    </div>
                    <div>
                        <div>Tempo Total de Sonecas</div>
                        <div class="resumo-number">{{ $resumo['tempoTotalSonecas'] }}min</div>
                    </div>
                </div>
                
                <div class="avaliacao">
                    Avaliação: {{ $resumo['avaliacao'] }}
                </div>
            </div>
        </div>
        @endif
    </div>
</body>
</html>