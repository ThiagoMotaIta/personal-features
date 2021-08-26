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
            <div class="col-12"><h4 class="text-warning">Listagem - Advogados Agressores</h4><hr/></div>
          </div>  

          <div class="row">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">

                      <h4 class="card-title">Advogados Agressores
                        <span class="float-sm-right" data-toggle="modal" data-target="#modalAGressores">
                          <button class="btn btn-warning btn-sm">+ <i class="fa fa-users fa-lg"></i></button>
                        </span>
                      </h4>

                      <div id="divBaseAComparar" style="margin: 0 auto; padding: 25px 0 0; position: relative; text-align: center; text-shadow: 0 1px 0 #fff; display: block;">

                        <div class="form-group" align="center">

                          <!-- generica a toda lista com opcao de exclusao -->
                          <div id="msgSucessoExcluir" class="alert alert-success" style="display: none;"><small><i class="fa fa-check-circle"></i> Registro excluído com sucesso!</small></div>
                          
                          <table class="table table-sm table-striped" id="listaPareada">
                            <thead class="thead-light" align="center">
                              <tr id="tr-<?=$rs['id']?>">
                                <th>ID</th>
                                <th>Advogado</th>
                                <th>Grau</th>
                                <th>Data Importação</th>
                                <th>Ações</th>
                              </tr>
                            </thead>
                            <tbody align="center">
                              <?php

                              function tirarAcentosMelhorada($string){
                                  return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/", "/(ç)/", "/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$string);
                              }
                              
                              
                              $q=  mysqli_query($bd, "SELECT * FROM base_agressores where status = 'A' ");

                              $num_rows = mysqli_num_rows($q);
                              
                              while ($rs = mysqli_fetch_array($q)){

                              ?>    
                              <tr id="tr-<?=$rs['id']?>">
                                <td><?=$rs['id']?></td>
                                <td><?=tirarAcentosMelhorada($rs['nome_agressor'])?></td>
                                <td><?=$rs['grau_agressor']?></td>
                                <td><?php echo date("d/m/Y",strtotime($rs['data_importacao'])); ?></td>
                                <td>
                                  <button class="btn btn-warning btn-sm" onclick="modalInfo(<?=$rs['id']?>, '<?=$rs['nome_agressor']?>', '<?=$rs['grau_agressor']?>')"><i class="fa fa-edit"></i></button>
                                  <button class="btn btn-default btn-sm" onclick="chamaModalExclusao(<?=$rs['id']?>, 'agressor')"><i class="fa fa-trash"></i></button>
                                </td>
                              </tr>
                              <?php } ?>
                            </tbody>
                          </table>

                          <hr/>

                          <?php if ($num_rows > 0){ ?>
                            <a href="planilhaPareadaResultado.php" class="btn btn-warning"><i class="fa fa-file-excel-o"></i> Exportar Planilha</a>
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

  <!-- Modal -->
  <div class="modal fade" id="modalAGressores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header alert-warning">
          <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-users"></i> Incluir Agressor</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body" align="justify">
          <form class="forms-sample">
            <div id="msgErroGerenciarAgressores" class="alert alert-danger" style="display: none;"><small>Erro ao realizar ação!</small></div>
            <div id="msgSucessoGerenciarAgressores" class="alert alert-success" style="display: none;"><small><i class="fa fa-check-circle"></i> Agressor adicionado com sucesso!</small></div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Advogado</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="nomeAgressor" placeholder="NOME DO ADVOGADO">
              </div>
              <div class="col-sm-3">
                <select class="form-control" id="grauAgressor">
                  <option value="">GRAU</option>
                  <option value="AGRESSOR">AGRESSOR</option>
                  <option value="POTENCIAL">POTENCIAL</option>
                </select>
              </div>
            </div>
          </form>
          <div align="center" id="carregandoGerenciarAgressores" class="alert" style="display: none;"><i class='fa fa-spinner fa-pulse text-warning fa-2x'></i></div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-warning" onclick="gerenciarAgressores()"><i class="fa fa-plus"></i> Incluir</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header alert-warning">
          <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-info"></i> Informações</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body" align="justify">
          <form class="forms-sample">
            
            <div id="msgErroGerenciarAgressoresEdit" class="alert alert-danger" style="display: none;"><small>Erro ao realizar ação!</small></div>
            <div id="msgSucessoGerenciarAgressoresEdit" class="alert alert-success" style="display: none;"><small><i class="fa fa-check-circle"></i> Grau editado com sucesso!</small></div>

            <input type="hidden" id="idAgressor">

            <div class="form-group row">
              <label class="col-sm-12 col-form-label"><span id="nomeAgressorTexto"></span></label>
            </div>
            
            <div class="form-group row">
              <div class="col-sm-6">
                <select class="form-control" id="grauAgressorEdit">
                  <option value="">GRAU</option>
                  <option value="AGRESSOR">AGRESSOR</option>
                  <option value="POTENCIAL">POTENCIAL</option>
                </select>
              </div>
            </div>
          
          </form>
          <div align="center" id="carregandoGerenciarAgressoresEdit" class="alert" style="display: none;"><i class='fa fa-spinner fa-pulse text-warning fa-2x'></i></div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-warning" onclick="editarAgressor()"><i class="fa fa-edit"></i> Editar</button>
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
      $("#listaPareada").DataTable();
    });
  </script>
</body>

</html>