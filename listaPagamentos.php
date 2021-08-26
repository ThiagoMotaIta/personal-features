<!DOCTYPE html>
<html lang="pt-br">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SUIT</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="vendors/iconfonts/font-awesome/css/font-awesome.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?=$favicon?>" />
</head>

<body>
  <div class="container-scroller">
    
    <!-- partial:partials/_navbar.html ==== TOPO -->
    <?php include "topoPagamentos.php"; ?>
    
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      
      <!-- partial:partials/_sidebar.html ==== LATERAL -->
      <?php include "lateral.php"; ?>
     
      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
          <!-- AVISOS-->
          <div class="row purchace-popup" style="display: none;">
            <div class="col-12">
              <span class="d-block d-md-flex align-items-center">
                <p>Carregando...</p>
                <i class="mdi mdi-close ml-auto popup-dismiss d-none d-md-block"></i>
              </span>
            </div>
          </div>
          

          <div class="row">
            <div class="col-12"><h4 class="text-warning">Pagamentos</h4><hr/></div>
          </div>  

          <div class="row">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-lg-4 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">

                      <h4 class="card-title"><strong class="text-info">VERBA</strong> x <strong class="text-success">VALOR</strong> - TOTAIS <small>(2006 à <?=$ano?>)</small></h4><hr/>

                      <div id="divBaseAComparar" style="margin: 0 auto; padding: 25px 0 0; position: relative; text-align: center; text-shadow: 0 1px 0 #fff; display: block;">

                        <div class="form-group" align="center">
                         <small>
                          <?php  
                            $q1 = mysqli_query($bd, "SELECT SUM(valor) as valorVerbaHonorario FROM pagamentos where verba LIKE '%HONOR%' and status = 'A' ");
                            $l1 = mysqli_fetch_assoc($q1);
                          ?>
                          <div class="alert alert-success"><strong>HONORÁRIOS</strong>: R$ <?php echo number_format($l1['valorVerbaHonorario'],2,",",".");?></div>

                          <?php  
                            $q2 = mysqli_query($bd, "SELECT SUM(valor) as valorVerbaExito FROM pagamentos where verba LIKE '%EXITO%' and status = 'A' ");
                            $l2 = mysqli_fetch_assoc($q2);
                          ?>
                          <div class="alert alert-success"><strong>ÊXITO</strong>: R$ <?php echo number_format($l2['valorVerbaExito'],2,",",".");?></div>

                          <?php  
                            $q3 = mysqli_query($bd, "SELECT SUM(valor) as valorVerbaEncerramento FROM pagamentos where verba LIKE '%ENCERRAMENTO%' and status = 'A' ");
                            $l3 = mysqli_fetch_assoc($q3);
                          ?>
                          <div class="alert alert-success"><strong>ENCERRAMENTO</strong>: R$ <?php echo number_format($l3['valorVerbaEncerramento'],2,",",".");?></div>

                          <?php  
                            $q4 = mysqli_query($bd, "SELECT SUM(valor) as valorVerbaCopiasCadastro FROM pagamentos where verba = 'COPIAS CADASTRO' and status = 'A' ");
                            $l4 = mysqli_fetch_assoc($q4);
                          ?>
                          <div class="alert alert-warning"><strong>CÓPIAS CADASTRO</strong>: R$ <?php echo number_format($l4['valorVerbaCopiasCadastro'],2,",",".");?></div>

                          <?php  
                            $q5 = mysqli_query($bd, "SELECT SUM(valor) as valorVerbaEspecial FROM pagamentos where verba = 'ESPECIAL VALOR COMBINADO' and status = 'A' ");
                            $l5 = mysqli_fetch_assoc($q5);
                          ?>
                          <div class="alert alert-primary"><strong>ESPECIAL VALOR COMBINADO</strong>: R$ <?php echo number_format($l5['valorVerbaEspecial'],2,",",".");?></div>

                          <?php  
                            $q6 = mysqli_query($bd, "SELECT SUM(valor) as valorVerbaSentenca FROM pagamentos where verba LIKE '%SENTENCA%' and status = 'A' ");
                            $l6 = mysqli_fetch_assoc($q6);
                          ?>
                          <div class="alert alert-warning"><strong>SENTENÇA</strong>: R$ <?php echo number_format($l6['valorVerbaSentenca'],2,",",".");?></div>
                          </small>
                        </div>

                      </div>

                    </div>
                  </div>
                </div>

                <div class="col-lg-4 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">

                      <h4 class="card-title"><strong class="text-info">HORNORÁRIOS</strong> x <strong class="text-success">VALOR</strong> - ANO</h4><hr/>

                      <div id="divBaseAComparar" style="margin: 0 auto; padding: 25px 0 0; position: relative; text-align: center; text-shadow: 0 1px 0 #fff; display: block;">

                        <div class="form-group" align="center">
                          
                          <small>

                          <?php

                            for ($i = 2015; $i <= $ano; $i++) {

                              $qA = mysqli_query($bd, "SELECT SUM(valor) as valorVerbaHonorario FROM pagamentos where verba LIKE '%HONOR%' and '".$i."-01-01' <= data_pagamento and data_pagamento < '".$i."-12-31' and status = 'A' ");
                              $lA = mysqli_fetch_assoc($qA);

                            ?>
                              <div class="alert alert-success"><strong>HONORÁRIOS <?=$i?></strong>: R$ <?php echo number_format($lA['valorVerbaHonorario'],2,",",".");?></div>
                            
                          <?php } ?>
                        

                          </small>

                        </div>

                      </div>

                    </div>
                  </div>
                </div>

                <div class="col-lg-4 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">

                      <h4 class="card-title"><strong class="text-info">HONORÁRIOS</strong> x <strong class="text-success">VALOR</strong> - MÊS / <?=$ano?></h4><hr/>

                      <div id="divBaseAComparar" style="margin: 0 auto; padding: 25px 0 0; position: relative; text-align: center; text-shadow: 0 1px 0 #fff; display: block;">

                        <div class="form-group" align="center">
                          
                          <small>

                          <?php

                            $mesExt;

                            $dadosMes = array();

                            for ($i = 1; $i <= $mes; $i++) {

                              if ($i < 9){
                                $qA = mysqli_query($bd, "SELECT SUM(valor) as valorVerbaHonorario FROM pagamentos where verba LIKE '%HONOR%' and '".$ano."-0".$i."-01' <= data_pagamento and data_pagamento < '".$ano."-0".$i."-31' and status = 'A' ");
                                $lA = mysqli_fetch_assoc($qA);
                              } else {
                                $qA = mysqli_query($bd, "SELECT SUM(valor) as valorVerbaHonorario FROM pagamentos where verba LIKE '%HONOR%' and '".$ano."-".$i."-01' <= data_pagamento and data_pagamento < '".$ano."-".$i."-31' and status = 'A' ");
                                $lA = mysqli_fetch_assoc($qA);
                              }

                              if($i == '1'){
                                $mesExt = "Janeiro";
                              }
                              if($i == '2'){
                                $mesExt = "Fevereiro";
                              }
                              if($i == '3'){
                                $mesExt = "Março";
                              }
                              if($i == '4'){
                                $mesExt = "Abril";
                              }
                              if($i == '5'){
                                $mesExt = "Maio";
                              }
                              if($i == '6'){
                                $mesExt = "Junho";
                              }

                              if($i == '7'){
                                $mesExt = "Julho";
                              }
                              if($i == '8'){
                                $mesExt = "Agosto";
                              }
                              if($i == '9'){
                                $mesExt = "Setembro";
                              }
                              if($i == '10'){
                                $mesExt = "Outubro";
                              }
                              if($i == '11'){
                                $mesExt = "Novembro";
                              }
                              if($i == '12'){
                                $mesExt = "Dezembro";
                              }

                              array_push($dadosMes, $mesExt, $lA['valorVerbaHonorario']);

                            ?>
                              <div class="alert alert-success"><strong>HONORÁRIOS <?=$mesExt?></strong>: R$ <?php echo number_format($lA['valorVerbaHonorario'],2,",",".");?></div>
                            
                          <?php } ?>

                          <?php //print_r($dadosMes); ?>
                        
                          </small>

                        </div>

                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <?php  
            $qT = mysqli_query($bd, "SELECT * FROM pagamentos where status = 'A' ");
            $num_rows_t = mysqli_num_rows($qT);
          ?>


          <div class="row">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">

                      <h4 class="card-title">Gráfico - Honorários / Mês</h4><hr/>

                      <div id="divBaseAComparar" style="height: 50%;">

                        <div class="form-group" align="center">

                          <canvas id="barChart"></canvas>

                        </div>

                      </div>

                    </div>
                  </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">

                      <h4 class="card-title">Gráfico - Verbas</h4><hr/>

                      <div id="divBaseAComparar" style="height: 50%;">

                        <div class="form-group" align="center">

                          <canvas id="doughnutChart"></canvas>

                        </div>

                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>


          <div class="row">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">

                      <h4 class="card-title">Capturas (<?=$num_rows_t?>)</h4><hr/>

                      <div id="divBaseAComparar" style="margin: 0 auto; padding: 25px 0 0; position: relative; text-align: center; text-shadow: 0 1px 0 #fff; display: block;">

                        <div class="form-group" align="center">
                          
                          <table class="table table-sm table-striped" id="listaPareada">
                            <thead class="thead-light" align="center">
                              <tr>
                                <th>ID</th>
                                <th>CDPASTA</th>
                                <th>Verba</th>
                                <th>Valor</th>
                                <th>Data</th>
                                <th>Status</th>
                              </tr>
                            </thead>
                            <tbody align="center">
                              <?php

                              $agressorStyle;
                              
                              $q=  mysqli_query($bd, "SELECT * FROM pagamentos where status = 'A' limit 0,1000 ");

                              $num_rows = mysqli_num_rows($q);

                              while ($rs = mysqli_fetch_array($q)){

                               $valor = number_format($rs['valor'],2,",","."); 

                              ?>    
                                <tr>
                                  <td><?=$rs['id']?></td>
                                  <td><?=$rs['pasta']?></td>
                                  <td><?=tirarAcentos($rs['verba'])?></td>
                                  <td>R$ <?=$valor?></td>
                                  <td><?php echo date("d/m/Y",strtotime($rs['data_pagamento'])); ?></td>
                                  <td><?=$rs['status_pagamento']?></td>
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>

                          <hr/>

                          <?php if ($num_rows > 0){ ?>
                            <a href="excel/base_ativa_reduzida.xlsx" class="btn btn-warning"><i class="fa fa-file-excel-o"></i> Exportar Planilha</a>
                          <?php } else { ?>
                            <a href="home.php" class="btn btn-warning">Importar Planilha para Análise</a>
                          <?php } ?>

                        </div>

                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

        <?php

          $mes1;
          $mes2;
          $mes3;

          if ($mes > 0 && $mes < 4){
            $mes1 = "01";
            $mes2 = "02";
            $mes3 = "03";
          }

          if ($mes > 3 && $mes < 7){
            $mes1 = "04";
            $mes2 = "05";
            $mes3 = "06";
          }

          if ($mes > 6 && $mes < 10){
            $mes1 = "07";
            $mes2 = "08";
            $mes3 = "09";
          }

          if ($mes > 9 && $mes < 13){
            $mes1 = "10";
            $mes2 = "11";
            $mes3 = "12";
          }

          $qM1 = mysqli_query($bd, "SELECT SUM(valor) as valorVerbaHonorarioM1 FROM pagamentos where verba LIKE '%HONOR%' and '".$ano."-".$mes1."-01' <= data_pagamento and data_pagamento < '".$ano."-".$mes1."-31' and status = 'A' ");
          $lM1 = mysqli_fetch_assoc($qM1);

          $qM2 = mysqli_query($bd, "SELECT SUM(valor) as valorVerbaHonorarioM2 FROM pagamentos where verba LIKE '%HONOR%' and '".$ano."-".$mes2."-01' <= data_pagamento and data_pagamento < '".$ano."-".$mes2."-31' and status = 'A' ");
          $lM2 = mysqli_fetch_assoc($qM2);

          $qM3 = mysqli_query($bd, "SELECT SUM(valor) as valorVerbaHonorarioM3 FROM pagamentos where verba LIKE '%HONOR%' and '".$ano."-".$mes3."-01' <= data_pagamento and data_pagamento < '".$ano."-".$mes3."-31' and status = 'A' ");
          $lM3 = mysqli_fetch_assoc($qM3);

          

        ?>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include "rodape.php"; ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->


  <script src="js/app.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $("#listaPareada").DataTable();
      $("#carregandoPagina").html("<h4>SISTEMAS UNIFICADOS E INTELIGENTES - SUIT</h4>Hoje: <?=$dataAgora?>");

      /* ChartJS
       * -------
       * Data and config for chartjs
       */
      'use strict';
      var data = {
        /*labels: ["Janeiro", "Fevereiro", "Marco", "Abril", "Maio", "Junho"],*/
        labels: ["<?=$mes1?>/<?=$ano?>", "<?=$mes2?>/<?=$ano?>", "<?=$mes3?>/<?=$ano?>"],
        datasets: [{
          label: 'Total',
          data: ["<?=$lM1['valorVerbaHonorarioM1']?>", "<?=$lM2['valorVerbaHonorarioM2']?>", "<?=$lM3['valorVerbaHonorarioM3']?>"],
          backgroundColor: [
            'rgba(204, 245, 225, 1)',
            'rgba(204, 245, 225, 1)',
            'rgba(204, 245, 225, 1)' 
          ],
          borderColor: [
            'rgb(184, 241, 213)',
            'rgb(184, 241, 213)',
            'rgb(184, 241, 213)'
          ],
          borderWidth: 1
        }]
      };
      
      var options = {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        },
        legend: {
          display: false
        },
        elements: {
          point: {
            radius: 0
          }
        }

      };

      var doughnutPieData = {
      datasets: [{
        data: [<?=$l2['valorVerbaExito']?>, <?=$l3['valorVerbaEncerramento']?>, <?=$l6['valorVerbaSentenca']?>, <?=$l1['valorVerbaHonorario']?>],
        backgroundColor: [
          'rgba(231, 224, 249, 1)',
          'rgba(214, 232, 249, 1)',
          'rgba(255, 239, 204, 1)',
          'rgba(204, 245, 225, 1)'
        ],
        borderColor: [
          'rgba(222, 211, 246, 1)',
          'rgba(197, 223, 246, 1)',
          'rgba(255, 233, 184, 1)',
          'rgba(184, 241, 213, 1)'
        ],
      }],

      // These labels appear in the legend and in the tooltips when hovering different arcs
      labels: [
        'Exito',
        'Encerramento',
        'Sentenca',
        'Honorarios'
      ]
    };
    var doughnutPieOptions = {
      responsive: true,
      animation: {
        animateScale: true,
        animateRotate: true
      }
    };
      

      // Get context with jQuery - using jQuery's .get() method.
      if ($("#barChart").length) {
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var barChart = new Chart(barChartCanvas, {
          type: 'bar',
          data: data,
          options: options
        });
      }

      if ($("#doughnutChart").length) {
      var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
      var doughnutChart = new Chart(doughnutChartCanvas, {
        type: 'doughnut',
        data: doughnutPieData,
        options: doughnutPieOptions
      });
    }

    });
  </script>
</body>

</html>