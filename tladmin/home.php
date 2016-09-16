<!doctype html>
<?php include_once('include/tladmin_auth.php'); ?>
<html lang="de" ng-app="tladmin">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Tippliga24 Admin</title>

  <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css">
  <link type="text/css" rel="stylesheet" href="../css/ng-table.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <link href="css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <link href="css/skin-blue.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="skin-blue sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">
      <!-- Logo -->
      <div class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>TL24</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>TippLiga24</b>Admin</span>
      </div>
      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Control Sidebar Toggle Button -->
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>


    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" ng-model="admin-search" placeholder="Search..."/>
            <span class="input-group-btn">
              <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
          </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
          <li class="header">ADMIN PANEL</li>
          <!-- Optionally, you can add icons to the links -->
          <li class="active"><a href="home.php"><span class="glyphicon glyphicon-home"></span> <span>Home</span></a></li>
          <li><a href="benutzer.php"><span class="glyphicon glyphicon-user"></span> <span>Benutzer</span></a></li>
          <li><a href="datacenter.php"><span class="glyphicon glyphicon-file"></span> <span>Data-Center</span></a></li>
          <li><a href="finish_spieltag.php"><span class="glyphicon glyphicon-file"></span> <span>Spieltag abschließen</span></a></li>
        </ul><!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Page Header
          <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
          <li class="active">Here</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- Your Page Content Here -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="pull-right hidden-xs">
        TippLiga24
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2015 <a href="#">Florian Schmid</a>.</strong> All rights reserved.
    </footer>
    
    <!-- Control Sidebar -->      
    <aside class="control-sidebar control-sidebar-dark">                
      <!-- Tab panes -->
      <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
          <h3 class="control-sidebar-heading">Einstellungen</h3>
          <ul class='control-sidebar-menu'>
            <li>
            <a href="include/tladmin_logout.php">Logout</a>
            </li>              
          </ul><!-- /.control-sidebar-menu -->
        </div><!-- /.tab-pane -->
      </div>
    </aside><!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class='control-sidebar-bg'></div>
  </div><!-- ./wrapper -->

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