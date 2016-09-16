<?php 
	include_once('../../connect.php');

	$result = mysqli_query($conn, 'SELECT spieltag_akt FROM tipper_wettbewerb WHERE wettbewerb_id = 1');
	$spieltag_akt;
	while($rs = mysqli_fetch_assoc($result)) {
		$spieltag_akt = $rs['spieltag_akt'];
	}

	$actData = date('Y-m-d H:i:s');

	$ids = mysqli_query($conn, 'SELECT benutzer_id, liga_id FROM benutzer WHERE aktiv = 1');

	while($id = mysqli_fetch_assoc($ids)) {
		if($id['liga_id'] == 11) {
			// ALLE BENUTZER DIE IN DER QUALILIAG SPIELEN
			$spielebuli = mysqli_query($conn, 'SELECT * FROM spiele_buli WHERE spieltag = '.$spieltag_akt.'');
			$counter = 1;
			while($rsbuli = mysqli_fetch_assoc($spielebuli)) {
				$buli1 = $rsbuli['pointsTeam1'];
				$buli2 = $rsbuli['pointsTeam2'];
				$buliht1 = $rsbuli['htPointsTeam1'];
				$buliht2 = $rsbuli['htPointsTeam2'];
				$diff = $buli1 - $buli2;

				if($actData > $rsbuli['matchDateTime']) {
					$tipps = mysqli_query($conn, 'SELECT * FROM tipper_tipps_buli WHERE match_id = '.$rsbuli['matchID'].' AND benutzer_id = '.$id['benutzer_id'].'');
					$points;
					while($rstipp = mysqli_fetch_assoc($tipps)) {
						$htpoints = 0;
						$points = 0;
						$dreier = 0;
						$einser = 0;
						$minus = $rstipp['tipp1']-$rstipp['tipp2'];		

						if($rstipp['dreier'] !== Null && $rstipp['dreier'] !== 0) {
							$dreier = 1;
						} else if($rstipp['einser'] !== Null && $rstipp['einser'] !== 0) {
							$einser = 1;
						}

						//1.HZ oder Endergebnis ist gleich wie in der 1.HZ
						if($buli1 == $buliht1 && $buli2 == $buliht2) {
							
							// 3 Punkte
							if($buli1 == $rstipp['tipp1'] && $buli2 == $rstipp['tipp2']) {
								$htpoints = 3;
								$points = 3;
								if($einser !== 0) {
									$einser = 0;
								}
								$dreier = 1;
							// 1 Punkt bei Unentschieden 
							} else if($rstipp['tipp1'] == $rstipp['tipp2'] && $buli1 == $buli2) {
								$htpoints = 1;
								$points = 1;
								if($dreier !== 0) {
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
								} else if(($minus <= 0 && $diff > 0) || ($minus >= 0 && $diff < 0) || ($minus < 0 && $diff >= 0) || ($minus > 0 && $diff <= 0)) {
									$htpoints = 0;
									$points = 0;
									if($dreier !== 0 || $einser !== 0) {
										$dreier = 0;
										$einser = 0;
									}
								}
							}
						// Endergebnis
						} else if($buli1 != $buliht1 || $buli2 != $buliht2) {
							// 3 Punkte
							if($buli1 == $rstipp['tipp1'] && $buli2 == $rstipp['tipp2']) {
								$points = 3;
								if($einser !== 0) {
									$einser = 0;
								}
								$dreier = 1;
							// 1 Punkt bei Unentschieden 
							} else if($rstipp['tipp1'] == $rstipp['tipp2'] && $buli1 == $buli2) {
								$points = 1;
								if($dreier !== 0) {
									$dreier = 0;
								}
								$einser = 1;
							// 1 oder 0 Punkt ohne Unentschieden
							} else {
								if(($minus < 0 && $diff < 0) || ($minus > 0 && $diff > 0)) {
									$points = 1;
									if($dreier !== 0) {
										$dreier = 0;
									}
									$einser = 1;
								} else if(($minus <= 0 && $diff > 0) || ($minus >= 0 && $diff < 0) || ($minus < 0 && $diff >= 0) || ($minus > 0 && $diff <= 0)) {
									$points = 0;
									if($dreier !== 0 || $einser !== 0) {
										$dreier = 0;
										$einser = 0;
									}	
								}
							}
						}
					$updatewert = mysqli_query($conn, 'UPDATE tipper_tipps_buli SET dreier = '.$dreier.', einser = '.$einser.' WHERE match_id = '.$rsbuli['matchID'].' AND benutzer_id = '.$id['benutzer_id'].'');
					}
				$counter++;
				}
			}
		} else {
			// ALLE BENUTZER DIE IN EINER LIGA SPIELEN
			$spielebuli = mysqli_query($conn, 'SELECT * FROM spiele_buli WHERE spieltag = '.$spieltag_akt.'');
			$counter = 1;
			while($rsbuli = mysqli_fetch_assoc($spielebuli)) {
				$buli1 = $rsbuli['pointsTeam1'];
				$buli2 = $rsbuli['pointsTeam2'];
				$buliht1 = $rsbuli['htPointsTeam1'];
				$buliht2 = $rsbuli['htPointsTeam2'];
				$diff = $buli1 - $buli2;

				if($actData > $rsbuli['matchDateTime']) {
					$tipps = mysqli_query($conn, 'SELECT * FROM tipper_tipps_buli WHERE match_id = '.$rsbuli['matchID'].' AND benutzer_id = '.$id['benutzer_id'].'');
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
						if($buli1 == $buliht1 && $buli2 == $buliht2) {
							
							// 3 Punkte
							if($buli1 == $rstipp['tipp1'] && $buli2 == $rstipp['tipp2']) {
								$htpoints = 3;
								$points = 3;
								if($einser != 0) {
									$einser = 0;
								}
								$dreier = 1;
							// 1 Punkt bei Unentschieden 
							} else if($rstipp['tipp1'] == $rstipp['tipp2'] && $buli1 == $buli2) {
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

								} else if(($minus <= 0 && $diff > 0) || ($minus >= 0 && $diff < 0) || ($minus < 0 && $diff >= 0) || ($minus > 0 && $diff <= 0)) {
									$htpoints = 0;
									$points = 0;
									if($dreier !== 0 || $einser !== 0) {
										$dreier = 0;
										$einser = 0;
									}
								}
							}
						// Endergebnis
						} else if($buli1 != $buliht1 || $buli2 != $buliht2) {

							// 3 Punkte
							if($buli1 == $rstipp['tipp1'] && $buli2 == $rstipp['tipp2']) {
								$points = 3;
								if($einser !== 0) {
									$einser = 0;
								}
								$dreier = 1;
								
							// 1 Punkt bei Unentschieden 
							} else if($rstipp['tipp1'] == $rstipp['tipp2'] && $buli1 == $buli2) {
								
								$points = 1;
								if($dreier !== 0) {
									$dreier = 0;
								}
								$einser = 1;
							
							// 1 oder 0 Punkt ohne Unentschieden
							} else {

								if(($minus < 0 && $diff < 0) || ($minus > 0 && $diff > 0)) {
									$points = 1;
									if($dreier !== 0) {
										$dreier = 0;
									}
									$einser = 1;
									
								} else if(($minus <= 0 && $diff > 0) || ($minus >= 0 && $diff < 0) || ($minus < 0 && $diff >= 0) || ($minus > 0 && $diff <= 0)) {
									$points = 0;
									if($dreier !== 0 || $einser !== 0) {
										$dreier = 0;
										$einser = 0;
									}	
									
								}
							}
						}

						// Punkte zum Tippergebnis hinzu addieren
						$null = mysqli_query($conn, 'SELECT * FROM tipper_matchup_buli WHERE spieltag = '.$spieltag_akt.' AND (tipper1_id = '.$id['benutzer_id'].' OR tipper2_id = '.$id['benutzer_id'].')');
						if($counter == 1) {
							while($nuller = mysqli_fetch_assoc($null)) {
								if($nuller['tipper1_id'] == $id['benutzer_id']) {
									// Tippergebnis vor dem Ersten Einfügen auf 0 stellen
									mysqli_query($conn, 'UPDATE tipper_matchup_buli SET htPointsT1 = 0, PointsT1 = 0 WHERE spieltag = '.$spieltag_akt.' AND tipper1_id = '.$id['benutzer_id'].'');
								} else if($nuller['tipper2_id'] == $id['benutzer_id']) {
									// Tippergebnis vor dem Ersten Einfügen auf 0 stellen
									mysqli_query($conn, 'UPDATE tipper_matchup_buli SET htPointsT2 = 0, PointsT2 = 0 WHERE spieltag = '.$spieltag_akt.' AND tipper2_id = '.$id['benutzer_id'].'');
								}
							}
						}
						$select = mysqli_query($conn, 'SELECT * FROM tipper_matchup_buli WHERE spieltag = '.$spieltag_akt.' AND (tipper1_id = '.$id['benutzer_id'].' OR tipper2_id = '.$id['benutzer_id'].')');
						while($resultselect = mysqli_fetch_assoc($select)) {
							if($points != 0) {		
								if($resultselect['tipper1_id'] == $id['benutzer_id']) {
									$points = intval($resultselect['PointsT1']) + intval($points);
									mysqli_query($conn, 'UPDATE tipper_matchup_buli SET PointsT1 = '.$points.' WHERE spieltag = '.$spieltag_akt.' AND tipper1_id = '.$id['benutzer_id'].'');
								} else if($resultselect['tipper2_id'] == $id['benutzer_id']) {				
									$points = intval($resultselect['PointsT2']) + intval($points);
									mysqli_query($conn, 'UPDATE tipper_matchup_buli SET PointsT2 = '.$points.' WHERE spieltag = '.$spieltag_akt.' AND tipper2_id = '.$id['benutzer_id'].'');
								}
							}
						//#var_dump('COUNTER : =>'.$counter.' Heim: '.$buli1.' - Auswärts: '.$buli2.' => Tipp1: '.$rstipp['tipp1'].'  - Tipp2: '.$rstipp['tipp2']);
						//var_dump('RESULT: '.$points. '<br>');
						}

						var_dump($id['benutzer_id']);
						var_dump($einser);
						var_dump('<br><br>');
					
					$updatewert = mysqli_query($conn, 'UPDATE tipper_tipps_buli SET dreier = '.$dreier.', einser = '.$einser.' WHERE match_id = '.$rsbuli['matchID'].' AND benutzer_id = '.$id['benutzer_id'].'');
					}
				$counter++;
				}
			}
		}
		
	}
?>