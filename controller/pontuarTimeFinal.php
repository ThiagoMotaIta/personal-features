<?php include "../includes/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();
            
if( isset($_GET['ativo']) && isset($_GET['points']) && isset($_GET['kills']) && isset($_GET['camp']) ){

	// Dados do Camp 
	$qC = mysqli_query($bd, "SELECT * from n_championship_p where id = '".$_GET['camp']."' and status = 'A' ");
    $rsC = mysqli_fetch_assoc($qC);

    // Organizador
    $qO = mysqli_query($bd, "SELECT * from n_organization_p where id = '".$rsC['organization_id']."'");
    $rsO = mysqli_fetch_assoc($qO);

	
    // Se o cara logado for o organizador LIBERA update de Pontuacao
	if ($rsO['player_id_owner'] == $_SESSION['loggedId']){
		
		// Atualiza pontuacao FASE FINAL
		$sqlUp = "UPDATE n_championship_groups_p SET final_stage_points = '".$_GET['points']."', final_stage_kills = '".$_GET['kills']."' WHERE team_id='".$_GET['ativo']."' and final_stage = 'F' and championship_id = '".$_GET['camp']."' ";
		mysqli_query($bd, $sqlUp);

		$arr2 = array(
			"success" => "S"
		);
	
	} else {
		$arr2 = array(
			"success" => "N"
		);
	}

} else {
	$arr2 = array(
		"success" => "N"
	);
}

array_push($arr,$arr2);

mysqli_close($bd);	
 
print json_encode($arr);

?>