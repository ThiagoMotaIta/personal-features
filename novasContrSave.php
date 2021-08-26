<?php session_start(); ?>
<?php include "includes/funcoes.php";

date_default_timezone_set('America/Sao_Paulo');
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$dataAgora = $dia."/".$mes."/".$ano;
error_reporting(E_ERROR | E_PARSE);

$link = abreConn();

// Verifica se não vem em branco
if ($_FILES["novasContr"]["name"] != ""){

	// UPLOAD =============================
	
	$ext = strtolower(strrchr($_FILES["novasContr"]["name"],"."));
	$target_dir = "arquivos_novas_contr/";
	$new_file_name = $dia."-".$mes."-".$ano."-".$_FILES["novasContr"]["name"];
	$target_file = $target_dir . $new_file_name;
	$uploadOk = 1;
	$ArqFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	// Check if file already exists
	/*if (file_exists($target_file)) {
	    //echo "Arquivo ja existente. Procure renomear seu CV. ";
	    $uploadOk = 0;
	}*/

	// Check file size
	if (round($_FILES["novasContr"]["size"] / 1024) > 2048) {
	    //echo "Tamanho maior que o permitido (2 MB). ";
	    $uploadOk = 0;
	}

	// Allow certain file formats
	if($ArqFileType != "csv") {
	    //echo "Formato indevido. ";
	    $uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    //echo "Erro ao subir arquivo. ";
	    redirect("uploadNovasContr.php?sucesso=0");
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["novasContr"]["tmp_name"], $target_file)) {
	        
	        $lendo = @fopen("arquivos_novas_contr/".$dia."-".$mes."-".$ano."-".$_FILES["novasContr"]["name"],"r");
			if (!$lendo) {
				echo "Erro ao abrir a URL.<br>";
				echo "Arquivo selecionado: ".$_FILES["novasContr"]["name"];
			exit;
			}

			ini_set('max_execution_time','-1');
			ini_set('memory_limit', '-1');

			$posicao = 0;
				while (!feof($lendo)) {
				$linha = fgets($lendo,256);
				$posicao++;

				$insere = "linha".$posicao."";

				/* quebramos as linhas */
				$linha = explode(";", $linha);

				$cdpasta = tirarAcentos($linha[0]);

				$hashCod = base64_encode($dia."/".$mes."/".$ano.$_FILES["novasContr"]["name"]);

				if ($linha[0] != '' && $linha[0] != 'NUMERO_PASTA'){
					$insere="INSERT into base_novas_contr (status, cdpasta, cadastrador_id, nome_arquivo, data_importacao, hash_cod)
												values 
											  ('A', '".$cdpasta."', '".$_SESSION['id']."', '".$dia."-".$mes."-".$ano."-".$_FILES["novasContr"]["name"]."', '".$ano."-".$mes."-".$dia."', '".$hashCod."')";
					mysqli_query($link, $insere) or die(mysql_error());
				}
			}

			/* fechamos o csv */
			fclose($lendo);


	        redirect("uploadNovasContr.php?sucesso=1");

	    } else {
	        //echo "Erro ao enviar arquivo.";
	        redirect("uploadNovasContr.php?sucesso=2");
	    }
	}

	// FIM UPLOAD =========================

} else {
	redirect("uploadNovasContr.php?sucesso=3");
}

mysqli_close($link);
?>