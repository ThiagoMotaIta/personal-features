<?php session_start();
error_reporting(E_ERROR | E_PARSE);
//local
function abreConn(){
	$bd = mysqli_connect("localhost","blockcha_user_ap","5fS35SWk#", "blockcha_app_aux") or die("Não conseguiu conectar ao servidor! " . mysqli_error());
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
$versao = "21";
?>