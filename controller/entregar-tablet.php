<?php include "../conn/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();
$today = date('Y-m-d');
            
if( isset($_GET['idSol'])){

	$param = 'situacao_tablet';
	$log = "Beneficio Tablet: ";
	$logC = "Entregue";
	
	// Altera situacao do beneficio
	$sqlUp = "UPDATE a_solicitacoes_e SET 
							".$param." = '3'
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