<?php include "../includes/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();

$sql = mysqli_query($bd, "SELECT * from n_player_p where name LIKE '%".$_GET['playerOrEmail']."%' or email LIKE '%".$_GET['playerOrEmail']."%' limit 0,5 ");
            
              
while ($rs = mysqli_fetch_array($sql)){

	// Verifica se o player ja ta em algum time do mesmo jogo
  	$sql1 = mysqli_query($bd, "SELECT * from n_team_formation_p where player_id='".$rs['id']."' and status = 'A' ");
    
    $countTimeMesmoJogo = 0;        
    while ($rs1 = mysqli_fetch_array($sql1)){
    	$qT = mysqli_query($bd, "SELECT * from n_team_p where id = '".$rs1['team_id']."' and status = 'A'" );
		$rsT = mysqli_fetch_assoc($qT);

		if ($rsT['game_id'] == $_GET['gameId']){
			$countTimeMesmoJogo = $countTimeMesmoJogo+1;
		}
    }

  	if ($countTimeMesmoJogo == 0){
  		$arr2 = array(
			"playerId" => $rs["id"],
			"playerName" => $rs["name"],
			"found" => "S",
			"hasTeam" => "N"
		);
  	} else {
  		$arr2 = array(
			"playerId" => $rs["id"],
			"playerName" => $rs["name"],
			"found" => "S",
			"hasTeam" => "S"
		);
  	}

	array_push($arr,$arr2);
}	


mysqli_close($bd);	
 
print json_encode($arr);

?>