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
                    
                    <div class="row">
                        <div class="col-9" align="right">
                        </div>
                        <div class="col-3" align="right">
                            <input type="text" id="searchSol" class="form-control" placeholder="Buscar Solicitação">
                        </div>
                    </div>

                    <hr/>

                    <div class="row">
                        
                        <table class="table table-striped" id="listaLogs">
                            <thead class="table">
                              <tr>
                                <th scope="col"><strong>Tipo Log</strong></th>
                                <th scope="col"><strong>Log</strong></th>
                                <th scope="col"><strong>Situação</strong></th>
                                <th scope="col"><strong>Data</strong></th>
                                <th scope="col"><strong>Solicitante</strong></th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php 

                            $bd = abreConn();

                            // Total no banco
                            $qTotal = mysqli_query($bd, "SELECT count(*) as totalLog FROM a_logs_e");
                            $rsTotal = mysqli_fetch_assoc($qTotal);

                            $limite = 10; // Limite por pagina

                            $ultimaPag = $rsTotal['totalLog']/$limite; // Ultima pagina para mostrar

                            // Pega página atual, se houver e for valido (maior que zero!)
                            if( isset( $_GET['pag'] ) && (int)$_GET['pag'] >= 0){
                                $pagina = (int)$_GET['pag'];
                            }else{
                                $pagina = 0;
                            }

                            // Calcula o offset
                            $offset = $limite * $pagina;

                            $qLog=  mysqli_query($bd, "SELECT * FROM a_logs_e ORDER BY id DESC LIMIT ".$limite." OFFSET ".$offset." ");
                            while ($rsLog = mysqli_fetch_array($qLog)){

                                $qS1 = mysqli_query($bd, "SELECT * from a_solicitantes_e where id = '".$rsLog['id_solicitante']."' and status = 'A' ");
                                $rsS1 = mysqli_fetch_assoc($qS1);
                            ?>

                            <tr>
                                <td><small><?=$rsLog['titulo']?></small></td>
                                <td><small><?=$rsLog['descricao']?></small></td>
                                <td><small><?=$rsLog['situacao']?></small></td>
                                <td><small><?php echo date("d/m/Y", strtotime($rsLog['data']));?></small></td>
                                <td><small><?=$rsS1['solicitante_nome']?></small></td>
                            </tr>

                            <?php if ($rsLog['id'] == ''){ ?>
                                <tr>
                                <td colspan="8"><small>Lista Finalizada</small></td>
                            </tr>
                            <?php } ?>

                            <?php } 

                            mysqli_close($bd);

                            ?>
                            </tbody>
                        </table>

                    </div>

                    <hr/>
                        <div align="right">
                            <?php if($pagina !== 0){ ?>
                            <a href="logs.php?pag=<?=$pagina-1?>" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-circle-left"></i> Anterior</a>
                            <?php } ?>

                            <?php if ($pagina < $ultimaPag){ ?>
                            <a href="logs.php?pag=<?=$pagina+1?>" class="btn btn-secondary btn-sm">Próximo <i class="fa fa-arrow-circle-right"></i></a>
                            <?php } ?>                            
                        </div>
                        
                        <hr/>
                        <div align="right">
                            <!--<a href="controller/rel-excel.php" class="btn btn-primary  btn-sm"><i class="fa fa-file"></i> Exportar Relatório</a>-->
                            <a href="solicitacoes.php" class="btn btn-primary  btn-sm"><i class="fa fa-file"></i> Solicitações</a>                            
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

    });

    function chamaModalInfo(idSol){
        $('#modalInfo-'+idSol).modal('toggle');
    }

    function chamaModalAprov(idSol){
        $('#modalAprov-'+idSol).modal('toggle');
    }
</script>

</html>
