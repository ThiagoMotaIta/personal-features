<?php session_start(); ?>
<?php include "includes/funcoes.php"; 

header('Content-Type: application/json');

date_default_timezone_set('America/Sao_Paulo');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$dataAgora = $dia."/".$mes."/".$ano;
error_reporting(E_ERROR | E_PARSE);

// JSON referente ao login ao sistema
$link = abreConn();
$arr = array();

$log = $_GET["email"];
$pass = $_GET["senha"];
  
$q = mysqli_query($link, "SELECT * FROM acesso where email = '".$log."' and senha ='".$pass."' and status = 'A' ");
$l = mysqli_fetch_assoc($q);
mysqli_free_result($q);

$_SESSION["id"] = $l["id"];
$_SESSION["usuario"] = $l["usuario"];
$_SESSION["email"] = $l["email"];

// Verifica se encontrou usuario no banco
if ($_SESSION["id"] == "") {
	$arr2 = array(
		"loginOk" => "N",
	);
} else {
	$arr2 = array(
		"loginOk" => "S",
	);

	// Atualiza data ultimo acesso
	$sqlUp = "UPDATE acesso SET ultimo_acesso='".$dataAgora."' WHERE id='".$_SESSION["id"]."' ";
	mysqli_query($link, $sqlUp);
}

mysqli_close($link);

array_push($arr,$arr2);
 
print json_encode($arr);

?>