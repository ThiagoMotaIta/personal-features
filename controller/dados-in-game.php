<?php include "../includes/functions.php";
	
	if ($_POST['gameId'] != NULL || $_POST['nickInGame'] != NULL){

		$bd = abreConn();

		$validado = true;

		// Verifica se player logado e mesmo o player
		$qP = mysqli_query($bd, "SELECT * from n_player_p where id = '".$_SESSION['loggedId']."' and status = 'A'" );
		$rsP = mysqli_fetch_assoc($qP);

		if ($rsP["id"] != $_SESSION['loggedId']){
			$validado = false;
		}

		// Se o cara for realmente ele
		if ($validado){

			//Verificar se ele ja informou os Dados In Game
			$qXn = mysqli_query($bd, "SELECT * from n_xp_coin_p where description = 'Editou Dados do Game ".$_POST['gameId']." ' and status = 'A' and player_id = '".$_SESSION["loggedId"]."' " );
			$rsXn = mysqli_fetch_assoc($qXn);


			// Se primeira vez, cadatra e ganhs XP e NO
			if ($rsXn == NULL){
				

				// Cadastra Dados In Game
				$sql = "INSERT into n_player_game_info_p (player_id,  
												   game_id,
												   player_id_in_game,
												   player_level_in_game,
												   player_nick_in_game,
												   status) 
												   	values(
												   	   '".$_SESSION['loggedId']."',
													   '".$_POST['gameId']."',
													   '".$_POST['idInGame']."',
													   '".$_POST['levelInGame']."',
													   '".$_POST['nickInGame']."',
													   'A'
													) " ;
				mysqli_query($bd, $sql);


				// Cadastra XP e NP
				$sql = "INSERT into n_xp_coin_p (transaction_hash,  
												   player_id,
												   win_or_loose,
												   description,
												   xp_points,
												   np_coins,
												   status) 
												   	values(
												   	   '".base64_encode($_SESSION['loggedPlayerEmail'])."',
													   '".$_SESSION['loggedId']."',
													   'W',
													   'Editou Dados do Game ".$_POST['gameId']."',
													   '300',
													   '500.00',
													   'A'
													) " ;
				mysqli_query($bd, $sql);

				// Atualiza as variaveis de sessao para XP e NP
				$novoXP = $_SESSION["loggedPlayerXp"] + 300;
				$novoNP = $_SESSION["loggedPlayerCoins"] + 500;

				unset($_SESSION["loggedPlayerXp"]);
				unset($_SESSION["loggedPlayerCoins"]);
				
				$_SESSION["loggedPlayerXp"] = $novoXP;
				$_SESSION["loggedPlayerCoins"] = $novoNP;

			} else {

				// Se ja incluiu antes, entao so edita mesmo e nao ganha XP nem NP
				$sqlUp = "UPDATE n_player_game_info_p SET player_id_in_game = '".$_POST['idInGame']."',
												player_level_in_game = '".$_POST['levelInGame']."',
												player_nick_in_game = '".$_POST['nickInGame']."'
												WHERE player_id='".$_SESSION['loggedId']."' and status = 'A' and game_id ='".$_POST['gameId']."' ";
				mysqli_query($bd, $sqlUp);

			}


			redirect("../jogo-perfil.php?game=".$_POST['gameId']);

		} else {
			redirect("../jogo-perfil.php?game=".$_POST['gameId']);
		}

		mysqli_close($bd);
	
	} else {
		redirect("../jogo-perfil.php?game=".$_POST['gameId']);
	}


?>
