<?php 
	session_start();
	include_once('../../connect.php');

	$result = mysqli_query($conn, 'SELECT m.*, b.Team AS Team1 FROM tipper_matchup_buli m, benutzer b WHERE m.tipper1_id = b.benutzer_id ');

	$matchups = [];
	while($rs = mysqli_fetch_assoc($result)) {
		$match = [];
		$match['MatchupID'] = $rs['matchup_id'];
		$match['LigaID'] = $rs['liga_id'];
		$match['Spieltag'] = $rs['spieltag'];
		$match['Tipper1ID'] = $rs['tipper1_id'];
		$match['Tipper2ID'] = $rs['tipper2_id'];
		$match['htPointsT1'] = $rs['htPointsT1'];
		$match['htPointsT2'] = $rs['htPointsT2'];
		$match['PointsT1'] = $rs['PointsT1'];
		$match['PointsT2'] = $rs['PointsT2'];
		$match['Team1'] =  $rs['Team1'];
		if(isset($_SESSION['login'])) {
			if($_SESSION['liga_id'] == $rs['liga_id']) {
				$match['Aktl'] = 1;
			}	
		} elseif($rs['liga_id'] == 1) {
			$match['Aktl'] = 1;
		}

		$result2 = mysqli_query($conn, 'SELECT Team AS Team2 FROM benutzer, tipper_matchup_buli WHERE tipper2_id = benutzer_id AND matchup_id = '.$rs["matchup_id"].'');
		while($ts = mysqli_fetch_assoc($result2)) {
			$match['Team2'] = $ts['Team2'];
		}

		array_push($matchups,$match);
	}
	echo json_encode($matchups);




?>