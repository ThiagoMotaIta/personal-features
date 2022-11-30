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

    <link rel="shortcut icon" href="https://nextplayer.com.br/assets/images/iconeNormal.fw.png" />

    <title>NEXT PLAYER - Plataforma Online de Campeonatos de e-Sports</title>

    <meta property="og:image" content="assets/images/">
    
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-grad-school.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <link rel="stylesheet" href="assets/css/geral.css?<?=$versao?>">
<!--
    
TemplateMo 557 Grad School

https://templatemo.com/tm-557-grad-school

-->
  </head>

<body>

   
  <!--header-->
  <?php include "view/menu-top.php" ?>

  <?php include "view/main-banner.php" ?>  

  <?php include "view/home-games.php" ?>

  <?php include "view/home-championship-main.php" ?>
  
  <!-- Sobre a Plataforma -->
  <section class="section video" data-section="section5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 align-self-center">
          <div class="left-content">
            <span>A Tecnologia <em class="hSection">BLOCKCHAIN</em> e as <em class="hSection">$NP Coins</em></span>
            <h4>A NEXT PLAYER utiliza a tecnologia <em>BLOCKCHAIN</em></h4>
            <p align="justify">Como forma de segurança e imutabilidade dos dados de nossos usuários/players, nossa plataforma utiliza a tecnologia Blockchain também no armanezamento de todo o histórico de pontuações e ganhos de cada jogador. Temos a nossa própria <strong class="hSection">moeda virtual, a $NP Coins</strong>, onde cada jogador poderá acumulá-las após vencer adversários em partidas organizadas dentro da plataforma ou por cumprir etapas específicas, também dentro da Plataforma NEXT PLAYER (<u>gamification</u>).
            <br><br>O jogador também poderá trocar as $NPs por produtos e serviços oferecidos na plataforma (produtos gamers, inscrições em campeonatos e muito mais).
            <br/><br/>
            A NEXT PLAYER utiliza a rede Etherium Classic no armazenamento de seus dados sensíveis
            </p>
            <div class="main-button" style="display: none;"><a rel="nofollow" href="#" target="_parent">External URL</a></div>
          </div>
        </div>
        <div class="col-md-6">
          <article class="video-item">
            <div class="video-caption">
              <h4>NEXT PLAYER + Tecnologia BLOCKCHAIN</h4>
            </div>
            <figure>
              <a href="https://www.youtube.com/watch?v=ByjjS4OoFpk" class="play"><img src="assets/images/blockChain.jpg"></a>
            </figure>
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

  <!-- Button trigger modal -->
  <button type="button" id="btnModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAtencaoCamp" style="display: none;">
    Modal Abertura login
  </button>

  <!-- Modal abertura -->
  <div class="modal fade" id="modalAtencaoCamp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <strong>SE LIGA, JOGADOR!!</strong><img src="assets/images/iconeNormal.fw.png" height="30" />
        </div>

        <div class="modal-body" align="justify">

          <p align="center"><img src="assets/images/codHorizontal.fw.png" class="img img-circle" width="150" /><br/>Mobile</p>

          <br/>

          <h4 align="center"><strong>FASE FINAL<br/><span class="text-primary">BR SOLO</span></strong></h4> 
          <br/>  

          <p align="center">  
            <a href="detalhes-grupos-finalistas.php?camp=1" class="btn btn-primary"><i class="fa fa-gamepad"></i> Verificar Finalistas</a> 
          </p>

          <span id="mnsAguard"></span>
          
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm" data-bs-dismiss="modal">Ver isso depois</button>
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


        function chamaModalLogin(){
          $('#modalAtencaoCamp').modal('toggle');
          $('#modalEntrar').modal('toggle');
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

          if ($('#logadoHidden').val() == null){
            $("#btnModal").click();
          }

        });
    </script>
</body>
</html>