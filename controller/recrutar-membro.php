<?php include "../includes/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();
            
if( isset($_GET['teamId']) && isset($_GET['playerId']) ){

	// Recruta player
	$sql = "INSERT into n_team_formation_p (team_id,  
									   player_id,
									   status) values('".$_GET['teamId']."',
									   '".$_GET['playerId']."',
									   'A') " ;
	mysqli_query($bd, $sql);

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