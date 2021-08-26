<?php include "../conn/functions.php";

$bd = abreConn();

if (isset($_GET['cpf'])){
    $qL = mysqli_query($bd, "SELECT * from a_solicitantes_e WHERE cpf = '" . $_GET['cpf'] . "' ");
    $rsL = mysqli_fetch_assoc($qL);

    if ($rsL == NULL) {
        echo($_GET['cpf']." nao encontrado.");
    } else {

        $qL1 = mysqli_query($bd, "DELETE FROM a_solicitacoes_e WHERE id_solicitante = '".$rsL['id']."' ");
        echo("Solicitacao(oes) para o CPF ".$_GET['cpf']." deletada(s)<br/>");

        $qL2 = mysqli_query($bd, "DELETE FROM a_logs_e WHERE id_solicitante = '".$rsL['id']."' ");
        echo("Logs deletados para o CPF ".$_GET['cpf']."<br/>");

        $qL3 = mysqli_query($bd, "DELETE FROM a_solicitantes_e WHERE cpf = '".$_GET['cpf']."' ");
        echo("Solicitante deletado para o CPF ".$_GET['cpf']);
    }
} else {
    echo("CPF ausente");
}

mysqli_close($bd);