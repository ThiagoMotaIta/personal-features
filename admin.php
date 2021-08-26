
<!DOCTYPE html>

<html lang="en">

<?php include "view/head.php" ?>

<body>
    <div class="wrapper">
        
        <?php include "view/side-menu-off.php" ?>

        <div class="main-panel">
            

            <!-- LOGIN -->
            <div class="content" align="center">
                <strong>ACESSO RESTRITO</strong>
                <hr/>

               <form id="formLogin" class="col-4">

                LOGIN<br/>
                <input type="text" id="login" class="form-control">
                <br/>
                SENHA<br/>
                <input type="password" id="passWord" class="form-control">
                <br/>
                <button type="button" class="btn btn-danger" onclick="verificaLogin()">Entrar</button>
            
               </form>

               <hr/>
               <span id="mnsAguard"></span>

            </div>
            

        </div>
    </div>
    
</body>

<?php include "view/sector-js.php" ?>

<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        //demo.showNotification();

    });
</script>

</html>
