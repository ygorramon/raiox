@extends('adminlte::page')

@section('title', 'Desafios disponiveis')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('challenge.availables') }}" class="active">Desafios Diponíveis</a></li>
</ol>

@stop

@section('content')

<form action="{{route('challenge.meus.responder.update', $challenge->id)}}" method="POST">
    @csrf
    {{ method_field('PUT') }}
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Passo 1</h3>

        </div>
        <div class="card-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-4 ">
                    <label for="nomeMae">Nome da Mãe/Pai:</label>

                    <div>
                        <input type="text" readonly class="form-control" id="nomeMae" value="{{$challenge->client->name}}" placeholder="nomeMae">
                    </div>
                </div>
                <div class="col-md-4 ">
                    <label for="nomeMae">E-mail</label>

                    <div>
                        <input type="text" readonly class="form-control" id="nomeMae" value="{{$challenge->client->email}}" placeholder="nomeMae">
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="nomeBebe">Nome do(a) Bebê:</label>

                    <div>
                        <input type="text" readonly class="form-control" id="nomeBebe" value="{{$challenge->client->nameBaby}}" placeholder="nomeMae">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 ">
                    <label for="nascimentoBebe">Data de Nascimento do Bebê:</label>

                    <div>
                        <input type="text" readonly class="form-control" id="nascimentoBebe" value="{{\Carbon\Carbon::parse($challenge->client->birthBaby)->format('d/m/Y')}}" placeholder="nomeMae">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="idadeBebe">Idade do Bebê: (DIAS / MESES)</label>

                    <div>
                        <input type="text" readonly class="form-control" id="idadeBebe" value="{{now()->diffInDays(\Carbon\Carbon::parse($challenge->client->birthBaby))}} / {{now()->diffInMonths(\Carbon\Carbon::parse($challenge->client->birthBaby))}}" placeholder="nomeMae">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="sexoBebe">Sexo do Bebê:</label>

                    <div>
                        <input type="text" readonly class="form-control" id="sexoBebe" value="{{$challenge->client->sexBaby == 'M' ? "MASCULINO" : "FEMININO"}}" placeholder="nomeMae">
                    </div>
                </div>
                
            </div>
            
        </div>
            <textarea name="passo1" class="form-control" style="height:auto">
           {{$challenge->passo1}}
        </textarea>
        </div>
    </div>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Passo 2</h3>
        </div>
        <div class="card-body">
        <div>
                        <label for="ritualBomDia">Causa dos Despertares:</label>
                        @if($challenge->form->conclusionImmaturity=='S')
                        <span class="badge bg-green">Imaturidade</span>
                        
                        @endif

                        @if($challenge->form->conclusionHungry=='S')
                        <span class="badge bg-green">Fome</span>
                        
                        @endif
                        @if($challenge->form->conclusionAche=='S')
                        <span class="badge bg-green">Dor</span>
                       
                        @endif
                        @if($challenge->form->conclusionJump=='S')
                        <span class="badge bg-green">Salto de Desenvolvimento</span>
                        
                        @endif

                        @if($challenge->form->conclusionAnguish=='S')
                        <span class="badge bg-green">Angústia da Separação</span>
                        
                        @endif
                        @if($challenge->form->conclusionScreens=='S')
                        <span class="badge bg-green">Telas</span>
                        
                        @endif
                        @if($challenge->form->conclusionScreens=='S')
                        <span class="badge bg-green">Estresse excessivo</span>
                        
                        @endif
                        Idade do Bebê: <span class="badge bg-green">{{now()->diffInMonths(\Carbon\Carbon::parse($challenge->client->birthBaby))}} MESES</span>
                        <div>
                        <label for="ritualBomDia">Ganho de Peso:</label>
                        @if(is_numeric($challenge->form->weightGain ))
                        <span class="badge bg-green">{{$challenge->form->weightGain}}</span>
                        @else
                        <span class="badge bg-red">Não Sabe ou Perdeu Peso</span>
                        @endif
                    </div>
                </div>
                       


                    </div>
            <textarea name="passo2" class="form-control"  style="height:auto">
            {{$challenge->passo2}}
</textarea>
            
        </div>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Passo 3</h3>
        </div>
        <div class="card-header">
            <h3 class="card-title ">Despertar</h3>
        </div>
        <div class="card-body">
        <div>
                       
                        <div class="row">
                <div class="col-md-3 ">


                    <div>
                        <label for="ritualBomDia">Ritual do Bom dia:</label>
                        @if($challenge->form->ritualGoodMorning=='S' )
                        <span class="badge bg-green">SIM</span>
                        @else
                        <span class="badge bg-red">NÃO</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-2 ">


                    <div>
                        <label for="ritualBomDia">Ritual -Luzes:</label>
                        @if($challenge->form->ritualGoodMorningLight=='S' )
                        <span class="badge bg-green">SIM</span>
                        @else
                        <span class="badge bg-red">NÃO</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-2 ">


                    <div>
                        <label for="ritualBomDia">Ritual-Ruídos:</label>
                        @if($challenge->form->ritualGoodMorningNoise=='S' )
                        <span class="badge bg-green">SIM</span>
                        @else
                        <span class="badge bg-red">NÃO</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-2 ">


                    <div>
                        <label for="ritualBomDia">Ritual-Estímulos:</label>
                        @if($challenge->form->ritualGoodMorningStimulus=='S' )
                        <span class="badge bg-green">SIM</span>
                        @else
                        <span class="badge bg-red">NÃO</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-2 ">


                    <div>
                        <label for="ritualBomDia">Ritual-Remove:</label>
                        @if($challenge->form->ritualGoodMorningRemove=='S' )
                        <span class="badge bg-green">SIM</span>
                        @else
                        <span class="badge bg-red">NÃO</span>
                        @endif
                    </div>
                </div>

            </div>
            <textarea name="passo3_despertar" class="form-control" style="height:auto" >
          {{$challenge->passo3_despertar}}
            </textarea>
        </div>
        
            
        </div>
        <div class="card-header">
            <h3 class="card-title ">Rotina Alimentar</h3>
        </div>
        <div class="card-body">
            <textarea name="passo3_rotina_alimentar" class="form-control" style="height:auto">
            {{$challenge->passo3_rotina_alimentar}}

            </textarea>
        </div>
        <div class="card-header">
            <h3 class="card-title ">Rotina de Sonecas</h3>
        </div>
        <div class="card-body">
            <textarea name="passo3_rotina_sonecas" class="form-control" style="height:auto">
            {{$challenge->passo3_rotina_sonecas}}

            </textarea>
        </div>
        <div class="card-header">
            <h3 class="card-title ">Ambiente de Sonecas</h3>
        </div>
        <div class="card-body">
            <textarea name="passo3_ambiente_sonecas" class="form-control" style="height:auto">
            {{$challenge->passo3_ambiente_sonecas}}

            </textarea>
        </div>
        <div class="card-header">
            <h3 class="card-title ">Sono Noturno</h3>
        </div>
        <div class="card-body">
            <textarea name="passo3_sono_noturno" class="form-control" style="height:auto">
            {{$challenge->passo3_sono_noturno}}

            </textarea>
        </div>
        <div class="card-header">
            <h3 class="card-title ">Ambiente de Sono Noturno</h3>
        </div>
        <div class="card-body">
            <textarea name="passo3_ambiente_noturno" class="form-control" style="height:auto">
            {{$challenge->passo3_ambiente_noturno}}
            </textarea>
        </div>

    </div>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Passo 4</h3>
        </div>
        <div class="card-header">
            <h3 class="card-title ">Associações de Sonecas</h3>
        </div>
        <div class="card-body">
            <textarea name="passo4_associacoes_sonecas" class="form-control" style="height:auto">
            {{$challenge->passo4_associacoes_sonecas}}
            </textarea>

        </div>
        <div class="card-header">
            <h3 class="card-title ">Associações de Sono Noturno</h3>
        </div>
        <div class="card-body">
            <textarea name="passo4_associacoes_noturno" class="form-control" style="height:auto">
            {{$challenge->passo4_associacoes_noturno}}
</textarea>
        </div>


    </div>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Conclusão</h3>
        </div>
        <div class="card-body">
            <textarea name="conclusao" class="form-control">
            {{$challenge->conclusao}}

            </textarea>
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Enviar</button>
</form>
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