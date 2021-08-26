<?php include "../../conn/functions.php";

$bd = abreConn();

$today = date('Y-m-d H:i:s');

// Lista solicitacoes Tablet EM ANALISE
$qL = mysqli_query($bd, "SELECT * from a_solicitacoes_e WHERE status_tablet = '1' and situacao_tablet = '0' order by id limit 0,100 ");

while ($rsP = mysqli_fetch_array($qL)){

    // Se encontrar, atualiza Reprovado
    if ($rsP != NULL && strlen($rsP['aluno_matricula']) < 12){
        $qL4 = mysqli_query($bd, "UPDATE a_solicitacoes_e SET
                                  situacao_tablet = '2'
                                  WHERE id = '".$rsP['id']."' ");

        $qL5 = mysqli_query($bd, "INSERT INTO `a_logs_e`(`titulo`, `descricao`, `data`, `id_solicitante`, `situacao`) 
        VALUES ('" . $rsP['aluno_matricula'] . "','','" . $today . "','" . $rsP['id_solicitante'] . "','Reprovado')");
    }

}


// Lista solicitacoes Alim
$qL = mysqli_query($bd, "SELECT * from a_solicitacoes_e WHERE status_alimentacao = '1' and situacao_alimentacao = '0' order by id limit 0,100 ");

while ($rsP = mysqli_fetch_array($qL)){

    // Se encontrar, atualiza Reprovado
    if ($rsP != NULL && strlen($rsP['aluno_matricula']) < 12){
        $qL4 = mysqli_query($bd, "UPDATE a_solicitacoes_e SET
                                  situacao_alimentacao = '2'
                                  WHERE id = '".$rsP['id']."' ");

        $qL5 = mysqli_query($bd, "INSERT INTO `a_logs_e`(`titulo`, `descricao`, `data`, `id_solicitante`, `situacao`) 
        VALUES ('" . $rsP['aluno_matricula'] . "','','" . $today . "','" . $rsP['id_solicitante'] . "','Reprovado')");
    }

}


mysqli_close($bd);
