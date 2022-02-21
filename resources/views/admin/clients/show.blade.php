@extends('adminlte::page')

@section('title', "Detalhes do Cliente {$client->name}")

@section('content_header')
    <h1>Detalhes do Cliente <b>{{ $client->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Email: </strong> {{ $client->email }}
                </li>
                 <li>
                    <strong>Turma: </strong>  {{ $client->class }}
                </li>
                
                <li>
                    <strong>Expira em : </strong> {{ \Carbon\Carbon::parse($client->expireAt)->format('d/m/Y') }}
                </li>
                <li>
                    <strong>Nome da Mãe: </strong> {{ $client->name }}
                </li>
                <li>
                    <strong>Nome do Bebê: </strong> {{ $client->nameBaby }}
                </li>
                <li>
                    <strong>Sexo do Bebê: </strong> {{ $client->sexBaby }}
                </li>
                <li>
                    <strong>Data de Nascimento do Bebê: </strong> @if(!$client->birthBaby==Null) {{ 
                         \Carbon\Carbon::parse($client->birthBaby)->format('d/m/Y')
                         }}
                         @endif
                </li>
            </ul>


            <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> DELETAR o Cliente {{ $client->email }}</button>
            </form>
        </div>
    </div>
@endsection