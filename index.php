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
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">  
            <h1 align="center" class="text-warning">SUIT</h1>
            <h4 align="center">SISTEMAS UNIFICADOS E INTELIGENTES</h4>
            <div class="auto-form-wrapper">
              
              <div align="center" id="carregando" class="alert" style="display: none;"><i class='fa fa-spinner fa-pulse text-warning fa-2x'></i></div>
              <div id="msgErro" class="alert alert-danger" style="display: none;"><small><i class="fa fa-exclamation-triangle"></i> <span id="tipoErro"></span></small></div>

              <form id="formLogin">
                <div class="form-group">
                  <label class="label">E-mail</label>
                  <div class="input-group">
                    <input type="text" id="email" class="form-control" placeholder="E-mail de Usuário">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-account"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Senha</label>
                  <div class="input-group">
                    <input type="password" id="senha" class="form-control" placeholder="Senha de Usuário">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-lock"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </form>
              
              <div class="form-group">
                <button class="btn btn-warning submit-btn btn-block" onclick="validarLogin()"><i class="mdi mdi-check-circle"></i> Entrar</button>
              </div>
              
              <div>
                <p class="text-center">
                  <img src="http://sistemas.rochamarinho.adv.br/images/logoRMS.png" width="300" /><br/><br/>
                  <small><strong>NIT</strong> - N&uacute;cleo de Inova&ccedil;&atilde;o e Tecnologia
                  <br/>
                  Rocha, Marinho E Sales Advogados</small>
                </p>
              </div>
              
            </div>
          
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <script src="js/app.js"></script>
  <!-- endinject -->

  <!-- Modal -->
  <div class="modal fade" id="modalCadastroUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header alert-primary">
          <h4 class="modal-title" id="exampleModalLabel"><i class="mdi mdi-plus-circle"></i> Primeiro Acesso</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" align="justify">
          Caso seu usuário não esteja cadastrado em nosso sistema, entre em contato com o <strong class="text-primary">NIT</strong>.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Entendido</button>
        </div>
      </div>
    </div>
  </div>


</body>

<script type="text/javascript">
  $(document).ready(function() {
    $("#email").focus();
  });
</script>

</html>