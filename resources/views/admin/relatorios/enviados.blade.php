@extends('adminlte::page')

@section('title', 'Todos os Desafios')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Todos os Desafios</li>
</ol>

@stop

@section('content')
<div class="card">
  
    
    <div class="card-body">
        <table class="table table-condensed" id="table">
            <thead>
                <tr>
                    <th>Nome da Mãe</th>
                      <th>Email</th>
                    <th>Turma</th>
                    <th>Data de Envio</th>
                    <th>Terapeuta</th>

                    <th>Status</th>
                   <th>Ações</th>


                  
                  
                </tr>
            </thead>
            <tbody>
                @foreach ($challenges as $challenge)
                <tr>
                    <td>{{ $challenge->client->name }}</td>
                    <td>{{ $challenge->client->email }}</td>
                    <td>{{ $challenge->client->class }}</td>
                  <td> {{formatDateAndTimeHours($challenge->sended_at)}}</td>
                    <td>{{ $challenge->user->name ?? ''}}</td>

                    <td> @if($challenge->status=='ANALISE')
                        <span class="badge bg-yellow">
                            {{ $challenge->status }}</span>
                            @endif
                            @if($challenge->status=='ENVIADO')
                        <span class="badge bg-yellow">
                            {{ $challenge->status }}</span>
                            @endif
                            @if($challenge->status=='RESPONDIDO')
                        <span class="badge bg-green">
                            {{ $challenge->status }} 
</span>

                            @endif
                            @if($challenge->status=='FINALIZADO')
                        <span class="badge bg-blue">
                            {{ $challenge->status }} 
</span>

                            @endif
                    </td>
                   @if($challenge->status!='INICIADO')
                    <td><a class="btn btn-primary" href="{{route('challenge.meus.show', $challenge->id)}}"> Ver Desafio</a>
                    <a class="btn btn-warning" href="{{route('challenge.meus.respostas', $challenge->id)}}"> Ver Respostas</a>
                    @if(isset($challenge->chat))
                     <a class="btn btn-success" href="{{route('challenge.meus.chat', $challenge->id)}}"> Ver Chat</a>
                        @endif
                    </td>
                    @endif

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
       "paging":   true,
       "language": {
         
    "search":         "Filtrar: ",
  
       },
        "order": [[2 , "desc" ]]
    });
} );
</script>
@endsection
@stop