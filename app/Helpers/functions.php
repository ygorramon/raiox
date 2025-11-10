<?php


function formatDateAndTime($value, $format = 'd/m/Y')
{
    
    return Carbon\Carbon::parse($value)->format($format);
}

function formatDateAndTimeHours($value, $format = 'd/m/Y H:i')
{
    
    return Carbon\Carbon::parse($value)->format($format);
}

 function getJanela($bebe_idade)
  {
    if ($bebe_idade < 59) {
      $data['janelaIdealInicio'] = 40;
      $data['janelaIdealFim'] = 70;
    }

    if ($bebe_idade >= 59 && $bebe_idade < 120) {
      $data['janelaIdealInicio'] = 60;
      $data['janelaIdealFim'] = 100;
    }

    if ($bebe_idade >= 120 && $bebe_idade < 180) {
      $data['janelaIdealInicio'] = 75;
      $data['janelaIdealFim'] = 120;
    }
    if ($bebe_idade >= 180 && $bebe_idade < 240) {
      $data['janelaIdealInicio'] = 100;
      $data['janelaIdealFim'] = 150;
    }
    if ($bebe_idade >= 240 && $bebe_idade < 300) {
      $data['janelaIdealInicio'] = 100;
      $data['janelaIdealFim'] = 180;
    }
    if ($bebe_idade >= 300 && $bebe_idade < 360) {
      $data['janelaIdealInicio'] = 120;
      $data['janelaIdealFim'] = 210;
    }
    if ($bebe_idade >= 360 && $bebe_idade < 540) {
      $data['janelaIdealInicio'] = 120;
      $data['janelaIdealFim'] = 270;
    }
    if ($bebe_idade >= 540) {
      $data['janelaIdealInicio'] = 120;
      $data['janelaIdealFim'] = 390;
    }

    return (object) $data;
  }
  function getIdade($value){
   return now()->diffInDays(\Carbon\Carbon::parse($value));
  }
  
 function getGanhoPeso($bebe_idade, $ganhoPeso)
  {
    $data = "";
    if ($bebe_idade <= 90 && $ganhoPeso >= 700) {
      $data = "Adequado";
    }
    if ($bebe_idade <= 90 && $ganhoPeso < 700) {
      $data = "Inadequado";
    }
    if ($bebe_idade > 90 && $bebe_idade <= 180 && $ganhoPeso >= 600) {
      $data = "Adequado";
    }
    if ($bebe_idade > 90 && $bebe_idade <= 180 && $ganhoPeso < 600) {
      $data = "Inadequado";
    }
    if ($bebe_idade > 180 && $bebe_idade <= 270 && $ganhoPeso >= 500) {
      $data = "Adequado";
    }
    if ($bebe_idade > 180 && $bebe_idade <= 270 && $ganhoPeso < 500) {
      $data = "Inadequado";
    }
    if ($bebe_idade > 270 && $bebe_idade <= 365 && $ganhoPeso >= 400) {
      $data = "Adequado";
    }
    if ($bebe_idade > 270 && $bebe_idade <= 365 && $ganhoPeso < 400) {
      $data = "Inadequado";
    }
    if ($ganhoPeso == "NP") {
      $data = "Vazio";
    }
    if ($ganhoPeso == "N") {
      $data = "Vazio";
    }
    return $data;
  }

  function stringReplace($text, $client)
  {
    $nome_mae_primeiro = explode(" ", $client->name);
    $nome_baby_primeiro = explode(" ", $client->nameBaby);
    $array_from_to = array(
      'nome_mae_primeiro' => $nome_mae_primeiro[0],
      'nome_bebe_primeiro' => $nome_baby_primeiro[0]
    );
    $text = str_replace(array_keys($array_from_to), $array_from_to, $text);
    return $text;
}
function getSex($sex){
$data="";
  if('F'==$sex){
$data='FEMININO';
}else{
  $data='MASCULINO';

}
return $data;
}

function diffDate($date_start, $date_end){
return  \Carbon\Carbon::parse($date_end)
->diffInHours(\Carbon\Carbon::parse($date_start));
}

function mediaWindowEsperada($babyAge){
  if($babyAge <=60 ){
    $data['janelaIdealInicio'] = 40;
    $data['janelaIdealFim'] = 80;
  }
}

function getSinalSono($bebe_idade)
{
  if ($bebe_idade < 59) {
    $data['janelaIdealInicio'] = 30;
    $data['janelaIdealFim'] = 40;
  }

  if ($bebe_idade >= 59 && $bebe_idade < 120) {
    $data['janelaIdealInicio'] = 45;
    $data['janelaIdealFim'] = 70;
  }

  if ($bebe_idade >= 120 && $bebe_idade < 180) {
    $data['janelaIdealInicio'] = 70;
    $data['janelaIdealFim'] = 90;
  }
  if ($bebe_idade >= 180 && $bebe_idade < 240) {
    $data['janelaIdealInicio'] = 90;
    $data['janelaIdealFim'] = 120;
  }
  if ($bebe_idade >= 240 && $bebe_idade < 300) {
    $data['janelaIdealInicio'] = 90;
    $data['janelaIdealFim'] = 150;
  }
  if ($bebe_idade >= 300 && $bebe_idade < 360) {
    $data['janelaIdealInicio'] = 120;
    $data['janelaIdealFim'] = 180;
  }
  if ($bebe_idade >= 360 && $bebe_idade < 540) {
    $data['janelaIdealInicio'] = 120;
    $data['janelaIdealFim'] = 240;
  }
  if ($bebe_idade >= 540) {
    $data['janelaIdealInicio'] = 120;
    $data['janelaIdealFim'] = 360;
  }

  return (object) $data;
}

function setStatus($text){

if($text == 'S')
{
    $data['color'] = 'bg-green';
    $data['value'] = 'SIM';
}else{
    $data['color'] = 'bg-red';
    $data['value'] = 'NÃO';
}

return (object) $data;
}

 function getAnalyzedTime($challenge, $day, $field = 'timeWokeUp')
{
    $value = optional(optional($challenge->analyzes()->where('day', $day)->first())->dados()->first())->$field;

    if (!$value) {
        return '';
    }

    try {
        return Carbon\Carbon::parse($value)->format('H:i');
    } catch (\Exception $e) {
        return '';
    }

    
}

function calcularTempoAcordado($birthBaby)
{
  $idade = \Carbon\Carbon::parse($birthBaby)->diffInMonths();

  if ($idade <= 2)
    return 50;         // Até 60 dias
  if ($idade <= 3)
    return 70;         // 60 a 90 dias
  if ($idade <= 4)
    return 80;         // 90 a 120 dias
  if ($idade <= 5)
    return 90;         // 4 a 5 meses
  if ($idade <= 6)
    return 100;        // 5 a 6 meses
  if ($idade <= 7)
    return 120;        // 6 a 7 meses
  if ($idade <= 8)
    return 140;        // 7 a 8 meses
  if ($idade <= 9)
    return 150;        // 8 a 9 meses
  if ($idade <= 10)
    return 160;       // 9 a 10 meses
  if ($idade <= 11)
    return 170;       // 10 a 11 meses
  if ($idade <= 12)
    return 180;       // 11 a 12 meses
  if ($idade <= 18)
    return 210;       // 12 a 18 meses
  return 240;                         // Mais de 18 meses
}




// Adicione esta função em um helper ou no controller
function calcularDiferencaMinutos($horaInicio, $horaFim) {
    try {
        // Verificar se as horas são válidas
        if (empty($horaInicio) || empty($horaFim)) {
            return null;
        }
        
        // Remover segundos se existirem
        $horaInicio = substr($horaInicio, 0, 5); // Pega apenas HH:MM
        $horaFim = substr($horaFim, 0, 5); // Pega apenas HH:MM
        
        // Verificar formato
        if (!preg_match('/^\d{2}:\d{2}$/', $horaInicio) || !preg_match('/^\d{2}:\d{2}$/', $horaFim)) {
            return null;
        }
        
        $inicio = \Carbon\Carbon::createFromFormat('H:i', $horaInicio);
        $fim = \Carbon\Carbon::createFromFormat('H:i', $horaFim);
        
        // Se a hora fim for menor que a início, assume que é no dia seguinte
        if ($fim->lessThan($inicio)) {
            $fim->addDay();
        }
        
        return $inicio->diffInMinutes($fim);
        
    } catch (\Exception $e) {
        // Log do erro se necessário
        \Log::error('Erro ao calcular diferença de minutos: ' . $e->getMessage());
        return null;
    }
}