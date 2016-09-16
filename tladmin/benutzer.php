<!doctype html>
<?php include_once('include/tladmin_auth.php'); ?>
<html lang="de" ng-app="tladmin" ng-controller="customersCtrl">
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
            <input type="text" name="q" ng-model="tlsearch" class="form-control" placeholder="Search..."/>
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
          <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> <span>Home</span></a></li>
          <li class="active"><a href="benutzer.php"><span class="glyphicon glyphicon-user"></span> <span>Benutzer</span></a></li>
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
          TL24-Tipper
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
          <li class="active">Here</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- Your Page Content Here -->
        <div class="table-responsive">
          <table class="table" id="user-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Vorname</th>
                <th>Nachname</th>
                <th>E-Mail</th>
                <th>Team</th>
                <th>Admin</th>
                <th>Aktiv</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="x in user | filter:tlsearch">
                <td>{{ x.ID }}</td>
                <td>{{ x.Vorname }}</td>
                <td>{{ x.Nachname }}</td>
                <td>{{ x.EMail }}</td>
                <td>{{ x.Team }}</td>
                <td>{{ x.Admin }}</td>
                <td>{{ x.Aktiv }}</td>
                <td>
                  <button type="button" ng-hide="{{x.Aktiv}}" ng-click="userActivate(x.ID, x.Aktiv)" class="btn btn-success"><span class="glyphicon glyphicon-heart"></span> Aktivieren</button><button type="button" ng-show="{{x.Aktiv}}" ng-click="userActivate(x.ID, x.Aktiv)" class="btn btn-success"><span class="glyphicon glyphicon-heart"></span> Deaktivieren</button>
                  <button type="button" data-toggle="editModal" data-target="#userEdit-modal" data-id="{{x.ID}}" data-vorname="{{x.Vorname}}" data-name="{{x.Nachname}}" data-email="{{x.EMail}}" data-team="{{x.Team}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Edit</button>      
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section><!-- /.content -->
      <!-- START EDIT MODAL -->
          <div class="modal fade bs-example-modal-sm" id="userEdit-modal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Tipper bearbeiten</h4>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal">

                    <input type="hidden" name="id" value="">
                  
                    <div class="form-group">
                      <label for="eingabeVorname" class="col-sm-2 control-label">Vorname</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="vorname"value="">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="eingabeName" class="col-sm-2 control-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="eingabeEmail" class="col-sm-2 control-label">E-Mail</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" value="">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Team</label>
                      <div class="col-sm-10">
                        <p class="form-control-static" name="team"></p>
                      </div>
                    </div>

                    <div class="alert alert-success" id="userSaveSuccess" role="alert"> Die Daten wurden erfolgreich gespeichert.</div>
                    <div class="alert alert-warning" id="userSaveFail" role="alert"> Es gab einen Fehler beim Speichern der Daten!</div>

                  </form>    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                  <button type="submit" class="btn btn-primary" id="editModalSubmit">Änderungen speichern</button>
                </div>
              </div>
            </div>
          </div>
          <!-- END EDIT MODAL -->
          <!-- START ACTIVATE MODAL -->
          <div class="modal fade bs-example-modal-sm" id="userActivate-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-body">
                  <div>
                    Wollen Sie den Status des Tippers ändern?
                  </div>
                  <div class="alert alert-success" id="userActivateSuccess" role="alert"> Statusänderung wurden übernommen.</div>
                  <div class="alert alert-warning" id="userActivateFail" role="alert"> Es gab einen Fehler beim Ändern der Daten!</div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" id="activateModalSubmit">Ja</button>
                  <button type="button" class="btn btn-default" id="activateModalDeny" data-dismiss="modal">Nein</button>
                  <button type="button" class="btn btn-default" id="activateModalClose" data-dismiss="modal">Schließen</button>
                  <input type="hidden" value="" name="activateID">
                  <input type="hidden" value="" name="activateAktiv">
                </div>
              </div>
            </div>
          </div>
          <!-- END ACTIVATE MODAL -->
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
  
   <script   src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/ng-table.js"></script>
  <script src="../js/main.js"></script>
  <!-- AdminLTE App -->
  <script src="js/tladmin.js"></script>
  <script src="js/app.min.js" type="text/javascript"></script>
</body>
</html>