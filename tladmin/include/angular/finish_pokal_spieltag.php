<?php 
	include_once('../../../include/connect.php');

	
	/******* POKAL *************/
	//Aktueller Liga Spieltag
	$select1 = mysqli_query($conn, 'SELECT * FROM tipper_wettbewerb WHERE wettbewerb_id =  2');
	$spieltag_akt;
	$wettbewerb_spieltag;
	while ($s1 = mysqli_fetch_assoc($select1)) {
		$spieltag_akt = $s1['spieltag_akt'];
		$wettbewerb_spieltag = $s1['wettbewerb_spieltag'];
	}



	// Pokal auf Null setzen
	$insert1 = mysqli_query($conn, 'UPDATE benutzer SET pokal = 0 WHERE aktiv = 1');

	// Spieler die die aktuelle Pokal Partie gewonnen haben auf 1 setzen
	$select2 = mysqli_query($conn, 'SELECT * FROM tipper_matchup_pokal WHERE spieltag = '.$spieltag_akt.'');
	while($s2 = mysqli_fetch_assoc($select2)) {
		$points1 = $s2['PointsT1'];
		$points2 = $s2['PointsT2'];
		$tipper1 = $s2['tipper1_id'];
		$tipper2 = $s2['tipper2_id'];

		if($points1 == $points2) {
			$select3 = mysqli_query($conn, 'SELECT * FROM tipper_details, benutzer WHERE benutzer_id = '.$tipper1.'');
			while($s3 = mysqli_fetch_assoc($select3)) {
				$select4 = mysqli_query($conn, 'SELECT * FROM tipper_details, benutzer WHERE benutzer_id = '.$tipper2.'');
				while($s4 = mysqli_fetch_assoc($select4)) {
					if($s3['tore_ges'] > $s4['tore_ges']) {
						$insert2 = mysqli_query($conn, 'UPDATE benutzer SET pokal = 1 WHERE benutzer_id = '.$tipper1.'');
					} else if($s3['tore_ges'] < $s4['tore_ges']) {
						$insert2 = mysqli_query($conn, 'UPDATE benutzer SET pokal = 1 WHERE benutzer_id = '.$tipper2.'');
					} else if($s3['tore_ges'] == $s4['tore_ges']) {
						if($s3['liga_id'] > $s4['liga_id']) {
							$insert2 = mysqli_query($conn, 'UPDATE benutzer SET pokal = 1 WHERE benutzer_id = '.$tipper2.'');
						} else if($s3['liga_id'] < $s4['liga_id']) {
							$insert2 = mysqli_query($conn, 'UPDATE benutzer SET pokal = 1 WHERE benutzer_id = '.$tipper1.'');
						} else if($s3['liga_id'] == $s4['liga_id']) {
							$random = mt_rand(1,2);
							switch($random){
								case 1: 
									$insert2 = mysqli_query($conn, 'UPDATE benutzer SET pokal = 1 WHERE benutzer_id = '.$tipper1.'');
									break;
								case 2:
									$insert2 = mysqli_query($conn, 'UPDATE benutzer SET pokal = 1 WHERE benutzer_id = '.$tipper2.'');
									break;
							}
						}
					}
				}
			}
		} else if($points1 > $points2) {
			$insert2 = mysqli_query($conn, 'UPDATE benutzer SET pokal = 1 WHERE benutzer_id = '.$tipper1.'');
		} else if($points1 < $points2) {
			$insert2 = mysqli_query($conn, 'UPDATE benutzer SET pokal = 1 WHERE benutzer_id = '.$tipper2.'');
		}
	}

	// Freilos Teams für die nächste Pokalrunde freischalten
	if($spieltag_akt == 1) {
		mysqli_query($conn, 'UPDATE benutzer SET pokal = 1, pokal_freilos = 0 WHERE pokal_freilos = 1');
	}

	//Spieltag erhöhen und in Tabelle eintragen
	$spieltag_neu = ++$spieltag_akt;
	$wettbewerb_spieltag_neu = ++$wettbewerb_spieltag;
	mysqli_query($conn, 'UPDATE tipper_wettbewerb SET spieltag_akt = '.$spieltag_neu.', wettbewerb_spieltag = '.$wettbewerb_spieltag_neu.' WHERE wettbewerb_id = 2');


?>