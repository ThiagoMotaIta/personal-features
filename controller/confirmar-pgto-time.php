<?php include "../includes/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();
            
if( isset($_GET['campId']) && isset($_GET['teamId']) ){

	$sqlUp = "UPDATE n_championship_sub_p SET 
							payment_status = '1'
							WHERE team_id='".$_GET['teamId']."' and championship_id = '".$_GET['campId']."' and status = 'A' ";
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