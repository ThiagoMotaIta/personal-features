<?php include "../conn/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();
$today = date('Y-m-d');
            
if( isset($_GET['param']) ){

	// BUsca o param 
	$qL = mysqli_query($bd, "SELECT * from a_solicitacoes_e where (aluno_nome = '".$_GET['param']."' or aluno_matricula = '".$_GET['param']."') and status = 'A' ");
	$rsL = mysqli_fetch_assoc($qL);

	if ($rsL != NULL){


		// Situacao Beneficio
        if ($rsL['situacao_beneficio'] == 0){
            $sitBen = "EM ANÁLISE";
        }
        if ($rsL['situacao_beneficio'] == 1){
            $sitBen = "<strong class='text-primary'>APROVADO</strong>";
        }
        if ($rsL['situacao_beneficio'] == 2){
            $sitBen = "<strong class='text-danger'>REPROVADO</strong>";
        }
        if ($rsL['situacao_beneficio'] == 3){
            $sitBen = "<strong class='text-success'>ENTREGUE</strong>";
        }

        // Situacao Aliemntacao
        if ($rsL['situacao_alimentacao'] == 0){
            $sitAli = "EM ANÁLISE";
        }
        if ($rsL['situacao_alimentacao'] == 1){
            $sitAli = "<strong class='text-primary'>APROVADO</strong>";
        }
        if ($rsL['situacao_alimentacao'] == 2){
            $sitAli = "<strong class='text-danger'>REPROVADO</strong>";
        }

        // Situacao Tablet
        if ($rsL['situacao_tablet'] == 0){
            $sitTab = "EM ANÁLISE";
        }
        if ($rsL['situacao_tablet'] == 1){
            $sitTab = "<strong class='text-primary'>APROVADO</strong>";
        }
        if ($rsL['situacao_tablet'] == 2){
            $sitTab = "<strong class='text-danger'>REPROVADO</strong>";
        }

        if ($rsL['status_alimentacao'] == 0){
            $sitAli = "<span class='text-secondary'>NÃO SOLICITADO</span>";
        }

        if ($rsL['status_beneficio'] == 0){
            $sitBen = "<span class='text-secondary'>NÃO SOLICITADO</span>";
        }

        if ($rsL['status_alimentacao'] == 0){
            $sitAli = "<span class='text-secondary'>NÃO SOLICITADO</span>";
        }

        if ($rsL['status_tablet'] == 0){
            $sitTab = "<span class='text-secondary'>NÃO SOLICITADO</span>";
        }


		$arr2 = array(
			"sucesso" => "S",
			"idSol" => $rsL['id'],
			"matricula" => $rsL['aluno_matricula'],
			"aluno" => $rsL['aluno_matricula'],
			"nascimento" => $rsL['aluno_matricula'],
			"cpf" => $rsL['aluno_matricula'],
			"situacaoBen" => $sitBen,
			"situacaoAli" => $sitAli,
			"situacaoTab" => $sitTab
		);

	} else {
		
		$arr2 = array(
			"sucesso" => "N"
		);

	}

} else {
	$arr2 = array(
		"sucesso" => "N"
	);
}

array_push($arr,$arr2);

mysqli_close($bd);	
 
print json_encode($arr);

?>