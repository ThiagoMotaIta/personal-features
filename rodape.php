<footer class="footer">
  <div class="container-fluid clearfix">
    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
      <a href="http://sistemas.rochamarinho.adv.br/nit" target="_blank" class="text-warning"><strong>NIT</strong></a> - Núcleo de Inovação e Tecnologia<br/> Rocha, Marinho E Sales Advogados</span>
    
    <span class="float-right">
      <button class="btn btn-warning btn-sm" title="Voltar ao topo" onclick="javascript: $('html, body').animate({scrollTop:0}, 'slow');"><i class="fa fa-caret-up fa-lg"></i></button>
    </span>
  </div>
</footer>

<?php

// Encerrando a conexão em cada página (Conexão é aberta no arquivo topo.php)
mysqli_close($bd);

?>