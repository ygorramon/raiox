@extends('site.desafio.layouts.app')
@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
@stop
@section('content')
<div class="row">

    <div class="col s12">
<h5>AJUSTES - Passo 3 - Despertar</h5>
        <div class="card">
    <div class="card-content row">
        <div class="col s12 m6 l6">
            <label>Ajustes Gasto de Energia:</label>
            <textarea class="materialize-textarea" id="conclusao_fome" name="conclusao_fome">{{$challenge->formulario()->first()->gasto_energia_ajuste ?? ''}}
            </textarea>
        </div>
    </div>
    <div class="card-content row">
        <div class="col s12 m6 l6">
            <label>Ajustes Sinais de Sono:</label>
            <textarea class="materialize-textarea" id="conclusao_dor"  name="conclusao_dor"> {{$challenge->formulario()->first()->sinais_sono_ajuste ?? ''}}
             </textarea>
            
           
    
</div>
    </div>
    <div class="card-content row">
        <div class="col s12 m6 l6">
            <label>Ajustes Desacelerar:</label>
            <textarea class="materialize-textarea" id="conclusao_dor"  name="conclusao_dor"> {{$challenge->formulario()->first()->desacelerar_ajuste ?? ''}}
             </textarea>
            
           
    
</div>
    </div>
    <div class="card-content row">
        <div class="col s12 m6 l6">
            <label>Ajustes Ambiente - Luminosidade:</label>
            <textarea class="materialize-textarea" id="conclusao_dor"  name="conclusao_dor"> {{$challenge->formulario()->first()->ambiente_luz_ajuste ?? ''}}
             </textarea>
            
           
    
</div>
    </div>
    <div class="card-content row">
        <div class="col s12 m6 l6">
            <label>Ajustes Ambiente - Som:</label>
            <textarea class="materialize-textarea" id="conclusao_dor"  name="conclusao_dor"> {{$challenge->formulario()->first()->ambiente_som_ajuste ?? ''}}
             </textarea>
            
           
    
</div>
    </div>
    <div class="card-content row">
        <div class="col s12 m6 l6">
            <label>Ajustes Ambiente - Tempertatura:</label>
            <textarea class="materialize-textarea" id="conclusao_dor"  name="conclusao_dor"> {{$challenge->formulario()->first()->ambiente_temperatura_ajuste ?? ''}}
             </textarea>
            
           
    
</div>
    </div>
    <div class="card-content row">
        <div class="col s12 m6 l6">
            <label>Ajustes Ritual do Sono:</label>
            <textarea class="materialize-textarea" id="conclusao_dor"  name="conclusao_dor"> {{$challenge->formulario()->first()->ritual_sono_ajuste ?? ''}}
             </textarea>
            
           
    
</div>
    </div>
<div class="card-content row">
<a href="{{route('Desafio.show',$challenge->id)}}" class="btn"> Voltar </a>
</div>
    </div>
    
</div>

@endsection