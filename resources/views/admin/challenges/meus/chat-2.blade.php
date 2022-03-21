@extends('adminlte::page')

@section('title', 'Desafios disponiveis')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('challenge.availables') }}" class="active">Desafios Diponíveis</a></li>
</ol>

@stop

@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Chat </h3>

    </div>
    
    <a class="btn-lg btn-warning" href="{{route('challenge.meus.respostas2', $challenge->id)}}" target="__blank">Respostas do desafio </a>
    <a class="btn-lg btn-warning" href="{{route('challenge.meus.show', $challenge->id)}}" target="__blank">Desafio  </a>

    @if($challenge->chat()->first()->status=='mae')
    @foreach($challenge->chat()->first()->messages as $message)
    @if($message->type==1)
    <label>Mãe ({{$challenge->client->name}}) / E-mail ({{$challenge->client->email}}) / Bebê ({{$challenge->client->nameBaby}}):  em - {{formatDateAndTimeHours($message->created_at)}} </label>
    <textarea class="form-control" style="background-color: green;color:#fff;height:auto" readonly > {{$message->content}}</textarea>
   @endif
   @if($message->type==2)
    <label>Eu:  em - {{formatDateAndTimeHours($message->created_at)}}</label>
    <textarea class="form-control"  style="height:auto" readonly> {{$message->content}}</textarea>
   @endif

    @endforeach
    <form action="{{route('challenge.meus.chat.store', $challenge->id)}}" method="POST">
        @csrf
        <label>Responder:</label>
        <textarea class="form-control" name="message" style="height:auto"> </textarea>
        <button class="btn btn-primary" type="submit">Enviar</button>
    </form>
    @endif

    @if($challenge->chat()->first()->status=='odilo')
    @foreach($challenge->chat()->first()->messages as $message)
    @if($message->type==1)
    <label>Mãe: ({{$challenge->client->name}})  / Bebê ({{$challenge->client->nameBaby}}): em - {{formatDateAndTimeHours($message->created_at)}}</label>
    <textarea class="form-control"  style="background-color: green;color:#fff;height:auto" readonly > {{$message->content}}</textarea>
    @endif
    @if($message->type==2)
    <label>Eu:  em - {{formatDateAndTimeHours($message->created_at)}}</label>
    <textarea class="form-control"   style="height:auto" readonly > {{$message->content}}</textarea>
   @endif

    @endforeach
    <div class="row">
      
                <a href="{{route('challenge.meus.message.edit',$challenge->chat()->first()->messages->last()->id)}}" class="btn btn-primary" >Editar última mensagem</a>
       
    </div>

    <form action="{{route('challenge.meus.chat.store', $challenge->id)}}" method="POST">
        @csrf
        <label>Responder:</label>
        <textarea class="form-control" name="message" style="height:auto"> </textarea>
        <button class="btn btn-primary" type="submit">Enviar</button>
    </form>

    @endif

</div>
@section('js')
<script>
    $(document).ready(function() {
        $(".form-control").overlayScrollbars({

            textarea: {
                dynHeight: true,
                
            }

        });
    });
</script>
@stop

@endsection