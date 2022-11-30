<?php include "../includes/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();

// Verifica se cara fez pre-inscricao
$sql = mysqli_query($bd, "SELECT email, name from n_pre_sub_p where email = '".$_GET['email']."'");
$result = mysqli_fetch_assoc($sql);

if($result != NULL){ // Se encontrar e-mail

	// Agora verifica se pre-inscrito ja se cadastrou na plataforma
	$sqlJaCad = mysqli_query($bd, "SELECT email from n_player_p where email = '".$result['email']."'");
	$resultJaCad = mysqli_fetch_assoc($sqlJaCad);

	if ($resultJaCad == NULL){
		$jaCadastrado = "N";
	} else {
		$jaCadastrado = "S";
	}
	
	$arr2 = array(
		"nomePreInsc" => $result["name"],
		"emailPreInsc" => $result["email"],
		"found" => "S",
		"jaCadastrado" => $jaCadastrado
		// ......
	);
} else {
	$arr2 = array(
		"found" => "N"
		// ......
	);
}

mysqli_close($bd);

array_push($arr,$arr2);	
 
print json_encode($arr);

?>