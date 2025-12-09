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

    @if(\Carbon\Carbon::parse($challenge->client->created_at)->diffInDays(now()) > 8)

        <div id="modal2" class="modal">
            <div class="modal-content">
                <h5>Consulta Pediátrica / Acompanhamento pelo Whatsapp</h5>
                <h6>Assista o vídeo abaixo e entenda sobre</h6>
                <video width="100%" controls>
                    <source src="{{ asset('storage/videos/consulta.mp4') }}" type="video/mp4">
                    Seu navegador não suporta vídeos.
                </video>




            </div>
            <div class="modal-footer">
                <a href="https://api.whatsapp.com/send?phone=5586999996977" target="_blank  " class="btn">
                    Agende Aqui</a>
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col  s12">
            <div class="container">
                <div class="section">
                    <div class="card-alert">
                        <div class="card-content  purple-text">
                            <a href="https://api.whatsapp.com/send?phone=5588996620215" target="_blank  " class="btn">
                                Suporte Técnico</a>
                            @if(\Carbon\Carbon::parse($challenge->client->created_at)->diffInDays(now()) > 8) <a
                            class="btn blue modal-trigger" href="#modal2">Consulta</a> @endif



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
                                                                                                <td> 

                                                                                                @if($challenge->analise_video)
                                                                        {{-- CASO 1: Existe analise_video --}}
                                                                        @if($challenge->videos && $challenge->videos->count())
                                                                            {{-- Tem vídeos adicionais --}}
                                                                            <p><strong>Vídeos adicionais vinculados:</strong></p>
                                                                            @foreach($challenge->videos as $video)
                                                                                <a class="waves-effect waves-light btn grey modal-trigger" href="#modalVideo{{ $video->id }}">
                                                                                    {{ $loop->iteration }}º - {{ $video->title ?? 'Vídeo adicional' }}
                                                                                </a><br><br>
                                                                            @endforeach
                                                                        @endif

                                                                        {{-- Verificar se é análise antiga --}}
                                                                        @if($challenge->analise_video == 'antigo')
                                                                            {{-- CASO 1.1: Análise antiga --}}
                                                                            <div class="card-panel yellow lighten-4">
                                                                                <i class="material-icons left">info</i>
                                                                                <strong>Análise Antiga</strong><br>
                                                                                Seu desafio não foi analisado por ter mais de 30 dias de rotina. 
                                                                                Recomendamos que realize outro desafio.
                                                                            </div>
                                                                        @else
                                                                            {{-- CASO 1.2: Análise individual (sistema antigo) --}}
                                                                            @if(isset($challenge->analise_video) && !empty($challenge->analise_video))
                                                                                <a class="btn btn-info modal-trigger" href="#modalAnalise">
                                                                                    <i class="material-icons left">play_circle_filled</i>
                                                                                    Ver Análise
                                                                                </a>
                                                                            @endif
                                                                        @endif

                                                                    @elseif(isset($challenge->analises) && is_array($challenge->analises) && count($challenge->analises) > 0)
                                                                        {{-- CASO 2: Sistema novo com múltiplas partes (JSON) --}}
                                                                        <a class="btn btn-info modal-trigger" href="#modalAnaliseResumo">
                                                                            <i class="material-icons left">playlist_play</i>
                                                                            Ver Análise ({{ count($challenge->analises) }} partes)
                                                                        </a>

                                                                        {{-- Mostrar vídeos adicionais se existirem --}}
                                                                        @if($challenge->videos && $challenge->videos->count())
                                                                            <p><strong>Vídeos adicionais vinculados:</strong></p>
                                                                            @foreach($challenge->videos as $video)
                                                                                <a class="waves-effect waves-light btn grey modal-trigger" href="#modalVideo{{ $video->id }}">
                                                                                    {{ $loop->iteration }}º - {{ $video->title ?? 'Vídeo adicional' }}
                                                                                </a><br><br>
                                                                            @endforeach
                                                                        @endif



                                                                    @endif    
                                                                                                @if($challenge->status === "FINALIZADO")
                                                                                                    {{-- CASO 3: Nenhuma análise disponível --}}
                                                                                                     @if($challenge->analise_video==null && $challenge->analises==null)
                                                                                                    <div class="card-panel blue lighten-5">
                                                                                                        <i class="material-icons left">access_time</i>
                                                                                                        <strong>Análise em Andamento</strong><br>
                                                                                                        Seu desafio foi finalizado. Em breve o Dr. Odilo irá avaliá-lo em vídeo e ficará disponível.
                                                                                                    </div>
                                                                                                    @endif

                                                                                                                                    {{-- MODAL para análise individual (sistema antigo) --}}
                                                                                                                                    @if(isset($challenge->analise_video) && !empty($challenge->analise_video) && $challenge->analise_video != 'antigo')
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

                                                                                                                                    {{-- MODAL para múltiplas partes (sistema novo) --}}
                                                                                                                                    @if(isset($challenge->analises) && is_array($challenge->analises) && count($challenge->analises) > 0)
                                                                                                                                        <!-- Modal resumo -->
                                                                                                                                        <div id="modalAnaliseResumo" class="modal">
                                                                                                                                            <div class="modal-content">
                                                                                                                                                <h4>Análise em Vídeo</h4>
                                                                                                                                                <div class="collection">
                                                                                                                                                    @foreach($challenge->analises as $analise)
                                                                                                                                                        <a href="#!" class="collection-item modal-trigger" data-target="modalAnaliseMultipla">
                                                                                                                                                            <i class="material-icons">play_circle_outline</i>
                                                                                                                                                            Parte {{ $analise['parte'] }} -
                                                                                                                                                            {{ $analise['nome_original'] ?? 'Análise' }}
                                                                                                                                                            <span class="secondary-content">
                                                                                                                                                                {{ $analise['tamanho_mb'] ?? round($analise['tamanho'] / 1024 / 1024, 2) }} MB
                                                                                                                                                            </span>
                                                                                                                                                        </a>
                                                                                                                                                    @endforeach
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                            <div class="modal-footer">
                                                                                                                                                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
                                                                                                                                                <a href="#!" class="waves-effect waves-blue btn-flat modal-trigger" data-target="modalAnaliseMultipla">
                                                                                                                                                    Ver Detalhes
                                                                                                                                                </a>
                                                                                                                                            </div>
                                                                                                                                        </div>

                                                                                                                                        <!-- Modal detalhado com tabs -->
                                                                                                                                        <div id="modalAnaliseMultipla" class="modal modal-fixed-footer">
                                                                                                                                            <div class="modal-content">
                                                                                                                                                <h4>Análise em Vídeo - Partes</h4>

                                                                                                                                                <!-- Navegação entre partes -->
                                                                                                                                                <ul class="tabs">
                                                                                                                                                    @foreach($challenge->analises as $index => $analise)
                                                                                                                                                        <li class="tab col">
                                                                                                                                                            <a href="#parte-{{ $analise['parte'] }}" class="{{ $index === 0 ? 'active' : '' }}">
                                                                                                                                                                Parte {{ $analise['parte'] }}
                                                                                                                                                            </a>
                                                                                                                                                        </li>
                                                                                                                                                    @endforeach
                                                                                                                                                </ul>

                                                                                                                                                <!-- Conteúdo das partes -->
                                                                                                                                                @foreach($challenge->analises as $index => $analise)
                                                                                                                                                    <div id="parte-{{ $analise['parte'] }}" class="col s12">
                                                                                                                                                        <div class="card">
                                                                                                                                                            <div class="card-content">
                                                                                                                                                                <h5>Parte {{ $analise['parte'] }} de {{ count($challenge->analises) }}</h5>

                                                                                                                                                                <!-- Informações do vídeo -->
                                                                                                                                                                <div class="video-info mb-3">
                                                                                                                                                                    <p><strong>Arquivo:</strong> {{ $analise['nome_original'] ?? 'N/A' }}</p>
                                                                                                                                                                    <p><strong>Tamanho:</strong>
                                                                                                                                                                        {{ $analise['tamanho_mb'] ?? round($analise['tamanho'] / 1024 / 1024, 2) }} MB</p>
                                                                                                                                                                    <p><strong>Data:</strong>
                                                                                                                                                                        {{ \Carbon\Carbon::parse($analise['data_upload'])->format('d/m/Y H:i') }}</p>
                                                                                                                                                                </div>

                                                                                                                                                                <!-- Player de vídeo -->
                                                                                                                                                                <video width="100%" controls class="analise-video" data-parte="{{ $analise['parte'] }}">
                                                                                                                                                                    <source src="{{ asset('storage/' . $analise['caminho']) }}" type="video/mp4">
                                                                                                                                                                    Seu navegador não suporta vídeos.
                                                                                                                                                                </video>
                                                                                                                                                            </div>
                                                                                                                                                        </div>
                                                                                                                                                    </div>
                                                                                                                                                @endforeach
                                                                                                                                            </div>
                                                                                                                                            <div class="modal-footer">
                                                                                                                                                <a href="#!" class="modal-close waves-effect waves-red btn-flat">Fechar</a>
                                                                                                                                                <button id="playAllBtn" class="waves-effect waves-green btn teal">
                                                                                                                                                    <i class="material-icons left">play_circle_filled</i>Reproduzir Todas
                                                                                                                                                </button>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    @endif

                                                                                                                                    {{-- MODAIS para vídeos adicionais --}}
                                                                                                                                    @if($challenge->videos && $challenge->videos->count())
                                                                                                                                        @foreach($challenge->videos as $video)
                                                                                                                                            <div id="modalVideo{{ $video->id }}" class="modal">
                                                                                                                                                <div class="modal-content">
                                                                                                                                                    <h4>{{ $video->title ?? 'Vídeo Adicional' }}</h4>
                                                                                                                                                    @if($video->file_path)
                                                                                                                                                        <video width="100%" controls>
                                                                                                                                                            <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                                                                                                                                                            Seu navegador não suporta vídeos.
                                                                                                                                                        </video>
                                                                                                                                                    @else
                                                                                                                                                        <p>Vídeo não disponível.</p>
                                                                                                                                                    @endif
                                                                                                                                                </div>
                                                                                                                                                <div class="modal-footer">
                                                                                                                                                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        @endforeach
                                                                                                                                    @endif
                                                                                                @else
                                                                                                        <form action="{{  route('desafio.finalizado', $challenge->id)  }}" method="POST">
                                                                                                            @csrf
                                                                                                            {{  method_field('PUT')  }}
                                                                                                            <button class="btn">Finalizar/Enviar Desafio</button>
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


    @if(isset($challenge->analise_video) && !empty($challenge->analise_video))
        <!-- Modal para vídeo único (sistema antigo) -->
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
    @elseif(isset($challenge->analises) && is_array($challenge->analises) && count($challenge->analises) > 0)
        <!-- Modal para múltiplas partes (sistema novo) -->
        <div id="modalAnaliseMultipla" class="modal modal-fixed-footer">
            <div class="modal-content">
                <h4>Análise em Vídeo - Partes</h4>

                <!-- Navegação entre partes -->
                <ul class="tabs">
                    @foreach($challenge->analises as $index => $analise)
                        <li class="tab col">
                            <a href="#parte-{{ $analise['parte'] }}" class="{{ $index === 0 ? 'active' : '' }}">
                                Parte {{ $analise['parte'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <!-- Conteúdo das partes -->
                @foreach($challenge->analises as $index => $analise)
                    <div id="parte-{{ $analise['parte'] }}" class="col s12">
                        <div class="card">
                            <div class="card-content">
                                <h5>Parte {{ $analise['parte'] }} de {{ count($challenge->analises) }}</h5>

                                <!-- Informações do vídeo -->
                                <div class="video-info mb-3">
                                    <p><strong>Arquivo:</strong> {{ $analise['nome_original'] ?? 'N/A' }}</p>
                                    <p><strong>Tamanho:</strong>
                                        {{ $analise['tamanho_mb'] ?? round($analise['tamanho'] / 1024 / 1024, 2) }} MB</p>
                                    <p><strong>Data:</strong>
                                        {{ \Carbon\Carbon::parse($analise['data_upload'])->format('d/m/Y H:i') }}</p>
                                </div>

                                <!-- Player de vídeo -->
                                <video width="100%" controls class="analise-video" data-parte="{{ $analise['parte'] }}">
                                    <source src="{{ asset('storage/' . $analise['caminho']) }}" type="video/mp4">
                                    Seu navegador não suporta vídeos.
                                </video>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-red btn-flat">Fechar</a>
                <button id="playAllBtn" class="waves-effect waves-green btn teal">
                    <i class="material-icons left">play_circle_filled</i>Reproduzir Todas
                </button>
            </div>
        </div>

        <!-- Modal simplificado para visualização rápida -->
        <div id="modalAnaliseResumo" class="modal">
            <div class="modal-content">
                <h4>Análise em Vídeo</h4>
                <div class="collection">
                    @foreach($challenge->analises as $analise)
                        <a href="#!" class="collection-item modal-trigger" data-target="modalAnaliseMultipla">
                            <i class="material-icons">play_circle_outline</i>
                            Parte {{ $analise['parte'] }} -
                            {{ $analise['nome_original'] ?? 'Análise' }}
                            <span class="secondary-content">
                                {{ $analise['tamanho_mb'] ?? round($analise['tamanho'] / 1024 / 1024, 2) }} MB
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
                <a href="#!" class="waves-effect waves-blue btn-flat modal-trigger" data-target="modalAnaliseMultipla">
                    Ver Detalhes
                </a>
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
{{-- MODAL para análise individual (sistema antigo) --}}
@if(isset($challenge->analise_video) && !empty($challenge->analise_video) && $challenge->analise_video != 'antigo')
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

{{-- MODAL para múltiplas partes (sistema novo) --}}
@if(isset($challenge->analises) && is_array($challenge->analises) && count($challenge->analises) > 0)
    <!-- Modal resumo -->
    <div id="modalAnaliseResumo" class="modal">
        <div class="modal-content">
            <h4>Análise em Vídeo</h4>
            <div class="collection">
                @foreach($challenge->analises as $analise)
                    <a href="#!" class="collection-item modal-trigger" data-target="modalAnaliseMultipla">
                        <i class="material-icons">play_circle_outline</i>
                        Parte {{ $analise['parte'] }} -
                        {{ $analise['nome_original'] ?? 'Análise' }}
                        <span class="secondary-content">
                            {{ $analise['tamanho_mb'] ?? round($analise['tamanho'] / 1024 / 1024, 2) }} MB
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
            <a href="#!" class="waves-effect waves-blue btn-flat modal-trigger" data-target="modalAnaliseMultipla">
                Ver Detalhes
            </a>
        </div>
    </div>

    <!-- Modal detalhado com tabs -->
    <div id="modalAnaliseMultipla" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>Análise em Vídeo - Partes</h4>

            <!-- Navegação entre partes -->
            <ul class="tabs">
                @foreach($challenge->analises as $index => $analise)
                    <li class="tab col">
                        <a href="#parte-{{ $analise['parte'] }}" class="{{ $index === 0 ? 'active' : '' }}">
                            Parte {{ $analise['parte'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <!-- Conteúdo das partes -->
            @foreach($challenge->analises as $index => $analise)
                <div id="parte-{{ $analise['parte'] }}" class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <h5>Parte {{ $analise['parte'] }} de {{ count($challenge->analises) }}</h5>

                            <!-- Informações do vídeo -->
                            <div class="video-info mb-3">
                                <p><strong>Arquivo:</strong> {{ $analise['nome_original'] ?? 'N/A' }}</p>
                                <p><strong>Tamanho:</strong>
                                    {{ $analise['tamanho_mb'] ?? round($analise['tamanho'] / 1024 / 1024, 2) }} MB</p>
                                <p><strong>Data:</strong>
                                    {{ \Carbon\Carbon::parse($analise['data_upload'])->format('d/m/Y H:i') }}</p>
                            </div>

                            <!-- Player de vídeo -->
                            <video width="100%" controls class="analise-video" data-parte="{{ $analise['parte'] }}">
                                <source src="{{ asset('storage/' . $analise['caminho']) }}" type="video/mp4">
                                Seu navegador não suporta vídeos.
                            </video>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-red btn-flat">Fechar</a>
            <button id="playAllBtn" class="waves-effect waves-green btn teal">
                <i class="material-icons left">play_ciscle_filled</i>Reproduzir Todas
            </button>
        </div>
    </div>
@endif

{{-- MODAIS para vídeos adicionais --}}
@if($challenge->videos && $challenge->videos->count())
    @foreach($challenge->videos as $video)
        <div id="modalVideo{{ $video->id }}" class="modal">
            <div class="modal-content">
                <h4>{{ $video->title ?? 'Vídeo Adicional' }}</h4>
                @if($video->file_path)
                    <video width="100%" controls>
                        <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                        Seu navegador não suporta vídeos.
                    </video>
                @else
                    <p>Vídeo não disponível.</p>
                @endif
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
            </div>
        </div>
    @endforeach
@endif
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Inicializar modais do Materialize
            var modals = document.querySelectorAll('.modal');
            M.Modal.init(modals);

            // Inicializar tabs
            var tabs = document.querySelectorAll('.tabs');
            M.Tabs.init(tabs);

            // Controle de reprodução automática entre partes
            const playAllBtn = document.getElementById('playAllBtn');
            if (playAllBtn) {
                playAllBtn.addEventListener('click', function () {
                    playAllVideosSequentially();
                });
            }

            function playAllVideosSequentially() {
                const videos = document.querySelectorAll('.analise-video');
                let currentVideoIndex = 0;

                function playNextVideo() {
                    if (currentVideoIndex >= videos.length) return;

                    const currentVideo = videos[currentVideoIndex];
                    const currentTab = document.querySelector(`#parte-${currentVideo.dataset.parte}`);

                    // Ativar a tab correspondente
                    const tabInstance = M.Tabs.getInstance(document.querySelector('.tabs'));
                    tabInstance.select(`parte-${currentVideo.dataset.parte}`);

                    // Reproduzir o vídeo atual
                    currentVideo.play();

                    // Quando o vídeo terminar, passar para o próximo
                    currentVideo.onended = function () {
                        currentVideoIndex++;
                        playNextVideo();
                    };

                    // Se o usuário pausar manualmente, parar a sequência
                    currentVideo.onpause = function () {
                        if (!currentVideo.ended) {
                            currentVideo.onended = null; // Remove o listener
                        }
                    };
                }

                // Iniciar a sequência
                playNextVideo();
            }

            // Pausar todos os vídeos quando o modal fechar
            const modalMultipla = document.getElementById('modalAnaliseMultipla');
            if (modalMultipla) {
                modalMultipla.addEventListener('click', function (e) {
                    if (e.target.classList.contains('modal-close') || e.target.closest('.modal-close')) {
                        document.querySelectorAll('.analise-video').forEach(video => {
                            video.pause();
                            video.currentTime = 0;
                        });
                    }
                });
            }

            // Auto-play quando mudar de tab
            document.addEventListener('DOMContentLoaded', function () {
                const tabElems = document.querySelectorAll('.tabs');
                const tabInstances = M.Tabs.init(tabElems, {
                    onShow: function (newTab) {
                        const video = newTab.querySelector('.analise-video');
                        if (video) {
                            video.currentTime = 0;
                            // Não auto-play automático para não incomodar o usuário
                            // video.play();
                        }
                    }
                });
            });
        });
    </script>
@endsection