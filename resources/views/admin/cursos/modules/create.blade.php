@extends('adminlte::page')

@section('title', 'Novo Módulo')

@section('content_header')
    <h1>Novo Módulo</h1>
@stop

@section('content')
    <form action="{{ route('modulos.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Título</label>
        <input type="text" name="title" class="form-control">
    </div>

    <div class="form-group">
        <label>Descrição</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label>Vídeos</label>
        <select name="videos[]" multiple class="form-control">
            @foreach($videos as $video)
                <option value="{{ $video->id }}">{{ $video->title }}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Salvar</button>
</form>
@stop
