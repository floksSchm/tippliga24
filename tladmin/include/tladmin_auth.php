<?php
     session_start();
     include_once ("../include/connect.php");
     
     $hostname = $_SERVER['HTTP_HOST'];
     
     if(!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
     	header('Location: http://'.$hostname.'/tladmin/index.php');
      	exit;
     }
      
?>