@extends('adminlte::page')

@section('title', 'Relatórios Todos')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
</ol>

@stop

@section('content')
<div class="card">
<div class="card-header">
        <form action="{{route('relatorios.search')}}" method="POST" class="form form-inline">
            @csrf
            
            <input type="date" name="date_start" placeholder="Data de Início:" class="form-control">
            <input type="date" name="date_end" placeholder="Data de Fim:" class="form-control">

            <button type="submit" class="btn btn-dark">Filtrar</button> 
            @if(isset($request))
            <h4>Atividade de: {{formatDateAndTime($request['date_start']) ?? ''}} a {{formatDateAndTime($request['date_end']) ?? ''}}</h4>
            @endif
        </form>
    </div>
    <div class="card-body">
        
    <div class="col-12">
        <h5> Desafios Respondidos </h5>
        @foreach ($challenges as $key => $terapeuta)
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-clipboard"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">{{$key}} - {{$terapeuta->count()}}</span>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nome da Mãe</th>
                      <th>Nome do Bebê</th>
                      <th style="width: 40px">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($terapeuta as $desafio)
                    <tr>
                      <td>1.</td>
                      <td>{{$desafio->name}}</td>
                      <td>
                      {{$desafio->nameBaby}}
                      </td>
                      <td><a target="__blank" href="{{route('challenge.meus.respostas', $desafio->desafio_id)}}"><span class="badge bg-warning">Ver</span></a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.info-box-content -->
            </div>
        @endforeach
          
          </div>
          <div class="col-12">
        <h5> Chats Respondidos </h5>
        @foreach ($messages as $key => $terapeuta)
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{$key}}</span>
                <span class="info-box-number">{{$terapeuta->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
        @endforeach
          
          </div>
    <div class="card-footer">
       
    </div>
</div>

@stop