@extends('adminlte::page')

@section('title', 'Novo Vídeo')

@section('content_header')
    <h1>Novo Vídeo</h1>
@stop

@section('content')
    <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
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
        <button class="btn btn-success">Salvar</button>
    </form>
@stop
