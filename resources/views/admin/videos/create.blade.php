@extends('adminlte::page')

@section('title', 'Novo Vídeo')

@section('content_header')
    <h1>Novo Vídeo</h1>
@stop

@section('content')
    <div id="alert-success" class="alert alert-success d-none">Vídeo enviado com sucesso!</div>
    <div id="alert-error" class="alert alert-danger d-none">Ocorreu um erro no envio do vídeo.</div>

    <form id="videoForm" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Título</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Descrição</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Arquivo de Vídeo</label>
            <input type="file" name="video" class="form-control" accept="video/mp4" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>

    <!-- Barra de Progresso -->
    <div id="progressWrapper" class="mt-4 d-none">
        <label>Enviando vídeo...</label>
        <div class="progress">
            <div id="uploadProgress" class="progress-bar" role="progressbar" style="width: 0%">0%</div>
        </div>
    </div>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#videoForm').on('submit', function(e) {
        e.preventDefault();

        $('#alert-success, #alert-error').addClass('d-none');
        $('#progressWrapper').removeClass('d-none');
        $('#uploadProgress').css('width', '0%').text('0%');

        var formData = new FormData(this);

        $.ajax({
            url: '{{ route('videos.store') }}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            xhr: function() {
                var xhr = new window.XMLHttpRequest();

                // Acompanhamento do progresso do upload
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        $('#uploadProgress')
                            .css('width', percentComplete + '%')
                            .text(percentComplete + '%');
                    }
                }, false);

                return xhr;
            },
            success: function(response) {
                $('#progressWrapper').addClass('d-none');
                $('#alert-success').removeClass('d-none').text(response.message);
                $('#videoForm')[0].reset();
            },
            error: function(xhr) {
                $('#progressWrapper').addClass('d-none');
                $('#alert-error').removeClass('d-none').text("Erro ao enviar: " + (xhr.responseJSON?.message || 'Erro desconhecido'));
            }
        });
    });
</script>
@stop
