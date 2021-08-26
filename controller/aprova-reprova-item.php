<?php include "../conn/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();
$today = date('Y-m-d');
            
if( isset($_GET['idSol']) && isset($_GET['tipoBenef']) && isset($_GET['aprovaReprova']) ){

	// Qual beneficio
	if ($_GET['tipoBenef'] == 'aux'){
		$param = 'situacao_beneficio';
		$log = "Beneficio de auxilio: ";
	}

	if ($_GET['tipoBenef'] == 'alim'){
		$param = 'situacao_alimentacao';
		$log = "Beneficio Alimentacao: ";
	}

	if ($_GET['tipoBenef'] == 'tablet'){
		$param = 'situacao_tablet';
		$log = "Beneficio Tablet: ";
	}

	// Aprova ou Reprova
	if ($_GET['aprovaReprova'] == 'A'){
		$aprovaReprova = 1;
		$logC = "Aprovado";
	}
	if ($_GET['aprovaReprova'] == 'R'){
		$aprovaReprova = 2;
		$logC = "Reprovado";
	}
	
	// Altera situacao do beneficio
	$sqlUp = "UPDATE a_solicitacoes_e SET 
							".$param." = '".$aprovaReprova."'
							WHERE id='".$_GET['idSol']."' and status = 'A' ";
	mysqli_query($bd, $sqlUp);

	// Dados do solicitante
	$qS = mysqli_query($bd, "SELECT * from a_solicitacoes_e where id = '".$_GET['idSol']."' and status = 'A' ");
	$rsS = mysqli_fetch_assoc($qS);

	// Cria log de acao
	$qLog = mysqli_query($bd, "INSERT INTO a_logs_e(descricao, titulo, data, id_solicitante, situacao) 
        						VALUES ('".$log."".$logC."','Atualizacao de Situacao','".$today."','".$rsS['id_solicitante']."','".$logC."')");
	mysqli_query($bd, $qLog);

	$arr2 = array(
		"success" => "S"
	);

} else {
	$arr2 = array(
		"success" => "N"
	);
}

array_push($arr,$arr2);

mysqli_close($bd);	
 
print json_encode($arr);

?>