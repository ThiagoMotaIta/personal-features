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
            <div class="col-12"><h4 class="text-warning">Listagem - Usuários</h4><hr/></div>
          </div>  

          <div class="row">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">

                      <h4 class="card-title">Usuários do Sistema 
                        <?php if ($_SESSION['incluir_ag'] == 1){ ?>
                        <span class="float-sm-right" data-toggle="modal" data-target="#modalUsuario">
                          <button class="btn btn-warning btn-sm">+ <i class="fa fa-user fa-lg"></i></button>
                        </span>
                        <?php } ?>
                      </h4>
                      <hr/>

                      <div id="divBaseAComparar" style="margin: 0 auto; padding: 25px 0 0; position: relative; text-align: center; text-shadow: 0 1px 0 #fff; display: block;">

                        <div class="form-group" align="center">

                          <!-- generica a toda lista com opcao de exclusao -->
                          <div id="msgSucessoExcluir" class="alert alert-success" style="display: none;"><small><i class="fa fa-check-circle"></i> Registro excluído com sucesso!</small></div>
                          
                          <table class="table table-sm table-striped" id="listaUsuarios">
                            <thead class="thead-light" align="center">
                              <tr id="tr-<?=$rs['id']?>">
                                <th>ID</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Identificação BJ</th>
                                <th>Senha BJ</th>
                                <th>Ações</th>
                              </tr>
                            </thead>
                            <tbody align="center">
                              <?php

                              function tirarAcentosMelhorada($string){
                                  return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/", "/(ç)/", "/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$string);
                              }
                              
                              
                              $q=  mysqli_query($bd, "SELECT * FROM acesso where status = 'A' ");

                              $num_rows = mysqli_num_rows($q);
                              
                              while ($rs = mysqli_fetch_array($q)){

                              ?>    
                              <tr id="tr-<?=$rs['id']?>">
                                <td><?=$rs['id']?></td>
                                <td onclick="modalEditarUser(<?=$rs['id']?>)"><?=tirarAcentosMelhorada($rs['usuario'])?></td>
                                <td><?=$rs['email']?></td>
                                <td><?=$rs['login_bj']?></td>
                                <td><i class="fa fa-eye" title="<?=$rs['senha_bj']?>"></i></td>
                                <td>
                                  <button class="btn btn-warning btn-sm" onclick="modalInfoPermissoes(<?=$rs['id']?>)"><i class="fa fa-lock"></i></button>
                                  <button class="btn btn-default btn-sm" onclick="chamaModalExclusao(<?=$rs['id']?>, 'usuario')"><i class="fa fa-trash"></i></button>
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

          <!-- Modal permissao usuario -->
          <div class="modal fade" id="modalPermissao" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header alert-warning">
                  <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-lock"></i> Permissões de Usuário</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" align="justify">

                  <div id="msgErroPermissao" class="alert alert-danger" style="display: none;"><small><strong>Erro</strong>! Permissões não cadastradas! Tente novamente.</small></div>
                  <div id="msgSucessoPermissao" class="alert alert-success" style="display: none;"><small><strong>Sucesso</strong>! As permissões foram cadastradas.</small></div>

                  <form class="forms-sample" id="formPermissoes">



                    <span style="display: block;" id="spamUsuarioPermissao">
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <select class="form-control" id="usuarioId" disabled="disabled">
                            <option value="">Usuário</option>
                              <?php 
                              $q=  mysqli_query($bd, "SELECT id, usuario, status FROM acesso where status = 'A' order by usuario ");

                              while ($rs = mysqli_fetch_array($q)){ ?>
                                <option value="<?=$rs['id']?>"><?=$rs['usuario']?></option>
                              <?php } ?>  
                          </select>
                        </div>
                      </div>
                    </span>

                    <span style="display: none;" id="spamCheckBoxPermissao">


                      <div class="form-group row">
                        <div class="col-sm-12">
                          <small>Marcar/desmarcar tudo</small> <input class="checkPermissoesMaster" type="checkbox" id="checkMaster" onclick="marcardesmarcar()">
                        </div>
                      </div>

                      <strong>NOVAS CONTRATAÇÕES</strong>
                      <fieldset style="background-color: #fff; padding: 5px;">
                        <div class="form-group row">
                          <div class="col-sm-4">
                            Listar <input class="checkPermissoes" type="checkbox" id="listarNC" name="checkPermissoesName" value="1">
                          </div>
                          <div class="col-sm-4">
                            Importar <input class="checkPermissoes" type="checkbox" id="importarNC" name="checkPermissoesName" value="1">
                          </div>
                          <div class="col-sm-4">
                            Exportar <input class="checkPermissoes" type="checkbox" id="exportarNC" name="checkPermissoesName" value="1">
                          </div>
                        </div>
                      </fieldset>

                      <hr/>

                      <strong>BASE ATIVA</strong>
                      <fieldset style="background-color: #fff; padding: 5px;">
                        <div class="form-group row">
                          <div class="col-sm-4">
                            Listar <input class="checkPermissoes" type="checkbox" id="listarBA" name="checkPermissoesName" value="1">
                          </div>
                          <div class="col-sm-4">
                            Importar <input class="checkPermissoes" type="checkbox" id="importarBA" name="checkPermissoesName" value="1">
                          </div>
                          <div class="col-sm-4">
                            Exportar <input class="checkPermissoes" type="checkbox" id="exportarBA" name="checkPermissoesName" value="1">
                          </div>
                        </div>
                      </fieldset>

                      <hr/>

                      <strong>PAGAMENTOS</strong>
                      <fieldset style="background-color: #fff; padding: 5px;">
                        <div class="form-group row">
                          <div class="col-sm-4">
                            Listar <input class="checkPermissoes" type="checkbox" id="listarPG" name="checkPermissoesName" value="1">
                          </div>
                          <div class="col-sm-4">
                            Importar <input class="checkPermissoes" type="checkbox" id="importarPG" name="checkPermissoesName" value="1">
                          </div>
                          <div class="col-sm-4">
                            Exportar <input class="checkPermissoes" type="checkbox" id="exportarPG" name="checkPermissoesName" value="1">
                          </div>
                        </div>
                      </fieldset>

                      <hr/>

                      <strong>AGRESSORES</strong>
                      <fieldset style="background-color: #fff; padding: 5px;">
                        <div class="form-group row">
                          <div class="col-sm-3">
                            Listar <input class="checkPermissoes" type="checkbox" id="listarAG" name="checkPermissoesName" value="1">
                          </div>
                          <div class="col-sm-3">
                            Incluir <input class="checkPermissoes" type="checkbox" id="incluirAG" name="checkPermissoesName" value="1">
                          </div>
                          <div class="col-sm-3">
                            Editar <input class="checkPermissoes" type="checkbox" id="editarAG" name="checkPermissoesName" value="1">
                          </div>
                          <div class="col-sm-3">
                            Apagar <input class="checkPermissoes" type="checkbox" id="apagarAG" name="checkPermissoesName" value="1">
                          </div>
                        </div>
                      </fieldset>

                      <hr/>

                      <strong>GESTÃO À VISTA (GAV)</strong>
                      <fieldset style="background-color: #fff; padding: 5px;">
                        <div class="form-group row">
                          <div class="col-sm-3">
                            Listar <input class="checkPermissoes" type="checkbox" id="listarGAV" name="checkPermissoesName" value="1">
                          </div>
                          <div class="col-sm-3">
                            Incluir <input class="checkPermissoes" type="checkbox" id="incluirGAV" name="checkPermissoesName" value="1">
                          </div>
                        </div>
                      </fieldset>
                    </span>

                  </form>    

                  <div align="center" id="carregandoModalPermissao" class="alert" style="display: none;"><i class='fa fa-spinner fa-pulse text-warning fa-2x'></i></div>
                </div>
                <div class="modal-footer">
                  <button type="button" id="botaoConcluirPermissao" disabled="disabled" class="btn btn-warning" onclick="criarPermissoes()"><i class="fa fa-check-circle"></i> Concluir</button>
                  <button type="button" class="btn btn-secondary" onclick="cancelarPermissao()"><i class="fa fa-close"></i> Cancelar</button>
                </div>
              </div>
            </div>
          </div>


          <!-- Modal CRIAR USUARIO-->
          <div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header alert-warning">
                  <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-user"></i> Incluir Usuário</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                
                <div class="modal-body" align="justify">
                  <form class="forms-sample">
                    <div id="msgErroNovoUser" class="alert alert-danger" style="display: none;"><small>Erro ao realizar ação!</small></div>
                    <div id="msgSucessoNovoUser" class="alert alert-success" style="display: none;"><small><i class="fa fa-check-circle"></i> Usuário cadastrado com sucesso!</small></div>

                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nome</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nomeUsuario" placeholder="Nome do Usuário">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">E-mail</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="emailUsuario" placeholder="E-mail Corporativo">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Senha SUIT</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="senhaUsuario" placeholder="Senha para primeiro acesso SUIT">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Usuário PJUR</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="usuarioPjur" placeholder="Usuário de acesso ao portal Itaú">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Senha PJUR</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="senhaPjur" placeholder="Senha de acesso ao portal Itaú">
                      </div>
                    </div>
                    
                  </form>
                  <div align="center" id="carregandoNovoUsuario" class="alert" style="display: none;"><i class='fa fa-spinner fa-pulse text-warning fa-2x'></i></div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-warning" onclick="novoUsuario()"><i class="fa fa-plus"></i> Incluir</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal Editar USUARIO-->
          <div class="modal fade" id="modalEditarUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header alert-warning">
                  <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Editar Usuário</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                
                <div class="modal-body" align="justify">
                  <form class="forms-sample">
                    <div id="msgErroNovoUserEdit" class="alert alert-danger" style="display: none;"><small>Erro ao realizar ação!</small></div>
                    <div id="msgSucessoNovoUserEdit" class="alert alert-success" style="display: none;"><small><i class="fa fa-check-circle"></i> Usuário editado com sucesso!</small></div>

                    <input type="hidden" id="idUsuarioEdit">

                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nome</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nomeUsuarioEdit" placeholder="Nome do Usuário">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">E-mail</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="emailUsuarioEdit" placeholder="E-mail Corporativo">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Senha SUIT</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="senhaUsuarioEdit" placeholder="Senha para primeiro acesso SUIT">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Usuário PJUR</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="usuarioPjurEdit" placeholder="Usuário de acesso ao portal Itaú">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Senha PJUR</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="senhaPjurEdit" placeholder="Senha de acesso ao portal Itaú">
                      </div>
                    </div>
                    
                  </form>
                  <div align="center" id="carregandoNovoUsuarioEdit" class="alert" style="display: none;"><i class='fa fa-spinner fa-pulse text-warning fa-2x'></i></div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-warning" onclick="editarUsuario()"><i class="fa fa-edit"></i> Editar</button>
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
      $("#listaUsuarios").DataTable();
    });
  </script>
</body>

</html>