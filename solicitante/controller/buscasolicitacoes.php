<?php include "../../conn/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();

$situacaoTablet;
$solicitouTablet;
$situacaoAlim;
$solicitouAlim;

// Busca se tem CPF Cadastrado
$qP = mysqli_query($bd, "SELECT * from a_solicitantes_e where cpf = '".$_GET['cpf']."' and status = 'A' order by id desc limit 0,1" );
$rsP = mysqli_fetch_assoc($qP);

// Verifica se esse CPF fez alguma solicitacao
$qS = mysqli_query($bd, "SELECT * from a_solicitacoes_e where id_solicitante = '".$rsP['id']."' and status = 'A'");


while ($rsS = mysqli_fetch_array($qS)){

    if ($rsS != NULL){

        // Dados da Escola
        $qE = mysqli_query($bd, "SELECT * from a_escolas_e where inep = '".$rsS['aluno_escola']."' and status = 'A'" );
        $rsE = mysqli_fetch_assoc($qE);

        // Se tiver solicitado Tablet
        if ($rsS['status_tablet'] == 1){
            if ($rsS['situacao_tablet'] == 0){
                $situacaoTablet = "<strong>EM AN&Aacute;LISE</strong>";
            }
            if ($rsS['situacao_tablet'] == 1){
                $situacaoTablet = "<strong class='text-success'>APROVADO</strong>";
            }
            if ($rsS['situacao_tablet'] == 2){
                $situacaoTablet = "<strong class='text-danger'>REPROVADO <button type='button' class='btn btn-sm btn-danger' onclick='editarSol(".$rsS['id'].")'><i class='fa fa-pencil-alt'></i> CORRIGIR DADOS</button></strong>";
            }
            if ($rsS['situacao_tablet'] == 3){
                $situacaoTablet = "<strong class='text-success'>JÁ ENTREGUE</strong>";
            }

            $solicitouTablet = "S";
        } else {
            $solicitouTablet = "N";
        }

        // Se tiver solicitado Alimentacao
        if ($rsS['status_alimentacao'] == 1){
            if ($rsS['situacao_alimentacao'] == 0){
                $situacaoAlim = "<strong>EM AN&Aacute;LISE</strong>";
            }
            if ($rsS['situacao_alimentacao'] == 1){
                $situacaoAlim = "<strong class='text-success'>APROVADO</strong>";
            }
            if ($rsS['situacao_alimentacao'] == 2){
                $situacaoAlim = "<strong class='text-danger'>REPROVADO <button type='button' class='btn btn-sm btn-danger' onclick='editarSol(".$rsS['id'].")'><i class='fa fa-pencil-alt'></i> CORRIGIR DADOS</button></strong>";
            }

            $solicitouAlim = "S";
        } else {
            $solicitouAlim = "N";
        }

        $arr2 = array(
            "idSolicitante" => $rsS["id_solicitante"],
            "identificadorAluno" => $rsS["aluno_matricula"],
            "nomeAluno" => htmlentities(stripslashes(utf8_encode($rsS["aluno_nome"])), ENT_QUOTES),
            "serieAluno" => $rsS["aluno_serie"],
            "nomeEscola" => $rsE["condicao"]." ".$rsE["escola"],
            "dataCadastro" => $rsS["data_solicitada"],
            "solicitouTablet" => $solicitouTablet,
            "situacaoTablet" => $situacaoTablet,
            "solicitouAlim" => $solicitouAlim,
            "situacaoAlim" => $situacaoAlim,
            "found" => "S"
        );
    } else {
        $arr2 = array(
            "found" => "N"
        );
    }   

array_push($arr,$arr2);
}

mysqli_close($bd);  
 
print json_encode($arr);

?>