<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<?php

error_reporting(E_ERROR | E_PARSE);

// Set DB Connection
function abreConn(){
    $db = mysqli_connect("localhost","root","", "gov_data") or die("Can not connect to Database! " . mysqli_error());
    return $db;
}

// Connect to DB
$dbs = abreConn();

$query =  mysqli_query($dbs, "SELECT * FROM bills ");

$list = array (
    array('id', 'title', 'supporter_count', 'opposer_count')
);

// For each bills row, check results
while ($rs = mysqli_fetch_array($query)){
    $qv = mysqli_query($dbs, "SELECT id, bill_id from votes where bill_id = '".$rs['id']."' ");
    $rsv = mysqli_fetch_assoc($qv);

    $qtl = mysqli_query($dbs, "SELECT count(id) as totalSupported from vote_results where vote_type = '1' and vote_id = '".$rsv['id']."' ");
    $rstl = mysqli_fetch_assoc($qtl);

    $qtlo = mysqli_query($dbs, "SELECT count(id) as totalOppoded from vote_results where vote_type = '2' and vote_id = '".$rsv['id']."' ");
    $rstlo = mysqli_fetch_assoc($qtlo);

    // Increase array with new data
    array_push($list, array($rs['id'], $rs['title'], $rstl['totalSupported'], $rstlo['totalOppoded']));
}

// Close DB connection
mysqli_close($dbs);

// Create and export CSV
$fp = fopen('csv/bills.csv', 'w');

foreach ($list as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);
?>

<div class="alert">
    The <a href='csv/bills.csv'>bills.csv</a> file was successfully generated! Please, click on it to download.
    <hr/>
    <a href="./">.:: Back to home</a>
</div>

