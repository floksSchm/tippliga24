<?php 
	session_start();
	include_once('../connect.php');

	$post = file_get_contents('php://input');

	$actData = date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s")." +30 minutes"));

	$data = json_decode($post, true); 
	$length = count($data);
	
	for($i = 0; $i < $length; $i++) {
		$value = mysql_escape_string($data[$i]['value']);
		$name = mysql_escape_string($data[$i]['name']);
		$nr = str_replace('_', '', strstr($name, '_'));
		$matchid = strstr($name, '_', true);
		$compare = mysqli_query($conn, 'SELECT * FROM spiele_pokal WHERE matchID = '.$matchid.'');
		while($c = mysqli_fetch_assoc($compare)) {
			if($c['matchDateTime'] > $actData) {
				$val;
				if($value == '') {
					$val = 0;
				} else {
					$val = $value;
				}

				if($nr == 1) {
					$sql  = 'INSERT INTO tipper_tipps_pokal (benutzer_id, match_id, tipp1) VALUES ('.$_SESSION["id"].', '.$matchid.', '.$val.') ON DUPLICATE KEY UPDATE tipp1 = '.$val.'';
				} elseif ($nr == 2) {
					$sql  = 'INSERT INTO tipper_tipps_pokal (benutzer_id, match_id, tipp2) VALUES ('.$_SESSION["id"].', '.$matchid.', '.$val.') ON DUPLICATE KEY UPDATE tipp2 = '.$val.'';
				}
				$result = mysqli_query($conn, $sql);
			}
		}	
	}

	echo true;
?>