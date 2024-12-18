@extends('site.desafio.layouts.app')
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
@stop



@section('content')


    <div class="row">

        <div class="col s12">
            <div class="card">
                <div class="card-content row">
                    <div class="col s12 ">
                        <h3>Conclusão</h3>
                        <textarea class="materialize-textarea">Finalmente chegamos ao fim da sua análise e eu vou listar aqui os pontos que precisam de ajustes, dentro do Método dos 4 Passos. Lembrando que essa foi uma análise automática, mas que nosso algoritmo consegue analisar o máximo de possibilidades de respostas e sempre trabalhamos para te dar as orientações mais precisas desde o primeiro momento.
            Sugiro fazer os ajustes na ordem de cada passo, assim como está listado abaixo: (Clique nos passos para Visualizar)</textarea>

                        <ul class="collapsible">
                            <li>
                                <div class="collapsible-header"><i class="material-icons">place</i>PASSO 1</div>
                                <div class="collapsible-body">

                                    <label>Sinal de Sono</label>
                                    <textarea class="materialize-textarea">Caso não perceba os sinais de sono antes, já comece o “Desacelerar” após {{ $media_janelas }} minutos.</textarea>
                                    <label>Ritual</label>
                                    <textarea class="materialize-textarea">Lembre que o ideal de um ritual é que ele dure menos de 30 minutos e que seja sem choro.</textarea>
                                    <label>Duração da Soneca</label>
                                    <textarea class="materialize-textarea">Lembre que o ideal de uma soneca é que ela dure mais de 40 minutos e que acorde bem, alegre e ativo.</textarea>



                                </div>
                            </li>

                            <li>
                                <div class="collapsible-header"><i class="material-icons">place</i>PASSO 2</div>
                                <div class="collapsible-body">

                                    <label>Fome</label>
                                    <textarea class="materialize-textarea">{{ $challenge->formulario()->first()->ajustes_fome ?? '' }}</textarea>
                                    <label>Dor</label>
                                    <textarea class="materialize-textarea">{{ $challenge->formulario()->first()->ajustes_dor ?? '' }}</textarea>
                                    @if ($babyAge < 540)
                                        <label>Salto</label>
                                        <textarea class="materialize-textarea">{{ $challenge->formulario()->first()->ajustes_salto }}</textarea>
                                    @endif
                                    @if ($babyAge < 180)
                                        <label>Angústia da Separação</label>
                                        <textarea class="materialize-textarea">A angústia da separação será aliviada quando o bebê perceber que você sai do campo de visão, mas sempre volta. Por isso que brincadeiras de “esconde-achou" e sair do campo de visão falando com o bebê para que ele ainda te ouça por mais um tempo, são tão importantes. Além da naninha, que é um objeto de transição desse período.</textarea>
                                    @endif
                                    <label>Telas</label>
                                    <textarea class="materialize-textarea">A exposição às telas pode atrapalhar bastante o sono do bebê pelo excesso de estímulos e pelo exces-so de luz azul. Por isso a recomendação é que não haja essa exposição.
Se você não consegue evitar essa exposição, passaremos para o próximo passo, ainda temos muito trabalho pela frente, mas lembre que essa pode ser uma causa de despertar, dificultando chegar à noite inteira de sono.
</textarea>

                                </div>
                            </li>

                            <li>
                                <div class="collapsible-header"><i class="material-icons">place</i>PASSO 3</div>
                                <div class="collapsible-body">
                                    @if ($qtd_dias_acordou_cedo > 0)
                                        <label>Despertar </label>
                                        <textarea class="materialize-textarea">Se seu bebê despertar antes de 06:00, avalie o ambiente para que ele fique o mais escuro possível, silencioso (ou isolado por um ruído branco) e com temperatura adequada.</textarea>
                                    @endif
                                    @if ($qtd_dias_acordou_tarde > 0)
                                        <label>Despertar </label>
                                        <textarea class="materialize-textarea">Se despertar após às 08:00 Lembre que acordar após às 08:00 não é o ideal para o organismo e para o sono do bebê. Por isso acorde progressivamente mais cedo até alcançar, pelo menos, 08:00.
</textarea>
                                    @endif
                                    <label>Ritual do Bom dia</label>
                                    <textarea class="materialize-textarea">O ritual do bom dia te ajudará a dar ainda mais previsibilidade para o seu bebê! Não deixe de fazer!</textarea>

                                    <label>ROTINA DE SONECAS - JANELA DE SONO</label>
                                    <textarea class="materialize-textarea">Sugiro que, CASO NÃO PERCEBA sinais de sono antes, comece o desacelerar em até {{ $media_janelas }} minutos, para que ele durma em até 30 minutos e permaneça dentro da janela de sono esperada.</textarea>
                                    @if ($qtd_sonecas_inadequadas > 0)
                                        <label>ROTINA DE SONECAS - DURAÇÃO </label>
                                        <textarea class="materialize-textarea">Sonecas curtas: Reavalie os 5 pilares das sonecas e siga as orientações sobre prolonga-las para que durem pelo menos 40 minutos.</textarea>
                                    @endif
                                    @if ($challenge->formulario()->first()->desacelera == 'N')
                                        <label>ROTINA DE SONECAS - DESACELERAR </label>
                                        <textarea class="materialize-textarea">Lembre de desacelerar! Isso vai te ajudar na hora de colocar o bebê para dormir!</textarea>
                                    @endif
                                    @if ($challenge->formulario()->first()->ambiente_barulho == 'barulho')
                                        <label>Ambiente do Sono - Som </label>
                                        <textarea class="materialize-textarea">Lembre que quanto menos ruídos externos o ambiente tiver, maior a chance do seu bebê tirar boas sonecas, acordar menos e acordar mais tarde.
E você conseguirá isso com um ambiente silencioso ou isolando a acústica com um ruído branco.
</textarea>
                                    @endif
                                    @if ($challenge->formulario()->first()->ambiente_temperatura != 'agradavel')
                                        <label>Ambiente do Sono - Temperatura </label>
                                        <textarea class="materialize-textarea">Faça o melhor que puder para o ajuste da temperatura!
Isso é essencial para um sono de qualidade.
</textarea>
                                    @endif
                                    @if ($challenge->formulario()->first()->ambiente_temperatura != 'escuro')
                                        <label>Ambiente do Sono - Luminosidade </label>
                                        <textarea class="materialize-textarea">Lembre que quanto mais escuro o ambiente for, maior a chance do seu bebê tirar boas sonecas, acor-dar menos e acordar mais tarde.
</textarea>
                                    @endif
                                    <label>ROTINA DE SONECAS - RITUAL DO SONO </label>
                                    <textarea class="materialize-textarea">Rituais que duram mais de 30 minutos e/ou contem muito choro costumam prejudicar o sono do bebê pois ele fica cansado/estressado demais por isso.
Reveja as orientações dadas, busque por gatilhos de choro e busque um ritual rápido e sem choro.

</textarea>

                                </div>


                            </li>

                            <li>
                                <div class="collapsible-header"><i class="material-icons">place</i>PASSO 4</div>
                                <div class="collapsible-body">
                                    <textarea class="materialize-textarea">
                                        Agora é hora de falarmos sobre o Passo 4- O sono noturno e as associações.
Como esse é um tópico muito individual, recomendo que assista a aula referente à associação que mais te incomoda primeiro.
Não tente desfazer todas as associações de uma vez porque poderá ser muita mudança para o/a bebê, ou seja, poderá ter choro e o nosso objetivo é que não haja choro em nenhum momento.
E caso ainda tenha dúvidas, participe dos encontros ao vivo para expôr seu caso e suas individualidades e para que possamos entender e te ajudar ainda mais.
</textarea>

                                </div>


                            </li>

                        </ul>






                    </div>
                </div>
            </div>

        </div>


    </div>

@endsection
@section('js')
    <script>
        @if (session('sucesso'))
            M.toast({
                html: '{{ session('sucesso') }}'
            })
        @endif
        $(document).ready(function() {
            $('.collapsible').collapsible({
                accordion: true
            });
        });
    </script>
@endsection
