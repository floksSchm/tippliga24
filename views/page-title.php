<?php 
	$headers = ['/teams.php' => 'Die Teams','/liga.php' => 'Deine Tipp-Arena','/tippschuetze.php' => 'Tippschützen','/pokal.php' => 'Deine Pokal-Arena','/regeln.php' => 'Die Regeln','/fundstuecke.php' => 'Fundstücke','/registrierung_page.php' => 'Registrierung','/impressum.php' => 'Impressum','/kontakt.php' => 'Kontakt'];
	$subtitles = ['/teams.php' => 'Kenne deine Gegner!','/liga.php' => 'Tippe gegen deine Gegner','/tippschuetze.php' => 'Die treffsichersten Tipper der Liga','/pokal.php' => 'Der TL24-Pokal', '/regeln.php' => 'Kleine Regelkunde für Tippanfänger','/fundstuecke.php' => 'Diese Bilder sind für Kinder und Jugendliche unter 16 Jahren nicht geeignet','/registrierung_page.php' => 'Dein erster Schritt zur Tipp-Legende','/impressum.php' => 'Rund um die Tippliga24','/kontakt.php' => 'Schreibe den TL24-Machern'];
	$page = $_SERVER['REQUEST_URI'];
	$pagetitle = '';
	$pagesubtitle = '';

	foreach ($headers as $item => $title) {
		if($page == $item) {
			$pagetitle = $title;
		}
	}

	foreach ($subtitles as $item => $subtitle) {
		if($page == $item) {
			$pagesubtitle = $subtitle;
		}
	}
?>

<?php if($pagetitle != ''):?>
	<section class="page-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h1><?php echo $pagetitle;?></h1>
				</div>
				<div class="col-md-12">
					<span class="pagesubtitle"><?php echo $pagesubtitle;?></span>
				</div>
			</div>
		</div>
	</section>
<?php else:?>
	<section class="page-header-empty">
		<div class="container-fluid">
			<div class="row">
				
			</div>
		</div>
	</section>
<?php endif;?>