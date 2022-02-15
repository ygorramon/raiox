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
    
    <div class="card-body">
        <table class="table table-condensed" id="table">
            <thead>
                <tr>
                    <th>Nome da Mãe</th>
                    <th>Nome do Bebê</th>
                   
                    <th>Última Mensagem</th>
                    <th>Horas de atraso</th>
                     <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chats as $chat)
                <tr>
                    <td>{{ $chat->challenge->client->name }}</td>
                    <td>{{  $chat->challenge->client->nameBaby }}</td>
                   <td> {{formatDateAndTimeHours($chat->messages->last()->created_at)}}</td>
                    <td>
@if(diffDate($chat->messages->last()->created_at,now()) < 24 )
                        <span class="badge bg-green">  {{diffDate($chat->messages->last()->created_at,now())}} </span>
                        @endif

                        @if(diffDate($chat->messages->last()->created_at,now()) >= 24 && diffDate($chat->messages->last()->created_at,now()) < 36)
                        <span class="badge bg-yellow">  {{diffDate($chat->messages->last()->created_at,now())}} </span>
                        @endif

                        @if(diffDate($chat->messages->last()->created_at,now()) >=36)
                        <span class="badge bg-red">  {{diffDate($chat->messages->last()->created_at,now())}} </span>
                        @endif
                    </td>
                    <td>
                      
                        <a href="{{route('challenge.meus.chat',  $chat->challenge->id)}}" class="btn btn-warning">Chat</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>
@section ('js')
<script>
$(document).ready(function() {
    $('#table').DataTable({
       "paging":   false,
       "language": {
         
    "search":         "Filtrar: ",
  
       },
       "dom": '<"top"<f><"clear">',
        "order": [[ 3, "desc" ]]
    });
} );
</script>
@endsection
@stop