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


      <?php 

      $textoErro = '';
      $displayErro = 'none';
      $displaySucesso = 'none';
      $tempoMinuto = "";
      
      if(isset($_GET['sucesso'])){
        $displayErro = 'block';

        if ($_GET['sucesso'] == 2){
          $textoErro = '<strong>Erro:</strong> O sistema n&atilde;o conseguiu importar os dados. Tente novamente!';
        }

        if ($_GET['sucesso'] == 3){
          $textoErro = "<strong>Erro:</strong> Selecione um arquivo!";
        }

        if ($_GET['sucesso'] == 0){
          $textoErro = "<strong>Erro:</strong> Selecione um arquivo (<strong>.CSV</strong>) de <strong>até 4MB de tamanho</strong>!";
        }

        if ($_GET['sucesso'] != 1 && $_GET['sucesso'] != 2 && $_GET['sucesso'] != 3 && $_GET['sucesso'] != 0){
          $textoErro = "Porque voc&ecirc; est&aacute; mexendo diretamente na URL do sistema??";
        }

        if ($_GET['sucesso'] == 1){
          $textoErro = "";
          $displayErro = 'none';
          $displaySucesso = 'block';
        }

      }

      ?>
      
      
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
            <div class="col-12"><h4 class="text-warning">Captura de Dados - Base Ativa</h4><hr/></div>
          </div>  

          <div class="row">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">

                      <div id="msgErro" style="display: <?=$displayErro?>; margin: 0 auto;" class="alert alert-danger" role="alert">
                        <span id="tipoErro"><?=$textoErro?></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true" onclick="javascript: $('#msgErro').hide(500);">&times;</span>
                        </button>
                      </div>

                      <div id="msgSucesso" style="display: <?=$displaySucesso?>;" class="alert alert-warning alert-dismissible fade show" role="alert">
                        <span><strong>Sucesso:</strong> Planilha importada e análise processada! Para acessar o resultado <a href="listaUltimaAnalise.php"><strong class="text-warning">clique aqui</strong></a></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true" onclick="javascript: $('#msgSucesso').hide(500);">&times;</span>
                        </button>
                      </div>

                      <h4 class="card-title">Selecionar arquivo</h4><hr/>

                      <div id="divBaseAComparar" style="margin: 0 auto; padding: 25px 0 0; position: relative; text-align: center; text-shadow: 0 1px 0 #fff; width: 580px; display: block;">

                        <div class="form-group" align="center">
                          <form class="form-horizontal form-label-left" id="formUpload" name="formUpload" enctype="multipart/form-data" method="post" action="importAction.php">
                            <input name="baseComparada" id="baseComparada" type="file" class="btn btn-light" />
                            <p></p>
                            <button type="submit" class="btn btn-warning" onclick="javascript:$('#carregando').show(); $('#carregandoTexto').show();"><i class="fa fa-android"></i> Capturar</button>
                          </form>
                        </div>

                      </div>

                      <p align="center" id="carregando" style="display: none;">
                        <br/>
                        <i class="fa fa-spinner text-warning fa-2x fa-spin"></i> <br/><small class="text-warning">Capturando Informações...</small>
                      </p>

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
</body>

</html>