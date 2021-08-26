<?php include "conn/functions.php";

$bd = abreConn();

$today = date('Y-m-d H:i:s');


$qL = mysqli_query($bd, "SELECT * from a_solicitacoes_e WHERE id = '" . $_GET['idSol'] . "' ");
$rsL = mysqli_fetch_assoc($qL);

if ($rsL == NULL) {
    // Aluno nao encontrado
} else {

    $qL4 = mysqli_query($bd, "UPDATE a_solicitacoes_e SET aluno_nome = '".$_POST['nome-aluno-'.$_GET['idSol']]."',
                              aluno_escola = '".$_POST['escola-aluno-'.$_GET['idSol']]."',
                              aluno_serie = '".$_POST['serie-aluno-'.$_GET['idSol']]."',
                              aluno_matricula = '".$_POST['id-aluno-'.$_GET['idSol']]."'
                              WHERE id = '".$rsL['id']."' ");

    //$qL5 = mysqli_query($bd, "INSERT INTO `a_logs_e`(`titulo`, `descricao`, `data`, `id_solicitante`, `situacao`) 
    //VALUES ('" . $_POST['idAluno-edit'] . "','','" . $today . "','" . $rsL['id_solicitante'] . "','Aprovado')");

    
    $qSol = mysqli_query($bd, "SELECT * from a_solicitantes_e WHERE id = '" . $rsL['id_solicitante'] . "' ");
    $rsSol = mysqli_fetch_assoc($qSol);


    redirect("entregas.php?cpf=".$rsSol['cpf']);

}

mysqli_close($bd);
