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
if ($_FILES["baseAgressores"]["name"] != ""){

	// UPLOAD =============================
	
	$ext = strtolower(strrchr($_FILES["baseAgressores"]["name"],"."));
	$target_dir = "arquivos_base_agressores/";
	$new_file_name = $dia."-".$mes."-".$ano."-".$_FILES["baseAgressores"]["name"];
	$target_file = $target_dir . $new_file_name;
	$uploadOk = 1;
	$ArqFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	// Check if file already exists
	/*if (file_exists($target_file)) {
	    //echo "Arquivo ja existente. Procure renomear seu CV. ";
	    $uploadOk = 0;
	}*/

	// Check file size
	if (round($_FILES["baseAgressores"]["size"] / 1024) > 4096) {
	    //echo "Tamanho maior que o permitido (2 MB). ";
	    $uploadOk = 0;
	}

	// Allow certain file formats
	if(/*$ArqFileType != "xls" && $ArqFileType != "xlsx" &&*/ $ArqFileType != "csv") {
	    //echo "Formato indevido. ";
	    $uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    //echo "Erro ao subir arquivo. ";
	    redirect("uploadBase.php?sucesso=0");
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["baseAgressores"]["tmp_name"], $target_file)) {
	        
	        $lendo = @fopen("arquivos_base_agressores/".$dia."-".$mes."-".$ano."-".$_FILES["baseAgressores"]["name"],"r");
			if (!$lendo) {
				echo "Erro ao abrir a URL.<br>";
				echo "Arquivo selecionado: ".$_FILES["baseAgressores"]["name"];
			exit;
			} else {
				$qCl = mysqli_query($link, "UPDATE base_agressores SET status = 'E' where status = 'A' ");
				$lCl = mysqli_fetch_assoc($qCl);
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

				$nomeAgressor = tirarAcentos($linha[0]);

				if ($linha[0] != '' && $linha[0] != 'agressor'){
					$insere="INSERT into base_agressores (status, nome_agressor, id_cadastrador, nome_arquivo, data_importacao)
												values 
											  ('A', '".$nomeAgressor."', '".$_SESSION['id']."', '".$dia."-".$mes."-".$ano."-".$_FILES["baseAgressores"]["name"]."', '".$ano."-".$mes."-".$dia."')";
					mysqli_query($link, $insere) or die(mysql_error());
				}
			}

			/* fechamos o csv */
			fclose($lendo);


	        redirect("uploadBase.php?sucesso=1");

	    } else {
	        //echo "Erro ao enviar arquivo.";
	        redirect("uploadBase.php?sucesso=2");
	    }
	}

	// FIM UPLOAD =========================

} else {
	redirect("uploadBase.php?sucesso=3");
}

mysqli_close($link);
?>