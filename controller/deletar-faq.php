<?php include "conn/functions.php";

$bd = abreConn();


$qL = mysqli_query($bd, "SELECT * from a_faqs_e WHERE id = '" . $_GET['id'] . "' ");
$rsL = mysqli_fetch_assoc($qL);

if ($rsL == NULL) {
    redirect("faqs.php");
} else {

    $qL4 = mysqli_query($bd, "DELETE FROM a_faqs_e WHERE id = '".$_GET['id']."' ");
    redirect("faqs.php");
}

mysqli_close($bd);
