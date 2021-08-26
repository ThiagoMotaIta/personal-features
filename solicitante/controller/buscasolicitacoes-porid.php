<?php include "../../conn/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();

$qP = mysqli_query($bd, "SELECT * from a_solicitacoes_e where id = '".$_GET['id']."' and status = 'A'" );
$rsP = mysqli_fetch_assoc($qP);


if ($rsP != NULL){

    // Dados da Escola
    $qE = mysqli_query($bd, "SELECT * from a_escolas_e where inep = '".$rsP['aluno_escola']."' and status = 'A'" );
    $rsE = mysqli_fetch_assoc($qE);

    $arr2 = array(
        "found" => "S",
        "idTabelaAluno" => $rsP['id'],
        "identificadorAluno" => $rsP['aluno_matricula'],
        "nomeAluno" => $rsP['aluno_nome'],
        "escolaAluno" => $rsE['escola']." - ".$rsE['condicao'],
        "escolaInepAluno" => $rsE['inep'],
        "serieAluno" => $rsP['aluno_serie'],
        "cpfAluno" => $rsP['aluno_cpf'],
        "nascimentoAluno" => $rsP['aluno_nascimento']
    );
} else {
    $arr2 = array(
        "found" => "N"
    );
}   

array_push($arr,$arr2);

mysqli_close($bd);  
 
print json_encode($arr);

?>