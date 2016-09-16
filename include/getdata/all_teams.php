<?php
	session_start();
	include_once('../connect.php');

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	$teams = [];

	$select = mysqli_query($conn, 'SELECT * FROM benutzer WHERE aktiv = 1 ORDER BY liga_id');
	while($s1 = mysqli_fetch_assoc($select)) {
		$team = [];
		$team['ID'] = $s1['benutzer_id']; 
		$team['Vorname'] = $s1['vorname']; 
		$team['Nachname'] = $s1['nachname']; 
		$team['Email'] = $s1['email']; 
		$team['Team'] = $s1['team']; 
		$team['LigaID'] = $s1['liga_id']; 
		$team['nameShow'] = 0;
		if(isset($_SESSION['id']) && $s1['benutzer_id'] == $_SESSION['id']) {
			$team['Self'] = 1;
		}

		array_push($teams, $team);
	}

	echo json_encode($teams);

?>