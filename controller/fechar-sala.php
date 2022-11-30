<?php include "../includes/functions.php";

$bd = abreConn();
            
if( isset($_GET['camp'])){

	// Dados do Camp
	$qC = mysqli_query($bd, "SELECT * from n_championship_p where id = '".$_GET['camp']."' and status = 'A' ");
    $rsC = mysqli_fetch_assoc($qC);

    // Organizador
    $qO = mysqli_query($bd, "SELECT * from n_organization_p where id = '".$rsC['organization_id']."'");
    $rsO = mysqli_fetch_assoc($qO);

    // Se organizador esta logado
    if ($rsO['player_id_owner'] == $_SESSION['loggedId']){

		// Atualiza registro
		$sqlUp = "UPDATE n_championship_p SET room_game_link = '',
											  group_opened_link = NULL
		 								  WHERE id = '".$rsC['id']."' ";
		mysqli_query($bd, $sqlUp);

		redirect("../campeonatos-dash.php?camp=".$_GET['camp']);
	} else {
		redirect("../campeonatos-dash.php?camp=".$_GET['camp']);
	}

} else {
	redirect("../campeonatos-dash.php?camp=".$_GET['camp']);
}


mysqli_close($bd);	

?>