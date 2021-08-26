<?php include "../conn/remoto/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();
$phone = $_GET["phone"];
$status = $_GET["status"];

if ($status == 'analise') {
   $qL = mysqli_query($bd, "SELECT * from a_solicitacoes_e INNER JOIN a_solicitantes_e ON a_solicitantes_e.id = a_solicitacoes_e.id_solicitante 
   where telefone_celular = '" . $phone . "' && situacao_beneficio = 0  && situacao_alimentacao = 0 && situacao_tablet = 0");
} else {
   $qL = mysqli_query($bd, "SELECT * from a_solicitacoes_e INNER JOIN a_solicitantes_e ON a_solicitantes_e.id = a_solicitacoes_e.id_solicitante 
   where telefone_celular = '" . $phone . "'");
}

$content = [];
while ($row = mysqli_fetch_assoc($qL)) {
   $content[] = $row;
}

print json_encode($content);
mysqli_close($bd);
