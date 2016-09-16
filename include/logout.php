<?php
     session_start();
     session_destroy();

	 $pos = strpos($_SERVER['HTTP_REFERER'], '_');
	 //$path = substr($_SERVER['HTTP_REFERER'], 0, $pos);

	$path = $_SERVER['HTTP_HOST'];

	 header('Location: ../');
     exit();
?>