<?php include "../includes/functions.php";
	
	if ($_POST['campId'] != NULL || $_POST['arquivoCompPgto'] != NULL){

		$bd = abreConn();

		$validado = true;

		if ($validado){

			// Dados do Campeonato
		    $qC = mysqli_query($bd, "SELECT * from n_championship_p where id = '".$_POST['campId']."' and status = 'A' ");
		    $rsC = mysqli_fetch_assoc($qC);
			

			// Atualiza status pagamento para 2 (Aguardando confirmacao do Organizador)

			// ======== Se for SOLO
			if ($rsC['solo_or_team'] == "S"){

				// UPLOAD =============================
				$ext = strtolower(strrchr($_FILES["arquivoCompPgto"]["name"],"."));
				$target_dir = "../comppgto/";
				$new_file_name = $_SESSION['loggedId']."-".$_POST['campId']."-".$_FILES["arquivoCompPgto"]["name"];
				$target_file = $target_dir . $new_file_name;
				$ArqFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				move_uploaded_file($_FILES["arquivoCompPgto"]["tmp_name"], $target_file);

				$sqlUp = "UPDATE n_championship_sub_p SET 
										payment_status = '2',
										comp_uploaded = '".$new_file_name."'
										WHERE player_id='".$_SESSION['loggedId']."' and championship_id = '".$_POST['campId']."' and status = 'A' ";
				mysqli_query($bd, $sqlUp);
			}

			// ======== Se for TEAM
			if ($rsC['solo_or_team'] == "T"){

				// UPLOAD =============================
				$ext = strtolower(strrchr($_FILES["arquivoCompPgto"]["name"],"."));
				$target_dir = "../comppgto/";
				$new_file_name = $_POST['teamId']."-".$_POST['campId']."-".$_FILES["arquivoCompPgto"]["name"];
				$target_file = $target_dir . $new_file_name;
				$ArqFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				move_uploaded_file($_FILES["arquivoCompPgto"]["tmp_name"], $target_file);

				$sqlUp = "UPDATE n_championship_sub_p SET 
										payment_status = '2',
										comp_uploaded = '".$new_file_name."'
										WHERE team_id='".$_POST['teamId']."' and championship_id = '".$_POST['campId']."' and status = 'A' ";
				mysqli_query($bd, $sqlUp);
			}


			redirect("../campeonatos-detalhes.php?id=".$rsC['id']);

		} else {
			redirect("../campeonatos-enviar-comp-pgto.php?status=erro");
		}

		mysqli_close($bd);
	
	} else {
		redirect("../campeonatos-enviar-comp-pgto.php?status=erro");
	}


?>
