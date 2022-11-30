<?php include "../includes/functions.php";
$bd = abreConn();
            
if( isset($_GET['lang']) ){

	$_SESSION["idioma"] = $_GET['lang'];
	
}

redirect("../");

mysqli_close($bd);	

?>