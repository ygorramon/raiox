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
      $data['janelaIdealFim'] = 80;
    }

    if ($bebe_idade >= 59 && $bebe_idade < 120) {
      $data['janelaIdealInicio'] = 60;
      $data['janelaIdealFim'] = 90;
    }

    if ($bebe_idade >= 120 && $bebe_idade < 180) {
      $data['janelaIdealInicio'] = 75;
      $data['janelaIdealFim'] = 120;
    }
    if ($bebe_idade >= 180 && $bebe_idade < 270) {
      $data['janelaIdealInicio'] = 100;
      $data['janelaIdealFim'] = 150;
    }
    if ($bebe_idade >= 270 && $bebe_idade < 360) {
      $data['janelaIdealInicio'] = 120;
      $data['janelaIdealFim'] = 210;
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
->diffInDays(\Carbon\Carbon::parse($date_start));
}