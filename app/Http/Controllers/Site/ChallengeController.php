<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Challenge;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ChallengeController extends Controller
{
    public function __construct(Challenge $challenge)
    {

        $this->repository = $challenge;
        $this->middleware('auth.client:clients');
    }

    public function index()
    {
        $challenges = Auth::guard('clients')->user()->challenges()->get();

        $latest_challenge = Auth::guard('clients')->user()->challenges()->latest()->first();

        return view('site.desafio.index', compact('challenges', 'latest_challenge'));
    }

    public function chat()
    {


        return view('site.desafio.chat');
    }

    public function store(Request $request)
    {
        $client = Auth::guard('clients')->user();
        $challenge = $client->challenges()->create([
            'status' => 'INICIADO',
        ]);
        return redirect()->route('desafio.show', $challenge->id);
    }

    public function show($id)
    {
        if (!$challenge = $this->repository->find($id)
            || !$this->repository->find($id)->client_id == Auth::guard('clients')->user()->id) {
            return redirect()->back();
        }
        $challenge = $this->repository->find($id);

        $analyzes = $challenge->analyzes()->get();


        return view('site.desafio.show', compact('analyzes', 'challenge'));
    }

    public function analyzeCreate($id, $day)
    {
        if ($day < 1 || $day > 7) {
            return redirect()->back();
        }
        if (!$challenge = $this->repository->find($id)
            || !$this->repository->find($id)->client_id == Auth::guard('clients')->user()->id) {
            return redirect()->back();
        }
        $challenge = $this->repository->find($id);
        if (isset($this->repository->find($id)->analyzes()->where('day', $day)->first()->day)) {
            return redirect()->back();
        }

        if ($day > 1) {
            if (
                !isset($this->repository->find($id)->analyzes()->where('day', $day - 1)->first()->day)
                || !(date_format(now(), 'Y-d-m') >= date_format($challenge->analyzes()->where('day', $day - 1)->first()->created_at->addDays(1), 'Y-d-m'))
            ) {
                return redirect()->back();
            }
        }







        $challenge = $this->repository->find($id);
        return view('site.desafio.create', compact('challenge', 'day'));
    }
    public function analyzeCreateForm($id)
    {
        if (!$challenge = $this->repository->find($id)
            || !$this->repository->find($id)->client_id == Auth::guard('clients')->user()->id) {

            return redirect()->back();
        }
        if (isset($this->repository->find($id)->form()->first()->id)) {
            return redirect()->back();
        }
        $challenge = $this->repository->find($id);

        if (
            !isset($this->repository->find($id)->analyzes()->where('day', '7')->first()->day)
            || !(date_format(now(), 'Y-d-m') >= date_format($challenge->analyzes()->where('day', '7')->first()->created_at->addDays(1), 'Y-d-m'))
        ) {
            return redirect()->back();
        }




        return view('site.desafio.form', compact('challenge'));
    }

    public function desafioUpdate($id)
    {
        if (!$challenge = $this->repository->find($id)
            || !$this->repository->find($id)->client_id == Auth::guard('clients')->user()->id) {

            return redirect()->back();
        }
        $challenge = $this->repository->find($id);
        $challenge->update([
            'status' => 'ENVIADO'
        ]);
        return redirect()->route('desafio.show', $challenge->id)->with('sucesso', 'Desafio Enviado!');


    }

    public $message = [
        'date.required' => 'O campo Data da Avaliação é de preenchimento obrigatório',
        'date.date_format' => 'O campo Data da Avaliação deve ser preenchido no formato dd/mm/aaaa',

        'timeWokeUp.required' => 'O campo Horário que Acordou é de preenchimento obrigatório',
        'timeWokeUp.date_format' => 'O campo Horário que Acordou deve ser preenchido no formato HH:mm ',

        'comments.max' => 'O campo de Observações deve ter no máximo 200 caracteres',

        'soneca1_ss.after_or_equal' => 'O campo Horário que sentiu sono da Soneca 1 deve ser um horário após o Horário que Acordou',
        'soneca1_ss.date_format' => 'O campo Horário que sentiu sono da Soneca 1 deve ser preenchido no formato HH:mm ',

        'soneca1_hd.after_or_equal' => 'O campo Horário que dormiu  da Soneca 1 deve ser um horário após o Horário que sentiu sono da Soneca 1',
        'soneca1_hd.date_format' => 'O campo Horário que dormiu  da Soneca 1 deve ser preenchido no formato HH:mm ',
        'soneca1_hd.required_unless' => 'Preencha os dados completos da Soneca 1',

        'soneca1_ha.after_or_equal' => 'O campo Horário que acordou  da Soneca 1 deve ser um horário após o Horário que dormiu da Soneca 1',
        'soneca1_ha.date_format' => 'O campo Horário que acordou  da Soneca 1 deve ser preenchido no formato HH:mm ',
        'soneca1_ha.required_unless' => 'Preencha os dados completos da Soneca 1',

        'soneca2_ss.after_or_equal' => 'O campo Horário que sentiu sono da Soneca 2 deve ser um horário após o Horário que Acordou da Soneca 1',
        'soneca2_ss.date_format' => 'O campo Horário que sentiu sono da Soneca 2 deve ser preenchido no formato HH:mm ',

        'soneca2_hd.after_or_equal' => 'O campo Horário que dormiu  da Soneca 2 deve ser um horário após o Horário que sentiu sono da Soneca 2',
        'soneca2_hd.date_format' => 'O campo Horário que dormiu  da Soneca 2 deve ser preenchido no formato HH:mm ',
        'soneca2_hd.required_unless' => 'Preencha os dados completos da Soneca 2',

        'soneca2_ha.after_or_equal' => 'O campo Horário que acordou  da Soneca 2 deve ser um horário após o Horário que dormiu da Soneca 2',
        'soneca2_ha.date_format' => 'O campo Horário que acordou  da Soneca 2 deve ser preenchido no formato HH:mm ',
        'soneca2_ha.required_unless' => 'Preencha os dados completos da Soneca 2',

        'soneca3_ss.after_or_equal' => 'O campo Horário que sentiu sono da Soneca 3 deve ser um horário após o Horário que Acordou da Soneca 2',
        'soneca3_ss.date_format' => 'O campo Horário que sentiu sono da Soneca 3 deve ser preenchido no formato HH:mm ',

        'soneca3_hd.after_or_equal' => 'O campo Horário que dormiu  da Soneca 3 deve ser um horário após o Horário que sentiu sono da Soneca 3',
        'soneca3_hd.date_format' => 'O campo Horário que dormiu  da Soneca 3 deve ser preenchido no formato HH:mm ',
        'soneca3_hd.required_unless' => 'Preencha os dados completos da Soneca 3',

        'soneca3_ha.after_or_equal' => 'O campo Horário que acordou  da Soneca 3 deve ser um horário após o Horário que dormiu da Soneca 3',
        'soneca3_ha.date_format' => 'O campo Horário que acordou  da Soneca 3 deve ser preenchido no formato HH:mm ',
        'soneca3_ha.required_unless' => 'Preencha os dados completos da Soneca 3',

        'soneca4_ss.after_or_equal' => 'O campo Horário que sentiu sono da Soneca 4 deve ser um horário após o Horário que Acordou da Soneca 3',
        'soneca4_ss.date_format' => 'O campo Horário que sentiu sono da Soneca 4 deve ser preenchido no formato HH:mm ',

        'soneca4_hd.after_or_equal' => 'O campo Horário que dormiu  da Soneca 4 deve ser um horário após o Horário que sentiu sono da Soneca 4',
        'soneca4_hd.date_format' => 'O campo Horário que dormiu  da Soneca 4 deve ser preenchido no formato HH:mm ',
        'soneca4_hd.required_unless' => 'Preencha os dados completos da Soneca 4',

        'soneca4_ha.after_or_equal' => 'O campo Horário que acordou  da Soneca 4 deve ser um horário após o Horário que dormiu da Soneca 4',
        'soneca4_ha.date_format' => 'O campo Horário que acordou  da Soneca 4 deve ser preenchido no formato HH:mm ',
        'soneca4_ha.required_unless' => 'Preencha os dados completos da Soneca 4',

        'soneca5_ss.after_or_equal' => 'O campo Horário que sentiu sono da Soneca 5 deve ser um horário após o Horário que Acordou da Soneca 4',
        'soneca5_ss.date_format' => 'O campo Horário que sentiu sono da Soneca 5 deve ser preenchido no formato HH:mm ',

        'soneca5_hd.after_or_equal' => 'O campo Horário que dormiu  da Soneca 5 deve ser um horário após o Horário que sentiu sono da Soneca 5',
        'soneca5_hd.date_format' => 'O campo Horário que dormiu  da Soneca 5 deve ser preenchido no formato HH:mm ',
        'soneca5_hd.required_unless' => 'Preencha os dados completos da Soneca 5',

        'soneca5_ha.after_or_equal' => 'O campo Horário que acordou  da Soneca 5 deve ser um horário após o Horário que dormiu da Soneca 5',
        'soneca5_ha.date_format' => 'O campo Horário que acordou  da Soneca 5 deve ser preenchido no formato HH:mm ',
        'soneca5_ha.required_unless' => 'Preencha os dados completos da Soneca 5',

        'soneca6_ss.after_or_equal' => 'O campo Horário que sentiu sono da Soneca 6 deve ser um horário após o Horário que Acordou da Soneca 5',
        'soneca6_ss.date_format' => 'O campo Horário que sentiu sono da Soneca 6 deve ser preenchido no formato HH:mm ',

        'soneca6_hd.after_or_equal' => 'O campo Horário que dormiu  da Soneca 6 deve ser um horário após o Horário que sentiu sono da Soneca 6',
        'soneca6_hd.date_format' => 'O campo Horário que dormiu  da Soneca 6 deve ser preenchido no formato HH:mm ',
        'soneca6_hd.required_unless' => 'Preencha os dados completos da Soneca 6',

        'soneca6_ha.after_or_equal' => 'O campo Horário que acordou  da Soneca 6 deve ser um horário após o Horário que dormiu da Soneca 6',
        'soneca6_ha.date_format' => 'O campo Horário que acordou  da Soneca 6 deve ser preenchido no formato HH:mm ',
        'soneca6_ha.required_unless' => 'Preencha os dados completos da Soneca 6',

        'ritual_ss.required' => 'O campo Horário que sentiu sono do Ritual Noturno é de preenchimento obrigatório',
        'ritual_ss.date_format' => 'O campo Horário que sentiu sono do Ritual Noturno deve ser preenchido no formato HH:mm',

        'ritual_in.required' => 'O campo Horário que iniciou Ritual Noturno é de preenchimento obrigatório',
        'ritual_in.date_format' => 'O campo Horário que iniciou Ritual Noturno deve ser preenchido no formato HH:mm',
        'ritual_in.after_or_equal' => 'O campo Horário que iniciou Ritual Noturno deve ser um horário após o Horário que sentiu sono do Ritual Noturno',

        'ritual_d.required' => 'O campo Horário que dormiu no Ritual Noturno é de preenchimento obrigatório',
        'ritual_d.date_format' => 'O campo Horário que dormiu no Ritual Noturno deve ser preenchido no formato HH:mm',
        'ritual_d.after_or_equal' => 'O campo Horário que dormiu no Ritual Noturno deve ser um horário após o Horário que iniciou o Ritual Noturno',

        'despertar1_a.date_format' => 'O campo Horário que acordou  do Despertar 1 deve ser preenchido no formato HH:mm ',
        'despertar1_a.required_unless' => 'Preencha os dados completos do Despertar 1',

        'despertar1_d.date_format' => 'O campo Horário que dormiu  da Despertar 1 deve ser preenchido no formato HH:mm ',
        'despertar1_d.required_unless' => 'Preencha os dados completos da Despertar 1',

        'despertar1_fd.required_unless' => 'Preencha o campo como dormiu do Despertar 1',

        'despertar2_a.date_format' => 'O campo Horário que acordou  do Despertar 2 deve ser preenchido no formato HH:mm ',
        'despertar2_a.required_unless' => 'Preencha os dados completos do Despertar 2',

        'despertar2_d.date_format' => 'O campo Horário que dormiu  da Despertar 2 deve ser preenchido no formato HH:mm ',
        'despertar2_d.required_unless' => 'Preencha os dados completos da Despertar 2',

        'despertar2_fd.required_unless' => 'Preencha o campo como dormiu do Despertar 2',

        'despertar3_a.date_format' => 'O campo Horário que acordou  do Despertar 3 deve ser preenchido no formato HH:mm ',
        'despertar3_a.required_unless' => 'Preencha os dados completos do Despertar 3',

        'despertar3_d.date_format' => 'O campo Horário que dormiu  da Despertar 3 deve ser preenchido no formato HH:mm ',
        'despertar3_d.required_unless' => 'Preencha os dados completos da Despertar 3',

        'despertar3_fd.required_unless' => 'Preencha o campo como dormiu do Despertar 3',

        'despertar4_a.date_format' => 'O campo Horário que acordou  do Despertar 4 deve ser preenchido no formato HH:mm ',
        'despertar4_a.required_unless' => 'Preencha os dados completos do Despertar 4',

        'despertar4_d.date_format' => 'O campo Horário que dormiu  da Despertar 4 deve ser preenchido no formato HH:mm ',
        'despertar4_d.required_unless' => 'Preencha os dados completos da Despertar 4',

        'despertar4_fd.required_unless' => 'Preencha o campo como dormiu do Despertar 4',

        'despertar5_a.date_format' => 'O campo Horário que acordou  do Despertar 5 deve ser preenchido no formato HH:mm ',
        'despertar5_a.required_unless' => 'Preencha os dados completos do Despertar 5',

        'despertar5_d.date_format' => 'O campo Horário que dormiu  da Despertar 5 deve ser preenchido no formato HH:mm ',
        'despertar5_d.required_unless' => 'Preencha os dados completos da Despertar 5',

        'despertar5_fd.required_unless' => 'Preencha o campo como dormiu do Despertar 5',

        'despertar6_a.date_format' => 'O campo Horário que acordou  do Despertar 6 deve ser preenchido no formato HH:mm ',
        'despertar6_a.required_unless' => 'Preencha os dados completos do Despertar 6',

        'despertar6_d.date_format' => 'O campo Horário que dormiu  da Despertar 6 deve ser preenchido no formato HH:mm ',
        'despertar6_d.required_unless' => 'Preencha os dados completos da Despertar 6',

        'despertar6_fd.required_unless' => 'Preencha o campo como dormiu do Despertar 6',


    ];

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'date' => 'required|date_format:d/m/Y',
            'timeWokeUp' => 'required|date_format:H:i',
            'volcanicEffect' => 'nullable|string',
            'comments' => 'nullable|string|max:200',
            'soneca1_ss' => 'nullable|after_or_equal:timeWokeUp|date_format:H:i',
            'soneca1_hd' => 'nullable|after_or_equal:soneca1_ss|date_format:H:i|required_unless:soneca1_ss,null',
            'soneca1_ha' => 'nullable|after_or_equal:soneca1_hd|date_format:H:i|required_unless:soneca1_ha,null',

            'soneca2_ss' => 'nullable|after_or_equal:soneca1_ha|date_format:H:i',
            'soneca2_hd' => 'nullable|after_or_equal:soneca2_ss|date_format:H:i|required_unless:soneca2_ss,null',
            'soneca2_ha' => 'nullable|after_or_equal:soneca2_hd|date_format:H:i|required_unless:soneca2_ha,null',

            'soneca3_ss' => 'nullable|after_or_equal:soneca2_ha|date_format:H:i',
            'soneca3_hd' => 'nullable|after_or_equal:soneca3_ss|date_format:H:i|required_unless:soneca3_ss,null',
            'soneca3_ha' => 'nullable|after_or_equal:soneca3_hd|date_format:H:i|required_unless:soneca3_ha,null',

            'soneca4_ss' => 'nullable|after_or_equal:soneca3_ha|date_format:H:i',
            'soneca4_hd' => 'nullable|after_or_equal:soneca4_ss|date_format:H:i|required_unless:soneca4_ss,null',
            'soneca4_ha' => 'nullable|after_or_equal:soneca4_hd|date_format:H:i|required_unless:soneca4_ha,null',

            'soneca5_ss' => 'nullable|after_or_equal:soneca4_ha|date_format:H:i',
            'soneca5_hd' => 'nullable|after_or_equal:soneca5_ss|date_format:H:i|required_unless:soneca5_ss,null',
            'soneca5_ha' => 'nullable|after_or_equal:soneca5_hd|date_format:H:i|required_unless:soneca5_ha,null',

            'soneca6_ss' => 'nullable|after_or_equal:soneca5_ha|date_format:H:i',
            'soneca6_hd' => 'nullable|after_or_equal:soneca6_ss|date_format:H:i|required_unless:soneca6_ss,null',
            'soneca6_ha' => 'nullable|after_or_equal:soneca6_hd|date_format:H:i|required_unless:soneca6_ha,null',

            'ritual_ss' => 'required|date_format:H:i',
            'ritual_in' => 'required|after_or_equal:ritual_ss|date_format:H:i',
            'ritual_d' => 'required|after_or_equal:ritual_in|date_format:H:i',

            'despertar1_a' => 'nullable|date_format:H:i',
            'despertar1_d' => 'nullable|date_format:H:i|required_unless:despertar1_a,null',
            'despertar1_fd' => 'nullable|required_unless:despertar1_a,null',

            'despertar2_a' => 'nullable|date_format:H:i',
            'despertar2_d' => 'nullable|date_format:H:i|required_unless:despertar2_a,null',
            'despertar2_fd' => 'nullable|required_unless:despertar2_a,null',

            'despertar3_a' => 'nullable|date_format:H:i',
            'despertar3_d' => 'nullable|date_format:H:i|required_unless:despertar3_a,null',
            'despertar3_fd' => 'nullable|required_unless:despertar3_a,null',

            'despertar4_a' => 'nullable|date_format:H:i',
            'despertar4_d' => 'nullable|date_format:H:i|required_unless:despertar4_a,null',
            'despertar4_fd' => 'nullable|required_unless:despertar4_a,null',

            'despertar5_a' => 'nullable|date_format:H:i',
            'despertar5_d' => 'nullable|date_format:H:i|required_unless:despertar5_a,null',
            'despertar5_fd' => 'nullable|required_unless:despertar5_a,null',

            'despertar6_a' => 'nullable|date_format:H:i',
            'despertar6_d' => 'nullable|date_format:H:i|required_unless:despertar6_a,null',
            'despertar6_fd' => 'nullable|required_unless:despertar6_a,null',


        ], $this->message);
    }

    public function analyzeStoreForm(Request $request, $id)
    {

        if (!$challenge = $this->repository->find($id)
            || !$this->repository->find($id)->client_id == Auth::guard('clients')->user()->id) {
            return redirect()->back();
        }
        $challenge = $this->repository->find($id);

        if ($request->ritual_luz == null) {
            $request->ritual_luz = "N";
        }
        if ($request->ritual_ruido == null) {
            $request->ritual_ruido = "N";
        }
        if ($request->ritual_estimulo == null) {
            $request->ritual_estimulo = "N";
        }
        if ($request->ritual_retira == null) {
            $request->ritual_retira = "N";
        }
        if ($request->obstaculos_colica == null) {
            $request->obstaculos_colica = "N";
        }
        if ($request->obstaculos_refluxo == null) {
            $request->obstaculos_refluxo = "N";
        }
        if ($request->obstaculos_gases == null) {
            $request->obstaculos_gases = "N";
        }
        if ($request->obstaculos_APLV == null) {
            $request->obstaculos_APLV = "N";
        }
        if ($request->obstaculos_APLV == null) {
            $request->obstaculos_APLV = "N";
        }
        if ($request->soneca_acordado_berco == null) {
            $request->soneca_acordado_berco = "N";
        }
        if ($request->soneca_dorme_colo_berco == null) {
            $request->soneca_dorme_colo_berco = "N";
        }
        if ($request->soneca_dorme_colo == null) {
            $request->soneca_dorme_colo = "N";
        }
        if ($request->soneca_cama_compartilhada == null) {
            $request->soneca_cama_compartilhada = "N";
        }
        if ($request->soneca_cama_compartilhada == null) {
            $request->soneca_cama_compartilhada = "N";
        }
        if ($request->soneca_carrinho == null) {
            $request->soneca_carrinho = "N";
        }
        if ($request->soneca_rede == null) {
            $request->soneca_rede = "N";
        }
        if ($request->soneca_outro == null) {
            $request->soneca_outro = "N";
        }

        if ($request->associacao_soneca_ruido_branco == null) {
            $request->associacao_soneca_ruido_branco = "N";
        }
        if ($request->associacao_soneca_naninha == null) {
            $request->associacao_soneca_naninha = "N";
        }
        if ($request->associacao_soneca_chupeta == null) {
            $request->associacao_soneca_chupeta = "N";
        }
        if ($request->associacao_soneca_chupar_dedo == null) {
            $request->associacao_soneca_chupar_dedo = "N";
        }
        if ($request->associacao_soneca_mamar == null) {
            $request->associacao_soneca_mamar = "N";
        }
        if ($request->associacao_soneca_outro == null) {
            $request->associacao_soneca_outro = "N";
        }

        if ($request->associacao_noturno_ruido_branco == null) {
            $request->associacao_noturno_ruido_branco = "N";
        }
        if ($request->associacao_noturno_naninha == null) {
            $request->associacao_noturno_naninha = "N";
        }
        if ($request->associacao_noturno_chupeta == null) {
            $request->associacao_noturno_chupeta = "N";
        }
        if ($request->associacao_noturno_chupar_dedo == null) {
            $request->associacao_noturno_chupar_dedo = "N";
        }
        if ($request->associacao_noturno_mamar == null) {
            $request->associacao_noturno_mamar = "N";
        }
        if ($request->associacao_noturno_outro == null) {
            $request->associacao_noturno_outro = "N";
        }
        if ($request->conclusao_imaturidade == null) {
            $request->conclusao_imaturidade = "N";
        }
        if ($request->conclusao_fome == null) {
            $request->conclusao_fome = "N";
        }
        if ($request->conclusao_dor == null) {
            $request->conclusao_dor = "N";
        }
        if ($request->conclusao_salto == null) {
            $request->conclusao_salto = "N";
        }
        if ($request->conclusao_angustia == null) {
            $request->conclusao_angustia = "N";
        }
        if ($request->conclusao_telas == null) {
            $request->conclusao_telas = "N";
        }
        if ($request->conclusao_estresse == null) {
            $request->conclusao_estresse = "N";
        }








        $form = $challenge->form()->create([

            'ritualGoodMorning' => $request->ritualBomDia,
            'jump' => $request->salto,
            'ritualGoodMorningLight' => $request->ritual_luz,
            'ritualGoodMorningNoise' => $request->ritual_ruido,
            'ritualGoodMorningStimulus' => $request->ritual_estimulo,
            'ritualGoodMorningRemove' => $request->ritual_retira,
            'typeEatingRoutine' => $request->rotinaAlimentar,
            'routineDifficulties' => $request->dificuldadeRotinaAlimentar,
            'weightGain' => $request->ganhoPeso,
            'colicObstacle' => $request->obstaculos_colica,
            'refluxObstacle' => $request->obstaculos_refluxo,
            'gasObstacle' => $request->obstaculos_gases,
            'aplvObstacle' => $request->obstaculos_APLV,
            'energyExpenditure' => $request->gastoEnergia,
            'noticeSigns' => $request->sinaisSono,
            'slowDown' => $request->desacelera,
            'ritualType' => $request->ritualSonecasChoro,
            'environmentNapsLights' => $request->soneca_luzes,
            'environmentNapsNoises' => $request->soneca_ruidos,
            'environmentNapsTemperature' => $request->soneca_temperatura,
            'whereSleepCrib' => $request->soneca_acordado_berco,
            'whereSleepLap' => $request->soneca_dorme_colo_berco,
            'whereSleepLapCrib' => $request->soneca_dorme_colo,
            'whereSleepSharedBed' => $request->soneca_cama_compartilhada,
            'whereSleepCar' => $request->soneca_carrinho,
            'whereSleepRede' => $request->soneca_rede,
            'whereSleepOther' => $request->soneca_outro,
            'environmentNapBother' => $request->soneca_local_incomoda,
            'napAssociationWhiteNoise' => $request->associacao_soneca_ruido_branco,
            'napAssociationCloth' => $request->associacao_soneca_naninha,
            'napAssociationPacifier' => $request->associacao_soneca_chupeta,
            'napAssociationSuckFinger' => $request->associacao_soneca_chupar_dedo,
            'napAssociationSuckle' => $request->associacao_soneca_mamar,
            'napAssociationOther' => $request->associacao_soneca_outro,
            'enoughNap' => $request->soneca_suficiente,
            'wakeUpNap' => $request->soneca_acorda,
            'nightRitual' => $request->ritaualNoturno,
            'environmentRitualLights' => $request->sn_luzes,
            'environmentRitualNoises' => $request->sn_ruidos,
            'environmentRitualTemperature' => $request->sn_temperatura,
            'ritualAssociationWhiteNoise' => $request->associacao_noturno_ruido_branco,
            'ritualAssociationCloth' => $request->associacao_noturno_naninha,
            'ritualAssociationPacifier' => $request->associacao_noturno_chupeta,
            'ritualAssociationSuckFinger' => $request->associacao_noturno_chupar_dedo,
            'ritualAssociationSuckle' => $request->associacao_noturno_mamar,
            'ritualAssociationOther' => $request->associacao_noturno_outro,
            'conclusionImmaturity' => $request->conclusao_imaturidade,
            'conclusionHungry' => $request->conclusao_fome,
            'conclusionAche' => $request->conclusao_dor,
            'conclusionJump' => $request->conclusao_salto,
            'conclusionAnguish' => $request->conclusao_angustia,
            'conclusionScreens' => $request->conclusao_telas,
            'conclusionStress' => $request->conclusao_estresse,
            'comments' => '',

        ]);
        return redirect()->route('desafio.show', $challenge->id)->with('sucesso', 'Formulário Final Concluído');
    }
    public function analyzeStore(Request $request, $id, $day)
    {
        //dd(\Carbon\Carbon::parse('00:25')->diffInMinutes(\Carbon\Carbon::parse('23:50'),true));
        $ritual_window = $request->timeWokeUp;
        if (!$challenge = $this->repository->find($id)
            || !$this->repository->find($id)->client_id == Auth::guard('clients')->user()->id) {
            return redirect()->back();
        }


        $this->validator($request->all())->validate();
        $challenge = $this->repository->find($id);

        if ($request->volcanicEffect == null) {
            $request->volcanicEffect = 'N';
        }

        if ($request->comments == null) {
            $request->comments = '';
        }

        $analyze = $challenge->analyzes()->create([
            'day' => $day,
            'date' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d'),

            'timeWokeUp' => $request->timeWokeUp,
            'volcanicEffect' => $request->volcanicEffect,
            'comments' => $request->comments
        ]);

        if ($request->soneca1_ss != null) {
            $request->timeWokeUp = \Carbon\Carbon::parse($request->timeWokeUp);
            $request->soneca1_ss = \Carbon\Carbon::parse($request->soneca1_ss);
            $request->soneca1_hd = \Carbon\Carbon::parse($request->soneca1_hd);
            $request->soneca1_ha = \Carbon\Carbon::parse($request->soneca1_ha);
            $ritual_window = $request->soneca1_ha;
            $analyze->naps()->create([
                'number' => '1',
                'timeSlept' => $request->soneca1_hd,
                'timeWokeUp' => $request->soneca1_ha,
                'signalSlept' => $request->soneca1_ss,
                'window' => $request->soneca1_hd->diffInMinutes($request->timeWokeUp),
                'windowSignalSlept' => $request->soneca1_hd->diffInMinutes($request->soneca1_ss),
                'duration' => $request->soneca1_ha->diffInMinutes($request->soneca1_hd),
            ]);
        }

        if ($request->soneca2_ss != null) {
            $request->soneca2_ss = \Carbon\Carbon::parse($request->soneca2_ss);
            $request->soneca2_hd = \Carbon\Carbon::parse($request->soneca2_hd);
            $request->soneca2_ha = \Carbon\Carbon::parse($request->soneca2_ha);
            $ritual_window = $request->soneca2_ha;

            $analyze->naps()->create([
                'number' => '2',
                'timeSlept' => $request->soneca2_hd,
                'timeWokeUp' => $request->soneca2_ha,
                'signalSlept' => $request->soneca2_ss,
                'window' => $request->soneca2_hd->diffInMinutes($request->soneca1_ha),
                'windowSignalSlept' => $request->soneca2_hd->diffInMinutes($request->soneca2_ss),
                'duration' => $request->soneca2_ha->diffInMinutes($request->soneca2_hd),
            ]);
        }

        if ($request->soneca3_ss != null) {
            $request->soneca3_ss = \Carbon\Carbon::parse($request->soneca3_ss);
            $request->soneca3_hd = \Carbon\Carbon::parse($request->soneca3_hd);
            $request->soneca3_ha = \Carbon\Carbon::parse($request->soneca3_ha);
            $ritual_window = $request->soneca3_ha;

            $analyze->naps()->create([
                'number' => '3',
                'timeSlept' => $request->soneca3_hd,
                'timeWokeUp' => $request->soneca3_ha,
                'signalSlept' => $request->soneca3_ss,
                'window' => $request->soneca3_hd->diffInMinutes($request->soneca2_ha),
                'windowSignalSlept' => $request->soneca3_hd->diffInMinutes($request->soneca3_ss),
                'duration' => $request->soneca3_ha->diffInMinutes($request->soneca3_hd),
            ]);
        }

        if ($request->soneca4_ss != null) {
            $request->soneca3_ss = \Carbon\Carbon::parse($request->soneca4_ss);
            $request->soneca4_hd = \Carbon\Carbon::parse($request->soneca4_hd);
            $request->soneca4_ha = \Carbon\Carbon::parse($request->soneca4_ha);
            $ritual_window = $request->soneca4_ha;

            $analyze->naps()->create([
                'number' => '4',
                'timeSlept' => $request->soneca4_hd,
                'timeWokeUp' => $request->soneca4_ha,
                'signalSlept' => $request->soneca4_ss,
                'window' => $request->soneca4_hd->diffInMinutes($request->soneca3_ha),
                'windowSignalSlept' => $request->soneca4_hd->diffInMinutes($request->soneca4_ss),
                'duration' => $request->soneca4_ha->diffInMinutes($request->soneca4_hd),
            ]);
        }

        if ($request->soneca5_ss != null) {
            $request->soneca5_ss = \Carbon\Carbon::parse($request->soneca5_ss);
            $request->soneca5_hd = \Carbon\Carbon::parse($request->soneca5_hd);
            $request->soneca5_ha = \Carbon\Carbon::parse($request->soneca5_ha);
            $ritual_window = $request->soneca5_ha;

            $analyze->naps()->create([
                'number' => '5',
                'timeSlept' => $request->soneca5_hd,
                'timeWokeUp' => $request->soneca5_ha,
                'signalSlept' => $request->soneca5_ss,
                'window' => $request->soneca5_hd->diffInMinutes($request->soneca4_ha),
                'windowSignalSlept' => $request->soneca5_hd->diffInMinutes($request->soneca5_ss),
                'duration' => $request->soneca5_ha->diffInMinutes($request->soneca5_hd),
            ]);
        }

        if ($request->soneca6_ss != null) {
            $request->soneca5_ss = \Carbon\Carbon::parse($request->soneca6_ss);
            $request->soneca6_hd = \Carbon\Carbon::parse($request->soneca6_hd);
            $request->soneca6_ha = \Carbon\Carbon::parse($request->soneca6_ha);
            $ritual_window = $request->soneca6_ha;

            $analyze->naps()->create([
                'number' => '6',
                'timeSlept' => $request->soneca6_hd,
                'timeWokeUp' => $request->soneca6_ha,
                'signalSlept' => $request->soneca6_ss,
                'window' => $request->soneca6_hd->diffInMinutes($request->soneca5_ha),
                'windowSignalSlept' => $request->soneca6_hd->diffInMinutes($request->soneca6_ss),
                'duration' => $request->soneca6_ha->diffInMinutes($request->soneca6_hd),
            ]);
        }

        if ($request->ritual_ss != null) {
            $request->ritual_ss = \Carbon\Carbon::parse($request->ritual_ss);
            $request->ritual_in = \Carbon\Carbon::parse($request->ritual_in);
            $request->ritual_d = \Carbon\Carbon::parse($request->ritual_d);
            $analyze->rituals()->create([
                'signalSlept' => $request->ritual_ss,
                'start' => $request->ritual_in,
                'end' => $request->ritual_d,
                'duration' => $request->ritual_d->diffInMinutes($request->ritual_in),
                'window' => $request->ritual_in->diffInMinutes($ritual_window),
                'windowSignalSlept' => $request->ritual_in->diffInMinutes($request->ritual_ss)
            ]);
        }



        if ($request->despertar1_a != null) {
            $request->despertar1_a = \Carbon\Carbon::parse($request->despertar1_a);
            $request->despertar1_d = \Carbon\Carbon::parse($request->despertar1_d);

            if ($request->despertar1_a->format('H') >= 0 && $request->despertar1_a->format('H') < 7) {
                $request->despertar1_a->addDays(1);
            }

            if ($request->despertar1_d->format('H') >= 0 && $request->despertar1_d->format('H') < 7) {
                $request->despertar1_d->addDays(1);
            }
            if ($request->despertar1_fd == 4) {
                $request->despertar1_fd = $request->despertar1_fd_outro;
            }
            $analyze->wakes()->create([
                'number' => '1',
                'timeWokeUp' => $request->despertar1_a,
                'timeSlept' => $request->despertar1_d,
                'duration' => $request->despertar1_d->diffInMinutes($request->despertar1_a),
                'sleepingMode' => $request->despertar1_fd
            ]);
        }
        if ($request->despertar2_a != null) {
            $request->despertar2_a = \Carbon\Carbon::parse($request->despertar2_a);
            $request->despertar2_d = \Carbon\Carbon::parse($request->despertar2_d);

            if ($request->despertar2_a->format('H') >= 0 && $request->despertar2_a->format('H') < 7) {
                $request->despertar2_a->addDays(1);
            }

            if ($request->despertar2_d->format('H') >= 0 && $request->despertar2_d->format('H') < 7) {
                $request->despertar2_d->addDays(1);
            }
            if ($request->despertar2_fd == 4) {
                $request->despertar2_fd = $request->despertar2_fd_outro;
            }
            $analyze->wakes()->create([
                'number' => '2',
                'timeWokeUp' => $request->despertar2_a,
                'timeSlept' => $request->despertar2_d,
                'duration' => $request->despertar2_d->diffInMinutes($request->despertar2_a),
                'sleepingMode' => $request->despertar2_fd
            ]);
        }

        if ($request->despertar3_a != null) {
            $request->despertar3_a = \Carbon\Carbon::parse($request->despertar3_a);
            $request->despertar3_d = \Carbon\Carbon::parse($request->despertar3_d);

            if ($request->despertar3_a->format('H') >= 0 && $request->despertar3_a->format('H') < 7) {
                $request->despertar3_a->addDays(1);
            }

            if ($request->despertar3_d->format('H') >= 0 && $request->despertar3_d->format('H') < 7) {
                $request->despertar3_d->addDays(1);
            }
            if ($request->despertar3_fd == 4) {
                $request->despertar3_fd = $request->despertar3_fd_outro;
            }
            $analyze->wakes()->create([
                'number' => '3',
                'timeWokeUp' => $request->despertar3_a,
                'timeSlept' => $request->despertar3_d,
                'duration' => $request->despertar3_d->diffInMinutes($request->despertar3_a),
                'sleepingMode' => $request->despertar3_fd
            ]);
        }

        if ($request->despertar4_a != null) {
            $request->despertar4_a = \Carbon\Carbon::parse($request->despertar4_a);
            $request->despertar4_d = \Carbon\Carbon::parse($request->despertar4_d);

            if ($request->despertar4_a->format('H') >= 0 && $request->despertar4_a->format('H') < 7) {
                $request->despertar4_a->addDays(1);
            }

            if ($request->despertar4_d->format('H') >= 0 && $request->despertar4_d->format('H') < 7) {
                $request->despertar4_d->addDays(1);
            }
            if ($request->despertar4_fd == 4) {
                $request->despertar4_fd = $request->despertar4_fd_outro;
            }
            $analyze->wakes()->create([
                'number' => '4',
                'timeWokeUp' => $request->despertar4_a,
                'timeSlept' => $request->despertar4_d,
                'duration' => $request->despertar4_d->diffInMinutes($request->despertar4_a),
                'sleepingMode' => $request->despertar4_fd
            ]);
        }

        if ($request->despertar5_a != null) {
            $request->despertar5_a = \Carbon\Carbon::parse($request->despertar5_a);
            $request->despertar5_d = \Carbon\Carbon::parse($request->despertar5_d);

            if ($request->despertar5_a->format('H') >= 0 && $request->despertar5_a->format('H') < 7) {
                $request->despertar5_a->addDays(1);
            }

            if ($request->despertar5_d->format('H') >= 0 && $request->despertar5_d->format('H') < 7) {
                $request->despertar5_d->addDays(1);
            }
            if ($request->despertar5_fd == 4) {
                $request->despertar5_fd = $request->despertar5_fd_outro;
            }
            $analyze->wakes()->create([
                'number' => '5',
                'timeWokeUp' => $request->despertar5_a,
                'timeSlept' => $request->despertar5_d,
                'duration' => $request->despertar5_d->diffInMinutes($request->despertar5_a),
                'sleepingMode' => $request->despertar5_fd
            ]);
        }

        if ($request->despertar6_a != null) {
            $request->despertar6_a = \Carbon\Carbon::parse($request->despertar6_a);
            $request->despertar6_d = \Carbon\Carbon::parse($request->despertar6_d);

            if ($request->despertar6_a->format('H') >= 0 && $request->despertar6_a->format('H') < 7) {
                $request->despertar6_a->addDays(1);
            }

            if ($request->despertar6_d->format('H') >= 0 && $request->despertar6_d->format('H') < 7) {
                $request->despertar6_d->addDays(1);
            }
            if ($request->despertar6_fd == 4) {
                $request->despertar6_fd = $request->despertar6_fd_outro;
            }
            $analyze->wakes()->create([
                'number' => '6',
                'timeWokeUp' => $request->despertar6_a,
                'timeSlept' => $request->despertar6_d,
                'duration' => $request->despertar6_d->diffInMinutes($request->despertar6_a),
                'sleepingMode' => $request->despertar6_fd
            ]);
        }
        return redirect()->route('desafio.show', $challenge->id)->with('sucesso', 'Análise realizada');
    }

    public function analyzeEdit($id, $day)
    {
        $challenge = $this->repository->find($id);
        $analyze = $challenge->analyzes()->where('day', $day)->first();
        $ritual = $analyze->rituals()->first();
        $naps = $analyze->naps()->get();
        $wakes = $analyze->wakes()->get();
        return view('site.desafio.edit', compact('analyze', 'day', 'challenge', 'ritual', 'naps', 'wakes'));
    }

    public function analyzeUpdate($id, $day, Request $request)
    {
        $ritual_window = $request->timeWokeUp;
        if (!$challenge = $this->repository->find($id)
            || !$this->repository->find($id)->client_id == Auth::guard('clients')->user()->id) {
            return redirect()->back();
        }

        if ($request->volcanicEffect == null) {
            $request->volcanicEffect = 'N';
        }

        if ($request->comments == null) {
            $request->comments = '';
        }

        $this->validator($request->all())->validate();
        $challenge = $this->repository->find($id);

        $challenge->analyzes()->where('day', $day)->update([
            'day' => $day,
            'date' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d'),

            'timeWokeUp' => $request->timeWokeUp,
            'volcanicEffect' => $request->volcanicEffect,

        ]);
        $analyze = $challenge->analyzes()->where('day', $day)->first();
        $analyze->naps()->delete();
        $analyze->wakes()->delete();

        if ($request->soneca1_ss != null) {
            $request->timeWokeUp = \Carbon\Carbon::parse($request->timeWokeUp);
            $request->soneca1_ss = \Carbon\Carbon::parse($request->soneca1_ss);
            $request->soneca1_hd = \Carbon\Carbon::parse($request->soneca1_hd);
            $request->soneca1_ha = \Carbon\Carbon::parse($request->soneca1_ha);
            $ritual_window = $request->soneca1_ha;
            $analyze->naps()->create([
                'number' => '1',
                'timeSlept' => $request->soneca1_hd,
                'timeWokeUp' => $request->soneca1_ha,
                'signalSlept' => $request->soneca1_ss,
                'window' => $request->soneca1_hd->diffInMinutes($request->timeWokeUp),
                'windowSignalSlept' => $request->soneca1_hd->diffInMinutes($request->soneca1_ss),
                'duration' => $request->soneca1_ha->diffInMinutes($request->soneca1_hd),
            ]);
        }

        if ($request->soneca2_ss != null) {
            $request->soneca2_ss = \Carbon\Carbon::parse($request->soneca2_ss);
            $request->soneca2_hd = \Carbon\Carbon::parse($request->soneca2_hd);
            $request->soneca2_ha = \Carbon\Carbon::parse($request->soneca2_ha);
            $ritual_window = $request->soneca2_ha;

            $analyze->naps()->create([
                'number' => '2',
                'timeSlept' => $request->soneca2_hd,
                'timeWokeUp' => $request->soneca2_ha,
                'signalSlept' => $request->soneca2_ss,
                'window' => $request->soneca2_hd->diffInMinutes($request->soneca1_ha),
                'windowSignalSlept' => $request->soneca2_hd->diffInMinutes($request->soneca2_ss),
                'duration' => $request->soneca2_ha->diffInMinutes($request->soneca2_hd),
            ]);
        }

        if ($request->soneca3_ss != null) {
            $request->soneca3_ss = \Carbon\Carbon::parse($request->soneca3_ss);
            $request->soneca3_hd = \Carbon\Carbon::parse($request->soneca3_hd);
            $request->soneca3_ha = \Carbon\Carbon::parse($request->soneca3_ha);
            $ritual_window = $request->soneca3_ha;

            $analyze->naps()->create([
                'number' => '3',
                'timeSlept' => $request->soneca3_hd,
                'timeWokeUp' => $request->soneca3_ha,
                'signalSlept' => $request->soneca3_ss,
                'window' => $request->soneca3_hd->diffInMinutes($request->soneca2_ha),
                'windowSignalSlept' => $request->soneca3_hd->diffInMinutes($request->soneca3_ss),
                'duration' => $request->soneca3_ha->diffInMinutes($request->soneca3_hd),
            ]);
        }

        if ($request->soneca4_ss != null) {
            $request->soneca3_ss = \Carbon\Carbon::parse($request->soneca4_ss);
            $request->soneca4_hd = \Carbon\Carbon::parse($request->soneca4_hd);
            $request->soneca4_ha = \Carbon\Carbon::parse($request->soneca4_ha);
            $ritual_window = $request->soneca4_ha;

            $analyze->naps()->create([
                'number' => '4',
                'timeSlept' => $request->soneca4_hd,
                'timeWokeUp' => $request->soneca4_ha,
                'signalSlept' => $request->soneca4_ss,
                'window' => $request->soneca4_hd->diffInMinutes($request->soneca3_ha),
                'windowSignalSlept' => $request->soneca4_hd->diffInMinutes($request->soneca4_ss),
                'duration' => $request->soneca4_ha->diffInMinutes($request->soneca4_hd),
            ]);
        }

        if ($request->soneca5_ss != null) {
            $request->soneca5_ss = \Carbon\Carbon::parse($request->soneca5_ss);
            $request->soneca5_hd = \Carbon\Carbon::parse($request->soneca5_hd);
            $request->soneca5_ha = \Carbon\Carbon::parse($request->soneca5_ha);
            $ritual_window = $request->soneca5_ha;

            $analyze->naps()->create([
                'number' => '5',
                'timeSlept' => $request->soneca5_hd,
                'timeWokeUp' => $request->soneca5_ha,
                'signalSlept' => $request->soneca5_ss,
                'window' => $request->soneca5_hd->diffInMinutes($request->soneca4_ha),
                'windowSignalSlept' => $request->soneca5_hd->diffInMinutes($request->soneca5_ss),
                'duration' => $request->soneca5_ha->diffInMinutes($request->soneca5_hd),
            ]);
        }

        if ($request->soneca6_ss != null) {
            $request->soneca5_ss = \Carbon\Carbon::parse($request->soneca6_ss);
            $request->soneca6_hd = \Carbon\Carbon::parse($request->soneca6_hd);
            $request->soneca6_ha = \Carbon\Carbon::parse($request->soneca6_ha);
            $ritual_window = $request->soneca6_ha;

            $analyze->naps()->create([
                'number' => '6',
                'timeSlept' => $request->soneca6_hd,
                'timeWokeUp' => $request->soneca6_ha,
                'signalSlept' => $request->soneca6_ss,
                'window' => $request->soneca6_hd->diffInMinutes($request->soneca5_ha),
                'windowSignalSlept' => $request->soneca6_hd->diffInMinutes($request->soneca6_ss),
                'duration' => $request->soneca6_ha->diffInMinutes($request->soneca6_hd),
            ]);
        }


        if ($request->ritual_ss != null) {
            $request->ritual_ss = \Carbon\Carbon::parse($request->ritual_ss);
            $request->ritual_in = \Carbon\Carbon::parse($request->ritual_in);
            $request->ritual_d = \Carbon\Carbon::parse($request->ritual_d);
            $analyze->rituals()->first()->update([
                'signalSlept' => $request->ritual_ss,
                'start' => $request->ritual_in,
                'end' => $request->ritual_d,
                'duration' => $request->ritual_d->diffInMinutes($request->ritual_in),
                'window' => $request->ritual_in->diffInMinutes($ritual_window),
                'windowSignalSlept' => $request->ritual_in->diffInMinutes($request->ritual_ss)
            ]);
        }
        if ($request->despertar1_a != null) {
            $request->despertar1_a = \Carbon\Carbon::parse($request->despertar1_a);
            $request->despertar1_d = \Carbon\Carbon::parse($request->despertar1_d);

            if ($request->despertar1_a->format('H') >= 0 && $request->despertar1_a->format('H') < 7) {
                $request->despertar1_a->addDays(1);
            }

            if ($request->despertar1_d->format('H') >= 0 && $request->despertar1_d->format('H') < 7) {
                $request->despertar1_d->addDays(1);
            }
            if ($request->despertar1_fd == 4) {
                $request->despertar1_fd = $request->despertar1_fd_outro;
            }
            $analyze->wakes()->create([
                'number' => '1',
                'timeWokeUp' => $request->despertar1_a,
                'timeSlept' => $request->despertar1_d,
                'duration' => $request->despertar1_d->diffInMinutes($request->despertar1_a),
                'sleepingMode' => $request->despertar1_fd
            ]);
        }
        if ($request->despertar2_a != null) {
            $request->despertar2_a = \Carbon\Carbon::parse($request->despertar2_a);
            $request->despertar2_d = \Carbon\Carbon::parse($request->despertar2_d);

            if ($request->despertar2_a->format('H') >= 0 && $request->despertar2_a->format('H') < 7) {
                $request->despertar2_a->addDays(1);
            }

            if ($request->despertar2_d->format('H') >= 0 && $request->despertar2_d->format('H') < 7) {
                $request->despertar2_d->addDays(1);
            }
            if ($request->despertar2_fd == 4) {
                $request->despertar2_fd = $request->despertar2_fd_outro;
            }
            $analyze->wakes()->create([
                'number' => '2',
                'timeWokeUp' => $request->despertar2_a,
                'timeSlept' => $request->despertar2_d,
                'duration' => $request->despertar2_d->diffInMinutes($request->despertar2_a),
                'sleepingMode' => $request->despertar2_fd
            ]);
        }

        if ($request->despertar3_a != null) {
            $request->despertar3_a = \Carbon\Carbon::parse($request->despertar3_a);
            $request->despertar3_d = \Carbon\Carbon::parse($request->despertar3_d);

            if ($request->despertar3_a->format('H') >= 0 && $request->despertar3_a->format('H') < 7) {
                $request->despertar3_a->addDays(1);
            }

            if ($request->despertar3_d->format('H') >= 0 && $request->despertar3_d->format('H') < 7) {
                $request->despertar3_d->addDays(1);
            }
            if ($request->despertar3_fd == 4) {
                $request->despertar3_fd = $request->despertar3_fd_outro;
            }
            $analyze->wakes()->create([
                'number' => '3',
                'timeWokeUp' => $request->despertar3_a,
                'timeSlept' => $request->despertar3_d,
                'duration' => $request->despertar3_d->diffInMinutes($request->despertar3_a),
                'sleepingMode' => $request->despertar3_fd
            ]);
        }

        if ($request->despertar4_a != null) {
            $request->despertar4_a = \Carbon\Carbon::parse($request->despertar4_a);
            $request->despertar4_d = \Carbon\Carbon::parse($request->despertar4_d);

            if ($request->despertar4_a->format('H') >= 0 && $request->despertar4_a->format('H') < 7) {
                $request->despertar4_a->addDays(1);
            }

            if ($request->despertar4_d->format('H') >= 0 && $request->despertar4_d->format('H') < 7) {
                $request->despertar4_d->addDays(1);
            }
            if ($request->despertar4_fd == 4) {
                $request->despertar4_fd = $request->despertar4_fd_outro;
            }
            $analyze->wakes()->create([
                'number' => '4',
                'timeWokeUp' => $request->despertar4_a,
                'timeSlept' => $request->despertar4_d,
                'duration' => $request->despertar4_d->diffInMinutes($request->despertar4_a),
                'sleepingMode' => $request->despertar4_fd
            ]);
        }

        if ($request->despertar5_a != null) {
            $request->despertar5_a = \Carbon\Carbon::parse($request->despertar5_a);
            $request->despertar5_d = \Carbon\Carbon::parse($request->despertar5_d);

            if ($request->despertar5_a->format('H') >= 0 && $request->despertar5_a->format('H') < 7) {
                $request->despertar5_a->addDays(1);
            }

            if ($request->despertar5_d->format('H') >= 0 && $request->despertar5_d->format('H') < 7) {
                $request->despertar5_d->addDays(1);
            }
            if ($request->despertar5_fd == 4) {
                $request->despertar5_fd = $request->despertar5_fd_outro;
            }
            $analyze->wakes()->create([
                'number' => '5',
                'timeWokeUp' => $request->despertar5_a,
                'timeSlept' => $request->despertar5_d,
                'duration' => $request->despertar5_d->diffInMinutes($request->despertar5_a),
                'sleepingMode' => $request->despertar5_fd
            ]);
        }

        if ($request->despertar6_a != null) {
            $request->despertar6_a = \Carbon\Carbon::parse($request->despertar6_a);
            $request->despertar6_d = \Carbon\Carbon::parse($request->despertar6_d);

            if ($request->despertar6_a->format('H') >= 0 && $request->despertar6_a->format('H') < 7) {
                $request->despertar6_a->addDays(1);
            }

            if ($request->despertar6_d->format('H') >= 0 && $request->despertar6_d->format('H') < 7) {
                $request->despertar6_d->addDays(1);
            }
            if ($request->despertar6_fd == 4) {
                $request->despertar6_fd = $request->despertar6_fd_outro;
            }
            $analyze->wakes()->create([
                'number' => '6',
                'timeWokeUp' => $request->despertar6_a,
                'timeSlept' => $request->despertar6_d,
                'duration' => $request->despertar6_d->diffInMinutes($request->despertar6_a),
                'sleepingMode' => $request->despertar6_fd
            ]);
        }
        return redirect()->route('desafio.show', $challenge->id)->with('sucesso', 'Análise atualizada');
    }
}
