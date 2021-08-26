<?php include "../conn/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();
            
if( isset($_GET['login']) && isset($_GET['passWord']) ){

	$log = $_GET["login"];
	$pass = base64_encode($_GET["passWord"]);

	// Verifica se possui acesso  
	$qL = mysqli_query($bd, "SELECT * from a_usu_func_e where senha = '".$pass."' and email = '".$log."' and status = 'A' ");
	$rsL = mysqli_fetch_assoc($qL);
	
	// Se nao existir...
	if ($rsL == NULL){
		
		$arr2 = array(
			"success" => "N"
		);

	} else {

		// Seta variáveis de sessão
		$_SESSION["loggedId"] = $rsL["id"];
		$_SESSION["loggedName"] = $rsL["nome"];
		$_SESSION["loggedEmail"] = $rsL["email"];

		// Monta o retorno do JSON de sucesso
		$arr2 = array(
			"success" => "S"
		);
	}

} else {
	$arr2 = array(
		"success" => "N"
	);
}

array_push($arr,$arr2);

mysqli_close($bd);	
 
print json_encode($arr);

?>