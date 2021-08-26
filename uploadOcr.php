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
            <div class="col-12"><h4 class="text-warning">Captura de Dados - OCR</h4><hr/></div>
          </div>  

          <div class="row">
            <div class="content-wrapper">
              <div class="row">
                
                <div class="col-lg-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">

                      <div id="msgErro" style="display: <?=$displayErro?>; margin: 0 auto;" class="alert alert-danger" role="alert">
                        <span id="tipoErro"><?=$textoErro?></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true" onclick="javascript: $('#msgErro').hide(500);">&times;</span>
                        </button>
                      </div>

                      <div id="msgSucesso" style="display: <?=$displaySucesso?>;" class="alert alert-warning alert-dismissible fade show" role="alert">
                        <span><strong><i class="fa fa-check text-warning"></i> Sucesso:</strong> Planilha importada e dados capturados! <a href="listaNovasContr.php"><strong class="text-warning">clique aqui</strong></a></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" disabled="disabled">
                          <span aria-hidden="true" onclick="javascript: $('#msgSucesso').hide(500);">&times;</span>
                        </button>
                      </div>

                      <h4 class="card-title">Selecionar Documento</h4><hr/>

                      <div id="divBaseAComparar" style="margin: 0 auto; padding: 25px 0 0; position: relative; text-align: center; text-shadow: 0 1px 0 #fff; width: 580px; display: block;">

                        <div class="form-group" align="center">
                          <form class="form-horizontal form-label-left" id="formUpload" name="formUpload" enctype="multipart/form-data" method="post" action="importActionBaseAgressores.php">
                            <input name="baseAgressores" id="baseAgressores" type="file" class="btn btn-light" />
                            <p></p>
                            <button type="button" class="btn btn-warning" onclick="leituraOcr()"><i class="fa fa-android"></i> Leitura de Arquivo</button>
                            <button type="reset" class="btn btn-default" onclick="javascript:$('#msgErro').hide(500); $('#msgSucesso').hide(500);">Limpar</button>
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

                <div class="col-lg-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">


                      <h4 class="card-title">Leitura em tempo real</h4><hr/>

                      <div id="divBaseAComparar" style="margin: 0 auto; padding: 25px 0 0; position: relative; text-align: center; text-shadow: 0 1px 0 #fff; width: 580px; display: block;">

                        <div id="valoresOcr" class="form-group" align="left" style="display: none;">
                          <span id="reu"></span><br/>
                          <span id="orgao"></span><br/>
                          <span id="comarca"></span><br/>
                          <span id="autor"></span><br/>
                          <span id="autorCpf"></span><br/>
                          <span id="autorRg"></span><br/>
                          <span id="numPro"></span><br/>
                          <span id="acao"></span><br/>
                          <span id="valorAcao"></span><br/>
                          <span id="advPartContr"></span><br/>
                        </div>

                      </div>

                      <p align="center" id="carregandoOcr" style="display: none;">
                        <br/>
                        <i class="fa fa-spinner text-warning fa-2x fa-spin"></i> <br/><small class="text-warning">Lendo Arquivo...</small>
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

  <script type="text/javascript">
    function leituraOcr(){
      $('#valoresOcr').show();
      $('#carregandoOcr').show();

      setTimeout(function(){ 
        $('#reu').html("<strong>Réu</strong>: Banco Itaú Consignado S/A");
        $('#reu').show(); 
      }, 6000);
      setTimeout(function(){
        $('#orgao').html("<strong>Órgão</strong>: Vara Única");
        $('#orgao').show(); 
      }, 8000);
      setTimeout(function(){
        $('#comarca').html("<strong>Comarca</strong>: Aracoiaba / CE");
        $('#coarca').show(); 
      }, 10000);
      setTimeout(function(){
        $('#autor').html("<strong>Autor</strong>: AMÉLIA MOURA MACIEL");
        $('#autor').show(); 
      }, 12000);
      setTimeout(function(){
        $('#autorCpf').html("<strong>Autor - CPF</strong>: 724 584.023-72");
        $('#autorCpf').show(); 
      }, 16000);
      setTimeout(function(){
        $('#autorRg').html("<strong>Autor - RG</strong>: 2008631328-7");
        $('#autorRg').show(); 
      }, 22000);
      setTimeout(function(){
        $('#numPro').html("<strong>Processo</strong>: 3000190-92.2019 8.06 0036");
        $('#numPro').show(); 
      }, 26000);
      setTimeout(function(){
        $('#acao').html("<strong>Ação</strong>: AÇÃO ANULATÓRIA DE DÉBITO c/c DANOS MATERIAS E MORAIS");
        $('#acao').show(); 
      }, 32000);
      setTimeout(function(){
        $('#valorAcao').html("<strong>Valor Ação</strong>: R$ 15 000,00");
        $('#valorAcao').show(); 
      }, 38000);
      setTimeout(function(){
        $('#advPartContr').html("<strong>Adv Parte Contr.</strong>: DR. LIVIO MARTINS ALVES / OAB/CE 15.942 ");
        $('#advPartContr').show(); 
      }, 42000);
      setTimeout(function(){
        $('#carregandoOcr').hide(); 
      }, 44000);
    }

  </script>
</body>

</html>