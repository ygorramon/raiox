@extends('site.desafio.layouts.app')
@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
<style>
    /* CSS específico para vídeos verticais (selfie) */
    .video-container-vertical {
        position: relative;
        width: 100%;
        max-width: 400px; /* Largura máxima para manter proporção vertical */
        margin: 0 auto;
        background: #000;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .video-container-vertical video {
        width: 100%;
        height: auto;
        display: block;
    }
    
    /* Para telas muito pequenas */
    @media (max-width: 480px) {
        .video-container-vertical {
            max-width: 100%;
        }
    }
</style>
@stop

@section('content')
<div class="row">
    <div class="col s12">
        <div class="container">
            <div class="section">
                <div id="card-widgets">
                    <div class="row">
                        <div class="col s12">
                            <!-- Modal do Vídeo Explicativo -->
                            <div id="modalVideoExplicativo" class="modal">
                                <div class="modal-content center-align">
                                    <h4>🎥 Como usar as Análises Individuais</h4>
                                    <p>Assista a este vídeo para entender como aproveitar ao máximo suas análises individuais:</p>
                                    
                                    <!-- Container especial para vídeo vertical -->
                                    <div class="video-container-vertical">
                                        <video id="videoExplicativo" controls playsinline>
                                            <source src="{{ asset('storage/videos/analises-individuais-explicacao.mp4') }}" type="video/mp4">
                                            Seu navegador não suporta vídeos.
                                        </video>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="modal-close btn waves-effect waves-light green" onclick="marcarComoVisto()">
                                            ✅ Entendi, não mostrar novamente
                                        </button>
                                        <button type="button" class="modal-close btn waves-effect waves-light grey">
                                            Fechar
                                        </button>
                                    </div>
                                </div>
                            </div>


                            <ul id="task-card" class="collection with-header animate fadeLeft">
                                <li class="collection-header red">
                                    <h5 class="task-card-title mb-3">Minhas Análises Individuais</h5>
                                    <p class="task-card-date white-text">Acompanhe seus dias de forma independente</p>
                                </li>
                                
                                <table class="bordered">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Título</th>
                                            <th>Idade do Bebê</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($analises as $analise)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($analise->data)->format('d/m/Y') }}</td>
                                            <td>{{ $analise->titulo ?? 'Análise do Dia' }}</td>
                                            <td>{{ $analise->idadeBebe }} meses</td>
                                            <td>
                                                <a class="btn waves-effect waves-light blue" href="{{ route('analises.individuais.show', $analise->id) }}">
                                                    👁️ Ver
                                                </a>
                                                <a class="btn waves-effect waves-light orange" href="{{ route('analises.individuais.edit', $analise->id) }}">
                                                    ✏️ Editar
                                                </a>
                                                <form action="{{ route('analises.individuais.destroy', $analise->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn waves-effect waves-light red" onclick="return confirm('Tem certeza que deseja excluir esta análise?')">
                                                        🗑️ Excluir
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="center-align">
                                                <div class="card-panel yellow lighten-4">
                                                    <p class="yellow-text darken-4">Nenhuma análise individual encontrada.</p>
                                                    <p>Comece criando sua primeira análise!</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                
                                <li class="collection-item center-align">
                                    <a class="btn waves-effect waves-light green" href="{{ route('analises.individuais.create') }}">
                                        ➕ Iniciar Nova Análise
                                    </a>
                                </li>
                            </ul>
                            
                            <div class="card-alert card purple lighten-5">
                                <div class="card-content purple-text">
                                    <a href="https://api.whatsapp.com/send?phone=5588996620215" target="_blank" class="btn">
                                        Suporte Técnico
                                    </a>
                                </div>
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
    $(document).ready(function(){
        // Inicializa todos os modais
        $('.modal').modal();
        
        // Verifica se é a primeira vez do usuário ou se já viu o vídeo
        const jaViuVideo = localStorage.getItem('videoAnalisesIndividuaisVisto');
        
        if (!jaViuVideo) {
            // Abre o modal automaticamente após 1 segundo
            setTimeout(function() {
                $('#modalVideoExplicativo').modal('open');
                
                // Tenta reproduzir o vídeo automaticamente
                const video = document.getElementById('videoExplicativo');
                if (video) {
                    video.play().catch(function(error) {
                        console.log('Reprodução automática bloqueada:', error);
                    });
                }
            }, 1000);
        }
        
        // Inicializa tooltips se estiver usando
        $('.tooltipped').tooltip();
    });

    // Função para marcar que o usuário já viu o vídeo
    function marcarComoVisto() {
        localStorage.setItem('videoAnalisesIndividuaisVisto', 'true');
        
        // Pausa o vídeo quando fecha
        const video = document.getElementById('videoExplicativo');
        if (video) {
            video.pause();
        }
    }

    // Também pausa o vídeo quando o modal é fechado de outras formas
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('modalVideoExplicativo');
        if (modal) {
            modal.addEventListener('close', function() {
                const video = document.getElementById('videoExplicativo');
                if (video) {
                    video.pause();
                }
            });
        }
    });
</script>
@endsection