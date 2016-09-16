<?php
	include_once('../../../include/connect.php');

	if(isset($_POST['postId'])) {
		$sql = 'UPDATE benutzer SET vorname="'.$_POST["postVorname"].'", nachname="'.$_POST["postName"].'", email="'.$_POST["postEmail"].'" WHERE benutzer_id='.intval($_POST["postId"]).'';

		$result = mysqli_query($conn, $sql);

		echo $result;
		  
		mysqli_close($conn);
	}

	if(isset($_POST['activateId'])) {
		$akt = intval($_POST['activate']);
		if($akt === 1) {
			$akt = 0;
		} else {
			$akt = 1;
		}
		$sql = 'UPDATE benutzer SET aktiv="'.$akt.'" WHERE benutzer_id='.intval($_POST["activateId"]).'';

		$result = mysqli_query($conn, $sql);

		echo $result;
		  
		mysqli_close($conn);
	}

 ?>