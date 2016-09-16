<?php 
	session_start();
	include_once('../connect.php');

	$post = json_decode(file_get_contents('php://input'), true); 

	if(isset($post['Spieler'])) {

		$spieler = utf8_decode(mysqli_real_escape_string($conn, $post['Spieler']));
		$stadion = utf8_decode(mysqli_real_escape_string($conn, $post['Stadion']));
		$beschreibung = mysqli_real_escape_string($conn, $post['Beschreibung']);

		$sql = 'UPDATE tipper_details SET spieler="'.$spieler.'", stadion= "'.$stadion.'", beschreibung="'.$beschreibung.'" WHERE benutzer_id='.$_SESSION["id"].'';
		$result = mysqli_query($conn, $sql);	

		echo var_dump($post);	
	}
?>