<?php include "includes/functions.php";?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="iso-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="player, e-sports, game, next, nextplayer, cod, call, of, duty, mobile, freefire, fps, championship, campeonato, level, pes, fifa" />
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="shortcut icon" href="assets/images/favicon-novo.png" />

    <?php include "view/menu-top.php"; 

    if(isset($_SESSION['loggedId'])){

      $saudacao = $_SESSION['loggedPlayerName'];
    
    } else {
      $saudacao = "Jogador";
    }

    if(!isset($_GET['id'])){ redirect("campeonatos.php"); }

    ?>


    <?php $bd = abreConn();

    // Dados do Campeonato
    $qC = mysqli_query($bd, "SELECT * from n_championship_p where id = '".$_GET['id']."' and status = 'A' ");
    $rsC = mysqli_fetch_assoc($qC); 

    // Game
    $qG = mysqli_query($bd, "SELECT game, logo, console_type, id from n_games_p where id = '".$rsC['game_id']."'");
    $rsG = mysqli_fetch_assoc($qG);

    // Organizador
    $qO = mysqli_query($bd, "SELECT organization, logotype_url, description, broadcast_main_link from n_organization_p where id = '".$rsC['organization_id']."'");
    $rsO = mysqli_fetch_assoc($qO);

    ?>

    <?php if ($rsC['listed'] == 0){ ?>
      <title><?=$rsO['organization']?> - <?=$rsC['title']?></title>
    <?php } else { ?>
      <title>NEXT PLAYER - Plataforma Online de Campeonatos de e-Sports</title>
    <?php } ?>  
    
    <meta property="og:image" content="organizations/logos/<?=$rsO['logotype_url']?>">

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

  <?php 
  // Se campeonato ja estiver ENCERRADO
  if($rsC['current_status'] == 'F'){ 
    redirect("campeonatos-detalhes-finalizados.php?id=".$_GET['id']); 
  }

  // Verifica se e modalidade XTREINO
  if ($rsC['type'] == 'XT'){
    $type = 'X-TREINOS';
  } else {
    $type = 'CAMPEONATOS';
  }
?>


   
  <!--header-->
  
  <!-- Sobre a Plataforma -->
  <section class="section video" data-section="section5">
    <div class="container">

      <div class="row hSection">
        <h3> <img src="assets/images/iconeNormal.fw.png" height="30" /> <strong><?=$type?></strong><hr/></h3>
      </div>

      <div class="row">
        <div class="col-md-6 align-self-center">
          <div class="left-content">
            <img src="organizations/logos/<?=$rsO['logotype_url']?>" class="img img-thumbnail" width='100' />
            <h4><?=$rsC['title']?> <small><br/>Por <em><?=$rsO['organization']?></em></small></h4>

            <?php // Verifica se e FREE
            if ($rsC['subscription_value'] > 0 && $rsC['organization_id'] == 1){
              $textPremioMax = 'Prize Pool Máx.';
            } else {
              $textPremioMax = 'Prize Pool';
            } ?>

            <h4><small><?=$textPremioMax?></small> <none class="badge bg-success">R$ <?php echo number_format($rsC['gift_value'], 2, ',', '.');?></none>

              <?php 
              // Se for camp Normal com taxa, vair ter prize pool maximo e minimo
              if ($rsC['type'] != 'XT' && $rsC['subscription_value'] > 0 && $rsC['organization_id'] == 1){ ?>
              <br/>
              <small>Prize Pool Mín.</small> <none class="badge bg-secondary">R$ <?php echo number_format($rsC['gift_value']/2, 2, ',', '.');?></none>
              <?php } ?>

              <br/>
              <small><small>Taxa: R$ <?php echo number_format($rsC['subscription_value'], 2, ',', '.');?></small></small></h4>
            
            <p align="left">
              <big>
              <strong class="hSection">Jogo</strong>: <?=$rsG['game']?><br/>
              <strong class="hSection">Data</strong>: De <?php echo date("d/m/Y", strtotime($rsC['starts_at']));?> à <?php echo date("d/m/Y", strtotime($rsC['ends_at']));?><br/>

              <?php
              // Quantidade de Inscritos

              // Se for SOLO
              if ($rsC['solo_or_team'] == "S"){
              $qTc = mysqli_query($bd, "SELECT count(id) as totalConfirmados from n_championship_sub_p where championship_id = '".$_GET['id']."' and status =  'A' and payment_status = '1' ");
              $rsTc = mysqli_fetch_assoc($qTc); ?>
                <strong class="hSection">Quantidade Mínima</strong>: <?=$rsC['min_teams']?> Players<br/>
                <strong class="hSection">Quantidade Máxima</strong>: <?=$rsC['max_teams']?> Players<br/>
                <!--<strong class="hSection">Confirmados</strong>: <?=$rsTc['totalConfirmados']?> Players<br/>-->
              <?php } ?>

              <?php
              // Se for TIME
              if ($rsC['solo_or_team'] == "T"){
              $qTc = mysqli_query($bd, "SELECT COUNT(DISTINCT(team_id)) as totalConfirmados from n_championship_sub_p where championship_id = '".$_GET['id']."' and status =  'A' and payment_status = '1' ");
              $rsTc = mysqli_fetch_assoc($qTc); ?>
                <strong class="hSection">Quantidade Mínima</strong>: <?=$rsC['min_teams']?> Times<br/>
                <strong class="hSection">Quantidade Máxima</strong>: <?=$rsC['max_teams']?> Times<br/>
                <!--<strong class="hSection">Confirmados</strong>: <?=$rsTc['totalConfirmados']?> Times<br/>-->
              <?php } ?>


              <?php
              // Verifica se bateu a meta MAXIMA
              if ($rsTc['totalConfirmados'] == $rsC['max_teams'] && $rsC['sold_out'] != 'S'){
                $sqlUp = "UPDATE n_championship_p SET sold_out = 'S' WHERE id='".$rsC['id']."' ";
                mysqli_query($bd, $sqlUp);
                redirect("campeonatos-detalhes.php?id=".$rsC['id']);  
              }
              ?>
              
              <?php 
              // SE FOR STREAMER DA NEXT PLAYER
              if ($rsC['organization_id'] == 1){ ?>
                <strong class="hSection">Streamer / Transmissão</strong>:
                
                <?php if ($rsC['id'] != 28){ ?>
                <a href="<?=$rsO['broadcast_main_link']?>" target="_Blank"><br/>
                  <img src="assets/images/allanzinho-np.fw.png" width="80" /> 
                  <small>LIVE será aqui</small>
                </a>
                <?php } else { ?>
                <a href="https://www.youtube.com/c/Mans%C3%A3oCODMobile" target="_Blank"><br/> 
                  <small>Highlander</small>
                </a>
                <?php } ?>
                  
              <?php } else { ?>
                <strong class="hSection">Streamer / Transmissão</strong>:
                <a href="<?=$rsO['broadcast_main_link']?>" target="_Blank"><br/> 
                  <small>Link para Transmissão</small>
                </a>
              <?php } ?>

              <!-- ======= SORTEIO GRUPO =========== -->
              <?php 
              // SORTEIO SOLO
              if ($rsC['solo_or_team'] == "S"){ ?>
                <?php $qPg = mysqli_query($bd, "SELECT * from n_championship_groups_p where championship_id = '".$rsC['id']."' and player_id = '".$_SESSION['loggedId']."' and status = 'A' ");
                      $rsPg = mysqli_fetch_assoc($qPg);
                if ($rsPg == NULL){ ?>
                   
                <?php } else { ?>
                  <br/><br/>
                  <?php if ($rsPg['final_stage'] == 'F'){ ?>
                  <strong class="hSection">Você está no Grupo</strong>: <h4 class="badge bg-primary" style="margin: 0px;"><a href="detalhes-grupos-finalistas.php?camp=<?=$rsC['id']?>">FINAL</a></h4>
                  <?php } else { ?>
                    <strong class="hSection">Você está no Grupo</strong>: <h4 class="badge bg-primary" style="margin: 0px;"><?=$rsPg['sorted_group']?></h4>
                  <?php } ?>
                <?php } ?>

                <br/><br/>
                <small>
                      <strong class="hSection">GRUPOS</strong>:<br/>
                    <a href="detalhes-grupos.php?camp=<?=$rsC['id']?>" class="btn btn-warning btn-sm"><strong>GRUPOS / Classificação</strong></a>

                    <?php if(isset($_SESSION['loggedId'])){ 
                      // Dados in Game - LOGADO
                      $qDgL = mysqli_query($bd, "SELECT * from n_player_game_info_p where player_id = '".$_SESSION['loggedId']."' and status = 'A' and game_id = '".$rsG['id']."' ");
                      $rsDgL = mysqli_fetch_assoc($qDgL);

                      if ($rsDgL == NULL){?>
                      <a href="jogo-perfil.php?game=<?=$rsG['id']?>" class="btn btn-danger btn-sm"> <strong>Informe aqui NICK e UID</strong> </a>
                    <?php } else { ?>
                      <a href="jogo-perfil.php?game=<?=$rsG['id']?>" class="btn btn-danger btn-sm"> <strong>Atualize aqui NICK</strong> </a>
                    <?php } } ?>

                </small>

                  <?php if ($rsC['solo_or_team'] == "S" && $rsC['room_game_link'] != NULL && $rsPg['sorted_group'] == $rsC['group_opened_link'] /*&& $rsPg['final_stage'] == 'F'*/ ){ ?>
                   <br/><br/>
                  <strong class="hSection">SALA</strong>:<br/>
                  <a href="<?=$rsC['room_game_link']?>" target="_Blank" class="btn btn-warning btn-lg">
                    <strong>LINK DA SALA</strong>
                  </a>
                <?php } else { ?>
                  <br/><br/>
                    <strong class="hSection">SALA</strong>: <small>Link ainda não disponível...</small>
                <?php } ?>

              <?php } ?>    


              <?php 
              // SORTEIO TEAM
              if ($rsC['solo_or_team'] == "T"){ 

                $qualTimePlayer;

                // Verifica player logaddo ja participa de algum time deste jogo
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

                ?>
                <?php $qPg = mysqli_query($bd, "SELECT * from n_championship_groups_p where championship_id = '".$rsC['id']."' and team_id = '".$qualTimePlayer."' and status = 'A' ");
                      $rsPg = mysqli_fetch_assoc($qPg);
                if ($rsPg == NULL){ ?>
                  
                <?php } else { ?>
                  <br/><br/>
                  <?php if ($rsPg['final_stage'] == 'F'){ ?>
                  <strong class="hSection">Você está no Grupo</strong>: <h4 class="badge bg-primary" style="margin: 0px;"><a href="detalhes-grupos-finalistas.php?camp=<?=$rsC['id']?>">CLASSIFICADOS</a></h4>
                  <?php } else { ?>
                    <strong class="hSection">Você está no Grupo/Pote</strong>: <h4 class="badge bg-primary" style="margin: 0px;"><?=$rsPg['sorted_group']?></h4>
                  <?php } ?>
                <?php } ?>

                <br/><br/>
                <small>
                      <strong class="hSection">GRUPOS</strong>:<br/>
                    <a href="detalhes-grupos.php?camp=<?=$rsC['id']?>" class="btn btn-warning btn-sm"><strong>GRUPOS / Classificação</strong></a>

                    <?php if(isset($_SESSION['loggedId'])){ 
                      // Dados in Game - LOGADO
                      $qDgL = mysqli_query($bd, "SELECT * from n_player_game_info_p where player_id = '".$_SESSION['loggedId']."' and status = 'A' and game_id = '".$rsG['id']."' ");
                      $rsDgL = mysqli_fetch_assoc($qDgL);

                      if ($rsDgL == NULL){?>
                      <a href="jogo-perfil.php?game=<?=$rsG['id']?>" class="btn btn-danger btn-sm"> <strong>Informe aqui NICK e UID</strong> </a>
                    <?php } else { ?>
                      <a href="jogo-perfil.php?game=<?=$rsG['id']?>" class="btn btn-danger btn-sm"> <strong>Atualize aqui seu NICK</strong> </a>
                    <?php } } ?>

                </small>

                <?php // ============== SE FOR BR 
                if ($rsC['type'] == "BR"){?>
                  <?php if ($rsC['solo_or_team'] == "T" && $rsC['room_game_link'] != NULL /*&& $rsPg['sorted_group'] == $rsC['group_opened_link']*/ && $rsPg['final_stage'] == 'F' ){ ?>
                     <br/><br/>
                    <strong class="hSection">SALA</strong>:<br/>
                    <a href="<?=$rsC['room_game_link']?>" target="_Blank" class="btn btn-warning btn-lg">
                      <strong>LINK DA SALA</strong>
                    </a>
                  <?php } else { ?>
                    <br/><br/>
                    <strong class="hSection">SALA</strong>: <small>Link ainda não disponível...</small>
                  <?php } ?>
                <?php } ?>

                <?php // ============== SE FOR XTREINO 
                if ($rsC['type'] == "XT"){?>
                  <?php if ($rsC['solo_or_team'] == "T" && $rsC['room_game_link'] != NULL /*&& $rsPg['sorted_group'] == $rsC['group_opened_link']*/ && $rsPg['final_stage'] == 'F' ){ ?>
                     <br/><br/>
                    <strong class="hSection">SALA</strong>:<br/>
                    <a href="<?=$rsC['room_game_link']?>" target="_Blank" class="btn btn-warning btn-lg">
                      <strong>LINK DA SALA</strong>
                    </a>
                  <?php } else { ?>
                    <br/><br/>
                    <strong class="hSection">SALA</strong>: <small>Link ainda não disponível...</small>
                  <?php } ?>
                <?php } ?>

                <?php // =============== SE FOR MJ 
                if ($rsC['type'] == "MJ"){?>
                  <?php if ($rsC['solo_or_team'] == "T" && $rsC['room_game_link'] != NULL && ($qualTimePlayer == '' || $qualTimePlayer == '') /*&& $rsPg['final_stage'] == 'F'*/ ){ ?>
                     <br/><br/>
                    <strong class="hSection">SALA</strong>:<br/>
                    <a href="<?=$rsC['room_game_link']?>" target="_Blank" class="btn btn-warning btn-lg">
                      <strong>LINK DA SALA</strong>
                    </a>
                  <?php } else { ?>
                    <br/><br/>
                    <strong class="hSection">SALA</strong>: <small>Link ainda não disponível...</small>
                  <?php } ?>
                <?php } ?>


              <?php } ?>


              <!-- =============== FIM SORTEIO GRUPO ============== -->

              <br/><br/>
              <strong class="hSection">Maiores Detalhes</strong>: <span id="maioresDetalhes"><?=$rsC['resume']?></span>
              
              </big>
            </p>

            <hr/>

            <p>
              <?php if(isset($_SESSION['loggedId'])){ ?>
              
                <?php
                // Verifica se ja confirmou presenca neste camp 
                $qPc = mysqli_query($bd, "SELECT * from n_championship_sub_p where championship_id = '".$rsC['id']."' and player_id = '".$_SESSION['loggedId']."' and status = 'A' ");
                  $rsPc = mysqli_fetch_assoc($qPc);
                
                if ($rsPc == NULL){  
                ?>    
                  
                  <?php 
                  // Verifica se nao ta esgotado
                  if ($rsC['sold_out'] != "S" && $rsC['current_status'] == "A") {?>
                    <button id="btnAmareloConf" class="btn btn-warning" style="margin:10px;" data-bs-toggle="modal" data-bs-target="  #modalConfirmarParticipacao"><strong>PARTICIPAR</strong></button>
                    <a id="anchorVermelhoUploadCompPgto" class="btn btn-danger" href="campeonatos-enviar-comp-pgto.php?camp=<?=$rsC['id']?>" style="margin:10px; display: none;"><strong>PAGAR E ENVIAR COMP. PAGAMENTO</strong></a>
                    <button id="btnAzulConfirmado" class="btn btn-primary" style="margin:10px; display: none;" disabled="disabled"><strong>PARTICIPAÇÃO JÁ CONFIRMADA</strong></button>
                  <?php } else { ?>

                    <?php if ($rsC['current_status'] == "A"){ ?>
                      <button class="btn btn-danger" style="margin:10px;" disabled="disabled"><strong>INSCRIÇÕES ENCERRADAS</strong></button>
                    <?php } if ($rsC['current_status'] == "P"){ ?>
                      <button class="btn btn-success" style="margin:10px;"><strong>INSCRIÇÕES EM BREVE</strong></button>
                    <?php } ?>
                      
                  <?php } ?>  
                  

                <?php } else { // Se confirmou participacao ?>
                  
                  <?php if ($rsPc['payment_status'] == 0){ // Confirmou, mas precisa enviar o comp ?>
                    <a class="btn btn-danger" href="campeonatos-enviar-comp-pgto.php?camp=<?=$rsC['id']?>" style="margin:10px;"><strong>PAGAR E ENVIAR COMP. PAGAMENTO</strong></a>
                  <?php } ?>
                  <?php if ($rsPc['payment_status'] == 1){ // Participacao confirmada. Tudo OK ?>
                    <button class="btn btn-primary" style="margin:10px;" disabled="disabled"><strong>PARTICIPAÇÃO JÁ CONFIRMADA</strong></button>
                  <?php } ?>
                  <?php if ($rsPc['payment_status'] == 2){ // Enviou comp e esta aguardando aprovacao da org ?>
                    <button class="btn btn-warning" disabled="disabled" style="margin:10px;"><strong>AGUARDANDO CONFIRMAÇÃO</strong></button>
                  <?php } ?>

                <?php } ?>  

              <?php } else {?>
              
                <?php if ($rsC['current_status'] == 'A'){ // Verifica se ta EM ANDAMENTO?>  
                  <button class="btn btn-warning" style="margin:10px;" data-bs-toggle="modal" data-bs-target="#modalEntrar"><strong>PARTICIPAR</strong></button>
                <?php } ?>
                <?php if ($rsC['current_status'] == 'P'){ // Verifica se ta PREVISTO ?>  
                  <button class="btn btn-success" style="margin:10px;"><strong>INSCRIÇÕES EM BREVE</strong></button>
                <?php } ?>
              
              <?php } ?>
                
              <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalRegulamento" style="margin:10px;"><strong>REGULAMENTO</strong></button>
            </p>

            <p>
              <hr/>
              <a href="campeonatos.php" style="margin: 10px;"><i class="fa fa-trophy"></i> Campeonatos</a>
            </p>

            <p>
              <hr/>
              <a href="perfil.php" style="margin: 10px;"><i class="fa fa-user"></i> Meu Perfil</a>
            </p>

            <?php 

            $temTimeNesteJogo = false;
            $qualTime;

            // Verifica player logaddo ja participa de algum time deste jogo
            $qTf = mysqli_query($bd, "SELECT * from n_team_formation_p where player_id = '".$_SESSION['loggedId']."' and status = 'A'" );
            while ($rsTf = mysqli_fetch_array($qTf)){

              if ($rsTf != NULL){
              $qTd = mysqli_query($bd, "SELECT * from n_team_p where id = '".$rsTf['team_id']."' and status = 'A' ");
              $rsTd = mysqli_fetch_assoc($qTd);
              if ($rsTd['game_id'] == $rsG['id']){
                $temTimeNesteJogo = true;
                $qualTime = $rsTd['id'];
              }  

            } 

            if ($rsTd['game_id'] == $rsG['id']){ ?>
            <input type="hidden" id="meuSquad" value="<?=$qualTime?>" />
            <?php } } ?>

            <?php mysqli_close($bd); ?>
              
            
            
          </div>
        </div>
        <div class="col-md-6">
          <article class="video-item">
            <div class="video-caption">
              <h4>Seja um Campeão!</h4>
            </div>
            <figure>
              <img src="assets/images/champions-frame.jpg" width="50%">
            </figure>
            <br/>
          </article>
        </div>
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


  <!-- Modal -->
  <div class="modal fade" id="modalConfirmarParticipacao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <strong><?=$type?></strong><img src="assets/images/iconeNormal.fw.png" height="30" />
        </div>

        <div class="modal-body">
         
          <big><strong><?=$rsC['title']?></strong></big>
           <br/>
           Prêmio Máximo: R$ <?php echo number_format($rsC['gift_value'], 2, ',', '.');?><br/>
           Taxa de Inscrição: R$ <?php echo number_format($rsC['subscription_value'], 2, ',', '.');?><br/>
           Início: <?php echo date("d/m/Y", strtotime($rsC['starts_at']));?> às <?=$rsC['starts_at_time']?><br/>
           <small>Ao confirmar sua participação você declara que lê e concorda com o regulamento.</small>
         
         <hr/>
         <small id="bodyCamp">
         
         <?php if ($rsC['subscription_free'] == "S"){ ?>

         <?php } ?>

         <?php if ($rsC['subscription_free'] == "N"){ ?>
         <h5><strong>SEGUIR PARA PAGAMENTO</strong></h5> 
         Após confirmar, efetue o pagamento da taxa de R$ <strong><?php echo number_format($rsC['subscription_value'], 2, ',', '.');?></strong> e envie o comprovante para a organização <strong><?=$rsO['organization']?></strong>, através do botão vermelho que irá aparer nesta página. Se o líder do seu time já efetuou o pagamento, você não precisa enviar novamente.
         <?php } ?>

         </small>
        </div>
        <div class="modal-footer">
          
          <?php 
          // Se campeonato for TIMExTIME e o cara ja tiver uma lINE
          if ($rsC['solo_or_team'] == 'T' && $temTimeNesteJogo) {?>
          <button id="botaoConfirmCamp" type="button" class="btn btn-primary" onclick="confirmarCamp(<?=$rsC['id']?>, <?=$_SESSION['loggedId']?>, '<?=$rsC['solo_or_team']?>')"><i class="fa fa-gamepad"></i> Confirmar</button>
          <div id="loadingPartCamp" style="display: none;">
            <small><i class="fa fa-spinner fa-spin"></i> Carregando...</small>
          </div>
        <?php } ?>

        <?php 
          // Se campeonato for TIMExTIME e o cara NAO tiver uma lINE
          if ($rsC['solo_or_team'] == 'T' && !$temTimeNesteJogo) {?>
          <div class="alert"><small><strong class="text-danger">IMPORTANTE</strong>:<br/>Você ainda não possui um Time de <strong><?=$rsG['game']?></strong>... Se você não for o líder, peça para ele criar o time e lhe convidar. <br/><br/>Se você for o líder, pode criar seu time clicando botão abaixo: <br/><br/> <a href="criar-time.php" class="btn btn-warning"><strong>MONTAR LINE/TIME</strong></a> </small></div>
        <?php } ?>


        <?php 
          // Se campeonato for SOLO
          if ($rsC['solo_or_team'] == 'S') {?>
          <button id="botaoConfirmCamp" type="button" class="btn btn-primary" onclick="confirmarCamp(<?=$rsC['id']?>, <?=$_SESSION['loggedId']?>, '<?=$rsC['solo_or_team']?>')"><i class="fa fa-gamepad"></i> Confirmar</button>
          <div id="loadingPartCamp" style="display: none;">
            <small><i class="fa fa-spinner fa-spin"></i> Carregando...</small>
            <input type="hidden" id="meuSquad" value="0" />
          </div>
        <?php } ?>

        <button type="button" id="btnFecharConf" class="btn btn-sm" data-bs-dismiss="modal" style="display: none;"><i class="fa fa-times-circle"></i> Fechar</button>

        </div>
        </form>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modalRegulamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <strong>REGULAMENTO</strong><img src="assets/images/iconeNormal.fw.png" height="30" />
        </div>
        
        <div class="modal-body">
        <?=$rsC['rules']?>
        </div>  
        
        <div class="modal-footer" id="entendidoReg">
          <button type="button" class="btn btn-sm" data-bs-dismiss="modal"><i class="fa fa-times-circle"></i> Fechar</button>
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

          if ($("#meuSquad").val() == null){
            $("#bodyCamp").hide();
          }

          // Atualiza a cada 3 MIN
          setTimeout(function(){ location.reload(); }, 180000);

        });
    </script>
</body>
</html>