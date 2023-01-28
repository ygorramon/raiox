@extends('site.Desafio.layouts.app')
@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
@stop



@section('content')
<form action="{{route('client.message.update', $message->id)}}" method="POST">
    @csrf
    {{ method_field('PUT') }}
    <div class="row">
        
       
            <div class="col s12">
            <div class="card card-tabs">
                <div class="card-content">
                    <div class="card-title">
                      <textarea class="materialize-textarea" name="content" required>{{$message->content}}</textarea>
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