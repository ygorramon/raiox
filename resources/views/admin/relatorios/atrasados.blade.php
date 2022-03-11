@extends('adminlte::page')

@section('title', 'Todos os Desafios')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Desafios Atrasados</li>
</ol>

@stop

@section('content')
<div class="card">
  
    
    <div class="card-body">
        <table class="table table-condensed" id="table">
            <thead>
                <tr>
                    <th>Nome da Mãe</th>
                    <th>Turma</th>
                    <th>Terapeuta</th>

                    <th>Status</th>

                    <th>Data de Envio</th>
                    <th>Data de Resposta</th>
                    <th>Diferença em Horas</th>

                  
                </tr>
            </thead>
            <tbody>
                @foreach ($challenges as $challenge)
                <tr>
                    <td>{{ $challenge->client->name }} <br>({{ $challenge->client->email}})</td>
                    <td>{{ $challenge->client->class }}</td>
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
                    <td> 
                    {{ formatDateAndTimeHours($challenge->sended_at) }}   
                    </td>
                    @if(isset($challenge->answered_at))
                    <td>
                    {{ formatDateAndTimeHours($challenge->answered_at) }}                          
                    </td>
                    @else
                    <td></td>
                    @endif
                    @if(diffDate($challenge->sended_at,$challenge->answered_at)<24)
                    <td><span class="badge bg-green">{{diffDate($challenge->sended_at,$challenge->answered_at)}}</span></td>
                    @endif
                    @if(diffDate($challenge->sended_at,$challenge->answered_at)>=24 && diffDate($challenge->sended_at,$challenge->answered_at)<48)
                    <td><span class="badge bg-yellow">{{diffDate($challenge->sended_at,$challenge->answered_at)}}</span></td>
                    @endif
                     @if(diffDate($challenge->sended_at,$challenge->answered_at)>=48)
                    <td><span class="badge bg-red">{{diffDate($challenge->sended_at,$challenge->answered_at)}}</span></td>
                    @endif
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
        "order": [[ 6, "desc" ]]
    });
} );
</script>
@endsection
@stop