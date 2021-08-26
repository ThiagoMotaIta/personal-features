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
                    
                    <hr/>

                    <div class="row">
                        
                        <table class="table table-striped" id="listaSol">
                            <thead class="table">
                              <tr>
                                <th scope="col"><strong>ID. Aluno</strong></th>
                                <th scope="col"><strong>Aluno</strong></th>
                                <th scope="col"><strong>Data Nasc.</strong></th>
                                <th scope="col"><strong>CPF</strong></th>
                                <th scope="col"><strong>Solicitação</strong></th>
                                <th scope="col"><strong>Informações</strong></th>
                                <th scope="col"><strong>Opções</strong></th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php 

                            $bd = abreConn();

                            // Total no banco
                            $qTotal = mysqli_query($bd, "SELECT count(*) as totalSol FROM a_solicitacoes_e where status = 'A' ");
                            $rsTotal = mysqli_fetch_assoc($qTotal);

                            $limite = 10; // Limite por pagina

                            $ultimaPag = $rsTotal['totalSol']/$limite; // Ultima pagina para mostrar

                            // Pega página atual, se houver e for valido (maior que zero!)
                            if( isset( $_GET['pag'] ) && (int)$_GET['pag'] >= 0){
                                $pagina = (int)$_GET['pag'];
                            }else{
                                $pagina = 0;
                            }

                            // Calcula o offset
                            $offset = $limite * $pagina;

                            $qSol=  mysqli_query($bd, "SELECT * FROM a_solicitacoes_e where status = 'A' ORDER BY id DESC LIMIT ".$limite." OFFSET ".$offset." ");
                            while ($rsSol = mysqli_fetch_array($qSol)){

                                $qS1 = mysqli_query($bd, "SELECT * from a_solicitantes_e where id = '".$rsSol['id_solicitante']."' and status = 'A' ");
                                $rsS1 = mysqli_fetch_assoc($qS1);

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
                            ?>

                            <tr>
                                <td><small><?=$rsSol['aluno_matricula']?></small></td>
                                <td><small><?=$rsSol['aluno_nome']?></small></td>
                                <td><small><?php echo date("d/m/Y", strtotime($rsSol['aluno_nascimento']));?></small></td>
                                <td><small><?=$rsSol['aluno_cpf']?></small></td>
                                <td><small><?=$sitTab?></small></td>
                                <td>
                                    <button class="btn btn-sm btn-secondary" onclick="chamaModalInfo(<?=$rsSol['id']?>)"><i class="fa fa-list"></i></button>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="chamaModalAprov(<?=$rsSol['id']?>)"><i class="fa fa-check-circle"></i></button>
                                </td>
                            </tr>

                            <?php if ($rsSol['id'] == ''){ ?>
                                <tr>
                                <td colspan="8"><small>Lista Finalizada</small></td>
                            </tr>
                            <?php } ?>

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
                              <div class="modal fade" id="modalAprov-<?=$rsSol['id']?>" tabindex="-1" aria-hidden="true" style="margin-top: 0px;">
                                <div class="modal-dialog">
                                  <div class="modal-content">

                                    <div class="modal-header">
                                      <strong>Aprovação Individual</strong> <span class="text-primary"><?=$rsSol['aluno_nome']?> / <?=$rsSol['aluno_matricula']?></span>
                                    </div>

                                    <div class="modal-body">
                                        <small>
                                            <?php if ($rsSol['status_beneficio'] == 1){ ?>
                                            <div class="row">
                                                <div class="col-6">
                                                    Auxílio Emergencial
                                                </div>
                                                <div class="col-6">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                      <button type="button" id="btnAuxApr-<?=$rsSol['id']?>" class="btn btn-secondary" onclick="aprovarReprovarItem(<?=$rsSol['id']?>, 'aux', 'A')">Aprovar</button>
                                                      <button type="button" id="btnAuxRep-<?=$rsSol['id']?>" class="btn btn-secondary" onclick="aprovarReprovarItem(<?=$rsSol['id']?>, 'aux', 'R')">Reprovar</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <br/>
                                            <?php } ?>
                                            <?php if ($rsSol['status_alimentacao'] == 1){ ?>
                                                <div class="row">
                                                    <div class="col-6">
                                                        Cesta Básica de Alimentação
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                          <button type="button" id="btnAlimApr-<?=$rsSol['id']?>" onclick="aprovarReprovarItem(<?=$rsSol['id']?>, 'alim', 'A')" class="btn btn-secondary">Aprovar</button>
                                                          <button type="button" id="btnAlimRep-<?=$rsSol['id']?>" onclick="aprovarReprovarItem(<?=$rsSol['id']?>, 'alim', 'R')" class="btn btn-secondary">Reprovar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br/>
                                            <?php } ?>

                                            <?php if ($rsSol['status_tablet'] == 1){ ?>
                                            <div class="row">
                                                <div class="col-6">
                                                    Tablet
                                                </div>
                                                <div class="col-6">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                      <button type="button" id="btnTablApr-<?=$rsSol['id']?>" onclick="aprovarReprovarItem(<?=$rsSol['id']?>, 'tablet', 'A')" class="btn btn-secondary">Aprovar</button>
                                                      <button type="button" id="btnTablRep-<?=$rsSol['id']?>" onclick="aprovarReprovarItem(<?=$rsSol['id']?>, 'tablet', 'R')" class="btn btn-secondary">Reprovar</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            
                                        </small>
                                        <hr/>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-primary" onclick="confirmarAproRepr(<?=$rsSol['id']?>)"> Confirmar</button> <span style="display: none;" id="loading-<?=$rsSol['id']?>"><i class='fa fa-spinner fa-spin'></i></span>
                                      <button type="button" class="btn btn-secondary" onclick="chamaModalAprov(<?=$rsSol['id']?>)"> Fechar</button>
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

                        <table class="table table-striped" id="listaSolBusca" style="display: none;">
                            <thead class="table">
                              <tr>
                                <th scope="col"><strong>Matrícula</strong></th>
                                <th scope="col"><strong>Aluno</strong></th>
                                <th scope="col"><strong>Data Nasc.</strong></th>
                                <th scope="col"><strong>CPF</strong></th>
                                <th scope="col"><strong>Status Benefício</strong></th>
                                <th scope="col"><strong>Status Alimentação</strong></th>
                                <th scope="col"><strong>Status Tablet</strong></th>
                                <th scope="col"><strong>Informações</strong></th>
                                <th scope="col"><strong>Opções</strong></th>
                              </tr>
                            </thead>
                            <tbody id="bodyBuscaSol">
                                
                            </tbody>
                        </table>

                    </div>

                    <hr/>
                        <div align="right">
                            <?php if($pagina !== 0){ ?>
                            <a href="solicitacoes.php?pag=<?=$pagina-1?>" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-circle-left"></i> Anterior</a>
                            <?php } ?>

                            <?php if ($pagina < $ultimaPag){ ?>
                            <a href="solicitacoes.php?pag=<?=$pagina+1?>" class="btn btn-secondary btn-sm">Próximo <i class="fa fa-arrow-circle-right"></i></a>
                            <?php } ?>                            
                        </div>
                        
                        <hr/>
                        <div align="right">
                            <a href="controller/rel-excel.php" class="btn btn-primary  btn-sm"><i class="fa fa-file"></i> Exportar Relatório</a>
                            <a href="logs.php" class="btn btn-primary  btn-sm"><i class="fa fa-clock-o"></i> Logs</a>                            
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

        $("#menuSol").removeAttr("class");
        $("#menuSol").attr("class", "active");

    });

    function chamaModalInfo(idSol){
        $('#modalInfo-'+idSol).modal('toggle');
    }

    function chamaModalAprov(idSol){
        $('#modalAprov-'+idSol).modal('toggle');
    }
</script>

</html>
