<?php include "../../conn/functions.php";

$bd = abreConn();

$today = date('Y-m-d H:i:s');


$qL = mysqli_query($bd, "SELECT * from a_solicitacoes_e WHERE id = '" . $_POST['idTable-edit'] . "' ");
$rsL = mysqli_fetch_assoc($qL);

if ($rsL == NULL) {
    // Aluno nao encontrado
} else {

    $qL4 = mysqli_query($bd, "UPDATE a_solicitacoes_e SET aluno_nome = '".$_POST['nomeAluno-edit']."',
                              aluno_cpf = '".$_POST['cpfAluno-edit']."',
                              aluno_nascimento = '".$_POST['dataNascAluno-edit']."',
                              aluno_escola = '".$_POST['escolaAlunoId-edit']."',
                              aluno_serie = '".$_POST['serieAluno-edit']."',
                              aluno_matricula = '".$_POST['idAluno-edit']."',
                              situacao_beneficio = '0',
                              situacao_alimentacao = '0',
                              situacao_tablet = '0'
                              WHERE id = '".$rsL['id']."' ");

    $qL5 = mysqli_query($bd, "INSERT INTO `a_logs_e`(`titulo`, `descricao`, `data`, `id_solicitante`, `situacao`) 
    VALUES ('" . $_POST['idAluno-edit'] . "','','" . $today . "','" . $rsL['id_solicitante'] . "','Em an&aacute;lise')");
    

    redirect("../sucesso-edit.php?sm=1");

}

mysqli_close($bd);
