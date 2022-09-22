@extends('site.desafio.layouts.app')
@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
@stop
@section('content')
<div class="row">

    <div class="col s12">
<h5>AJUSTES - Passo 4</h5>
        <div class="card">
    <div class="card-content row">
        <div class="col s12 m6 l6">
            <label>PASSO 4:</label>
            <textarea class="materialize-textarea" id="conclusao_fome" name="conclusao_fome">Como esse é um tópico muito individual, as suas orientações virão em breve, de forma pessoal.



Em breve entraremos em contato com você, mas vou deixar mais um espaço para você escrever algu-ma informação adicional que considere relevante, dúvida ou individualidade do seu bebê.
Vamos juntos chegar à noite inteira de sono do seu bebê!

            </textarea>
        </div>
    </div>
   
<div class="card-content row">
<a href="{{route('desafio.show',$challenge->id)}}" class="btn"> Voltar </a>
</div>
    </div>
    
</div>

@endsection