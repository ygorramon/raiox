@extends('site.auth.layouts.app')
@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}"  media="screen,projection"/>
    @stop



@section('content')


<div class="row">
      <div class="col s12">
        <div class="container"><div id="login-page" class="row">
  <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
    <form class="login-form" method="POST" action="{{ url('/client/reset') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

      <div class="row">
        <div class="input-field col s12">
          <h5 class="ml-4">Recuperar Senha</h5>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="email" type="email" name="email">
          <label for="email" class="center-align">Email</label>
        </div>
      </div>
      <div class="row margin">
                <div class="input-field col s12">
                  <i class="material-icons prefix pt-2">lock_outline</i>
                  <input id="password" type="password" name="password" class="validate" required="">
                  <label for="password">Password</label>
                </div>
              </div>
              <div class="row margin">
                <div class="input-field col s12">
                  <i class="material-icons prefix pt-2">lock_outline</i>
                  <input id="password-again" type="password" name="password_confirmation" class="validate" required="">
                  <label for="password-again">Password again</label>
                </div>
              </div>
      <div class="row">
        <div class="input-field col s12">
        <button type="submit" class="btn waves-effect waves-light border-round  col s12">Resetar Senha</button>
           
        </div>
      </div>
      
    </form>
  </div>
</div>
        </div>
        <div class="content-overlay"></div>
    </div>
</div>
@endsection