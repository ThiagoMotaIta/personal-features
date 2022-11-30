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
  <?php if(!isset($_GET['org'])){ redirect("perfil.php"); }?>

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

  // Se o player logado NAO for o organizador, nao deixa editar
  if ($rsL['id'] != $_SESSION['loggedId']){
    redirect("organizacao.php?org=".$_GET['org']);
  }

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
      <div class="row">
        <div class="col-md-6 align-self-center">
          <div class="left-content">
            <h4>Vamos lá, <em><?=$_SESSION['loggedPlayerName']?></em> :)</h4>
            <p align="justify">
              Para editar a organização <strong class="hSection"><?=$rsO['organization']?></strong>, informe os novos dados no formulário abaixo:
              <form id="formEditarOrg" enctype="multipart/form-data" action="controller/editar-minha-org.php" method="POST">

              <input type="hidden" id="orgId" name="orgId" value="<?=$rsO['id']?>">
              
              <div class="form-group">
                <input type="text" class="form-control" id="orgName" name="orgName" placeholder="Nome da Organização" value="<?=$rsO['organization']?>">
                <small id="msnErroOrgName" style="display: none" class="text-danger">Informe um Nome</small>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="orgInstagram" name="orgInstagram" placeholder="Link do Instagram" value="<?=$rsO['instagram_link']?>">
                <small id="msnErroOrgInstagram" style="display: none" class="text-danger">Informe o Link</small>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="orgBroadCast" name="orgBroadCast" placeholder="Link da Transmissão" value="<?=$rsO['broadcast_main_link']?>">
                <small id="msnErroOrgBroadCast" style="display: none" class="text-danger">Informe o Link</small>
              </div>
              <div class="form-group">
                <textarea class="form-control" id="orgDesc" name="orgDesc" placeholder="Descrição da Organização"><?=$rsO['description']?></textarea>
                <small id="msnErroOrgDesc" style="display: none" class="text-danger">Informe a Descrição</small>
              </div>
              <div class="form-group">
                <small><label>Caso queira mudar a foto, informe a nova imagem</label></small>
                <input type="file" class="form-control" id="logotipoOrg" name="logotipoOrg" placeholder="Logotipo da Organização" accept=".jpg,.png,.gif,.jpeg"/>
                <small id="msnErroFileSize" style="display: none" class="text-danger">Imagem não pode ser maior que 5 MB</small>

                <button type="button" id="btnEditarOrg" class="btn btn-warning btn-sm main-button" onclick="validarEditarOrg(<?=$rsO['id']?>)"><strong>EDITAR DADOS</strong></button> 
                  <br/>
                  <div id="loadingEditarOrg" style="display: none;"><br/><i class="fa fa-spinner fa-spin"></i> Carregando...</div>
             </form>
              </div>
            </p>

            <p>
              <hr/>
              <a href="organizacao.php?org=<?=$_GET['org']?>" class="btn btn-primary btn-sm"><strong>VOLTAR</strong></a>
            </p>
          </div>
        </div>
        <div class="col-md-6">
          <article class="video-item">
            <div class="video-caption">
              <h4>Let's rock!</h4>
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