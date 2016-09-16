<section class="pokal">
	<div class="container-fluid pokal-wrapper">
		<div class="row pokal-select-container">
			<div class="form-group col-xs-12">
				<span id="pokalspieltag-label">Pokalrunde</span>
				<select id="pokalspieltag-select" class="form-control" ng-change="getPokal()" ng-model="selectedPokal" ng-options="item.text for item in spieltage_pokal track by item.value">
				</select>
				
			</div>
		</div>
		<div class="row pokal-spiele-container">

			<div class="col-xs-12 pokal-spiele">
				<div class="tipp-header">
					<span class="tipp-pokal-heading">2.Bundesliga</span>
					<?php if(isset($_SESSION['login']) && $_SESSION['login']):?>
						<span class="tipp-header-inner">Deine Tipps</span>
					<?php endif;?>
				</div>
				<div class="spiel-item" ng-repeat="spiel in spielepokal" ng-show="spiel.Akt" ng-cloak>
					<div class="hidden-xs matchdate">
						<span ng-bind="spiel.MatchDateTime | date:'dd.MM.yyyy, HH:mm' : '+0000'"></span>
					</div>
					<div class="pokal-teams">
						<div class="hidden-xs team1" ng-bind="spiel.Team1"></div>
						<div class="pokal-logo-container">
							<img class="team-logo" ng-src="{{spiel.Team1Icon}}" />
							<span> vs. </span>
							<img class="team-logo" ng-src="{{spiel.Team2Icon}}" />
						</div>
						<div class="hidden-xs team2" ng-bind="spiel.Team2"></div>
					</div>
					<div class="spiele-pokal-teams-pts">
						<span ng-bind="spiel.PointsTeam1+ ' : ' +spiel.PointsTeam2"></span>
						<span ng-bind="'('+spiel.HtPointsTeam1 +':'+spiel.HtPointsTeam2+')'"></span>
					</div>
					<?php if(isset($_SESSION['login']) && $_SESSION['login']):?>
						<span class="spiele_b2_tipps">
							<input type="number" ng-hide="spiel.disabled || spiel.notallowed" class="spiel_p" name="{{spiel.MatchID}}_1" min="0" value="{{spiel.Tipp1}}"/>		
							<span ng-show="spiel.disabled" ng-bind="spiel.Tipp1"></span>
							<span> : </span>
							<span ng-show="spiel.disabled" ng-bind="spiel.Tipp2"></span>
							<input type="number" class="spiel_p" name="{{spiel.MatchID}}_2" ng-hide="spiel.disabled || spiel.notallowed" min="0" value="{{spiel.Tipp2}}"/>
						</span>
						
					<?php endif;?>
				</div>
				<?php if((isset($_SESSION['login']) && $_SESSION['login']) && $_SESSION['pokal'] == 1):?><div id="tippSuccess" class="alert alert-success" role="alert">Deine Tipps wurden gespeichert!</div><div id="tippFail" class="alert alert-danger" role="alert">Deine Tipps konnten nicht gespeichert werden!</div><button class="form-control btn-primary" type="submit" name="pokalsubmit">Tippen</button><?php endif;?>
			</div>
		</div>
		<div class="row pokal-matchups-container">
			<div class="col-xs-12" ng-cloak>
				<div class="matchup_bl2_container">
					<span class="matchup_b_heading">Tipper Pokal-Matches: <span ng-bind="spieltage_pokal[selectedPokal.value-1].text"></span></span>		
				</div>
				<div class="match-item" ng-repeat="match in pokalt" ng-show="match.Akt" ng-cloak>

					<div class="match-inner">
						<div class="matchup-teams">
							<a href="#" ng-click="openTeamModal(match.Tipper1ID, 0)" ng-bind="match.Team1"></a>
							<span> vs. </span>
							<a href="#" ng-click="openTeamModal(match.Tipper2ID, 0)" ng-bind="match.Team2"></a>
						</div>
						<div class="matchup-points">
							<span ng-bind="match.PointsT1"></span>
							<span> : </span>
							<span ng-bind="match.PointsT2"></span>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>