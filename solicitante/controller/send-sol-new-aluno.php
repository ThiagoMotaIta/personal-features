<?php include "../../conn/functions.php";

$bd = abreConn();

$today = date('Y-m-d H:i:s');


$qL = mysqli_query($bd, "SELECT * from a_solicitantes_e WHERE id = '" . $_POST['id-solicitante-novoAluno'] . "' ");

$rsL = mysqli_fetch_assoc($qL);
if ($rsL == NULL) {
    // Solicitante nao encontrado
} else {

    $qL4 = mysqli_query($bd, "INSERT INTO `a_solicitacoes_e`(`id_solicitante`, `data_solicitada`, `status_beneficio`, `status_alimentacao`, `status_tablet`,
    `aluno_nome`, `aluno_cpf`, `aluno_nascimento`, `aluno_escola`, `aluno_serie`, `aluno_matricula`, `status`,`situacao_beneficio`,`situacao_alimentacao`,`situacao_tablet`) 
    VALUES ('" . $_POST['id-solicitante-novoAluno'] . "','" . $today . "','0','1','1','" . $_POST['nomeAluno-novoAluno'] . "','" . $_POST['cpfAluno-novoAluno'] . "','" . $_POST['dataNascAluno-novoAluno'] . "','" . $_POST['escolaAlunoId-novoAluno'] . "','" . $_POST['serieAluno-novoAluno'] . "','" . $_POST['idAluno-novoAluno'] . "','A','0','0','0')");

    $qL5 = mysqli_query($bd, "INSERT INTO `a_logs_e`(`titulo`, `descricao`, `data`, `id_solicitante`, `situacao`) 
    VALUES ('" . $_POST['idAluno-novoAluno'] . "','','" . $today . "','" . $_POST['id-solicitante-novoAluno'] . "','Em an&aacute;lise')");

    redirect("../sucesso.php?sm=1");

}

mysqli_close($bd);
