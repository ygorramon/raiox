@extends('site.desafio.layouts.app')
@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
@stop
@section('content')
<div class="row">

    <div class="col s12">
<h5>AJUSTES - Passo 2</h5>
        <div class="card">
    <div class="card-content row">
        <div class="col s12 m6 l6">
            <label>Ajustes Fome:</label>
            <textarea class="materialize-textarea" id="conclusao_fome" name="conclusao_fome">{{$challenge->formulario()->first()->ajustes_fome ?? ''}}</textarea>
        </div>
    </div>
    <div class="card-content row">
        <div class="col s12 m6 l6">
            <label>Ajustes Dor:</label>
            <textarea class="materialize-textarea" id="conclusao_dor"  name="conclusao_dor"> {{$challenge->formulario()->first()->ajustes_dor ?? ''}} </textarea>
            
           @if($challenge->formulario()->first()->ajustes_dor_colica)
            <label>Ajustes Cólicas:</label>
           <textarea class="materialize-textarea" id="conclusao_dor_colica"  name="conclusao_dor_colica">{{$challenge->formulario()->first()->ajustes_dor_colica}}
        </textarea> 
        @endif
         @if($challenge->formulario()->first()->ajustes_dor_refluxo)
            <label>Ajustes Refluxo:</label>
            <textarea class="materialize-textarea" id="conclusao_dor_refluxo" name="conclusao_dor_refluxo">{{$challenge->formulario()->first()->ajustes_dor_refluxo}}</textarea>
           @endif
            @if($challenge->formulario()->first()->ajustes_dor_dentes)
            <label>Ajustes Dor de Dente:</label>
            <textarea class="materialize-textarea" id="conclusao_dor_dente" name="conclusao_dor_dente">{{$challenge->formulario()->first()->ajustes_dor_dentes}}</textarea>
       @endif
        </div>
    </div>
    <div class="card-content row">
        <div class="col s12 m6 l6">
            <label>Ajustes Salto:</label>
            <textarea class="materialize-textarea" id="conclusao_salto" name="conclusao_salto">{{$challenge->formulario()->first()->ajustes_salto}}</textarea>
        </div>
    </div>
    @if ($babyAge > 180 && $babyAge < 540) <div class="card-content row">
        <div class="col s12 m6 l6">
            <label>Ajustes Angustia da Separação:</label>
            <textarea class="materialize-textarea" id="conclusao_angustia" name="conclusao_angustia">{{$challenge->formulario()->first()->ajustes_angustia}}</textarea>
        </div>
</div>
@endif
<div class="card-content row">
    <div class="col s12 m6 l6">
        <label>Ajustes Telas:</label>
        <textarea class="materialize-textarea" id="conclusao_telas" name="conclusao_telas">{{$challenge->formulario()->first()->ajustes_telas}}</textarea>
    </div>
    
</div>
<div class="card-content row">
<a href="{{route('Desafio.show',$challenge->id)}}" class="btn"> Voltar </a>
</div>
    </div>
    
</div>

@endsection