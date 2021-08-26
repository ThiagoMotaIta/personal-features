<?php session_start(); ?>
<?php include "includes/funcoes.php"; 

header('Content-Type: application/json');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
error_reporting(E_ERROR | E_PARSE);


$link = abreConn();
$arr = array();

if (isset($_GET['usuarioId'])){
	
	$sql = "INSERT INTO permissoes (cadastrador_id,
									usuario_id,
									data_setup,
									listar_nc,
									importar_nc,
									exportar_nc,
									listar_ba,
									importar_ba,
									exportar_ba,
									listar_pg,
									importar_pg,
									exportar_pg,
									listar_ag,
									incluir_ag,
									editar_ag,
									apagar_ag,
									listar_gav,
									incluir_gav,
									status
									) VALUES ('".$_SESSION['id']."',
											  '".$_GET['usuarioId']."',
											  '".$ano."-".$mes."-".$dia."', 
											  '".$_GET['listarNC']."',
											  '".$_GET['importarNC']."',
											  '".$_GET['exportarNC']."',
											  '".$_GET['listarBA']."',
											  '".$_GET['importarBA']."',
											  '".$_GET['exportarBA']."',
											  '".$_GET['listarPG']."',
											  '".$_GET['importarPG']."',
											  '".$_GET['exportarPG']."',
											  '".$_GET['listarAG']."',
											  '".$_GET['incluirAG']."',
											  '".$_GET['editarAG']."',
											  '".$_GET['apagarAG']."',
											  '".$_GET['listarGAV']."',
											  '".$_GET['incluirGAV']."',
											  'A')";
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