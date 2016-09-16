<?php include_once($_SERVER['DOCUMENT_ROOT'].'include/getdata/home.php');?>
<main class="home">	
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 slick-slider" >
				 <img class="slick-item" data-lazy="/img/fundstuecke/2005_1/DCP02090.jpg" alt="Slick Image">
				  <img class="slick-item" data-lazy="/img/fundstuecke/2002_1/P1010007.jpg" alt="Slick Image">
				  <img class="slick-item" data-lazy="/img/fundstuecke/2005_1/DCP02100.jpg" alt="Slick Image">
				<img class="slick-item" data-lazy="/img/fundstuecke/2001_1/P1010025_JPG.jpg" alt="Slick Image">
				<img class="slick-item" data-lazy="/img/fundstuecke/2001_2/P1010150_JPG.jpg" alt="Slick Image">
				  <img class="slick-item" data-lazy="/img/fundstuecke/2003_1/DCP00397.jpg" alt="Slick Image">
				  <img class="slick-item" data-lazy="/img/fundstuecke/2003_1/DCP00398.jpg" alt="Slick Image">
				<img class="slick-item" data-lazy="/img/fundstuecke/2003_1/DCP00399.jpg" alt="Slick Image">
				<img class="slick-item" data-lazy="/img/fundstuecke/2003_1/DCP00402.jpg" alt="Slick Image">
				<img class="slick-item" data-lazy="/img/fundstuecke/2004_2/x105-0534_IMG.jpg" alt="Slick Image">
				 
			</div>
		</div>
	</div>
	<div class="home-static">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<h2>Willkommen bei der Tippliga24</h2>
					<p>
						Der Treffpunkt für alle Fußballfans die der Leidenschaft des Tippsports erlegen sind. Für alle Anhänger der kultigsten Tippliga-Arena der Welt. Für die nicht Every Day Matchday ist, sondern jede Sekunde. Für Statistik-Tipper und Aus-Dem-Bauch-Heraus-Entscheider. Für die Stehplatz-Tippliga-Ultras und Sofa-Kuschel-Tipper. Für alle H7-Bundesliga-Gucker und SWR1-Stadion-Hörer. Für Offensiv-Fanatiker und Defensiv-Fetischisten. Sogar für alle 2:1-Tipper - den Turnbeutelvergessern des Tippsports.<br />
						Für euch alle:<br />
						<h3>Tippsport's coming home!</h3>


					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<!--div class="row">
			<div class="col-xs-12">
				<h3>News</h3>
			</div>
			<div class="col-xs-12 news-container">
				<div class="news-item thumbnail">
					<div class="news-item-header">
					
					</div>
					<div class="news-item-content">
						
					</div>
				</div>
			</div>
			<div class="col-xs-12 news-container">
				
			</div>
		</div-->
		<div class="row">
			<div class="col-xs-12">
				<h3>Infos</h3>
			</div>
				<?php foreach ($titel as $key => $value):?>
					<?php if($key == 0):?>
						<div class="col-xs-12 col-sm-4 col-md-3 info-container">
							<div class="info-item thumbnail">
								<div class="info-item-header">
									Meister
								</div>
								<?php if($value['team_logo']):?>
									<img class="img-responsive titel-logo thumbnail" src="/include/uploads/teams/<?php echo $value['meister_id'];?>/<?php echo $value['team_logo'];?>">
								<?php else:?>
									<img class="img-responsive titel-logo thumbnail" src="/include/uploads/teams/placeholder.jpg">
								<?php endif;?>
								<div class="info-item-content">
									<div class="info-item-inner">
										<i class="fa fa-trophy" aria-hidden="true"></i> <?php echo $value['meister_team'];?> 
									</div>
								</div>

							</div>
						</div>
						
					<?php else:?>
						<div class="col-xs-12 col-sm-4 col-md-3 info-container">
							<div class="info-item thumbnail">
								<div class="info-item-header">
									Pokalsieger
								</div>
								<?php if($value['team_logo']):?>
									<img class="img-responsive titel-logo thumbnail" src="/include/uploads/teams/<?php echo $value['pokal_id'];?>/<?php echo $value['team_logo'];?>">
								<?php else:?>
									<img class="img-responsive titel-logo thumbnail" src="/include/uploads/teams/placeholder.jpg">
								<?php endif;?>
								<div class="info-item-content">
									<div class="info-item-inner">
										<i class="fa fa-trophy" aria-hidden="true"></i> <?php echo $value['pokal_team'];?> 
									</div>
								</div>

							</div>
						</div>
					<?php endif;?>

				<?php endforeach;?>

				<div class="col-xs-12 col-sm-4 col-md-3 info-container">
					<div class="info-item thumbnail">
						<div class="info-item-header">
							Tippschützen Ewige Tabelle
						</div>
						<table class="table">
							<tr>
								<th>#</th>
								<th>Team</th>
								<th class="visible-xs-table-block">Spieler</th>
								<th><i class="fa fa-futbol-o" aria-hidden="true"></i></th>
							</tr>
							<?php foreach ($tippschuetze_ewig as $key => $value):?>
								<tr>
									<td><?php echo $key+1;?>.</td>
									<td><?php echo $value['team'];?></td>
									<td class="visible-xs-table-block"><?php echo $value['spieler'];?></td>
									<td><?php echo $value['tore'];?></td>
								</tr>
							<?php endforeach;?>
						</table>
					</div>
				</div>

				<div class="col-xs-12 col-sm-4 col-md-3 info-container">
					<div class="info-item thumbnail">
						<div class="info-item-header">
							Tippschützen Aktuelle Saison
						</div>
						<table class="table">
							<tr>
								<th>#</th>
								<th>Team</th>
								<th class="visible-xs-table-block">Spieler</th>
								<th><i class="fa fa-futbol-o" aria-hidden="true"></i></th>
							</tr>
							<?php foreach ($tippschuetze_akt as $key => $value):?>
								<tr>
									<td><?php echo $key+1;?>.</td>
									<td><?php echo $value['team'];?></td>
									<td class="visible-xs-table-block"><?php echo $value['spieler'];?></td>
									<td><?php echo $value['tore'];?></td>
								</tr>
							<?php endforeach;?>
						</table>
					</div>
				</div>
				
	
		</div>
	</div>
</main>