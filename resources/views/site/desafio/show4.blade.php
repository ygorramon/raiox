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






                                    </div>


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
                                                        @for ($day = 1; $day <= 7; $day++)
                                                            @php
                                                                $rotina = $challenge->rotinas()->where('day', $day)->first();
                                                                $anterior = $day > 1 ? $challenge->rotinas()->where('day', $day - 1)->first() : null;
                                                                $liberado = $day == 1 || ($anterior && now()->greaterThanOrEqualTo($anterior->data->addDay()));
                                                            @endphp

                                                            <tr>
                                                                @if ($liberado)
                                                                    @if (!$rotina || !$rotina->data)
                                                                        <td>
                                                                            <a href="{{ route('analyze.create2', [$challenge->id, $day]) }}"
                                                                               class="btn waves-effect waves-light red">Dia {{ $day }}</a>
                                                                        </td>
                                                                    @else
                                                                        <td>
                                                                            <a href="{{ route('analyze.edit', [$challenge->id, $day]) }}"
                                                                               class="btn waves-effect waves-light red">Dia {{ $day }}</a>
                                                                        </td>
                                                                    @endif

                                                                    <td>{{ $rotina && $rotina->data ? 'Preenchido' : 'Não Preenchido' }}</td>
                                                                @else
                                                                    <td>Dia {{ $day }}</td>
                                                                @endif
                                                            </tr>
                                                        @endfor

                                    @endif

                                        @if  (
                                                    isset(
                                                    $challenge->rotinas()->where('day', '7')->first()->date
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
                                                                @if($challenge->analise_video == 'antigo')
                                                                    Seu desafio não foi analisado por ter mais de 30 dias de rotina. Recomendamos que realize outro desafio.
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