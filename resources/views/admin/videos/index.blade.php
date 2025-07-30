@extends('adminlte::page')

@section('title', 'Gerenciar Vídeos')

@section('content_header')
    <h1>Gerenciar Vídeos</h1>
    <a href="{{ route('videos.create') }}" class="btn btn-primary">+ Novo Vídeo</a>
@stop

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Vídeo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($videos as $video)
                <tr>
                    <td>{{ $video->title }}</td>
                    <td>{{ $video->description }}</td>
                    <td>
                        <video src="{{ Storage::url($video->file_path) }}" controls width="200"></video>
                    </td>
                    <td>
                        <a href="{{ route('videos.edit', $video) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('videos.destroy', $video) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Confirma?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
