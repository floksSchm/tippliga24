<!DOCTYPE html>
<?php
     session_start();
     include_once ("include/connect.php");

     if(!isset($_SESSION['login']) || !$_SESSION['login']):?>
<html lang="de" ng-app="tl" ng-controller="siteCtrl">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tippliga24 - Regeln</title>
   <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
  <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
  <link type="text/css" rel="stylesheet" href="css/ng-table.css">
  <link type="text/css" rel="stylesheet" href="css/styles.css">
</head>
<body>
  
  <?php include_once('views/navigation.php');?>
<?php include_once('views/page-title.php');?>
<?php include_once('include/content/regeln_content.php');?>
<?php include_once('views/footer.php');?>

  
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="js/angular.js"></script>
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/ng-table.js"></script>
   <script src="js/ckeditor/ckeditor.js" type="text/javascript"></script>
  <script src="js/ng-ckeditor.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/tl.js"></script>

</body>
</html>

<?php elseif(isset($_SESSION['login']) && $_SESSION['login']):?>
<html lang="de" ng-app="tl" ng-controller="siteCtrl">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tippliga24 - Regeln</title>
  <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
  <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
  <link type="text/css" rel="stylesheet" href="css/ng-table.css">
  <link type="text/css" rel="stylesheet" href="css/styles.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <?php include_once('views/navigation.php'); ?>
<?php include_once('views/page-title.php');?>
<?php include_once('include/content/regeln_content.php');?>
<?php include_once('views/footer.php');?>

 <?php include_once('views/profil.php'); ?>
 
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="js/angular.js"></script>
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/ng-table.js"></script>
    <script src="js/ckeditor/ckeditor.js" type="text/javascript"></script>
  <script src="js/ng-ckeditor.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/tl.js"></script>


</body>
</html>
<?php endif;?>