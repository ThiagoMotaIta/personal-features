<?php include "../includes/functions.php";
	
	if ($_POST['perfilName'] != NULL || $_POST['perfilPhone'] != NULL){

		$bd = abreConn();

		$validado = true;

		// Verifica se player logado é mesmo o player
		$qP = mysqli_query($bd, "SELECT * from n_player_p where id = '".$_SESSION['loggedId']."' and status = 'A'" );
		$rsP = mysqli_fetch_assoc($qP);

		if ($rsP["id"] != $_SESSION['loggedId']){
			$validado = false;
		}

		

		// Se o cara for realmente ele
		if ($validado){

			if ($_POST['perfilState'] == "EX"){
				$country = 2;
			} else {
				$country = 1;
			}

			$birthDate = explode("/", $_POST['perfilBirth']);
			$birthDateNew = $birthDate[2]."-".$birthDate[1]."-".$birthDate[0];
			
			$sqlUp = "UPDATE n_player_p SET name ='".$_POST['perfilName']."',  
											gander = '".$_POST['perfilGander']."',
											birth_day = '".$birthDateNew."',
											country_id = '".$country."',
											state = '".$_POST['perfilState']."',
											phone = '".$_POST['perfilPhone']."'
											WHERE id='".$_SESSION['loggedId']."' and status = 'A' ";
			mysqli_query($bd, $sqlUp);

			//Seta Novas variaveis de sessoes - NOME
			unset($_SESSION["loggedPlayerName"]);
			$_SESSION["loggedPlayerName"] = $_POST["perfilName"];



			//Verificar se ele ja recebeu os NPs e XP, na primeira atualizacao
			$qXn = mysqli_query($bd, "SELECT * from n_xp_coin_p where description = 'Editou Dados Principais' and status = 'A' and player_id = '".$_SESSION["loggedId"]."' " );
			$rsXn = mysqli_fetch_assoc($qXn);


			// Se primeira vez que edita dados
			if ($rsXn == NULL){
				// Cadastra XP e 100 Moedas
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
													   'Editou Dados Principais',
													   '1000',
													   '1000.00',
													   'A'
													) " ;
				mysqli_query($bd, $sql);

				// Atualiza as variaveis de sessao para XP e NP
				$novoXP = $_SESSION["loggedPlayerXp"] + 1000;
				$novoNP = $_SESSION["loggedPlayerCoins"] + 1000;

				unset($_SESSION["loggedPlayerXp"]);
				unset($_SESSION["loggedPlayerCoins"]);
				
				$_SESSION["loggedPlayerXp"] = $novoXP;
				$_SESSION["loggedPlayerCoins"] = $novoNP;
			}


			redirect("../perfil.php?1");

		} else {
			redirect("../perfil.php?2");
		}

		mysqli_close($bd);
	
	} else {
		redirect("../perfil.php?3");
	}


?>
