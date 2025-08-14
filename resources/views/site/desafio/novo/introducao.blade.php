@extends('site.desafio.layouts.app')
@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
@stop



@section('content')

    <div id="modalSono" class="modal modal-fixed-footer">
    <div class="modal-content">
    <h5>Vamos observar o sono do bebê?</h5>

    {{-- Pergunta 1 --}}
    <div id="pergunta1">
    <p><strong>1 - Você consegue observar os sinais de sono do bebê?</strong></p>
    <p>Sabe quanto tempo o seu bebê leva até COMEÇAR a sentir sono?</p>
    <button class="btn green" onclick="responderSono(true)">Sim</button>
    <button class="btn red" onclick="responderSono(false)">Não</button>
    </div>

    {{-- Se NÃO --}}
    <div id="explicacaoSinais" style="display: none;">
    <p><strong>OS SINAIS DE SONO MAIS COMUNS SÃO:</strong></p>
    <ul>
    <li>Bocejar</li>
    <li>Se agitar</li>
    <li>Abrir bem os olhos</li>
    <li>Fazer barulhinhos como uma porta que precisa de óleo abrindo</li>
    <li>Virando o rosto para pessoas e objetos</li>
    <li>Escondendo o rosto no peito de quem o segura no colo</li>
    <li>Fazendo movimentos involuntários com braços e pernas</li>
    <li>Esfregando os olhos</li>
    <li>Olhar parado/fixo em algo</li>
    <li>Puxando as orelhas/cabelos</li>
    <li>Arranhando o próprio rosto/batendo nas pessoas</li>
    <li>Ficando com os movimentos menos coordenados</li>
    <li>Virando/arqueando o corpo para trás</li>
    <li>Perdendo o interesse nos brinquedos</li>
    <li>Caindo muito ou esbarrando em coisas ou pessoas</li>
    </ul>
    <p><strong>Esse passo é muito importante</strong> e determinará todo o nosso acompanhamento quanto aos
    ajustes das sonecas.</p>
    <p>Observe com cuidado para preencher o seu desafio de 7 dias da melhor forma.</p>
    <p><strong>Vamos tentar?</strong> Observe quanto tempo seu filho leva entre acordar de uma soneca até
    COMEÇAR a sentir sono novamente, ok?</p>
    <p>Aí você preenche para começarmos!</p>
    <br>
    <button class="btn blue" onclick="voltarParaPergunta1()">Voltar para a pergunta 1</button>
    </div>

    {{-- Se SIM --}}
    <div id="tempoSonoForm" style="display: none;">
    <p><strong>3 - Quanto tempo, em média, ele leva até COMEÇAR a sentir sono?</strong></p>
    <input id="tempoSono" type="number" placeholder="Informe em minutos" class="validate" />
    <button id="salvarSono" class="btn blue" onclick="validarTempoSono()">Continuar</button>
    </div>

    {{-- Valor maior que o esperado --}}
    <div id="confirmacaoTempo" style="display: none;">
    <p><strong>5 -</strong> Cada bebê é único, mas esse valor está acima do que a maioria dos bebês na mesma
    idade costuma demorar até sentir sono.</p>
    <p>O intervalo médio costuma ser menor que <strong><span id="tempoEsperadoTexto"></span></strong> minutos.
    </p>
    <p>Tem certeza do intervalo que você referiu?</p>
    <button class="btn green" onclick="salvarSono()">Sim, tenho certeza</button>
    <button class="btn red" onclick="observarMais()">Não tenho certeza</button>
    </div>

    {{-- Observar mais sinais --}}
    <div id="observarMaisTempo" style="display: none;">
    <p><strong>7 -</strong> Faz assim, começa a observar seu bebê após <strong><span
      id="sugestaoTempo"></span></strong> minutos, ou até um pouco antes disso.</p>
    <p>Observe por 1 minuto, procurando sinais de sono.</p>
    <p>Depois, responda à pergunta:</p>
    <p><em>“Ele está emitindo algum sinal de sono?”</em></p>
    <p>Se sim, anote no seu desafio de 7 dias. Se não, espere 5 a 10 minutos e observe novamente.</p>
    <p>Quando perceber os primeiros sinais de sono, registre na plataforma.</p>
    <button class="btn blue" onclick="salvarSono()">Iniciar desafio de 7 dias</button>    </div>

    {{-- Desafio iniciado --}}
    <div id="desafioIniciado" style="display: none;">
    <h5>Desafio de 7 dias iniciado!</h5>
    <p><strong>4/6 -</strong> Tudo bem! Lembre que esse intervalo que o bebê leva para COMEÇAR a sentir sono não
    varia tanto, ok?</p>
    <p>Você pode preencher os dados na plataforma diariamente.</p>
    </div>

    </div>
    <div class="modal-footer">
    <div id="modalEtapa1" class="modal">
    <div class="modal-content">
    <h4>Você consegue observar os sinais de sono do bebê?</h4>
    <p>Sabe quanto tempo o seu bebê leva até COMEÇAR a sentir sono?</p>
    <div class="center-buttons">
    <a class="btn modal-close" onclick="mostrarEtapa('modalEtapa2')">Não</a>
    <a class="btn modal-close" onclick="mostrarEtapa('modalEtapa3')">Sim</a>
    </div>
    </div>
    </div>
    </div>
    </div>


    <div class="row">

    <div class="col s12">
    <br>

    <center>
      <h3> Para iniciarmos, assista o vídeo abaixo: <h3>
      <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; background: #000;">
    <iframe src="https://www.youtube.com/embed/_HxmdYrOl_o?si=q857w-PjE0Uvwekd"
        title="YouTube video player"
        style="position: absolute; top:0; left: 0; width: 100%; height: 100%;"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin"
        allowfullscreen>
    </iframe>
</div>

    <a class="btn modal-trigger" href="#modalSono">Confirmo que assisti ao vídeo</a>
    </center>

    </div>
    </div>

    @section('js')
      <script>
      document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.modal');
      M.Modal.init(elems);
      });

      const tempos = [
      { maxMeses: 2, tempo: 50 },
      { maxMeses: 3, tempo: 70 },
      { maxMeses: 4, tempo: 80 },
      { maxMeses: 5, tempo: 90 },
      { maxMeses: 6, tempo: 100 },
      { maxMeses: 7, tempo: 120 },
      { maxMeses: 8, tempo: 140 },
      { maxMeses: 9, tempo: 150 },
      { maxMeses: 10, tempo: 160 },
      { maxMeses: 11, tempo: 170 },
      { maxMeses: 12, tempo: 180 },
      { maxMeses: 18, tempo: 210 },
      { maxMeses: 99, tempo: 360 },
      ];

      let idadeMeses = {{ \Carbon\Carbon::now()->diffInMonths($challenge->client->birthBaby ?? now()) }};
      let tempoAceito = tempos.find(t => idadeMeses <= t.maxMeses).tempo;

      let percebeSono = null;
      let tempoSono = null;

      function responderSono(valor) {
      percebeSono = valor ? 1 : 0;

      if (valor) {
      document.getElementById('pergunta1').style.display = 'none';
      document.getElementById('tempoSonoForm').style.display = 'block';
      } else {
      document.getElementById('pergunta1').style.display = 'none';
      document.getElementById('explicacaoSinais').style.display = 'block';
      }
      }

      function voltarParaPergunta1() {
      document.getElementById('explicacaoSinais').style.display = 'none';
      document.getElementById('pergunta1').style.display = 'block';
      }
    function validarTempoSono() {
    const tempo = parseInt($('#tempoSono').val(), 10);

    if (isNaN(tempo) || tempo <= 0) {
      M.toast({html: 'Informe um valor válido em minutos.'});
      return;
    }

    tempoSono = tempo; // <<< salva globalmente

    if (tempo <= tempoAceito) {
      salvarSono();
    } else {
      $('#tempoSonoForm').hide();
      $('#tempoEsperadoTexto').text(tempoAceito);
      $('#confirmacaoTempo').show();
    }
  }


       function salvarSono() {
     
      $.ajax({
      url: "{{ route('desafio.sono', $challenge->id) }}",
      type: "POST",
      data: {
      _token: "{{ csrf_token() }}",
      percebe_sono: percebeSono,
      tempo_sono: tempoSono
      },
      success: function (response) {
      if (response.success) {
      window.location.href = "{{ route('desafio.show', $challenge->id) }}";
      }
      },
      error: function () {
      alert("Erro ao salvar. Verifique os campos.");
      }
      });
      }


      function iniciarDesafio() {
      $('#pergunta1, #explicacaoSinais, #tempoSonoForm, #confirmacaoTempo, #observarMaisTempo').hide();
      $('#desafioIniciado').show();
      }

      function observarMais() {
      $('#confirmacaoTempo').hide();
      $('#sugestaoTempo').text(tempoAceito);
      $('#observarMaisTempo').show();
      }
      </script>

    @endsection
@endsection
