<?php
session_start();
unset($_SESSION["loggedId"]);
unset($_SESSION["loggedPlayerName"]);
unset($_SESSION["loggedPlayerEmail"]);

unset($_SESSION["loggedPlayerLevel"]);
unset($_SESSION["loggedPlayerAvatar"]);
unset($_SESSION["loggedPlayerAvatarPng"]);
unset($_SESSION["loggedPlayerXp"]);
unset($_SESSION["loggedPlayerCoins"]);

//unset($_SESSION["idioma"]);
header("location: ../");
?>
