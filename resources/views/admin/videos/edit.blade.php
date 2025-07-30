@extends('adminlte::page')

@section('title', 'Editar Vídeo')

@section('content_header')
    <h1>Editar Vídeo</h1>
@stop

@section('content')
    <form action="{{ route('videos.update', $video) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Título</label>
            <input type="text" name="title" value="{{ $video->title }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Descrição</label>
            <textarea name="description" class="form-control">{{ $video->description }}</textarea>
        </div>
        <div class="form-group">
            <label>Substituir Vídeo (opcional)</label>
            <input type="file" name="video" class="form-control" accept="video/mp4">
        </div>
        <button class="btn btn-primary">Atualizar</button>
    </form>
@stop
