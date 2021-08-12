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
        <h3 class="card-title">Chat</h3>
    </div>
    @if($challenge->chat()->first()->status=='mae')
    @foreach($challenge->chat()->first()->messages as $message)
    @if($message->type==1)
    <label>Mãe:</label>
    <textarea class="form-control" readonly> {{$message->content}}</textarea>
   @endif
   @if($message->type==2)
    <label>Eu:</label>
    <textarea class="form-control" readonly> {{$message->content}}</textarea>
   @endif

    @endforeach
    <form action="{{route('challenge.meus.chat.store', $challenge->id)}}" method="POST">
        @csrf
        <label>Responder:</label>
        <textarea class="form-control" name="message"> </textarea>
        <button class="btn btn-primary" type="submit">Enviar</button>
    </form>
    @endif

    @if($challenge->chat()->first()->status=='odilo')
    @foreach($challenge->chat()->first()->messages as $message)
    @if($message->type==1)
    <label>Mãe:</label>
    <textarea class="form-control" readonly> {{$message->content}}</textarea>
    @endif
    @if($message->type==2)
    <label>Eu:</label>
    <textarea class="form-control" readonly> {{$message->content}}</textarea>
   @endif

    @endforeach
    @endif

</div>


@endsection