<?php 
	session_start();
	include_once('../../connect.php');

	$result = mysqli_query($conn, 'SELECT * FROM tipper_tabelle_buli ORDER BY liga_id ASC, spieltag ASC, punkte DESC, tore DESC, gegentore ASC');

	$tabelle = [];
	while($rs = mysqli_fetch_assoc($result)) {
		$table_row = [];
		$table_row['ligaID'] = $rs['liga_id'];
		// QUALILIGA
		if($table_row['ligaID'] == 11) {
			$table_row['spieltag'] = $rs['spieltag'];
			$table_row['benutzer_id'] = $rs['benutzer_id'];
			$table_row['tore'] = $rs['tore'];
			$table_row['punkte'] = $rs['punkte'];
			$table_row['dreier'] = $rs['dreier'];
			$table_row['einser'] = $rs['einser'];
			$table_row['quali'] = 1;
		} else {
			$table_row['spieltag'] = $rs['spieltag'];
			$table_row['benutzer_id'] = $rs['benutzer_id'];
			$table_row['tore'] = $rs['tore'];
			$table_row['gegentore'] = $rs['gegentore'];
			$table_row['punkte'] = $rs['punkte'];
			$table_row['dreier'] = $rs['dreier'];
			$table_row['einser'] = $rs['einser'];
			$table_row['quali'] = 0;
		}
		

		$table_row['Self'] = 0;

		if(isset($_SESSION['id']) && $rs['benutzer_id'] == $_SESSION['id']) {
			$table_row['Self'] = 1;
		}

		$team  = mysqli_query($conn, 'SELECT team FROM benutzer WHERE benutzer_id = '.$rs['benutzer_id'].'');
		while($t = mysqli_fetch_assoc($team)) {
			$table_row['team'] = $t['team'];
		}

		array_push($tabelle, $table_row);
	}

	echo json_encode($tabelle);

?>