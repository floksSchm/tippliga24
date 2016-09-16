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
            <input type="text" name="q" class="form-control" placeholder="Search..."/>
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
          <li><a href="benutzer.php"><span class="glyphicon glyphicon-user"></span> <span>Benutzer</span></a></li>
          <li class="active"><a href="datacenter.php"><span class="glyphicon glyphicon-file"></span> <span>Data-Center</span></a></li>
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
          Data-Center
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
          <li class="active">Here</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- Your Page Content Here -->

        <!-- DATEN INPUT FORM -->
        <form class="form-horizontal" id="datenInputForm">
        <h3>Spieldaten einfügen</h3>
          <div class="row">
            <div class="form-group col-lg-4 col-xs-12">
              <label class="col-lg-8 control-label">Start Spieltag</label>
              <div class="col-lg-4">
                <input type="number" class="form-control" ng-model="startSpieltag" name="startSpieltag" placeholder="Start-Spieltag">
              </div>
            </div>
            <div class="form-group col-lg-4 col-xs-12">
              <label class="col-lg-8 control-label">Anzahl Spieltage</label>
              <div class="col-lg-4">
                <input type="number" class="form-control" ng-model="anzahlSpieltag" name="anzahlSpieltag" placeholder="Anzahl Spieltage">
              </div>
            </div>
            <div class="form-group col-lg-4 col-xs-12">
              <label class="col-lg-8 control-label">Saisonjahr</label>
              <div class="col-lg-4">
                <input type="number" class="form-control" ng-model="saisonJahr" name="saisonJahr" placeholder="Saison">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-lg-4 col-xs-12">
              <label class="col-lg-8 control-label">Liga-Kürzel</label>
              <div class="col-lg-4">
                <input type="text" class="form-control" ng-model="ligaKuerzel" name="ligaKuerzel" placeholder="Liga-Kürzel">
              </div>    
            </div>
            <div class="form-group col-lg-4 col-xs-12">
              <label class="col-lg-8 control-label">In welche Tabelle sollen die Daten eingefügt werden?</label>
              <div class="col-lg-4">
                <input type="text" class="form-control" ng-model="tblDaten" name="tblDaten" placeholder="Tabelle">
              </div>    
            </div>
            <div class="form-group col-lg-4 col-xs-12">
              <div class="col-lg-4">
                <button type="button" class="btn btn-success" ng-click="insertData(startSpieltag, anzahlSpieltag, saisonJahr, ligaKuerzel, tblDaten)" id="insertData">Daten einfügen</button>
              </div>    
            </div>
          </div>         
        </form>

        <!-- MATCHUP FORM -->

        <form class="form-horizontal" id="matchupForm">
        <h3>Tipper Matchups erstellen</h3>
        <div class="row">
          <div class="form-group col-lg-4 col-xs-12">
            <label class="col-lg-8 control-label">Für welche Liga sollen die Matchups erstellt werden?</label>
            <div class="col-lg-4">
              <input type="number" class="form-control" ng-model="ligaID" name="ligaid" placeholder="Liga-ID">
            </div>    
          </div>
          <div class="form-group col-lg-4 col-xs-12">
            <label class="col-lg-8 control-label">In welche Tabelle sollen die Matchups eingefügt werden?</label>
            <div class="col-lg-4">
              <input type="text" class="form-control" ng-model="tblmatchup" name="tblmatchup" placeholder="Tabellen-Name">
            </div>    
          </div>
          <div class="form-group col-lg-4 col-xs-12">
            <div class="col-lg-4">
              <button type="button" class="btn btn-success" ng-click="createMatchup(ligaID, tblmatchup)" id="matchupdata">Matchup erstellen</button>
            </div>    
          </div>
        </div>
        </form>

        <!-- MATCHUP POKAL FORM -->

        <form class="form-horizontal" id="pokalForm">
        <h3>Tipper Pokal-Matchups erstellen</h3>
        <div class="row">
          <div class="form-group col-lg-4 col-xs-12">
            <label class="col-lg-8 control-label">Geben Sie die Pokal-ID an</label>
            <div class="col-lg-4">
              <input type="number" class="form-control" ng-model="pokalid" name="pokalid" placeholder="Pokal-ID">
            </div>    
          </div>
          <div class="form-group col-lg-4 col-xs-12">
            <label class="col-lg-8 control-label">In welche Tabelle sollen die Pokal-Matchups eingefügt werden?</label>
            <div class="col-lg-4">
              <input type="text" class="form-control" ng-model="pokalmatchup" name="pokalmatchup" placeholder="Tabellen-Name">
            </div>    
          </div>
          <div class="form-group col-lg-4 col-xs-12">
            <div class="col-lg-4">
              <button type="button" class="btn btn-success" ng-click="createPokalMatchup(pokalid, pokalmatchup)" id="pokaldata">Pokal-Matchups erstellen</button>
            </div>    
          </div>
        </div>
        </form>

        <!-- BENUTZER ERSTELLEN FORM -->

        <form class="form-horizontal" id="createUserForm">
        <h3>Benutzer erstellen</h3>
        <div class="row">
          <div class="form-group col-lg-4 col-xs-12">
            <label class="col-lg-8 control-label">Vorname</label>
            <div class="col-lg-4">
              <input type="text" class="form-control" ng-model="vorname" name="vorname" placeholder="Vorname">
            </div>    
          </div>
          <div class="form-group col-lg-4 col-xs-12">
            <label class="col-lg-8 control-label">Nachname</label>
            <div class="col-lg-4">
              <input type="text" class="form-control" ng-model="nachname" name="nachname" placeholder="Nachname">
            </div>    
          </div>
          <div class="form-group col-lg-4 col-xs-12">
            <label class="col-lg-8 control-label">E-Mail</label>
            <div class="col-lg-4">
              <input type="email" class="form-control" ng-model="email" name="email" placeholder="E-Mail">
            </div>    
          </div>
          <div class="form-group col-lg-4 col-xs-12">
            <label class="col-lg-8 control-label">Passwort</label>
            <div class="col-lg-4">
              <input type="text" class="form-control" ng-model="passwort" name="passwort" placeholder="Passwort">
            </div>    
          </div>
          <div class="form-group col-lg-4 col-xs-12">
            <label class="col-lg-8 control-label">Team</label>
            <div class="col-lg-4">
              <input type="text" class="form-control" ng-model="team" name="team" placeholder="Team">
            </div>    
          </div>
          <div class="form-group col-lg-4 col-xs-12">
            <label class="col-lg-8 control-label">Liga-ID</label>
            <div class="col-lg-4">
              <input type="number" class="form-control" ng-model="ligaid" name="ligaid" placeholder="Liga-ID">
            </div>    
          </div>
          <div class="form-group col-lg-4 col-xs-12">
            <div class="col-lg-4">
              <button type="button" class="btn btn-success" ng-click="createUser(vorname,nachname,email,passwort,team,ligaid)" id="userdata">Benutzer erstellen</button>
            </div>    
          </div>
        </div>
        </form>


      </section><!-- /.content -->
      <!-- START USER MODAL -->
          <div class="modal fade bs-example-modal-sm" id="user-modal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-body">
                  <div>
                    Benutzer erstellen?
                  </div>
                  <div class="alert alert-success" id="userSuccess" role="alert">Benutzer wurde erstellt.</div>
                  <div class="alert alert-warning" id="userCreateFail" role="alert"> Es gab einen Fehler beim Erstellen des Benutzers!</div>
                  <div class="alert alert-warning" id="userFail" role="alert"> Es müssen alle Felder ausgefüllt werden.</div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" id="userSubmit">Erstellen</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                  <input type="hidden" value="" name="vorname">
                  <input type="hidden" value="" name="nachname">
                  <input type="hidden" value="" name="passwort">
                  <input type="hidden" value="" name="email">
                  <input type="hidden" value="" name="ligaid">
                  <input type="hidden" value="" name="team">
                </div>
              </div>
            </div>
          </div>
        <!-- END USER MODAL -->

         <!-- START POKAL MATCHUP MODAL -->
          <div class="modal fade bs-example-modal-sm" id="pokal-modal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-body">
                  <div>
                   Pokal Matchups erstellen?
                  </div>
                  <div class="alert alert-success" id="pokalSuccess" role="alert"> Pokal-Matchups wurden erstellt.</div>
                  <div class="alert alert-warning" id="pokalInsertFail" role="alert"> Es gab einen Fehler beim Erstellen der Pokal-Matchups!</div>
                  <div class="alert alert-warning" id="pokalFail" role="alert"> Es müssen alle Felder ausgefüllt werden.</div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" id="pokalMatchupsSubmit">Erstellen</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                  <input type="hidden" value="" name="pokalid">
                  <input type="hidden" value="" name="pokalmatchup">
                </div>
              </div>
            </div>
          </div>
        <!-- END POKAL MATCHUP MODAL -->

      <!-- START MATCHUP MODAL -->
          <div class="modal fade bs-example-modal-sm" id="matchup-modal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-body">
                  <div>
                    Matchups erstellen?
                  </div>
                  <div class="alert alert-success" id="matchupSuccess" role="alert"> Matchups wurden erstellt.</div>
                  <div class="alert alert-warning" id="matchupFail" role="alert"> Es gab einen Fehler beim Erstellen der Matchups!</div>
                  <div class="alert alert-warning" id="variablesFail" role="alert"> Es müssen alle Felder ausgefüllt werden.</div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" id="matchupSubmit">Speichern</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                  <input type="hidden" value="" name="ligaid">
                  <input type="hidden" value="" name="tblmatchup">
                </div>
              </div>
            </div>
          </div>
        <!-- END MATCHUP MODAL -->

          <!-- START INSERTDATA MODAL -->
          <div class="modal fade bs-example-modal-sm" id="insertData-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-body">
                  <div>
                    Daten in die Tabelle eintragen?
                  </div>
                  <div class="alert alert-success" id="insertDataSuccess" role="alert"> Daten wurden eingefügt.</div>
                  <div class="alert alert-warning" id="insertDataFail" role="alert"> Es gab einen Fehler beim Einfügen der Daten!</div>
                  <div class="alert alert-warning" id="variablesFail" role="alert"> Sie müssen alle Felder ausfüllen, um Daten in die Datenbank einzufügen!</div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" id="insertDataSubmit">Ja</button>
                  <button type="button" class="btn btn-default" id="insertDataDeny" data-dismiss="modal">Nein</button>
                  <input type="hidden" value="" name="startSpieltag">
                  <input type="hidden" value="" name="anzahlSpieltag">
                  <input type="hidden" value="" name="saisonJahr">
                  <input type="hidden" value="" name="ligaKuerzel">
                  <input type="hidden" value="" name="tblDaten">
                </div>
              </div>
            </div>
          </div>
          <!-- END INSERTDATA MODAL -->
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