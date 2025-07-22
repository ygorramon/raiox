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
    @foreach ($challenges as $challenge)
        <tr>
            <td>{{ $challenge->client->name }}</td>
            <td>{{ $challenge->client->nameBaby }}</td>
            <td>
                @if($challenge->client->birthBaby)
                    {{ \Carbon\Carbon::parse($challenge->client->birthBaby)->format('d/m/Y') }}
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
                    <a class="btn btn-primary" href="{{ route('challenge.meus.show', $challenge->id) }}">Ver Desafio</a>
                    <a class="btn btn-warning" href="{{ route('challenge.meus.respostas', $challenge->id) }}">Ver Respostas</a>
                    @if(isset($challenge->chat))
                        <a class="btn btn-success" href="{{ route('challenge.meus.chat', $challenge->id) }}">Ver Chat</a>
                    @endif
                @endif
                <form action="{{ route('challenge.getanalise', $challenge->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-primary">Pegar</button>
                </form>
                <button class="btn btn-info" data-toggle="modal" data-target="#uploadModal" data-id="{{ $challenge->id }}">
    Upload de Análise
</button>
@if($challenge->analise_video)
  <button class="btn btn-dark view-analise-btn"
          data-video-url="{{ Storage::url($challenge->analise_video) }}">
    Ver Análise
  </button>
@endif
            </td>
        </tr>
    @endforeach
</tbody>
        </table>
    </div>
<!-- Modal Upload Análise -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel">
  <div class="modal-dialog" role="document">
    <form id="uploadForm" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="challenge_id" id="modalChallengeId">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Upload de Análise</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="file" name="analise_video" accept="video/mp4" required class="form-control">
          <br>
          <video id="previewVideo" controls style="max-width: 100%; display: none;"></video>

          <div class="progress mt-3" style="height: 25px; display:none;">
            <div class="progress-bar progress-bar-striped progress-bar-animated"
                 role="progressbar"
                 style="width: 0%">0%</div>
          </div>

          <div id="uploadStatus" class="mt-2"></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Enviar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Modal Ver Análise -->
<div class="modal fade" id="viewAnaliseModal" tabindex="-1" role="dialog" aria-labelledby="viewAnaliseModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Análise em Vídeo</h4>
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
</div>
@section('js')
<script>
$(document).ready(function() {
    $('#table').DataTable({
        paging: true,
        language: { search: "Filtrar: " },
        order: [[6, "desc"]]
    });

    $('#uploadModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var challengeId = button.data('id')
        $('#modalChallengeId').val(challengeId)

        // Limpar barra de progresso e status
        $('.progress').hide();
        $('.progress-bar').css('width', '0%').text('0%');
        $('#uploadStatus').text('');
    });

    $('input[name="analise_video"]').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const url = URL.createObjectURL(file);
            $('#previewVideo').attr('src', url).show();
        } else {
            $('#previewVideo').hide();
        }
    });

    $('#uploadForm').on('submit', function(e) {
        e.preventDefault();

        var form = $('#uploadForm')[0];
        var data = new FormData(form);

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
                $('#uploadStatus').html('<div class="alert alert-success">Upload concluído!</div>');
                setTimeout(() => { location.reload(); }, 1500);
            } else {
                $('#uploadStatus').html('<div class="alert alert-danger">Erro no upload!</div>');
            }
        };

        xhr.send(data);
    });

});

$('.view-analise-btn').click(function() {
    var videoUrl = $(this).data('video-url');
    $('#analiseVideoPlayer').attr('src', videoUrl);
    $('#viewAnaliseModal').modal('show');
});
</script>
@endsection
@stop