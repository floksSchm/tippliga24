<?php 
	include_once('../connect.php');

	$select = mysqli_query($conn, 'SELECT *  FROM benutzer, tipper_details WHERE benutzer.aktiv = 1 AND tipper_details.benutzer_id = benutzer.benutzer_id ORDER BY tore_akt DESC, team ASC');

	$send = [];
	while($schuetze = mysqli_fetch_assoc($select)) {
		$data = [];
		$data['id'] = $schuetze['benutzer_id'];
		$data['spieler'] = $schuetze['spieler'];
		$data['team'] = $schuetze['team'];
		$data['tore_akt'] = $schuetze['tore_akt'];
		$data['gegentore_akt'] = $schuetze['gegentore_akt'];
		$data['tore_ges'] = $schuetze['tore_ges'];
		$data['gegentore_ges'] = $schuetze['gegentore_ges'];
		$data['dreier_akt'] = $schuetze['dreier_akt'];
		$data['einser_akt'] = $schuetze['einser_akt'];
		$data['dreier_ges'] = $schuetze['dreier_ges'];
		$data['einser_ges'] = $schuetze['einser_ges'];
		array_push($send, $data);
	}

	echo json_encode($send);
?>