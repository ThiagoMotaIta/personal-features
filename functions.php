<?php

//local
function abreConn(){
	$bd = mysqli_connect("localhost","nextplay_np_root","QePsRo61%", "nextplay_plataform_np") or die("Não conseguiu conectar ao servidor! " . mysqli_error());
	return $bd;
}

function redirect($url){
?>
	<script language="javascript">
		document.location.href = "<?=$url?>";
	</script>
<?php 
	die();
}
?>