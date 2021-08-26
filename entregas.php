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

                    <p align="right">
                        <a href="entregas-por-id-aluno.php" class="btn btn-primary">Buscar por <strong>IDENTIFICADOR DO ALUNO</strong></a>
                    </p>

                    <hr/>

                    <div class="row">
                        <form>
                            <label>Informe o <strong>CPF DO RESPONSÁVEL</strong> (não é o cpf do aluno)</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="cpf" data-mask="000.000.000-00">
                            </div>
                            <button type="button" class="btn btn-primary" onclick="pesquisaTabletRecebido()"><i class='fa fa-search'></i> Pesquisar</button> <small style="display: none;" id="loading-tuplas"><i class='fa fa-spinner fa-spin'></i> Carregando...</small>
                        </form>
                    </div>
     
                    <?php //Lista as solicitacoes com este CPF de responsavel 
                    if (isset($_GET['cpf'])){ ?>
                    
                    <hr/>

                    <table class="table table-striped" id="listaSol">
                        <thead class="table">
                          <tr>
                            <th scope="col"><strong>ID. Aluno</strong></th>
                            <th scope="col"><strong>Aluno</strong></th>
                            <th scope="col"><strong>Série</strong></th>
                            <th scope="col"><strong>Escola</strong></th>
                            <th scope="col"><strong>Solicitação</strong></th>
                            <th scope="col"><strong>Informações</strong></th>
                            <th scope="col"><strong>Opções</strong></th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 

                        $bd = abreConn();

                        // Dados do Solicitante
                        $qS1 = mysqli_query($bd, "SELECT * from a_solicitantes_e where cpf = '".$_GET['cpf']."' and status = 'A' ");
                        $rsS1 = mysqli_fetch_assoc($qS1);

                        if ($rsS1 == null){ ?>
                            <tr>
                            <td colspan="8"><span class="text-danger"><strong><i class="fa fa-exclamation-triangle"></i> ERRO</strong>: Não há solicitações cadastradas para o CPF <strong><?=$_GET['cpf']?></strong>.</span></td>
                        </tr>
                        <?php }

                        $qSol=  mysqli_query($bd, "SELECT * FROM a_solicitacoes_e where id_solicitante = '".$rsS1['id']."' and status = 'A' ORDER BY id DESC ");
                        while ($rsSol = mysqli_fetch_array($qSol)){

                            // Dados da Escola
                            $qE = mysqli_query($bd, "SELECT * from a_escolas_e where inep = '".$rsSol['aluno_escola']."' and status = 'A' ");
                            $rsE = mysqli_fetch_assoc($qE);

                            // Situacao Beneficio
                            if ($rsSol['situacao_beneficio'] == 0){
                                $sitBen = "EM ANÁLISE";
                            }
                            if ($rsSol['situacao_beneficio'] == 1){
                                $sitBen = "<strong class='text-primary'>APROVADO</strong>";
                            }
                            if ($rsSol['situacao_beneficio'] == 2){
                                $sitBen = "<strong class='text-danger'>REPROVADO</strong>";
                            }

                            // Situacao Aliemntacao
                            if ($rsSol['situacao_alimentacao'] == 0){
                                $sitAli = "EM ANÁLISE";
                            }
                            if ($rsSol['situacao_alimentacao'] == 1){
                                $sitAli = "<strong class='text-primary'>APROVADO</strong>";
                            }
                            if ($rsSol['situacao_alimentacao'] == 2){
                                $sitAli = "<strong class='text-danger'>REPROVADO</strong>";
                            }

                            // Situacao Tablet
                            if ($rsSol['situacao_tablet'] == 0){
                                $sitTab = "EM ANÁLISE";
                            }
                            if ($rsSol['situacao_tablet'] == 1){
                                $sitTab = "<strong class='text-primary'>APROVADO</strong>";
                            }
                            if ($rsSol['situacao_tablet'] == 2){
                                $sitTab = "<strong class='text-danger'>REPROVADO</strong>";
                            }
                            if ($rsSol['situacao_tablet'] == 3){
                                $sitTab = "<strong class='text-success'>ENTREGUE</strong>";
                            }

                            if ($rsSol['status_alimentacao'] == 0){
                                $sitAli = "<span class='text-secondary'>NÃO SOLICITADO</span>";
                            }

                            if ($rsSol['status_beneficio'] == 0){
                                $sitBen = "<span class='text-secondary'>NÃO SOLICITADO</span>";
                            }

                            if ($rsSol['status_alimentacao'] == 0){
                                $sitAli = "<span class='text-secondary'>NÃO SOLICITADO</span>";
                            }

                            if ($rsSol['status_tablet'] == 0){
                                $sitTab = "<span class='text-secondary'>NÃO SOLICITADO</span>";
                            }


                            // Verificacoes da escola
                            if ($rsSol['aluno_escola'] == 0){
                                $escola = '--';
                            } else {
                                $escola = $rsE['escola'];
                            }

                            $serie = $rsSol['aluno_serie'];

                            if ($rsSol['aluno_serie'] == 0){
                                $serie = '--';
                            }

                            if ($rsSol['aluno_serie'] == 21){
                                $serie = 'EJA I (1° ao 3° ano)';
                            }
                            if ($rsSol['aluno_serie'] == 22){
                                $serie = 'EJA II (4° e 5° ano)';
                            }
                            if ($rsSol['aluno_serie'] == 23){
                                $serie = 'EJA III (6° e 7° ano)';
                            }
                            if ($rsSol['aluno_serie'] == 24){
                                $serie = 'EJA IV (8° e 9° ano)';
                            }
                        ?>

                        <tr>
                            <td><small><?=$rsSol['aluno_matricula']?></small></td>
                            <td><small><?=$rsSol['aluno_nome']?></small></td>
                            <td><small><?=$serie?></small></td>
                            <td><small><?=$escola?></small></td>
                            <td><small id='sitTab-tupla-<?=$rsSol['id']?>'><?=$sitTab?></small></td>
                            <td>
                                <button class="btn btn-sm btn-secondary" onclick="chamaModalInfo(<?=$rsSol['id']?>)"><i class="fa fa-list"></i></button> 
                                <?php if ($rsSol['situacao_tablet'] < 3){ ?>
                                <button class="btn btn-sm btn-secondary" onclick="chamaModalEdit(<?=$rsSol['id']?>)"><i class="fa fa-pencil"></i></button>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($rsSol['situacao_tablet'] == 1){ ?>
                                    <button class="btn btn-sm btn-primary" onclick="chamaModalEntregar(<?=$rsSol['id']?>)"><i class="fa fa-check-circle"></i></button>
                                <?php } ?>
                            </td>
                        </tr>

                          <!-- Modal -->
                          <div class="modal fade" id="modalInfo-<?=$rsSol['id']?>" tabindex="-1" aria-hidden="true" style="margin-top: 0px;">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <div class="modal-header">
                                  <strong>Mais Informações</strong>
                                </div>

                                <div class="modal-body">
                                    <small>
                                        <strong>DADOS PESSOAIS DO SOLICITANTE</strong><br/>
                                        <div class="row">
                                            <div class="col-6">
                                                <strong>Nome</strong><br/>
                                                <?=$rsS1['solicitante_nome']?>
                                            </div>
                                            <div class="col-6">
                                                <strong>Data de Nascimento</strong><br/>
                                                <?=$rsS1['data_nascimento']?>
                                            </div>
                                            <div class="col-6">
                                                <strong>CPF</strong><br/>
                                                <?=$rsS1['cpf']?>
                                            </div>
                                            <div class="col-6">
                                                <strong>RG</strong><br/>
                                                <?=$rsS1['rg']?>
                                            </div>
                                            <div class="col-6">
                                                <strong>Celular</strong><br/>
                                                <?=$rsS1['telefone_celular']?>
                                            </div>
                                        </div>

                                        <strong>ENDEREÇO DO SOLICITANTE</strong><br/>
                                        <div class="row">
                                            <div class="col-6">
                                                <strong>CEP</strong><br/>
                                                <?=$rsS1['end_cep']?>
                                            </div>
                                            <div class="col-6">
                                                <strong>Bairro</strong><br/>
                                                <?=$rsS1['end_bairro']?>
                                            </div>
                                            <div class="col-6">
                                                <strong>Estado</strong><br/>
                                                <?=$rsS1['end_estado']?>
                                            </div>
                                            <div class="col-6">
                                                <strong>Cidade</strong><br/>
                                                <?=$rsS1['end_cidade']?>
                                            </div>
                                            <div class="col-6">
                                                <strong>Logradouro</strong><br/>
                                                <?=$rsS1['end_logradouro']?>
                                            </div>
                                            <div class="col-6">
                                                <strong>Número</strong><br/>
                                                <?=$rsS1['end_numero']?>
                                            </div>
                                        </div>

                                        
                                    </small>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" onclick="chamaModalInfo(<?=$rsSol['id']?>)"> Fechar</button>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>


                          <!-- Modal -->
                          <div class="modal fade" id="modalEntregar-<?=$rsSol['id']?>" tabindex="-1" aria-hidden="true" style="margin-top: 0px;">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <div class="modal-header">
                                  <strong>Entrega Individual de Tablet</strong>
                                </div>

                                <div class="modal-body">
                                    <small>
                                        <?php if ($rsSol['status_tablet'] == 1){ ?>
                                        <div class="row">
                                            <div class="col-6">
                                                Tablet foi entregue?
                                            </div>
                                            <div class="col-6">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                  <button type="button" id="btnTablApr-<?=$rsSol['id']?>" onclick="confirmarReceberTablet(<?=$rsSol['id']?>)" class="btn btn-secondary">Marcar como Entregue</button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                    </small>
                                    <hr/>
                                </div>
                                <div class="modal-footer">
                                    <span style="display: none;" id="loading-<?=$rsSol['id']?>"><i class='fa fa-spinner fa-spin'></i></span>

                                    <div class="alert alert-success" style="display: none;" id="sucessoEntrega-<?=$rsSol['id']?>">
                                        <strong>SUCESSO</strong>: Tablet marcado como entregue!
                                        <br/>
                                        <button class="btn btn-success" style="background-color: #fff;" onclick="chamaModalEntregar(<?=$rsSol['id']?>)">OK</button>
                                    </div>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>


                          <!-- Modal -->
                          <div class="modal fade" id="modalEdit-<?=$rsSol['id']?>" tabindex="-1" aria-hidden="true" style="margin-top: 0px;">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <div class="modal-header">
                                  <strong>Editar Solicitação <?=$sitTab?></strong>
                                </div>

                                <div class="modal-body">
                                    
                                    <form id="form-edit-sol-admin-<?=$rsSol['id']?>" method="post" action="edit-sol-admin.php?idSol=<?=$rsSol['id']?>">
                                        <input type="hidden" name="id-sol-<?=$rsSol['id']?>" value="<?=$rsSol['id']?>">

                                        <input type="text" class="form-control" id="id-aluno-<?=$rsSol['id']?>" name="id-aluno-<?=$rsSol['id']?>" value="<?=$rsSol['aluno_matricula']?>" placeholder="Identificador do Aluno" data-mask="000000000000">
                                        <br/>
                                        <input type="text" class="form-control" id="nome-aluno-<?=$rsSol['id']?>" name="nome-aluno-<?=$rsSol['id']?>" value="<?=$rsSol['aluno_nome']?>" placeholder="Nome Completo do Aluno">
                                        <br/>
                                        <select class="form-control" id="serie-aluno-<?=$rsSol['id']?>" name="serie-aluno-<?=$rsSol['id']?>">
                                            <option value="<?=$rsSol['aluno_serie']?>"><?=$serie?></option>
                                            <option value="1">1º ano</option>
                                            <option value="2">2º ano</option>
                                            <option value="3">3º ano</option>
                                            <option value="4">4º ano</option>
                                            <option value="5">5º ano</option>
                                            <option value="6">6º ano</option>
                                            <option value="7">7º ano</option>
                                            <option value="8">8º ano</option>
                                            <option value="9">9º ano</option>
                                            <option value="21">EJA I (1° ao 3° ano)</option>
                                            <option value="22">EJA II (4° e 5° ano)</option>
                                            <option value="23">EJA III (6° e 7° ano)</option>
                                            <option value="24">EJA IV (8° e 9° ano)</option>
                                          </select>
                                          <br/>
                                          <select class="form-control" id="escola-aluno-<?=$rsSol['id']?>" name="escola-aluno-<?=$rsSol['id']?>">
                                            <option value="<?=$rsSol['aluno_escola']?>"><?=$escola?></option>
                                            
                                            <?php 
                                            $qEs=  mysqli_query($bd, "SELECT * FROM a_escolas_e where status = 'A' ORDER BY escola");
                                            while ($rsEs = mysqli_fetch_array($qEs)){
                                            ?>
                                            <option value="<?=$rsEs['inep']?>"><?=$rsEs['escola']?> - <?=$rsEs['condicao']?></option>
                                            <?php } ?>

                                          </select>
                                    </form>

                                    <hr/>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" onclick="editarSolAdmin(<?=$rsSol['id']?>)"> Editar</button>
                                    <span style="display: none;" id="loadingEdit-<?=$rsSol['id']?>"><i class='fa fa-spinner fa-spin'></i></span>
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

                    <?php } // Fim Lista solicitacoes com este CPF?>
                    
                    <hr/>
                    <div align="right">
                        <!--<a href="controller/rel-excel.php" class="btn btn-primary  btn-sm"><i class="fa fa-file"></i> Exportar Relatório</a>-->
                        <a href="controller/rel-excel-entregues.php" class="btn btn-primary  btn-sm"><i class="fa fa-file"></i> Relatório de Entregas</a>                            
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

        $("#menuEntregas").removeAttr("class");
        $("#menuEntregas").attr("class", "active");

    });

    function chamaModalInfo(idSol){
        $('#modalInfo-'+idSol).modal('toggle');
    }

    function chamaModalEntregar(idSol){
        $('#modalEntregar-'+idSol).modal('toggle');
    }

    function chamaModalEdit(idSol){
        $('#modalEdit-'+idSol).modal('toggle');
    }    

    function pesquisaTabletRecebido(){

        $("#loading-tuplas").show();

        var validado = true;

        if ($("#cpf").val() == ""){
            validado = false;
        } else {
            var val = $("#cpf").val();
            if (val.match(/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/) != null) {
                var val1 = val.substring(0, 3);
                var val2 = val.substring(4, 7);
                var val3 = val.substring(8, 11);
                var val4 = val.substring(12, 14);

                var i;
                var number;
                var result = true;

                number = (val1 + val2 + val3 + val4);

                s = number;
                c = s.substr(0, 9);
                var dv = s.substr(9, 2);
                var d1 = 0;

                for (i = 0; i < 9; i++) {
                    d1 += c.charAt(i) * (10 - i);
                }

                if (d1 == 0)
                    result = false;

                d1 = 11 - (d1 % 11);
                if (d1 > 9) d1 = 0;

                if (dv.charAt(0) != d1)
                    result = false;

                d1 *= 2;
                for (i = 0; i < 9; i++) {
                    d1 += c.charAt(i) * (11 - i);
                }

                d1 = 11 - (d1 % 11);
                if (d1 > 9) d1 = 0;

                if (dv.charAt(1) != d1)
                    result = false;
                
                if (!result){
                    validado = false;
                }
            }    
        }

        if (validado){
            window.location.href = "entregas.php?cpf="+$("#cpf").val();
        } else {
            $.notify({
                icon: "nc-icon nc-chat-round",
                message: "<strong>CPF</strong> inválido"

            }, {
                type: type[4],
                timer: 8000,
            });
            $("#loading-tuplas").hide();
        }
    }


    // Aprovar ou Reprovar individual
    function confirmarReceberTablet(idSol){

        $("#loading-"+idSol).show();
        $("#sucessoEntrega-"+idSol).hide();

        // TABLET        
        $("#btnTablApr-"+idSol).removeAttr("class");
        $("#btnTablApr-"+idSol).attr("class", "btn btn-success");
        $("#btnTablRep-"+idSol).removeAttr("class");
        $("#btnTablRep-"+idSol).attr("class", "btn btn-secondary");

        $.ajax({
         url : 'controller/entregar-tablet.php?idSol='+idSol,
         type : 'GET',
         dataType: 'json',
         success: function(data){
            console.log(data);
            if (data[0].success == 'S'){
                $("#loading-"+idSol).hide();
                $("#sucessoEntrega-"+idSol).show();
                $("#sitTab-tupla-"+idSol).html("<strong class='text-success'>ENTREGUE</strong>")
            } else {
                $("#loading-"+idSol).hide();
            }
         },
         error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
         }
        });

    }


    function editarSolAdmin(idSol){
        
        var validado=true;

        if ($("#id-aluno-"+idSol).val() == ""){
            validado = false;
        }
        if ($("#nome-aluno-"+idSol).val() == ""){
            validado = false;
        }
        if ($("#serie-aluno-"+idSol).val() == 0){
            validado = false;
        }
        if ($("#escola-aluno-"+idSol).val() == ""){
            validado = false;
        }

        if (validado){
            var formulario = document.getElementById('form-edit-sol-admin-'+idSol);
            formulario.submit();
        } else {
            $.notify({
                icon: "nc-icon nc-chat-round",
                message: "<strong>Todos os campos</strong> precisam ser informadoa na Edição"

            }, {
                type: type[4],
                timer: 8000,
            });
            $("#loading-tuplas").hide();
        }
    }
</script>

</html>
