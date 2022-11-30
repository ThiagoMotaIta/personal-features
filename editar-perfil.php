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

  <?php 

  $bd = abreConn(); 

  //Time
  $qP = mysqli_query($bd, "SELECT * from n_player_p where id = '".$_SESSION['loggedId']."' and status = 'A' ");
  $rsP = mysqli_fetch_assoc($qP);

  if ($rsP == NULL){
    redirect("perfil.php");
  }

  ?>
  
  <!-- Sobre a Plataforma -->
  <section class="section video" data-section="section5">
    <div class="container">
      <div class="row hSection">
        <h3> <img src="assets/images/iconeNormal.fw.png" height="30" /> <strong>PERFIL</strong><hr/></h3>
      </div>
      <div class="row">
        <div class="col-md-6 align-self-center">
          <div class="left-content">
            <h4>Vamos lá, <em><?=$_SESSION['loggedPlayerName']?></em> :)</h4>
            <p align="justify">
              Para editar seu Perfil, informe os novos dados no formulário abaixo. Ah, seu e-mail <strong class="hSection"><?=$rsP['email']?></strong> NÃO PODE SER ALTERADO!
              <br/><br/>
              Complete os Dados e ganhe <strong class="hSection">1.000 Pontos de Experiência</strong> e <strong class="hSection">$NP 1.000,00</strong>
              <form id="formEditarPerfil" action="controller/editar-meu-perfil.php" method="POST">  
              
              <div class="form-group">
                <input type="text" class="form-control" id="perfilName" name="perfilName" placeholder="Nome da Line/Time" value="<?=$rsP['name']?>">
                <small id="msnErroPerfilName" style="display: none" class="text-danger">Informe um Nome</small>
              </div>
              <div class="form-group">
                <select class="form-control" id="perfilGander" name="perfilGander">
                  <?php if ($rsP['gander'] == NULL) { ?>
                  <option value="">Selecione o Sexo</option>
                  <?php } else { ?>
                  <option value="<?=$rsP['gander']?>"><?=$rsP['gander']?></option>
                  <?php } ?>
                  <option value="F">F - Feminino</option>
                  <option value="M">M - Masculino</option>
                </select>
                <small id="msnErroPerfilGander" style="display: none" class="text-danger">Escolha uma opção</small>
              </div>
              <div class="form-group">
                <select class="form-control" id="perfilState" name="perfilState">
                  <?php if ($rsP['state'] == NULL) { ?>
                  <option value="">Selecione o Estado</option>
                  <?php } else { ?>
                  <option value="<?=$rsP['state']?>"><?=$rsP['state']?></option>
                  <?php } ?>
                  <option value="AC">Acre</option>
                  <option value="AL">Alagoas</option>
                  <option value="AP">Amapá</option>
                  <option value="AM">Amazonas</option>
                  <option value="BA">Bahia</option>
                  <option value="CE">Ceará</option>
                  <option value="DF">Distrito Federal</option>
                  <option value="ES">Espírito Santo</option>
                  <option value="GO">Goiás</option>
                  <option value="MA">Maranhão</option>
                  <option value="MT">Mato Grosso</option>
                  <option value="MS">Mato Grosso do Sul</option>
                  <option value="MG">Minas Gerais</option>
                  <option value="PA">Pará</option>
                  <option value="PB">Paraíba</option>
                  <option value="PR">Paraná</option>
                  <option value="PE">Pernambuco</option>
                  <option value="PI">Piauí</option>
                  <option value="RJ">Rio de Janeiro</option>
                  <option value="RN">Rio Grande do Norte</option>
                  <option value="RS">Rio Grande do Sul</option>
                  <option value="RO">Rondônia</option>
                  <option value="RR">Roraima</option>
                  <option value="SC">Santa Catarina</option>
                  <option value="SP">São Paulo</option>
                  <option value="SE">Sergipe</option>
                  <option value="TO">Tocantins</option>
                  <option value="EX">Estrangeiro</option>
                  
                </select>
                <small id="msnErroPerfilState" style="display: none" class="text-danger">Escolha uma opção</small>
              </div>

              <?php if ($rsP['birth_day'] == NULL) { ?>
              <div class="form-group">
                <small><label>Esta data só poderá ser informada uma única vez</label></small>
                <input type="text" class="form-control" id="perfilBirth" name="perfilBirth" placeholder="Data de Nascimento" data-mask="00/00/0000">
                <small id="msnErroPerfilBirth" style="display: none" class="text-danger">Informe a Data de Nascimento</small>
              </div>
              <?php } else { $data = date("d/m/Y", strtotime($rsP['birth_day']));?>
                <input type="hidden" id="perfilBirth" name="perfilBirth" value="<?=$data?>">
              <?php } ?>  

              <hr/>
              <h5><strong class="hSection">AUTENTICAÇÃO</strong> 
                <a href="#" data-bs-toggle="modal" data-bs-target="#modalZapAuth">
                  <i class="fa fa-question-circle"></i>
                </a>
              </h5>

              <div class="form-group">
                <small><label>Informe o <strong>DDD</strong> e o <strong>TELEFONE</strong>.</label></small>
                <input type="text" class="form-control" id="perfilPhone" name="perfilPhone" placeholder="ddd-número" value="<?=$rsP['phone']?>" data-mask="00-000000000">  

                <small id="msnErroPerfilPhone" style="display: none" class="text-danger">Informe seu WhatsApp</small>
                <button type="button" id="btnEditarPerfil" class="btn btn-warning btn-sm main-button" onclick="validarEditarPerfil()"><strong>EDITAR PERFIL</strong></button>
                  <br/>
                  <div id="loadingEditarPerfil" style="display: none;"><br/><i class="fa fa-spinner fa-spin"></i> Carregando...</div>
              </div>

              </form>
            </p>

            <p>
              <hr/>
              <a href="perfil.php" class="btn btn-primary btn-sm"><strong>VOLTAR</strong></a>
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


  <div class="modal fade" id="modalZapAuth" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <strong>AUTENTICAÇÃO - WhatsApp</strong><img src="assets/images/iconeNormal.fw.png" height="30" />
        </div>
        
        <div class="modal-body">
          <small>
            Seu <strong>E-MAI</strong>L e <strong>NÚMERO WHATSAPP</strong> são essenciais para por exemplo, entrarmos em contato sobre as premiações dos campeonatos que você venha a vencer ou estar no pódio, recuperação de conta, dentre outros recursos de verificação na Plataforma.
            <br/><br/>
            <strong>Suas informações NÃO SERÃO divulgadas</strong>, fique tranquilo... A gente só quer ter a certeza de que <u>VOCÊ É VOCÊ</u> :)
          </small>
        </div>  
        
        <div class="modal-footer" id="entendidoReg">
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

          $("#btnModal").click();
          //$("#btnModal").html("Nada");

        });
    </script>
</body>
</html>