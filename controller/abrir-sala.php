<?php include "../includes/functions.php";

$bd = abreConn();
            
if( isset($_POST['linkSala']) || isset($_POST['grupoLiberado']) ){

	// Dados do Camp
	$qC = mysqli_query($bd, "SELECT * from n_championship_p where id = '".$_POST['campIdHidden']."' and status = 'A' ");
    $rsC = mysqli_fetch_assoc($qC);

    // Organizador
    $qO = mysqli_query($bd, "SELECT * from n_organization_p where id = '".$rsC['organization_id']."'");
    $rsO = mysqli_fetch_assoc($qO);

    // Se organizador esta logado
    if ($rsO['player_id_owner'] == $_SESSION['loggedId']){

		// Atualiza registro
		$sqlUp = "UPDATE n_championship_p SET room_game_link = '".$_POST['linkSala']."',
											  group_opened_link = '".$_POST['grupoLiberado']."'
		 								  WHERE id = '".$rsC['id']."' ";
		mysqli_query($bd, $sqlUp);

		redirect("../campeonatos-dash.php?camp=".$_POST['campIdHidden']."&salaSucesso=ok&grupo=".$_POST['grupoLiberado']);
	} else {
		redirect("../campeonatos-dash.php?camp=".$_POST['campIdHidden']."&salaSucesso=erro");
	}

} else {
	redirect("../campeonatos-dash.php?camp=".$_POST['campIdHidden']."&salaSucesso=erro");
}


mysqli_close($bd);	

?>