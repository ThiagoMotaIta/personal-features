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

  ?>
  
  <!-- Sobre a Plataforma -->
  <section class="section video" data-section="section5">
    <div class="container">

      <div class="row hSection">
        <h3><img src="assets/images/iconeNormal.fw.png" height="30" /> <strong>LIGAS</strong><hr/></h3>
      </div>

      <div class="row">
        <div class="col-md-6 align-self-center">
          <div class="left-content">
            <h4>Olá, <em><?=$saudacao?></em> :)</h4>
            <p align="justify">
              Aqui, você encontra todos as ligas disponíveis em nossa plataforma.
              <br/><br/>
              <strong class="hSection">O MELHOR DE TUDO</strong>: Participando das ligas, você acumula Postos de Experiência e $NPs (a moeda virtual da plataforma NEXT PLAYER). Dahora, não?!
            </p>

            <div align="center" class="row">

              <div class="col-md-12 btn btn-primary alert">
                Em breve, esta opção estará disponível... Aguarde!
              </div>
              
            </div>

            <p>
              <hr/>
              <a href="campeonatos.php" class="btn btn-warning btn-sm" style="margin: 10px;"><i class="fa fa-search"></i> <strong>BUSCAR CAMPEONATOS</strong></a>
            </p>
            
          </div>
        </div>
        <div class="col-md-6">
          <article class="video-item">
            <div class="video-caption">
              <h4>mostre quem manda!</h4>
            </div>
            <figure>
              <img src="assets/images/valorant3-frame.jpg" width="50%">
            </figure>
            <br/>
          </article>
        </div>
      </div>

      <div class="row" style="color:#fff;">
        <?php 

        $bd = abreConn(); 

        $qCs=  mysqli_query($bd, "SELECT * FROM n_championship_groups_p where status = 'A' and championship_id = 29 and final_stage = 'F' /*and sorted_group in ('B')*/ order by id ");

        $count = 1;
        while ($rsCs = mysqli_fetch_array($qCs)){ 

          $qP = mysqli_query($bd, "SELECT * from n_team_formation_p where team_id = '".$rsCs['team_id']."'");
          while ($rsP = mysqli_fetch_array($qP)){

            // Dados Time
            $qT = mysqli_query($bd, "SELECT * from n_team_p where id = '".$rsCs['team_id']."' and status = 'A' ");
            $rsT = mysqli_fetch_assoc($qT);

            // Dados jogadores
            $qP1 = mysqli_query($bd, "SELECT * from n_player_p where id = '".$rsP['player_id']."' and status = 'A' ");
            $rsP1 = mysqli_fetch_assoc($qP1);


            if ($rsP1['id'] == $rsT['leader_id']){



          ?>

          <?=$rsP1['email']?>,<br/>

        <?php $count++; } } }

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