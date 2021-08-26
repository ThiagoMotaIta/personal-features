<?php
session_start();
unset($_SESSION["loggedId"]);
unset($_SESSION["loggedName"]);
unset($_SESSION["loggedEmail"]);
header("location: ../admin.php");
?>
