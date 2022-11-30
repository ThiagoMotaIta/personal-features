<?php include "../includes/functions.php";
	
	if ($_POST['emailReg'] != NULL || $_POST['nameReg'] != NULL){

		date_default_timezone_set('America/Sao_Paulo');
		$dia = date('d');
		$mes = date('m');
		$ano = date('Y');
		$dataAgora = $ano."-".$mes."-".$dia;

		$bd = abreConn();

		// Verifica se ja ta cadastrado
		$qD = mysqli_query($bd, "SELECT email, name from n_player_p where email = '".$_POST['emailReg']."'");
		$rsD = mysqli_fetch_assoc($qD);

		if ($rsD != NULL){
			redirect("../conta-ja-criada.php?player=".$rsD['name']."&email=".$rsD['email']);
		} else {

			$sql = "INSERT into n_player_p (name,  
										   email,
										   register_date,
										   user_hash,
										   password,
										   level,
										   avatar_id,
										   last_login,
										   status) values('".$_POST['nameReg']."',
										   '".$_POST['emailReg']."',
										   '".$dataAgora."',
										   '".base64_encode($_POST['emailReg'])."',
										   '".base64_encode($_POST['passWordReg'])."',
										   '1',
										   '1',
										   '".$dataAgora."',
										   'A') " ;
			mysqli_query($bd, $sql);

			
			// Efetua login do cara
			$q = mysqli_query($bd, "SELECT * FROM n_player_p where email = '".$_POST['emailReg']."' and status = 'A' ");
			$l = mysqli_fetch_assoc($q);
			mysqli_free_result($q);

			$_SESSION["loggedId"] = $l["id"];
			$_SESSION["loggedPlayerName"] = $l["name"];
			$_SESSION["loggedPlayerEmail"] = $l["email"];


			// Cadastra XP e 500 Moedas
			$sql = "INSERT into n_xp_coin_p (transaction_hash,  
											   player_id,
											   win_or_loose,
											   description,
											   xp_points,
											   np_coins,
											   status) 
											   	values(
											   	   '".base64_encode($_POST['emailReg'].$dataAgora)."',
												   '".$l['id']."',
												   'W',
												   'Criou conta Next Player',
												   '500',
												   '500.00',
												   'A'
												) " ;
			mysqli_query($bd, $sql);


			// Dados de Nivel e Avatar
			$qDj = mysqli_query($bd, "SELECT nl.level as level, na.avatar as avatar, na.pic_png as picPng 
									  from n_player_p as np, 
									 	n_level_plataforma_p as nl, 
									 	n_avatar_p as na
									  where 
									 	np.id = '".$l['id']."' and
									 	np.avatar_id = na.id and
									 	np.level = nl.id
									 	");
			$rsDj = mysqli_fetch_assoc($qDj);

			$_SESSION["loggedPlayerLevel"] = $rsDj["level"];
			$_SESSION["loggedPlayerAvatar"] = $rsDj["avatar"];
			$_SESSION["loggedPlayerAvatarPng"] = $rsDj["picPng"];


			// Dados XP e Moedas
			$_SESSION["loggedPlayerXp"] = 500;
			$_SESSION["loggedPlayerCoins"] = '500.00';

			redirect("../conta-criada-sucesso.php");

		}

		mysqli_close($bd);
	
	} else {
		redirect("../");
	}

?>
