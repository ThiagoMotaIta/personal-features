<?php include "../includes/functions.php";
	
	if ($_POST['teamName'] != NULL){

		$bd = abreConn();

		$validado = true;

		// Verifica todas as formacoes do player (seja lider ou membro, de qualquer jogo)
		$qTf = mysqli_query($bd, "SELECT * from n_team_formation_p where player_id = '".$_SESSION['loggedId']."' and status = 'A'" );
		while ($rsTf = mysqli_fetch_array($qTf)){
			// Dados do time
			$qT = mysqli_query($bd, "SELECT * from n_team_p where id = '".$rsTf['team_id']."' and status = 'A'" );
			$rsT = mysqli_fetch_assoc($qT);

			// Se ele ja estiver em um time deste jogo, nao deixa criar um novo
			if ($rsT['game_id'] == $_POST['gameId']){
				$validado = false;
			}
		}

		

		// Se nao tiver numa line para este jogo, deixa criar o time
		if ($validado){

			// UPLOAD =============================
		
			if ($_FILES["logotipoTime"]["name"] != ""){
				$ext = strtolower(strrchr($_FILES["logotipoTime"]["name"],"."));
				$target_dir = "../teams/";
				$new_file_name = $_POST['gameId']."-".$_SESSION['loggedId']."-".$_FILES["logotipoTime"]["name"];
				$target_file = $target_dir . $new_file_name;
				$ArqFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				move_uploaded_file($_FILES["logotipoTime"]["tmp_name"], $target_file);
			} else {
				$new_file_name = "no-logo.fw.png";
			}
			
			// Cadastra o time
			$sql = "INSERT into n_team_p (game_id,  
											   team,
											   tag,
											   logo,
											   leader_id,
											   status) values('".$_POST['gameId']."',
											   '".$_POST['teamName']."',
											   '".$_POST['teamTag']."',
											   '".$new_file_name."',
											   '".$_SESSION['loggedId']."',
											   'A') " ;
			mysqli_query($bd, $sql);


			$qNt = mysqli_query($bd, "SELECT * from n_team_p where leader_id = '".$_SESSION['loggedId']."' and status = 'A' order by id desc limit 0,1");
			$rsNt = mysqli_fetch_assoc($qNt);


			// Cadastra Formacao
			$sql = "INSERT into n_team_formation_p (team_id,  
											   player_id,
											   status) 
											   	values('".$rsNt['id']."',
												   '".$_SESSION['loggedId']."',
												   'A' ) " ;
			mysqli_query($bd, $sql);


			redirect("../time-perfil.php?time=".$rsNt['id']);

		} else {
			redirect("../criar-time.php?status=erro&game=".$_POST['gameId']."&time=".$rsT['id']);
		}

		mysqli_close($bd);
	
	} else {
		redirect("../criar-time.php");
	}


?>
