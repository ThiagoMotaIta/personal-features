<?php include "../includes/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();

$qP = mysqli_query($bd, "SELECT * from n_player_p where email = '".$_GET['email']."' and status = 'A'" );
$rsP = mysqli_fetch_assoc($qP);


if ($rsP != NULL){

	$hashUser = $rsP['user_hash'];
	$to = $rsP['email'];
	$subject = "Recuperar Acesso - NEXT PLAYER";
	$html = "
	<html>
	<body>
	<img src='https://nextplayer.com.br/assets/images/logotipoAzulNovo.fw.png' width='100%' />
	<br/><br/>
	<div align='justify'>
		Clique no link para alterar sua senha:
		<br/>
		<br/>
		<a href='https://nextplayer.com.br/recuperar-acesso-senha.php?hash=$hashUser' target='_Blank' style='padding:10px; background-color: #212529; color:#fff'>
			RECUPERAR ACESSO
		</a>
	</div>
	</body>
	</html>";
	$headers = "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: NEXT PLAYER <suporte@nextplayer.com.br>\r\n";

	mail($to, $subject, $html, $headers);

	$arr2 = array(
		"enviado" => "S"
	);
} else {
	$arr2 = array(
		"enviado" => "N"
	);
}	

array_push($arr,$arr2);

mysqli_close($bd);	
 
print json_encode($arr);

?>