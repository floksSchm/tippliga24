<?php
	include_once('../../connect.php');
	include_once('../../config.php');

	$spieltag_akt;
	$last_update;
	$pokal_spieltag;

	$actData = date('Y-m-d H:i:s');

	$result3 = mysqli_query($conn, 'SELECT slu.last_update, tw.spieltag_akt, tw.wettbewerb_spieltag FROM spiele_last_update AS slu, tipper_wettbewerb AS tw WHERE slu.wettbewerb_id = 2 AND tw.wettbewerb_id = 2');
	while($rs3 = mysqli_fetch_assoc($result3)) {
		$last_update = $rs3['last_update'];
		$spieltag_akt = $rs3['spieltag_akt'];
		$pokal_spieltag = $rs3['wettbewerb_spieltag'];
	}

	/*$url0 = 'http://www.openligadb.de/api/getcurrentgroup/bl2';

	$data0 = file_get_contents($url0);
	$data0 = json_decode($data0);
	foreach ($data0 as $key => $value) {
		if($key == 'GroupOrderID') {
			$pokal_spieltag = $value;
		}
	}*/

	$url = 'http://www.openligadb.de/api/getlastchangedate/bl2/'.$CONF['JAHR_AKT'].'/'.$pokal_spieltag;

	$data_orig = file_get_contents($url);
	$data_orig = str_replace('T', ' ', $data_orig);
	$data_orig = substr($data_orig,1);
	$dataArr =  explode('.', $data_orig);
	$data = $dataArr[0];


	if($data) {
		if(strtotime($data) > strtotime($last_update)) {

	

			//POKAL ERGEBNISSE AKTUALISIEREN
			$url2 = 'http://www.openligadb.de/api/getmatchdata/bl2/'.$CONF['JAHR_AKT'].'/'.$pokal_spieltag;

			$data2 = file_get_contents($url2);
			$obj = json_decode($data2);
			foreach ($obj as $spieltag => $values){
				$pointsTeam1;
				$pointsTeam2;
				$htPointsTeam1;
				$htPointsTeam2;


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
								$pointsTeam1 = $values->MatchResults[0]->PointsTeam1;
								$pointsTeam2 = $values->MatchResults[0]->PointsTeam2;
								break;
						}
						switch ($values->MatchResults[1]->ResultOrderID) {
							case 1:
								$htPointsTeam1 = $values->MatchResults[1]->PointsTeam1;
								$htPointsTeam2 = $values->MatchResults[1]->PointsTeam2;
								break;
							case 2:
								$pointsTeam1 = $values->MatchResults[1]->PointsTeam1;
								$pointsTeam2 = $values->MatchResults[1]->PointsTeam2;
								break;
						}

						if(count($values->Goals) > 0 && ($pointsTeam1 == 0 && $pointsTeam2 == 0)) {

							foreach ($values->Goals as $goalKey => $goal) {
								$pointsTeam1 = $goal->ScoreTeam1;
								$pointsTeam2 = $goal->ScoreTeam2;
							}
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
						}
					}

					$sql = 'UPDATE spiele_pokal SET htPointsTeam1 = '.$htPointsTeam1.', htPointsTeam2 = '.$htPointsTeam2.', pointsTeam1 = '.$pointsTeam1.', pointsTeam2 = '.$pointsTeam2.', matchIsFinished = '.$matchIsFinished.', live = '.$live.' WHERE matchID = '.$values->MatchID.'';

					$result = mysqli_query($conn, $sql);
				}
			}
			$insert1 = mysqli_query($conn, 'UPDATE spiele_last_update SET last_update = '.$data.' WHERE wettbewerb_id = 2');
			
		} else {
			$url2 = 'http://www.openligadb.de/api/getmatchdata/bl2/'.$CONF['JAHR_AKT'].'/'.$pokal_spieltag;
			$data2 = file_get_contents($url2);
			$obj = json_decode($data2);
			foreach ($obj as $spieltag => $values){
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
					}
				}

				$sql = 'UPDATE spiele_pokal SET live = '.$live.' WHERE matchID = '.$values->MatchID.'';

				$result = mysqli_query($conn, $sql);

			}
		}
	}
?>