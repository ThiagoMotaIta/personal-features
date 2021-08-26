<?php session_start();
error_reporting(E_ERROR | E_PARSE);
//local
function abreConn(){
	$bd = mysqli_connect("localhost","root","", "auxilio_caucaia") or die("Não conseguiu conectar ao servidor!");
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
$versao = "1";
?>