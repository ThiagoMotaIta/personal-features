<?php session_start(); ?>
<?php include "includes/funcoes.php"; 

header('Content-Type: application/json');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
error_reporting(E_ERROR | E_PARSE);

function tirarAcentosMelhorada($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/", "/(ç)/", "/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$string);
}

$link = abreConn();
$arr = array();

// NOVO USUARIO
if (isset($_GET['nomeUsuario']) && isset($_GET['emailUsuario']) && isset($_GET['senhaUsuario']) && !isset($_GET['usuarioId'])){

	$_GET['nomeUsuario'] = tirarAcentosMelhorada($_GET['nomeUsuario']);
	
	$sql = "INSERT INTO acesso (usuario, email, senha, login_bj, senha_bj, status) VALUES ('".$_GET['nomeUsuario']."', '".$_GET['emailUsuario']."', '".$_GET['senhaUsuario']."', '".$_GET['usuarioPjur']."', '".$_GET['senhaPjur']."', 'A')";
	mysqli_query($link, $sql);

	$arr2 = array(
		"cad" => "S"
	);

}

// EDITAR USUARIO
if (isset($_GET['nomeUsuario']) && isset($_GET['emailUsuario']) && isset($_GET['senhaUsuario']) && isset($_GET['usuarioId'])){

	$_GET['nomeUsuario'] = tirarAcentosMelhorada($_GET['nomeUsuario']);
	
	$sql = "UPDATE acesso SET usuario = '".$_GET['nomeUsuario']."', email = '".$_GET['emailUsuario']."', senha = '".$_GET['senhaUsuario']."', login_bj = '".$_GET['usuarioPjur']."', senha_bj = '".$_GET['senhaPjur']."'  WHERE id='".$_GET["usuarioId"]."'";
	mysqli_query($link, $sql);

	$arr2 = array(
		"edit" => "S"
	);

}

mysqli_close($link);

array_push($arr,$arr2);
 
print json_encode($arr);

?>