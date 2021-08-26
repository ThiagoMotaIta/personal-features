<?php session_start(); ?>
<?php include "includes/funcoes.php"; 

header('Content-Type: application/json');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
error_reporting(E_ERROR | E_PARSE);

// JSON referente ao login ao sistema
$link = abreConn();
$arr = array();

// GERAL
if (isset($_GET['area']) && isset($_GET['id'])){

	// ================== Agressores ====================
	if ($_GET['area'] == "agressor"){
		
		$sqlUp = "UPDATE base_agressores SET status='E' WHERE id='".$_GET["id"]."' ";
		mysqli_query($link, $sqlUp);

		// Log de Sistema
		/*$sqlInsertLog = "INSERT INTO log_sar (colaborador_id, acao_id, data, status) VALUES ('".$_SESSION["id"]."', '7', '".$ano."-".$mes."-".$dia."' ,'A' )  ";
		mysqli_query($link, $sqlInsertLog);*/

		$arr2 = array(
			"excluido" => "S",
			"id" => $_GET["id"],
		);
		
	}
	// ================== Agressores ====================

	// ================== Usuarios ====================
	if ($_GET['area'] == "usuario"){
		
		$sqlUp = "UPDATE acesso SET status='E' WHERE id='".$_GET["id"]."' ";
		mysqli_query($link, $sqlUp);

		// Log de Sistema
		/*$sqlInsertLog = "INSERT INTO log_sar (colaborador_id, acao_id, data, status) VALUES ('".$_SESSION["id"]."', '7', '".$ano."-".$mes."-".$dia."' ,'A' )  ";
		mysqli_query($link, $sqlInsertLog);*/

		$arr2 = array(
			"excluido" => "S",
			"id" => $_GET["id"],
		);
		
	}
	// ================== Usuarios ====================


} else { // GERAL
	$arr2 = array(
		"excluido" => "N",
	);
}

mysqli_close($link);

array_push($arr,$arr2);
 
print json_encode($arr);

?>