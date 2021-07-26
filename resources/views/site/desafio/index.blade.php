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
                                    <h5 class="task-card-title mb-3">Meus Desafios</h5>

                                </li>
                                <table class="bordered">
                                    <thead><th>Desafio</th><th>Status</th><td>Ações</td></thead>
                                @forelse ($challenges as $key => $challenge)
                                
                                <td>{{$key+1}}</td><td>{{$challenge->status}}</td>
                                <td><a href="{{route('desafio.show',$challenge->id)}}" > <span class="task-cat red">Acessar</span></a></td>
                                @empty
                                </table>
                                <form action="{{route('desafio.store')}}" method="POST">
                                    @csrf
                                    <li class="collection-item dismissable">
                                        <button class="btn waves-effect waves-light " type="submit"> Inicie um novo desafio </submit>
                                </form>
                                </li>
                                @endforelse

                                @if(isset($latest_challenge) && $latest_challenge->status=='Finalizado')
                                <form action="{{route('desafio.store')}}" method="POST">
                                    @csrf
                                    <li class="collection-item dismissable">
                                        <button class="btn waves-effect waves-light " type="submit"> Inicie um novo desafio </submit>
                                    </li>
                                </form>
                                @endif


                            </ul>
                        </div>

                    </div>
                </div>





                @endsection
            </div>
        </div>
    </div>
</div>