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

   <table class="table table-bordered " id="table">
            <thead>
                <tr>
                   
                    <th>Terapeuta</th>
                    <th>Ações</th>
               </tr>
            </thead>
            <tbody> 
                 @foreach ($users as $user)
                 <tr><td>{{$user->name}}</td><td><a class="btn btn-primary" href="{{route('relatorios.users.show', $user->id)}}">Ver relatório</a></td></tr>
                 @endforeach
            </tbody>
   </table>
</div>
</div>
        @stop