<?php include "../conn/remoto/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();
$cpf = $_GET["cpf"];

$qL = mysqli_query($bd, "SELECT * from a_logs_e INNER JOIN a_solicitantes_e ON a_solicitantes_e.id = a_logs_e.id_solicitante  where cpf = '".$cpf."' ");

$content = [];
while($row = mysqli_fetch_assoc($qL)){
   $content[] = $row;
}
 
print json_encode($content);
mysqli_close($bd);	

?>