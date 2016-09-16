<?php 
	include_once('../../../include/connect.php');

	// Alle Spieler einer Liga aus der DB holen und im Array speichern
	if(isset($_POST['ligaid'])) {
		$liga_id = intval($_POST['ligaid']);
		$tblMatchup = $_POST['tblmatchup'];

		$spieler_arr = [];

		$spieler = mysqli_query($conn,'SELECT benutzer_id FROM benutzer WHERE liga_id = "'.intval($liga_id).'"');
		$spielerZaehler = 1;
		while($sp = mysqli_fetch_assoc($spieler)) {	
			$spieler_arr [$spielerZaehler] = $sp['benutzer_id'];
			$spielerZaehler++;
		}



		$length = count($spieler_arr);

		if($length % 2 != 0) {
			echo 'Es muss eine gerade Anzahl an Spieler in einer Liga sein!';
			exit();
		}


		$spielAnzahl = intval($length * 0.5);

		$ungeradeLinks = 1;
		$ungeradeRechts = $length;
		$ungeradeZaehler = 1;

		$geradeLinks =  $length;
		$geradeRechts = $spielAnzahl + 1;
		$geradeZaehler = 0;

		// Array für die Matchups
		$matchups = [];

		//Alle Spieltage durchloopen
		for($i = 1; $i <= $length-1; $i++) {
			$spieltag = [];
			$spieltagComp = [];

			//Abfrage ob es der Erste Spieltag ist
			if($i == 1) {
				//Alle Spiele am Ersten Spieltag erstellen
				for($n = 1; $n <= $spielAnzahl; $n++) {
					$spiel = [];
					if($n == 1) {
						array_push($spiel, $ungeradeLinks, $ungeradeRechts);
						array_push($spieltag, $spiel);
						$ungeradeLinks++;
						$ungeradeRechts--;
					} else {
						array_push($spiel, $ungeradeLinks, $ungeradeRechts);
						array_push($spieltag, $spiel);
						$ungeradeLinks++;
						$ungeradeRechts--;
					}
				}
			$ungeradeZaehler++;
			foreach ($spieltag as $arr => $spiel) {		
				foreach ($spiel as $key => $value) {
					$spiel[$key] = $spieler_arr[$value];
				}
				array_push($spieltagComp, $spiel);
			}
			array_push($matchups, $spieltagComp);

			//Abfrage ob Spieltag ungerade aber nicht der Erste Spieltag ist
			} else if($i % 2 == 1 && $i != 1) {	
				$ungeradePlus = $ungeradeZaehler;
				//Alle Spiele des Spieltags erstellen
				for($n = 1; $n <= $spielAnzahl; $n++) {
					$spiel = [];
					if($n == 1) {
						$ungeradeMinus = $ungeradeZaehler;
						array_push($spiel, $ungeradeMinus, $length);
						array_push($spieltag, $spiel);
					} else {
						if($ungeradeMinus == 1) {
							$ungeradeMinus = $length - 1;
							$ungeradePlus++;
							array_push($spiel, $ungeradePlus, $ungeradeMinus);
							array_push($spieltag, $spiel);
						} else {
							$ungeradePlus++;
							$ungeradeMinus--;
							array_push($spiel, $ungeradePlus, $ungeradeMinus);
							array_push($spieltag, $spiel);

						}
						
					}
				}

			$ungeradeZaehler++;
			foreach ($spieltag as $arr => $spiel) {		
				foreach ($spiel as $key => $value) {
					$spiel[$key] = $spieler_arr[$value];
				}
				array_push($spieltagComp, $spiel);
			}
			array_push($matchups, $spieltagComp);

			//Abfrage ob der Spieltag gerade ist
			} else if($i % 2 == 0) {

				//Alle Spiele an den geraden Spieltagen erstellen
				for($n = 1; $n <= $spielAnzahl; $n++) {
					$spiel = [];
					if($n == 1) {
						$geradeMinus = $geradeZaehler + $geradeRechts;
						array_push($spiel, $length, $geradeMinus);
						array_push($spieltag, $spiel);
						$geradePlus = $geradeMinus + 1;
					} else {
						if($geradePlus == $length) {
							$geradePlus = 1;
							$geradeMinus--;
							array_push($spiel, $geradePlus, $geradeMinus);
							array_push($spieltag, $spiel);
							$geradePlus++;
						} else {
							$geradeMinus--;
							array_push($spiel, $geradePlus, $geradeMinus);
							array_push($spieltag, $spiel);
							$geradePlus++;
						}
						
					}
				}
			$geradeZaehler++;
			foreach ($spieltag as $arr => $spiel) {		
				foreach ($spiel as $key => $value) {
					$spiel[$key] = $spieler_arr[$value];
				}
				array_push($spieltagComp, $spiel);
			}
			array_push($matchups, $spieltagComp);
			}

		}
		$spieltag = 1;


		foreach ($matchups as $spieltag => $spiele) {
			$spieltag++;
			foreach ($spiele as $key => $id) {
				$t1 = $id[0];
				$t2 = $id[1];

				$sql = 'INSERT INTO '.$tblMatchup.' VALUES (NULL,'.$liga_id.','.$spieltag.',"'.$t1.'","'.$t2.'","","","","")';

				$result = mysqli_query($conn, $sql);
			}
			

		}

	}

	/*var_dump($matchups[0]);
	echo "<br /><br /><br />";
	var_dump($matchups[1]);
	echo "<br /><br /><br />";
	var_dump($matchups[2]);
	echo "<br /><br /><br />";
	var_dump($matchups[3]);
	echo "<br /><br /><br />";
	var_dump($matchups[4]);
	echo "<br /><br /><br />";
	var_dump($matchups[5]);
	echo "<br /><br /><br />";
	var_dump($matchups[6]);*/
	
?>


	