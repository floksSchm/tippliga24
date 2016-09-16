<?php 
  session_start();
	include_once('../connect.php');

	$query1 = mysqli_query($conn,'SELECT * FROM tipper_wettbewerb');

	$wettbewerb = [];
    while($rs = mysqli_fetch_assoc($query1)) {
      $liga = [];

      $liga['Wettbewerb'] = $rs['wettbewerb_id'];
      $liga['Spieltag'] = $rs['spieltag_akt'];
      if(isset($_SESSION['liga_id'])) {
        $liga['Liga'] = $_SESSION['liga_id'];
      }

      array_push($wettbewerb, $liga);

    }
    

   echo json_encode($wettbewerb);
?>