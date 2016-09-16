<?php 
	include_once('../../connect.php');
	include_once('../../config.php');

	$spieltag_akt;
	$saison = $CONF['SAISON_BEZ'];
	$wettbewerb_id = 1;
	$dtspiele;
	$dttabelle;
	$actDate = date('Y-m-d H:i:s');
	$ligaStarted = 0;
	$spieltag_started = 0;


	$date = mysqli_query($conn, 'SELECT * FROM spiele_last_update WHERE wettbewerb_id = '.$wettbewerb_id.'');
	while($d = mysqli_fetch_assoc($date)) {
		$dtspiele = $d['last_update'];
		$dttabelle = $d['tabelle_update'];
	}

	if(strtotime($dtspiele) != strtotime($dttabelle)) {

		$result = mysqli_query($conn, 'SELECT spieltag_akt, spieltag_started FROM tipper_wettbewerb WHERE wettbewerb_id = 1');
		while($rs = mysqli_fetch_assoc($result)) {
			$spieltag_akt = $rs['spieltag_akt'];
			$spieltag_started = $rs['spieltag_started'];
		}

		if($spieltag_akt == 1) {

			$getDate = mysqli_query($conn, 'SELECT min(matchDateTime) AS matchTime FROM spiele_buli WHERE spieltag = 1');
			while($gd = mysqli_fetch_assoc($getDate)) {
				if($gd['matchTime'] > $actDate) {
					$ligaStarted = 1;
				}
			}
		}

		$ids = mysqli_query($conn, 'SELECT * FROM benutzer, tipper_details WHERE benutzer.aktiv = 1 AND benutzer.benutzer_id = tipper_details.benutzer_id');

		while($id = mysqli_fetch_assoc($ids)) {
			if($id['liga_id'] == 11) {

				$dreier;
				$einser;
				$data1 = mysqli_query($conn, 'SELECT count(benutzer_id) AS anz_dreier FROM tipper_tipps_buli WHERE benutzer_id = '.$id["benutzer_id"].' AND dreier = 1');
				while($d = mysqli_fetch_assoc($data1)) {
					$dreier = $d['anz_dreier'];
				}
				$data2 = mysqli_query($conn, 'SELECT count(benutzer_id) AS anz_einser FROM tipper_tipps_buli WHERE benutzer_id = '.$id["benutzer_id"].' AND einser = 1');
				while($d2 = mysqli_fetch_assoc($data2)) {
					$einser = $d2['anz_einser'];
				}
				$goals = ($dreier*3)+$einser;

				$sql  = mysqli_query($conn, 'INSERT INTO tipper_tabelle_buli (liga_id, saison, spieltag, benutzer_id, tore, dreier, einser) VALUES ('.$id["liga_id"].', "'.$saison.'", '.$spieltag_akt.', '.$id["benutzer_id"].', '.$goals.', '.$dreier.', '.$einser.') ON DUPLICATE KEY UPDATE tore = '.$goals.', dreier = '.$dreier.', einser = '.$einser.'');
				
			} else {
				$data1 = mysqli_query($conn, 'SELECT * FROM tipper_matchup_buli WHERE spieltag = '.$spieltag_akt.' AND (tipper1_id = '.$id["benutzer_id"].' OR tipper2_id = '.$id["benutzer_id"].')');
				while($d1 = mysqli_fetch_assoc($data1)) {
					if($d1['tipper1_id'] == $id["benutzer_id"]) {
						$goals = intval($d1['PointsT1']) + intval($id['tore_akt']);
						$goals_against = intval($d1['PointsT2']) + intval($id['gegentore_akt']);
						$points;
						if($d1['PointsT1'] > $d1['PointsT2']) {
							$points = 3;
						} else if($d1['PointsT1'] < $d1['PointsT2']) {
							$points = 0;
						} else if($d1['PointsT1'] ==  $d1['PointsT2']) {
							if(!$ligaStarted || !$spieltag_started) {
								$points = 0;
							} else {
								$points = 1;
							}
						}
						$points = $points + $id['punkte_akt'];
						$dreier = $id['dreier_akt'];
						$einser = $id['einser_akt'];
						$data2 = mysqli_query($conn, 'SELECT * FROM spiele_buli WHERE spieltag = '.$spieltag_akt.'');
						while($d2 = mysqli_fetch_assoc($data2)) {
							$data3 = mysqli_query($conn, 'SELECT * FROM tipper_tipps_buli WHERE match_id = '.$d2["matchID"].' AND benutzer_id = '.$id["benutzer_id"].'');
							while($d3 = mysqli_fetch_assoc($data3)) {
								$dreier = intval($dreier) +  intval($d3['dreier']);
								$einser = intval($einser) +  intval($d3['einser']);
							}
						}
						$sql  = mysqli_query($conn, 'INSERT INTO tipper_tabelle_buli (liga_id, saison, spieltag, benutzer_id, tore, gegentore, punkte, dreier, einser) VALUES ('.$id["liga_id"].', "'.$saison.'", '.$spieltag_akt.', '.$id["benutzer_id"].', '.$goals.', '.$goals_against.', '.$points.', '.$dreier.', '.$einser.') ON DUPLICATE KEY UPDATE tore = '.$goals.', gegentore = '.$goals_against.', punkte = '.$points.', dreier = '.$dreier.', einser = '.$einser.'');
					} else if($d1['tipper2_id'] == $id["benutzer_id"]) {
						$goals = intval($d1['PointsT2']) + intval($id['tore_akt']);
						$goals_against = intval($d1['PointsT1']) + intval($id['gegentore_akt']);
						$points;
						if($d1['PointsT2'] > $d1['PointsT1']) {
							$points = 3;
						} else if($d1['PointsT2'] < $d1['PointsT1']) {
							$points = 0;
						} else if($d1['PointsT1'] ==  $d1['PointsT2']) {
							if(!$ligaStarted || !$spieltag_started) {
								$points = 0;
							} else {
								$points = 1;
							}
						}
						$points = $points + $id['punkte_akt'];
						$dreier = $id['dreier_akt'];
						$einser = $id['einser_akt'];
						$data2 = mysqli_query($conn, 'SELECT * FROM spiele_buli WHERE spieltag = '.$spieltag_akt.'');
						while($d2 = mysqli_fetch_assoc($data2)) {
							$data3 = mysqli_query($conn, 'SELECT * FROM tipper_tipps_buli WHERE match_id = '.$d2["matchID"].' AND benutzer_id = '.$id["benutzer_id"].'');
							while($d3 = mysqli_fetch_assoc($data3)) {
								$dreier = intval($dreier) +  intval($d3['dreier']);
								$einser = intval($einser) +  intval($d3['einser']);
							}
						}
						
						$sql  = mysqli_query($conn, 'INSERT INTO tipper_tabelle_buli (liga_id, saison, spieltag, benutzer_id, tore, gegentore, punkte, dreier, einser) VALUES ('.$id["liga_id"].', "'.$saison.'", '.$spieltag_akt.', '.$id["benutzer_id"].', '.$goals.', '.$goals_against.', '.$points.', '.$dreier.', '.$einser.') ON DUPLICATE KEY UPDATE tore = '.$goals.', gegentore = '.$goals_against.', punkte = '.$points.', dreier = '.$dreier.', einser = '.$einser.'');
					}

				}
			}
			
			
		}
		$updateDate = mysqli_query($conn, 'UPDATE spiele_last_update SET tabelle_update = '.$dtspiele.' WHERE wettbewerb_id = '.$wettbewerb_id.'');
	}
	

	
?>