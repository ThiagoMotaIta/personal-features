<?php include "includes/functions.php";
error_reporting(E_ERROR | E_PARSE);
	
	if ($_POST['email'] != NULL){

		// INTEGRAO API GET RESPONSE - LISTA nextplayer_pre_inscritos
		$URL='https://api.getresponse.com/v3/contacts';
		$headers = array();
		$headers[] = 'X-Auth-Token: api-key takdx4zbs2li53hftssqg44tydnghf0i';

		$fields = array(
						'name'=>$_POST['name'],
						'email'=>$_POST['email'],
						'campaign'=> array ('campaignId'=>'oi0I5')
						);

		$fields_string = http_build_query($fields);				

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$URL);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch,CURLOPT_POST, true);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		$result=curl_exec ($ch);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close ($ch);
		//echo($result);

		//Apos cadastrar no get response via API, devolve o cara para a plataforma

		date_default_timezone_set('America/Sao_Paulo');
		$dia = date('d');
		$mes = date('m');
		$ano = date('Y');
		$dataAgora = $ano."-".$mes."-".$dia;

		$bd = abreConn();
		
		$sql = "insert into n_pre_sub_p (name,  
										   email,
										   date,
										   status) values('".$_POST['name']."',
										   '".$_POST['email']."',
										   '".$dataAgora."',
										   'A') " ;
		mysqli_query($bd, $sql);

		mysqli_close($bd);

		redirect("../preinscrito/");
	
	} else {
		redirect("index.php");
	}

?>
