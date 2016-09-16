<?php
	session_start();
 	$hostname = $_SERVER['HTTP_HOST'];
	if (isset($_SESSION['login']) && $_SESSION['admin'] == 1) {
		header('Location: http://'.$hostname.'/tladmin/home.php');
      	exit();
	} elseif (isset($_POST['login-admin'])) {
		$team = mysqli_real_escape_string($conn,$_POST['team']);
  		$passwort = mysqli_real_escape_string($conn,$_POST['passwort']);


		$query_user = mysqli_query($conn,'SELECT * FROM benutzer WHERE team = "'.$team.'"');

		while($result = mysqli_fetch_assoc($query_user)) {
			if(password_verify($passwort,$result['kennwort']) && $team == $result['team'] && intval($result['admin']) == 1) {
				$_SESSION['id'] = $result['benutzer_id'];
				$_SESSION['vorname'] = $result['vorname'];
				$_SESSION['name'] = $result['nachname'];
				$_SESSION['email'] = $result['email'];
				$_SESSION['team'] = $team;
	      		$_SESSION['liga_id'] = $result['liga_id'];
	      		$_SESSION['admin'] = intval($result['admin']);
	      		$_SESSION['pokal'] = intval($result['pokal']);

	      		$_SESSION['login'] = true;

	      		header('Location: http://'.$hostname.'/tladmin/home.php');
      			exit();
			} elseif (!password_verify($passwort,$result['kennwort'])) {
				echo '<div class="alert alert-danger" role="alert">Hoppla! Passwort oder Teamname falsch.</div>';
			} elseif (intval($result['admin']) != 1) {
				echo '<div class="alert alert-danger" role="alert">Du hast nicht die nötigen Berechtigungen für diesen Bereich.</div>';
			}
		}
	}
?>