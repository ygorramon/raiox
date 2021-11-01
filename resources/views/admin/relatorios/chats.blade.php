@extends('adminlte::page')

@section('title', 'Todos os Chats')

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
                    <th>Nome da Mãe</th>
                    <th> Status do Desafio </th>
                    <th>Terapeuta</th>
                    <th>Última mensagem</th>
                    <th>Horário da última mensagem</th>
                  
                    <th>Diferença em Dias</th>

                  
                </tr>
            </thead>
            <tbody>
                @foreach ($chats as $chat)
                <tr>
                <td>{{ $chat->challenge->client->name }}</td>
                <td> @if($chat->challenge->status=='ANALISE')
                        <span class="badge bg-yellow">
                            {{ $chat->$challenge->status }}</span>
                            @endif
                            @if($chat->challenge->status=='ENVIADO')
                        <span class="badge bg-yellow">
                            {{ $chat->challenge->status }}</span>
                            @endif
                            @if($chat->challenge->status=='RESPONDIDO')
                        <span class="badge bg-green">
                            {{ $chat->challenge->status }} 
</span>

                            @endif
                            @if($chat->challenge->status=='FINALIZADO')
                        <span class="badge bg-blue">
                            {{ $chat->challenge->status }} 
</span>

                            @endif
                    <td>{{$chat->challenge->user->name ?? ''}}</td>
                    <td>@if($chat->status=='mae')  <span class="badge bg-yellow"> CLIENTE </span> @else  <span class="badge bg-green"> TERAPEUTA </span>@endif</td>
                    <td> {{formatDateAndTimeHours($chat->messages->last()->created_at)}}</td>
                    <td>@if($chat->status=='mae') {{diffDate($chat->messages->last()->created_at,now())}} 
                        @else
                        {{diffDate($chat->messages->where('type','1')->last()->created_at, $chat->messages->last()->created_at)}}
                        @endif</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>
@stop