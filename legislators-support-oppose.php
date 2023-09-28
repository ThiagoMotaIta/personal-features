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

$query =  mysqli_query($dbs, "SELECT legislator_id, vote_id, vote_type FROM vote_results ");

$list = array (
    array('id', 'name', 'num_supported_bills', 'num_opposed_bills')
);

// For each vote_results row, check results
while ($rs = mysqli_fetch_array($query)){
    $qL = mysqli_query($dbs, "SELECT * from legislators where id = '".$rs['legislator_id']."' ");
    $rsL = mysqli_fetch_assoc($qL);

    $qts = mysqli_query($dbs, "SELECT count(id) as totalSupported from vote_results where vote_type = '1' and legislator_id = '".$rsL['id']."' ");
    $rsts = mysqli_fetch_assoc($qts);

    $qto = mysqli_query($dbs, "SELECT count(id) as totalOpposed from vote_results where vote_type = '2' and legislator_id = '".$rL['id']."' ");
    $rsto = mysqli_fetch_assoc($qto);

    // Increase array with new data
    array_push($list, array($rsL['id'], $rsL['name'], $rsts['totalSupported'], $rsto['totalOpposed']));
}

// Close DB connection
mysqli_close($dbs);

// Create and export CSV
$fp = fopen('csv/legislators-support-oppose-count.csv', 'w');

foreach ($list as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);
?>

<div class="alert">
    The <a href='csv/legislators-support-oppose-count.csv'>legislators-support-oppose-count.csv</a> file was successfully generated! Please, click on it to download.
    <hr/>
    <a href="./">.:: Back to home</a>
</div>

