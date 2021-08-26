<?php include "../../conn/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();

$sql = mysqli_query($bd, "SELECT * from a_escolas_e where escola LIKE '%".$_GET['param']."%' and status = 'A' limit 0,5 ");


while ($rsP = mysqli_fetch_array($sql)){

    if ($rsP != NULL){
        $arr2 = array(
            "escolaIdTabela" => $rsP["id"],
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
}

mysqli_close($bd);  
 
print json_encode($arr);

?>