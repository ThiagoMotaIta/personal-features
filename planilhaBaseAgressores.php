<?php
include('includes/funcoes.php');

date_default_timezone_set('America/Sao_Paulo');
$dia = date('d');
$mes = date('m');
$ano = date('Y');


$link = abreConn();


$q=  mysqli_query($link, "SELECT * FROM base_agressores where status = 'A' ");

// definimos o tipo de arquivo
header("Content-type: application/msexcel");

// Como será gravado o arquivo
header("Content-Disposition: attachment; filename=base_adv_agressor". $dia ."_". $mes ."_". $ano .".xls");

// montando a planilha
echo "<table align=left border=1>";
  echo "<tr align=left bgcolor=#d1ecf1 style='color:#0c5460; font-size:22px;'>";
    echo "<td colspan='3'>Base de Advogados Agressores</td>";
  echo "</tr>";
  echo "<tr align=left style='font-size:12px;'>";
    echo "<td colspan='3'>Planilha gerada em: ". $dia ."/". $mes ."/". $ano ." </td>";
  echo "</tr>";
  echo "<tr align=center bgcolor=#17a2b8 style='color:#fff;'>";
    echo "<td><strong>Seq.</strong></td>";
  echo "<td><strong>ADVOGADO AGRESSOR</strong></td>";
  //echo "<td><strong>Cita&ccedil;&atilde;o ou Notifica&ccedil;&atilde;o da parte</strong></td>";
  echo "<td><strong>STATUS</strong></td>";
  echo "</tr>";
$i=1;
while ($rs = mysqli_fetch_array($q)){
   
    echo "<tr align=center>";
    echo "<td>".$i."</td>";
    echo "<td>" . tirarAcentos($rs["nome_agressor"]) . "</td>";
    echo "<td>Base</td>";
  echo "</tr>";
  $i++;
}
 echo "<tr align=left style='font-size:12px;'>";
    echo "<td colspan='3'>SIA3 - Sistema de Buscas e Analises de Advogados Agressores - Rocha, Marinho e Sales Advogados - NIT</td>";
  echo "</tr>";
echo "</table>"; 

mysqli_close($link);
?>