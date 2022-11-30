<?php include "../includes/functions.php";
	
	if ($_POST['orgName'] != NULL || $_POST['orgDesc'] != NULL){

		$bd = abreConn();

		$validado = true;

		// Verifica se player logado é Coordenador
		$qO = mysqli_query($bd, "SELECT * from n_organization_p where id = '".$_POST['orgId']."' and status = 'A'" );
		$rsO = mysqli_fetch_assoc($qO);

		if ($rsO["player_id_owner"] != $_SESSION['loggedId']){
			$validado = false;
		}

		

		// Se o cara for o Coordenador da Organizacao, pode editar
		if ($validado){

			// UPLOAD =============================
		
			if ($_FILES["logotipoOrg"]["name"] != ""){
				$ext = strtolower(strrchr($_FILES["logotipoOrg"]["name"],"."));
				$target_dir = "../organizations/logos/";
				$new_file_name = $_POST['orgId']."-".$_SESSION['loggedId']."-".$_FILES["logotipoOrg"]["name"];
				$target_file = $target_dir . $new_file_name;
				$ArqFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				move_uploaded_file($_FILES["logotipoOrg"]["tmp_name"], $target_file);
			} else {
				$new_file_name = $rsO['logotype_url'];
			}
			
			$sqlUp = "UPDATE n_organization_p SET organization ='".$_POST['orgName']."', 
												  description = '".$_POST['orgDesc']."',
												  broadcast_main_link = '".$_POST['orgBroadCast']."',
												  instagram_link = '".$_POST['orgInstagram']."',
												  logotype_url = '".$new_file_name."' 
												  WHERE id='".$_POST['orgId']."' ";
			mysqli_query($bd, $sqlUp);


			redirect("../organizacao.php?org=".$_POST['orgId']);

		} else {
			redirect("../perfil.php");
		}

		mysqli_close($bd);
	
	} else {
		redirect("../perfil.php");
	}


?>
