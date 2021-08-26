<?php include "../conn/remoto/functions.php";

header('Content-Type: application/json');

$bd = abreConn();

$data = json_decode(file_get_contents('php://input'), true);

if ($data == null) {
    $arr = array(
        "success" => false,
        "error" => "Conteúdo da requisição inexistente"
    );
    print json_encode($arr);
    return;
}

$solicitante_nome = $data["name"];
$cpf = $data["cpf"];
$rg = $data["rg"];
$data_nascimento = $data["birthDate"];
$telefone_celular = $data["phone"];
$end_cep = $data["cep"];
$end_cidade = $data["city"];
$end_estado = $data["state"];
$end_bairro = $data["neighborhood"];
$end_logradouro = $data["street"];
$end_numero = $data["number"];
$end_complemento = $data["complement"];
$today = date('Y-m-d H:i:s');


$qL = mysqli_query($bd, "SELECT * from a_solicitantes_e INNER JOIN a_solicitacoes_e ON a_solicitantes_e.id = a_solicitacoes_e.id_solicitante WHERE 
cpf = '" . $cpf . "' AND  ( situacao_beneficio = '0' OR situacao_alimentacao = '0' OR situacao_alimentacao = '0' ) LIMIT 0,1");

$rsL = mysqli_fetch_assoc($qL);
if ($rsL != NULL) {
    $arr = array(
        "success" => false,
        "error" => "cpf em uso"
    );

    print json_encode($arr);
} else {

    $qL2 = mysqli_query($bd, "INSERT INTO `a_solicitantes_e`(`solicitante_nome`, `cpf`, `rg`, `data_nascimento`, `telefone_celular`, `end_cep`, `end_cidade`, 
    `end_estado`, `end_bairro`, `end_logradouro`, `end_numero`, `end_complemento`,`status`) VALUES ('" . $solicitante_nome . "','" . $cpf . "','" . $rg . "','" . $data_nascimento . "','" . $telefone_celular . "','" . $end_cep . "','" . $end_cidade . "','" . $end_estado . "','" . $end_bairro . "'
    ,'" . $end_logradouro . "','" . $end_numero . "','" . $end_complemento . "','A')");

    $qL3 = mysqli_query($bd, "SELECT * from a_solicitantes_e where cpf = '" . $cpf . "' ORDER BY id DESC LIMIT 0,1");
    $solicitante = mysqli_fetch_assoc($qL3);


    foreach ($data["students"] as &$value) {
        $qL4 = mysqli_query($bd, "INSERT INTO `a_solicitacoes_e`(`id_solicitante`, `data_solicitada`, `status_beneficio`, `status_alimentacao`, `status_tablet`,
        `aluno_nome`, `aluno_cpf`, `aluno_nascimento`, `aluno_escola`, `aluno_serie`, `aluno_matricula`, `status`,`situacao_beneficio`,`situacao_alimentacao`,`situacao_tablet`) 
        VALUES ('" . $solicitante['id'] . "','" . $today . "','" . $data['assist'] . "','" . $data['basket'] . "','" . $data['tablet'] . "','" . $value['name'] . "','" . $value['cpf'] . "','" . $value['birthDate'] . "','" . $value['escola'] . "','" . $value['serie'] . "','" . $value['matricula'] . "','A','0','0','0')");

        $qL5 = mysqli_query($bd, "INSERT INTO `a_logs_e`(`titulo`, `descricao`, `data`, `id_solicitante`, `situacao`) 
        VALUES ('" . $value['matricula'] . "','','" . $today . "','" . $solicitante['id'] . "','Em análise')");
    }

    $arr = array(
        "success" => true
    );

    print json_encode($arr);
}

mysqli_close($bd);
