@extends('adminlte::page')

@section('title', 'Editar Módulo')

@section('content_header')
    <h1>Editar Módulo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('modulos.update', $courseModule->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Título do Módulo</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $courseModule->title) }}"
                           class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea name="description" id="description" class="form-control"
                              rows="4">{{ old('description', $courseModule->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Vídeos Disponíveis</label>
                    <div class="row">
                        @foreach ($videos as $video)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input
                                        type="checkbox"
                                        name="videos[]"
                                        value="{{ $video->id }}"
                                        id="video_{{ $video->id }}"
                                        class="form-check-input"
                                        {{ $courseModule->videos->contains($video->id) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="video_{{ $video->id }}">
                                        {{ $video->title }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="{{ route('modulos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
