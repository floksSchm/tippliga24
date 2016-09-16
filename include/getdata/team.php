<?php 
	session_start();
	include_once('../connect.php');

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	$getID = $_GET['id'];
	$data = [];
	if($getID != '' &&  $getID) {
		$user = mysqli_query($conn, 'SELECT * FROM benutzer INNER JOIN tipper_liga AS tl ON benutzer.liga_id = tl.liga_id INNER JOIN tipper_details ON benutzer.benutzer_id = tipper_details.benutzer_id  WHERE benutzer.benutzer_id='.$getID.'');

		$details = [];
		while($rs = mysqli_fetch_assoc($user)) {
			$details['team'] = $rs["team"];
			$details['vorname'] = $rs["vorname"];
			$details['nachname'] = $rs["nachname"];
			$details['team_logo'] = $rs["team_logo"];
			$details['id'] = $getID;
			$details['spieler'] = $rs["spieler"];
			$details['stadion'] = $rs["stadion"];
			$details['beschreibung'] = $rs["beschreibung"];
			$details['liga_name'] = $rs["liga_name"];
			
			//BILDER
			$details['pic1'] =  $rs["pic1"];
			$details['pic2'] =  $rs["pic2"];
			$details['pic3'] =  $rs["pic3"];
			$details['pic4'] =  $rs["pic4"];
			$details['pic5'] =  $rs["pic5"];

			array_push($data, $details);
		}

		$result2 = mysqli_query($conn, "SELECT * FROM tipper_comments WHERE benutzer_id=".$getID." ORDER BY timestamp DESC");
		$comments = [];
		while($ts = mysqli_fetch_assoc($result2)) {
		    $comment = [];
		    $trainer;
		    $writer = mysqli_query($conn, 'SELECT * FROM benutzer WHERE benutzer_id = '.$ts["comment_writer"].'');
		    while($wr = mysqli_fetch_assoc($writer)) {
		        $trainer = $wr['vorname'].' '.$wr['nachname'];
		    }

		    $comment['Writer'] = $trainer;
		    $comment['Timestamp'] = $ts["timestamp"];
		    $comment['Header'] = $ts["comment_header"];
		    $comment['Comment'] = $ts["comment"];
		    array_push($comments, $comment);
		}

		array_push($data, $comments);

		echo json_encode($data);
	}
	
?>