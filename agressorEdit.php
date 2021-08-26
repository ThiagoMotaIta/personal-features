<?php session_start(); ?>
<?php include "includes/funcoes.php"; 

header('Content-Type: application/json');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
error_reporting(E_ERROR | E_PARSE);

$link = abreConn();
$arr = array();

if (isset($_GET['grau']) && isset($_GET['id'])){
	
	$sql = "UPDATE base_agressores SET grau_agressor = '".$_GET['grau']."' WHERE id = '".$_GET['id']."' ";
	mysqli_query($link, $sql);

	$arr2 = array(
		"edit" => "S"
	);

} else {
	$arr2 = array(
		"edit" => "N"
	);
}

mysqli_close($link);

array_push($arr,$arr2);
 
print json_encode($arr);

?>