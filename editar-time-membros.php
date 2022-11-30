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

  <!-- Verifica se tá logado -->
  <?php if(!isset($_SESSION['loggedId'])){ redirect("./"); }?>

  <!-- Verifica se URL ta ok -->
  <?php if(!isset($_GET['time'])){ redirect("perfil.php"); }?>

  <?php 

  $bd = abreConn(); 

  //Time
  $qT = mysqli_query($bd, "SELECT * from n_team_p where id = '".$_GET['time']."' and status = 'A' ");
  $rsT = mysqli_fetch_assoc($qT);

  if ($rsT == NULL){
    redirect("perfil.php");
  }

  // Apenas o LIDER pode editar os membros
  if ($rsT["leader_id"] != $_SESSION['loggedId']){
    redirect("perfil.php");
  }

  //Game
  $qG = mysqli_query($bd, "SELECT * from n_games_p where id = '".$rsT['game_id']."'");
  $rsG = mysqli_fetch_assoc($qG);

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
            <h4>Vamos lá, <em><?=$_SESSION['loggedPlayerName']?></em> :)</h4>
            <p align="justify">
              Para gerenciar os membros do seu time <strong class="hSection"><?=$rsT['team']?></strong>, seleciona o membro e realize a ação desejada.
              <hr/>

              <div class="row">
                <?php 

                  $sql1 = mysqli_query($bd, "SELECT * from n_team_formation_p where team_id = '".$_GET['time']."' and status = 'A'");
                  while ($rs1 = mysqli_fetch_array($sql1)){

                  if ($rs1 != NULL){ 
                    $qL1 = mysqli_query($bd, "SELECT * from n_player_p where id = '".$rs1['player_id']."'");
                    $rsL1 = mysqli_fetch_assoc($qL1);
                  ?>

                  <div class="col-md-4" align="center">
                    <img src="assets/images/avatar-1.fw.png" width="60%" /><br/>
                    <strong>
                      <?=$rsL1['name']?><br/>
                    </strong>
                    <?php if ($rsT['leader_id'] != $rsL1['id']){ ?>
                    <button class="btn btn-danger btn-sm" onclick="preRemoveMembro(<?=$rsT['id']?>, <?=$rsL1['id']?>)" id="membro-<?=$rsL1['id']?>"><small>Remover</small></button>
                    <?php } else { ?>
                    <small>- Líder -</small>  
                    <?php } ?>  
                    <hr/> 
                  </div>
                    
                  <?php } } ?>
              </div>
            <p>
              <hr/>
              <a href="#" data-bs-toggle="modal" data-bs-target="#modalRecrutarTime" class="btn btn-warning btn-sm" style="margin:10px;" ><i class="fa fa-plus-circle"></i> <strong>RECRUTAR MEMBROS</strong></a>
              <br/>
              <a href="time-perfil.php?time=<?=$_GET['time']?>" class="btn btn-primary btn-sm" style="margin:10px;"><strong>VOLTAR</strong></a>
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

  <!-- Modal REMOVER -->
  <div class="modal fade" id="modalRemovarMembro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <strong>REMOVER MEMBRO</strong><img src="assets/images/iconeNormal.fw.png" height="30" />
        </div>

        <div class="modal-body" id="bodySairTime">
           <small>
             
             <div class="alert alert-info" id="removidoSucesso" style="display: none;">
               <strong>Membro Removido com Sucesso!</strong>
             </div>

             <big>Deseja realmente remover este membro do time <strong><?=$rsT['team']?></strong>?</big>
             <br/><br/>
             Caso confirme a remoção, o jogador removido não fará mais parte do TIME e terá sua participação CANCELADA dos campeonatos em que este time esteja participando.
           </small>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" id="btnRemoverMembro"><i class="fa fa-sign-out"></i> Sim, remover membro</button>
          <div id="loadingRemoverMembro" style="display: none;"><small><i class="fa fa-spinner fa-spin"></i> Carregando...</small></div>
        </div>
        </form>
      </div>
    </div>
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

  <?php include "view/footer.php" ?>

  <?php mysqli_close($bd); ?>

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