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
  <?php include "view/menu-top.php" ?>


  <?php if (!isset($_SESSION['loggedId'])) { redirect("./"); } ?>

  
  <!-- Sobre a Plataforma -->
  <section class="section video" data-section="section5">
    <div class="container">

      <div class="row hSection">
        <h3> <img src="assets/images/iconeNormal.fw.png" height="30" /> <strong>PERFIL</strong><hr/></h3>
      </div>

      <div class="row">
        <div class="col-md-6 align-self-center">
          <div class="left-content">

            <div class="row">
              <div class="col-md-4">
                <img  width="120" src="assets/images/avatar-1.fw.png" class="img" />
                <br/>
                <br/>
                  <small><a href="editar-perfil.php" class="btn btn-sm btn-primary" style="margin: 5px;"><i class="fa fa-plus-circle"></i> Mais Dados</small></a>
                  <small><a href="editar-perfil.php" class="btn btn-sm btn-primary" style="margin: 5px; display: none;"><i class="fa fa-pencil"></i> Mudar Senha</small></a>  
                
              </div>  

              <div class="col-md-8">   
                <h4><?=$_SESSION['loggedPlayerName']?></h4>
                <p align="justify">
                  <strong class="hSection">LEVEL</strong>: <?=strtoupper($_SESSION['loggedPlayerLevel'])?><br/>
                  <strong class="hSection">PONTOS DE EXPERIÊNCIA</strong>: <?=$_SESSION['loggedPlayerXp']?> XP<br/>
                  <strong class="hSection">NP COINS</strong>: $NP <?php echo number_format($_SESSION['loggedPlayerCoins'], 2, ',', '.');?><br/>  
                </p>
              </div>
            </div>

            <hr/>

            <p>
              <strong class="hSection">MEUS TIMES</strong>:<br/>
              
              <div class="row">
              <!-- Dados do TIME -->
              <?php

              $bd = abreConn();

              $qTm = mysqli_query($bd, "SELECT * from n_team_formation_p where player_id = '".$_SESSION['loggedId']."' and status = 'A' ");
            
              
                  while ($rs = mysqli_fetch_array($qTm)){

                  //Time
                  $qT = mysqli_query($bd, "SELECT * from n_team_p where id = '".$rs['team_id']."' ");
                  $rsT = mysqli_fetch_assoc($qT);

                  //Game
                  $qG = mysqli_query($bd, "SELECT * from n_games_p where id = '".$rsT['game_id']."'");
                  $rsG = mysqli_fetch_assoc($qG);

                  //Líder
                  $qL = mysqli_query($bd, "SELECT * from n_player_p where id = '".$rsT['leader_id']."'");
                  $rsL = mysqli_fetch_assoc($qL);

              ?>
                  <div class="col-md-4" align="center">
                    <a href="time-perfil.php?time=<?=$rsT['id']?>" style="color: #fff;">
                      <img class="img img-thumbnail" width="100" height="150" src="teams/<?=$rsT['logo']?>" />
                      <br/>
                      <small>
                        <big><strong><?=strtoupper ($rsT['tag'])?> <?=strtoupper ($rsT['team'])?></strong></big> <br/><?=$rsG['game']?>
                      </small>
                    </a>
                  </div>
              
              <?php } ?>
             </div>

             <?php
             // Verifica se player tem alguma organizacao 
             $qO = mysqli_query($bd, "SELECT * from n_organization_p where player_id_owner = '".$_SESSION['loggedId']."' and status = 'A' ");
             $rsO = mysqli_fetch_assoc($qO);

             if ($rsO != NULL){
             ?>
             <br/>
             <p>
              <strong class="hSection">MINHAS ORGANIZAÇÕES</strong>:<br/>
              
              <div class="row">
              <!-- Dados da ORGANIZAÇÃO -->
              <?php

              $qOr = mysqli_query($bd, "SELECT * from n_organization_p where player_id_owner = '".$_SESSION['loggedId']."' and status = 'A' ");
            
              
                  while ($rsOr = mysqli_fetch_array($qOr)){

              ?>
                  <div class="col-md-4" align="center">
                    <a href="organizacao.php?org=<?=$rsOr['id']?>" style="color: #fff;">
                      <img class="img img-thumbnail" width="100" height="150" src="organizations/logos/<?=$rsOr['logotype_url']?>" />
                      <br/>
                      <small>
                        <big><strong><?=strtoupper ($rsOr['organization'])?></strong></big>
                      </small>
                    </a>
                  </div>
              
              <?php } ?>
             </div>
           <?php }  mysqli_close($bd);?>


             <p>
              <hr/>
                <a href="criar-time.php" class="btn btn-warning btn-sm" style="margin: 10px;"><i class="fa fa-plus-circle"></i> <strong>CRIAR NOVO TIME</strong></a>
                <a href="campeonatos.php" class="btn btn-warning btn-sm" style="margin: 10px;"><i class="fa fa-search"></i> <strong>BUSCAR CAMPEONATOS</strong></a>
            </p>
            
            </p>
          </div>
        </div>
        <div class="col-md-6">
          <article class="video-item">
            <div class="video-caption">
              <h4>O Brabo tem nome!</h4>
            </div>
            <figure>
              <img src="assets/images/perfil-frame.jpg" width="50%">
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

          $("#btnModal").click();
          //$("#btnModal").html("Nada");

        });
    </script>
</body>
</html>