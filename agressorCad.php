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

if (isset($_GET['nome']) && isset($_GET['grau'])){

	$_GET['nome'] = tirarAcentosMelhorada($_GET['nome']);
	
	$sql = "INSERT INTO base_agressores (nome_agressor, grau_agressor, id_cadastrador, data_importacao, status) VALUES ('".strtoupper($_GET['nome'])."', '".$_GET['grau']."', '1', '".$ano."-".$mes."-".$dia."', 'A')";
	mysqli_query($link, $sql);

	$arr2 = array(
		"cad" => "S"
	);

} else {
	$arr2 = array(
		"cad" => "N"
	);
}

mysqli_close($link);

array_push($arr,$arr2);
 
print json_encode($arr);

?>