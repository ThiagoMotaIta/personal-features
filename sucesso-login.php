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

  <?php $bd = abreConn(); ?>
   
  <!--header-->
  <?php include "view/menu-top.php" ?>

  <!-- Verifica se tá logado -->
  <?php if(!isset($_SESSION['loggedId'])){ redirect("./"); }?>
  
  <!-- Sobre a Plataforma -->
  <section class="section video" data-section="section5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 align-self-center">
          <div class="left-content">
            <h4>Bem-vindo(a) de volta, <em><?=$_SESSION['loggedPlayerName']?></em> :)</h4>
            <p align="justify">
              Sempre bom revê-lo(a) por aqui... Então, qual a pedida para hoje?? 
            </p>

            <p>
              <h5>Destaques</h5>

              <a href="campeonatos-detalhes.php?id=30">
              <img src="organizations/banners/30-solo-v-3.jpg" class="img img-thumbnail" width="250" style="margin-top: 10px;"></a>

              <a href="campeonatos-detalhes.php?id=31">
              <img src="organizations/banners/31-camp.jpg" class="img img-thumbnail" width="250" style="margin-top: 10px;"></a>

            </p>

            <p>
              <a href="campeonatos.php" class="btn btn-warning" style="margin:10px;"><strong>BUSCAR CAMPEONATOS</strong></a>
              <a href="disputas.php" class="btn btn-warning" style="margin:10px;"><strong>ARENA NEXT PLAYER</strong></a>
              <a href="perfil.php" class="btn btn-primary" style="margin:10px;"><strong>VER MEU PERFIL</strong></a>
            </p>
          </div>
        </div>
        <div class="col-md-6">
          <article class="video-item">
            <div class="video-caption">
              <h4>Boa diversão!</h4>
            </div>
            <figure>
              <img src="assets/images/lol-frame-2.jpg" width="50%">
            </figure>
            <br/>
          </article>
        </div>
      </div>
    </div>
  </section>


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

          <?php  
          // Dados do Campeonato
          $qC = mysqli_query($bd, "SELECT * from n_championship_p where room_game_link != '' and group_opened_link != '' and status = 'A' limit 0,1 ");
          $rsC = mysqli_fetch_assoc($qC); 
          ?>

          <?php if ($rsC != NULL){ // Se tiver campeonato AGORA com sala criada

          if ($rsC['type'] == "XT"){
            $tipo = "X-TREINO";
          }

          if ($rsC['type'] == "BR"){
            $tipo = "CAMPEONATO";
          }

          if ($rsC['type'] == "MJ"){
            $tipo = "COPA";
          }

          ?>

            <h4 align="center"><strong><?=$tipo?><br/><span class="text-primary"><?=$rsC['title']?></span></strong></h4>

            <div class="alert alert-info" align="center">
              
              <small>
              FASE ÚNICA<br/>  
              <strong>02/12</strong> às <strong>20hs</strong><br/>
              </small>

              <!--<small>
              FASE DE GRUPOS<br/>  
              <strong>Grupo A</strong>: <strong>21/10 às 20hs</strong><br/>
              <strong>Grupo B</strong>: <strong>22/10 às 20hs</strong>
              <br/>FINAL<br/>  
              <strong>23/10 às 20hs</strong><br/>
              </small>-->

            </div>

            <div class="alert alert-warning">
               <small>ATENÇÃO: O</small> <small><strong class="text-danger">LINK DA SALA</strong> estará disponível na <strong>Página do Campeonato</strong>, aqui em nossa plataforma (clicando no botão azul abaixo), 15 minutos antes do horário da primeira queda.
              </small>
            </div>

            <p align="center">
              <a href="campeonatos-detalhes.php?id=<?=$rsC['id']?>" class="btn btn-primary" style="margin: 5px;"><i class="fa fa-trophy"></i> Página do Campeonato</a>
              <?php if ($rsC['group_opened_link'] == "A"){ ?>
                <a href="https://trovo.live/AllanzinhoTV" target="_Blank" class="btn btn-danger" style="margin: 5px;"><i class="fa fa-play-circle"></i> Assistir ao Vivo</a>
              <?php } ?>
              <?php if ($rsC['group_opened_link'] == "B"){ ?>
                <a href="https://trovo.live/AllanzinhoTV" target="_Blank" class="btn btn-danger" style="margin: 5px;"><i class="fa fa-play-circle"></i> Assistir ao Vivo</a>
              <?php } ?>
            </p>

            <hr/><hr/>

            <p align="center">Veja também:</p>
            <p align="center">
              
              <a href="campeonatos-detalhes.php?id=31" class="btn btn-success" style="margin: 5px;"><strong> INSCRIÇÕES LIGA FTA ED. 6</strong></a>
              <a href="ranking-team.php" class="btn btn-warning" style="margin: 5px;"><strong> RANKING SQUAD</strong></a> <a href="ranking-solo.php" class="btn btn-warning" style="margin: 5px;"><strong> RANKING SOLO</strong></a>
            </p>
          <?php } ?>


          <?php if ($rsC == NULL){ // Se NAO tiver campeonato AGORA com sala criada ?>
            <p align="center">
              É só escolher o camp, <strong><?=$_SESSION['loggedPlayerName']?></strong>:
            </p>
            <p align="center">
              <a href="detalhes-grupos-podio.php?camp=30" class="btn btn-danger" style="margin: 5px;"><strong>PÓDIO - SOLO LAST BLOOD</strong></a>
            </p>
            <p align="center">
              <a href="campeonatos-detalhes.php?id=31" class="btn btn-primary" style="margin: 5px;"><strong>INSCRIÇÕES LIGA FTA ED. 6</strong></a>
            </p>
            <p align="center">
              <a href="ranking-team.php" class="btn btn-warning" style="margin: 5px;"><strong> RANKING SQUAD</strong></a> <a href="ranking-solo.php" class="btn btn-warning" style="margin: 5px;"><strong> RANKING SOLO</strong></a>
            </p>

            <!--<iframe width="100%" height="315" src="https://www.youtube.com/embed/qyMrUb5ufoY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
          <?php } ?>

          <span id="mnsAguard"></span>
          
          </p>
        </div>

        <div class="modal-footer">
          <button type="button" id="btnFecharConf" class="btn btn-sm" data-bs-dismiss="modal"><i class="fa fa-times-circle"></i> Fechar</button>
        </div>

      </div>
    </div>
  </div>

  <?php include "view/footer.php" ?>


  <div class="cookie-container" align="center">
    <small>Usamos cookies para melhorar a sua experiência. Ao navegar neste site, você concorda com a nossa <a class="link" href="politica-cookies.php" style="text-decoration: underline;">Política de Cookies</a>.
    </small>

    <button class="cookie-btn">
      Ok, concordo!
    </button>
  </div>

  <?php mysqli_close($bd); ?>
  
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


        function chamaLinkCampeonatos(){

            window.location.href = "campeonatos.php";

        }


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

        });
    </script>
</body>
</html>