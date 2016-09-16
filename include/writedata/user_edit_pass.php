<?php 
	session_start();
	include_once('../connect.php');

	$post = json_decode(file_get_contents('php://input'), true); 
	echo var_dump($post);

	if(isset($post['passAlt'])) {
		$query_user = mysqli_query($conn,'SELECT * FROM benutzer WHERE benutzer_id = "'.$_SESSION["id"].'"');
		$passAlt = mysqli_real_escape_string($conn, $post['passAlt']);
		$passNeu1 = mysqli_real_escape_string($conn, $post['passNeu1']);
		$passNeu2 = mysqli_real_escape_string($conn, $post['passNeu2']);
		if(mysqli_num_rows($query_user) == 1) {
			 while($result = mysqli_fetch_assoc($query_user)) {
			 	if(password_verify($passAlt ,$result['kennwort'])) {

			 		$hash = password_hash($passNeu1, PASSWORD_DEFAULT);

			 		$sql = 'UPDATE benutzer SET kennwort="'.$hash.'" WHERE benutzer_id='.$_SESSION["id"].'';
					$result = mysqli_query($conn, $sql);
					echo $result;
			 	} else {
			 		echo false;
			 	}
			 }

		} else {
	 		echo false;
	 	}	
	}
?>