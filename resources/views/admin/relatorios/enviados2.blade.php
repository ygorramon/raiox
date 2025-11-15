@extends('adminlte::page')

@section('title', 'Todos os Desafios')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Todos os Desafios</li>
</ol>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-condensed" id="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome da Mãe</th>
            <th>Bebê</th>
            <th>Data de Nascimento - Idade</th>
            <th>Email</th>
            <th>Turma</th>
            <th>Data de Envio</th>
            <th>Terapeuta</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @php
            // Agrupar desafios por faixa etária
            $faixasEtarias = [
                '1 a 3 meses' => [],
                '4 a 6 meses' => [],
                '6 a 12 meses' => [],
                'Maiores de 1 ano' => []
            ];
            
            foreach ($challenges as $challenge) {
                if ($challenge->client->birthBaby) {
                    $birthDate = \Carbon\Carbon::parse($challenge->client->birthBaby);
                    $ageInMonths = $birthDate->diffInMonths(now());
                    
                    if ($ageInMonths <= 3) {
                        $faixasEtarias['1 a 3 meses'][] = $challenge;
                    } elseif ($ageInMonths <= 6) {
                        $faixasEtarias['4 a 6 meses'][] = $challenge;
                    } elseif ($ageInMonths <= 12) {
                        $faixasEtarias['6 a 12 meses'][] = $challenge;
                    } else {
                        $faixasEtarias['Maiores de 1 ano'][] = $challenge;
                    }
                } else {
                    // Caso não tenha data de nascimento, colocar em "Maiores de 1 ano" ou outra categoria padrão
                    $faixasEtarias['Maiores de 1 ano'][] = $challenge;
                }
            }
        @endphp

        @foreach($faixasEtarias as $faixa => $desafios)
            @if(count($desafios) > 0)
                <tr class="table-info">
                    <td colspan="10" class="font-weight-bold">
                        <i class="fas fa-baby"></i> Faixa Etária: {{ $faixa }} 
                        <span class="badge badge-primary ml-2">{{ count($desafios) }} registro(s)</span>
                    </td>
                </tr>
                
                @foreach($desafios as $challenge)
                <tr>
                    <td>{{ $challenge->id }}</td>
                    <td>{{ $challenge->client->name }}</td>
                    <td>{{ $challenge->client->nameBaby }}</td>
                    <td>
                        @if($challenge->client->birthBaby)
                            {{ \Carbon\Carbon::parse($challenge->client->birthBaby)->format('d/m/Y') }}
                            <br>
                            <small class="text-muted">
                                ({{ \Carbon\Carbon::parse($challenge->client->birthBaby)->diffInMonths(now()) }} meses)
                            </small>
                        @endif
                    </td>
                    <td>{{ $challenge->client->email }}</td>
                    <td>{{ $challenge->client->class }}</td>
                    <td>{{ \Carbon\Carbon::parse($challenge->sended_at)->format('d/m/Y H:i') }}</td>
                    <td>{{ $challenge->user->name ?? '' }}</td>
                    <td>
                        @switch($challenge->status)
                            @case('ANALISE')
                            @case('ENVIADO')
                                <span class="badge bg-yellow">{{ $challenge->status }}</span>
                                @break
                            @case('RESPONDIDO')
                                <span class="badge bg-green">{{ $challenge->status }}</span>
                                @break
                            @case('FINALIZADO')
                                <span class="badge bg-blue">{{ $challenge->status }}</span>
                                @break
                        @endswitch
                    </td>
                    <td>
                        @if($challenge->status != 'INICIADO')
                            <a class="btn btn-primary btn-sm" href="{{ route('challenge.meus.show', $challenge->id) }}">Ver Desafio</a>
                            <a class="btn btn-warning btn-sm" href="{{ route('challenge.meus.respostas', $challenge->id) }}">Ver Respostas</a>
                            @if(isset($challenge->chat))
                                <a class="btn btn-success btn-sm" href="{{ route('challenge.meus.chat', $challenge->id) }}">Ver Chat</a>
                            @endif
                        @endif
                        <form action="{{ route('challenge.getanalise', $challenge->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-primary btn-sm">Pegar</button>
                        </form>
                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#uploadModal" data-id="{{ $challenge->id }}">
                            Upload de Análise
                        </button>
                        
                        <!-- Botões para ver análises existentes -->
                        @if($challenge->analises && count($challenge->analises) > 0)
                            @foreach($challenge->analises as $index => $analise)
                                <button class="btn btn-dark btn-sm view-analise-btn mt-1"
                                        data-video-url="{{ Storage::url($analise['caminho']) }}"
                                        data-parte="{{ $analise['parte'] }}">
                                    Ver Análise Parte {{ $analise['parte'] }}
                                </button>
                            @endforeach
                        @endif
                    </td>
                </tr>
                @endforeach
            @endif
        @endforeach
    </tbody>
</table>
    </div>
</div>

<!-- Modal Upload Análise Múltipla -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <form id="uploadForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="challenge_id" id="modalChallengeId">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload de Análise - Múltiplas Partes</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="videosContainer">
                        <!-- Primeiro vídeo -->
                        <div class="video-upload-item mb-3 p-3 border rounded">
                            <h6>Parte 1</h6>
                            <div class="form-group">
                                <label>Vídeo da Análise (Parte 1)</label>
                                <input type="file" name="analise_videos[]" accept="video/mp4" required class="form-control video-file">
                            </div>
                            <video class="preview-video" controls style="max-width: 100%; display: none; margin-top: 10px;"></video>
                        </div>
                    </div>
                    
                    <!-- Botão para adicionar mais partes -->
                    <button type="button" id="addVideoBtn" class="btn btn-secondary btn-sm">
                        <i class="fas fa-plus"></i> Adicionar Outra Parte
                    </button>
                    
                    <div class="progress mt-3" style="height: 25px; display:none;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                             role="progressbar"
                             style="width: 0%">0%</div>
                    </div>

                    <div id="uploadStatus" class="mt-2"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Enviar Todas as Partes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Ver Análise -->
<div class="modal fade" id="viewAnaliseModal" tabindex="-1" role="dialog" aria-labelledby="viewAnaliseModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="analiseModalTitle">Análise em Vídeo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <video id="analiseVideoPlayer" controls style="max-width: 100%;"></video>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
$(document).ready(function() {
    $('#table').DataTable({
        paging: true,
        language: { search: "Filtrar: " },
        order: [[6, "asc"]]
    });

    let videoCount = 1;

    // Abrir modal
    $('#uploadModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var challengeId = button.data('id')
        $('#modalChallengeId').val(challengeId)

        // Resetar formulário
        videoCount = 1;
        $('#videosContainer').html(`
            <div class="video-upload-item mb-3 p-3 border rounded">
                <h6>Parte 1</h6>
                <div class="form-group">
                    <label>Vídeo da Análise (Parte 1)</label>
                    <input type="file" name="analise_videos[]" accept="video/mp4" required class="form-control video-file">
                </div>
                <video class="preview-video" controls style="max-width: 100%; display: none; margin-top: 10px;"></video>
            </div>
        `);
        
        $('.progress').hide();
        $('.progress-bar').css('width', '0%').text('0%');
        $('#uploadStatus').text('');
    });

    // Adicionar nova parte de vídeo
    $('#addVideoBtn').click(function() {
        videoCount++;
        const newVideoHtml = `
            <div class="video-upload-item mb-3 p-3 border rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <h6>Parte ${videoCount}</h6>
                    <button type="button" class="btn btn-danger btn-sm remove-video-btn">
                        <i class="fas fa-times"></i> Remover
                    </button>
                </div>
                <div class="form-group">
                    <label>Vídeo da Análise (Parte ${videoCount})</label>
                    <input type="file" name="analise_videos[]" accept="video/mp4" required class="form-control video-file">
                </div>
                <video class="preview-video" controls style="max-width: 100%; display: none; margin-top: 10px;"></video>
            </div>
        `;
        $('#videosContainer').append(newVideoHtml);
    });

    // Remover parte de vídeo
    $(document).on('click', '.remove-video-btn', function() {
        if ($('.video-upload-item').length > 1) {
            $(this).closest('.video-upload-item').remove();
            // Reorganizar números das partes
            $('.video-upload-item').each(function(index) {
                $(this).find('h6').text(`Parte ${index + 1}`);
                $(this).find('label').text(`Vídeo da Análise (Parte ${index + 1})`);
            });
            videoCount = $('.video-upload-item').length;
        }
    });

    // Preview de vídeo
    $(document).on('change', '.video-file', function(e) {
        const file = e.target.files[0];
        const previewVideo = $(this).closest('.video-upload-item').find('.preview-video');
        
        if (file) {
            const url = URL.createObjectURL(file);
            previewVideo.attr('src', url).show();
        } else {
            previewVideo.hide();
        }
    });

    // Enviar formulário
    $('#uploadForm').on('submit', function(e) {
        e.preventDefault();

        var form = $('#uploadForm')[0];
        var data = new FormData(form);

        // Adicionar número de partes
        data.append('total_partes', videoCount);

        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()}
        });

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '{{ route("challenge.upload.analise") }}', true);

        xhr.upload.addEventListener("progress", function(e) {
            if (e.lengthComputable) {
                var percent = Math.round((e.loaded / e.total) * 100);
                $('.progress').show();
                $('.progress-bar').css('width', percent + '%').text(percent + '%');
            }
        });

        xhr.onload = function() {
            if (xhr.status === 200) {
                $('#uploadStatus').html('<div class="alert alert-success">Upload concluído com sucesso!</div>');
                setTimeout(() => { 
                    location.reload(); 
                }, 2000);
            } else {
                $('#uploadStatus').html('<div class="alert alert-danger">Erro no upload!</div>');
            }
        };

        xhr.send(data);
    });

    // Ver análise
    $('.view-analise-btn').click(function() {
        var videoUrl = $(this).data('video-url');
        var parte = $(this).data('parte');
        $('#analiseVideoPlayer').attr('src', videoUrl);
        $('#analiseModalTitle').text('Análise - Parte ' + parte);
        $('#viewAnaliseModal').modal('show');
    });

    // Fechar modal e limpar recursos
    $('#viewAnaliseModal').on('hidden.bs.modal', function () {
        $('#analiseVideoPlayer').attr('src', '');
    });
});
</script>
@endsection