<section class="teams">
	<div class="container-fluid" class="content">
		<div class="row page-search-wrapper">
			<div class="col-xs-12 page-search">
				<div class="form-group">
					<input id="team-search" type="text" class="form-control" ng-model="teamsearch" placeholder="Team suchen"><span class="glyphicon glyphicon-search"></span>
				</div>
			</div>
		</div>

		<div class="row teams-wrapper">
			<div class="col-xs-12">
				<table class="team-tbl">
					<thead>
						<!--th class="first" ng-click="sortTeams(2)">Liga</th>
						<th class="second" ng-click="sortTeams(0)">Team <span class="glyphicon glyphicon-chevron-down"></span><span class="glyphicon glyphicon-chevron-up"></span></th>
						<th class="third" ng-click="sortTeams(1)">Trainer <span class="glyphicon glyphicon-chevron-down"></span><span class="glyphicon glyphicon-chevron-up"></span></th-->
						<th class="first team-tbl-liga" >Liga</th>
						<th class="second team-tbl-team">Team </th>
						<th class="third team-tbl-trainer hidden-xs">Trainer </span></th>
					</thead>
					<tbody>
						<tr ng-repeat="team in teams | filter:teamsearch" class="team-tbl-row">
							<td class="first"><span ng-bind="team.LigaName" ng-show="team.nameShow"></span></td>
							<td class="second"><a href="#" ng-click="openTeamModal(team.ID, team.Self)" ng-bind="team.Team" class="team-tbl-link"></a></td>
							<td class="third hidden-xs" ng-bind="team.Vorname + ' ' +team.Nachname"></td>
						</tr>
					</tbody>			
				</table>
			</div>
		</div>		
	</div>
</section>