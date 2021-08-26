<?php include "../conn/remoto/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();

$qL = mysqli_query($bd, "SELECT * from a_escolas_e ");

$content = [];
while($row = mysqli_fetch_assoc($qL)){
   $content[] = $row;
}
 
print json_encode($content);
mysqli_close($bd);	

?>