<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'include/connect.php');

	$titel = [];

	$select = mysqli_query($conn, 'SELECT * FROM tipper_details AS tp INNER JOIN benutzer AS b ON b.benutzer_id = tp.benutzer_id WHERE tp.pokal_akt = 1 OR tp.meister_akt = 1');
	while($s1 = mysqli_fetch_assoc($select)) {
		if($s1['meister_akt']) {
			$titel[0] = array('meister_team' => $s1['team'], 'meister_id' => $s1['benutzer_id'],'meister_team' => $s1['team'], 'titel_pokale' => $s1['pokal_anz'],'titel_meister' => $s1['meister_anz'],'team_logo' => $s1['team_logo']);
		} else if($s1['pokal_akt']) {
			$titel[1] = array('pokal_team' => $s1['team'], 'pokal_id' => $s1['benutzer_id'],'pokal_team' => $s1['team'], 'titel_pokale' => $s1['pokal_anz'],'titel_meister' => $s1['meister_anz'],'team_logo' => $s1['team_logo']);
		}
	}

	$tippschuetze_ewig = [];

	$select = mysqli_query($conn, 'SELECT * FROM tipper_details INNER JOIN benutzer ON benutzer.benutzer_id = tipper_details.benutzer_id ORDER BY tore_ges DESC LIMIT 5');
	while($s1 = mysqli_fetch_assoc($select)) {
		array_push($tippschuetze_ewig, array('team' => $s1['team'],'spieler' => $s1['spieler'],'id' => $s1['benutzer_id'],'tore' => $s1['tore_ges']));
	}

	$tippschuetze_akt = [];

	$select = mysqli_query($conn, 'SELECT * FROM tipper_details INNER JOIN benutzer ON benutzer.benutzer_id = tipper_details.benutzer_id ORDER BY tore_akt DESC LIMIT 5');
	while($s1 = mysqli_fetch_assoc($select)) {
		array_push($tippschuetze_akt, array('team' => $s1['team'],'spieler' => $s1['spieler'],'id' => $s1['benutzer_id'],'tore' => $s1['tore_akt']));
	}
?>