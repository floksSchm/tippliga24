<section class="liga">
	<div class="container-fluid liga-wrapper">
		<div class="row liga-select-container">
			<div class="form-group col-xs-12 col-sm-6">
				<span id="spieltag-label">Spieltag</span>
				<select id="spieltag-select" class="form-control" ng-change="getSpieltag()" ng-options="item for item in spieltage_liga track by item" ng-model="selectedItem">
				</select>
				
			</div>
			<div class="form-group col-xs-12 col-sm-6">
				<span id="liga-label">Liga</span>
				<select id="liga-select" class="form-control" ng-change="getSpieltag()" ng-options="liga.text for liga in ligen track by liga.value" ng-model="ligaItemSelected">
				</select>
				
			</div>
			
		</div>
		<div class="row liga-tbl-container">
			<div class="liga-tbl-header col-xs-12">
				<span>Tipp-Tabelle</span>
				<p>Aktueller Spieltag: <small ng-bind="spieltag_liga"></small></p>
			</div>
			<div class="col-xs-12">
				<table class="table liga-table">
					<thead>
						<th class="hidden-xs">Platz</th>
						<th class="hidden-xs">Team</th>
						<th class="hidden-xs" ng-show="ligaItemSelected.value != 11">Tore/Gegentore</th>
						<th class="hidden-xs" ng-show="ligaItemSelected.value == 11">Tore</th>
						<th class="hidden-xs">Dreier</th>
						<th class="hidden-xs">Einser</th>
						<th class="hidden-xs" ng-show="ligaItemSelected.value != 11">Punkte</th>
						<th class="visible-xs-table-block">#</th>
						<th class="visible-xs-table-block">Team</th>
						<th class="visible-xs-table-block" ng-show="ligaItemSelected.value != 11">T/G</th>
						<th class="visible-xs-table-block" ng-show="ligaItemSelected.value == 11">Tore</th>
						<th class="visible-xs-table-block" ng-show="ligaItemSelected.value != 11">Pkt</th>
					</thead>
					<tbody>
						<tr ng-repeat="tablerow in tabelleliga" ng-show="tablerow.Akt" ng-if="tablerow.Aktl" ng-class="tablerow.bottomLiga == 1 ? 'bg-danger' : (tablerow.topLiga == 1 ? 'bg-info' : '')">
							<td ng-bind="tablerow.platz != '' ? tablerow.platz+'.' : tablerow.platz"></td>
							<td><a href="#" ng-click="openTeamModal(tablerow.benutzer_id, tablerow.Self)" ng-bind="tablerow.team"></a></td>
							<td ng-bind="tablerow.tore + (tablerow.quali == 0 ? ' / '+tablerow.gegentore : '')" class="hidden-xs"></td>
							<td ng-bind="tablerow.dreier" class="hidden-xs"></td>
							<td ng-bind="tablerow.einser" class="hidden-xs"></td>
							<td class="visible-xs-table-block" ng-bind="tablerow.tore + (tablerow.quali == 0 ? ' / '+tablerow.gegentore : '')"></td>
							<td ng-bind="tablerow.punkte" ng-show="ligaItemSelected.value != 11" class="font-bold"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row liga-spiele-container">
			<div class="col-xs-12 liga-spiele">
				<div class="tipp-header">
					<span class="tipp-buli-heading">Bundesliga</span>
					<?php if(isset($_SESSION['login']) && $_SESSION['login']):?>
						<span class="tipp-header-inner">Deine Tipps</span>
					<?php endif;?>
				</div>
				<div class="clearfix"></div>
				<div class="spiel-item" ng-repeat="spiel in spieleb" ng-show="spiel.Akt" ng-cloak>
					<div class="matchdate hidden-xs">
						<span ng-bind="spiel.MatchDateTime | date:'dd.MM.yyyy, HH:mm' : '+0000'"></span>
					</div>
					<div class="spiele-teams">
						<div ng-bind="spiel.Team1" class="hidden-xs team1"></div>
						<div class="liga-logo-container">
							<img class="team-logo" ng-src="{{spiel.Team1Icon}}" />
							<span> vs. </span>
							<img class="team-logo" ng-src="{{spiel.Team2Icon}}" />
						</div>
						
						<div ng-bind="spiel.Team2" class="hidden-xs team2"></div>
					</div>
					<?php if(isset($_SESSION['login']) && $_SESSION['login']):?>
						<div class="spiele-teams-pts">
							<span ng-bind="spiel.PointsTeam1 +' : '+spiel.PointsTeam2"></span>
							<span ng-bind="'('+spiel.HtPointsTeam1 +' : '+spiel.HtPointsTeam2+')'"></span>
						</div>
					<?php else :?>
						<div class="spiele-teams-pts not-logged-in">
							<span ng-bind="spiel.PointsTeam1 +' : '+spiel.PointsTeam2"></span>
							<span ng-bind="'('+spiel.HtPointsTeam1 +' : '+spiel.HtPointsTeam2+')'"></span>
						</div>
					<?php endif;?>
						
						<?php if(isset($_SESSION['login']) && $_SESSION['login']):?>
						<span class="tipp_b_container">
							<input type="number" ng-hide="spiel.disabled" class="spiel_b" name="{{spiel.MatchID}}_1" min="0" value="{{spiel.Tipp1}}"/>		
							<span ng-show="{{spiel.disabled}}" ng-bind="spiel.Tipp1" class="tipp_b"></span>
							<span> : </span>
							<input type="number" class="spiel_b" name="{{spiel.MatchID}}_2" ng-hide="spiel.disabled" min="0" value="{{spiel.Tipp2}}"/>
							<span ng-show="{{spiel.disabled}}" ng-bind="spiel.Tipp2" class="tipp_b"></span>
						</span>
						<?php endif;?>
				</div>
				<?php if(isset($_SESSION['login']) && $_SESSION['login']):?><div id="tippSuccess" class="alert alert-success" role="alert">Deine Tipps wurden gespeichert!</div><div id="tippFail" class="alert alert-danger" role="alert">Deine Tipps konnten nicht gespeichert werden!</div><button class="form-control btn-primary" type="submit" name="tippsubmit">Tippen</button><?php endif;?>
			</div>
		</div>
		<div class="row liga-matchup-container" ng-show="ligaItemSelected.value != 11">
			<div class="col-xs-12" id="matchups" ng-cloak>
				<div class="matchup_b_container">
					<span class="matchup_b_heading">Tipper Matches: {{ selectedItem }}.Spieltag</span>
					
				</div>
				<div class="match-item" ng-repeat="match in spielet" ng-show="match.Akt" ng-if="match.Aktl" ng-cloak>
					<div  class="match-inner">
						<div class="matchup-teams">
							<span class="match-team1" ng-bind="match.Team1"></span>
							<span> vs. </span>
							<span class="match-team2" ng-bind="match.Team2"></span>
						</div>
						<div class="matchup-points">
							<span class="match-p1" ng-bind="match.PointsT1"></span>
							<span> : </span>
							<span class="match-p2" ng-bind="match.PointsT2"></span>
						</div>
							
					</div>
				</div>
			</div>
		</div>
	</div>
</section>