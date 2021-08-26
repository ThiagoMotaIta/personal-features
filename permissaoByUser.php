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
if (isset($_GET['usuarioId'])){

		
	$q = mysqli_query($link, "SELECT * FROM permissoes where usuario_id = '".$_GET['usuarioId']."' and status = 'A' order by id desc limit 0,1");

	$num_rows = mysqli_num_rows($q);

	if ($num_rows > 0){
	
		while ($rs = mysqli_fetch_array($q)){

			$arr2 = array(
				"listarNC" => $rs["listar_nc"],
				"importarNC" => $rs["importar_nc"],
				"exportarNC" => $rs["exportar_nc"],
				//
				"listarBA" => $rs["listar_ba"],
				"importarBA" => $rs["importar_ba"],
				"exportarBA" => $rs["exportar_ba"],
				//
				"listarPG" => $rs["listar_pg"],
				"importarPG" => $rs["importar_pg"],
				"exportarPG" => $rs["exportar_pg"],
				//
				"listarAG" => $rs["listar_ag"],
				"incluirAG" => $rs["incluir_ag"],
				"editarAG" => $rs["editar_ag"],
				"apagarAG" => $rs["apagar_ag"],
				//
				"listarGAV" => $rs["listar_gav"],
				"incluirGAV" => $rs["incluir_gav"],
				//
				"sucesso" => "S",
			);

		}

	} else {
		$arr2 = array(
			"sucesso" => "N",
		);
	}

	array_push($arr,$arr2);
		

} else { // GERAL
	$arr2 = array(
		"sucesso" => "N",
	);
}

mysqli_close($link);
 
print json_encode($arr);

?>