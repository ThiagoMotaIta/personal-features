<?php include "../conn/remoto/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();
$matricula = $_GET["matricula"];
$status = $_GET["status"];


if ($status == 'analise') {
   $qL = mysqli_query($bd, "SELECT * from a_solicitacoes_e INNER JOIN a_solicitantes_e ON a_solicitantes_e.id = a_solicitacoes_e.id_solicitante 
   where aluno_matricula = '" . $matricula . "' && situacao_beneficio = 0  && situacao_alimentacao = 0 && situacao_tablet = 0 ORDER BY data_solicitada ASC");
} else {
   $qL = mysqli_query($bd, "SELECT * from a_solicitacoes_e INNER JOIN a_solicitantes_e ON a_solicitantes_e.id = a_solicitacoes_e.id_solicitante  
   where aluno_matricula = '".$matricula."' ORDER BY data_solicitada ASC");
}

$content = [];
while($row = mysqli_fetch_assoc($qL)){
   $content[] = $row;
}
 
print json_encode($content);
mysqli_close($bd);	

?>