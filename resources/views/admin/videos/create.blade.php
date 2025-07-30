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

    <!-- Splash de carregamento -->
    <div id="loadingSplash" class="d-none text-center mt-4">
        <div class="spinner-border text-primary" role="status"></div>
        <p>Enviando vídeo, aguarde...</p>
    </div>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#videoForm').on('submit', function(e) {
        e.preventDefault();

        $('#alert-success, #alert-error').addClass('d-none');
        $('#loadingSplash').removeClass('d-none');

        var formData = new FormData(this);

        $.ajax({
            url: '{{ route('videos.store') }}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#loadingSplash').addClass('d-none');
                $('#alert-success').removeClass('d-none');
                $('#videoForm')[0].reset();
            },
            error: function(xhr) {
                $('#loadingSplash').addClass('d-none');
                $('#alert-error').removeClass('d-none').text("Erro ao enviar: " + xhr.responseJSON?.message || 'Erro desconhecido');
            }
        });
    });
</script>
@stop
