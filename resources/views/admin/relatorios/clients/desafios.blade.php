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
        <table class="table table-bordered ">
            <thead>
               
                <tr>
                    <th> Nº do Desafio</th>
                    <th>Nome da Mãe</th>
                     <th>Email</th>
                    <th>Status</th>
                    <th>Data do Envio</th>
                    <th>Data da Resposta</th>
                    <th>Terapeuta</th>
                    <th >Ações</th>
                </tr>
              
            </thead>
            <tbody>
                @foreach ($challenges as $challenge)
                <tr>
                    <td> {{$challenge->id}}</td>
                    <td>{{ $challenge->client->name }}</td>
                    <td>{{ $challenge->client->email }}</td>
                   @if($challenge->status=='INICIADO') <td><span class="badge bg-red">{{ $challenge->status }}</span></td>@endif
                   @if($challenge->status=='ENVIADO') <td><span class="badge bg-orange">{{ $challenge->status }}</span></td>@endif
                   @if($challenge->status=='ANALISE') <td><span class="badge bg-yellow">{{ $challenge->status }}</span></td>@endif
                   @if($challenge->status=='RESPONDIDO') <td><span class="badge bg-green">{{ $challenge->status }}</span></td>@endif
                   @if($challenge->status=='FINALIZADO') <td><span class="badge bg-blue">{{ $challenge->status }}</span></td>@endif
                    @if(isset($challenge->sended_at))
                    <td>{{ formatDateAndTimeHours($challenge->sended_at) }}</td>
                    @else
                    <td></td>
                    @endif
                     @if(isset($challenge->answered_at))
                    <td>{{ formatDateAndTimeHours($challenge->answered_at) }}</td>
                    @else
                    <td></td>
                    @endif
                    <td>{{ $challenge->user->name ?? '' }}</td>
                    @if($challenge->status!='INICIADO')
                    <td><a class="btn btn-primary" href="{{route('challenge.meus.show', $challenge->id)}}"> Ver Desafio</a>
                    <a class="btn btn-warning" href="{{route('challenge.meus.respostas', $challenge->id)}}"> Ver Respostas</a>
                    @if(isset($challenge->chat))
                     <a class="btn btn-success" href="{{route('challenge.meus.chat', $challenge->id)}}"> Ver Chat</a>
                        @endif
                    </td>
                    @endif

                   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop