<?php 
	include_once('../../../include/connect.php');

	
	/******* LIGA *************/
	//Aktueller Liga Spieltag
	$select1 = mysqli_query($conn, 'SELECT * FROM tipper_wettbewerb WHERE wettbewerb_id =  1');
	$spieltag_akt;
	$wettbewerb_spieltag;
	while ($s1 = mysqli_fetch_assoc($select1)) {
		$spieltag_akt = $s1['spieltag_akt'];
		$wettbewerb_spieltag = $s1['wettbewerb_spieltag'];
	}


	// Daten von der tipper_tabelle_buli Tabelle in die Tipper Details Tabelle übertragen
	$select2 = mysqli_query($conn, 'SELECT * FROM tipper_tabelle_buli WHERE spieltag = '.$spieltag_akt.'');
	if($select2) {
		while($s2 = mysqli_fetch_assoc($select2)) {
			$upd = mysqli_query($conn, 'UPDATE tipper_details SET tore_akt = '.$s2["tore"].', gegentore_akt = '.$s2["gegentore"].', punkte_akt = '.$s2["punkte"].', dreier_akt = '.$s2["dreier"].', einser_akt  = '.$s2["einser"].' WHERE benutzer_id = '.$s2["benutzer_id"].'');
			if(!$upd) {
				echo 'FEHLER beim  Übertragen der Daten! Benutzer-ID: '.$s2["benutzer_id"].' FEHLER MESSAGE: '.mysqli_error($conn).'<br>';
			}
		}
	}

	//Spieltag erhöhen und in Tabelle eintragen
	$spieltag_neu = ++$spieltag_akt;
	$wettbewerb_spieltag_neu = ++$wettbewerb_spieltag;
	mysqli_query($conn, 'UPDATE tipper_wettbewerb SET spieltag_akt = '.$spieltag_neu.', wettbewerb_spieltag = '.$wettbewerb_spieltag_neu.' WHERE wettbewerb_id = 1');


?>