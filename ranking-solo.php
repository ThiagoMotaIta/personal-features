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


  $bd = abreConn();?>
  
  <!-- Sobre a Plataforma -->
  <section class="section video" data-section="section5">
    <div class="container">

      <div class="row hSection">
        <h3><img src="assets/images/iconeNormal.fw.png" height="30" /> <strong>RANKING - SOLO</strong>
          <small style="color: #fff;"><?php echo date('Y'); ?></small><hr/>
        </h3>
      </div>

      <div class="row">
        <div class="col-md-12 align-self-center">
          <div class="left-content">
            <h4>Olá, <em><?=$saudacao?></em> :)  

            </h4>
            <p align="justify">
              Aqui você encontra o Ranking oficial da Plataforma <strong class="hSection">NEXT PLAYER</strong>, na modalidade <strong class="hSection">BR SOLO</strong>, contabilizando todas as pontuações deste ano, dos Campeonatos gratuitos e com taxa, do tipo <strong class="hSection">SOLO</strong> organizados por nossa Plataforma.
            </p>
            
          </div>
        </div>
      </div>

      <?php // AGUARDANDO CONTAGRM
      if ($rsC['id'] == '23'){
        //die("<div class='alert alert-info'>Estamos processando a contagem. Aguarde...</div>");
      } ?>

      <div class="row" style="color:#fff;">
        <?php 
              /////////////////////////////////////
              ///////// SOLO //////////////////////
              /////////////////////////////////////
        ?>

                <div class="col-md-12 alert alert-info" style="margin-top: 10px;">
                  <h4 class="hSection"><strong>RANKING SEASON <?php echo date('Y'); ?></strong></h4>
                  <br/>

                  <small>
                  <table class="table table-striped">
                    <thead class="table-dark">
                      <tr>
                        <th scope="col">POS</th>
                        <th scope="col">PLAYER</th>
                        <th scope="col">PTS</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php // Lista GRUPO A
                  $iA = 0;
                  $qGPA=  mysqli_query($bd, "SELECT player_id, SUM(sorted_group_points + final_stage_points) AS total_pontos FROM n_championship_groups_p GROUP BY player_id ORDER BY total_pontos DESC limit 0,101 ");
                  while ($rGPA = mysqli_fetch_array($qGPA)){ 

                  // Player
                  $qPA = mysqli_query($bd, "SELECT * from n_player_p where id = '".$rGPA['player_id']."' and status != 'E' ");
                  $rsPA = mysqli_fetch_assoc($qPA); 

                  // Dados in Game
                  $qDgA = mysqli_query($bd, "SELECT * from n_player_game_info_p where player_id = '".$rsPA['id']."' and status = 'A' and game_id = '1' ");
                  $rsDgA = mysqli_fetch_assoc($qDgA);

                  ?>

                  <?php if ($rGPA["player_id"] == $_SESSION["loggedId"]){
                    $class = "class='badge bg-primary' style='color:#fff;' ";
                  } else {
                    $class = "";
                  }

                  if ($iA < 11){
                    $classBadge = "warning";
                  } else {
                    $classBadge = "primary";
                  } 

                  if ($rsPA['status'] == 'B'){
                    $classBadge = "danger";
                  }
                  ?>

                  <?php if ($rGPA['player_id'] != null){?>

                  <tr>
                    <td><none class="badge bg-<?=$classBadge?>" style="color: #fff;"><?=$iA?>º</none></td>
                    <td>
                      <?php if ($rsDgA == NULL){ ?>
                        <strong><?=$rsPA['name']?></strong> 
                      <?php } else { ?>
                        <strong><?=$rsDgA['player_nick_in_game']?></strong>
                      <?php } ?> 
                      <?php if ($rGPA["player_id"] == $_SESSION["loggedId"]){?>
                        <strong class="badge bg-primary" style="color: #fff;">VOCÊ</strong>
                      <?php } ?>
                      <?php if ($rsPA['status'] == 'B'){ ?> <strong class="badge bg-danger" style="color: #fff;">BANIDO</strong> <?php } ?> 
                    </td>
                    <td><?=$rGPA['total_pontos']?></td> 
                  </tr>

                  <?php } $iA++; } 


                  if ($rGPA == NULL){
                    //echo("---");
                  }


                  ?>

                   </tbody>
              </table>
            </small>

                </div>
      </div>

      <?php  mysqli_close($bd); ?>

      <a href="campeonatos.php" class="btn btn-secondary btn-sm" style="margin-top: 10px;"> <strong>Voltar</strong> </a>

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