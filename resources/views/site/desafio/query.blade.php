@extends('site.desafio.layouts.app')
@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
@stop



@section('content')
<form action="{{route('query.store')}}" method="POST">
    @csrf
    
    <div class="row">
        
       
            <div class="col s12">
            <div class="card card-tabs">
                <div class="card-content">
                    <div class="card-title">
                        <label> Faça uma pergunta </label>
                      <textarea class="materialize-textarea" name="pergunta" required></textarea>
                    </div>
                </div>
            </div>
        </div>
    
       
       
       
            <div class="col s12">
            <div id="input-fields" class="card card-tabs">
                <div class="card-content">
                    <div class="card-title">
                        <button class="btn" type="submit">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
</form>
@endsection

