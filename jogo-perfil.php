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
  <?php include "view/menu-top.php" ?>


  <!-- Dados do GAME -->
  <?php

  $bd = abreConn(); 

  // Jogo
  $qG = mysqli_query($bd, "SELECT * from n_games_p where id = '".$_GET['game']."' and status = 'A' ");
  $rsG = mysqli_fetch_assoc($qG);

  if ($rsG == NULL){
    redirect("perfil.php");
  } else {

    // Categoria
    $qC = mysqli_query($bd, "SELECT * from n_game_category_p where id = '".$rsG['category_id']."' and status = 'A' ");
    $rsC = mysqli_fetch_assoc($qC);

  }

  if (isset($_GET['game'])){
    if (isset($_SESSION['loggedId'])){
      // Dados In Game
      $qDg = mysqli_query($bd, "SELECT * from n_player_game_info_p where player_id = '".$_SESSION['loggedId']."' and status = 'A' and game_id = '".$_GET['game']."' ");
      $rsDg = mysqli_fetch_assoc($qDg);
    }
  }


  if ($rsDg != NULL){ ?>
  <input type="hidden" id="dadosInGameOk" value="<?=$rsG['id']?>">  
  <?php } ?>

  
  <!-- Sobre a Plataforma -->
  <section class="section video" data-section="section5">
    <div class="container">

      <div class="row hSection">
        <h3> <img src="assets/images/iconeNormal.fw.png" height="30" /> <strong>GAMES</strong><hr/></h3>
      </div>

      <div class="row">
        <div class="col-md-6 align-self-center">
          <div class="left-content">
          
            <div class="row">
              <div class="col-md-4">
                <img width="150" src="assets/images/<?=$rsG['logo']?>" class="img img-circle" />
                <br/><br/>
                  <?php if (isset($_SESSION['loggedId'])){?>
                  <small><a href='#' data-bs-toggle="modal" data-bs-target="#modalGameSync" class="btn btn-sm btn-danger" style="margin: 5px; margin-bottom: 20px;"><i class="fa fa-gamepad"></i> Editar NICK</small></a>
                  <br/>
                <?php } else { ?>
                  <small><a href='#' data-bs-toggle="modal" data-bs-target="#modalEntrar" class="btn btn-sm btn-primary" style="margin: 5px; margin-bottom: 20px;"><i class="fa fa-gamepad"></i> Conta do Jogo</small></a>
                  <br/>
                <?php } ?>
              </div>
              <div class="col-md-8">
                <p align="justify">
                  <?php if ($rsDg != NULL){ ?>
                    <strong class="hSection">NICK</strong>: <?=$rsDg['player_nick_in_game']?><br/>
                    <strong class="hSection">ID</strong>: <?=$rsDg['player_id_in_game']?><br/>
                    <strong class="hSection">LEVEL</strong>: <?=$rsDg['player_level_in_game']?><br/>
                    <br/>
                  <?php } ?>
                  <strong class="hSection">Game</strong>: <?=$rsG['game']?><br/>
                  <strong class="hSection">Categoria</strong>: <?=$rsC['category']?><br/>
                  <strong class="hSection">Publisher</strong>: <?=$rsG['publisher']?><br/>
                  <strong class="hSection">Console</strong>: <?=$rsG['console_type']?><br/>
                  <br/>
                  <img src="assets/images/logotipoBrancoNovo.png" width="220" /><br/>
                  <strong class="hSection">Pontos por Vitória</strong>: <?=$rsG['xp_per_match']?> XP<br/>
                  <strong class="hSection">$NP por Vitória</strong>: $NP <?=$rsG['coins_per_match']?><br/>
                </p>
              </div>
            </div>

            <p>
              <hr/>
            </p>

            <p>
              <hr/>
                <a href="perfil.php" class="btn btn-warning btn-sm" style="margin: 10px;"><i class="fa fa-user"></i> <strong>MEU PERFIL</strong></a>
                <a href="campeonatos.php" class="btn btn-warning btn-sm" style="margin: 10px;"><i class="fa fa-search"></i> <strong>BUSCAR CAMPEONATOS</strong></a>
            </p>
          
          </div>
        </div>
        <div class="col-md-6">
          <article class="video-item">
            <div class="video-caption">
              <h4>É hora da diversão!</h4>
            </div>
            <figure>
              <img src="assets/images/jogos-frame.jpg" width="50%">
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


  <?php if (isset($_SESSION['loggedId'])){?>
  <!-- Modal -->
  <div class="modal fade" id="modalGameSync" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <strong>SUA CONTA DO JOGO</strong><img src="assets/images/iconeNormal.fw.png" height="30" />
        </div>

        <div class="modal-body" id="bodySairTime">
           
           <small>
           Aqui, você precisa informar EXATAMENTE, as mesmas informações que estão na sua conta do game <strong><big><?=strtoupper($rsG['game'])?></big></strong>. <br/>Além disso, <strong>ganhe 300 XP e $NP 500,00</strong> para cada conta de jogo que você informar os dados :)
           <hr/>
           <form id="formDadosInGame" action="controller/dados-in-game.php" method="POST">
              <input type="hidden" name="gameId" id="gameId" value="<?=$rsG['id']?>">
              <div class="form-group">
                <input type="text" class="form-control" id="nickInGame" name="nickInGame" placeholder="NICK no Jogo" value="<?=$rsDg['player_nick_in_game']?>">
                <small id="msnErroNickInGame" style="display: none" class="text-danger">Informe um Nick</small>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="idInGame" name="idInGame" placeholder="ID no Jogo" value="<?=$rsDg['player_id_in_game']?>">
                <small id="msnErroIdInGame" style="display: none" class="text-danger">Informe o ID</small>
              </div>
              <div class="form-group">
                <input type="number" class="form-control" id="levelInGame" name="levelInGame" placeholder="NÍVEL no Jogo" value="<?=$rsDg['player_level_in_game']?>">
                <small id="msnErroLevelInGame" style="display: none" class="text-danger">E-mails não Conferem</small>
              </div>

              <?php if ($rsG['id'] == 1){ ?>
                <img src="assets/images/exemplo-dados-cod.fw.png" width="100%"><br/>
              <?php } ?>

              <strong>ATENÇÃO</strong>: É muito importante que estas informações estejam corretas, pois nas disputas, ligas e principalmente, nos campeonatos entre TIMES, seu NICK e/ou ID do jogo serão solicitados... 
             </form>

          </small>
        
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" onclick="atualizarInfo()"><i class="fa fa-gamepad"></i> Atualizar</button>
          <div id="loadingAtualizarDadosInGame" style="display: none;"><small><i class="fa fa-spinner fa-spin"></i> Carregando...</small></div>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>


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

          if ($("#dadosInGameOk").val() == null){
            $('#modalGameSync').modal('toggle');
          }

        });
    </script>
</body>
</html>