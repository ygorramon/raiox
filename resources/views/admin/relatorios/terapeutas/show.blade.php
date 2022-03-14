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
        <table class="table table-condensed" id="table">
            <thead>
                <tr>
                    <th>Nome da Mãe</th>
                    <th>Nome do Bebê</th>
                     <th>Turma</th>
                     <th>Última mensagem</th>
                   <th>Diferença em Horas</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->challenges->where('status','RESPONDIDO') as $challenge)
                <tr>
                    <td>{{ $challenge->client->name }} <br>({{ $challenge->client->email}})</td>
                    <td>{{ $challenge->client->nameBaby }}</td>
                   <td>{{ $challenge->client->class }}</td>
                   @if(isset($challenge->chat))
                    <td>@if($challenge->chat->status=='mae')  <span class="badge bg-yellow"> CLIENTE </span> @else  <span class="badge bg-green"> TERAPEUTA </span>@endif</td>
                    <td>@if($challenge->chat->status=='mae')
                        @if(diffDate($challenge->chat->messages->last()->created_at,now()) < 24 )
                        <span class="badge bg-green">  {{diffDate($challenge->chat->messages->last()->created_at,now())}} </span>
                        @endif

                        @if(diffDate($challenge->chat->messages->last()->created_at,now()) >= 24 && diffDate($challenge->chat->messages->last()->created_at,now()) < 36)
                        <span class="badge bg-yellow">  {{diffDate($challenge->chat->messages->last()->created_at,now())}} </span>
                        @endif

                        @if(diffDate($challenge->chat->messages->last()->created_at,now()) >=36)
                        <span class="badge bg-red">  {{diffDate($challenge->chat->messages->last()->created_at,now())}} </span>
                        @endif

                        @else
                        @endif</td>
                    @else
                    <td></td> <td></td>
                    @endif
                    
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
@section ('js')
<script>
$(document).ready(function() {
    $('#table').DataTable({
       "paging":   false,
       "language": {
         
    "search":         "Filtrar: ",
  
       },
       "dom": '<"top"<f><"clear">',
        "order": [[ 4, "desc" ]]
    });
} );
</script>
@endsection
    @stop