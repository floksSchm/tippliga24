<?php 
	include_once('../../include/connect.php');
	/*$pass = 'test1234';

	$hash = password_hash($pass, PASSWORD_DEFAULT);

	var_dump($hash);

	$actData = date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s")." +30 minutes"));
	$compare = mysqli_query($conn, 'SELECT * FROM spiele_buli WHERE matchID = 33292');
	while($c = mysqli_fetch_assoc($compare)) {
		if($c['matchDateTime'] < $actData) {
			var_dump('ACT DATA: '.$actData.'   - MATCH DATA: '.$c['matchDateTime']);
			var_dump('test1');
		} else {
			var_dump('ACT DATA: '.$actData.'   - MATCH DATA: '.$c['matchDateTime']);
			var_dump('test2');
		}
	}

	for($i = 1; $i <= 10; $i++) {
		$pass ="dummy".$i;
		$hash = password_hash($pass, PASSWORD_DEFAULT);
		mysqli_query($conn, 'INSERT INTO benutzer (vorname, nachname, email, kennwort, team, liga_id) VALUES ("vorname'.$i.'", "nachname'.$i.'", "testemail'.$i.'@web.de", "'.$hash.'", "teamDummy'.$i.'", 11)');

		$last_id = mysqli_insert_id($conn);
		$insert2 = mysqli_query($conn, 'INSERT INTO tipper_details (benutzer_id) VALUES ('.$last_id.')');
		
	}*/
?>