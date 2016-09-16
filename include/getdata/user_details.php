<?php
session_start();
include_once('../connect.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_SESSION['login']) && $_SESSION['login']) {
    $result = mysqli_query($conn, 'SELECT * FROM tipper_details WHERE benutzer_id = '.$_SESSION["id"].'');

    $data = [];
    while($rs = mysqli_fetch_assoc($result)) {
        $details = [];
        $details['Spieler'] = $rs["spieler"];
        $details['Stadion'] = $rs["stadion"];
        $details['Beschreibung'] = html_entity_decode($rs["beschreibung"]);
        $details['Teamlogo'] = $rs["team_logo"];
        $details['Pic1'] = $rs["pic1"];
        $details['Pic2'] = $rs["pic2"];
        $details['Pic3'] = $rs["pic3"];
        $details['Pic4'] = $rs["pic4"];
        $details['Pic5'] = $rs["pic5"];
        $cnt = 0;
        $pics = [];
        array_push($pics, $rs["pic1"], $rs["pic2"], $rs["pic3"], $rs["pic4"], $rs["pic5"]);
        for($i = 0; $i < 5; $i++){
            if($pics[$i] != NULL) {
                $cnt++;
            }
        }
        $details['cntPics'] = $cnt;
        array_push($data, $details);
    }

    $result2 = mysqli_query($conn, "SELECT * FROM tipper_comments WHERE benutzer_id=".$_SESSION['id']." ORDER BY timestamp DESC");
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