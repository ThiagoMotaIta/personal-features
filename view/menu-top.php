<?php include "controller/varIdiomas.php";  ?>

<header class="main-header clearfix" role="header">
  <div class="logo">
    <a href="./"><img src="assets/images/logotipoBrancoNovo.png" width="300" /></a>
  </div>
  <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
  <nav id="menu" class="main-nav" role="navigation">
    <ul class="main-menu">
      <li class="has-submenu"><a href="#sectionJogos"><?=$menuJogos?></a>
        <ul class="sub-menu">
          <li><a href="#" id="menuGame1">COD - Mobile</a></li>
          <li><a href="#" id="menuGame2">COD - War Zone</a></li>
          <li><a href="#" id="menuGame3">CS:GO</a></li>
          <li><a href="#" id="menuGame4">eFootball PES</a></li>
          <li><a href="#" id="menuGame5">Free Fire</a></li>
          <li><a href="#" id="menuGame6">LOL - Wild Rift</a></li>
          <li><a href="#" id="menuGame7">Valorant</a></li>
          <li><a href="#" id="menuGame8">Pokémon Unite</a></li>
        </ul>
      </li>
      <li><a href="#" id="menuLoja"><?=$menuLoja?></a></li>
      <li class="has-submenu"><a href="#sectionCampeonato"><?=$menuJogar?></a>
        <ul class="sub-menu">
          <li><a href="#" id="menuCampeonatos"><?=$menuCampeonatos?></a></li>
          <li><a href="#" id="menuXTreinos"><?=$menuXTreinos?></a></li>
          <li><a href="#" id="menuLiga"><?=$menuLigas?></a></li>
          <li><a href="#" id="menuDisputas">Arena</a></li>
        </ul>
      </li>
      <li class="has-submenu"><a href="#sectionRanking">RANKING</a>
        <ul class="sub-menu">
          <li><a href="#" id="menuRankingSquad">BR SQUAD</a></li>
          <li><a href="#" id="menuRankingSolo">BR SOLO</a></li>
        </ul>
      </li>
      <?php 
      if(!isset($_SESSION['loggedId'])){ ?>
        <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalRegistrar"><?=$menuCriarConta?></a></li>
        <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalEntrar"><?=$menuEntrar?></a></li>
      <?php } else { ?>
        <li class="has-submenu"><a href="#" data-bs-toggle="modal" data-bs-target="#modalPlayer"><i class="fa fa-user"></i> <?=$_SESSION['loggedPlayerName']?></a></a>
        <ul class="sub-menu">
          <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalPlayer"><?=$menuMeuProgresso?></a></li>
          <li><a href="#" id="menuPerfil"><?=$menuMeuPerfil?></a></li>
          <li><a href="#" id="menuSair"><?=$menuSair?></a></li>
        </ul>
      </li>
      <?php } ?>
      <!--<li><a href="#" id="menuBr"><img src="assets/images/b-br.jpg" height="25" /></a></li>
      <li><a href="#" id="menuEng"><img src="assets/images/b-en.jpg" height="25" /></a></li>-->
    </ul>
  </nav>
</header>


<!-- Modal Registrar -->
  <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        
        <div class="modal-header">
          <strong><?=$contaTitleCriarConta?></strong><img src="assets/images/iconeNormal.fw.png" height="30" />
        </div>

        <div class="modal-body">
          <small>

            <div class="alert" id="DivRegisterCont" style="display: none;"> 
             Se você se pré-inscreveu no campeonato de <i><strong>CALL OF DUTY MOBILE</strong></i>, ao criar sua conta, informe o <strong>MESMO E-MAIL</strong> utilizado na sua pré-inscrição.<br/><br/>
             Caso você não tenha feito sua pré-inscrição, não tem problema: Basta criar sua conta normalmente.
             <br/><br/>
             <button class="btn btn-primary btn-sm" onclick="showDivRegister()">Criar Conta</button>
            </div>

           <div id="divRegister" style="display: block;"> 
             <form id="formNovaContaPadrao" action="controller/criar-nova-conta-padrao.php" method="POST">
              <div class="form-group">
                <input type="text" class="form-control" id="nameReg" name="nameReg" placeholder="<?=$nomeCriarConta?>">
                <small id="msnErroNameRegPadrao" style="display: none" class="text-danger">Informe um Nome</small>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="emailReg" name="emailReg" placeholder="<?=$emailCriarConta?>">
                <small id="msnErroEmailRegPadrao" style="display: none" class="text-danger">Informe um E-mail válido</small>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="emailRegConfirm" name="emailRegConfirm" placeholder="<?=$emailConfCriarConta?>">
                <small id="msnErroEmailRegConfirmPadrao" style="display: none" class="text-danger">E-mails não Conferem</small>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="passWordReg" name="passWordReg" placeholder="<?=$senhaCriarConta?>">
                <small id="msnErroPassWordRegPadrao" style="display: none" class="text-danger">Informe uma Senha</small>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="passWordRegConfirm" name="passWordRegConfirm" placeholder="<?=$senhaConfCriarConta?>">
                <small id="msnErroPassWordRegConfirmPadrao" style="display: none" class="text-danger">Senhas não Conferem</small>
              </div>
              <div class="form-check">
                <?=$termos?>
              </div>
             </form>
            </div>

         </small>
        </div>
        <div class="modal-footer">
          <button id="btnCriarConta" style="display: block;" type="button" class="btn btn-primary" onclick="validarNovaContaPadrao()"><i class="fa fa-gamepad"></i> <?=$contaCriarConta?></button>
          <div id="loadingCriarContaPadrao" style="display: none;"><small><i class="fa fa-spinner fa-spin"></i> Carregando...</small></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalEntrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <strong><?=$loginTitle?></strong><img src="assets/images/iconeNormal.fw.png" height="30" />
        </div>

        <div class="modal-body">
        <small>
           <form id="formLogin" action="controller/login.php" method="POST">
            <div class="form-group">
              <input type="text" class="form-control" id="emailLogin" name="emailLogin" placeholder="<?=$emailLogin?>">
              <small id="msnErroEmailLogin" style="display: none" class="text-danger">Informe um e-mail válido</small>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="passWordLogin" name="passWordLogin" placeholder="<?=$senhaLogin?>">
              <small id="msnErroPassWordLogin" style="display: none" class="text-danger">Informe uma Senha</small>
            </div>
            <a href="recuperar-acesso.php" class="text-primary"><?=$loginTitleEsqueceuSenha?></a>
            <hr/>
            <a href="#" onclick="chamaModalCriarConta()" class="text-primary"><?=$loginTitleAindaNaoCriouConta?></a>
         </small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="verificaLogin()"><i class="fa fa-gamepad"></i> <?=$contaLogin?></button>
          <div id="loadingLogin" style="display: none;"><small><i class="fa fa-spinner fa-spin"></i> Carregando...</small></div>
        </div>
        </form>
      </div>
    </div>
  </div>




  <?php if(isset($_SESSION['loggedId'])){ ?>

    <input type="hidden" id="logadoHidden" value="<?=$_SESSION['loggedId']?>" />
    
    <!-- Modal -->
    <div class="modal fade" id="modalPlayer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <strong><?=$_SESSION['loggedPlayerName']?></strong><img src="assets/images/iconeNormal.fw.png" height="30" />
          </div>

          <div class="modal-body" align="center">
          <small>

          <h5><?=$_SESSION['loggedPlayerLevel']?></h5>
          
          Experiência:
          <h5>
            <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?=$_SESSION['loggedPlayerXp']?> XP</div>
            </div>
          </h5>
          
          
          NP Coins:
          <h5><img src="assets/images/coin.svg" width="25" /> $NP <?php echo number_format($_SESSION['loggedPlayerCoins'], 2, ',', '.');?></h5>
          <hr/>

          Conquiste mais pontos de experiência e NP Coins participando de Campeonatos e desafiando players em nossa plataforma.

          <br/><br/>
          
          <div align="center"> 
            <a href="perfil.php" class="btn btn-primary"><i class="fa fa-user"></i> Meu Perfil</a>
          </div> 

          <div align="right"> 
            <a href="controller/logoff.php" class="btn btn-sm"><i class="fa fa-sign-out"></i> Sair</a>
          </div>  
            
          </small>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-sm" data-bs-dismiss="modal"><i class="fa fa-times-circle"></i> Fechar</button>
          </div>
          </form>
        </div>
      </div>
    </div>

  <?php } ?>