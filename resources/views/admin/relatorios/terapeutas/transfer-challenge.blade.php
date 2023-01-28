@extends('adminlte::page')

@section('title', 'Todos os Desafios')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Trasnferir Desafio</li>
</ol>

@stop

@section('content')
<div class="card">
  
    
    <div class="card-body">

<h4> Mãe: {{$challenge->client->name}}</h4>
<h4> Terapeuta Atual: {{$challenge->user->name}}</h4>
<form action="{{route('relatorios.challenge.transferir.update', $challenge->id)}}"  method="POST">
    @csrf
                            {{ method_field('PUT') }}
<select name="user" class="form-control">
    @foreach ($users as $user)
        <option value="{{$user->id}}" 
            @if($challenge->user_id==$user->id) selected @endif
            )>{{$user->name}}</option>
    @endforeach
</select>
<button type="submit" class="btn btn-primary "> Trasnferir</button>
</form>


</div>
    @stop