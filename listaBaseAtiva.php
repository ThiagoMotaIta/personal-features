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
            <div class="col-12"><h4 class="text-warning">Relatórios - Base Ativa</h4><hr/></div>
          </div>  

          <div class="row">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">

                      <h4 class="card-title">Análise</h4><hr/>

                      <div id="divBaseAComparar" style="margin: 0 auto; padding: 25px 0 0; position: relative; text-align: center; text-shadow: 0 1px 0 #fff; display: block;">

                        <div class="form-group" align="center">
                          
                          <table class="table table-sm table-striped" id="listaPareada">
                            <thead class="thead-light" align="center">
                              <tr>
                                <th>ID</th>
                                <th>CD/Pasta</th>
                                <th>Carteira</th>
                                <th>Órgão</th>
                                <th>UF</th>
                                <th>Assunto/causa</th>
                                <th>Estratégia</th>
                              </tr>
                            </thead>
                            <tbody align="center">
                              <?php

                              function tirarAcentosMelhorada($string){
                                  return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/", "/(ç)/", "/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$string);
                              }

                              $agressorStyle;
                              
                              $q=  mysqli_query($bd, "SELECT * FROM base_ativa where status = 'A' limit 0,1000 ");

                              $num_rows = mysqli_num_rows($q);

                              while ($rs = mysqli_fetch_array($q)){

                              ?>    
                              <tr>
                                <td><?=$rs['id']?></td>
                                <td><?=$rs['pasta']?></td>
                                <td><?=tirarAcentosMelhorada($rs['carteira'])?></td>
                                <td><?=tirarAcentosMelhorada($rs['orgao'])?></td>
                                <td><?=$rs['uf']?></td>
                                <td><?=tirarAcentosMelhorada($rs['assunto_causa'])?></td>
                                <td><?=tirarAcentosMelhorada($rs['estrategia'])?></td>
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
    });
  </script>
</body>

</html>