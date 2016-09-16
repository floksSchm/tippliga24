<?php 
	include_once('../../../include/connect.php');

	if(isset($_POST['vorname'])) {

		$vorname = mysqli_real_escape_string($conn, $_POST['vorname']);
		$nachname = mysqli_real_escape_string($conn, $_POST['nachname']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$team = mysqli_real_escape_string($conn, $_POST['team']);
		$passwort = mysqli_real_escape_string($conn, $_POST['passwort']);
		$ligaid = mysqli_real_escape_string($conn, $_POST['ligaid']);

		// CREATE HASH FROM PW
		$hash = password_hash($passwort, PASSWORD_DEFAULT);

		// INSERT INTO DB
		$insert1 = mysqli_query($conn, 'INSERT INTO benutzer (vorname, nachname, email, kennwort, team, liga_id) VALUES ("'.$vorname.'", "'.$nachname.'", "'.$email.'", "'.$hash.'", "'.$team.'", '.$ligaid.')');
		if($insert1) {
			$last_id = mysqli_insert_id($conn);
			$insert2 = mysqli_query($conn, 'INSERT INTO tipper_details (benutzer_id) VALUES ('.$last_id.')');
			if($insert2) {
				echo true;
			}
		}

	} else {
		echo false;
	}
?>