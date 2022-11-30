<?php include "../includes/functions.php";

header('Content-Type: application/json');

$arr = array();
$bd = abreConn();
            
if( isset($_GET['soloOrTeam']) && isset($_GET['campId']) && isset($_GET['qntdGrupos']) ){


	//============================ Se for sorteio de SOLO
	if($_GET['soloOrTeam'] == "S"){


		// Quantidade Confirmados
		$qTc = mysqli_query($bd, "SELECT count(id) as totalConfirmados from n_championship_sub_p where championship_id = '".$_GET['campId']."' and payment_status = '1' and status =  'A' ");
        $rsTc = mysqli_fetch_assoc($qTc);

        $fatorDivisao = ceil($rsTc['totalConfirmados']/$_GET['qntdGrupos']);
        $iniA = 0;
        $limitA = $fatorDivisao;

        // 1 GRUPO
        if ($_GET['qntdGrupos'] == '1'){
        	// Listar os players
	        $qTf =  mysqli_query($bd, "SELECT * FROM n_championship_sub_p where status = 'A' and championship_id = '".$_GET['campId']."' limit ".$iniA.",".$limitA." ");
	        while ($rsTf = mysqli_fetch_array($qTf) ){

			    $sql = "INSERT into n_championship_groups_p (championship_id,  
											   player_id,
											   sorted_group,
											   sorted_group_points,
											   final_stage_points,
											   status) values('".$_GET['campId']."',
											   '".$rsTf['player_id']."',
											   'A',
											   '0',
											   '0,'
											   'A') " ;
				mysqli_query($bd, $sql);

	        }	

        }

        // 2 GRUPOS
        if ($_GET['qntdGrupos'] == '2'){

        	// Listar os players e insere GRUPO A
	        $qTf =  mysqli_query($bd, "SELECT * FROM n_championship_sub_p where status = 'A' and championship_id = '".$_GET['campId']."' limit ".$iniA.",".$limitA." ");
	        while ($rsTf = mysqli_fetch_array($qTf) ){

			    $sql = "INSERT into n_championship_groups_p (championship_id,  
											   player_id,
											   sorted_group,
											   sorted_group_points,
											   final_stage_points,
											   status) values('".$_GET['campId']."',
											   '".$rsTf['player_id']."',
											   'A',
											   '0',
											   '0',
											   'A') " ;
				mysqli_query($bd, $sql);

	        }

	        $iniB = $limitA;
        	$limitB = $limitA+$fatorDivisao;
	        // Listar os players e insere GRUPO B
	       $qTf =  mysqli_query($bd, "SELECT * FROM n_championship_sub_p where status = 'A' and championship_id = '".$_GET['campId']."' limit ".$iniB.",".$limitB." ");
	        while ($rsTf = mysqli_fetch_array($qTf) ){

			    $sql = "INSERT into n_championship_groups_p (championship_id,  
											   player_id,
											   sorted_group,
											   sorted_group_points,
											   final_stage_points,
											   status) values('".$_GET['campId']."',
											   '".$rsTf['player_id']."',
											   'B',
											   '0',
											   '0',
											   'A') " ;
				mysqli_query($bd, $sql);

	        }	

        }

	}

	// ==========================================vSe for sorteio de TEAM
	if($_GET['soloOrTeam'] == "T"){
		
		// Quantidade Confirmados
		$qTc = mysqli_query($bd, "SELECT COUNT(DISTINCT(team_id)) as totalConfirmados from n_championship_sub_p where championship_id = '".$_GET['campId']."' and status =  'A' and payment_status = '1' ");
        $rsTc = mysqli_fetch_assoc($qTc);

        $fatorDivisao = ceil($rsTc['totalConfirmados']/$_GET['qntdGrupos']);
        $iniA = 0;
        $limitA = $fatorDivisao;


        // 1 GRUPO
        if ($_GET['qntdGrupos'] == '1'){
        	// Listar os times
	        $qTf =  mysqli_query($bd, "SELECT distinct(team_id) FROM n_championship_sub_p where status = 'A' and championship_id = '".$_GET['campId']."' limit ".$iniA.",".$limitA." ");
	        while ($rsTf = mysqli_fetch_array($qTf) ){

			    $sql = "INSERT into n_championship_groups_p (championship_id,  
											   team_id,
											   sorted_group,
											   sorted_group_points,
											   final_stage_points,
											   status) values('".$_GET['campId']."',
											   '".$rsTf['team_id']."',
											   'A',
											   '0',
											   '0',
											   'A') " ;
				mysqli_query($bd, $sql);

	        }	

        }


        // 2 GRUPOS
        if ($_GET['qntdGrupos'] == '2'){

        	// Listar os players e insere GRUPO A
	        $qTf =  mysqli_query($bd, "SELECT distinct(team_id) FROM n_championship_sub_p where status = 'A' and championship_id = '".$_GET['campId']."' limit ".$iniA.",".$limitA." ");
	        while ($rsTf = mysqli_fetch_array($qTf) ){

			    $sql = "INSERT into n_championship_groups_p (championship_id,  
											   team_id,
											   sorted_group,
											   sorted_group_points,
											   final_stage_points,
											   status) values('".$_GET['campId']."',
											   '".$rsTf['team_id']."',
											   'A',
											   '0',
											   '0',
											   'A') " ;
				mysqli_query($bd, $sql);

	        }

	        $iniB = $limitA;
        	$limitB = $limitA+$fatorDivisao;
	        // Listar os players e insere GRUPO B
	       $qTf =  mysqli_query($bd, "SELECT distinct(team_id) FROM n_championship_sub_p where status = 'A' and championship_id = '".$_GET['campId']."' limit ".$iniB.",".$limitB." ");
	        while ($rsTf = mysqli_fetch_array($qTf) ){

			    $sql = "INSERT into n_championship_groups_p (championship_id,  
											   team_id,
											   sorted_group,
											   sorted_group_points,
											   final_stage_points,
											   status) values('".$_GET['campId']."',
											   '".$rsTf['team_id']."',
											   'B',
											   '0',
											   '0',
											   'A') " ;
				mysqli_query($bd, $sql);

	        }	

        }

	}


	$arr2 = array(
		"success" => "S"
	);


} else {
	$arr2 = array(
		"success" => "N"
	);
}

array_push($arr,$arr2);

mysqli_close($bd);	
 
print json_encode($arr);

?>