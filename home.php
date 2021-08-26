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
    <?php include "topo.php"; ?>
    
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
                <p>Algum aviso aqui</p>
                <i class="mdi mdi-close ml-auto popup-dismiss d-none d-md-block"></i>
              </span>
            </div>
          </div>
          

          <div class="row">
            <div class="col-12"><h4 class="text-warning">Números - Últimas Análises</h4><hr/></div>
          </div>  

          <?php

          /*$q1 = mysqli_query($bd, "SELECT count(id) as totalAgressores from base_agressores where status = 'A' ");
          $l1 = mysqli_fetch_assoc($q1);

          $q2 = mysqli_query($bd, "SELECT count(id) as totalAnalise from base_comparada where status = 'A' ");
          $l2 = mysqli_fetch_assoc($q2);

          $q2_1 = mysqli_query($bd, "SELECT count(id) as totalSim from base_comparada where verificar_agressor = 'SIM' and status = 'A' ");
          $l2_1 = mysqli_fetch_assoc($q2_1);

          $q2_2 = mysqli_query($bd, "SELECT count(id) as totalNao from base_comparada where verificar_agressor = 'NAO' and status = 'A' ");
          $l2_2 = mysqli_fetch_assoc($q2_2);

          $percentualSim = (100*$l2_1['totalSim'])/$l2['totalAnalise'];
          $percentualNao = (100*$l2_2['totalNao'])/$l2['totalAnalise'];*/

          $q1 = mysqli_query($bd, "SELECT count(id) as totalBaseAtiva from base_ativa where status = 'A' ");
          $l1 = mysqli_fetch_assoc($q1);

          $qA = mysqli_query($bd, "SELECT count(id) as totalAcordo from base_ativa where estrategia LIKE '%ACORDO%' and status = 'A' ");
          $lA = mysqli_fetch_assoc($qA);

          $qD = mysqli_query($bd, "SELECT count(id) as totalDefesa from base_ativa where estrategia LIKE '%DEFESA%' and status = 'A' ");
          $lD = mysqli_fetch_assoc($qD);

          $percentualAcordo = (100*$lA['totalAcordo'])/$l1['totalBaseAtiva'];
          $percentualDefesa = (100*$lD['totalDefesa'])/$l1['totalBaseAtiva'];

          ?>

          <div class="row">
            <div class="content-wrapper">
              
              <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Estratégias - Base Ativa (15/10/2019)</h4><hr/>
                      <h1 class="text-primary"><?=$l1['totalBaseAtiva']?></h1>
                      <div class="text-success">Acordo: <strong><?=round($percentualAcordo, 2)?>%</strong></div>
                      <div class="alert alert-success" style="width: <?=round($percentualAcordo, 2)?>%; display: none;" id="card1"></div>
                      <div class="text-primary">Defesa: <strong><?=round($percentualDefesa, 2)?>%</strong></div>
                      <div class="alert alert-primary" style="width: <?=round($percentualDefesa, 2)?>%; display: none;" id="card2"></div>
                      <div class="text-warning">Não Definido: <strong>10.5%</strong></div>
                      <div class="alert alert-warning" style="width: 10.5%; display: none;" id="card3"></div>
                      <br/>
                      <br/>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Estratégias - Novas Contratações (HOJE)</h4><hr/>
                      <h1 class="text-primary">35</h1>
                      <div class="text-success">Acordo: <strong>0.00%</strong></div>
                      <div class="alert alert-success" style="width: 1px; display: none;" id="card4"></div>
                      <div class="text-primary">Defesa: <strong>33.33%</strong></div>
                      <div class="alert alert-primary" style="width: 33.33%; display: none;" id="card5"></div>
                      <div class="text-warning">Não Definido: <strong>66.66%</strong></div>
                      <div class="alert alert-warning" style="width: 66.66%; display: none;" id="card6"></div>
                      <br/>
                      <br/>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Advogados Agressores - Base Ativa (15/10/2019)</h4><hr/>
                      <h1 class="text-primary"><?=$l1['totalBaseAtiva']?></h1>
                      <div class="text-warning">Agressores: <strong>18.31%</strong></div>
                      <div class="alert alert-warning" style="width: 20%; display: none;" id="card7"></div>

                      <div class="text-primary">Não Agressores: <strong>81.69%</strong></div>
                      <div class="alert alert-primary" style="width: 80%; display: none;" id="card8"></div>
                      <br/>
                      <br/>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Advogados Agressores - Novas Contratações (HOJE)</h4><hr/>
                      <h1 class="text-primary">35</h1>
                      <div class="text-warning">Agressores: <strong>22.22%</strong></div>
                      <div class="alert alert-warning" style="width: 22.22%; display: none;" id="card9"></div>

                      <div class="text-primary">Não Agressores: <strong>77.78%</strong></div>
                      <div class="alert alert-primary" style="width: 77.78%; display: none;" id="card10"></div>
                      <br/>
                      <br/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
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
      $("#card1").show(500);
      $("#card2").show(500);
      $("#card3").show(500);
      $("#card4").show(500);
      $("#card5").show(500);
      $("#card6").show(500);
      $("#card7").show(500);
      $("#card8").show(500);
      $("#card9").show(500);
      $("#card10").show(500);
    });
  </script>
</body>

</html>