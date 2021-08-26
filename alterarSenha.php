<?php session_start(); ?>
<?php include "includes/funcoes.php"; 

header('Content-Type: application/json');

date_default_timezone_set('America/Sao_Paulo');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$dataAgora = $dia."/".$mes."/".$ano;
error_reporting(E_ERROR | E_PARSE);

// JSON referente ao login ao sistema
$link = abreConn();
$arr = array();

// Verifica se ID veio setado
if ($_GET["idLogado"] == "") {
	$arr2 = array(
		"altear" => "N",
	);
} else {
	
	// Busca colaborador com estes dados (ID e SENHA ANTERIOR)
	$q = mysqli_query($link, "SELECT * FROM acesso where id = '".$_GET['idLogado']."' and senha = '". $_GET['senhaAtual'] ."' and status = 'A' ");
	$l = mysqli_fetch_assoc($q);
	mysqli_free_result($q);

	if ($l['id'] != ""){ // Se dados bateram, atualiza senha
		$sqlUp = "UPDATE acesso SET senha = '".$_GET['novaSenha']."' WHERE id='".$_GET["idLogado"]."' ";
		mysqli_query($link, $sqlUp);

		$arr2 = array(
			"altear" => "S",
		);
	} else { // Se não, nega alteracao
		$arr2 = array(
			"altear" => "N",
		);
	}

}

mysqli_close($link);

array_push($arr,$arr2);
 
print json_encode($arr);

?>