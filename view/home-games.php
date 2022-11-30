<!-- Jogos -->
<section class="section courses" data-section="sectionJogos">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <h2>Jogos na Plataforma</h2>
        </div>
      </div>
      <div class="owl-carousel owl-theme">
        
        <?php

        $qG=  mysqli_query($bd, "SELECT * FROM n_games_p where status = 'A' order by id ");
        while ($rsG = mysqli_fetch_array($qG)){ ?>

          <div class="item">
            <a href="jogo-perfil.php?game=<?=$rsG['id']?>"><img src="assets/images/<?=$rsG['logo']?>"></a>
          </div>

        <?php } ?>


      </div>
    </div>
  </div>
</section>