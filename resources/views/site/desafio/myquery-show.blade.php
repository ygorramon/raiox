@extends('site.desafio.layouts.app')
@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
@stop



@section('content')
<div class="row">
    <div class="col s12">
        <div class="container">
            <div class="section">
                <div id="card-widgets">
                    <div class="row">
                        <div class="col s12">
                      

                            <ul id="task-card" class="collection with-header animate fadeLeft">
                                <li class="collection-header red">
                                    <h5 class="task-card-title mb-3">Minhas Perguntas</h5>

                                </li>
            <div class="card card-tabs">
                <div class="card-content">
                    <div class="card-title">
                      
                      <labe> {{$doubt->query}}</labe>

                      <br>

                       <textarea class="materialize-textarea" required> {{$doubt->response}}</textarea>
                    </div>
                </div>
            </div>
        </div>
                    </div>
                </div>
            </div>
        </div>
    
       
       
       

@endsection

