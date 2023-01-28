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
            <label>Ajustes Ritual do Bom dia:</label>
            <textarea class="materialize-textarea" id="conclusao_fome" name="conclusao_fome">{{$challenge->formulario()->first()->ajustes_ritual_bom_dia ?? ''}}
            </textarea>
        </div>
    </div>
    <div class="card-content row">
        <div class="col s12 m6 l6">
            <label>Ajustes do Despertar:</label>
            <textarea class="materialize-textarea" id="conclusao_dor"  name="conclusao_dor"> {{$challenge->formulario()->first()->ajustes_despertar ?? ''}}
             </textarea>
            
           
    
</div>
    </div>
<div class="card-content row">
<a href="{{route('Desafio.show',$challenge->id)}}" class="btn"> Voltar </a>
</div>
    </div>
    
</div>

@endsection