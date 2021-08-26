<?php
 include "../conn/functions.php";
 header("Content-type: application/vnd.ms-excel");
 header("Content-type: application/force-download");
 header("Content-Disposition: attachment; filename=relatorio-app-beneficio-caucaia-ta-on.xls");
 header("Pragma: no-cache");
?>

<meta charset='utf-8'>

<table class="table table-striped">
    <thead class="table">
      <tr>
        <th scope="col"><strong>CPF RESPONSÁVEL</strong></th>
        <th scope="col"><strong>ID. ALUNO</strong></th>
        <th scope="col"><strong>ALUNO</strong></th>
        <th scope="col"><strong>INEP</strong></th>
        <th scope="col"><strong>SÉRIE</strong></th>
        <th scope="col"><strong>ESCOLA</strong></th>
        <th scope="col"><strong>REGIÃO</strong></th>
        <th scope="col"><strong>NASCIMENTO</strong></th>
        <th scope="col"><strong>CPF</strong></th>
        <th scope="col"><strong>SOLICITAÇÃO</strong></th>
      </tr>
    </thead>
    <tbody>
    <?php 

    $bd = abreConn(); 

    // Lista solicitacoes
    $qSol=  mysqli_query($bd, "SELECT * FROM a_solicitacoes_e where status = 'A' order by id desc ");
    while ($rsSol = mysqli_fetch_array($qSol)){

        // Dados do Solicitante
        $qS1 = mysqli_query($bd, "SELECT * from a_solicitantes_e where id = '".$rsSol['id_solicitante']."' and status = 'A' ");
        $rsS1 = mysqli_fetch_assoc($qS1);

        // Dados da Escola
        $qE = mysqli_query($bd, "SELECT * from a_escolas_e where inep = '".$rsSol['aluno_escola']."' and status = 'A' ");
        $rsE = mysqli_fetch_assoc($qE);

        if ($rsE == NULL){
            $escola = '--';
            $inep = '--';
            $regiao = '--';
        } else {
            $escola = $rsE['escola'].' - '.$rsE['condicao'];
            $inep = $rsE['inep'];
            $regiao = $rsE['regiao'];
        }

        $serie = $rsSol['aluno_serie'];

        if ($rsSol['aluno_serie'] == 0){
            $serie = '--';
        }

        if ($rsSol['aluno_serie'] == 21){
            $serie = 'EJA I (1 ao 3 ano)';
        }
        if ($rsSol['aluno_serie'] == 22){
            $serie = 'EJA II (4 e 5 ano)';
        }
        if ($rsSol['aluno_serie'] == 23){
            $serie = 'EJA III (6 e 7 ano)';
        }
        if ($rsSol['aluno_serie'] == 24){
            $serie = 'EJA IV (8 e 9 ano)';
        }

        // Situacao Beneficio
        if ($rsSol['situacao_beneficio'] == 0){
            $sitBen = "EM ANÁLISE";
        }
        if ($rsSol['situacao_beneficio'] == 1){
            $sitBen = "<strong class='text-primary'>APROVADO</strong>";
        }
        if ($rsSol['situacao_beneficio'] == 2){
            $sitBen = "<strong class='text-warning'>NEGADO</strong>";
        }

        // Situacao Aliemntacao
        if ($rsSol['situacao_alimentacao'] == 0){
            $sitAli = "EM ANÁLISE";
        }
        if ($rsSol['situacao_alimentacao'] == 1){
            $sitAli = "<strong class='text-primary'>APROVADO</strong>";
        }
        if ($rsSol['situacao_alimentacao'] == 2){
            $sitAli = "<strong class='text-warning'>NEGADO</strong>";
        }

        // Situacao Tablet
        if ($rsSol['situacao_tablet'] == 0){
            $sitTab = "EM ANÁLISE";
        }
        if ($rsSol['situacao_tablet'] == 1){
            $sitTab = "<strong style='color:#0d6efd;'>APROVADO</strong>";
        }
        if ($rsSol['situacao_tablet'] == 2){
            $sitTab = "<strong style='color:#dc3545;'>NEGADO</strong>";
        }
        if ($rsSol['situacao_tablet'] == 3){
            $sitTab = "<strong style='color:#87CB16;'>ENTREGUE</strong>";
        }

        
        if ($rsSol['status_beneficio'] == 0){
            $sitBen = "<span class='text-secondary'>NÃO SOLICITADO</span>";
        }

        if ($rsSol['status_alimentacao'] == 0){
            $sitAli = "<span class='text-secondary'>NÃO SOLICITADO</span>";
        }

        if ($rsSol['status_tablet'] == 0){
            $sitTab = "<span class='text-secondary'>NÃO SOLICITADO</span>";
        }
    ?>

    <tr>
        <td align="center"><small><?=$rsS1['cpf']?></small></td>
        <td align="center"><small><?=$rsSol['aluno_matricula']?></small></td>
        <td><small><?=$rsSol['aluno_nome']?></small></td>
        <td align="center"><small><?=$inep?></small></td>
        <td align="center"><small><?=$serie?></small></td>
        <td><small><?=$escola?></small></td>
        <td align="center"><small><?=$regiao?></small></td>
        <td align="center"><small><?=$rsSol['aluno_nascimento']?></small></td>
        <td align="center"><small><?=$rsSol['aluno_cpf']?></small></td>
        <td align="center"><small><?=$sitTab?></small></td>
    </tr>

    <?php } 

    mysqli_close($bd);

    ?>
    </tbody>
</table>