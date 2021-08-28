@extends('adminlte::page')

@section('title', 'Todos os Desafios')

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
            <input type="text" name="filter" placeholder="Filtrar:" class="form-control" value="{{ $filters['filter'] ?? '' }}">
            <button type="submit" class="btn btn-dark">Filtrar</button>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome da Mãe</th>
                    <th>Terapeuta</th>

                    <th>Status</th>

                    <th>Data de Envio</th>
                    <th>Data de Resposta</th>
                    <th>Diferença em Dias</th>

                  
                </tr>
            </thead>
            <tbody>
                @foreach ($challenges as $challenge)
                <tr>
                    <td>{{ $challenge->client->name }}</td>
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
                    </td>
                    <td> 
                    {{ formatDateAndTimeHours($challenge->sended_at) }}   
                    </td>
                    <td>
                    {{ formatDateAndTimeHours($challenge->answered_at) }}                          
                    </td>
                    <td>{{diffDate($challenge->sended_at,$challenge->answered_at)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>
@stop