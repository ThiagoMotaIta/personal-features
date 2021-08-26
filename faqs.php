<?php include "conn/functions.php";?>
<!DOCTYPE html>

<html lang="en">

<?php include "view/head.php" ?>

<body>
    <div class="wrapper">
        
        <?php include "view/side-menu.php" ?>

        <div class="main-panel">
            
            <?php include "view/top-menu.php" ?>

            <div class="content">
                <div class="container-fluid">
                    
                    <div align="right">
                        <button type="button" class="btn btn-primary" onclick="chamaModalNovaPergunta()"><i class="fa fa-plus-circle"></i> Nova Pergunta</button>
                    </div>

                    <hr/>

                    <div class="row">
                        
                        <table class="table table-striped" id="listaSol">
                            <thead class="table">
                              <tr>
                                <th scope="col"><strong>ID</strong></th>
                                <th scope="col"><strong>Pergunta</strong></th>
                                <th scope="col"><strong>Resposta</strong></th>
                                <th scope="col"><strong>Opções</strong></th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php 

                            $bd = abreConn();

                            $qF =  mysqli_query($bd, "SELECT * FROM a_faqs_e where status = 'A' ORDER BY id DESC ");
                            while ($rs = mysqli_fetch_array($qF)){ ?>


                            <?php if ($rs == null){ ?>
                                <tr>
                                <td colspan="4"><small>Ainda não há perguntas Cadastradas</small></td>
                            </tr>
                            <?php } ?>


                            <tr>
                                <td><small><?=$rs['id']?></small></td>
                                <td><small><?=$rs['pergunta']?></small></td>
                                <td><small><?=$rs['resposta']?></small></td>
                                <td>
                                    <button class="btn btn-sm btn-danger" onclick="chamaModalDeletar(<?=$rs['id']?>)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                              <!-- Modal -->
                              <div class="modal fade" id="modalInfo-<?=$rs['id']?>" tabindex="-1" aria-hidden="true" style="margin-top: 0px;">
                                <div class="modal-dialog">
                                  <div class="modal-content">

                                    <div class="modal-header">
                                      <strong>Deletar Pergunta</strong>
                                    </div>

                                    <div class="modal-body">
                                        Deseja Realmente apagar esta Pergunta?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" onclick="deletarPergunta(<?=$rs['id']?>)"> Apagar</button>
                                    </div>
                                    </form>
                                  </div>
                                </div>
                              </div>

                            <?php } 

                            mysqli_close($bd);

                            ?>
                            </tbody>
                        </table>

                    </div>

                    <hr/>
                        
                    <!-- Modal -->
                      <div class="modal fade" id="modalNovaPergunta" tabindex="-1" aria-hidden="true" style="margin-top: 0px;">
                        <div class="modal-dialog">
                          <div class="modal-content">

                            <div class="modal-header">
                              <strong>Nova Pergunta</strong>
                            </div>

                            <div class="modal-body">
                                <form name="formNovaPergunta" id="formNovaPergunta" action="controller/nova-faq.php" method="post">
                                    <div class="form-group">
                                        <label>Nova Pergunta (até 250 caracteres)</label>
                                        <input type="text" name="nova-pergunta" id="nova-pergunta" class="form-control" placeholder="Nova Pergunta" maxlength="250">
                                    </div>
                                    <div class="form-group">
                                        <label>Resposta (até 250 caracteres)</label>
                                        <input type="text" name="nova-resposta" id="nova-resposta" class="form-control" placeholder="Resposta" maxlength="250">
                                    </div>                                    
                                </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary" onclick="novaPergunta()"> Incluir</button> <span style="display:none;" class="fa fa-spinner fa-spin" id="load-nova-pergunta"></span>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>    

                </div>
            </div>
            
            <?php include "view/footer.php" ?>

        </div>
    </div>
</body>

<?php include "view/sector-js.php" ?>

<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        //demo.initDashboardPageCharts();

        //demo.showNotification();

        $("#menuFaqs").removeAttr("class");
        $("#menuFaqs").attr("class", "active");

    });

    function chamaModalDeletar(idSol){
        $('#modalInfo-'+idSol).modal('toggle');
    }

    function chamaModalAprov(idSol){
        $('#modalAprov-'+idSol).modal('toggle');
    }

    function chamaModalNovaPergunta(){
        $('#modalNovaPergunta').modal('toggle');
    }

    function deletarPergunta(id){
        window.location.href = "controller/deletar-faq.php?id="+id;
    }

    function novaPergunta(){

        var validado = true;

        if ($("#nova-pergunta").val() == ""){
            validado = false;
        }

        if ($("#nova-resposta").val() == ""){
            validado = false;
        }

        if (validado){
            $("#load-nova-pergunta").show();
            var formulario = document.getElementById('formNovaPergunta');
            formulario.submit();
        } else {
            $.notify({
                icon: "nc-icon nc-chat-round",
                message: "<strong>Pergunta</strong> e <strong>Resposta</strong> precisam ser informadas"

            }, {
                type: type[4],
                timer: 8000,
            });
        }
    }
</script>

</html>
