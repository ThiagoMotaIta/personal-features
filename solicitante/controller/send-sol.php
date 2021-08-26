<?php include "../../conn/functions.php";

$bd = abreConn();

// Etapa 1
$solicitante_nome = $_POST["nomeResp"];
$cpf = $_POST["cpfResp"];
$rg = $_POST["rgResp"];
$data_nascimento = $_POST["dataNascResp"];
$telefone_celular = $_POST["celularResp"];

// Etapa 2
$end_cep = $_POST["cepResp"];
$end_cidade = $_POST["cidadeResp"];
$end_estado = 'CE';
$end_bairro = $_POST["bairroResp"];
$end_logradouro = $_POST["logradouroResp"];
$end_numero = $_POST["numeroResp"];
$end_complemento = $_POST["complementoResp"];

// Quantidade de alunos
$qntd_aluno = $_POST["aluno-qntd"];

$today = date('Y-m-d H:i:s');


$qL = mysqli_query($bd, "SELECT * from a_solicitantes_e INNER JOIN a_solicitacoes_e ON a_solicitantes_e.id = a_solicitacoes_e.id_solicitante WHERE 
cpf = '" . $cpf . "' AND  ( situacao_beneficio = '0' OR situacao_alimentacao = '0' OR situacao_alimentacao = '0' ) LIMIT 0,1");

$rsL = mysqli_fetch_assoc($qL);
if ($rsL != NULL) {
    // CPF responsavel ja cadastrado
} else {

    $qL2 = mysqli_query($bd, "INSERT INTO `a_solicitantes_e`(`solicitante_nome`, `cpf`, `rg`, `data_nascimento`, `telefone_celular`, `end_cep`, `end_cidade`, 
    `end_estado`, `end_bairro`, `end_logradouro`, `end_numero`, `end_complemento`,`status`) VALUES ('" . $solicitante_nome . "','" . $cpf . "','" . $rg . "','" . $data_nascimento . "','" . $telefone_celular . "','" . $end_cep . "','" . $end_cidade . "','" . $end_estado . "','" . $end_bairro . "'
    ,'" . $end_logradouro . "','" . $end_numero . "','" . $end_complemento . "','A')");

    $qL3 = mysqli_query($bd, "SELECT * from a_solicitantes_e where cpf = '" . $cpf . "' ORDER BY id DESC LIMIT 0,1");
    $solicitante = mysqli_fetch_assoc($qL3);

    for ($i=1; $i <= $qntd_aluno; $i++) {
        $qL4 = mysqli_query($bd, "INSERT INTO `a_solicitacoes_e`(`id_solicitante`, `data_solicitada`, `status_beneficio`, `status_alimentacao`, `status_tablet`,
        `aluno_nome`, `aluno_cpf`, `aluno_nascimento`, `aluno_escola`, `aluno_serie`, `aluno_matricula`, `status`,`situacao_beneficio`,`situacao_alimentacao`,`situacao_tablet`) 
        VALUES ('" . $solicitante['id'] . "','" . $today . "','0','" . $_POST['check-alim'] . "','" . $_POST['check-tablet'] . "','" . $_POST['nomeAluno-'.$i] . "','" . $_POST['cpfAluno-'.$i] . "','" . $_POST['dataNascAluno-'.$i] . "','" . $_POST['escolaAlunoId-'.$i] . "','" . $_POST['serieAluno-'.$i] . "','" . $_POST['idAluno-'.$i] . "','A','0','0','0')");

        $qL5 = mysqli_query($bd, "INSERT INTO `a_logs_e`(`titulo`, `descricao`, `data`, `id_solicitante`, `situacao`) 
        VALUES ('" . $_POST['idAluno-'.$i] . "','','" . $today . "','" . $solicitante['id'] . "','Em an&aacute;lise')");
    }

    redirect("../sucesso.php?sm=1");

}

mysqli_close($bd);
