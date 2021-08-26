<?php include "../../conn/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();

$qP = mysqli_query($bd, "SELECT * from a_escolas_e where id = '".$_GET['param']."' and status = 'A'" );
$rsP = mysqli_fetch_assoc($qP);


if ($rsP != NULL){
    $arr2 = array(
        "escolaInep" => $rsP["inep"],
        "escola" => $rsP["escola"],
        "condicao" => $rsP["condicao"],
        "found" => "S"
    );
} else {
    $arr2 = array(
        "found" => "N"
    );
}   

array_push($arr,$arr2);

mysqli_close($bd);  
 
print json_encode($arr);

?>