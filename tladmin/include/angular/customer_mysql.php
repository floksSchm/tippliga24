<?php
include_once('../../../include/connect.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$result = mysqli_query($conn, "SELECT * FROM benutzer");

$outp = "";
while($rs = mysqli_fetch_assoc($result)) {
    if ($outp != "") {
    	$outp .= ",";
    }
    $outp .= '{"ID":"'  . $rs["benutzer_id"]. '",';
    $outp .= '"Vorname":"'   . utf8_encode($rs["vorname"]). '",';
    $outp .= '"Nachname":"'. utf8_encode($rs["nachname"]). '",';
	$outp .= '"EMail":"'. utf8_encode($rs["email"]). '",';
    $outp .= '"Team":"'. utf8_encode($rs["team"]). '",';
    $outp .= '"Admin":"'. $rs["admin"]. '",';
    $outp .= '"Aktiv":"'. $rs["aktiv"].'"}'; 
}

mysqli_close($conn);

$outp ='{"customer":['.$outp.']}';

echo($outp);
?>