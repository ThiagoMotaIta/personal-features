<?php include "../includes/functions.php"; 

date_default_timezone_set('America/Sao_Paulo');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$dataAgora = $ano."-".$mes."-".$dia;

$bd = abreConn();

$log = $_POST["emailLogin"];
$pass = base64_encode($_POST["passWordLogin"]);

// Verifica se possui conta  
$qL = mysqli_query($bd, "SELECT * from n_player_p where password = '".$pass."' and email = '".$log."' and status = 'A' ");
$rsL = mysqli_fetch_assoc($qL);

// Se nao existir...
if ($rsL == NULL){
	
	redirect("../erro-login.php?email=".$_POST["emailLogin"]);

} else { // Se tiver conta, faz login, atualiza last login e criar as variaveis de sessao

	// Atualiza ultimo login
	$sqlUp = "UPDATE n_player_p SET last_login ='".$dataAgora."' WHERE id='".$rsL['id']."' ";
	mysqli_query($bd, $sqlUp);

	$_SESSION["loggedId"] = $rsL["id"];
	$_SESSION["loggedPlayerName"] = $rsL["name"];
	$_SESSION["loggedPlayerEmail"] = $rsL["email"];
	$_SESSION["idioma"] = "br";


	// Dados de Nivel e Avatar
	$qDj = mysqli_query($bd, "SELECT nl.level as level, na.avatar as avatar, na.pic_png as picPng 
							  from n_player_p as np, 
							 	n_level_plataforma_p as nl, 
							 	n_avatar_p as na
							  where 
							 	np.id = '".$rsL['id']."' and
							 	np.avatar_id = na.id and
							 	np.level = nl.id
							 	");
	$rsDj = mysqli_fetch_assoc($qDj);

	$_SESSION["loggedPlayerAvatar"] = $rsDj["avatar"];
	$_SESSION["loggedPlayerAvatarPng"] = $rsDj["picPng"];


	// Soma Pontos e Moedas
	$qXc = mysqli_query($bd, "SELECT SUM(np_coins) as totalMoedas, SUM(xp_points) as totalPontos from n_xp_coin_p where player_id = '".$rsL['id']."' ");
	$rsXc = mysqli_fetch_assoc($qXc);

	$_SESSION["loggedPlayerXp"] = $rsXc['totalPontos'];
	$_SESSION["loggedPlayerCoins"] = $rsXc['totalMoedas'];

	// Level
    $qLv = mysqli_query($bd, "SELECT * from n_level_plataforma_p where xp_points <= '".$rsXc['totalPontos']."' and status = 'A' order by id desc limit 0,1");
    $rsLv = mysqli_fetch_assoc($qLv);

    $_SESSION["loggedPlayerLevel"] = $rsLv['level'];
	

	redirect("../sucesso-login.php");
}

mysqli_close($bd);

?>