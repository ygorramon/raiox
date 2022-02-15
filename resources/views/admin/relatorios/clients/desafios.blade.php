@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
   
</ol>

@stop

@section('content')
<div class="card">
<div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th> Nº do desafio</th>
                    <th>Nome da Mãe</th>
                    <th>Status</th>
                    <th>Data do Envio</th>
                    <th>Terapeuta</th>
                    <th width="270">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($challenges as $challenge)
                <tr>
                    <td>1</td>
                    <td>{{ $challenge->client->name }}</td>
                    <td>{{ $challenge->status }}</td>
                    <td>{{ $challenge->sended_at ?? '' }}</td>
                    <td>{{ $challenge->user->name ?? '' }}</td>

                    

                   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop