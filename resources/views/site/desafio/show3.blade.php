@extends('site.desafio.layouts.app')
@section('css')
<link type="text/css" rel="stylesheet" href="{{  asset('css/login.css')  }}" media="screen,projection" />
@stop



@section('content')
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h5>Informações Importantes</h5>
            <h6>1 - Preencha o desafio de 7 dias diariamente</h6>
            <h6>2 - A plataforma libera 1 dia por dia</h6>
            <h6>3 - Preencha os 7 dias de rotina, após isso preencha os dados dos passos 2, 3 e 4</h6>
            <h6>4 - Após Finalizar o Desafio de 7 dias, GERALMENTE, em até 7 dias o dr Odilo analisará em vídeo seu desafio.
            </h6>
            <h6>5 - Sua análise em vídeo, bem como vídeos adicionais, ficarão disponíveis nessa plataforma.</h6>


        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
        </div>
    </div>
    <div class="row">
        <div class="col  s12">
            <div class="container">
                <div class="section">
                    <div class="card-alert">
                        <div class="card-content  purple-text">
                            <a href="https://api.whatsapp.com/send?phone=5588996620215" target="_blank  " class="btn">
                                Suporte Técnico</a>


                        </div>

                    </div>
                    <div id="modal-confirm" class="modal">
                        <div class="modal-content">
                            <h4>Confirmação</h4>
                            <p>Você está prestes a desistir do desafio.
                                Esta operação <b>não pode ser revertida</b>.
                                Tem certeza que deseja continuar?</p>
                        </div>
                        <div class="modal-footer">
                            <form id="form-desistir" action="{{ route('desafio.abortado', $challenge->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                {{ method_field('PUT') }}
                                <button type="submit" class="btn red">Sim, desistir</button>
                            </form>
                            <a href="#!" class="modal-close btn grey">Cancelar</a>
                        </div>
                    </div>
                    <a class="btn red modal-trigger" href="#modal-confirm">Desistir do Desafio</a>


                    <div id="card-widgets">
                        <div class="row">
                            <div class="col  s12">

                                <div id="bordered-table" class="card  card  card-default  scrollspy">
                                    <div class="card-content">


                                        @if  ($challenge->status == 'ANALISE')
                                            <div class="row">
                                                <div class="col  s12">
                                                    <h4 class="card-title">O Dr. Odilo está analisando seu Desafio! </h4>
                                                </div>
                                                <div class="col  s12">
                                                    <h4 class="card-title">Em breve você receberá a análise! </h4>
                                                </div>

                                            </div>
                                        @endif


                                        @if  ($challenge->status == 'RESPONDIDO')
                                            <div class="card">
                                                <div class="card-content">
                                                    <span class="card-title"> Análises</span>
                                                    <a href="{{  route('analyze.passo2_analise', $challenge->id)  }}"
                                                        class="btn  waves-effect  waves-light  red  "> Análise Passo 2
                                                    </a><br><br>
                                                    <a href="{{  route('analyze.passo3_despertar.analise', $challenge->id)  }}"
                                                        class="btn  waves-effect  waves-light  red  "> Análise Passo 3 -
                                                        Despertar </a><br><br>
                                                    <a href="{{  route('analyze.passo3_rotina_sonecas.analise', $challenge->id)  }}"
                                                        class="btn  waves-effect  waves-light  red  ">
                                                        Análise Passo 3 - Rotina </a><br><br>
                                                    <a href="{{  route('analyze.passo3_pilares.analise', $challenge->id)  }}"
                                                        class="btn  waves-effect  waves-light  red  "> Passo 3 - PILARES
                                                    </a><br><br>
                                                    <a href="{{  route('analyze.passo4.analise', $challenge->id)  }}"
                                                        class="btn  waves-effect  waves-light  red  "> Análise do Passo 4
                                                    </a><br><br>
                                                    <a href="{{  route('analyze.conclusao', $challenge->id)  }}"
                                                        class="btn  waves-effect  waves-light  red  "> Conclusão </a><br>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-content">
                                                    <span class="card-title"> INFORMAÇÕES SOBRE O CHAT</span>



                                                    <p> O CHAT abaixo ficará disponível por 60 Dias após a resposta do seu
                                                        Desafio!</p>
                                                    <p> Você só pode colocar uma mensagem até o dr Odilo responder.</p>
                                                    <p> Esse CHAT finalizará no dia
                                                        {{  \Carbon\Carbon::parse($challenge->answered_at)->addDays(59)->format('d/m/y')  }}
                                                    </p>
                                                    <p> Restam
                                                        {{  \Carbon\Carbon::parse($challenge->answered_at)->addDays(59)->diffInDays(now())  }}</b>
                                                        Dias de Chat
                                                    </p>
                                                    <p> Após esse prazo, você poderá realizar um novo Desafio </p>
                                                </div>
                                            </div>


                                            <ul class="collapsible">
                                                <li>
                                                    <div class="collapsible-header"><i class="material-icons">message</i>Chat
                                                    </div>
                                                    <div class="collapsible-body">
                                                        @if  ($challenge->chat()->first() == null)
                                                            Envie uma mensagem ao Dr. Odilo Queiroz sobre seu Desafio!
                                                            <form action="{{  route('challenge.chat.store', $challenge->id)  }}"
                                                                method="POST">
                                                                @csrf
                                                                <label>Responder:</label>
                                                                <textarea class="materialize-textarea" name="message"></textarea>
                                                                <button class="btn  btn-primary">Enviar </button>
                                                            </form>
                                                        @endif
                                                        @if  ($challenge->chat()->first() != null)
                                                            @if  ($challenge->chat()->first()->status == 'mae')
                                                                @foreach  ($challenge->chat()->first()->messages as $message)
                                                                    @if  ($message->type == 1)
                                                                        <label>Eu:</label>
                                                                        <textarea class="materialize-textarea"
                                                                            readonly>  {{  $message->content  }}</textarea>
                                                                    @endif
                                                                    @if  ($message->type == 2)
                                                                        <label>Dr. Odilo:</label>
                                                                        <textarea class="materialize-textarea"
                                                                            readonly>  {{  $message->content  }}</textarea>
                                                                    @endif
                                                                @endforeach

                                                                Aguarde o retorno do Dr. Odilo!
                                                                <br>
                                                                <a class="btn  btn-primary"
                                                                    href="{{  route('client.message.edit', $challenge->chat()->first()->messages->last()->id)  }}">Editar
                                                                    última mensagem</a><br>
                                                            @endif


                                                            @if  ($challenge->chat()->first()->status == 'odilo')
                                                                @foreach  ($challenge->chat()->first()->messages as $message)
                                                                    @if  ($message->type == 1)
                                                                        <label>Eu:</label>
                                                                        <textarea class="materialize-textarea"
                                                                            readonly>  {{  $message->content  }}</textarea>
                                                                    @endif
                                                                    @if  ($message->type == 2)
                                                                        <label>Dr. Odilo:</label>
                                                                        <textarea class="materialize-textarea"
                                                                            readonly>  {{  $message->content  }}</textarea>
                                                                    @endif
                                                                @endforeach
                                                                <form action="{{  route('challenge.chat.store', $challenge->id)  }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <label>Responder:</label>
                                                                    <textarea class="materialize-textarea" name="message"
                                                                        required></textarea>
                                                                    <button class="btn  btn-primary">Enviar </button>
                                                                </form>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </li>

                                            </ul>
                                        @endif
                                    </div>


                                    @if  ($challenge->client->liberado == 1)
                                        @if  ($challenge->status == 'INICIADO' || $challenge->status == 'FINALIZADO')
                                                                            <h4 class="card-title">Análise Diária</h4>

                                                                            <div class="row">
                                                                                <div class="col  s12">
                                                                                </div>
                                                                                <div class="col  s12">
                                                                                    <table class="bordered">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th data-field="dia">Dia / Formulário</th>

                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                @if  (
            !isset(
            $challenge->analyzes()->where('day', '1')->first()->date
        )
        )
                                                                                                                    <td><a href="{{  route('analyze.create', [$challenge->id, 1])  }}"
                                                                                                                            class="btn  waves-effect  waves-light  red  "> Dia
                                                                                                                            1 </a>
                                                                                                    </div>
                                                                                                @else
                                                                                        <td><a href="{{  route('analyze.edit', [$challenge->id, 1])  }}"
                                                                                                class="btn  waves-effect  waves-light  red  "> Dia 1 </a>
                                                                                    </div>
                                                                                @endif

                                                                            @if  (
            isset(
            $challenge->analyzes()->where('day', '1')->first()->date
        )
        )

                                                                            @else

                                                                            @endif
                                                                            </tr>

                                                                            @if  (
            isset(
            $challenge->analyzes()->where('day', '1')->first()->date
        )
        )
                                                                                        <tr>
                                                                                            @if  (
                !isset(
                $challenge->analyzes()->where('day', '2')->first()->date
            )
            )
                                                                                                        <td><a href="{{  route('analyze.create', [$challenge->id, 2])  }}"
                                                                                                                class="btn  waves-effect  waves-light  red  "> Dia 2 </a>
                                                                                                </div>
                                                                                            @else
                                                                                            <td><a href="{{  route('analyze.edit', [$challenge->id, 2])  }}"
                                                                                                    class="btn  waves-effect  waves-light  red  "> Dia 2 </a>
                                                                                        </div>
                                                                                    @endif


                                                                                @if  (
                isset(
                $challenge->analyzes()->where('day', '2')->first()->date
            )
            )

                                                                                @else
                                                                                @endif
                                                                            @else
                                                                    @endif
                                                                    </tr>



                                                                    @if  (
            isset(
            $challenge->analyzes()->where('day', '2')->first()->date
        )
        )
                                                                                <tr>
                                                                                    @if  (
                !isset(
                $challenge->analyzes()->where('day', '3')->first()->date
            )
            )
                                                                                                <td><a href="{{  route('analyze.create', [$challenge->id, 3])  }}"
                                                                                                        class="btn  waves-effect  waves-light  red  "> Dia 3 </a>
                                                                                        </div>
                                                                                    @else
                                                                                    <td><a href="{{  route('analyze.edit', [$challenge->id, 3])  }}"
                                                                                            class="btn  waves-effect  waves-light  red  "> Dia 3 </a>
                                                                                </div>
                                                                            @endif


                                                                        @if  (
                isset(
                $challenge->analyzes()->where('day', '3')->first()->date
            )
            )

                                                                        @else
                                                                        @endif
                                                                    @else
                                                            @endif
                                                            </tr>


                                                            @if  (
            isset(
            $challenge->analyzes()->where('day', '3')->first()->date
        )
        )
                                                                        <tr>
                                                                            @if  (
                !isset(
                $challenge->analyzes()->where('day', '4')->first()->date
            )
            )
                                                                                        <td><a href="{{  route('analyze.create', [$challenge->id, 4])  }}"
                                                                                                class="btn  waves-effect  waves-light  red  "> Dia 4 </a>
                                                                                </div>
                                                                            @else
                                                                            <td><a href="{{  route('analyze.edit', [$challenge->id, 4])  }}"
                                                                                    class="btn  waves-effect  waves-light  red  ">
                                                                                    Dia 4 </a>
                                                                        </div>
                                                                    @endif

                                                                @if  (
                isset(
                $challenge->analyzes()->where('day', '4')->first()->date
            )
            )

                                                                @else
                                                                @endif
                                                            @else
                                                    @endif
                                                    </tr>


                                                    @if  (
            isset(
            $challenge->analyzes()->where('day', '4')->first()->date
        )
        )
                                                                <tr>


                                                                    @if  (
                !isset(
                $challenge->analyzes()->where('day', '5')->first()->date
            )
            )
                                                                                <td><a href="{{  route('analyze.create', [$challenge->id, 5])  }}"
                                                                                        class="btn  waves-effect  waves-light  red  ">
                                                                                        Dia 5 </a>
                                                                        </div>
                                                                    @else
                                                                    <td><a href="{{  route('analyze.edit', [$challenge->id, 5])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                            Dia 5
                                                                        </a>
                                                                </div>
                                                            @endif


                                                        @if  (
                isset(
                $challenge->analyzes()->where('day', '5')->first()->date
            )
            )

                                                        @else
                                                        @endif
                                                    @else
                                            @endif
                                            </tr>


                                            @if  (
            isset(
            $challenge->analyzes()->where('day', '5')->first()->date
        )
        )
                                                <tr>
                                                    @if  (
                !isset(
                $challenge->analyzes()->where('day', '6')->first()->date
            )
            )
                                                        <td><a href="{{  route('analyze.create', [$challenge->id, 6])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                Dia 6 </a>
                                                            </div>
                                                    @else
                                                            <td><a href="{{  route('analyze.edit', [$challenge->id, 6])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                    Dia 6 </a> </div>
                                                        @endif
                                                        @if  (
                isset(
                $challenge->analyzes()->where('day', '6')->first()->date
            )
            )

                                                        @else
                                                        @endif
                                            @else
                                                    @endif
                                            </tr>


                                            @if  (
            isset(
            $challenge->analyzes()->where('day', '6')->first()->date
        )
        )
                                                <tr>

                                                    @if  (
                !isset(
                $challenge->analyzes()->where('day', '7')->first()->date
            )
            )
                                                        <td><a href="{{  route('analyze.create', [$challenge->id, 7])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                Dia 7 </a>
                                                            </div>
                                                    @else
                                                            <td><a href="{{  route('analyze.edit', [$challenge->id, 7])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                    Dia 7 </a> </div>
                                                        @endif
                                                        @if  (
                isset(
                $challenge->analyzes()->where('day', '7')->first()->date
            )
            )

                                                        @else
                                                        @endif
                                            @else
                                                    @endif
                                            </tr>


                                            @if  (
            isset(
            $challenge->analyzes()->where('day', '7')->first()->date
        )
        )
                                                <tr>


                                                    @if  (!isset($challenge->formulario()->first()->id))
                                                            <td>
                                                                <a href="{{  route('analyze.passo2', $challenge->id)  }}" class="btn  waves-effect  waves-light  red  ">
                                                                    Passo 2 </a>
                                                            </td>
                                                            <td>NÃO</td>
                                                        </tr>
                                                    @else
                                                    <td> PASSO 2 </td>
                                                    <td> <a href="{{  route('analyze.passo2_analise', $challenge->id)  }}" class="btn  waves-effect  waves-light  red  ">
                                                            Análise Passo 2 </a> </td>
                                                @endif
                                                @if  (isset($challenge->formulario()->first()->id))
                                                    @if  ($challenge->formulario()->first()->passo3_despertar == 'FEITO')
                                                        <tr>
                                                            <td> PASSO 3 Despertar </td>
                                                            <td> <a href="{{  route('analyze.passo3_despertar.analise', $challenge->id)  }}"
                                                                    class="btn  waves-effect  waves-light  red  "> Análise Passo 3 - Despertar </a></td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td><a href="{{  route('analyze.passo3_despertar', $challenge->id)  }}"
                                                                    class="btn  waves-effect  waves-light  red  ">
                                                                    Passo 3 - DESPERTAR </a></td>
                                                        </tr>
                                                    @endif
                                                @endif

                                                @if  (isset($challenge->formulario()->first()->id))
                                                    @if  ($challenge->formulario()->first()->passo3_despertar == 'FEITO')
                                                        @if  ($challenge->formulario()->first()->passo3_rotina == 'FEITO')
                                                            <tr>
                                                                <td> PASSO 3 Rotina </td>
                                                                <td><a href="{{  route('analyze.passo3_rotina_sonecas.analise', $challenge->id)  }}"
                                                                        class="btn  waves-effect  waves-light  red  ">
                                                                        Análise Passo 3 - Rotina </a> </td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <td><a href="{{  route('analyze.passo3_rotina_sonecas', $challenge->id)  }}"
                                                                        class="btn  waves-effect  waves-light  red  "> Passo 3 - ROTINA DE SONECAS </a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endif
                                                @if  (isset($challenge->formulario()->first()->id))
                                                    @if  ($challenge->formulario()->first()->passo3_rotina == 'FEITO')
                                                        @if  ($challenge->formulario()->first()->passo3_pilares == 'FEITO')
                                                            <tr>
                                                                <td> PASSO 3 Pilares </td>
                                                                <td> <a href="{{  route('analyze.passo3_pilares.analise', $challenge->id)  }}"
                                                                        class="btn  waves-effect  waves-light  red  ">Análise Passo 3 - Pilares </a></td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                            <tr>
                                                                <td><a href="{{  route('analyze.passo3_pilares', $challenge->id)  }}" class="btn  waves-effect  waves-light  red  ">
                                                                        Passo
                                                                        3 - PILARES </a></td>
                                                            </tr>
                                                            </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endif

                                                @if  (isset($challenge->formulario()->first()->id))
                                                    @if  ($challenge->formulario()->first()->passo3_pilares == 'FEITO')

                                                        @if  ($challenge->formulario()->first()->passo4 == 'FEITO')
                                                            <tr>
                                                                <td> PASSO 4 </td>
                                                                <td> <a href="{{  route('analyze.passo4.analise', $challenge->id)  }}"
                                                                        class="btn  waves-effect  waves-light  red  ">
                                                                        Análise Passo 4</a></td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <td><a href="{{  route('analyze.passo4', $challenge->id)  }}" class="btn  waves-effect  waves-light  red  ">
                                                                        Passo 4 </a></td>
                                                            </tr>
                                                        @endif


                                                    @endif
                                                @endif


                                                @if  (isset($challenge->formulario()->first()->id) && $challenge->formulario()->first()->passo4 == 'FEITO')
                                                    @if  ($challenge->formulario()->first()->conclusao == 'FEITO')
                                                        <tr>
                                                            <td> CONCLUSÃO </td>
                                                            <td> Aguarde o contato do Dr Odilo <a href="{{  route('analyze.conclusao', $challenge->id)  }}"
                                                                    class="btn  waves-effect  waves-light  red  "> Conclusão </a></td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td><a href="{{  route('analyze.conclusao', $challenge->id)  }}" class="btn  waves-effect  waves-light  red  ">
                                                                    Conclusão </a></td>
                                                            <td>
                                                                <form action="{{  route('desafio.finalizado', $challenge->id)  }}" method="POST">
                                                                    @csrf
                                                                    {{  method_field('PUT')  }}
                                                                    <button class="btn">Finalizar Desafio</button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @else
                                            @endif
                                            </tr>
                                            <tr>
                                                <td>Meus Dados
                                                    <a href="{{  route('client.profile.edit')  }}" class="btn  waves-effect  waves-light  red  "> Meus Dados </a>
                                                </td>

                                            </tr>


                                            @if  (isset($challenge->form()->first()->id))
                                                <tr>
                                                    <td>
                                                        <form action="{{  route('desafio.update', $challenge->id)  }}" method="POST">
                                                            @csrf
                                                            {{  method_field('PUT')  }}
                                                            <button class="btn">Enviar Desafio</button>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            @endif

                                            </tbody>
                                            </table>
                                            </div>
                                            </div>

                                        @endif
                                    @else
                                        @if  ($challenge->status == 'INICIADO' || $challenge->status == 'FINALIZADO')
                                                <h4 class="card-title">Análise Diária</h4>

                                                <div class="row">
                                                    <div class="col  s12">
                                                    </div>
                                                    <div class="col  s12">
                                                        <table class="bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th data-field="dia">Dia / Formulário</th>
                                                                    <th data-field="dia">Análise</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    @if  (!isset($challenge->analyzes()->where('day', '1')->first()->day))
                                                                                        <td><a href="{{  route('analyze.create', [$challenge->id, 1])  }}"
                                                                                                class="btn  waves-effect  waves-light  red  "> Dia 1 </a>
                                                                        </div>
                                                                    @else
                                                        @if  (
                                                    !isset(
                                                    $challenge->analyzes()->where('day', '1')->first()->date
                                                )
                                                )
                                                            <td><a href="{{  route('analyze.create', [$challenge->id, 1])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                    Dia 1
                                                                </a>
                                                        @else
                                                                    <td><a href="{{  route('analyze.edit', [$challenge->id, 1])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                            Dia 1
                                                                        </a>
                                                                </div>
                                                            @endif
                                                    @endif

                                                @if  (
                                                isset(
                                                $challenge->analyzes()->where('day', '1')->first()->date
                                            )
                                            )
                                                    <td> Preenchido
                                                    </td>
                                                @else
                                                    <td>Não Preenchido</td>
                                                @endif
                                                </tr>

                                                @if  (
                                                isset(
                                                $challenge->analyzes()->where('day', '1')->first()->date
                                            )
                                            )
                                                    <tr>
                                                        @if  (
                                                    date_format(now(), 'Y-m-d') >=
                                                    date_format(
                                                        $challenge->analyzes()->where('day', '1')->first()->started_at->addDays(1),
                                                        'Y-m-d'
                                                    )
                                                )
                                                            @if  (!isset($challenge->analyzes()->where('day', '2')->first()->day))
                                                                <td><a href="{{  route('analyze.create', [$challenge->id, 2])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                        Dia 2
                                                                    </a>
                                                                    </div>
                                                            @else
                                                                    @if  (
                                                            !isset(
                                                            $challenge->analyzes()->where('day', '2')->first()->date
                                                        )
                                                        )
                                                                        <td><a href="{{  route('analyze.create', [$challenge->id, 2])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                                Dia 2
                                                                            </a>
                                                                    @else
                                                                        <td><a href="{{  route('analyze.edit', [$challenge->id, 2])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                                Dia 2 </a>
                                                                            </div>
                                                                    @endif
                                                                @endif


                                                                @if    (
                                                        isset(
                                                        $challenge->analyzes()->where('day', '2')->first()->date
                                                    )
                                                    )
                                                                    <td> Preenchido
                                                                    </td>
                                                                @else
                                                                <td> Não Preenchido
                                                                </td>
                                                            @endif
                                                        @else
                                                            <td>Dia 2</td>
                                                            <td>Disponível em
                                                                {{  date_format($challenge->analyzes()->where('day', '1')->first()->started_at->addDays(1), 'd/m/Y')  }}
                                                            </td>

                                                        @endif
                                                    </tr>
                                                @endif


                                                @if  (
                                                isset(
                                                $challenge->analyzes()->where('day', '2')->first()->date
                                            )
                                            )
                                                    <tr>
                                                        @if  (
                                                    date_format(now(), 'Y-m-d') >=
                                                    date_format(
                                                        $challenge->analyzes()->where('day', '2')->first()->started_at->addDays(1),
                                                        'Y-m-d'
                                                    )
                                                )
                                                            @if  (
                                                        !isset(
                                                        $challenge->analyzes()->where('day', '3')->first()->day
                                                    )
                                                    )
                                                                <td><a href="{{  route('analyze.create', [$challenge->id, 3])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                        Dia 3
                                                                    </a>
                                                                    </div>
                                                            @else
                                                                    @if  (
                                                            !isset(
                                                            $challenge->analyzes()->where('day', '3')->first()->date
                                                        )
                                                        )
                                                                        <td><a href="{{  route('analyze.create', [$challenge->id, 3])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                                Dia 3
                                                                            </a>
                                                                    @else
                                                                        <td><a href="{{  route('analyze.edit', [$challenge->id, 3])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                                Dia 3 </a>
                                                                            </div>
                                                                    @endif
                                                                @endif


                                                                @if    (
                                                        isset(
                                                        $challenge->analyzes()->where('day', '3')->first()->date
                                                    )
                                                    )
                                                                    <td> Preenchido
                                                                    </td>
                                                                @else
                                                                <td> Não Preenchido
                                                                </td>
                                                            @endif
                                                        @else
                                                            <td>Dia 3</td>
                                                            <td>Disponível em
                                                                {{  date_format($challenge->analyzes()->where('day', '2')->first()->started_at->addDays(1), 'd/m/Y')  }}
                                                            </td>

                                                        @endif
                                                    </tr>
                                                @endif

                                                @if  (
                                                isset(
                                                $challenge->analyzes()->where('day', '3')->first()->date
                                            )
                                            )
                                                    <tr>
                                                        @if  (
                                                    date_format(now(), 'Y-m-d') >=
                                                    date_format(
                                                        $challenge->analyzes()->where('day', '3')->first()->started_at->addDays(1),
                                                        'Y-m-d'
                                                    )
                                                )
                                                            @if  (
                                                        !isset(
                                                        $challenge->analyzes()->where('day', '4')->first()->day
                                                    )
                                                    )
                                                                <td><a href="{{  route('analyze.create', [$challenge->id, 4])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                        Dia 4
                                                                    </a>
                                                                    </div>
                                                            @else
                                                                    @if  (
                                                            !isset(
                                                            $challenge->analyzes()->where('day', '4')->first()->date
                                                        )
                                                        )
                                                                        <td><a href="{{  route('analyze.create', [$challenge->id, 4])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                                Dia 4
                                                                            </a>
                                                                    @else
                                                                        <td><a href="{{  route('analyze.edit', [$challenge->id, 4])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                                Dia 4 </a>
                                                                            </div>
                                                                    @endif
                                                                @endif

                                                                @if    (
                                                        isset(
                                                        $challenge->analyzes()->where('day', '4')->first()->date
                                                    )
                                                    )
                                                                    <td> Preenchido
                                                                    </td>
                                                                @else
                                                                <td> Não Preenchido
                                                                </td>
                                                            @endif
                                                        @else
                                                            <td>Dia 4</td>
                                                            <td>Disponível em
                                                                {{  date_format($challenge->analyzes()->where('day', '3')->first()->started_at->addDays(1), 'd/m/Y')  }}
                                                            </td>

                                                        @endif
                                                    </tr>
                                                @endif

                                                @if  (
                                                isset(
                                                $challenge->analyzes()->where('day', '4')->first()->date
                                            )
                                            )
                                                    <tr>
                                                        @if  (
                                                    date_format(now(), 'Y-m-d') >=
                                                    date_format(
                                                        $challenge->analyzes()->where('day', '4')->first()->started_at->addDays(1),
                                                        'Y-m-d'
                                                    )
                                                )

                                                            @if  (
                                                        !isset(
                                                        $challenge->analyzes()->where('day', '5')->first()->day
                                                    )
                                                    )
                                                                <td><a href="{{  route('analyze.create', [$challenge->id, 5])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                        Dia 5
                                                                    </a>
                                                                    </div>
                                                            @else
                                                                    @if  (
                                                            !isset(
                                                            $challenge->analyzes()->where('day', '5')->first()->date
                                                        )
                                                        )
                                                                        <td><a href="{{  route('analyze.create', [$challenge->id, 5])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                                Dia 5
                                                                            </a>
                                                                    @else
                                                                        <td><a href="{{  route('analyze.edit', [$challenge->id, 5])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                                Dia 5 </a>
                                                                            </div>
                                                                    @endif
                                                                @endif


                                                                @if    (
                                                        isset(
                                                        $challenge->analyzes()->where('day', '5')->first()->date
                                                    )
                                                    )
                                                                    <td> Preenchido
                                                                    </td>
                                                                @else
                                                                <td>Não Preenchido
                                                                </td>
                                                            @endif
                                                        @else
                                                            <td>Dia 5</td>
                                                            <td>Disponível em
                                                                {{  date_format($challenge->analyzes()->where('day', '4')->first()->started_at->addDays(1), 'd/m/Y')  }}
                                                            </td>

                                                        @endif
                                                    </tr>
                                                @endif

                                                @if  (
                                                isset(
                                                $challenge->analyzes()->where('day', '5')->first()->date
                                            )
                                            )
                                                    <tr>
                                                        @if  (
                                                    date_format(now(), 'Y-m-d') >=
                                                    date_format(
                                                        $challenge->analyzes()->where('day', '5')->first()->started_at->addDays(1),
                                                        'Y-m-d'
                                                    )
                                                )
                                                            @if  (
                                                        !isset(
                                                        $challenge->analyzes()->where('day', '6')->first()->day
                                                    )
                                                    )
                                                                <td><a href="{{  route('analyze.create', [$challenge->id, 6])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                        Dia 6
                                                                    </a>
                                                                    </div>
                                                            @else
                                                                    @if  (
                                                            !isset(
                                                            $challenge->analyzes()->where('day', '6')->first()->date
                                                        )
                                                        )
                                                                        <td><a href="{{  route('analyze.create', [$challenge->id, 6])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                                Dia 6
                                                                            </a>
                                                                    @else
                                                                        <td><a href="{{  route('analyze.edit', [$challenge->id, 6])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                                Dia 6 </a>
                                                                            </div>
                                                                    @endif
                                                                @endif
                                                                @if    (
                                                        isset(
                                                        $challenge->analyzes()->where('day', '6')->first()->date
                                                    )
                                                    )
                                                                    <td> Preenchido
                                                                    </td>
                                                                @else
                                                                <td>Não Preenchido
                                                                </td>
                                                            @endif
                                                        @else
                                                            <td>Dia 6</td>
                                                            <td>Disponível em
                                                                {{  date_format($challenge->analyzes()->where('day', '5')->first()->started_at->addDays(1), 'd/m/Y')  }}
                                                            </td>

                                                        @endif
                                                    </tr>
                                                @endif

                                                @if  (
                                                isset(
                                                $challenge->analyzes()->where('day', '6')->first()->date
                                            )
                                            )
                                                    <tr>
                                                        @if  (
                                                    date_format(now(), 'Y-m-d') >=
                                                    date_format(
                                                        $challenge->analyzes()->where('day', '6')->first()->started_at->addDays(1),
                                                        'Y-m-d'
                                                    )
                                                )

                                                            @if  (
                                                        !isset(
                                                        $challenge->analyzes()->where('day', '7')->first()->day
                                                    )
                                                    )
                                                                <td><a href="{{  route('analyze.create', [$challenge->id, 7])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                        Dia 7
                                                                    </a>
                                                                    </div>
                                                            @else
                                                                    @if  (
                                                            !isset(
                                                            $challenge->analyzes()->where('day', '7')->first()->date
                                                        )
                                                        )
                                                                        <td><a href="{{  route('analyze.create', [$challenge->id, 7])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                                Dia 7
                                                                            </a>
                                                                    @else
                                                                        <td><a href="{{  route('analyze.edit', [$challenge->id, 7])  }}" class="btn  waves-effect  waves-light  red  ">
                                                                                Dia 7 </a>
                                                                            </div>
                                                                    @endif
                                                                @endif
                                                                @if    (
                                                        isset(
                                                        $challenge->analyzes()->where('day', '7')->first()->date
                                                    )
                                                    )
                                                                    <td> Preenchido
                                                                    </td>
                                                                @else
                                                                <td> Não Preenchido
                                                                </td>
                                                            @endif
                                                        @else
                                                            <td>Dia 7</td>
                                                            <td>Disponível em
                                                                {{  date_format($challenge->analyzes()->where('day', '6')->first()->started_at->addDays(1), 'd/m/Y')  }}
                                                            </td>

                                                        @endif
                                                    </tr>
                                                @endif

                                                @if  (
                                                        isset(
                                                        $challenge->analyzes()->where('day', '7')->first()->date
                                                    )
                                                    )
                                                            <tr>


                                                                @if  (!isset($challenge->formulario()->first()->id))
                                                                        <td>
                                                                            <a href="{{  route('analyze.passo2', $challenge->id)  }}" class="btn  waves-effect  waves-light  red  ">
                                                                                Passo 2 </a>
                                                                        </td>
                                                                        <td>NÃO</td>
                                                                    </tr>
                                                                @else

                                                                <td> PASSO 2 </td>
                                                                @if(
                                                                $challenge->formulario()->first()->passo4 == 'FEITO' &&
                                                                date_format(now(), 'Y-m-d') >=
                                                                date_format(
                                                                    $challenge->formulario()->first()->updated_at->addDays(1),
                                                                    'Y-m-d'
                                                                )
                                                            )
                                                                    <td> <a href="{{  route('analyze.passo2_analise', $challenge->id)  }}" class="btn  waves-effect  waves-light  red  ">
                                                                            Análise Passo 2 </a> </td>

                                                                @else
                                                                    <td>Análise disponível em
                                                                        {{  date_format($challenge->formulario()->first()->updated_at->addDays(1), 'd/m/Y')  }}
                                                                    </td>
                                                                @endif
                                                            @endif
                                                            @if  (isset($challenge->formulario()->first()->id))
                                                                @if  ($challenge->formulario()->first()->passo3_despertar == 'FEITO')
                                                                    <tr>
                                                                        <td> PASSO 3 Despertar </td>
                                                                        @if(
                                                                    $challenge->formulario()->first()->passo4 == 'FEITO' &&
                                                                    date_format(now(), 'Y-m-d') >=
                                                                    date_format(
                                                                        $challenge->formulario()->first()->updated_at->addDays(1),
                                                                        'Y-m-d'
                                                                    )
                                                                )
                                                                            <td> <a href="{{  route('analyze.passo3_despertar.analise', $challenge->id)  }}"
                                                                                    class="btn  waves-effect  waves-light  red  "> Análise Passo 3 - Despertar </a></td>
                                                                        @else
                                                                            <td>Análise disponível em
                                                                                {{  date_format($challenge->formulario()->first()->updated_at->addDays(1), 'd/m/Y')  }}
                                                                            </td>
                                                                        @endif
                                                                    </tr>
                                                                @else
                                                                    <tr>
                                                                        <td><a href="{{  route('analyze.passo3_despertar', $challenge->id)  }}"
                                                                                class="btn  waves-effect  waves-light  red  ">
                                                                                Passo 3 - DESPERTAR </a></td>
                                                                    </tr>
                                                                @endif
                                                            @endif

                                                            @if  (isset($challenge->formulario()->first()->id))
                                                                @if  ($challenge->formulario()->first()->passo3_despertar == 'FEITO')
                                                                    @if  ($challenge->formulario()->first()->passo3_rotina == 'FEITO')
                                                                        <tr>
                                                                            <td> PASSO 3 Rotina </td>
                                                                            @if(
                                                                        $challenge->formulario()->first()->passo4 == 'FEITO' &&
                                                                        date_format(now(), 'Y-m-d') >=
                                                                        date_format(
                                                                            $challenge->formulario()->first()->updated_at->addDays(1),
                                                                            'Y-m-d'
                                                                        )
                                                                    )
                                                                                <td><a href="{{  route('analyze.passo3_rotina_sonecas.analise', $challenge->id)  }}"
                                                                                        class="btn  waves-effect  waves-light  red  ">
                                                                                        Análise Passo 3 - Rotina </a> </td>
                                                                            @else
                                                                                <td>Análise disponível em
                                                                                    {{  date_format($challenge->formulario()->first()->updated_at->addDays(1), 'd/m/Y')  }}
                                                                                </td>
                                                                            @endif
                                                                        </tr>
                                                                    @else
                                                                        <tr>
                                                                            <td><a href="{{  route('analyze.passo3_rotina_sonecas', $challenge->id)  }}"
                                                                                    class="btn  waves-effect  waves-light  red  "> Passo 3 - ROTINA DE SONECAS </a>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                            @if  (isset($challenge->formulario()->first()->id))
                                                                @if  ($challenge->formulario()->first()->passo3_rotina == 'FEITO')
                                                                    @if  ($challenge->formulario()->first()->passo3_pilares == 'FEITO')
                                                                        <tr>
                                                                            <td> PASSO 3 Pilares </td>
                                                                            @if(
                                                                        $challenge->formulario()->first()->passo4 == 'FEITO' &&
                                                                        date_format(now(), 'Y-m-d') >=
                                                                        date_format(
                                                                            $challenge->formulario()->first()->updated_at->addDays(1),
                                                                            'Y-m-d'
                                                                        )
                                                                    )
                                                                                <td> <a href="{{  route('analyze.passo3_pilares.analise', $challenge->id)  }}"
                                                                                        class="btn  waves-effect  waves-light  red  ">Análise Passo 3 - Pilares </a></td>
                                                                            @else
                                                                                <td>Análise disponível em
                                                                                    {{  date_format($challenge->formulario()->first()->updated_at->addDays(1), 'd/m/Y')  }}
                                                                                </td>
                                                                            @endif
                                                                        </tr>
                                                                    @else
                                                                        <tr>
                                                                        <tr>
                                                                            <td><a href="{{  route('analyze.passo3_pilares', $challenge->id)  }}" class="btn  waves-effect  waves-light  red  ">
                                                                                    Passo
                                                                                    3 - PILARES </a></td>
                                                                        </tr>
                                                                        </td>
                                                                        </tr>
                                                                    @endif
                                                                @endif
                                                            @endif

                                                            @if  (isset($challenge->formulario()->first()->id))
                                                                @if  ($challenge->formulario()->first()->passo3_pilares == 'FEITO')

                                                                    @if  ($challenge->formulario()->first()->passo4 == 'FEITO')
                                                                        <tr>
                                                                            <td> PASSO 4 </td>
                                                                            @if(
                                                                        $challenge->formulario()->first()->passo4 == 'FEITO' &&
                                                                        date_format(now(), 'Y-m-d') >=
                                                                        date_format(
                                                                            $challenge->formulario()->first()->updated_at->addDays(1),
                                                                            'Y-m-d'
                                                                        )
                                                                    )
                                                                                <td> <a href="{{  route('analyze.passo4.analise', $challenge->id)  }}"
                                                                                        class="btn  waves-effect  waves-light  red  ">
                                                                                        Análise Passo 4</a></td>
                                                                            @else
                                                                                <td>Análise disponível em
                                                                                    {{  date_format($challenge->formulario()->first()->updated_at->addDays(1), 'd/m/Y')  }}
                                                                                </td>
                                                                            @endif

                                                                        </tr>
                                                                    @else
                                                                        <tr>
                                                                            <td><a href="{{  route('analyze.passo4', $challenge->id)  }}" class="btn  waves-effect  waves-light  red  "> Passo
                                                                                    4 </a>
                                                                            </td>
                                                                        </tr>
                                                                    @endif


                                                                @endif
                                                            @endif

                                                            @if  (
                                                            isset($challenge->formulario()->first()->id) && $challenge->formulario()->first()->passo4 == 'FEITO'
                                                            &&
                                                            date_format(now(), 'Y-m-d') <
                                                            date_format(
                                                                $challenge->formulario()->first()->updated_at->addDays(1),
                                                                'Y-m-d'
                                                            )
                                                        )
                                                                <tr>
                                                                    <td>Conclusão disponível em
                                                                        {{  date_format($challenge->formulario()->first()->updated_at->addDays(1), 'd/m/Y')  }}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                            @else




                                                                @if  (
                                                                        isset($challenge->formulario()->first()->id) && $challenge->formulario()->first()->passo4 == 'FEITO'
                                                                        &&
                                                                        date_format(now(), 'Y-m-d') >=
                                                                        date_format(
                                                                            $challenge->formulario()->first()->updated_at->addDays(1),
                                                                            'Y-m-d'
                                                                        )
                                                                    )
                                                                            <tr>
                                                                            <tr>
                                                                                <td><a href="{{  route('analyze.conclusao', $challenge->id)  }}" class="btn  waves-effect  waves-light  red  ">
                                                                                        Conclusão </a></td>
                                                                                <td>@if($challenge->status === "FINALIZADO")

   
    @if($challenge->analise_video)
     @if($challenge->videos && $challenge->videos->count())
        {{-- Tem vídeos --}}
        <p><strong>Vídeos adicionais vinculados:</strong></p>
        @foreach($challenge->videos as $video)
            <a class="waves-effect waves-light btn grey modal-trigger" href="#modalVideo{{ $video->id }}">
                {{ $loop->iteration }}º - {{ $video->title ?? 'Vídeo adicional' }}
            </a><br><br>
        @endforeach
@endif
@if($challenge->analise_video=='antigo')
            Seu desafio não foi analisado por ter mais de 30 dias de envio. Recomendamos que realize outro desafio.                                                                
@else
        <a class="waves-effect waves-light btn modal-trigger" href="#modalAnalise">
            Análise Individualizada
        </a>
   @endif
    @else
        {{-- Nenhum vídeo ou análise ainda --}}
        Seu desafio foi finalizado. Em breve o Dr. Odilo irá avaliá-lo em vídeo e ficará disponível.
    @endif

    









                                                                                @else
                                                                                        <form action="{{  route('desafio.finalizado', $challenge->id)  }}" method="POST">
                                                                                            @csrf
                                                                                            {{  method_field('PUT')  }}
                                                                                            <button class="btn">Finalizar Desafio</button>
                                                                                        </form>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>


                                                                @endif
                                                            @endif
                                                @else
                                                @endif
                                                </tr>
                                                <tr>
                                                    <td>Meus Dados
                                                        <a href="{{  route('client.profile.edit')  }}" class="btn  waves-effect  waves-light  red  "> Meus Dados </a>
                                                    </td>

                                                </tr>







                                                </tbody>
                                                </table>
                                                </div>
                                                </div>

                                        @endif

                                    @endif
    </div>
    </div>

    </div>

    </div>
    </div>


    <!-- Modal do vídeo da análise -->
    @if(isset($challenge->analise_video))
        <div id="modalAnalise" class="modal">
            <div class="modal-content">
                <h4>Vídeo da Análise</h4>
                <video width="100%" controls>
                    <source src="{{ asset('storage/' . $challenge->analise_video) }}" type="video/mp4">
                    Seu navegador não suporta vídeos.
                </video>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
            </div>
        </div>
    @endif

    <!-- Modais dos vídeos adicionais -->
    @if($challenge->videos && $challenge->videos->count())
        @foreach($challenge->videos as $video)
            <div id="modalVideo{{ $video->id }}" class="modal">
                <div class="modal-content">
                    <h4>{{ $video->title }}</h4>
                    <video width="100%" controls>
                        <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                        Seu navegador não suporta vídeos.
                    </video>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>
        @endforeach
    @endif


@endsection
</div>
</div>
</div>
</div>

@section('js')
    <script>
        $(document).ready(function () {
            $('.modal').modal({

            });
            $('#modal1').modal('open');
        });

        @if  (session('sucesso'))
            M.toast({
                html: '{{  session('sucesso')  }}'
            })
        @endif
        $(document).ready(function () {
            $('.collapsible').collapsible({
                accordion: true
            });
        });



    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.modal');
            M.Modal.init(elems);
        });
    </script>
@endsection