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
            <div class="col-12"><h4 class="text-warning">Relatórios - Novas Contratações</h4><hr/></div>
          </div>  

          <div class="row">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">

                      <h4 class="card-title">Novas Contratações </h4><hr/>

                      <div id="divBaseAComparar" style="margin: 0 auto; padding: 25px 0 0; position: relative; text-align: center; text-shadow: 0 1px 0 #fff; display: block;">

                        <div class="form-group" align="center">
                          
                          <table class="table table-sm table-striped" id="listaAgressores">
                            <thead class="thead-light" align="center">
                              <tr>
                                <th>Código</th>
                                <th>Pastas / BJs importados</th>
                                <th>Data Importação</th>
                                <th>Download</th>
                              </tr>
                            </thead>
                            <tbody align="center">
                              <?php

                              $agressorStyle;
                              
                              $q=  mysqli_query($bd, "SELECT * FROM base_novas_contr where status = 'A' group by hash_cod limit 0,1000 ");

                              $num_rows = mysqli_num_rows($q);

                              while ($rs = mysqli_fetch_array($q)){

                              // Verifica se Download ja ta pronto
                              $qH = mysqli_query($bd, "SELECT * FROM base_novas_contr where hash_cod = '".$rs['hash_cod']."' and status = 'A' order by id desc limit 0,1");
                              $rsH = mysqli_fetch_assoc($qH);  

                              ?>    
                                <tr>
                                  <td><?=$rs['id']?></td>
                                  <td><button class="btn btn-warning" onclick="listarPastaViaHashCod('<?=$rs['hash_cod']?>', '<?=$rs['data_importacao']?>', '<?=$rs['nome_arquivo']?>')">Visualizar</button></td>
                                  <td><?php echo date("d/m/Y",strtotime($rs['data_importacao'])); ?></td>
                                  <td>
                                    <?php if($rsH['download'] == 1){ ?>
                                      <a href="retornos/<?=$rs['hash_cod']?>.xlsx" class="btn btn-sm btn-success"><i class="fa fa-download"></i></a>
                                    <?php } else { ?>
                                      <button class="btn btn-sm btn-default" disabled="disabled"><i class="fa fa-download"></i></button>
                                    <?php } ?>  
                                  </td>
                                </tr>
                              <?php } ?>
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


  <!-- Modal -->
  <div class="modal fade" id="modalPastasBuHashCod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header alert-warning">
          <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-list"></i> Lista de Pastas / BJ</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body" align="justify" style="height: 300px; overflow: auto;">
          
          <span id="listaPastasViaHashCodData"></span><hr/>
          <span id="listaPastasViaHashCod"></span>
         
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal" aria-label="Close"><i class="fa fa-check"></i> Entendido</button>
        </div>
      </div>
    </div>
  </div>


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
        $('#listaAgressores').DataTable( {
            "order": [[ 0, "desc" ]]
        } );
        //setTimeout(function(){ window.location.href = "listaNovasContr.php"; }, 500000);
        setTimeout(function(){ window.location.href = "listaNovasContr.php"; }, 300000);
    });
  </script>
</body>

</html>