@extends('adminlte::page')

@section('title', "Adicionar nova resposta")

@section('content_header')
    

    <h1>Responder</h1>
@stop

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Dados Pessoais</h3>
        </div>
        <div class="card-body">

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 ">
                        <label for="nomeMae">Nome da Mãe/Pai:</label>

                        <div>
                            <input type="text" readonly class="form-control" id="nomeMae"
                                value="{{ $doubt->client->name }}" placeholder="nomeMae">
                        </div>
                    </div>

                    <div class="col-md-4 ">
                        <label for="nomeMae">E-mail</label>

                        <div>
                            <input type="text" readonly class="form-control" id="nomeMae"
                                value="{{ $doubt->client->email }}" placeholder="nomeMae">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="nomeBebe">Nome do(a) Bebê:</label>

                        <div>
                            <input type="text" readonly class="form-control" id="nomeBebe"
                                value="{{ $doubt->client->nameBaby }}" placeholder="nomeMae">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 ">
                        <label for="nascimentoBebe">Data de Nascimento do Bebê:</label>

                        <div>
                            <input type="text" readonly class="form-control" id="nascimentoBebe"
                                value="{{ \Carbon\Carbon::parse($doubt->client->birthBaby)->format('d/m/Y') }}"
                                placeholder="nomeMae">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="idadeBebe">Idade do Bebê: (DIAS / MESES)</label>

                        <div>
                            <input type="text" readonly class="form-control" id="idadeBebe"
                                value="{{ now()->diffInDays(\Carbon\Carbon::parse($doubt->client->birthBaby)) }} / {{ now()->diffInMonths(\Carbon\Carbon::parse($doubt->client->birthBaby)) }}"
                                placeholder="nomeMae">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="sexoBebe">Sexo do Bebê:</label>

                        <div>
                            <input type="text" readonly class="form-control" id="sexoBebe"
                                value="{{ $doubt->client->sexBaby == 'M' ? 'MASCULINO' : 'FEMININO' }}"
                                placeholder="nomeMae">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Pergunta</h3>
        </div>
        <div class="card-body">
<h2>{{$doubt->query}}</h2>

        </div>
     </div>

     <div class="card card-info">
         <form action="{{route('duvidas.responder', $doubt->id)}}" method="POST">
    @csrf
    {{ method_field('PUT') }}
        <div class="card-header">
            <h3 class="card-title">Responder</h3>
        </div>
        <div class="card-body">
<textarea class="form-control" style="height:auto" name="resposta"></textarea>
<br>
 <button class="btn btn-primary" type="submit">Enviar</button>   
      </div>
         </form>
     </div>
@endsection