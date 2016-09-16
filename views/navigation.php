<header class="header">
    <div class="container-fluid header-top">
	    <div class="row" id="top-header">
	    	<div class="header-logo col-xs-8 col-sm-4 col-md-3">
                <a href="/index.php" >
                    <img class="img-responsive" id="logo" src="img/logo.gif">
                </a>
				
			</div>
			<div class="col-xs-4 col-sm-8 col-md-9 header-navi">
				<?php if(!isset($_SESSION['login']) || !$_SESSION['login']):?>
				<div class="login pull-right">
		          <a href="#" class="login-link btn btn-ar btn-default" data-toggle="modal" data-target="#loginModal"><i class="glyphicon glyphicon-user"></i> Login</a>
		        </div>
		    	<?php endif;?>
		        <?php if(isset($_SESSION['login']) && $_SESSION['login']):?>
			        <div class="profil pull-right">
			        	 <a href="#" class="profil-link btn btn-ar btn-default" data-toggle="modal" data-target="#profilModal"><i class="glyphicon glyphicon-user"></i> Profil</a>
                          <a href="../include/logout.php" class="logout-link btn btn-ar btn-default hidden-xs" ><i class="glyphicon glyphicon-log-out"></i> Logout</a>
                        <span class="teamname-navi hidden-xs">Angemeldet als: <?php echo $_SESSION['team'];?></span>
			        </div>
		        <?php endif;?>
		    	
			</div>
	    </div>
    </div>
    <nav class="main-nav navbar navbar-default">
      	<div class="container-fluid navbar-wrapper">
      		<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navi-collapsed">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php if(isset($_SESSION['login']) && $_SESSION['login']):?>
                    <a class="navbar-brand visible-xs" href="#"><?php echo $_SESSION['team'];?></a>
                <?php else:?>
                    <a class="navbar-brand visible-xs" href="#">Navigation</a>
                <?php endif;?>
            </div>
            <div class="collapse navbar-collapse" id="main-navi-collapsed">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="teams.php">Teams</a>
                    </li>
                    <li>
                        <a href="liga.php">Ligen</a>
                    </li>
                    <li>
                        <a href="tippschuetze.php">Tippschütze</a>
                    </li>
                    <li>
                        <a href="pokal.php">Pokal</a>
                    </li>
                    <!--li>
                        <a href="#">Genesis-Liga</a>
                    </li>
                    <li>
                        <a href="#">Historie</a>
                    </li>
                    <li>
                        <a href="#">News</a>
                    </li-->
                    <li>
                        <a href="regeln.php">Regeln</a>
                    </li>
                    <li>
                        <a href="fundstuecke.php">Fundstücke</a>
                    </li>
                    <li>
                        <a href="kontakt.php">Kontakt</a>
                    </li>
                    <?php if(isset($_SESSION['login']) && $_SESSION['login']):?>
                    	<li class="visible-xs-block">
	                        <a href="../include/logout.php">Logout</a>
	                    </li>
                    <?php endif;?>
                </ul>
            </div>
      	</div>
  	</nav>
</header>

<div class="modal fade" id="loginModal">
    <div class="modal-dialog">
      <div class="modal-header">
        <h4>Login</h4>
      </div>
      <div class="modal-content">
        <form role="form" method="POST" action="include/login.php">
            
            <div class="form-group">
                <div class="input-group">
                    
                    <input type="text" class="form-control" placeholder="Team" name="team">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                </div>
                <br>
                <div class="input-group">
                    
                    <input type="password" class="form-control" placeholder="Passwort" name="passwort">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                </div>
                <!--div class="checkbox pull-left">
                      <input type="checkbox" id="loginMerken" name="loginMerken">
                      <label for="checkbox_remember1">
                         Login merken
                      </label>
                </div-->
                <button type="submit" name="login" class="btn btn-ar btn-primary pull-right">Login</button>
                <div class="clearfix"></div>
            </div>
        </form>
      </div>
    </div>
  </div>
<?php if(isset($_GET['fail']) && $_GET['fail'] == '1'):?>
    <input type="hidden" id="loginFailTrigger">
<?php endif;?>
<div class="modal fade" id="loginFail">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="loginFailText">
            <p>Es gab ein Fehler beim Login! Bitte versuch es nochmals.</p>
        </div>
      </div>
    </div>
  </div>
