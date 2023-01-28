@extends('adminlte::page')

@section('title', 'Desafios disponiveis')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
</ol>

@stop

@section('content')
    <form action="{{route('challenge.meus.messsage.update', $message->id)}}" method="POST">
  @csrf
    {{ method_field('PUT') }}
    <textarea class="form-control"  style="height:auto" name="content"> {{$message->content}}</textarea>
<button type="submit" class="btn btn-primary">   Enviar </button>
</form>
@stop