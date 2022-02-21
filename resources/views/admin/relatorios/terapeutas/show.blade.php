@extends('adminlte::page')

@section('title', 'Todos os Desafios')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Terapeutas</li>
</ol>

@stop

@section('content')
<div class="card">
  
    
    <div class="card-body">

<h4> Terapeuta: {{$user->name}}</h4>

<br>
<h5> Desafios Ativos: {{count($user->challenges->where('status','RESPONDIDO'))}} </h5>
<br>
<h5> Chats Atrasados: {{count($user->chats()->where('chats.status', 'mae')->with('challenge')->where('challenges.status', 'RESPONDIDO')->get())}}</h5>
    </div>
    @stop