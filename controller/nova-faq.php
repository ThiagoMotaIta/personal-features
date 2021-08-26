<?php include "../conn/functions.php";

$bd = abreConn();

$today = date('Y-m-d H:i:s');


if (isset($_POST[''])) {

    redirect("../faqs.php");

} else {

    $sql = "INSERT into a_faqs_e (pergunta,  
                                    resposta,
                                    status) 
            VALUES ('".$_POST['nova-pergunta']."',
                    '".$_POST['nova-resposta']."',
                    'A') " ;
    mysqli_query($bd, $sql);

    redirect("../faqs.php");

}

mysqli_close($bd);
