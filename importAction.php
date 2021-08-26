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
if ($_FILES["baseComparada"]["name"] != ""){

	// UPLOAD =============================
	
	$ext = strtolower(strrchr($_FILES["baseComparada"]["name"],"."));
	$target_dir = "arquivos_comparacao/";
	$new_file_name = $dia."-".$mes."-".$ano."-".$_FILES["baseComparada"]["name"];
	$target_file = $target_dir . $new_file_name;
	$uploadOk = 1;
	$ArqFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	// Check if file already exists
	/*if (file_exists($target_file)) {
	    //echo "Arquivo ja existente. Procure renomear seu CV. ";
	    $uploadOk = 0;
	}*/

	// Check file size
	if (round($_FILES["baseComparada"]["size"] / 1024) > 4096) {
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
	    redirect("uploadComparacao.php?sucesso=0");
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["baseComparada"]["tmp_name"], $target_file)) {
	        
	        $lendo = @fopen("arquivos_comparacao/".$dia."-".$mes."-".$ano."-".$_FILES["baseComparada"]["name"],"r");
			if (!$lendo) {
				echo "Erro ao abrir a URL.<br>";
				echo "Arquivo selecionado: ".$_FILES["baseComparada"]["name"];
			exit;
			} else {
				$qCl = mysqli_query($link, "UPDATE base_comparada SET status = 'E' where status = 'A' ");
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

				$cdpasta = tirarAcentos($linha[0]);
				$adv_parte_contraria = tirarAcentos($linha[1]);

				if ($linha[0] != '' && $linha[0] != 'TOTAL' && $linha[0] != 'Base'){
					$insere="INSERT into base_comparada (status, cdpasta, adv_parte_contraria, id_cadastrador, nome_arquivo, data_importacao)
												values 
											  ('A', '".$cdpasta."', '".$adv_parte_contraria."', '".$_SESSION['id']."', '".$dia."-".$mes."-".$ano."-".$_FILES["baseComparada"]["name"]."', '".$ano."-".$mes."-".$dia."')";
					mysqli_query($link, $insere) or die(mysql_error());
				}
			}

			/* fechamos o csv */
			fclose($lendo);


			// ===================== PAREAMENTO COM A BASE DE AGRESSORES
			$q=  mysqli_query($link, "SELECT * FROM base_comparada where status = 'A' ");

			while ($rs = mysqli_fetch_array($q)){

			    //$style = 'bgcolor=#ffc266 color=#000';

			    $q1 = mysqli_query($link, "SELECT id, nome_agressor from base_agressores where nome_agressor LIKE '%".trim($rs['adv_parte_contraria'])."%' and status = 'A' ");
			    $l1 = mysqli_fetch_assoc($q1);

			    $agressor;

			    if ($l1['id'] != ""){
			      $agressor = "SIM";
			    } else {
			      $agressor = "NAO";
			    }

			    if (trim($rs['adv_parte_contraria']) == ""){
			    	$agressor = "";
			    }

			    $sql2 = "UPDATE base_comparada SET verificar_agressor = '".$agressor."' WHERE id='".$rs["id"]."' ";
				mysqli_query($link, $sql2);
			}
			// ====================== FIM PAREAMENTO


	        redirect("uploadComparacao.php?sucesso=1");

	    } else {
	        //echo "Erro ao enviar arquivo.";
	        redirect("uploadComparacao.php?sucesso=2");
	    }
	}

	// FIM UPLOAD =========================

} else {
	redirect("uploadComparacao.php?sucesso=3");
}

mysqli_close($link);
?>