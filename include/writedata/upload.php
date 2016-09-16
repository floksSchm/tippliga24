<?php
session_start();
include_once('../connect.php');

$id = $_SESSION['id'];
$storeFolder = $_SERVER['DOCUMENT_ROOT'].'/include/uploads/teams/'.$id.'/';
;   //2

if (!file_exists($storeFolder)) {
    mkdir($storeFolder, 0777, true);
}

 //Das Upload-Verzeichnis
//$filename = pathinfo($_FILES['datei']['name'], PATHINFO_FILENAME);
$filename = 'team_logo';
$extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));
 
 
//Überprüfung der Dateiendung
$allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
if(!in_array($extension, $allowed_extensions)) {
	die("Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt");
}
 
//Überprüfung der Dateigröße
$max_size = 500*1024; //500 KB
if($_FILES['datei']['size'] > $max_size) {
	die("Bitte keine Dateien größer 500kb hochladen");
}
 
 /*
//Überprüfung dass das Bild keine Fehler enthält
if(function_exists('exif_imagetype')) { //Die exif_imagetype-Funktion erfordert die exif-Erweiterung auf dem Server
	$allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
	$detected_type = exif_imagetype($_FILES['datei']['tmp_name']);
	if(!in_array($detected_type, $allowed_types)) {
		die("Nur der Upload von Bilddateien ist gestattet");
	}
}*/
 
//Pfad zum Upload
$new_path = $storeFolder.$filename.'.'.$extension;
 
//Neuer Dateiname falls die Datei bereits existiert
/*if(file_exists($new_path)) { //Falls Datei existiert, hänge eine Zahl an den Dateinamen
	$id = 1;
	do {
		$new_path = $upload_folder.$filename.'_'.$id.'.'.$extension;
		$id++;
	} while(file_exists($new_path));
}*/
 
//Alles okay, verschiebe Datei an neuen Pfad
if(move_uploaded_file($_FILES['datei']['tmp_name'], $new_path)) {
	$sql  = 'UPDATE tipper_details SET team_logo = '.$filename.'.'.$extension.' WHERE benutzer_id = '.$id.'';
	$result = mysqli_query($conn, $sql);
	header('Location: /index.php');
	exit;
}


?>    