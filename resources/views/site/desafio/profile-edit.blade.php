@extends('site.Desafio.layouts.app')
@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
@stop



@section('content')
<form action="{{route('client.profile.update')}}" method="POST">
    @csrf
    {{ method_field('PUT') }}
    <div class="row">
        <div class="col s12">
            <div id="input-fields" class="card card-tabs">
            @if ($errors->any())
            <div class="row">
                <div class="col s12">
                    <div class="card-panel red">
                        <span class="white-text">
                            @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                            @endforeach</span>
                    </div>
                </div>
            </div>

            @endif
                <div class="card-content">
                    <div class="card-title">
                        <div class="row">
                            
                            <div class="col s12 m6 l10">
                                <h4 class="card-title"Meus Dados</h4>
                               Atualize seus dados:

                            </div>
                        </div>
                        <div class="row margin">
              <div class="input-field col s12">
                <i class="material-icons prefix pt-2">person_outline</i>
                <input id="name" type="text" name="name" class="validate" value="{{ old('name', $client->name) }}" required="">
                <label for="name" class="center-align">Nome da Mãe</label>
              </div>
            </div>
            <div class="row margin">
              <div class="input-field col s12">
                <i class="material-icons prefix pt-2">person_outline</i>
                <input id="nameBaby" type="text" name="nameBaby" value="{{ old('nameBaby', $client->nameBaby) }}" class="validate" required="">
                <label for="nameBaby" class="center-align">Nome do Bebê</label>
              </div>
            </div>
            <div class="row margin">
              <div class="input-field col s6">
                <i class="material-icons prefix pt-2">person_outline</i>
                <input id="birthBaby" type="text" name="birthBaby" class="datepicker" value="{{ old('birthBaby', formatDateAndTime($client->birthBaby)) }}" required="">
                <label for="birthBaby" class="center-align">Nascimento do Bebê</label>
              </div>

              <div class="col s6">
                <p>Sexo do Bebê</p>
                <p>
                  <label>
                    <input class="validate" required="" name="sexBaby" type="radio" {{ old('sexBaby', $client->sexBaby ) == 'M' ? "checked" : "" }}  value="M">
                    <span>Masculino</span>
                  </label>
                </p>

                <label>
                  <input class="validate" required="" name="sexBaby" type="radio" {{ old('sexBaby', $client->sexBaby ) == 'F' ? "checked" : "" }}  value="F">
                  <span>Feminino</span>
                </label>
               
              </div>     
            </div>
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

@section('js')
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy'
            });
        });
        </script>
            

@endsection