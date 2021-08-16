@extends('adminlte::page')

@section('title', 'Desafios disponiveis')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('challenge.meus.chats.abertos') }}" class="active">Chats Abertos</a></li>
</ol>

@stop

@section('content')
<div class="card">
    <div class="card-header">
        
    </div>
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome da Mãe</th>
                    <th>Nome do Bebê</th>
                   
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chats as $chat)
                <tr>
                    <td>{{ $chat->challenge->client->name }}</td>
                    <td>{{  $chat->challenge->client->nameBaby }}</td>
                   
                    <td>

                      
                        <a href="{{route('challenge.meus.chat',  $chat->challenge->id)}}" class="btn btn-warning">Chat</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $chats->appends($filters)->links() !!}
        @else
        {!! $chats->links() !!}
        @endif
    </div>
</div>
@stop