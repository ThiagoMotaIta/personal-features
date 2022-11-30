<?php include "../includes/functions.php";
	
	if ($_POST['teamName'] != NULL || $_POST['teamId'] != NULL){

		$bd = abreConn();

		$validado = true;

		// Verifica se player logado é lider do time
		$qT = mysqli_query($bd, "SELECT * from n_team_p where id = '".$_POST['teamId']."' and status = 'A'" );
		$rsT = mysqli_fetch_assoc($qT);

		if ($rsT["leader_id"] != $_SESSION['loggedId']){
			$validado = false;
		}

		

		// Se o cara for o lider do time, pode editar
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
				$new_file_name = $rsT['logo'];
			}
			
			$sqlUp = "UPDATE n_team_p SET team ='".$_POST['teamName']."', tag = '".$_POST['teamTag']."', logo = '".$new_file_name."' WHERE id='".$_POST['teamId']."' ";
			mysqli_query($bd, $sqlUp);


			redirect("../time-perfil.php?time=".$_POST['teamId']);

		} else {
			redirect("../perfil.php");
		}

		mysqli_close($bd);
	
	} else {
		redirect("../perfil.php");
	}


?>
