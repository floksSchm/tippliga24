<?php
     session_start();
     include_once ("connect.php");

     if (!isset($_SESSION['login']) || !$_SESSION['login']) {
?>