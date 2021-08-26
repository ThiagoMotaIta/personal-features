<!DOCTYPE html>
<html lang="en">
    <?php include "view/head.php"?>

    <body id="page-top">
        
        <?php include "view/menu-top.php"?>

        <!-- Mensagem Sucesso -->
        <section id="consultaSol-form">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8 alert div-area" id="etapa1">
                        
                        <?php if(isset($_GET['sm'])){ ?>
                          
                          <?php if($_GET['sm'] == '1'){ ?>
                          <div class="alert alert-success">
                            <strong>SUCESSO!</strong>
                            <hr/>
                            Sua solicitação foi reenviada e encontra-se novamente <strong>EM ANÁLISE</strong>. Acompanhe a atualização da sua solicitação neste portal, informando seu CPF no menu "CONSULTAR SOLICITAÇÕES". Caso a solicitação seja novamente reprovada, procure a escola onde seu filho está matriculado para maiores informações.
                          </div>
                          <?php } else { ?>
                          <div class="alert alert-danger">
                            <strong>ERRO!</strong>
                            <hr/>
                            Sua Solicitação não foi processada corretamente. Tente novamente!!
                          </div>
                          <?php } ?>
                        
                        <?php } ?>

                        <div align="center">
                          <a class="btn btn-danger" href="./">Concluir</a>
                        </div>

                    </div>
                </div>
            </div>
        </section>

       
       <?php include "view/footer.php"?>

       <script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
       <script src="js/jquery.mask.js" type="text/javascript"></script>
       <script src="js/web-app-solicitante.js?10" type="text/javascript"></script>
    </body>
</html>
