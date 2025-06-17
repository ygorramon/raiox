<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use Illuminate\Http\Request;
use App\Models\Dado;
use Illuminate\Http\Resources\Json\Resource;

class DadoController extends Controller
{
    
    public function saveUpdate($id, $day,Request $request){
//dd($request);
    
     $challenge = Challenge::find($id);
     $analyze=$challenge->analyzes()->where('day', $day)->first();
 
     $dados=$analyze->dados()->first();
    $result = null;
    if($dados==null){
    
       $result= $analyze
     
    ->dados()->create([
                'date' =>
                \Carbon\Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d'),
                'timeWokeUp' => $request->timeWokeUp,
                'volcanicEffect' => null,
                'observacoes' =>$request->observcacao,
                'nap_signalSlept_1' => $request->soneca1_ss,
                'nap_timeSlept_1' => $request->soneca1_hd,
                'nap_timeWokeUp_1' => $request->soneca1_ha,
                'nap_onde_dormiu_1' => $request->soneca1_onde_dormiu,
                'nap_prolongada_1' => $request->soneca1_prolongada or 0,
                'nap_signalSlept_2' => $request->soneca2_ss,
                'nap_timeSlept_2' => $request->soneca2_hd,
                'nap_timeWokeUp_2' => $request->soneca2_ha,
                        'nap_onde_dormiu_2' => $request->soneca2_onde_dormiu,
                        'nap_prolongada_2' => $request->soneca2_prolongada or 0,
                'nap_signalSlept_3' => $request->soneca3_ss,
                'nap_timeSlept_3' => $request->soneca3_hd,
                'nap_timeWokeUp_3' => $request->soneca3_ha,
                        'nap_onde_dormiu_3' => $request->soneca3_onde_dormiu,
                        'nap_prolongada_3' => $request->soneca3_prolongada or 0,
                'nap_signalSlept_4' => $request->soneca4_ss,
                'nap_timeSlept_4' => $request->soneca4_hd,
                'nap_timeWokeUp_4' => $request->soneca4_ha,
                        'nap_onde_dormiu_4' => $request->soneca4_onde_dormiu,
                        'nap_prolongada_4' => $request->soneca4_prolongada or 0,
                'nap_signalSlept_5' => $request->soneca5_ss,
                'nap_timeSlept_5' => $request->soneca5_hd,
                'nap_timeWokeUp_5' => $request->soneca5_ha,
                        'nap_onde_dormiu_5' => $request->soneca5_onde_dormiu,
                        'nap_prolongada_5' => $request->soneca5_prolongada or 0,
                'nap_signalSlept_6' => $request->soneca6_ss,
                'nap_timeSlept_6' => $request->soneca6_hd,
                'nap_timeWokeUp_6' => $request->soneca6_ha,
                        'nap_onde_dormiu_6' => $request->soneca6_onde_dormiu,
                        'nap_prolongada_6' => $request->soneca6_prolongada or 0,

                'ritual_signalSlept' => $request->ritual_ss,
                'ritual_start' => $request->ritual_in,
                'ritual_end' => $request->ritual_d,
                'wake_timeWokeUp1' => $request->despertar1_a,
                'wake_timeSlept1' => $request->despertar1_d,
                'wake_sleepingMode1' => $request->despertar1_fd,
                'wake_timeWokeUp2' => $request->despertar2_a,
                'wake_timeSlept2' => $request->despertar2_d,
                'wake_sleepingMode2' => $request->despertar2_fd,
                'wake_timeWokeUp3' => $request->despertar3_a,
                'wake_timeSlept3' => $request->despertar3_d,
                'wake_sleepingMode3' => $request->despertar3_fd,
                'wake_timeWokeUp4' => $request->despertar4_a,
                'wake_timeSlept4' => $request->despertar4_d,
                'wake_sleepingMode4' => $request->despertar4_fd,
                'wake_timeWokeUp5' => $request->despertar5_a,
                'wake_timeSlept5' => $request->despertar5_d,
                'wake_sleepingMode5' => $request->despertar5_fd,
                'wake_timeWokeUp6' => $request->despertar6_a,
                'wake_timeSlept6' => $request->despertar6_d,
                'wake_sleepingMode6' => $request->despertar6_fd,
               
                /*   'despertar2_a' => \Carbon\Carbon::parse($request->despertar2_a),
                'despertar2_d' => \Carbon\Carbon::parse($request->despertar2_d),
                'despertar2_fd_outro' => $request->despertar2_fd_outro,
                'despertar3_a' => \Carbon\Carbon::parse($request->despertar3_a),
                'despertar3_d' => \Carbon\Carbon::parse($request->despertar3_d),
                'despertar3_fd_outro' => $request->despertar3_fd_outro,
                'despertar4_a' => \Carbon\Carbon::parse($request->despertar4_a),
                'despertar4_d' => \Carbon\Carbon::parse($request->despertar4_d),
                'despertar4_fd_outro' => $request->despertar4_fd_outro,
                'despertar5_a' => \Carbon\Carbon::parse($request->despertar5_a),
                'despertar5_d' => \Carbon\Carbon::parse($request->despertar5_d),
                'despertar5_fd_outro' => $request->despertar5_fd_outro,
                'despertar6_a' => \Carbon\Carbon::parse($request->despertar6_a),
                'despertar6_d' => \Carbon\Carbon::parse($request->despertar6_d),
                'despertar6_fd_outro' => $request->despertar6_fd_outro,*/
            ]);
    }else{
            $result=$analyze

                ->dados()->update([
                    'date' =>
                    \Carbon\Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d'),
                        'timeWokeUp' => $request->timeWokeUp,
                        'volcanicEffect' => null,
                                                'observacoes' => $request->observcacao,

                                                'nap_signalSlept_1' => $request->soneca1_ss,
                        'nap_timeSlept_1' => $request->soneca1_hd,
                        'nap_timeWokeUp_1' => $request->soneca1_ha,
                        'nap_onde_dormiu_1' => $request->soneca1_onde_dormiu,
                        'nap_prolongada_1' => $request->soneca1_prolongada or 0,
                        'nap_signalSlept_2' => $request->soneca2_ss,
                        'nap_timeSlept_2' => $request->soneca2_hd,
                        'nap_timeWokeUp_2' => $request->soneca2_ha,
                        'nap_onde_dormiu_2' => $request->soneca2_onde_dormiu,
                        'nap_prolongada_2' => $request->soneca2_prolongada or 0,
                        'nap_signalSlept_3' => $request->soneca3_ss,
                        'nap_timeSlept_3' => $request->soneca3_hd,
                        'nap_timeWokeUp_3' => $request->soneca3_ha,
                        'nap_onde_dormiu_3' => $request->soneca3_onde_dormiu,
                        'nap_prolongada_3' => $request->soneca3_prolongada or 0,
                        'nap_signalSlept_4' => $request->soneca4_ss,
                        'nap_timeSlept_4' => $request->soneca4_hd,
                        'nap_timeWokeUp_4' => $request->soneca4_ha,
                        'nap_onde_dormiu_4' => $request->soneca4_onde_dormiu,
                        'nap_prolongada_4' => $request->soneca4_prolongada or 0,
                        'nap_signalSlept_5' => $request->soneca5_ss,
                        'nap_timeSlept_5' => $request->soneca5_hd,
                        'nap_timeWokeUp_5' => $request->soneca5_ha,
                        'nap_onde_dormiu_5' => $request->soneca5_onde_dormiu,
                        'nap_prolongada_5' => $request->soneca5_prolongada or 0,
                        'nap_signalSlept_6' => $request->soneca6_ss,
                        'nap_timeSlept_6' => $request->soneca6_hd,
                        'nap_timeWokeUp_6' => $request->soneca6_ha,
                        'nap_onde_dormiu_6' => $request->soneca6_onde_dormiu,
                        'nap_prolongada_6' => $request->soneca6_prolongada or 0,

                        'ritual_signalSlept' => $request->ritual_ss,
                        'ritual_start' => $request->ritual_in,
                        'ritual_end' => $request->ritual_d,
                        'wake_timeWokeUp1' => $request->despertar1_a,
                        'wake_timeSlept1' => $request->despertar1_d,
                        'wake_sleepingMode1' => $request->despertar1_fd,
                        'wake_timeWokeUp2' => $request->despertar2_a,
                        'wake_timeSlept2' => $request->despertar2_d,
                        'wake_sleepingMode2' => $request->despertar2_fd,
                        'wake_timeWokeUp3' => $request->despertar3_a,
                        'wake_timeSlept3' => $request->despertar3_d,
                        'wake_sleepingMode3' => $request->despertar3_fd,
                        'wake_timeWokeUp4' => $request->despertar4_a,
                        'wake_timeSlept4' => $request->despertar4_d,
                        'wake_sleepingMode4' => $request->despertar4_fd,
                        'wake_timeWokeUp5' => $request->despertar5_a,
                        'wake_timeSlept5' => $request->despertar5_d,
                        'wake_sleepingMode5' => $request->despertar5_fd,
                        'wake_timeWokeUp6' => $request->despertar6_a,
                        'wake_timeSlept6' => $request->despertar6_d,
                        'wake_sleepingMode6' => $request->despertar6_fd,
             /*   'despertar2_a' => \Carbon\Carbon::parse($request->despertar2_a),
                'despertar2_d' => \Carbon\Carbon::parse($request->despertar2_d),
                'despertar2_fd_outro' => $request->despertar2_fd_outro,
                'despertar3_a' => \Carbon\Carbon::parse($request->despertar3_a),
                'despertar3_d' => \Carbon\Carbon::parse($request->despertar3_d),
                'despertar3_fd_outro' => $request->despertar3_fd_outro,
                'despertar4_a' => \Carbon\Carbon::parse($request->despertar4_a),
                'despertar4_d' => \Carbon\Carbon::parse($request->despertar4_d),
                'despertar4_fd_outro' => $request->despertar4_fd_outro,
                'despertar5_a' => \Carbon\Carbon::parse($request->despertar5_a),
                'despertar5_d' => \Carbon\Carbon::parse($request->despertar5_d),
                'despertar5_fd_outro' => $request->despertar5_fd_outro,
                'despertar6_a' => \Carbon\Carbon::parse($request->despertar6_a),
                'despertar6_d' => \Carbon\Carbon::parse($request->despertar6_d),
                'despertar6_fd_outro' => $request->despertar6_fd_outro,*/
                ]);
    }
    if($result!=null){
      
    return response()->json( $result, 200 );

    }else {
        {
                return response()->json(["msg" => "Street data not exist!"]);  
        }
    }
    
    }

}
