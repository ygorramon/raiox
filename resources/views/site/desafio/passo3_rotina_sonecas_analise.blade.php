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
            <label>Ajustes Rotina de Sonecas:</label>
            <textarea class="materialize-textarea" id="conclusao_fome" name="conclusao_fome">{{$challenge->formulario()->first()->ajuste_rotina_sonecas ?? ''}}
            </textarea>
        </div>
    </div>
    <div class="card-content row">
        <div class="col s12 m6 l6">
            <label>Duração das Sonecas:</label>
            <textarea class="materialize-textarea" id="conclusao_dor"  name="conclusao_dor"> {{$challenge->formulario()->first()->ajuste_duracao_sonecas ?? ''}}
             </textarea>
            
           
    
</div>
    </div>
<div class="card-content row">
<a href="{{route('desafio.show',$challenge->id)}}" class="btn"> Voltar </a>
</div>
    </div>
    
</div>

@endsection