<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="keywords" content="player, e-sports, game, next, nextplayer, cod, call, of, duty, mobile, freefire, fps, championship, campeonato, level, pes, fifa" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <link rel="stylesheet" href="assets/css/geral.css">
<!--
    
TemplateMo 557 Grad School

https://templatemo.com/tm-557-grad-school

-->
  </head>

<body>

   
  <!--header-->
  <header class="main-header clearfix" role="header">
    <div class="logo">
      <a href="./"><img src="assets/images/logotipoBrancoNovo.png" width="300" /></a>
    </div>
  </header>

  <!-- ***** Main Banner Area Start ***** -->
  <section class="section main-banner" id="top" data-section="section1">
      <video autoplay muted loop id="bg-video">
          <source src="assets/images/codMovie2.mp4" type="video/mp4" />
      </video>

      <div class="video-overlay header-text">
          <div class="caption">
              <h6>A NEXT PLAYER, plataforma de Campeonatos de e-Sports <br/><small>Apresenta:</small></h6>
              <h2>CAMPEONATO DE CALL OF DUTY - MOBILE</h2>
              <div class="main-button">
                  <div class="scroll-to-section"><a href="#sectionCampeonato">PRÉ-INSCRIÇÃO AQUI</a></div>
              </div>
          </div>
      </div>
  </section>
  <!-- ***** Main Banner Area End ***** -->
  

  <!-- Contagem Regressiva / Inscricao campeonatos -->
  <section class="section coming-soon" data-section="sectionCampeonato" style="padding-top: 50px;">
    <div class="container">
      <div class="row">
        <div class="col-md-7 col-xs-12">
          <div class="continer centerIt">
            <div>
              <h4>CAMPEONATO <em>CALL OF DUTY MOBILE</em> <em><u>INSCRIÇÕES GRATUITAS</u></em>
                <br/>
                PREMIAÇÃO TOTAL: <em>R$ 3.500,00</em>
                <br/><br/>
                <div class="main-button">
                  <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalRegulamento">
                    Regras
                  </a>
                  <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalDatas">
                    Datas
                  </a>
                  <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalPremiacao">
                    Prêmios
                  </a>
                </div>
              </h4>
              <div class="counter">

                <div class="days">
                  <div class="value">3</div>
                  <span>Estilos</span>
                </div>

                <div class="hours">
                  <div class="value">BR</div>
                  <span>SOLO</span>
                </div>

                <div class="minutes">
                  <div class="value">BR</div>
                  <span>Squad</span>
                </div>

                <div class="seconds">
                  <div class="value">MJ</div>
                  <span>Squad</span>
                </div>

              </div>

            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="right-content">
            <div class="top-content">
              <h6><em><h2>PRÉ-INSCRIÇÃO</h2></em><hr/>Éh... Nós também detestamos formulários!! <br/>Mas este aqui vai ser rapidão <i class="fa fa-thumbs-up"></i></h6>
            </div>
            <form id="formPreInsc" action="preInsc.php" method="POST">
              <div class="row">
                <div class="col-md-12">
                  <fieldset>
                    <small id="msnErroNome" style="display: none" class="text-danger">Informe um Nome</small>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Informe seu Nome">
                  </fieldset>
                </div>
                <div class="col-md-12">
                  <fieldset>
                    <small id="msnErroEmail" style="display: none" class="text-danger">Informe um e-mail válido</small>
                    <input name="email" type="text" class="form-control" id="email" placeholder="Informe seu E-mail">
                  </fieldset>
                </div>
                <div class="col-md-12">
                  <fieldset>
                    <small id="msnErroEmailConfirm" style="display: none" class="text-danger">E-mails não conferem</small>
                    <input name="emailConfirm" type="text" class="form-control" id="emailConfirm" placeholder="Confirme seu E-mail" required="">
                  </fieldset>
                </div>
                <div class="col-md-12">
                  <fieldset>
                    <button type="button" id="form-submit" class="button" onclick="validarPreInscricao()">Finalizar Inscrição</button>
                  </fieldset>
                </div>
              </div>
            </form>
          </div>
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
  <div class="modal fade" id="modalDatas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <fieldset>
            <p><legend>BR SOLO (200 Players)</legend>
            Qualificatória GRUPO A: 13/Mar às 17hs<br/>
            Qualificatória GRUPO B: 13/Mar às 20hs<br/>
            <strong>FINAL</strong>: 14/Mar às 17hs</p>
          </fieldset>
          <br/>
          <fieldset>
            <p><legend>BR SQUAD (40 Squads)</legend>
            Qualificatória GRUPO A: 20/Mar às 17hs<br/>
            Qualificatória GRUPO B: 20/Mar às 20hs<br/>
            <strong>FINAL</strong>: 21/Mar às 17hs</p>
          </fieldset>
          <br/>
          <fieldset>
            <p><legend>MJ SQUAD (32 Squads)</legend>
            Mata-Mata 1: 03/Abr, das 13hs às 17hs<br/>
            Mata-Mata 2: 04/Abr, das 13hs às 17hs<br/>
            Oitavas de Finais 1: 10/Abr, das 15hs às 17hs<br/>
            Oitavas de Finais 2: 11/Abr, das 15hs às 17hs<br/>
            Quartas de Finais: 17/Abr, das 13hs às 17hs<br/>
            Semi Finais: 24/Abr, das 13hs às 15hs<br/>
            Final: 08/Mai às 20hs
            </p>
          </fieldset>
          <hr/>
            <p>Siga nosso perfil no Instagram. Lá, a gente mantem a comunidade informada sempre que novos campeonatos da NEXT PLAYER forem surgindo. Só clicar no ícone abaixo:
            <br/>
            <a href="https://www.instagram.com/nextplayer.plataforma/" target="_Blank"><img src="assets/images/instagram2.png" width="80px" /></a>
            </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal"><i class="fa fa-crosshairs"></i> Entendido</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="modalRegulamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-body">
          <div align="center">
            Selecione:<br/>
            <button type="button" class="btn btn-warning" onclick="abaReg('BR-SOLO')" style="margin: 5px;">BR SOLO</button>
            <button type="button" class="btn btn-warning" onclick="abaReg('BR-SQUAD')" style="margin: 5px;">BR SQUAD</button>
            <button type="button" class="btn btn-warning" onclick="abaReg('MJ-SQUAD')" style="margin: 5px;">MJ SQUAD</button>
          </div>
          <hr/>
          <fieldset id="brSoloModal" style="display: none;">
            <legend>BR SOLO (200 Players)</legend>
            <p>
            <strong>REQUISITOS</strong>:<br/> 
            Ser player cadastrado na plataforma NEXT PLAYER e ter pelo menos 14 anos de idade.</p>
            <p>
            <p>
              <strong>GRUPO TELEGRAM/WHATSAPP</strong>:<br/>
              Assim que as vagas forem preenchidas, o administrador da plataforma NEXT PLAYER irá formar um grupo no Telegram ou no WhatsApp, com todos os players inscritos. Portanto, após realizar login na plataforma, é IMPRESCINDÍVEL que cada player informe corretamente o número de contato para Telegram/WhatsApp.
            </p>
            <p><strong>FORMATO DO CAMPEONATO</strong>:<br/>  
            O campeonato BR SOLO terá 2 grupos (A e B), cada um com 100 players. A formação de cada grupo será feita por sorteio (realizado pela plataforma).</p>
            <p>
            <p><strong>QUALIFICATÓRIAS</strong>:<br/>  
            Em cada grupo, serão disputadas 3 partidas entre seus 100 players. Os 50 melhores de cada grupo se qualificarão para a FINAL.
            </p>
            <p>
              <strong>PONTUAÇÃO</strong>:<br/>
              Apenas os 20 primeiros colocados de cada partida receberão pontuação, que vai de 20 pontos (1º colocado) a 1 ponto (20º colocado). Quem somar mais pontos nas 3 partidas de cada fase, avançará! Número de Kills será considerado apenas para CRITÉRIO DE DESEMPATE.
            </p>
            <p>
               <strong>A GRANDE FINAL E PREMIAÇÕES</strong>:<br/>
               Na grande final, serão disputadas 3 partidas entre os 100 players remanescentes (50 melhores do grupo A e 50 melhores do grupo B) que competirão pela premiação abaixo:<br/>
             - 1º Colocado: R$ 350,00<br/>
             - 2º Colocado: R$ 150,00<br/>
             - 3º Colocado: R$ 50,00
            </p>
            <p>
              <strong>PROIBIÇÕES</strong>:<br/>
              - Uso de Emuladores;<br/>
              - Uso de Tanque;<br/>
              - Ofensas verbais a outros players (Regra básica, hein?!);<br/>
              - Qualquer tipo de trapaça identificada pelos organizadores;
            </p>
            <hr/>
            <p>Siga nosso perfil no Instagram. Lá, a gente mantem a comunidade informada sempre que novos campeonatos da NEXT PLAYER forem surgindo. Só clicar no ícone abaixo:
            <br/>
            <a href="https://www.instagram.com/nextplayer.plataforma/" target="_Blank"><img src="assets/images/instagram2.png" width="80px" /></a>
            </p>
          </fieldset>

          <fieldset id="brSquadModal" style="display: none;">
            <legend>BR SQUAD (40 Squads)</legend>
            <p>
            <strong>REQUISITOS</strong>:<br/> 
            Cada Squad precisa ser cadastrado na plataforma NEXT PLAYER, ter no mínimo 4 players DISPONÍVEIS nos dias das disputas e TODOS os seus membros devem ter pelo menos 14 anos de idade e precisam, OBRIGATORIAMENTE, possuir a TAG do Squad no início do nome e claro, estarem cadastrados na plataforma NEXT PLAYER.</p>
            <p>
            <p>
              <strong>GRUPO TELEGRAM/WHATSAPP</strong>:<br/>
              Assim que as vagas forem preenchidas, o administrador da plataforma NEXT PLAYER irá formar um grupo no Telegram ou no WhatsApp, com todos os players inscritos. Portanto, após realizar login na plataforma, é IMPRESCINDÍVEL que cada player informe corretamente o número de contato para Telegram/WhatsApp.
            </p>  
            <p><strong>FORMATO DO CAMPEONATO</strong>:<br/>  
            O campeonato BR SQUAD terá 2 grupos (A e B), cada um com 20 Squads. A formação de cada grupo será feita por sorteio (realizado pela plataforma).</p>
            <p>
            <p><strong>QUALIFICATÓRIAS</strong>:<br/>  
            Em cada grupo, serão disputadas 3 partidas entre seus 20 Squads. Os 10 melhores de cada grupo se qualificarão para a FINAL.
            </p>
            <p>
              <strong>PONTUAÇÃO</strong>:<br/>
              Apenas os 10 primeiros colocados de cada partida receberão pontuação, que vai de 20 pontos (1º colocado) a 1 ponto (10º colocado). Os Squads que somarem mais pontos nas 3 partidas de cada fase, avançarão! Número de Kills será considerado apenas para CRITÉRIO DE DESEMPATE.
            </p>
            <p>
               <strong>A GRANDE FINAL E PREMIAÇÕES</strong>:<br/>
               Na grande final, serão disputadas 3 partidas entre os 20 Squads remanescentes (10 melhores do grupo A e 10 melhores do grupo B) que competirão pela premiação abaixo:<br/>
             - 1º Colocado: R$ 1.000,00<br/>
             - 2º Colocado: R$ 600,00<br/>
             - 3º Colocado: R$ 200,00
            </p>
            <p>
              <strong>PROIBIÇÕES</strong>:<br/>
              - Player SEM A TAG do Squad;<br/>
              - Uso de Emuladores;<br/>
              - Uso de Tanque;<br/>
              - Ofensas verbais a outros players (Regra básica, hein?!);<br/>
              - Qualquer tipo de trapaça identificada pelos organizadores;
              <br><br/>
              <u>Detalhe Importante</u>: Para que não haja a tal famosa "trapaça do telar", nas trasmissões ao vivo haverá um delay de 5 minutos. Portanto, não fique "moscando na casinha", achando que vai saber onde os squads estarão... Não dê uma de vacilão, blz?!
            </p>
            <hr/>
            <p>Siga nosso perfil no Instagram. Lá, a gente mantem a comunidade informada sempre que novos campeonatos da NEXT PLAYER forem surgindo. Só clicar no ícone abaixo:
            <br/>
            <a href="https://www.instagram.com/nextplayer.plataforma/" target="_Blank"><img src="assets/images/instagram2.png" width="80px" /></a>
            </p>
          </fieldset>

          <fieldset id="mjSquadModal" style="display: none;">
            <legend>MJ SQUAD (32 Squads)</legend>
            <p>
            <strong>REQUISITOS</strong>:<br/> 
            Cada Squad precisa ser cadastrado na plataforma NEXT PLAYER, ter no mínimo 5 players DISPONÍVEIS nos dias das disputas e TODOS os seus membros devem ter pelo menos 14 anos de idade e precisam, OBRIGATORIAMENTE, possuir a TAG do Squad no início do nome e claro, estarem cadastrados na plataforma NEXT PLAYER.</p>
            <p>
            <p>
              <strong>GRUPO TELEGRAM/WHATSAPP</strong>:<br/>
              Assim que as vagas forem preenchidas, o administrador da plataforma NEXT PLAYER irá formar um grupo no Telegram ou no WhatsApp, com todos os players inscritos. Portanto, após realizar login na plataforma, é IMPRESCINDÍVEL que cada player informe corretamente o número de contato para Telegram/WhatsApp.
            </p>
            <p><strong>FORMATO DO CAMPEONATO</strong>:<br/>  
            O campeonato MJ SQUAD será realizado no formato de COPA. Haverá chaveamento entre as 32 equipes. Os confrontos serão sorteados na plataforma.</p>
            <p>
            <p><strong>QUALIFICATÓRIAS</strong>:<br/>  
            Em cada confronto havará 2 Squads que jogarão no esquema "melhor de 3". Quem vencer 2 partidas avança para a próxima fase.
            </p>
            <p>
              <strong>PONTUAÇÃO</strong>:<br/>
              Devido à grande quantidade de partidas que teremos neste campeonato, o ÚNICO modo MJ que será utilizado <u>até às quartas de finais</u> será o "TEAM DEATHMATCH" (ou mata-mata em equipe), com pontuação máxima de 50 Kills. Os mapas de cada partida serão escolhidos aleatoriamente pela macânica do próprio jogo. 
            </p>
            <p>
               <strong>FINAIS E PREMIAÇÕES</strong>:<br/>
               Nas semi finais e finais, a única mudança é que os modos MJ "DOMINAÇÃO" e "LOCALIZAR E DESTRUIR" também farão parte dos modos selecionados. A escolha será aleatória, de acordo com a mecânica do próprio jogo. Abaixo, as premiações para os melhores colocados:<br/>
             - 1º Colocado: R$ 600,00<br/>
             - 2º Colocado: R$ 300,00<br/>
             - 3º Colocado: R$ 100,00
            </p>
            <p>
              <strong>PROIBIÇÕES</strong>:<br/>
              - Player SEM A TAG do Squad;<br/>
              - Uso de Emuladores;<br/>
              - Ofensas verbais a outros players (Regra básica, hein?!);<br/>
              - Qualquer tipo de trapaça identificada pelos organizadores;
            </p>

            <hr/>
            <p>Siga nosso perfil no Instagram. Lá, a gente mantem a comunidade informada sempre que novos campeonatos da NEXT PLAYER forem surgindo. Só clicar no ícone abaixo:
            <br/>
            <a href="https://www.instagram.com/nextplayer.plataforma/" target="_Blank"><img src="assets/images/instagram2.png" width="80px" /></a>
            </p>
          </fieldset>
        </div>
        <div class="modal-footer" id="entendidoReg" style="display: none;">
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal"><i class="fa fa-crosshairs"></i> Entendido</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="modalPremiacao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <fieldset>
            <p><legend>BR SOLO (200 Players)</legend>
              1º colocado: R$ 350,00<br/>
              2º colocado: R$ 150,00<br/>
              3º colocado: R$ 50,00<br/>
              <strong>Premiação Total: R$ 550,00</strong>
            </p>
          </fieldset>
          <br/>
          <fieldset>
           <p><legend>BR SQUAD (40 Squads)</legend>
              1º colocado: R$ 1.000,00<br/>
              2º colocado: R$ 600,00<br/>
              3º colocado: R$ 200,00<br/>
              <strong>Premiação Total: R$ 1.800,00</strong>
            </p>
          </fieldset>
          <br/>
          <fieldset>
            <p><legend>MJ Squad (32 Squads)</legend>
              1º colocado: R$ 600,00<br/>
              2º colocado: R$ 300,00<br/>
              3º colocado: R$ 100,00<br/>
              <strong>Premiação Total: R$ 1.000,00</strong>
            </p>
          </fieldset>
          <br/>
          <fieldset>
            <p><legend>Sorteio Gift Card (3 sorteios)</legend>
              1 Gift Card de R$ 50,00 sorteado dentre os que fizerem Check-in no modo BR SOLO<br/>
              1 Gift Card de R$ 50,00 sorteado dentre os que fizerem Check-in no modo BR Squad<br/>
              1 Gift Card de R$ 50,00 sorteado dentre os que fizerem Check-in no modo MJ Squad<br/>
              <strong>Premiação Total: R$ 150,00</strong>
            </p>
          </fieldset>
          <hr/>
            <p>Siga nosso perfil no Instagram. Lá, a gente mantem a comunidade informada sempre que novos campeonatos da NEXT PLAYER forem surgindo. Só clicar no ícone abaixo:
            <br/>
            <a href="https://www.instagram.com/nextplayer.plataforma/" target="_Blank"><img src="assets/images/instagram2.png" width="80px" /></a>
            </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal"><i class="fa fa-crosshairs"></i> Entendido</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/bootstrap.min.js"></script>
    <script src="vendor/jquery/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/web-app.js"></script>
    
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
    </script>

</body>
</html>