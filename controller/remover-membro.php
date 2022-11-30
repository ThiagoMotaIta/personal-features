<?php include "../includes/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();
            
if( isset($_GET['teamId']) && isset($_GET['playerId']) ){

	// Cancela Confirmacao, se ja tiver confirmado
	$qT = mysqli_query($bd, "SELECT * from n_championship_sub_p where player_id = '".$_GET['playerId']."' and team_id = '".$_GET['teamId']."' and status = 'A'" );
	$rsT = mysqli_fetch_assoc($qT);

	if ($rsT){
		$sqlUp = "UPDATE n_championship_sub_p SET status = 'E' WHERE id='".$rsT['id']."' ";
		mysqli_query($bd, $sqlUp);
	}

	// Atualiza registro
	$sqlUp = "UPDATE n_team_formation_p SET status = 'E' WHERE team_id='".$_GET['teamId']."' and player_id = '".$_GET['playerId']."' ";
	mysqli_query($bd, $sqlUp);

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