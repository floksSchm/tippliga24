<?php 
	session_start();
	include_once('../../connect.php');

	$actData = date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s")." +30 minutes"));
	$gameData = date('Y-m-d H:i:s');
	$pokal =  0;

	if(isset($_SESSION['login']) && $_SESSION['login']) {
		$id = $_SESSION['id'];
		$select1 = mysqli_query($conn, 'SELECT * FROM benutzer WHERE benutzer_id = '.$id.'');
		while ($s1 = mysqli_fetch_assoc($select1)) {
			if($s1['pokal'] == 1) {
				$pokal = 1;
			}
		}
	}

	$result = mysqli_query($conn, 'SELECT * FROM spiele_pokal ORDER BY spieltag ASC, matchDateTime ASC');

	$spiele = [];
	while($rs = mysqli_fetch_assoc($result)) {
		$spiel = [];
		$spiel['MatchID'] = $rs['matchID'];
		$spiel['Spieltag'] = $rs['spieltag'];
		$spiel['MatchDateTime'] = strtr($rs['matchDateTime'] , ' ' , 'T');
		$spiel['MatchDateTime'] .= 'Z';
		$spiel['Team1'] = $rs['team1'];
		$spiel['Team1Icon'] = $rs['team1Icon'];
		$spiel['Team2'] = $rs['team2'];
		$spiel['Team2Icon'] = $rs['team2Icon'];
		if(!$rs['matchIsFinished'] && !$rs['live']) {
			$spiel['PointsTeam1'] = '-';
			$spiel['PointsTeam2'] = '-';
			$spiel['HtPointsTeam1'] = '-';
			$spiel['HtPointsTeam2'] = '-';
		} else {
			$spiel['PointsTeam1'] = $rs['pointsTeam1'];
			$spiel['PointsTeam2'] = $rs['pointsTeam2'];
			$spiel['HtPointsTeam1'] = $rs['htPointsTeam1'];
			$spiel['HtPointsTeam2'] = $rs['htPointsTeam2'];
		}
		

		$spiel['MatchIsFinished'] = $rs['matchIsFinished'];
		if($rs['matchDateTime'] <= $actData) {
			$spiel['disabled'] = 1;
		} else {
			$spiel['disabled'] = 0;
		}
		if($pokal == 1) {
			$spiel['notallowed'] = 0;
		} else {
			$spiel['notallowed'] = 1;
		}

		if(isset($_SESSION['login']) && $_SESSION['login']){
			$result2 = mysqli_query($conn, 'SELECT * FROM tipper_tipps_pokal WHERE benutzer_id ='.$_SESSION['id'].' AND match_id = '.$rs['matchID'].'');
			if($result2) {
				while($rs2 = mysqli_fetch_assoc($result2)){
					if($rs2['tipp1'] != '' && $rs2['tipp2'] != ''){
						$spiel['Tipp1'] = $rs2['tipp1'];
						$spiel['Tipp2'] = $rs2['tipp2'];
					}
				}
			}		
		}

		array_push($spiele,$spiel);
	}

	echo json_encode($spiele);
?>