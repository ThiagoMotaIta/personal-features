<?php 
// Nao deixa passar se nao estiver logado
if (!isset($_SESSION['loggedName'])){
    redirect("index.php");
} 
?>

<div class="sidebar" data-image="assets/img/sidebar-6.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red" 
    -->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="home.php" class="simple-text">
                <img src="assets/img/logo-pref-cauc.png" width="150" />
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item" id="menuDash">
                <a class="nav-link" href="home.php">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li id="menuSol">
                <a class="nav-link" href="solicitacoes.php">
                    <i class="nc-icon nc-single-copy-04"></i>
                    <p>Solicitações</p>
                </a>
            </li>
            <li id="menuRem" style="display: none;">
                <a class="nav-link" href="./typography.html">
                    <i class="nc-icon nc-attach-87"></i>
                    <p>Remessa Banco</p>
                </a>
            </li>
        </ul>
    </div>
</div>