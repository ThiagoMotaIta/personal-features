<?php

date_default_timezone_set('America/Sao_Paulo');
$dia = date('d');
$mes = date('m');
$ano = date('Y');

$mesExtenso = date('M');

$dataAgora = $dia."/".$mes."/".$ano;
$tituloSistema = "SAR - Sistema de Agendamento de Recesso";
$versaoSistema = "0.0.1";
$favicon = "images/favicon.png";

$mesPort;

if($mes == '01'){
	$mesPort = "Janeiro";
}
if($mes == '02'){
	$mesPort = "Fevereiro";
}
if($mes == '03'){
	$mesPort = "Março";
}
if($mes == '04'){
	$mesPort = "Abril";
}
if($mes == '05'){
	$mesPort = "Maio";
}
if($mes == '06'){
	$mesPort = "Junho";
}

if($mes == '07'){
	$mesPort = "Julho";
}
if($mes == '08'){
	$mesPort = "Agosto";
}
if($mes == '09'){
	$mesPort = "Setembro";
}
if($mes == '10'){
	$mesPort = "Outubro";
}
if($mes == '11'){
	$mesPort = "Novembro";
}
if($mes == '12'){
	$mesPort = "Dezembro";
}


?>