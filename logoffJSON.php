<?php session_start(); ?>
<?php include "includes/funcoes.php"; 

header('Content-Type: application/json');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$dataAgora = $dia."/".$mes."/".$ano;
error_reporting(E_ERROR | E_PARSE);

// JSON referente ao login ao sistema
$link = abreConn();
$arr = array();

if (isset($_SESSION["id"])){

	// Log de Sistema
	$sqlInsertLog = "INSERT INTO log_sar (colaborador_id, acao_id, data, status) VALUES ('".$_SESSION["id"]."', '2', '".$ano."-".$mes."-".$dia."' ,'A' )  ";
	mysqli_query($link, $sqlInsertLog);

	$arr2 = array(
		"logoffOk" => "S",
	);

} else {
	$arr2 = array(
		"logoffOk" => "N",
	);
}

array_push($arr,$arr2);


mysqli_close($link);
 
print json_encode($arr);

?>