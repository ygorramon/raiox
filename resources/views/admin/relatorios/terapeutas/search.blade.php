@extends('adminlte::page')

@section('title', 'Todos os Desafios')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Terapeutas</li>
</ol>

@stop

@section('content')
<div class="card">
   <div class="card-header">
        <form action="{{route('relatorios.users.search')}}" method="POST" class="form form-inline">
            @csrf
           Filtrar por dia: 
            <input type="date" name="filter" placeholder="Filtrar:" class="form-control" value="{{ $date ?? '' }}">
            <button type="submit" class="btn btn-dark">Filtrar</button>
        </form>
    </div>
    
    <div class="card-body">

   <table class="table table-bordered " id="table">
            <thead>
                <tr>
                   
                    <th>Terapeuta</th>
                    <th>Desafios Ativos</th>
                    <th>Chats Atrasados</th>
                    <th>Desafios do dia {{formatDateAndTime($date)}}</th>
                    <th>Chats do dia {{formatDateAndTime($date)}}</th>

                    <th>Desafio</th>
               </tr>
            </thead>
            <tbody> 
                 @foreach ($users as $user)
                 <tr><td>{{$user->name}}</td>
                    <td> {{count($user->challenges->where('status','RESPONDIDO'))}} </td>
                    <td>{{count(
DB::table('chats')
                    
                    ->join('challenges', 'challenges.id', '=', 'chats.challenge_id')
                    ->join('users', 'users.id', '=', 'challenges.user_id')
                    ->select( 'chats.*')
                    
                    ->where('challenges.status','Respondido')
                    ->where('chats.status','mae')
                    ->where('users.id',$user->id)

                //    ->whereBetween('messages.created_at', ['2021-08-01',now()])
                    ->get())
                    }}
                    </td>
                    <td>{{count(DB::table('challenges')
           ->join('users','users.id','=','challenges.user_id')
           ->join('clients','clients.id','=','challenges.client_id')
           ->select('users.*','clients.*','challenges.*', 'users.name AS users_name', 'challenges.id as Desafio_id')
           ->where('users.id',$user->id)
->whereDate('answered_at', '=', $date)           ->get())}}</td>

 <td>{{count(DB::table('messages')
           ->join('chats', 'chats.id', '=', 'messages.chat_id')
           ->join('challenges', 'challenges.id', '=', 'chats.challenge_id')
           ->join('users', 'users.id', '=', 'challenges.user_id')
           ->select('users.name', 'chats.*')
           ->where('messages.type','2')
           ->where('users.id',$user->id)
           ->whereDate('messages.created_at', '=', $date)           ->get())}}</td>
                    <td><a class="btn btn-primary" href="{{route('relatorios.users.show', $user->id)}}">Desafios</a></td></tr>
                 @endforeach
            </tbody>
   </table>
</div>
</div>
        @stop