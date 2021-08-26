<!DOCTYPE html>
<html lang="pt-br">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SIA3</title>
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
            <div class="col-12"><h4 class="text-warning">Listagem - Hitórico registros</h4><hr/></div>
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
                                <th>COD</th>
                                <th>Setor</th>
                                <th>Ação</th>
                                <th>Data</th>
                              </tr>
                            </thead>
                            <tbody align="center">    
                              <tr>
                                <td>1</td>
                                <td>Novas Contratações</td>
                                <td>Upload</td>
                                <td>15/10/2019</td>
                              </tr>
                              <tr>
                                <td>2</td>
                                <td>Novas Contratações</td>
                                <td>Upload</td>
                                <td>16/10/2019</td>
                              </tr>
                              <tr>
                                <td>3</td>
                                <td>Novas Contratações</td>
                                <td>Upload</td>
                                <td>17/10/2019</td>
                              </tr>
                              <tr>
                                <td>4</td>
                                <td>Base Ativa</td>
                                <td>Upload</td>
                                <td>25/10/2019</td>
                              </tr>
                              <tr>
                                <td>5</td>
                                <td>Advogado Agressor</td>
                                <td>Análise</td>
                                <td>25/10/2019</td>
                              </tr>

                              <tr>
                                <td>6</td>
                                <td>Advogado Agressor</td>
                                <td>Análise</td>
                                <td>28/10/2019</td>
                              </tr>
                              <tr>
                                <td>7</td>
                               <td>Advogado Agressor</td>
                                <td>Análise</td>
                                <td>28/10/2019</td>
                              </tr>
                              <tr>
                                <td>8</td>
                                <td>Novas Contratações</td>
                                <td>Upload</td>
                                <td>28/10/2019</td>
                              </tr>
                              <tr>
                                <td>9</td>
                                <td>Novas Contratações</td>
                                <td>Upload</td>
                                <td>28/10/2019</td>
                              </tr>
                              <tr>
                                <td>10</td>
                                <td>Advogado Agressor</td>
                                <td>Análise</td>
                                <td>28/10/2019</td>
                              </tr>

                              <tr>
                                <td>11</td>
                                <td>Novas Contratações</td>
                                <td>Upload</td>
                                <td>28/10/2019</td>
                              </tr>
                              <tr>
                                <td>12</td>
                                <td>Advogado Agressor</td>
                                <td>Análise</td>
                                <td>28/10/2019</td>
                              </tr>
                              <tr>
                                <td>13</td>
                                <td>Novas Contratações</td>
                                <td>Upload</td>
                                <td>29/10/2019</td>
                              </tr>


                            </tbody>
                          </table>

                          <hr/>

                          

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