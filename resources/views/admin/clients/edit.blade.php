@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('clients.index') }}" class="active">Editar Cliente</a></li>
    </ol>

@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('clients.update', $client) }}" class="form" method="POST" enctype="multipart/form-data">
                 {{ method_field('PUT') }}
                @csrf

                <div class="form-group">
                    <label>* Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="Email:"
                        value="{{ $client->email ?? old('email') }}">
                </div>
                <div class="form-group">
                 
                   
                    <strong>Data da Compra: </strong> {{ \Carbon\Carbon::parse($client->created_at)->format('d/m/Y') }}
                </div>
                <div class="form-group">
                    <label>* Tempo de Expiração:</label>
                    <input type="date" name="expireAt" class="form-control"
                        value="{{ $client->expireAt ?? old('expireAt') }}">
                </div>
                <div class="form-group">
                    <label>* Nome:</label>
                    <input type="text" name="text" class="form-control" placeholder="Nome:"
                        value="{{ $client->name ?? old('name') }}">
                </div>
                <div class="form-group">
                    <label>* Nome do Bebê:</label>
                    <input type="text" name="babyName" class="form-control" placeholder="Nome do Bebê:"
                        value="{{ $client->nameBaby ?? old('nameBaby') }}">
                </div>
                <div class="form-group">
                    <label>* Sexo do Bebê:</label>
                    <input type="text" name="babySex" class="form-control" placeholder="Sexo do Bebê:"
                        value="{{ $client->sexBaby ?? old('sexBaby') }}">
                </div>
                <div class="form-group">
                    <label>* Nascimento do Bebê:</label>
                    <input type="date" name="birthBaby" class="form-control"
                        value="{{ $client->birthBaby ?? old('birthBaby') }}">
                </div>
                <div class="form-group">
                    <label>* Curso:</label>
                    <input type="text" name="class" class="form-control" value="{{ $client->class ?? old('class') }}">
                </div>
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input name="active" type="checkbox" class="custom-control-input" id="customSwitch3"
                        @if (isset($client) && $client->active == '1') checked @endif value="1">
                    <label class="custom-control-label" for="customSwitch3">Ativo</label>
                </div>

                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input name="liberado" type="checkbox" class="custom-control-input" id="customSwitch4"
                        @if (isset($client) && $client->liberado == '1') checked @endif value="1">
                    <label class="custom-control-label" for="customSwitch4">Liberado</label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark"> Enviar </button>
                </div>

            </form>
        </div>
    </div>
@endsection
