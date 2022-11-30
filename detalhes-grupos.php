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

    <title>NEXT PLAYER - Plataforma Online de Campeonatos de e-Sports</title>
    
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
  <?php include "view/menu-top.php"; 

  if(isset($_SESSION['loggedId'])){

    $saudacao = $_SESSION['loggedPlayerName'];
  
  } else {
    $saudacao = "Jogador";
  }


  $bd = abreConn();

  // Dados do Campeonato
  $qC = mysqli_query($bd, "SELECT * from n_championship_p where id = '".$_GET['camp']."' and status = 'A' ");
  $rsC = mysqli_fetch_assoc($qC);

  if ($rsC['type'] == "MJ"){
    redirect("detalhes-grupos-mj.php?camp=".$rsC['id']);
  }

  if ($rsC['type'] == "XT"){
    $camp = "X-TREINO";
  } else {
    $camp = "Campeonato";
  }

  // Game
  $qG = mysqli_query($bd, "SELECT * from n_games_p where id = '".$rsC['game_id']."'");
  $rsG = mysqli_fetch_assoc($qG);

  // Organizador
  $qO = mysqli_query($bd, "SELECT * from n_organization_p where id = '".$rsC['organization_id']."'");
  $rsO = mysqli_fetch_assoc($qO);

  // FASE DO CAMPEONATO - Saber se ja ta na final
  $qCf = mysqli_query($bd, "SELECT * from n_championship_groups_p where championship_id = '".$rsC['id']."' and status = 'A' and final_stage_points > 0 ");
  $rsCf = mysqli_fetch_assoc($qCf);


  if ($rsC['solo_or_team'] == 'T'){

    // Verifica player logaddo ja participa de algum time deste jogo e que esta nesse camp
    $qTf = mysqli_query($bd, "SELECT * from n_team_formation_p where player_id = '".$_SESSION['loggedId']."' and status = 'A'" );
    while ($rsTf = mysqli_fetch_array($qTf)){

      if ($rsTf != NULL){
      $qTd = mysqli_query($bd, "SELECT * from n_team_p where id = '".$rsTf['team_id']."' and status = 'A' ");
      $rsTd = mysqli_fetch_assoc($qTd);
        if ($rsTd['game_id'] == $rsG['id']){
          $qualTimePlayer = $rsTd['id'];
        }  

      }

    }

  }


  ?>
  
  <!-- Sobre a Plataforma -->
  <section class="section video" data-section="section5">
    <div class="container">

      <div class="row hSection">
        <h3><img src="assets/images/iconeNormal.fw.png" height="30" /> 
          <strong>DEFINIÇÃO DE GRUPOS</strong>
          <hr/>
        </h3>
      </div>


      <?php 
        if ($rsC['id'] == 30){ 
          //mysqli_close($bd); 
          //die("<div class='alert alert-info'>O sorteio está sendo processado. Seja paciênte...</div>");
        } 
      ?>

      <div class="row">
        <div class="col-md-12 align-self-center">
          <div class="left-content">
            <h4>Olá, <em><?=$saudacao?></em> :)</h4>
            <p align="justify">
              Aqui você encontra a distribuição completa dos grupos do <?=$camp?> <strong class="hSection"><?=$rsC['title']?></strong>, organizado por <strong class="hSection"><?=$rsO['organization']?></strong>
            </p>

            <?php 

            // Dados in Game - LOGADO
            $qDgL = mysqli_query($bd, "SELECT * from n_player_game_info_p where player_id = '".$_SESSION['loggedId']."' and status = 'A' and game_id = '".$rsG['id']."' ");
            $rsDgL = mysqli_fetch_assoc($qDgL);

            if ($rsDgL == NULL){ ?>
              <a href="jogo-perfil.php?game=<?=$rsG['id']?>" class="btn btn-danger" style="margin: 10px;"> <strong>Informe aqui seu NICK e UID</strong> </a>
            <?php } ?>

            <?php
            // FASE DO CAMP
            if ($rsCf == NULL && $rsC['type'] != 'XT'){
            ?>
              <a href="detalhes-grupos-finalistas.php?camp=<?=$rsC['id']?>" class="btn btn-warning" style="margin: 10px;"> <strong>CLIQUE AQUI PARA LISTA DE FINALISTAS</strong> </a>
              <?php } ?> 

            <?php if ($rsCf != NULL && $rsC['type'] != 'XT'){ ?>  
              <a href="detalhes-grupos-podio.php?camp=<?=$rsC['id']?>" class="btn btn-warning" style="margin: 10px;"> <strong>CLIQUE AQUI PARA CLASSIFICAÇÃO FINAL</strong> </a>
            <?php } ?>

            <?php
            // XTREINO
            if ($rsCf == NULL && $rsC['type'] == 'XT'){
            ?>
              <!--<a href="organizations/qualifies/xt-<?=$rsC['id']?>/grupo-a-xtreino-<?=$rsC['id']?>-sem2.pdf" class="btn btn-warning" style="margin: 10px;" target="_Blank"> <strong>CLASSIFICAÇÂO GRUPO A</strong> </a>
              <a href="organizations/qualifies/xt-<?=$rsC['id']?>/grupo-b-xtreino-<?=$rsC['id']?>-sem2.pdf" class="btn btn-warning" style="margin: 10px;" target="_Blank"> <strong>CLASSIFICAÇÂO GRUPO B</strong> </a>-->
              <a href="detalhes-grupos-finalistas.php?camp=<?=$rsC['id']?>" class="btn btn-warning" style="margin: 10px;"> <strong>CLIQUE AQUI PARA LISTA DE FINALISTAS</strong> </a>
              <?php } ?> 

            <?php if ($rsCf != NULL && $rsC['type'] == 'XT'){ ?>  
              <a href="detalhes-grupos-podio.php?camp=<?=$rsC['id']?>" class="btn btn-warning" style="margin: 10px;"> <strong>CLIQUE AQUI PARA CLASSIFICAÇÃO FINAL</strong> </a>
            <?php } ?>

            <br/><br/>

            <?php // Verifica se player logado esta no camp
            if ($rsC['solo_or_team'] == 'S'){
              $qGl = mysqli_query($bd, "SELECT * from n_championship_groups_p where player_id = '".$_SESSION['loggedId']."' and status = 'A' and championship_id = '".$rsC['id']."' ");
              $rsGl = mysqli_fetch_assoc($qGl);

              if ($rsGl == NULL){ ?>
                <small>Você não confirmou participação neste Campeonato ou não fez login em sua conta. Se não confirmou, você pode pelo menos, assistir às partidas :)</small>
              <?php } else { ?>
                Você está no Grupo <strong class="badge badge-primary"><big><?=$rsGl['sorted_group']?></big></strong>
              <?php } ?>
            <?php } ?>


            <?php // Verifica se player logado esta no camp por algum time
            if ($rsC['solo_or_team'] == 'T'){
              $qGl = mysqli_query($bd, "SELECT * from n_championship_groups_p where championship_id = '".$rsC['id']."' and team_id = '".$qualTimePlayer."' and status = 'A' ");
              $rsGl = mysqli_fetch_assoc($qGl);

              if ($rsGl == NULL){ ?>
                <small>Você não confirmou participação neste Campeonato ou não fez login em sua conta. Se não confirmou, você pode pelo menos, assistir às partidas :)</small>
              <?php } else {
                // Pega o time do player para esse jogo 
                $qTl = mysqli_query($bd, "SELECT * from n_team_p where id = '".$qualTimePlayer."' and status = 'A' ");
                $rsTl = mysqli_fetch_assoc($qTl);
                ?>
                Seu time <strong class="hSection"><?=$rsTl['team']?></strong> está no Grupo <strong class="badge badge-primary"><big><?=$rsGl['sorted_group']?></big></strong>
              <?php } ?>
            <?php } ?> 

            <br/>
            
          </div>
        </div>
      </div>
      <br/>

      <div class="row" style="color:#fff;">
        <?php 
              /////////////////////////////////////
              ///////// SOLO //////////////////////
              /////////////////////////////////////
              if ($rsC['solo_or_team'] == 'S'){ ?>

                <div class="col-md-3 alert alert-info" style="margin-top: 10px;">
                  <h4 class="hSection"><strong>GRUPO A</strong></h4>
                  <br/>
                  <?php // Lista GRUPO A
                  $iA = 1;
                  $qGPA=  mysqli_query($bd, "SELECT * FROM n_championship_groups_p where status = 'A' and championship_id = '".$rsC['id']."' and sorted_group =  'A' order by key_headers desc ");
                  while ($rGPA = mysqli_fetch_array($qGPA)){ 

                  // Player
                  $qPA = mysqli_query($bd, "SELECT * from n_player_p where id = '".$rGPA['player_id']."' and status = 'A' ");
                  $rsPA = mysqli_fetch_assoc($qPA); 

                  // Dados in Game
                  $qDgA = mysqli_query($bd, "SELECT * from n_player_game_info_p where player_id = '".$rsPA['id']."' and status = 'A' and game_id = '".$rsG['id']."' ");
                  $rsDgA = mysqli_fetch_assoc($qDgA);

                  ?>

                  <?php if ($rGPA["player_id"] == $_SESSION["loggedId"]){
                    $class = "class='badge bg-primary' style='color:#fff;' ";
                  } else {
                    $class = "";
                  }
                  ?>

                  <?php if ($rsDgA == NULL){ ?>
                    <none class="badge bg-primary" style="color: #fff;">SLOT: <?=$iA?></none> | <span <?=$class?>><?=$rsPA['name']?></span>
                  <?php } else { ?>
                    <none class="badge bg-primary" style="color: #fff;">SLOT: <?=$iA?></none> | <span <?=$class?>><?=$rsDgA['player_nick_in_game']?></span>
                  <?php } ?> 
                  <?php if ($rGPA["player_id"] == $_SESSION["loggedId"]){?>
                    <strong class="badge bg-primary" style="color: #fff;">VOCÊ</strong>
                  <?php } ?> 
                  <br/>

                  <?php $iA++; } 


                  if ($rGPA == NULL){
                    echo("---");
                  }


                  ?>

                </div>


                <div class="col-md-3 alert alert-info" style="margin-top: 10px;">
                  <h4 class="hSection"><strong>GRUPO B</strong></h4>
                  <br/>
                  <?php // Lista GRUPO B
                  $iB = 1;
                  $qGPB=  mysqli_query($bd, "SELECT * FROM n_championship_groups_p where status = 'A' and championship_id = '".$rsC['id']."' and sorted_group =  'B' ");
                  while ($rGPB = mysqli_fetch_array($qGPB)){ 

                  // Player
                  $qPB = mysqli_query($bd, "SELECT * from n_player_p where id = '".$rGPB['player_id']."' and status = 'A' ");
                  $rsPB = mysqli_fetch_assoc($qPB); 

                  // Dados in Game
                  $qDgB = mysqli_query($bd, "SELECT * from n_player_game_info_p where player_id = '".$rsPB['id']."' and status = 'A' and game_id = '".$rsG['id']."' ");
                  $rsDgB = mysqli_fetch_assoc($qDgB);

                  ?>

                  <?php if ($rGPB["player_id"] == $_SESSION["loggedId"]){
                    $class = "class='badge bg-primary' style='color:#fff;' ";
                  } else {
                    $class = "";
                  }
                  ?>

                  <?php if ($rsDgB == NULL){ ?>
                    <none class="badge bg-primary" style="color: #fff;">SLOT: <?=$iB?></none> | <span <?=$class?>><?=$rsPB['name']?></span>
                  <?php } else { ?>
                    <none class="badge bg-primary" style="color: #fff;">SLOT: <?=$iB?></none> | <span <?=$class?>><?=$rsDgB['player_nick_in_game']?></span>
                  <?php } ?> 
                  <?php if ($rGPB["player_id"] == $_SESSION["loggedId"]){?>
                    <strong class="badge bg-primary" style="color: #fff;">VOCÊ</strong>
                  <?php } ?> 
                  <br/>

                  <?php $iB++; } ?>

                </div>


                <div class="col-md-3 alert alert-info" style="margin-top: 10px;">
                  <h4 class="hSection"><strong>GRUPO C</strong></h4>
                  <br/>
                  <?php // Lista GRUPO C
                  $iC = 1;
                  $qGPC=  mysqli_query($bd, "SELECT * FROM n_championship_groups_p where status = 'A' and championship_id = '".$rsC['id']."' and sorted_group =  'C' ");
                  while ($rGPC = mysqli_fetch_array($qGPC)){ 

                  // Player
                  $qPC = mysqli_query($bd, "SELECT * from n_player_p where id = '".$rGPC['player_id']."' and status = 'A' ");
                  $rsPC = mysqli_fetch_assoc($qPC); 

                  // Dados in Game
                  $qDgC = mysqli_query($bd, "SELECT * from n_player_game_info_p where player_id = '".$rsPC['id']."' and status = 'A' and game_id = '".$rsG['id']."' ");
                  $rsDgC = mysqli_fetch_assoc($qDgC);

                  ?>

                  <?php if ($rGPC["player_id"] == $_SESSION["loggedId"]){
                    $class = "class='badge bg-primary' style='color:#fff;' ";
                  } else {
                    $class = "";
                  }
                  ?>

                  <?php if ($rsDgC == NULL){ ?>
                    <none class="badge bg-primary" style="color: #fff;">SLOT: <?=$iC?></none> | <span <?=$class?>><?=$rsPC['name']?></span>
                  <?php } else { ?>
                    <none class="badge bg-primary" style="color: #fff;">SLOT: <?=$iC?></none> | <span <?=$class?>><?=$rsDgC['player_nick_in_game']?></span>
                  <?php } ?> 
                  <?php if ($rGPC["player_id"] == $_SESSION["loggedId"]){?>
                    <strong class="badge bg-primary" style="color: #fff;">VOCÊ</strong>
                  <?php } ?> 
                  <br/>

                  <?php $iC++; } ?>

                </div>


                <div class="col-md-3 alert alert-info" style="margin-top: 10px;">
                  <h4 class="hSection"><strong>GRUPO D</strong></h4>
                  <br/>
                  <?php // Lista GRUPO D
                  $iD = 1;
                  $qGPD=  mysqli_query($bd, "SELECT * FROM n_championship_groups_p where status = 'A' and championship_id = '".$rsC['id']."' and sorted_group =  'D' ");
                  while ($rGPD = mysqli_fetch_array($qGPD)){ 

                  // Player
                  $qPD = mysqli_query($bd, "SELECT * from n_player_p where id = '".$rGPD['player_id']."' and status = 'A' ");
                  $rsPD = mysqli_fetch_assoc($qPD); 

                  // Dados in Game
                  $qDgD = mysqli_query($bd, "SELECT * from n_player_game_info_p where player_id = '".$rsPD['id']."' and status = 'A' and game_id = '".$rsG['id']."' ");
                  $rsDgD = mysqli_fetch_assoc($qDgD);

                  ?>

                  <?php if ($rGPD["player_id"] == $_SESSION["loggedId"]){
                    $class = "class='badge bg-primary' style='color:#fff;' ";
                  } else {
                    $class = "";
                  }
                  ?>

                  <?php if ($rsDgD == NULL){ ?>
                    <none class="badge bg-primary" style="color: #fff;">SLOT: <?=$iD?></none> | <span <?=$class?>><?=$rsPD['name']?></span>
                  <?php } else { ?>
                    <none class="badge bg-primary" style="color: #fff;">SLOT: <?=$iD?></none> | <span <?=$class?>><?=$rsDgD['player_nick_in_game']?></span>
                  <?php } ?> 
                  <?php if ($rGPD["player_id"] == $_SESSION["loggedId"]){?>
                    <strong class="badge bg-primary" style="color: #fff;">VOCÊ</strong>
                  <?php } ?> 
                  <br/>

                  <?php $iD++; } ?>

                </div>

              
          <?php }?>
      </div>


      <div class="row" style="color:#fff;">
        <?php 
              /////////////////////////////////////
              ///////// TEAM //////////////////////
              /////////////////////////////////////
              if ($rsC['solo_or_team'] == 'T'){ ?>

                <div class="col-md-3 alert alert-info" style="margin-top: 10px;">
                  <h4 class="hSection"><strong>GRUPO A</strong></h4>
                  <br/>
                  <?php // Lista GRUPO A
                  $iA = 1;
                  $qGPA=  mysqli_query($bd, "SELECT * FROM n_championship_groups_p where status = 'A' and championship_id = '".$rsC['id']."' and sorted_group = 'A' order by key_headers desc ");
                  while ($rGPA = mysqli_fetch_array($qGPA)){ 

                  // Time
                  $qTA = mysqli_query($bd, "SELECT * from n_team_p where id = '".$rGPA['team_id']."' and status = 'A' ");
                  $rsTA = mysqli_fetch_assoc($qTA);

                  // Formacao
                  $qTfA = mysqli_query($bd, "SELECT * from n_team_formation_p where team_id = '".$rsTA['id']."' and player_id = '".$_SESSION['loggedId']."' and status = 'A' ");
                  $rsTfA = mysqli_fetch_assoc($qTfA);

                  ?>

                  <?php if ($rsTfA != NULL){
                    $class = "class='badge bg-primary' style='color:#fff;' ";
                  } else {
                    $class = "";
                  }
                  ?>

                  <img src="teams/<?=$rsTA['logo']?>" width='50' class='img img-thumbnail' /> <?//=$rsTA['id']?><br/>
                  <none class="badge bg-primary" style="color: #fff;">No.  <?=$iA?></none> | <span <?=$class?>><?=$rsTA['team']?> <small>(<strong><?=$rsTA['tag']?></strong>)</small></span>
                  <?php if ($rsTfA != NULL){?>
                    <strong class="badge bg-primary" style="color: #fff;">SEU SQUAD</strong>
                  <?php } ?> 
                  <hr/>

                  <?php $iA++; } 


                  if ($rGPA == NULL){
                    echo("--");
                  }


                  ?>

                </div>


                <div class="col-md-3 alert alert-info" style="margin-top: 10px;">
                  <h4 class="hSection"><strong>GRUPO B</strong></h4>
                  <br/>
                  <?php // Lista GRUPO B
                  $iB = 1;
                  $qGPB=  mysqli_query($bd, "SELECT * FROM n_championship_groups_p where status = 'A' and championship_id = '".$rsC['id']."' and sorted_group = 'B' order by key_headers desc ");
                  while ($rGPB = mysqli_fetch_array($qGPB)){ 

                  // Time
                  $qTB = mysqli_query($bd, "SELECT * from n_team_p where id = '".$rGPB['team_id']."' and status = 'A' ");
                  $rsTB = mysqli_fetch_assoc($qTB);

                  // Formacao
                  $qTfB = mysqli_query($bd, "SELECT * from n_team_formation_p where team_id = '".$rsTB['id']."' and player_id = '".$_SESSION['loggedId']."' and status = 'A' ");
                  $rsTfB = mysqli_fetch_assoc($qTfB);

                  ?>

                  <?php if ($rsTfB != NULL){
                    $class = "class='badge bg-primary' style='color:#fff;' ";
                  } else {
                    $class = "";
                  }
                  ?>

                  <img src="teams/<?=$rsTB['logo']?>" width='50' class='img img-thumbnail' /> <?//=$rsTB['id']?><br/>
                  <none class="badge bg-primary" style="color: #fff;">No. <?=$iB?></none> | <span <?=$class?>><?=$rsTB['team']?> <small>(<strong><?=$rsTB['tag']?></strong>)</small></span>
                  <?php if ($rsTfB != NULL){?>
                    <strong class="badge bg-primary" style="color: #fff;">SEU SQUAD</strong>
                  <?php } ?> 
                  <hr/>

                  <?php $iB++; } 


                  if ($rGPA == NULL){
                    echo("---");
                  }

                  ?>

                </div>

                <?php if ($rsC['type'] == 'XT'){
                  $sup = "- (Suplentes)";
                } ?>

                <div class="col-md-3 alert alert-info" style="margin-top: 10px;">
                  <h4 class="hSection"><strong>GRUPO C <small><small><?=$sup?></small></small></strong></h4>
                  <br/>
                  <?php // Lista GRUPO C
                  $iC = 1;
                  $qGPC=  mysqli_query($bd, "SELECT * FROM n_championship_groups_p where status = 'A' and championship_id = '".$rsC['id']."' and sorted_group = 'C' order by key_headers desc ");
                  while ($rGPC = mysqli_fetch_array($qGPC)){ 

                 // Time
                  $qTC = mysqli_query($bd, "SELECT * from n_team_p where id = '".$rGPC['team_id']."' and status = 'A' ");
                  $rsTC = mysqli_fetch_assoc($qTC);

                  // Formacao
                  $qTfC = mysqli_query($bd, "SELECT * from n_team_formation_p where team_id = '".$rsTC['id']."' and player_id = '".$_SESSION['loggedId']."' and status = 'A' ");
                  $rsTfC = mysqli_fetch_assoc($qTfC);

                  ?>

                  <?php if ($rsTfC != NULL){
                    $class = "class='badge bg-primary' style='color:#fff;' ";
                  } else {
                    $class = "";
                  }
                  ?>

                  <img src="teams/<?=$rsTC['logo']?>" width='50' class='img img-thumbnail' /> <?//=$rsTC['id']?><br/>
                  <none class="badge bg-primary" style="color: #fff;">No. <?=$iC?></none> | <span <?=$class?>><?=$rsTC['team']?> <small>(<strong><?=$rsTC['tag']?></strong>)</small></span>
                  <?php if ($rsTfC != NULL){?>
                    <strong class="badge bg-primary" style="color: #fff;">SEU SQUAD</strong>
                  <?php } ?> 
                  <hr/>

                  <?php $iC++; } 

                  if ($rGPA == NULL){
                    echo("---");
                  }

                  ?>

                </div>


                <div class="col-md-3 alert alert-info" style="margin-top: 10px;">
                  <h4 class="hSection"><strong>GRUPO D <small><small><?=$sup?></small></small></strong></h4>
                  <br/>
                  <?php // Lista GRUPO D
                  $iD = 1;
                  $qGPD=  mysqli_query($bd, "SELECT * FROM n_championship_groups_p where status = 'A' and championship_id = '".$rsC['id']."' and sorted_group = 'D' order by key_headers desc ");
                  while ($rGPD = mysqli_fetch_array($qGPD)){ 

                  // Time
                  $qTD = mysqli_query($bd, "SELECT * from n_team_p where id = '".$rGPD['team_id']."' and status = 'A' ");
                  $rsTD = mysqli_fetch_assoc($qTD);

                  // Formacao
                  $qTfD = mysqli_query($bd, "SELECT * from n_team_formation_p where team_id = '".$rsTD['id']."' and player_id = '".$_SESSION['loggedId']."' and status = 'A' ");
                  $rsTfD = mysqli_fetch_assoc($qTfD);

                  ?>

                  <?php if ($rsTfD != NULL){
                    $class = "class='badge bg-primary' style='color:#fff;' ";
                  } else {
                    $class = "";
                  }
                  ?>

                  <img src="teams/<?=$rsTD['logo']?>" width='50' class='img img-thumbnail' /> <?//=$rsTD['id']?><br/>
                  <none class="badge bg-primary" style="color: #fff;">No. <?=$iD?></none> | <span <?=$class?>><?=$rsTD['team']?> <small>(<strong><?=$rsTD['tag']?></strong>)</small></span>
                  <?php if ($rsTfD != NULL){?>
                    <strong class="badge bg-primary" style="color: #fff;">SEU SQUAD</strong>
                  <?php } ?> 
                  <hr/>

                  <?php $iD++; } 


                  if ($rGPA == NULL){
                    echo("---");
                  }


                  ?>

                </div>

              
          <?php }?>
      </div>

      <?php  mysqli_close($bd); ?>

      <a href="campeonatos-detalhes.php?id=<?=$rsC['id']?>" class="btn btn-secondary btn-sm" style="margin-top: 10px;"> <strong>Voltar</strong> </a>

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