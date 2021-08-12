@extends('adminlte::page')

@section('title', 'Desafios disponiveis')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('challenge.availables') }}" class="active">Desafios Diponíveis</a></li>
</ol>

@stop

@section('content')
<form action="{{route('challenge.meus.responder.update', $challenge->id)}}" method="POST">
    @csrf
    {{ method_field('PUT') }}
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Passo 1</h3>
        </div>
        <div class="card-body">
            <textarea name="passo1" class="form-control"></textarea>
        </div>
    </div>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Passo 2</h3>
        </div>
        <div class="card-body">
            <textarea name="passo2" class="form-control"></textarea>
        </div>
    </div>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Passo 3</h3>
        </div>
        <div class="card-header">
            <h3 class="card-title ">Despertar</h3>
        </div>
        <div class="card-body">
            <textarea name="passo3_despertar" class="form-control"></textarea>
        </div>
        <div class="card-header">
            <h3 class="card-title ">Rotina Alimentar</h3>
        </div>
        <div class="card-body">
            <textarea name="passo3_rotina_alimentar" class="form-control"></textarea>
        </div>
        <div class="card-header">
            <h3 class="card-title ">Rotina de Sonecas</h3>
        </div>
        <div class="card-body">
            <textarea name="passo3_rotina_sonecas" class="form-control"></textarea>
        </div>
        <div class="card-header">
            <h3 class="card-title ">Ambiente de Sonecas</h3>
        </div>
        <div class="card-body">
            <textarea name="passo3_ambiente_sonecas" class="form-control"></textarea>
        </div>
        <div class="card-header">
            <h3 class="card-title ">Sono Noturno</h3>
        </div>
        <div class="card-body">
            <textarea name="passo3_sono_noturno" class="form-control"></textarea>
        </div>
        <div class="card-header">
            <h3 class="card-title ">Ambiente de Sono Noturno</h3>
        </div>
        <div class="card-body">
            <textarea name="passo3_ambiente_noturno" class="form-control"></textarea>
        </div>
        
    </div>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Passo 4</h3>
        </div>
        <div class="card-header">
            <h3 class="card-title ">Associações de Sonecas</h3>
        </div>
        <div class="card-body">
            <textarea name="passo4_associacoes_sonecas" class="form-control"></textarea>
        </div>
        <div class="card-header">
            <h3 class="card-title ">Associações de Sono Noturno</h3>
        </div>
        <div class="card-body">
            <textarea name="passo4_associacoes_noturno" class="form-control"></textarea>
        </div>
        
        
    </div>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Conclusão</h3>
        </div>
        <div class="card-body">
            <textarea name="conclusao" class="form-control"></textarea>
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Enviar</button>
</form>
@endsection