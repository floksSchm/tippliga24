<?php 
	include_once('../../../include/connect.php');

	if(isset($_POST['pokalid'])) {

		$tbl = mysqli_real_escape_string($conn, $_POST['pokalmatchup']);
		$pokalid = mysqli_real_escape_string($conn, $_POST['pokalid']);

		$result2 = mysqli_query($conn, 'SELECT spieltag_akt FROM tipper_wettbewerb WHERE wettbewerb_id = 2');
		$spieltag_akt;
		while($rs2 = mysqli_fetch_assoc($result2)) {
			$spieltag_akt = $rs2['spieltag_akt'];
		}
		if($spieltag_akt == 2) {
			$ids = mysqli_query($conn, 'SELECT * FROM benutzer WHERE aktiv = 1 AND (pokal = 1 OR pokal_freilos = 1) ORDER BY liga_id');
		} else {
			$ids = mysqli_query($conn, 'SELECT * FROM benutzer WHERE aktiv = 1 AND pokal = 1 ORDER BY liga_id');
		}
		
		$pokaltipper = [];
		$zaehler = 1;
		while($id = mysqli_fetch_assoc($ids)) {
			array_push($pokaltipper,$id['benutzer_id']);
		}

		$length = count($pokaltipper);

		$erste = 64;
		$zweite = 32;

		if($length == 64 || $length == 32 || $length == 16 || $length == 8 || $length == 4 || $length == 2){
			// POKAL MATCHES GENERIEREN UND IN DB SPEICHERN
			$matchups = [];
			$matches = count($pokaltipper) / 2;
			shuffle($pokaltipper);
			for($n = 1; $n <= $matches; $n++) {
				$match = [];
				$first = array_shift($pokaltipper);
				$match[0] = $first;
				$second = array_shift($pokaltipper);
				$match[1] = $second;
				array_push($matchups, $match);
			}
			foreach ($matchups as $pokal => $match) {
				$tipper1 = $match[0]; 
				$tipper2 = $match[1];
				$sql = 'INSERT INTO '.$tbl.' VALUES (NULL,'.$pokalid.','.$spieltag_akt.',"'.$tipper1.'","'.$tipper2.'","","","","")';

				$result = mysqli_query($conn, $sql);
			}
		} else {
			if($length > $erste) {
				$freitipper = [];
				$freilos = 2 * $erste - $length;
				$teamsFree = array_slice($pokaltipper, 0, $freilos);
				for($i = 1; $i <= $freilos; $i++) {
					$freitipper[$i] = array_shift($pokaltipper);
				}
			} else if($length > $zweite) {
				$freitipper = [];
				$freilos = 2 * $zweite - $length;
				$teamsFree = array_slice($pokaltipper, 0, $freilos);
				for($i = 0; $i < $freilos; $i++) {
					$freitipper[$i] = array_shift($pokaltipper);
				}
			} else if($length < $zweite) {
			 	echo false;
			}

			// FREILOS-TEAMS AKTUALISIEREN
			for ($t=0; $t < count($freitipper); $t++) { 
				mysqli_query($conn, 'UPDATE benutzer SET pokal = 0, pokal_freilos = 1 WHERE benutzer_id = '.$freitipper[$t].'');
			}

			// POKAL MATCHES GENERIEREN UND IN DB SPEICHERN
			$matchups = [];
			$matches = count($pokaltipper) / 2;
			shuffle($pokaltipper);
			for($n = 1; $n <= $matches; $n++) {
				$match = [];
				$first = array_shift($pokaltipper);
				$match[0] = $first;
				$second = array_shift($pokaltipper);
				$match[1] = $second;
				array_push($matchups, $match);
			}
			foreach ($matchups as $pokal => $match) {
				$tipper1 = $match[0]; 
				$tipper2 = $match[1];
				$sql = 'INSERT INTO '.$tbl.' VALUES (NULL,'.$pokalid.','.$spieltag_akt.',"'.$tipper1.'","'.$tipper2.'","","","","")';

				$result = mysqli_query($conn, $sql);
			}

		}
	}
	
?>