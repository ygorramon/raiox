@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
   
</ol>

@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('relatorios.clients.search')}}" method="POST" class="form form-inline">
            @csrf
           Informe o e-mail ou nome do cliente: 
            <input type="text" name="filter" placeholder="Filtrar:" class="form-control" value="{{ $filters['filter'] ?? '' }}">
            <button type="submit" class="btn btn-dark">Filtrar</button>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome da Mãe</th>
                    <th>E-mail</th>

                    <th width="270">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    

                    <td style="width=10px;">
                        <a href="{{ route('relatorios.clients.desafios', $client->id) }}" class="btn btn-info">Desafios</a>
                      
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @stop