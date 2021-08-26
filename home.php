<?php include "conn/functions.php";?>
<!DOCTYPE html>

<html lang="en">

<?php include "view/head.php" ?>

<body>
    <div class="wrapper">
        
        <?php include "view/side-menu.php" ?>

        <div class="main-panel">
            
            <?php include "view/top-menu.php" ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title">Solicitações (<small class="totalSol-div">Carregando...</small>)</h4>
                                    <p class="card-category">Tablet e Alimenentação</p>
                                </div>
                                <div class="card-body ">
                                    <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Aprovada
                                        <i class="fa fa-circle text-danger"></i> Reprovada
                                        <i class="fa fa-circle text-warning"></i> Análise
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Atualizado há 2 horas
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title">Solicitações (<small class="totalSol-div">Carregando...</small>)</h4>
                                    <p class="card-category">Últimos x Dia</p>
                                </div>
                                <div class="card-body ">
                                    <div id="chartActivity" class="ct-chart"></div>
                                </div>
                                <div class="card-footer ">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Tablet
                                        <i class="fa fa-circle text-danger"></i> Alimentação
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-check"></i> Atualizado há 2 horas
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include "view/footer.php" ?>

        </div>
    </div>
</body>


<?php // DADOS PARA OS GRÁFICOS 

$bd = abreConn();

// GRAFICO TORTA =================

// Quantidade de Solicitações
$qTs = mysqli_query($bd, "SELECT count(id) as totalSol from a_solicitacoes_e where status = 'A'");
$rsTs = mysqli_fetch_assoc($qTs);

// Quantidade de Solicitações Analises
$qTsAn = mysqli_query($bd, "SELECT count(id) as totalSolAn from a_solicitacoes_e where situacao_tablet = '0' and status = 'A'");
$rsTsAn = mysqli_fetch_assoc($qTsAn);

// Quantidade de Solicitações Aprovadas
$qTsAp = mysqli_query($bd, "SELECT count(id) as totalSolAp from a_solicitacoes_e where situacao_tablet = '1' and status = 'A'");
$rsTsAp = mysqli_fetch_assoc($qTsAp);

// Quantidade de Solicitações Reprovadas
$qTsRp = mysqli_query($bd, "SELECT count(id) as totalSolRp from a_solicitacoes_e where situacao_tablet = '2' and status = 'A'");
$rsTsRp = mysqli_fetch_assoc($qTsRp);

// Percentuais
$totalSol = $rsTs['totalSol'];

if ($rsTs['totalSol'] > 0){

    $percentSolAn = ($rsTsAn['totalSolAn']*100)/$totalSol;
    $percentSolAp = ($rsTsAp['totalSolAp']*100)/$totalSol;
    $percentSolRp = ($rsTsRp['totalSolRp']*100)/$totalSol;

    $percentSolAn = round($percentSolAn,1);
    $percentSolAp = round($percentSolAp,1);
    $percentSolRp = round($percentSolRp,1);

}

// GRAFICO BARRAS ==================

$anoAtual = date('Y');
$mesAtual = date('m');

if ($mesAtual == '01' || $mesAtual == '02' || $mesAtual == '03' || $mesAtual == '04'){
    $mes1 = '01';
    $mes2 = '02';
    $mes3 = '03';
    $mes4 = '04';
}

if ($mesAtual == '05' || $mesAtual == '06' || $mesAtual == '07' || $mesAtual == '08'){
    $mes1 = '05';
    $mes2 = '06';
    $mes3 = '07';
    $mes4 = '08';
}

if ($mesAtual == '09' || $mesAtual == '10' || $mesAtual == '11' || $mesAtual == '12'){
    $mes1 = '09';
    $mes2 = '10';
    $mes3 = '11';
    $mes4 = '12';
}

// Quantas SOL para Tablets - MES 1
$qSt1 = mysqli_query($bd, "SELECT count(id) as totalSolTab from a_solicitacoes_e where status_tablet = '1' and status = 'A' and data_solicitada LIKE '%".$anoAtual."-".$mes1."%' ");
$rsSt1 = mysqli_fetch_assoc($qSt1);

// Quantas SOL para Tablets - MES 2
$qSt2 = mysqli_query($bd, "SELECT count(id) as totalSolTab from a_solicitacoes_e where status_tablet = '1' and status = 'A' and data_solicitada LIKE '%".$anoAtual."-".$mes2."%' ");
$rsSt2 = mysqli_fetch_assoc($qSt2);

// Quantas SOL para Tablets - MES 3
$qSt3 = mysqli_query($bd, "SELECT count(id) as totalSolTab from a_solicitacoes_e where status_tablet = '1' and status = 'A' and data_solicitada LIKE '%".$anoAtual."-".$mes3."%' ");
$rsSt3 = mysqli_fetch_assoc($qSt3);

// Quantas SOL para Tablets - MES 4
$qSt4 = mysqli_query($bd, "SELECT count(id) as totalSolTab from a_solicitacoes_e where status_tablet = '1' and status = 'A' and data_solicitada LIKE '%".$anoAtual."-".$mes4."%' ");
$rsSt4 = mysqli_fetch_assoc($qSt4);

// Quantas SOL para Alimentacao - MES 1
$qSa1 = mysqli_query($bd, "SELECT count(id) as totalSolAli from a_solicitacoes_e where status_alimentacao = '1' and status = 'A' and data_solicitada LIKE '%".$anoAtual."-".$mes1."%' ");
$rsSa1 = mysqli_fetch_assoc($qSa1);

// Quantas SOL para Alimentacao - MES 2
$qSa2 = mysqli_query($bd, "SELECT count(id) as totalSolAli from a_solicitacoes_e where status_alimentacao = '1' and status = 'A' and data_solicitada LIKE '%".$anoAtual."-".$mes2."%' ");
$rsSa2 = mysqli_fetch_assoc($qSa2);

// Quantas SOL para Alimentacao - MES 3
$qSa3 = mysqli_query($bd, "SELECT count(id) as totalSolAli from a_solicitacoes_e where status_alimentacao = '1' and status = 'A' and data_solicitada LIKE '%".$anoAtual."-".$mes3."%' ");
$rsSa3 = mysqli_fetch_assoc($qSa3);

// Quantas SOL para Alimentacao - MES 4
$qSa4 = mysqli_query($bd, "SELECT count(id) as totalSolAli from a_solicitacoes_e where status_alimentacao = '1' and status = 'A' and data_solicitada LIKE '%".$anoAtual."-".$mes4."%' ");
$rsSa4 = mysqli_fetch_assoc($qSa4);

// Fecha conexao
mysqli_close($bd);

?>


<?php include "view/sector-js.php" ?>

<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        //demo.initDashboardPageCharts();

        //demo.showNotification();

        $(".totalSol-div").html(<?=$rsTs['totalSol']?>);

        $("#menuDash").removeAttr("class");
        $("#menuDash").attr("class", "nav-item active");



        var dataPreferences = {
            series: [
                [25, 30, 20, 25]
            ]
        };

        var optionsPreferences = {
            donut: true,
            donutWidth: 40,
            startAngle: 0,
            total: 100,
            showLabel: false,
            axisX: {
                showGrid: false
            }
        };

        Chartist.Pie('#chartPreferences', dataPreferences, optionsPreferences);

        Chartist.Pie('#chartPreferences', {
            labels: ['<?=$percentSolAp?>%', '<?=$percentSolRp?>%', '<?=$percentSolAn?>%'],
            series: [<?=$percentSolAp?>, <?=$percentSolRp?>, <?=$percentSolAn?>]
        });

        // lbd.startAnimationForLineChart(chartHours);

        var data = {
            labels: ['<?=$mes1?>/<?=$anoAtual?>', '<?=$mes2?>/<?=$anoAtual?>', '<?=$mes3?>/<?=$anoAtual?>', '<?=$mes4?>/<?=$anoAtual?>'],
            series: [
                [<?=$rsSt1['totalSolTab']?>, <?=$rsSt2['totalSolTab']?>, <?=$rsSt3['totalSolTab']?>, <?=$rsSt4['totalSolTab']?>],
                [<?=$rsSa1['totalSolAli']?>, <?=$rsSa2['totalSolAli']?>, <?=$rsSa3['totalSolAli']?>, <?=$rsSa4['totalSolAli']?>]
            ]
        };

        var options = {
            seriesBarDistance: 10,
            axisX: {
                showGrid: false
            },
            height: "245px"
        };

        var responsiveOptions = [
            ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function(value) {
                        return value[0];
                    }
                }
            }]
        ];

        var chartActivity = Chartist.Bar('#chartActivity', data, options, responsiveOptions);

    });
</script>

</html>
