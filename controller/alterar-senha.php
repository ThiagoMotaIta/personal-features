<?php include "../includes/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();
            
if( isset($_GET['newPass']) || isset($_GET['hash']) ){

	// Atualiza registro
	$novaSenha = base64_encode($_GET['newPass']);
	$sqlUp = "UPDATE n_player_p SET password = '".$novaSenha."' WHERE user_hash = '".$_GET['hash']."' ";
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