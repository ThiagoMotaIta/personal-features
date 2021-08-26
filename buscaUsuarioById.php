<?php session_start(); ?>
<?php include "includes/funcoes.php"; 

header('Content-Type: application/json');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
error_reporting(E_ERROR | E_PARSE);

// JSON referente ao login ao sistema
$link = abreConn();
$arr = array();

// GERAL
if (isset($_GET['idUsuario'])){

		
	$q = mysqli_query($link, "SELECT * FROM acesso where id = '".$_GET['idUsuario']."' and status = 'A' ");
	
	while ($rs = mysqli_fetch_array($q)){
		$arr2 = array(
			"id" => $rs["id"],
			"usuario" => $rs["usuario"],
			"email" => $rs["email"],
			"senha" => $rs["senha"],
			"loginPjur" => $rs["login_bj"],
			"senhaPjur" => $rs["senha_bj"],
			"sucesso" => "S",
		);

		array_push($arr,$arr2);
	}
		

} else { // GERAL
	$arr2 = array(
		"sucesso" => "N",
	);
}

mysqli_close($link);
 
print json_encode($arr);

?>