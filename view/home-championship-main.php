<!-- Contagem Regressiva / Inscricao campeonatos -->
<section class="section coming-soon" data-section="sectionCampeonato" style="padding-top: 0px; margin-top: 0px;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <h2>Campeonato em Destaque</h2>
        </div>
      </div>
      <div class="col-md-7 col-xs-12" style="margin-top: 0px;">
        <div class="continer centerIt">
          <div>
            <h4>CAMPEONATO <em>CALL OF DUTY MOBILE</em> <em><u>BR SOLO EDIÇÃO LAST BLOOD</u></em>
                <br/>
                PRIZE POOL: <em>R$ 700,00</em> à <em>R$ 1.400,00</em> 
                <br/><br/>
                <div class="main-button">
                  <a href="campeonatos.php">
                    Regras
                  </a>
                  <a href="campeonatos.php">
                    Datas
                  </a>
                  <a href="campeonatos.php">
                    Prêmios
                  </a>
                </div>
              </h4>
            <div class="counter">

              <div class="days">
                <div class="value">00</div>
                <span>Dias</span>
              </div>

              <div class="hours">
                <div class="value">00</div>
                <span>Horas</span>
              </div>

              <div class="minutes">
                <div class="value">00</div>
                <span>Minutos</span>
              </div>

              <div class="seconds">
                <div class="value">00</div>
                <span>Segundos</span>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="right-content">
          <div class="top-content">
              <h6><em><h2>INSCRIÇÃO</h2></em><hr/>Éh... Nós também detestamos formulários!! <br/>Mas este aqui vai ser rapidão <i class="fa fa-thumbs-up"></i></h6>
            </div>

          <div class="alert alert-warning">
            <i class="fa fa-exclamation-triangle"></i> Caso você já tenha feito sua inscrição, aguarde a formação dos grupos e horários :)
          </div>
            
          <form id="formPreInsc" action="preInsc.php" method="POST">
              <div class="row">
                <div class="col-md-12">
                  
                  <?php if(isset($_SESSION['loggedId'])) {?>

                  <a href="campeonatos.php" class="btn btn-primary">Para se inscrever, clique aqui</a> 
                    
                  <?php } else { ?>

                   <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalAtencaoCamp"><strong>Confirmar Participação</strong></a> 

                  <?php } ?>  

              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="cookie-container" align="center">
  <small>Usamos cookies para melhorar a sua experiência. Ao navegar neste site, você concorda com a nossa <a class="link" href="politica-cookies.php" style="text-decoration: underline;">Política de Cookies</a>.
  </small>

  <button class="cookie-btn">
    Ok, concordo!
  </button>
</div>