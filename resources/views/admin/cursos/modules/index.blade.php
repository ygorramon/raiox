@extends('adminlte::page')

@section('title', 'Módulos')

@section('content_header')
    <h1>Módulos</h1>
    <a href="{{ route('modulos.create') }}" class="btn btn-primary">+ Novo Módulo</a>
@stop

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($modules as $module)
                <tr>
                    <td>{{ $module->title }}</td>
                    <td>{{ $module->description }}</td>
                    <td>
                        <a href="{{ route('modulos.edit', $module) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('modulos.destroy', $module) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
