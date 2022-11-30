<?php include "../includes/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();

$qP = mysqli_query($bd, "SELECT * from n_player_p where email = '".$_GET['email']."' and status = 'A'" );
$rsP = mysqli_fetch_assoc($qP);


if ($rsP != NULL){
	$arr2 = array(
		"playerId" => $rsP["id"],
		"playerName" => $rsP["name"],
		"playerEmail" => $rsP["email"],
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