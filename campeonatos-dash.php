<?php include "includes/functions.php";?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="player, e-sports, game, next, nextplayer, cod, call, of, duty, mobile, freefire, fps, championship, campeonato, level, pes, fifa" />
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="shortcut icon" href="assets/images/favicon-novo.png" />

    <?php include "view/menu-top.php"; 

    if(!isset($_GET['camp'])){ redirect("campeonatos.php"); }

    ?>


    <?php $bd = abreConn();

    // Dados do Campeonato
    $qC = mysqli_query($bd, "SELECT * from n_championship_p where id = '".$_GET['camp']."' and status = 'A' ");
    $rsC = mysqli_fetch_assoc($qC); 

    // Game
    $qG = mysqli_query($bd, "SELECT * from n_games_p where id = '".$rsC['game_id']."'");
    $rsG = mysqli_fetch_assoc($qG);

    // Organizador
    $qO = mysqli_query($bd, "SELECT * from n_organization_p where id = '".$rsC['organization_id']."'");
    $rsO = mysqli_fetch_assoc($qO);

    ?>

    <?php if ($rsC['listed'] == 0){ ?>
      <title><?=$rsO['organization']?> - <?=$rsC['title']?></title>
    <?php } else { ?>
      <title>NEXT PLAYER - Plataforma Online de Campeonatos de e-Sports</title>
    <?php } ?>
    
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-grad-school.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <link rel="stylesheet" href="assets/css/geral.css?<?=$versao?>">

  </head>

<body>

   
  <!--header-->
  <?php 
  // Se o player logado NAO for o organizador, nao deixa visualizar
  if ($rsO['player_id_owner'] != $_SESSION['loggedId']){
    redirect("campeonatos.php");
  } ?>


  <input type="hidden" id="solorOrTeam" value="<?=$rsC['solo_or_team']?>">
  
  <!-- Sobre a Plataforma -->
  <section class="section video" data-section="section5">
    <div class="container">

      <div class="row hSection">
        <h3><img src="assets/images/iconeNormal.fw.png" height="30" /> <strong>DASHBOARD</strong> - <?=$rsC['title']?><hr/></h3>
      </div>

      <div class="row">
        <div class="col-md-12 align-self-center">
          <div class="left-content">
            <h4>Olá, <em><?=$rsO['organization']?></em> :)</h4>
            <p align="justify">
              Aqui você acompanha em tempo real, as inscrições no seu campeonato <strong class="hSection"><?=$rsC['title']?></strong>:
            </p>
            
          </div>
        </div>
      </div>

      <?php 

      // Verifica se ja houve sorteio de grupos
      $qSg = mysqli_query($bd, "SELECT * from n_championship_groups_p where championship_id = '".$rsC['id']."' and status = 'A' ");
      $rsSg = mysqli_fetch_assoc($qSg);

      if ($rsSg == NULL){ // Se NAO TIVER SORTEADO habilita o botao
      ?>
        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalSortearGrupos"><strong><i class="fa fa-random"></i> SORTEAR GRUPOS</strong></button>
      <?php } else { ?>
        <button class="btn btn-warning btn-sm" disabled="disabled"><strong><i class="fa fa-random"></i> SORTEAR GRUPOS</strong></button>
      <?php } ?>  

      <a class="btn btn-secondary btn-sm" href="organizacao.php?org=<?=$rsC['organization_id']?>"><strong> Voltar</strong></a>

      <?php /* GERAR SALA */ if ($rsC['type'] == "XT" || $rsC['type'] == "BR"){?>
        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalAbrirSala"><strong><i class="fa fa-sign-in"></i> ABRIR SALA</strong></button>
      <?php } ?>

      <?php if (isset($_GET['salaSucesso']) && isset($_GET['grupo']) && $_GET['salaSucesso'] == "ok"){?>
        <hr/>
        <div class="alert alert-success">
          <i class="fa fa-check-circle"></i> Sala Criada com sucesso para o <strong>GRUPO <?=$_GET['grupo']?></strong>!
        </div>
      <?php } ?>
      <?php if (isset($_GET['salaSucesso']) && $_GET['salaSucesso'] == "erro"){?>
        <hr/>
        <div class="alert alert-danger">
          <i class="fa fa-exclamation-triangle"></i> Erro ao criar a sala!
        </div>
      <?php } ?>

      <hr/>

      <?php /* TOTAL ARRECADADO */ if ($rsC['subscription_free'] == "N"){?>
        <?php
          $qTa = mysqli_query($bd, "SELECT SUM(payment_value) as totalArrecadado from n_championship_sub_p where championship_id = '".$rsC['id']."' and payment_status = '1' and status = 'A' ");
          $rsTa = mysqli_fetch_assoc($qTa);        
        ?>
        <h5 style="color:#fff;"><!--Total Arrcadado: <?=$rsTa['totalArrecadado']?>--></h5>
      <?php } ?>
      <hr/>

      <div class="row" style="color:#fff;">
        <?php  

              // SE FOR TEAM
              if ($rsC['solo_or_team'] == "T"){

                $count = 0;

                // Lista Times
                $qTf=  mysqli_query($bd, "SELECT distinct(team_id) FROM n_championship_sub_p where status = 'A' and championship_id = '".$rsC['id']."' order by team_id ");
                while ($rsTf = mysqli_fetch_array($qTf)){ 


                  // Dados dos times
                  $qT = mysqli_query($bd, "SELECT * from n_team_p where id = '".$rsTf['team_id']."'");
                  $rsT = mysqli_fetch_assoc($qT);

                  // Lider
                  $qL = mysqli_query($bd, "SELECT * from n_player_p where id = '".$rsT['leader_id']."'");
                  $rsL = mysqli_fetch_assoc($qL);

                  // Dados Pagamento time
                  $qDp = mysqli_query($bd, "SELECT * from n_championship_sub_p where team_id = '".$rsTf['team_id']."' and championship_id = '".$_GET['camp']."' and status = 'A' limit 0,1 ");
                  $rsDp = mysqli_fetch_assoc($qDp);                                    

                  if ($rsDp['payment_status'] == 1){ // Confirmado

                    // Pega o GRUPO se ja tiver sorteado
                    $qTg = mysqli_query($bd, "SELECT * from n_championship_groups_p where championship_id = '".$rsC['id']."' and team_id = '".$rsT['id']."' and status = 'A' ");
                    $rsTg = mysqli_fetch_assoc($qTg);

                    if ($rsTg == NULL){
                      $statusPgto = "<strong class='hSection'>CONFIRMADO</strong>";
                    } else {

                      if ($rsTg['final_stage'] == 'F'){ // Se foi pra Final
                        $statusPgto = "<strong class='hSection'>CONFIRMADO<br><small>GRUPO ".$rsTg['sorted_group']."</small></strong> <br/><button class='btn btn-danger btn-sm' onclick='chamaModalPontuacaoFinal(".$rsT['id'].", ".$rsC['id'].")'><i class='fa fa-crosshairs'></i> FN</button>";
                      } else {
                        $statusPgto = "<strong class='hSection'>CONFIRMADO<br><small>GRUPO ".$rsTg['sorted_group']."</small></strong> <br/><button class='btn btn-primary btn-sm' onclick='chamaModalPontuacaoGrupos(".$rsT['id'].", ".$rsC['id'].")'><i class='fa fa-crosshairs'></i> FG</button>";
                      }
                    }

                  } 
                  if ($rsDp['payment_status'] == 0){ // Aguardando Pagamento 
                    $statusPgto = "<strong class='text-danger'>NÃO PAGO</strong>";
                  }
                  if ($rsDp['payment_status'] == 2){ // Aguardando Confirmacao da Organizacao
                    $statusPgto = "<strong class='text-primary'>COMPROVANTE ENVIADO</strong><br/><a href='comppgto/".$rsDp['comp_uploaded']."' target='_Blanck' class='btn btn-warning'><i class='fa fa-file'></i></a> | <button data-bs-toggle='modal' data-bs-target='#modalConfPgtoTime-".$rsDp['team_id']."' target='_Blanck' class='btn btn-warning'><i class='fa fa-check-circle'></i></button>";
                  }

                  $count++;

                ?>  
                  <div class="col-md-3 alert" align="center">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalPlayersTime-<?=$rsT['id']?>">
                      <img width="100" src="teams/<?=$rsT['logo']?>" class="img img-thumbnail" />
                    </a> - <?=$rsT['id']?><br/>
                    <strong><?=$count?> | <?=$rsT['team']?> - <?=$rsT['tag']?></strong>
                    <br/>
                    Líder: <?=$rsL['name']?><br/><small><?=$rsL['email']?></small><br/>
                    <?=$statusPgto?>
                    <?php if($rsDp['comp_uploaded'] != NULL){ ?>
                      <br/><a href="comppgto/<?=$rsDp['comp_uploaded']?>" target="Blank"><i class="fa fa-eye"></i></a>
                    <?php } ?>
                  </div>

                  <!-- Modal -->
                  <div class="modal fade" id="modalConfPgtoTime-<?=$rsDp['team_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #000;">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <strong>CONFIRMAR PAGAMENTO</strong><img src="assets/images/iconeNormal.fw.png" height="30" />
                        </div>

                        <div class="modal-body" id="bodyModalTime-<?=$rsDp['team_id']?>">
                           <small>
                           <big>Deseja confirmar o Pagamento do time <strong><?=$rsT['team']?></strong>?</big>
                           <br/>
                         </small>
                        </div>

                        <div class="modal-footer">

                          <button id="btnConfPgtoTime-<?=$rsDp['team_id']?>" type="button" class="btn btn-primary btn-sm" onclick="confirmarCompPgtoTime(<?=$rsC['id']?>, <?=$rsDp['team_id']?>)"><i class="fa fa-check-circle"></i> Confirmar</button> <button type="button" data-bs-dismiss="modal" class="btn btn-secondary btn-sm" ><i class="fa fa-arrow-circle-left"></i> Voltar</button>
                          
                          <div id="loadingConfirCompEnvioTime-<?=$rsDp['team_id']?>" style="display: none;"><small><i class="fa fa-spinner fa-spin"></i> Carregando...</small></div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal PLAYERS POR TIME -->
                  <div class="modal fade" id="modalPlayersTime-<?=$rsT['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #000;">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <strong>ESCALAÇÃO DESTE TIME</strong><img src="assets/images/iconeNormal.fw.png" height="30" />
                        </div>

                        <div class="modal-body">
                        <small>
                           <div class="form-group">
                            <?php
                            $countP = 1; 
                            $sql1 = mysqli_query($bd, "SELECT * from n_team_formation_p where team_id = '".$rsT['id']."' and status = 'A'");
                            while ($rs1 = mysqli_fetch_array($sql1)){

                            if ($rs1 != NULL){ 
                              $qL1 = mysqli_query($bd, "SELECT * from n_player_p where id = '".$rs1['player_id']."'");
                              $rsL1 = mysqli_fetch_assoc($qL1);

                              $qDg = mysqli_query($bd, "SELECT * from n_player_game_info_p where player_id = '".$rsL1['id']."' and status = 'A' and game_id = '".$rsG['id']."' ");
                              $rsDg = mysqli_fetch_assoc($qDg);
                            ?>

                            <?php 
                            if ($countP == 1){
                              $classP = 'primary';
                            } else {
                              $classP = 'dark';
                            }
                            ?>

                            <?php if ($rsDg == NULL){ // Nao informou NICK?>
                              <strong class="text-<?=$classP?>"><i class='fa fa-user'></i> <?=$rsL1['name']?><br/></strong>
                            <?php } ?>

                            <?php if ($rsDg != NULL){ // Informou NICK?>
                              <strong class="text-<?=$classP?>"><i class='fa fa-user'></i> <?=$rsDg['player_nick_in_game']?></strong> 
                              (<?=$rsL1['name']?>)
                              <br/>
                            <?php } ?>  
                              
                            <?php } $countP++; } ?>

                           </div>
                         </small>
                        </div>
                        <div class="modal-footer">
                          <button type="button" data-bs-dismiss="modal" class="btn btn-secondary btn-sm" ><i class="fa fa-arrow-circle-left"></i> Voltar</button>
                        </div>
                      </div>
                    </div>
                  </div>

                <?php }

              }


              // SE FOR SOLO
              if ($rsC['solo_or_team'] == "S"){

                $count = 0;

                $qTf=  mysqli_query($bd, "SELECT * FROM n_championship_sub_p where status = 'A' and championship_id = '".$rsC['id']."' order by id desc ");
                while ($rsTf = mysqli_fetch_array($qTf)){

                  // Dados do player
                  $qP = mysqli_query($bd, "SELECT * from n_player_p where id = '".$rsTf['player_id']."'");
                  $rsP = mysqli_fetch_assoc($qP);

                  if ($rsTf['payment_status'] == 1){ // Confirmado
                    
                    // Pega o GRUPO se ja tiver sorteado
                    $qPg = mysqli_query($bd, "SELECT * from n_championship_groups_p where championship_id = '".$rsC['id']."' and player_id = '".$rsP['id']."' and status = 'A' ");
                    $rsPg = mysqli_fetch_assoc($qPg);

                    if ($rsPg == NULL){
                      $statusPgto = "<strong class='hSection'>CONFIRMADO</strong>";
                    } else {

                      if ($rsPg['final_stage'] == 'F'){ // Se foi pra Final
                        $statusPgto = "<strong class='hSection'>CONFIRMADO<br><small>GRUPO ".$rsPg['sorted_group']."</small></strong> <br/><button class='btn btn-danger btn-sm' onclick='chamaModalPontuacaoFinal(".$rsP['id'].", ".$rsC['id'].")'><i class='fa fa-crosshairs'></i> FN</button>";
                      } else {
                        $statusPgto = "<strong class='hSection'>CONFIRMADO<br><small>GRUPO ".$rsPg['sorted_group']."</small></strong> <br/><button class='btn btn-primary btn-sm' onclick='chamaModalPontuacaoGrupos(".$rsP['id'].", ".$rsC['id'].")'><i class='fa fa-crosshairs'></i> FG</button>";
                      }
                    }

                  } 
                  if ($rsTf['payment_status'] == 0){ // Aguardando Pagamento 
                    $statusPgto = "<strong class='text-danger'>NÃO PAGO</strong>";
                  }
                  if ($rsTf['payment_status'] == 2){ // Aguardando Confirmacao da Organizacao
                    $statusPgto = "<strong class='text-primary'>COMPROVANTE ENVIADO</strong><br/><a href='comppgto/".$rsTf['comp_uploaded']."' target='_Blanck' class='btn btn-warning'><i class='fa fa-file'></i></a> | <button data-bs-toggle='modal' data-bs-target='#modalConfPgtoSolo-".$rsP['id']."' target='_Blanck' class='btn btn-warning'><i class='fa fa-check-circle'></i></button>";
                  }


                  $count++;

                  // Dados in Game
                  $qDg = mysqli_query($bd, "SELECT * from n_player_game_info_p where player_id = '".$rsP['id']."' and status = 'A' and game_id = '".$rsG['id']."' ");
                  $rsDg = mysqli_fetch_assoc($qDg);

                ?>

                <?php if ($rsDg != NULL){ ?>

                <div class="col-md-3 alert" align="center">
                    <img width="100" src="assets/images/avatar-1.fw.png" class="img img-thumbnail" /> - <?=$rsP['id']?><br/>
                    <strong><?=$count?> | <?=$rsDg['player_nick_in_game']?><br/><small><?=$rsP['name']?></small></strong><br/><small><?=$rsP['email']?></small>
                    <br/>
                    <?=$statusPgto?>
                    <?php if($rsTf['comp_uploaded'] != NULL){ ?>
                      <br/><a href="comppgto/<?=$rsTf['comp_uploaded']?>" target="Blank"><i class="fa fa-eye"></i></a>
                    <?php } ?>
                  </div>

                <?php } else { ?>

                  <div class="col-md-3 alert" align="center">
                    <img width="100" src="assets/images/avatar-1.fw.png" class="img img-thumbnail" /> - <?=$rsP['id']?><br/>
                    <strong><?=$count?> | <?=$rsP['name']?><br/>Sem NICK</strong><br/><small><?=$rsP['email']?></small>
                    <br/>
                    <?=$statusPgto?>
                    <?php if($rsTf['comp_uploaded'] != NULL){ ?>
                      <br/><a href="comppgto/<?=$rsTf['comp_uploaded']?>" target="Blank"><i class="fa fa-eye"></i></a>
                    <?php } ?>
                  </div>       

                <?php } ?>  


                  <!-- Modal -->
                  <div class="modal fade" id="modalConfPgtoSolo-<?=$rsP['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color:#000;">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <strong>CONFIRMAR PAGAMENTO</strong><img src="assets/images/iconeNormal.fw.png" height="30" />
                        </div>

                        <div class="modal-body" id="bodyModalSolo-<?=$rsP['id']?>">
                           <small>
                           <?php if ($rsDg != NULL){ ?>
                            <big>Deseja confirmar o Pagamento do Player <strong><?=$rsDg['player_nick_in_game']?></strong>?</big>
                           <?php } else { ?>
                            <big>Deseja confirmar o Pagamento do Player <strong><?=$rsP['name']?></strong>?</big>
                           <?php } ?>                          
                           <br/>
                         </small>
                        </div>

                        <div class="modal-footer">
                          
                            <button type="button" class="btn btn-primary btn-sm" onclick="confirmarCompPgtoSolo(<?=$rsC['id']?>, <?=$rsP['id']?>)" id="btnConfPgtoSolo-<?=$rsP['id']?>"><i class="fa fa-check-circle"></i> Confirmar</button> <button type="button" data-bs-dismiss="modal" class="btn btn-secondary btn-sm" ><i class="fa fa-arrow-circle-left"></i> Voltar</button>
                          
                          <div id="loadingConfirCompEnvioSolo-<?=$rsP['id']?>" style="display: none;"><small><i class="fa fa-spinner fa-spin"></i> Carregando...</small></div>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>


                <?php }  

              }

              mysqli_close($bd);

              ?>
      </div>

    </div>
  </section>

  <?php include "view/footer.php" ?>


  <div class="cookie-container" align="center">
    <small>Usamos cookies para melhorar a sua experiência. Ao navegar neste site, você concorda com a nossa <a class="link" href="politica-cookies.php" style="text-decoration: underline;">Política de Cookies</a>.
    </small>

    <button class="cookie-btn">
      Ok, concordo!
    </button>
  </div>


  <!-- Modal SORTEAR GRUPOS -->
  <div class="modal fade" id="modalSortearGrupos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <strong>SORTEAR GRUPOS</strong><img src="assets/images/iconeNormal.fw.png" height="30" />
        </div>

        <div class="modal-body">
        <small>
           <div class="form-group" id="bodyModalSorteio">
            <label>Informe a Quantidade de Grupos</label>
              <select class="form-control" id="qntdGrupos" name="qntdGrupos">
                <option value="">Selecione</option>
                <option value="1">1 Grupo (Único)</option>
                <option value="2">2 Grupos (A e B)</option>
              </select>
              <small id="msnErroQntdGrupos" style="display: none" class="text-danger">Informe a quantidade de Grupos</small>
            </div>
         </small>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnSortearGrupo" class="btn btn-primary btn-sm" onclick="validaSorteio(<?=$rsC['id']?>, '<?=$rsC['solo_or_team']?>')"><i class="fa fa-random"></i> Sortear</button> <button type="button" data-bs-dismiss="modal" class="btn btn-secondary btn-sm" ><i class="fa fa-arrow-circle-left"></i> Voltar</button>
          <div id="loadingSorteio" style="display: none;">
            <small>
              <i class="fa fa-spinner fa-spin"></i> Carregando...
            </small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal ABRIR SALA -->
  <div class="modal fade" id="modalAbrirSala" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <strong>ABRIR SALA</strong><img src="assets/images/iconeNormal.fw.png" height="30" />
        </div>

        <div class="modal-body" id="bodyModalSolo">
           <small>
           <form method="post" action="controller/abrir-sala.php" id="formAbrirSala">
           <input type="hidden" id="campIdHidden" name="campIdHidden" class="form-control" value="<?=$rsC['id']?>">
           <input type="text" id="linkSala" name="linkSala" class="form-control" placeholder="Link da Sala">
           <small class="text-danger" id="msnErroLinkSala" style="display: none;">Informe o Link</small>
           <br/>
           <select class="form-control" id="grupoLiberado" name="grupoLiberado">
             <option value="">Escolha o Grupo</option>
             <option value="A">A</option>
             <option value="B">B</option>
             <option value="C">C</option>
             <option value="D">D</option>
           </select>
           <small class="text-danger" id="msnErroGrupoLiberado" style="display: none;">Informe o Grupo</small>
           <br/>
         </small>

         <div class="alert alert-success" id="msnSuccessSalaAberta" style="display: none;"><small><i class="fa fa-check-circle"></i> Sala Criada com Sucesso</small></div>
        </div>

        <div class="modal-footer">
          
            <button type="button" class="btn btn-success btn-sm" onclick="abrirSala()"><i class="fa fa-check-circle"></i> Abrir Sala</button> 

            <?php if ($rsC['room_game_link'] != ""){ ?>
            <button type="button" class="btn btn-danger btn-sm" onclick="fecharSala(<?=$rsC['id']?>)"><i class="fa fa-exclamation-triangle"></i> Fechar Sala</button>
            <?php } ?>

            <button type="button" data-bs-dismiss="modal" class="btn btn-secondary btn-sm" ><i class="fa fa-arrow-circle-left"></i> Voltar</button>
          
          <div id="loadingAbrirSala" style="display: none;"><small><i class="fa fa-spinner fa-spin"></i> Carregando...</small></div>
        </div>
        </form>
      </div>
    </div>
  </div>


  <!-- Modal PONTUACAO -->
  <div class="modal fade" id="modalPontuacaoCamp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <strong>INSERIR PONTUAÇÃO</strong><img src="assets/images/iconeNormal.fw.png" height="30" />
        </div>

        <div class="modal-body" id="bodyModalSolo">
           <strong class="text-primary" id="textoFase"></strong><hr/>
           <small>
           <input type="number" id="valorPontuacao" class="form-control" placeholder="Pontos">
           <small class="text-danger" id="msnErroPontos" style="display: none;">Informe a Pontuação</small>
           <br/>
           <input type="number" id="valorKills" class="form-control" placeholder="Kills">
           <small class="text-danger" id="msnErroKills" style="display: none;">Informe as Kills</small>
           <br/>
         </small>

         <div class="alert alert-primary" id="msnSuccessPoints"><small>Pontuação Adicionada com Sucesso</small></div>
        </div>

        <div class="modal-footer">
          
            <button type="button" class="btn btn-primary btn-sm" id="btnPontuar"><i class="fa fa-check-circle"></i> Confirmar</button> <button type="button" data-bs-dismiss="modal" class="btn btn-secondary btn-sm" ><i class="fa fa-arrow-circle-left"></i> Voltar</button>
          
          <div id="loadingPontuacao" style="display: none;"><small><i class="fa fa-spinner fa-spin"></i> Carregando...</small></div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/bootstrap.min.js?<?=$versao?>"></script>
    <script src="vendor/jquery/jquery-3.5.1.min.js?<?=$versao?>" crossorigin="anonymous"></script>

    <script src="assets/js/isotope.min.js?<?=$versao?>"></script>
    <script src="assets/js/owl-carousel.js?<?=$versao?>"></script>
    <script src="assets/js/lightbox.js?<?=$versao?>"></script>
    <script src="assets/js/tabs.js?<?=$versao?>"></script>
    <script src="assets/js/video.js?<?=$versao?>"></script>
    <script src="assets/js/slick-slider.js?<?=$versao?>"></script>
    <script src="assets/js/custom.js?<?=$versao?>"></script>
    <script src="assets/js/web-app.js?<?=$versao?>"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .scroll-to-section').on('click', 'a', function (e) {
          if($(e.target).hasClass('external')) {
            return;
          }
          e.preventDefault();
          $('#menu').removeClass('active');
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });


        function abaReg(mode){

          $("#entendidoReg").show();

          if (mode == 'BR-SOLO'){
            $("#brSquadModal").hide();
            $("#mjSquadModal").hide();
            $("#brSoloModal").show(500);
          }
          if (mode == 'BR-SQUAD'){
            $("#brSoloModal").hide();
            $("#mjSquadModal").hide();
            $("#brSquadModal").show(500);
          }
          if (mode == 'MJ-SQUAD'){
            $("#brSquadModal").hide();
            $("#brSoloModal").hide();
            $("#mjSquadModal").show(500);
          }

        }

        function showDivRegister(){
          $("#DivRegisterCont").hide();
          $("#divRegister").show(500);
          $("#btnCriarConta").show(500);
        }

        function champDetalhes(champ){
          window.location.href = "campeonatos-detalhes.php?id="+champ;
        }


        function fecharSala(champ){
          $("#loadingAbrirSala").show();
          window.location.href = "controller/fechar-sala.php?camp="+champ;
        }


        const cookieContainer = document.querySelector(".cookie-container");
        const cookieButton = document.querySelector(".cookie-btn");

        cookieButton.addEventListener("click", () => {
          cookieContainer.classList.remove("active");
          localStorage.setItem("cookieBannerDisplayed", "true");
        });

        setTimeout(() => {
          if (!localStorage.getItem("cookieBannerDisplayed")) {
            cookieContainer.classList.add("active");
          }
        }, 1000);

        $( document ).ready(function() {

          $("#btnModal").click();
          //$("#btnModal").html("Nada");

        });
    </script>
</body>
</html>