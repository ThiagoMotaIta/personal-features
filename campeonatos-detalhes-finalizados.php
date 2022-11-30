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
  // Se campeonato nao estiver ENCERRADO
  if($rsC['current_status'] == 'A' || $rsC['current_status'] == 'P'){ 
    redirect("campeonatos-detalhes.php?id=".$_GET['id']); 
  }
?>


<?php 
  // Se campeonato NAO estiver ENCERRADO
  if($rsC['current_status'] == 'A'){ 
    redirect("campeonatos-detalhes.php?id=".$_GET['id']); 
  }
?>
   
  <!--header-->
  
  <!-- Sobre a Plataforma -->
  <section class="section video" data-section="section5">
    <div class="container">

      <div class="row hSection">
        <h3> <img src="assets/images/iconeNormal.fw.png" height="30" /> <strong>CAMPEONATOS</strong><hr/></h3>
      </div>

      <div class="row">
        <div class="col-md-6 align-self-center">
          <div class="left-content">
            <img src="organizations/logos/<?=$rsO['logotype_url']?>" class="img img-thumbnail" width='100' />
            <h4>
              <?=$rsC['title']?><br/><small><none class="badge bg-success">ENCERRADO </none></small> 
              <small><br/>Por <em><?=$rsO['organization']?></em></small>
            </h4>

            <h4><small>Premiação Máxima</small> <none class="badge bg-primary">R$ <?php echo number_format($rsC['gift_value'], 2, ',', '.');?></none><br/><small><small>Taxa: R$ <?php echo number_format($rsC['subscription_value'], 2, ',', '.');?></small></small></h4>
            
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
                <strong class="hSection">Players Confirmados</strong>: <?=$rsTc['totalConfirmados']?><br/>
              <?php } ?>

              <?php
              // Se for TIME
              if ($rsC['solo_or_team'] == "T"){
              $qTc = mysqli_query($bd, "SELECT COUNT(DISTINCT(team_id)) as totalConfirmados from n_championship_sub_p where championship_id = '".$_GET['id']."' and status =  'A' and payment_status = '1' ");
              $rsTc = mysqli_fetch_assoc($qTc); ?>
                <strong class="hSection">Times Confirmados</strong>: <?=$rsTc['totalConfirmados']?><br/>
              <?php } ?>

              <!--
              <strong class="hSection">Streamer / Transmissão</strong>:
              <a href="<?=$rsO['broadcast_main_link']?>" target="_Blank"><br/>
                <img src="assets/images/narradorGodZyla07.fw.png" width="80" /> 
                <small>LIVE será aqui <img src="assets/images/twitch-tv-logo.png" width="20" /></small>
              </a>-->
              
              <!-- ======= SORTEIO GRUPO =========== -->
              <?php 
              // SORTEIO SOLO
              if ($rsC['solo_or_team'] == "S"){ ?>
                <?php $qPg = mysqli_query($bd, "SELECT * from n_championship_groups_p where championship_id = '".$rsC['id']."' and player_id = '".$_SESSION['loggedId']."' and status = 'A' ");
                      $rsPg = mysqli_fetch_assoc($qPg);
                if ($rsPg == NULL){ ?>
                   
                <?php } else { ?>
                  <br/><br/>
                  <strong class="hSection">Você participou do Grupo</strong>: <h4 class="badge bg-primary" style="margin: 0px;"><?=$rsPg['sorted_group']?></h4>
                <?php } ?>

                <br/><br/>
                <small>
                      <strong class="hSection">GRUPOS</strong>:<br/>
                    <a href="detalhes-grupos.php?camp=<?=$rsC['id']?>" class="btn btn-warning btn-sm"><strong>Consultar GRUPOS</strong></a>

                    <?php if(isset($_SESSION['loggedId'])){ 
                      // Dados in Game - LOGADO
                      $qDgL = mysqli_query($bd, "SELECT * from n_player_game_info_p where player_id = '".$_SESSION['loggedId']."' and status = 'A' and game_id = '".$rsG['id']."' ");
                      $rsDgL = mysqli_fetch_assoc($qDgL);

                      if ($rsDgL == NULL){?>
                      <a href="jogo-perfil.php?game=<?=$rsG['id']?>" class="btn btn-danger btn-sm"> <strong>Informe aqui NICK e UID</strong> </a>
                    <?php } }?>

                </small>

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
                  <strong class="hSection">Seu time participou do Grupo</strong>: <h4 class="badge bg-primary" style="margin: 0px;"><?=$rsPg['sorted_group']?></h4>
                <?php } ?>

                <br/><br/>
                <small>
                      <strong class="hSection">GRUPOS</strong>:<br/>
                    <a href="detalhes-grupos.php?camp=<?=$rsC['id']?>" class="btn btn-warning btn-sm"><strong>Consultar GRUPOS</strong></a>

                    <?php if(isset($_SESSION['loggedId'])){ 
                      // Dados in Game - LOGADO
                      $qDgL = mysqli_query($bd, "SELECT * from n_player_game_info_p where player_id = '".$_SESSION['loggedId']."' and status = 'A' and game_id = '".$rsG['id']."' ");
                      $rsDgL = mysqli_fetch_assoc($qDgL);

                      if ($rsDgL == NULL){?>
                      <a href="jogo-perfil.php?game=<?=$rsG['id']?>" class="btn btn-danger btn-sm"> <strong>Informe aqui NICK e UID</strong> </a>
                    <?php } }?>

                </small>
              <?php } ?>


              <!-- =============== FIM SORTEIO GRUPO ============== -->

              <br/><br/>
              <strong class="hSection">Maiores Detalhes</strong>: <span id="maioresDetalhes"><?=$rsC['resume']?></span>
              
              </big>
            </p>

            <hr/>

            <p>                
              <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalRegulamento"><strong>REGULAMENTO</strong></button>
            </p>

            <p>
              <hr/>
              <a href="campeonatos.php" style="margin: 10px;"><i class="fa fa-trophy"></i> Campeonatos</a>
            </p>

            <p>
              <hr/>
              <a href="perfil.php" style="margin: 10px;"><i class="fa fa-user"></i> Meu Perfil</a>
            </p>

            

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

        });
    </script>
</body>
</html>