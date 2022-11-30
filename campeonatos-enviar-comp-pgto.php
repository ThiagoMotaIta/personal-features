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

  <?php if(!isset($_GET['camp'])){ redirect("./"); }?>

  <?php 

  $bd = abreConn(); 

  // Dados do Campeonato
  $qC = mysqli_query($bd, "SELECT * from n_championship_p where id = '".$_GET['camp']."' and status = 'A' ");
  $rsC = mysqli_fetch_assoc($qC); 

  // Game
  $qG = mysqli_query($bd, "SELECT * from n_games_p where id = '".$rsC['game_id']."'");
  $rsG = mysqli_fetch_assoc($qG);

  // Organizador
  $qO = mysqli_query($bd, "SELECT * from n_organization_p where id = '".$rsC['organization_id']."'");
  $rsO = mysqli_fetch_assoc($qO);

  if ($rsC == NULL){
    redirect("perfil.php");
  }

  // SE FOR SOLO
  if($rsC['solo_or_team'] == "S"){
    // Verifica se ha inscricao pendende
    $qCs = mysqli_query($bd, "SELECT * from n_championship_sub_p where championship_id = '".$_GET['camp']."' and status = 'A' and player_id = '".$_SESSION['loggedId']."' ");
    $rsCs = mysqli_fetch_assoc($qCs);

    if ($rsCs == NULL){
      redirect("perfil.php");
    }
  }


  // SE FOR TEAM
  if($rsC['solo_or_team'] == "T"){
    // Pega o time do cara no Jogo
    $qCsT = mysqli_query($bd, "SELECT * from n_championship_sub_p where championship_id = '".$_GET['camp']."' and status = 'A' and player_id = '".$_SESSION['loggedId']."' ");
    $rsCsT = mysqli_fetch_assoc($qCsT);

    if ($rsCsT == NULL){
      redirect("perfil.php");
    }

    // Verifica se algum membro ja enviou comprovante pgto do time
    $qCs = mysqli_query($bd, "SELECT * from n_championship_sub_p where championship_id = '".$_GET['camp']."' and status = 'A' and team_id = '".$rsCsT['team_id']."' and (payment_status = '1' or payment_status = '2') ");
    $rsCs = mysqli_fetch_assoc($qCs);

    if ($rsCs != NULL){
      redirect("campeonatos-detalhes.php?id=".$_GET['camp']);
    }
  }


  // Se for

  ?>
  
  <!-- Sobre a Plataforma -->
  <section class="section video" data-section="section5">
    <div class="container">
      <div class="row hSection">
        <h3> <img src="assets/images/iconeNormal.fw.png" height="30" /> <strong>CAMPEONATOS</strong><hr/></h3>
      </div>
      <div class="row">
        <div class="col-md-6 align-self-center">
          <div class="left-content">
            <h4>Vamos lá, <em><?=$_SESSION['loggedPlayerName']?></em> :)</h4>
            <p align="justify">
              Aqui, você deve <strong class="hSection">EFETUAR O PAGAMENTO</strong> e em seguida, enviar o <strong class="hSection">COMPROVANTE DE PAGAMENTO</strong> da sua inscrição no Campeonato <strong class="hSection"><?=$rsC['title']?></strong>
              <br/>

              <h4>FORMAS DE PAGAMENTO</h4>
              <?=$rsC['payment_ways']?>

              <hr/>

              <h4>ENVIO DE COMPROVANTE</h4>
              <form id="formEnvioCompPgto" enctype="multipart/form-data" action="controller/envio-comp-pgto.php" method="POST">

              <input type="hidden" id="campId" name="campId" value="<?=$rsC['id']?>">
              <input type="hidden" id="teamId" name="teamId" value="<?=$rsCsT['team_id']?>"> 

              <div class="form-group">
                <small><label>Apenas imagem ou PDF</label></small>
                <input type="file" class="form-control" id="arquivoCompPgto" name="arquivoCompPgto" placeholder="Logotipo do Time" accept=".jpg,.png,.gif,.jpeg, .pdf"/>
                <small id="msnErroFileSize" style="display: none" class="text-danger">Arquivo não pode ser maior que 5 MB</small>


                <button type="button" id="btnEnvioCompPgto" class="btn btn-danger btn-sm main-button" onclick="validarEnvioCompPgto(<?=$rsC['id']?>)"><strong>ENVIAR COMPROVANTE</strong></button>

                  <br/>
                  <div id="loadingEnvioCompPgto" style="display: none;"><br/><i class="fa fa-spinner fa-spin"></i> Carregando...</div>
              </div>

              </form>
            </p>

            <p>
              <hr/>
              <a href="campeonatos-detalhes.php?id=<?=$_GET['camp']?>" class="btn btn-primary btn-sm"><strong>VOLTAR</strong></a>
            </p>
          </div>
        </div>
        <div class="col-md-6">
          <article class="video-item">
            <div class="video-caption">
              <h4>Joguem juntos!</h4>
            </div>
            <figure>
              <img src="assets/images/champions-frame.jpg" width="50%">
            </figure>
            <br/>
          </article>
        </div>
      </div>
    </div>
  </section>


  <div class="modal fade" id="modalEnvioPgto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <strong>ENVIO DE PAGAMENTO</strong><img src="assets/images/iconeNormal.fw.png" height="30" />
        </div>
        
        <div class="modal-body">
          
            Após efetuar pagamento, você precisa <strong class="text-danger">ENVIAR O COMPROVANTE</strong>. Para enviar, basta ir até o final desta página, onde há a opção para envio de comprovante.
            <br/><br/>
            Sem o comprovante, nós não temos como saber se você efetuou ou não, o pagamento.
          
        </div>  
        
        <div class="modal-footer" id="entendidoReg">
          <button type="button" class="btn btn-sm" data-bs-dismiss="modal"><i class="fa fa-check-circle"></i> Continuar com Pagamento</button>
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
    <script src="assets/js/jquery.mask.js?<?=$versao?>"></script>
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

          //$("#btnModal").click();
          $("#modalEnvioPgto").modal("toggle");

        });
    </script>
</body>
</html>