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


  $bd = abreConn();

  // Dados do Campeonato
  $qC = mysqli_query($bd, "SELECT * from n_championship_p where id = '".$_GET['camp']."' and status = 'A' ");
  $rsC = mysqli_fetch_assoc($qC);

  if ($rsC['type'] == "XT"){
    $camp = "X-TREINO";
  } else {
    $camp = "Campeonato";
  }

  // Game
  $qG = mysqli_query($bd, "SELECT * from n_games_p where id = '".$rsC['game_id']."'");
  $rsG = mysqli_fetch_assoc($qG);

  // Organizador
  $qO = mysqli_query($bd, "SELECT * from n_organization_p where id = '".$rsC['organization_id']."'");
  $rsO = mysqli_fetch_assoc($qO);

  ?>
  
  <!-- Sobre a Plataforma -->
  <section class="section video" data-section="section5">
    <div class="container">

      <div class="row hSection">
        <h3><img src="assets/images/iconeNormal.fw.png" height="30" /> <strong>FINAL</strong><hr/></h3>
      </div>

      <div class="row">
        <div class="col-md-12 align-self-center">
          <div class="left-content">
            <h4>Olá, <em><?=$saudacao?></em> :)</h4>
            <p align="justify">
              Aqui você encontra os FINALISTAS do <?=$camp?> <strong class="hSection"><?=$rsC['title']?></strong>, organizado por <strong class="hSection"><?=$rsO['organization']?></strong>
            </p>
          </div>
        </div>
      </div>

      <?php // AGUARDANDO CONTAGRM
      if ($rsC['id'] == '27'){
        //die("<div class='alert alert-info'>Estamos processando a contagem. Aguarde...</div>");
      } ?>

      <div class="row" style="color:#fff;">
        <?php 
              /////////////////////////////////////
              ///////// SOLO //////////////////////
              /////////////////////////////////////
              if ($rsC['solo_or_team'] == 'S'){ ?>

                <div class="col-md-12 alert alert-info" style="margin-top: 10px;">
                  <h4 class="hSection"><strong>FINALISTAS</strong></h4>
                  <br/>

                  <small>
                  <table class="table table-striped">
                    <thead class="table-dark">
                      <tr>
                        <th scope="col">SLOT</th>
                        <th scope="col">PLAYER</th>
                        <th scope="col">PTS</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php // Lista GRUPO A
                  $iA = 1;
                  $qGPA=  mysqli_query($bd, "SELECT * FROM n_championship_groups_p where status = 'A' and championship_id = '".$rsC['id']."' and final_stage =  'F' order by sorted_group_points desc ");
                  while ($rGPA = mysqli_fetch_array($qGPA)){ 

                  // Player
                  $qPA = mysqli_query($bd, "SELECT * from n_player_p where id = '".$rGPA['player_id']."' and status = 'A' ");
                  $rsPA = mysqli_fetch_assoc($qPA); 

                  // Dados in Game
                  $qDgA = mysqli_query($bd, "SELECT * from n_player_game_info_p where player_id = '".$rsPA['id']."' and status = 'A' and game_id = '".$rsG['id']."' ");
                  $rsDgA = mysqli_fetch_assoc($qDgA);

                  ?>

                  <?php if ($rGPA["player_id"] == $_SESSION["loggedId"]){
                    $class = "class='badge bg-primary' style='color:#fff;' ";
                  } else {
                    $class = "";
                  }
                  ?>


                  <tr>
                    <td><none class="badge bg-primary" style="color: #fff;">SLOT <?=$iA?></none></td>
                    <td>
                      <?php if ($rsDgA == NULL){ ?>
                        <strong><?=$rsPA['name']?></strong> 
                      <?php } else { ?>
                        <strong <?=$class?>><?=$rsDgA['player_nick_in_game']?></strong>
                      <?php } ?> 
                      <?php if ($rGPA["player_id"] == $_SESSION["loggedId"]){?>
                        <strong class="badge bg-primary" style="color: #fff;">VOCÊ</strong>
                      <?php } ?>
                    </td>
                    <td><?=$rGPA['sorted_group_points']?></td> 
                  </tr>

                  <?php $iA++; } 


                  if ($rGPA == NULL){
                    echo("<tr></tr>");
                  }


                  ?>
                  </tbody>
              </table>
            </small>

                </div>
              
          <?php }?>
      </div>


      <div class="row" style="color:#fff;">

        <?php 
              /////////////////////////////////////
              ///////// TEAM //////////////////////
              /////////////////////////////////////
              if ($rsC['solo_or_team'] == 'T'){ ?>

                <div class="col-md-12 alert alert-info" style="margin-top: 10px;">
                  <h4 class="hSection"><strong>FINALISTAS</strong></h4>
                  <br/>

                  <small>
                  <table class="table table-striped">
                    <thead class="table-dark">
                      <tr>
                        <th scope="col">SLOT</th>
                        <th scope="col">TIME</th>
                        <th scope="col"></th>
                        <th scope="col">PTS</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php // Lista GRUPO A
                  $iA = 1;
                  $qGPA=  mysqli_query($bd, "SELECT * FROM n_championship_groups_p where status = 'A' and championship_id = '".$rsC['id']."' and final_stage =  'F' order by sorted_group_points desc ");
                  while ($rGPA = mysqli_fetch_array($qGPA)){ 

                  // Team
                  $qPA = mysqli_query($bd, "SELECT * from n_team_p where id = '".$rGPA['team_id']."' and status = 'A' ");
                  $rsPA = mysqli_fetch_assoc($qPA);

                  // Formation
                  $qTfA = mysqli_query($bd, "SELECT * from n_team_formation_p where team_id = '".$rsPA['id']."' and player_id = '".$_SESSION['loggedId']."' and status = 'A' ");
                  $rsTfA = mysqli_fetch_assoc($qTfA);

                  ?>

                  <?php if ($rsTfA !== NULL){
                    $class = "class='badge bg-primary' style='color:#fff;' ";
                  } else {
                    $class = "";
                  }
                  ?>

                  <tr>
                    <td><none class="badge bg-primary" style="color: #fff;">No. <?=$iA?></none></td>
                    <td><img src="teams/<?=$rsPA['logo']?>" width='50' class='img img-thumbnail' /></td>
                    <td>
                      <strong><?=$rsPA['team']?></strong> <br/><small>TAG: <?=$rsPA['tag']?></small>
                      <?php if ($rsTfA != NULL){?>
                        <strong class="badge bg-primary" style="color: #fff;">SEU SQUAD</strong>
                      <?php } ?>
                    </td>
                    <td><?=$rGPA['sorted_group_points']?></td> 
                  </tr>

                  <?php $iA++; } 


                  if ($rGPA == NULL){
                    echo("<tr></tr>");
                  }


                  ?>
                </tbody>
              </table>
            </small>

                </div>
              
          <?php }?>

      </div>

      <?php  mysqli_close($bd); ?>

      <a href="detalhes-grupos.php?camp=<?=$rsC['id']?>" class="btn btn-secondary btn-sm" style="margin-top: 10px;"> <strong>Voltar</strong> </a>

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