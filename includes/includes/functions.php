<?php session_start();
error_reporting(E_ERROR | E_PARSE);
//local
function abreConn(){
	$bd = mysqli_connect("localhost","nextplay_np_root","QePsRo61%", "nextplay_plataform_np") or die("Servidor Lotado! Tente novamente... " . mysqli_error());
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
$versao = "37";
?>