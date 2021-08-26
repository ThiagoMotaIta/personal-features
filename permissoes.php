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
      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper" align="center" style="background-color: #fff;">
          
          Carregando as configurações do seu perfil de acesso. Aguarde...
          <p></p>
          <p>
            <i class="fa fa-spinner fa-pulse fa-4x text-warning"></i>
          </p>

          <?php

          // Captura as permissoes do usuario logado

          $q = mysqli_query($bd, "SELECT * FROM permissoes where usuario_id = '".$_SESSION['id']."' and status = 'A' order by id desc limit 0,1");
          $rs = mysqli_fetch_assoc($q);

          $_SESSION["listar_nc"] = $rs["listar_nc"];
          $_SESSION["importar_nc"] = $rs["importar_nc"];
          $_SESSION["exportar_nc"] = $rs["exportar_nc"];
          $_SESSION["listar_ba"] = $rs["listar_ba"];
          $_SESSION["importar_ba"] = $rs["importar_ba"];
          $_SESSION["exportar_ba"] = $rs["exportar_ba"];
          $_SESSION["listar_pg"] = $rs["listar_pg"];
          $_SESSION["importar_pg"] = $rs["importar_pg"];
          $_SESSION["exportar_pg"] = $rs["exportar_pg"];
          $_SESSION["listar_ag"] = $rs["listar_ag"];
          $_SESSION["incluir_ag"] = $rs["incluir_ag"];
          $_SESSION["editar_ag"] = $rs["editar_ag"];
          $_SESSION["apagar_ag"] = $rs["apagar_ag"];
          $_SESSION["listar_gav"] = $rs["listar_gav"];
          $_SESSION["incluir_gav"] = $rs["incluir_gav"];

          ?> 

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php
        // Encerrando a conexão em cada página (Conexão é aberta no arquivo topo.php)
        mysqli_close($bd);
        ?>
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
      setTimeout(function(){ window.location.href = "home.php"; }, 3000);
    });
  </script>
</body>

</html>