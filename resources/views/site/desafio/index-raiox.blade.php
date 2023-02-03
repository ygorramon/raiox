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
                            <!--
                        <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Informação</h4>
      <p>O número do Suporte Técnico do desafio de 7 Dias mudou: </p>
      <p> 5588996620215</p>
      <a href="https://api.whatsapp.com/send?phone=5588996620215" target="_blank " class="btn"> Suporte Técnico </a>    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ok</a>
    </div>
  </div>
-->

                            <ul id="task-card" class="collection with-header animate fadeLeft">
                                <li class="collection-header red">
                                    <h5 class="task-card-title mb-3">Meus Raios X do Sono</h5>

                                </li>
                                <table class="bordered">
                                    <thead><th>Data do Raio X</th><th>Análise</th></thead>
                                @forelse ($raioxs as $key => $raiox)
                                <tr>
                               <td>{{formatDateAndTime($raiox->date)}}</td><td><a class="btn" href="{{route('raiox.analise',$raiox->id)}}">Acessar</a></td>
                                </tr>
                                @empty
                                </table>
                               
                                       
                               
                                </li>
                                @endforelse
 <a class="btn" href="{{route('raiox.create')}}"> Inicie um novo Raio X </a>
                             


                            </ul>
                            <div class="card-alert card purple lighten-5">
            <div class="card-content purple-text">
              <a href="https://api.whatsapp.com/send?phone=5588996620215" target="_blank " class="btn"> Suporte Técnico </a>
            </div>
          </div>
                        </div>

                    </div>
                    
                </div>




                @endsection
            </div>
            
        </div>
        
    </div>
    
</div>


@section('js')

<script>
$(document).ready(function(){
    $('.modal').modal({
       
    });
    $('#modal1').modal('open');
  });
  </script>

@endsection