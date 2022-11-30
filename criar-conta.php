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
    <link rel="stylesheet" href="assets/css/geral.css">

  </head>

<body>

   
  <!--header-->
  <?php include "view/menu-top.php" ?>

  <!-- Verifica se tá logado (nesse caso, nao pode estar logado) -->
  <?php if(isset($_SESSION['loggedId'])){ redirect("./"); }?>
  
  <!-- Sobre a Plataforma -->
  <section class="section video" data-section="section5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 align-self-center">
          <div class="left-content">
            <h4>Fala aí, <em><?=$_GET['player']?></em> :)</h4>
            <p align="justify">
              Estamos quase lá... Agora, é preciso que você <strong style="color: #f5a425;">CRIE UMA SENHA</strong> para sua conta NEXT PLAYER, para poder confirmar sua participação no campeonato de <strong>CALL OF DUTY - MOBILE</strong>. Guarde sua senha e seu e-mail, pois serão com eles que você fará login em nossa plataforma:
              <form id="formNovaConta" action="controller/criar-nova-conta.php" method="POST">
                <input type="hidden" id="nameRegPreInsc" name="nameRegPreInsc" value="<?=$_GET['player']?>">
              
                <input type="hidden" id="emailRegPreInsc" name="emailRegPreInsc" value="<?=$_GET['email']?>">
             
                <input type="hidden" id="emailRegPreInscConfirm" name="emailRegPreInscConfirm" value="<?=$_GET['email']?>">
              
              <div class="form-group">
                <input type="password" class="form-control" id="passWordRegPreInsc" name="passWordRegPreInsc" placeholder="Crie uma Senha">
                <small id="msnErroPassWordReg" style="display: none" class="text-danger">Informe uma senha</small>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="passWordRegPreInscConfirm" name="passWordRegPreInscConfirm" placeholder="Confirme sua Senha">
                <small id="msnErroPassWordRegConfirm" style="display: none" class="text-danger">Senhas diferentes</small>

                <button type="button" class="btn btn-warning btn-sm main-button" onclick="validarNovaConta()"><strong>CRIAR CONTA</strong></button> 
                  <br/>
                  <div id="loadingCriarContaPreInsc" style="display: none;"><small><i class="fa fa-spinner fa-spin"></i> Carregando...</small></div>
             </form>

             <div>
              <br/>
              <small>Cconfira nossos <strong><a href="termos.pdf" target="_Blank" class="link" style="color:#ffc107;">Termos de Uso</a></strong></small>
            </div>

              </div>
            </p>
          </div>
        </div>
        <div class="col-md-6">
          <article class="video-item">
            <div class="video-caption">
              <h4>Falta pouco, Soldado!</h4>
            </div>
            <figure>
              <img src="assets/images/boaSorte.jpg" width="50%">
            </figure>
            <br/>
          </article>
          <small><span style="color:#fff;">Você pode acessar os nossos</span> <a href="termos.pdf" target="_Blank" class="link">Termos de Uso</a></small>
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