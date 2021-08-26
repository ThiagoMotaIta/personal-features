<?php
/* dados de conexão */
//$conexao = mysqli_connect("localhost","gece_carlosm","110830Ck", "gece_carlosmatos") or die("Não conseguiu conectar ao servidor! " . mysql_error());
$conexao = mysqli_connect("localhost","root","", "auxilio_caucaia") or die("Não conseguiu conectar ao servidor! " . mysql_error());
?>

<?php 

ini_set('max_execution_time','-1');
	
?>

<?php
/*
dados.txt é o arquivo que tem os nomes e e-mails
como mostrado no exemplo acima
*/
$lendo = @fopen("escolas-txt.txt","r");
if (!$lendo) {
echo "Erro ao abrir a URL.<br>";
exit;
}

/*
aqui, criamos $posicao, um valor que será incrementado para
criar uma nova linha de inserção de dados
*/
$posicao = 0;
while (!feof($lendo)) {
$linha = fgets($lendo,256);
$posicao++;

/* aqui é criado um nome para cada inserção */
$insere = "linha".$posicao."";

/* quebramos as linhas */
$linha = explode(",", $linha);

/*
agora, inserimos na tabela dados, no campo nome e email, cada linha do txt
*/
$insere="INSERT into a_escolas_e (status, inep, escola, regiao, condicao)
							values 
						  ('A', '$linha[0]', '$linha[1]', '$linha[2]', '$linha[3]')";
mysqli_query($conexao, $insere) or die(mysql_error());
}

/* mensagem quando for tudo OK */
echo "Dados inseridos com sucesso.";

/* fechamos o txt */
fclose($lendo);
?>

<?php
/* fechamos a conexão */
mysqli_close($conexao);
?>