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
  <?php if(!isset($_GET['org'])){ redirect("perfil.php"); }?>


  <!-- Dados do TIME -->
  <?php

  $bd = abreConn(); 

  //Organizacao
  $qO = mysqli_query($bd, "SELECT * from n_organization_p where id = '".$_GET['org']."' and status = 'A' ");
  $rsO = mysqli_fetch_assoc($qO);

  if ($rsO == NULL){
    redirect("perfil.php");
  }

  //Player Organizador
  $qL = mysqli_query($bd, "SELECT * from n_player_p where id = '".$rsO['player_id_owner']."'");
  $rsL = mysqli_fetch_assoc($qL);

  // Quantidade Camps
  $qC = mysqli_query($bd, "SELECT count(id) as totalCamps from n_championship_p where organization_id = '".$rsO['id']."' and status = 'A' ");
  $rsC = mysqli_fetch_assoc($qC);

  ?>

  
  <!-- Sobre a Plataforma -->
  <section class="section video" data-section="section5">
    <div class="container">

      <div class="row hSection">
        <h3> <img src="assets/images/iconeNormal.fw.png" height="30" /> <strong>ORGANIZAÇÕES</strong><hr/></h3>
      </div>

      <input type="hidden" id="temaIdHidden" value="<?=$rsT['id']?>">

      <div class="row">
        <div class="col-md-6 align-self-center">
          <div class="left-content">
          
            <div class="row">
              <div class="col-md-4">
                <img width="150" src="organizations/logos/<?=$rsO['logotype_url']?>" class="img img-thumbnail" />
                <?php  
                  if ($rsO['player_id_owner'] == $_SESSION['loggedId']){
                ?>
                  <br/><br/>
                  <small><a href='editar-organizacao.php?org=<?=$_GET['org']?>' class="btn btn-sm btn-primary" style="margin: 5px;"><i class="fa fa-pencil"></i> Editar Dados</small></a>
                  <br/>
                <?php } ?>
              </div>
              <div class="col-md-8">  
                <h4><?=$rsT['team']?></em></h4>
                <p align="justify">
                  <strong><big><big><?=$rsO['organization']?></big></big></strong><br/>
                  <strong class="hSection">Coordenador</strong>: <?=$rsL['name']?><br/>
                  <strong class="hSection">Campeonatos na Plataforma</strong>: <?=$rsC['totalCamps']?><br/>
                  <a target="_Blank" href="<?=$rsO['instagram_link']?>">
                    <img src="assets/images/instagramIconBrancoMenorShadow.fw.png" width="30" /> Instagram
                  </a>
                  <br/><br/>
                  
                  <?php  
                  if ($rsO['player_id_owner'] == $_SESSION['loggedId']){
                  ?>
                  <a href='criar-camp.php' disable="disable" class="btn btn-sm btn-primary" style="margin-top: 10px; display: none;"><i class="fa fa-trophy"></i> Criar Campeonato</a>
                  <?php } ?>
                </p>
              </div>
            </div>

            <br/>
            <p>
               <strong class="hSection">Últimos Campeonatos Organizados</strong><br/>

               <div class="row">
                <?php

                  $qCs = mysqli_query($bd, "SELECT * from n_championship_p where organization_id = '".$_GET['org']."' and status = 'A' order by id desc limit 0,5 ");
                
                  
                      while ($rsCs = mysqli_fetch_array($qCs)){

                      // Game
                      $qG = mysqli_query($bd, "SELECT game, logo, console_type from n_games_p where id = '".$rsCs['game_id']."'");
                      $rsG = mysqli_fetch_assoc($qG);  

                  ?>
                      <div class="col-md-3 btn btn-primary" style="margin: 5px;" onclick="champDetalhes(<?=$rsCs['id']?>)">
                        <img width="100" src="assets/images/<?=$rsG['logo']?>"/>
                        <br/>
                        <small><?=$rsCs['title']?></small>
                        <?php  
                        if ($rsO['player_id_owner'] == $_SESSION['loggedId']){
                        ?>
                        <hr/>
                        <a href="editar-camp.php?camp=<?=$rsCs['id']?>" class="btn btn-warning" style="margin:5px; display: none;"><i class="fa fa-pencil fa-lg"></i></a>
                        <a href="campeonatos-dash.php?camp=<?=$rsCs['id']?>" class="btn btn-warning" style="margin:5px;"><i class="fa fa-desktop fa-lg"></i></a>
                      <?php } ?>
                      </div>
                  
                  <?php } ?>
                </div>
            </p>

            <p>
              <hr/>
              <a href="perfil.php"><i class="fa fa-user"></i> Meu Perfil</a>
            </p>
          
          </div>
        </div>
        <div class="col-md-6">
          <article class="video-item">
            <div class="video-caption">
              <h4>LET'S ROCK!</h4>
            </div>
            <figure>
              <img src="assets/images/pubg-frame.jpg" width="50%">
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