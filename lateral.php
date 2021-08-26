<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <div class="nav-link">
        <div class="user-wrapper" style="margin-bottom: 5px;">
          <div class="profile-image">
            <img src="images/logoItau.png" alt="profile image">
          </div>
          <div class="text-wrapper">
            <p class="profile-name"><?=$_SESSION['usuario']?></p>
            <div>
              <small class="designation text-muted">Conectado</small>
              <span class="status-indicator online"></span>
            </div>
          </div>
        </div>
      </div>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="home.php">
        <i class="menu-icon mdi mdi-home"></i>
        <span class="menu-title">Home</span>
      </a>
    </li>
    
    <?php if ($_SESSION["importar_nc"] == 1 || $_SESSION["importar_ba"] == 1 || $_SESSION["importar_pg"] == 1){ ?>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="menu-icon fa fa-search"></i>
        <span class="menu-title">Captura de Dados</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <?php if ($_SESSION["importar_nc"] == 1){ ?>
          <li class="nav-item">
            <a class="nav-link" href="uploadNovasContr.php"><i class="fa fa-check"></i>&nbsp; Novas contratações</a>
          </li>
          <?php }
          if ($_SESSION["importar_ba"] == 1){ ?>
          <li class="nav-item">
            <a class="nav-link" href="uploadBaseAtiva.php"><i class="fa fa-check"></i>&nbsp; Base Ativa</a>
          </li>
          <?php }
          if ($_SESSION["importar_pg"] == 1){ ?>
          <li class="nav-item">
            <a class="nav-link" href="uploadPagamentos.php"><i class="fa fa-check"></i>&nbsp; Pagamentos</a>
          </li>
          <?php }
          if ($_SESSION["listar_nc"] == 1 && $_SESSION["importar_nc"] == 1 && $_SESSION["exportar_nc"] == 1 && $_SESSION["listar_ba"] == 1 && $_SESSION["importar_ba"] == 1 && $_SESSION["exportar_ba"] == 1 && $_SESSION["listar_pg"] == 1 && $_SESSION["importar_pg"] == 1 && $_SESSION["exportar_pg"] == 1 && $_SESSION["listar_ag"] == 1 && $_SESSION["incluir_ag"] == 1 && $_SESSION["editar_ag"] == 1  && $_SESSION["apagar_ag"] == 1 && $_SESSION["listar_gav"] == 1 && $_SESSION["incluir_gav"] == 1){ ?>
           <li class="nav-item">
            <a class="nav-link" href="uploadOcr.php"><i class="fa fa-check"></i>&nbsp; OCR</a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </li>
    <?php } ?>

    <?php if ($_SESSION["listar_nc"] == 1 || $_SESSION["listar_ba"] == 1 || $_SESSION["listar_pg"] == 1){ ?>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic-2" aria-expanded="false" aria-controls="ui-basic-2">
        <i class="menu-icon fa fa-list-alt"></i>
        <span class="menu-title">Relatórios</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic-2">
        <ul class="nav flex-column sub-menu">
          <?php if ($_SESSION["listar_nc"] == 1){ ?>
          <li class="nav-item">
            <a class="nav-link" href="listaNovasContr.php"><i class="fa fa-check"></i>&nbsp; Novas contratações</a>
          </li>
          <?php }
          if ($_SESSION["listar_ba"] == 1){ ?>
          <li class="nav-item">
            <a class="nav-link" href="listaBaseAtiva.php"><i class="fa fa-check"></i>&nbsp; Base Ativa</a>
          </li>
          <?php }
          if ($_SESSION["listar_ag"] == 1){ ?>
          <li class="nav-item">
            <a class="nav-link" href="listaAgressores.php"><i class="fa fa-check"></i>&nbsp; Agressores</a>
          </li>
          <?php }
          if ($_SESSION["listar_pg"] == 1){ ?>
          <li class="nav-item">
            <a class="nav-link" href="listaPagamentos.php"><i class="fa fa-check"></i>&nbsp; Pagamentos</a>
          </li>
          <?php } 
          if ($_SESSION["listar_nc"] == 1 && $_SESSION["importar_nc"] == 1 && $_SESSION["exportar_nc"] == 1 && $_SESSION["listar_ba"] == 1 && $_SESSION["importar_ba"] == 1 && $_SESSION["exportar_ba"] == 1 && $_SESSION["listar_pg"] == 1 && $_SESSION["importar_pg"] == 1 && $_SESSION["exportar_pg"] == 1 && $_SESSION["listar_ag"] == 1 && $_SESSION["incluir_ag"] == 1 && $_SESSION["editar_ag"] == 1  && $_SESSION["apagar_ag"] == 1 && $_SESSION["listar_gav"] == 1 && $_SESSION["incluir_gav"] == 1){ ?>
          <li class="nav-item">
            <a class="nav-link" href="listaUsuarios.php"><i class="fa fa-check"></i>&nbsp; Usuários</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="listaGeral.php"><i class="fa fa-check"></i>&nbsp; Histórico</a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </li>
    <?php } ?>

    <li class="nav-item">
      <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#modalBreve">
        <i class="menu-icon fa fa-refresh"></i>
        <span class="menu-title">Cadastros AutoJur</span>
      </a>
    </li>
   
    <li class="nav-item">
      <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#modalSair">
        <i class="menu-icon fa fa-sign-out"></i>
        <span class="menu-title">Sair</span>
      </a>
    </li>
    
  </ul>
</nav>



<!-- Modal -->
<div class="modal fade" id="modalSair" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header alert-danger">
        <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-sign-out"></i> Sair</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="justify">
        Deseja realmente sair do sistema?
        <div align="center" id="carregandoModalSair" class="alert" style="display: none;"><i class='fa fa-spinner fa-pulse text-danger fa-2x'></i></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="logoff()"><i class="fa fa-check"></i> Sair</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalBreve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header alert-warning">
        <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-refresh"></i> Cadastros AutoJur</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="justify">
        Funcionalidade em breve...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal" aria-label="Close"><i class="fa fa-check"></i> Entendido</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal exclusao GERAL - Partilhado entre as paginas -->
<div class="modal fade" id="modalExclusao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header alert-danger">
        <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i> Excluir Registro</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="justify">

        <div id="msgErroExcluir" class="alert alert-danger" style="display: none;"><small>Erro ao excluir. Tente novamente!</small></div>

        Deseja realmente excluir este registro do sistema ?
        <div align="center" id="carregandoModalExclusao" class="alert" style="display: none;"><i class='fa fa-spinner fa-pulse text-danger fa-2x'></i></div>
      </div>
      <div class="modal-footer">
        <button type="button" id="botaoExclusao" class="btn btn-danger"><i class="fa fa-trash"></i> Excluir</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> Cancelar</button>
      </div>
    </div>
  </div>
</div>