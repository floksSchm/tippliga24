<!doctype html>
<html lang="de" ng-app="tladmin">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Tippliga24 Admin</title>
	<?php include_once('../include/connect.php');?>
   <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css">
	  <link type="text/css" rel="stylesheet" href="../css/ng-table.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	  <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	  <link href="css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	  <link href="css/skin-blue.min.css" rel="stylesheet" type="text/css" />
</head>
<body>

	<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3 loginform">
				<div class="panel panel-login">
					<div class="panel-heading">
						TL24 Admin-Login
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="team" id="username" tabindex="1" class="form-control" placeholder="Teamname" value="">
									</div>
									<div class="form-group">
										<input type="password" name="passwort" id="password" tabindex="2" class="form-control" placeholder="Passwort">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-admin" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
								</form>
								<?php include_once('include/tladmin_login.php');?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- REQUIRED JS SCRIPTS --> 
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
   <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/ng-table.js"></script>
  <script src="../js/main.js"></script>
  <!-- AdminLTE App -->
  <script src="js/tladmin.js"></script>
  <script src="js/app.min.js" type="text/javascript"></script>
</body>
</html>