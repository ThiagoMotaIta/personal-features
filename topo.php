<?php 
session_start(); 
include "includes/funcoes.php";

include "variaveis.php";

// ATENCAO: Algumas variáves estão no arquivo variaveis.php onde este é chamado dentro das páginas

// Verifica usuario logado
if (!isset($_SESSION['id'])){
  redirect("logoff.php");
  die();
}

// Ahre conexao ------ fechamento no rodape.php
$bd = abreConn();

?>

<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="home.php">
          <img src="http://sistemas.rochamarinho.adv.br/images/logoRMS.png" alt="logo" style="height: 50px;" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="home.php">
          <img src="images/logo-mini.svg" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-left">
          <li class="nav-item">
            <h4>SISTEMAS UNIFICADOS E INTELIGENTES - SUIT</h4>Hoje: <?=$dataAgora?>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <!--<a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell"></i>
              <span class="count">4</span>-->
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 4 new notifications
                </p>
                <span class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mdi mdi-alert-circle-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Application Error</h6>
                  <p class="font-weight-light small-text">
                    Just now
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-comment-text-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Settings</h6>
                  <p class="font-weight-light small-text">
                    Private message
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="mdi mdi-email-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">New user registration</h6>
                  <p class="font-weight-light small-text">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Olá, <?=$_SESSION['usuario']?> !</span>
              <img class="img-xs rounded-circle" src="images/logoItau.png" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item mt-2" href="javascript:void(0);" data-toggle="modal" data-target="#modalMudarSenha">
                <i class="fa fa-key"></i> Editar Senha
              </a>
              <a class="dropdown-item" href="jvascript:void(0);" data-toggle="modal" data-target="#modalSair">
                <i class="fa fa-sign-out"></i> Sair
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>


  <!-- Modal -->
  <div class="modal fade" id="modalMudarSenha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header alert-primary">
          <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-key"></i> Alterar Senha</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body" align="justify">
          <form class="forms-sample">

            <input type="hidden" id="idLogado" value="<?=$_SESSION['id']?>">

            <div id="msgErroSenha" class="alert alert-danger" style="display: none;"><small><span id="tipoErroSenha"></span></small></div>
            <div id="msgSucessoSenha" class="alert alert-success" style="display: none;"><small><i class="fa fa-check-circle"></i> Senha editada com sucesso!</small></div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Senha Atual</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="senhaAtual" placeholder="Senha Atual">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nova Senha</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="novaSenha" placeholder="Nova Senha">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Repita Senha</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="novaSenha2" placeholder="Repita a Nova Senha">
              </div>
            </div>
          </form>
          <div align="center" id="carregandoModalSenha" class="alert" style="display: none;"><i class='fa fa-spinner fa-pulse text-primary fa-2x'></i></div>  
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="alterarSenha()"><i class="fa fa-edit"></i> Editar</button>
        </div>
      </div>
    </div>
  </div>