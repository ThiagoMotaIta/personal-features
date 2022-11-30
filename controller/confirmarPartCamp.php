<?php include "../includes/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();

if (!isset($_GET['camp']) || !isset($_GET['player'])  ){
	$arr2 = array(
		"success" => "N"
	);
} else {

	// Dados do Campeonato
    $qC = mysqli_query($bd, "SELECT * from n_championship_p where id = '".$_GET['camp']."' and status = 'A' ");
    $rsC = mysqli_fetch_assoc($qC);

    // Verfica se tem taxa de inscricao
    if ($rsC['subscription_free'] == 'S'){
    	$paymentStatus = 1;
    	$subVal = '0.00';
    } else {
    	$paymentStatus = 0;
    	$subVal = $rsC['subscription_value'];
    }


	// Confirma participação
	$sql = "INSERT into n_championship_sub_p (championship_id,  
									   player_id,
									   team_id,
									   payment_value,
									   payment_status,
									   status) values('".$_GET['camp']."',
									   '".$_GET['player']."',
									   '".$_GET['squad']."',
									   '".$subVal."',
									   '".$paymentStatus."',
									   'A') " ;
	mysqli_query($bd, $sql);

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
										   '".$_GET['player']."',
										   'W',
										   'Confirmou presenca Campeonato',
										   '300',
										   '100.00',
										   'A'
										) " ;
	mysqli_query($bd, $sql);

	// Atualiza as variaveis de sessao para XP e NP
	$novoXP = $_SESSION["loggedPlayerXp"] + 300;
	$novoNP = $_SESSION["loggedPlayerCoins"] + 100;

	unset($_SESSION["loggedPlayerXp"]);
	unset($_SESSION["loggedPlayerCoins"]);

	$_SESSION["loggedPlayerXp"] = $novoXP;
	$_SESSION["loggedPlayerCoins"] = $novoNP;

	$arr2 = array(
		"success" => "S",
		"free" => $rsC['subscription_free'],
		"taxa" => $rsC['subscription_value']
	);

}

mysqli_close($bd);

array_push($arr,$arr2);	
 
print json_encode($arr);

?>