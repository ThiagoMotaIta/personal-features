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
    <link rel="stylesheet" href="assets/css/geral.css">

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
        <h3><img src="assets/images/iconeNormal.fw.png" height="30" /> <strong>X-TREINOS</strong><hr/></h3>
      </div>

      <div class="row">
        <div class="col-md-6 align-self-center">
          <div class="left-content">
            <h4>Olá, <em><?=$saudacao?></em> :)</h4>
            <p align="justify">
              Aqui, você encontra todos os X-TREINOS disponíveis em nossa plataforma.
              <br/><br/>
              <strong class="hSection">O MELHOR DE TUDO</strong>: Participando dos X-TREINOS, você acumula Pontos de Experiência, $NPs (a moeda virtual da plataforma NEXT PLAYER) e Pontos para o <strong class="hSection">RANNKING NEXT PLAYER</strong>. Dahora, não?!
            </p>

            <hr/>

            <h5>X-TREINOS EM ANDAMENTO</h5>

            <div align="center" class="row">

              <?php $bd = abreConn();

              // Lista os Campeonatos
              $q=  mysqli_query($bd, "SELECT * FROM n_championship_p where status = 'A' and listed = 1 and current_status = 'A' and type = 'XT' order by id desc ");
              
              while ($rs = mysqli_fetch_array($q)){ 

                // Game
                $qG = mysqli_query($bd, "SELECT game, logo, console_type from n_games_p where id = '".$rs['game_id']."'");
                $rsG = mysqli_fetch_assoc($qG);

                // Organizador
                $qO = mysqli_query($bd, "SELECT organization, logotype_url, description from n_organization_p where id = '".$rs['organization_id']."'");
                $rsO = mysqli_fetch_assoc($qO); ?>
                
                <div class="col-md-3 btn btn-primary" style="margin: 5px;" onclick="champDetalhesFinalizados(<?=$rs['id']?>)">
                  <img width="100" src="assets/images/<?=$rsG['logo']?>"/>
                  <br/>
                  <small><?=$rs['title']?></small>
                </div>

              <?php } ?>
              
            </div>

            <hr/>

            <h5>X-TREINOS FINALIZADOS</h5>

            <div align="center" class="row">

              <?php $bd = abreConn();

              // Lista os Campeonatos
              $q=  mysqli_query($bd, "SELECT * FROM n_championship_p where status = 'A' and listed = 1 and current_status = 'F' and type = 'XT' order by id desc ");
              
              while ($rs = mysqli_fetch_array($q)){ 

                // Game
                $qG = mysqli_query($bd, "SELECT game, logo, console_type from n_games_p where id = '".$rs['game_id']."'");
                $rsG = mysqli_fetch_assoc($qG);

                // Organizador
                $qO = mysqli_query($bd, "SELECT organization, logotype_url, description from n_organization_p where id = '".$rs['organization_id']."'");
                $rsO = mysqli_fetch_assoc($qO); ?>
                
                <div class="col-md-3 btn btn-primary" style="margin: 5px;" onclick="champDetalhes(<?=$rs['id']?>)">
                  <img width="100" src="assets/images/<?=$rsG['logo']?>"/>
                  <br/>
                  <small><?=$rs['title']?></small>
                </div>

              <?php } ?>
              
            </div>

            
          </div>
        </div>
        <div class="col-md-6">
          <article class="video-item">
            <div class="video-caption">
              <h4>Bora treinar, parça?!</h4>
            </div>
            <figure>
              <img src="assets/images/xtreino-frame.jpg" width="50%">
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

        function champDetalhes(champ){
          window.location.href = "campeonatos-detalhes.php?id="+champ;
        }


        function champDetalhesFinalizados(champ){
          window.location.href = "campeonatos-detalhes-finalizados.php?id="+champ;
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