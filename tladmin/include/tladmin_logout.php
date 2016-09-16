<?php
	 $hostname = $_SERVER['HTTP_HOST'];
     session_start();
     session_destroy();

	 header('Location: http://'.$hostname.'/tladmin/index.php');
     exit();
?>