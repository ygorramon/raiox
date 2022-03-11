@extends('adminlte::page')

@section('title', 'Todos os Desafios')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Terapeutas - Desafios</li>
</ol>

@stop

@section('content')
<div class="card">
  
    
    <div class="card-body">

<h4> Terapeuta: {{$user->name}}</h4>

<br>

  <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome da Mãe</th>
                    <th>Nome do Bebê</th>
                     <th>Turma</th>
                   
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->challenges->where('status','RESPONDIDO') as $challenge)
                <tr>
                    <td>{{ $challenge->client->name }} <br>({{ $challenge->client->email}})</td>
                    <td>{{ $challenge->client->nameBaby }}</td>
                   <td>{{ $challenge->client->class }}</td>

                    
                    <td>

                        <a href="{{route('challenge.availables.show', $challenge->id)}}" class="btn btn-warning">VER</a>
                        <a href="{{route('relatorios.challenge.transferir', $challenge->id)}}" class="btn btn-primary">Trasnferir</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>



</div>
    @stop