@extends('adminlte::page')

@section('title', 'Desafios disponiveis')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('challenge.availables') }}" class="active">Desafios Diponíveis</a></li>
</ol>

@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="#" method="POST" class="form form-inline">
            @csrf
            
        </form>
    </div>
    <div class="card-body">
        <table class="table table-condensed" id="table">
            <thead>
                <tr>
                    <th>Nome da Mãe</th>
                    <th>Nome do Bebê</th>
                      <th>Turma</th>
                    <th>Bonus</th>
                    <th>Status</th>
                    <th> Outros desafios </th>
                    <th>Ações</th> 
                </tr>
            </thead>
            <tbody>
                @foreach ($challenges as $challenge)
                <tr>
                    <td>{{ $challenge->client->name }}</td>
                    <td>{{ $challenge->client->nameBaby }}</td>
                    <td>{{ $challenge->client->class }}</td>
                    <td> @if($challenge->client->bonus=='1')
                    <span class="badge bg-green">   SIM </span>
                    @else <span class="badge bg-red">   NÃO </span> @endif
                    </td>
                    <td> @if($challenge->status=='ANALISE')
                        <span class="badge bg-yellow">
                            {{ $challenge->status }}</span>
                            @endif
                            @if($challenge->status=='RESPONDIDO')
                        <span class="badge bg-green">
                            {{ $challenge->status }} 
</span>
EM- {{formatDateAndTimeHours($challenge->answered_at)}}

                            @endif
                            @if($challenge->status=='FINALIZADO')
                        <span class="badge bg-green">
                            {{ $challenge->status }} 
</span>

                            @endif
                    </td>
                    <td> 
                    <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false"> <span class="badge bg-teal">{{$challenge->client->challenges()->count()}}</span>
                  
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                    @foreach($challenge->client->challenges()->where('status','RESPONDIDO')->get() as $challenge)      
                      <a class="dropdown-item" target="_blank" href="{{route('challenge.meus.respostas', $challenge->id)}}">{{formatDateAndTimeHours($challenge->sended_at)}} - {{$challenge->user->name}}</a>                  
                      @endforeach
                    </div>
                  </div>                  
                    </td>
                   
                    <td>

                        <a href="{{route('challenge.meus.show', $challenge->id)}}" class="btn btn-warning">VER</a>
                        @if($challenge->status=='ANALISE')
                        <a href="{{route('challenge.meus.responder', $challenge->id)}}" class="btn btn-warning">Responder</a>
                        @endif
                        @if($challenge->status=='RESPONDIDO')
                        <a href="{{route('challenge.meus.respostas', $challenge->id)}}" class="btn btn-warning">Respostas</a>
                        @endif
                        @if(isset($challenge->chat()->first()->id))
                        <a href="{{route('challenge.meus.chat', $challenge->id)}}" class="btn btn-warning">Chat</a>
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
       
        "order": [[4 , "desc" ]]
       
    });
} );
</script>
@endsection
@stop