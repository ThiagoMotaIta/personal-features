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

  <!-- Verifica se tá logado (nesse caso, nao pode estar logado) -->
  <?php if(!isset($_GET['time'])){ redirect("criar-time.php"); }?>


  <!-- Dados do TIME -->
  <?php

  $bd = abreConn(); 

  //Time
  $qT = mysqli_query($bd, "SELECT * from n_team_p where id = '".$_GET['time']."' and status = 'A' ");
  $rsT = mysqli_fetch_assoc($qT);

  if ($rsT == NULL){
    redirect("perfil.php");
  }

  //Game
  $qG = mysqli_query($bd, "SELECT * from n_games_p where id = '".$rsT['game_id']."'");
  $rsG = mysqli_fetch_assoc($qG);

  //Líder
  $qL = mysqli_query($bd, "SELECT * from n_player_p where id = '".$rsT['leader_id']."'");
  $rsL = mysqli_fetch_assoc($qL);

  ?>

  
  <!-- Sobre a Plataforma -->
  <section class="section video" data-section="section5">
    <div class="container">

      <div class="row hSection">
        <h3> <img src="assets/images/iconeNormal.fw.png" height="30" /> <strong>TIMES</strong><hr/></h3>
      </div>

      <input type="hidden" id="temaIdHidden" value="<?=$rsT['id']?>">

      <div class="row">
        <div class="col-md-6 align-self-center">
          <div class="left-content">
          
            <div class="row">
              <div class="col-md-4">
                <img width="150" src="teams/<?=$rsT['logo']?>" class="img img-thumbnail" />
                <?php  
                  if ($rsT['leader_id'] == $_SESSION['loggedId']){
                ?>
                  <br/><br/>
                  <small><a href='editar-time.php?time=<?=$_GET['time']?>' class="btn btn-sm btn-primary" style="margin: 5px;"><i class="fa fa-pencil"></i> Editar Time</small></a>
                  <br/>
                  <small><a href='editar-time-membros.php?time=<?=$_GET['time']?>' class="btn btn-sm btn-primary" style="margin: 5px;"><i class="fa fa-pencil"></i> Membros</small></a>
                <?php } ?>

                <?php
                  // Verifica se ja informou Dados In game para este jogo 
                  $qDg = mysqli_query($bd, "SELECT * from n_player_game_info_p where player_id = '".$_SESSION['loggedId']."' and status = 'A' and game_id = '".$rsG['id']."' ");
                    $rsDg = mysqli_fetch_assoc($qDg);

                    if ($rsDg == NULL && $_SESSION['loggedId'] != NULL){    
                ?>
                    <br/>
                    <small><a href='jogo-perfil.php?game=<?=$rsG['id']?>' class="btn btn-sm btn-primary" style="margin: 5px;"><i class="fa fa-gamepad"></i> Conta do Jogo</small></a>

                <?php } ?>
              </div>
              <div class="col-md-8">  
                <h4><?=$rsT['team']?></em></h4>
                <p align="justify">
                  <strong class="hSection">TAG</strong>: <?=$rsT['tag']?><br/>
                  <strong class="hSection">Game</strong>: <?=$rsG['game']?><br/>
                  <strong class="hSection">Líder</strong>: <?=$rsL['name']?><br/>
                  <strong class="hSection">Títulos na Plataforma</strong>: <br/>
                  <strong class="hSection">Membros</strong>: <br/>

                  <?php 

                  $sql1 = mysqli_query($bd, "SELECT * from n_team_formation_p where team_id = '".$_GET['time']."' and status = 'A'");
                  while ($rs1 = mysqli_fetch_array($sql1)){

                  if ($rs1 != NULL){ 
                    $qL1 = mysqli_query($bd, "SELECT * from n_player_p where id = '".$rs1['player_id']."'");
                    $rsL1 = mysqli_fetch_assoc($qL1);

                    $qDg = mysqli_query($bd, "SELECT * from n_player_game_info_p where player_id = '".$rsL1['id']."' and status = 'A' and game_id = '".$rsG['id']."' ");
                    $rsDg = mysqli_fetch_assoc($qDg);
                  ?>

                  <?php if ($rsDg == NULL){?>
                  <strong>
                      <i class='fa fa-user'></i> <?=$rsL1['name']?><br/>
                  </strong>
                  <?php } ?>

                  <?php if ($rsDg != NULL){?>
                  <strong>
                    <i class='fa fa-user'></i> <?=$rsDg['player_nick_in_game']?> (<?=$rsL1['name']?>)<br/>
                  </strong>
                  <?php } ?>  
                    
                  <?php } } ?>

                </p>
              </div>
            </div>

            <p>
              <hr/>
              <?php if ($_SESSION['loggedId'] == $rsL['id']){?>
                <a href="#" data-bs-toggle="modal" data-bs-target="#modalRecrutarTime" class="btn btn-warning btn-sm"><i class="fa fa-plus-circle"></i> <strong>RECRUTAR MEMBROS</strong></a>
              <?php } ?>

              <?php 

              // Verifica se o player ja ta no time
              $qPt = mysqli_query($bd, "SELECT * from n_team_formation_p where team_id ='".$_GET['time']."' and player_id='".$_SESSION['loggedId']."' and status = 'A' ");
              $rsPt = mysqli_fetch_assoc($qPt);

              if ($rsPt == NULL){

              ?>
                
                <small>Se você quiser fazer parte deste time, entre em contato com o(a) Líder <strong class="hSection"><?=$rsL['name']?></strong> e peça para ele(a) adicionar você ao time <strong class="hSection"><?=$rsT['team']?></strong></small>
                <hr/>
              
              <?php } else { ?>

                <hr/>
                <a href="#" data-bs-toggle="modal" data-bs-target="#modalSairTime" class="btn btn-danger btn-sm"><i class="fa fa-sign-out"></i> <strong>SAIR DO TIME</strong></a>

              <?php } ?>

              <a href="perfil.php" class="btn btn-primary btn-sm" style="margin:10px;"><strong>VER MEU PERFIL</strong></a>  

            </p>
          
          </div>
        </div>
        <div class="col-md-6">
          <article class="video-item">
            <div class="video-caption">
              <h4>Joguem juntos!</h4>
            </div>
            <figure>
              <img src="assets/images/team-frame.jpg" width="50%">
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
  <div class="modal fade" id="modalRecrutarTime" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <strong>RECRUTAR MEMBROS</strong><img src="assets/images/iconeNormal.fw.png" height="30" />
        </div>

        <div class="modal-body">

          <small>

          <label><small><strong>Informe o <span class="text-primary">NOME</span> ou o <span class="text-primary">E-MAIL</span> do Membro</strong></small></label>
          <input type="text" id="membroBuscado" class="form-control" placeholder="Busque um mebro aqui">
          <br/>
          <button type="button" class="btn btn-primary btn-sm" onclick="buscarMembro(<?=$rsG['id']?>)"><i class="fa fa-search"></i> Buscar</button>

          <div id="loadingBusca" style="display: none;"><hr/><i class="fa fa-spinner fa-spin"></i> Carregando...</div>

          <div class="alert">
            <hr/>
            <span id="membrosAppend">

            </span>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-sm" data-bs-dismiss="modal"><i class="fa fa-times-circle"></i> Fechar</button>
        </div>
      
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="modalSairTime" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <strong>SAIR DO TIME</strong><img src="assets/images/iconeNormal.fw.png" height="30" />
        </div>

        <div class="modal-body" id="bodySairTime">
           <big>Deseja realmente sair do time <strong><?=$rsT['team']?></strong>?</big>
           <br/><br/>
           Caso confirme sua saída, você só poderá retornar ao time após o Líder <strong><?=$rsL['name']?></strong> o adicionar novamente.
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" onclick="sairTime(<?=$rsT['id']?>, <?=$_SESSION['loggedId']?>)" id="btnSairTime"><i class="fa fa-sign-out"></i> Sim, quero sair</button>
          <div id="loadingSairTime" style="display: none;"><small><i class="fa fa-spinner fa-spin"></i> Carregando...</small></div>
        </div>
        </form>
      </div>
    </div>
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