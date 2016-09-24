<?php 
	include_once('../../connect.php');
	include_once('../../config.php');
	
	$spieltag_akt;
	$last_update;
	$buli_spieltag;
	$spieltag_started = 0;

	$actData = date('Y-m-d H:i:s');

	$result3 = mysqli_query($conn, 'SELECT slu.last_update, tw.spieltag_akt, tw.wettbewerb_spieltag FROM spiele_last_update AS slu, tipper_wettbewerb AS tw WHERE slu.wettbewerb_id = 1 AND tw.wettbewerb_id = 1');
	while($rs3 = mysqli_fetch_assoc($result3)) {
		$last_update = $rs3['last_update'];
		$spieltag_akt = $rs3['spieltag_akt'];
		$buli_spieltag = $rs3['wettbewerb_spieltag'];
	}

	/*$url0 = 'http://www.openligadb.de/api/getcurrentgroup/bl1';

	$data0 = file_get_contents($url0);
	$data0 = json_decode($data0);
	foreach ($data0 as $key => $value) {
		if($key == 'GroupOrderID') {
			$buli_spieltag = $value;
		}
	}*/

	$url = 'http://www.openligadb.de/api/getlastchangedate/bl1/'.$CONF["JAHR_AKT"].'/'.$buli_spieltag;

	$data = file_get_contents($url);
	$data = str_replace('T', ' ', $data);

	if($data) {
		if($data < $last_update) {
			//BUNDESLIGA ERGEBNISSE AKTUALISIEREN
			$url2 = 'http://www.openligadb.de/api/getmatchdata/bl1/'.$CONF["JAHR_AKT"].'/'.$buli_spieltag;

			$data2 = file_get_contents($url2);
			$obj = json_decode($data2);
			foreach ($obj as $spieltag => $values){
				if(count($values->MatchResults) != 0) {
					if(count($values->MatchResults) == 1) {
						$pointsTeam1 = $values->MatchResults[0]->PointsTeam1;
						$pointsTeam2 = $values->MatchResults[0]->PointsTeam2;
						$htPointsTeam1 = $values->MatchResults[0]->PointsTeam1;
						$htPointsTeam2 = $values->MatchResults[0]->PointsTeam2;

					} else if(count($values->MatchResults) == 2) {
						switch ($values->MatchResults[0]->ResultOrderID) {
							case 1:
								$htPointsTeam1 = $values->MatchResults[0]->PointsTeam1;
								$htPointsTeam2 = $values->MatchResults[0]->PointsTeam2;
								break;
							case 2:
								$PointsTeam1 = $values->MatchResults[0]->PointsTeam1;
								$PointsTeam2 = $values->MatchResults[0]->PointsTeam2;
								break;
						}
						switch ($values->MatchResults[1]->ResultOrderID) {
							case 1:
								$htPointsTeam1 = $values->MatchResults[1]->PointsTeam1;
								$htPointsTeam2 = $values->MatchResults[1]->PointsTeam2;
								break;
							case 2:
								$PointsTeam1 = $values->MatchResults[1]->PointsTeam1;
								$PointsTeam2 = $values->MatchResults[1]->PointsTeam2;
								break;
						}
					}
					$live = 0;
					if($values->MatchIsFinished) {
						$matchIsFinished = 1;
					} else {
						$matchIsFinished = 0;
						$matchDateTime = 0;
						if($values->MatchDateTime != '') {
							$matchDateTime = str_replace('T', ' ', $values->MatchDateTime);
						} 
						if($actData > $matchDateTime && $matchDateTime != 0) {
							$live = 1;
							$spieltag_started = 1;
						}
					}

					$sql = 'UPDATE spiele_buli SET htPointsTeam1 = '.$htPointsTeam1.', htPointsTeam2 = '.$htPointsTeam2.', pointsTeam1 = '.$PointsTeam1.', pointsTeam2 = '.$PointsTeam2.', matchIsFinished = '.$matchIsFinished.', live = '.$live.' WHERE matchID = '.$values->MatchID.'';
					//var_dump($sql.'<br>');
					$result = mysqli_query($conn, $sql);
				}
			}
			$insert1 = mysqli_query($conn, 'UPDATE spiele_last_update SET last_update = '.$data.' WHERE wettbewerb_id = 1');
		}
	}
	if($spieltag_started) {
		$insert1 = mysqli_query($conn, 'UPDATE tipper_wettbewerb SET spieltag_started = 1 WHERE wettbewerb_id = 1');
	}
?>