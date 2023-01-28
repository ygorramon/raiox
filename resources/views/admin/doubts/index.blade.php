@extends('adminlte::page')

@section('title', 'Desafios disponiveis')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('challenge.meus.chats.abertos') }}" class="active">Chats
                Abertos</a></li>
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
                        <th>Status</th>
                        <th>Pergunta</th>
                        <th>Data de Envio</th>
                        <th>Data de Resposta</th>
                        <th>Tempo de Atraso</th>
                          <th>Tempo de Atraso</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doubts as $doubt)
                        <tr>
                            <td>{{ $doubt->client->name }} <br>({{ $doubt->client->email }})</td>
                            <td>{{ $doubt->client->nameBaby }}</td>
                            <td>{{ $doubt->status }} <br> 
                            @if(isset($doubt->user))
                        {{$doubt->user->name}}
                        @endif</td>
                            <td> {{ $doubt->query }}</td>
                            
                            @if($doubt->status=='ENVIADO')
                            
                            <td> {{ formatDateAndTimeHours($doubt->created_at) }}</td>
                            <td></td>
                            <td>
                                @if (diffDate($doubt->created_at, now()) < 24)
                                    <span class="badge bg-green"> {{ diffDate($doubt->created_at, now()) }} </span>
                                @endif

                                @if (diffDate($doubt->created_at, now()) >= 24 && diffDate($doubt->created_at, now()) < 36)
                                    <span class="badge bg-yellow"> {{ diffDate($doubt->created_at, now()) }} </span>
                                @endif

                                @if (diffDate($doubt->created_at, now()) >= 36)
                                    <span class="badge bg-red"> {{ diffDate($doubt->created_at, now()) }} </span>
                                @endif
                            </td>
                          
                            <td>
                                <a href="{{ route('duvidas.show', $doubt->id) }}" class="btn btn-warning">Responder</a>

                            </td>
                            @endif
                            @if($doubt->status=='RESPONDIDO')
                           <td> {{ formatDateAndTimeHours($doubt->created_at) }}</td>  <td> {{  formatDateAndTimeHours($doubt->answared_at) }}</td>
                           <td> </td>  <td> <a href="{{ route('duvidas.show', $doubt->id) }}" class="btn btn-warning">Editar Resposta</a> </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@section('js')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "paging": false,
                "language": {

                    "search": "Filtrar: ",

                },
                "dom": '<"top"<f><"clear">',
                "order": [
                    [6, "desc"]
                ]
            });
        });
    </script>
@endsection
@stop
