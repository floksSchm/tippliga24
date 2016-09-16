<?php 
	include_once('../../connect.php');

	$result = mysqli_query($conn, 'SELECT spieltag_akt FROM tipper_wettbewerb WHERE wettbewerb_id = 2');
	$spieltag_akt;
	while($rs = mysqli_fetch_assoc($result)) {
		$spieltag_akt = $rs['spieltag_akt'];
	}

	$actData = date('Y-m-d H:i:s');

	$ids = mysqli_query($conn, 'SELECT benutzer_id FROM benutzer WHERE aktiv = 1 AND pokal = 1');

	while($id = mysqli_fetch_assoc($ids)) {
		$spielepokal = mysqli_query($conn, 'SELECT * FROM spiele_pokal WHERE spieltag = '.$spieltag_akt.' AND (live = 1 OR matchIsFinished = 1)');
		$counter = 1;
		while($rspokal = mysqli_fetch_assoc($spielepokal)) {
			$pokal1 = $rspokal['pointsTeam1'];
			$pokal2 = $rspokal['pointsTeam2'];
			$pokalht1 = $rspokal['htPointsTeam1'];
			$pokalht2 = $rspokal['htPointsTeam2'];
			$diff = $pokal1 - $pokal2;

			if($actData > $rspokal['matchDateTime']) {
				$tipps = mysqli_query($conn, 'SELECT * FROM tipper_tipps_pokal WHERE match_id = '.$rspokal['matchID'].' AND benutzer_id = '.$id['benutzer_id'].'');
				$points;
				while($rstipp = mysqli_fetch_assoc($tipps)) {
					$htpoints = 0;
					$points = 0;
					$dreier = 0;
					$einser = 0;
					$minus = $rstipp['tipp1']-$rstipp['tipp2'];		

					if($rstipp['dreier'] != Null && $rstipp['dreier'] != 0) {
						$dreier = 1;
					} else if($rstipp['einser'] != Null && $rstipp['einser'] != 0) {
						$einser = 1;
					}

					//1.HZ oder Endergebnis ist gleich wie in der 1.HZ
					if($pokal1 == $pokalht1 && $pokal2 == $pokalht2) {
						
						// 3 Punkte
						if($pokal1 == $rstipp['tipp1'] && $pokal2 == $rstipp['tipp2']) {
							$htpoints = 3;
							$points = 3;
							if($einser != 0) {
								$einser = 0;
							}
							$dreier = 1;
						// 1 Punkt bei Unentschieden 
						} else if($rstipp['tipp1'] == $rstipp['tipp2'] && $pokal1 == $pokal2) {
							$htpoints = 1;
							$points = 1;
							if($dreier != 0) {
								$dreier = 0;
							}
							$einser = 1;
						// 1 oder 0 Punkt ohne Unentschieden
						} else {
							if(($minus < 0 && $diff < 0 ) || ($minus > 0 && $diff > 0)) {
								$htpoints = 1;
								$points = 1;
								if($dreier != 0) {
									$dreier = 0;
								}
								$einser = 1;
							} else if(($minus <= 0 && $diff > 0) || ($minus >= 0 && $diff < 0)) {
								$htpoints = 0;
								$points = 0;
								if($dreier != 0 || $einser != 0) {
									$dreier = 0;
									$einser = 0;
								}
							}
						}
					// Endergebnis
					} else if($pokal1 != $pokalht1 || $pokal2 != $pokalht2) {
						// 3 Punkte
						if($pokal1 == $rstipp['tipp1'] && $pokal2 == $rstipp['tipp2']) {
							$points = 3;
							if($einser != 0) {
								$einser = 0;
							}
							$dreier = 1;
						// 1 Punkt bei Unentschieden 
						} else if($rstipp['tipp1'] == $rstipp['tipp2'] && $pokal1 == $pokal2) {
							$points = 1;
							if($dreier != 0) {
								$dreier = 0;
							}
							$einser = 1;
						// 1 oder 0 Punkt ohne Unentschieden
						} else {
							if(($minus < 0 && $diff < 0) || ($minus > 0 && $diff > 0)) {
								$points = 1;
								if($dreier != 0) {
									$dreier = 0;
								}
								$einser = 1;
							} else if(($minus <= 0 && $diff > 0) || ($minus >= 0 && $diff < 0)) {
								$points = 0;
								if($dreier != 0 || $einser != 0) {
									$dreier = 0;
									$einser = 0;
								}	
							}
						}
					}

					// Punkte zum Tippergebnis hinzu addieren
					$null = mysqli_query($conn, 'SELECT * FROM tipper_matchup_pokal WHERE spieltag = '.$spieltag_akt.' AND (tipper1_id = '.$id['benutzer_id'].' OR tipper2_id = '.$id['benutzer_id'].')');
					if($counter == 1) {
						while($nuller = mysqli_fetch_assoc($null)) {
							if($nuller['tipper1_id'] == $id['benutzer_id']) {
								// Tippergebnis vor dem Ersten Einfügen auf 0 stellen
								mysqli_query($conn, 'UPDATE tipper_matchup_pokal SET htPointsT1 = 0, PointsT1 = 0 WHERE spieltag = '.$spieltag_akt.' AND tipper1_id = '.$id['benutzer_id'].'');
							} else if($nuller['tipper2_id'] == $id['benutzer_id']) {
								// Tippergebnis vor dem Ersten Einfügen auf 0 stellen
								mysqli_query($conn, 'UPDATE tipper_matchup_pokal SET htPointsT2 = 0, PointsT2 = 0 WHERE spieltag = '.$spieltag_akt.' AND tipper2_id = '.$id['benutzer_id'].'');
							}
						}
					}
					$select = mysqli_query($conn, 'SELECT * FROM tipper_matchup_pokal WHERE spieltag = '.$spieltag_akt.' AND (tipper1_id = '.$id['benutzer_id'].' OR tipper2_id = '.$id['benutzer_id'].')');
					while($resultselect = mysqli_fetch_assoc($select)) {
						if($points != 0) {		
							if($resultselect['tipper1_id'] == $id['benutzer_id']) {
								$points = intval($resultselect['PointsT1']) + intval($points);
								mysqli_query($conn, 'UPDATE tipper_matchup_pokal SET PointsT1 = '.$points.' WHERE spieltag = '.$spieltag_akt.' AND tipper1_id = '.$id['benutzer_id'].'');
							} else if($resultselect['tipper2_id'] == $id['benutzer_id']) {				
								$points = intval($resultselect['PointsT2']) + intval($points);
								mysqli_query($conn, 'UPDATE tipper_matchup_pokal SET PointsT2 = '.$points.' WHERE spieltag = '.$spieltag_akt.' AND tipper2_id = '.$id['benutzer_id'].'');
							}
						}
					}

				
				$updatewert = mysqli_query($conn, 'UPDATE tipper_tipps_pokal SET dreier = '.$dreier.', einser = '.$einser.' WHERE match_id = '.$rsbuli['matchID'].' AND benutzer_id = '.$id['benutzer_id'].'');
				}
			$counter++;
			}
		}
	}
?>