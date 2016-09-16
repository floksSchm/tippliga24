<section class="tippschuetze">
	<div class="container-fluid tippschuetze-wrapper" >
		<div class="row">
			<div class="col-xs-12">
				<div class="form-group">
					<input id="tippschuetze-search" type="text" class="form-control" ng-model="tippschuetzesearch" placeholder="Tipper suchen"><span class="glyphicon glyphicon-search"></span>
				</div>	
				<div class="form-group">
					<label for="tippschuetze_select_tbl">Tabelle wählen</label>
					<select id="tippschuetze_select_tbl" name="tippschuetze_select_tbl" ng-change="getTippschuetzeTbl()" ng-model="selectedTippschuetzeTbl" class="form-control">
						<option value="1" selected="selected">Aktuelle Saison</option>
						<option value="2">Ewige Tabelle</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="header_tippschuetze">
					<span id="tbl-akt">Aktuelle Saison</span>
					<span id="tbl-ewig">Ewige Tabelle</span>
				</div>
				<table class="table table-striped tippschuetze-akt-tbl">
					<thead>
						<th class="visible-xs-table-block">#</th>
						<th class="hidden-xs">Platz</th>
						<th class="hidden-xs">Spieler</th>
						<th>Team</th>
						<th ng-click="sortGoals(0)" class="hidden-xs th_sortable"><i class="fa fa-arrow-up" aria-hidden="true"></i> <i class="fa fa-arrow-down" aria-hidden="true"></i> Tore</th>
						<th class="hidden-xs">Gegentore</th>
						<th class="hidden-xs">Dreier</th>
						<th class="hidden-xs">Einser</th>
						<th ng-click="sortGoals(0)" class="visible-xs-table-block th_sortable"><i class="fa fa-arrow-up" aria-hidden="true"></i> <i class="fa fa-arrow-down" aria-hidden="true"></i> <i class="fa fa-futbol-o" aria-hidden="true"></i></th>
					</thead>
					<tbody>
						<tr ng-repeat="tablerow in tippschuetze | filter:tippschuetzesearch">
							<td ng-bind="tablerow.platz != '' ? tablerow.platz+'.' : tablerow.platz"></td>
							<td ng-bind="tablerow.spieler" class="hidden-xs"></td>
							<td><a href="#" ng-click="openTeamModal(tablerow.id, 0)" ng-bind="tablerow.team"></a></td>
							<td ng-bind="tablerow.tore_akt"></td>
							<td ng-bind="tablerow.gegentore_akt" class="hidden-xs"></td>
							<td ng-bind="tablerow.dreier_akt" class="hidden-xs"></td>
							<td ng-bind="tablerow.einser_akt" class="hidden-xs"></td>
						</tr>
					</tbody>
				</table>

				<table class="table table-striped tippschuetze-ewig-tbl">
					<thead>
						<th class="visible-xs-table-block">#</th>
						<th class="hidden-xs">Platz</th>
						<th class="hidden-xs">Spieler</th>
						<th>Team</th>
						<th ng-click="sortGoals(1)" class="hidden-xs th_sortable"><i class="fa fa-arrow-up" aria-hidden="true"></i> <i class="fa fa-arrow-down" aria-hidden="true"></i>Tore</th>
						<th class="hidden-xs">Gegentore</th>
						<th class="hidden-xs">Dreier</th>
						<th class="hidden-xs">Einser</th>
						<th ng-click="sortGoals(1)" class="visible-xs-table-block th_sortable"><i class="fa fa-arrow-up" aria-hidden="true"></i> <i class="fa fa-arrow-down" aria-hidden="true"></i> <i class="fa fa-futbol-o" aria-hidden="true"></i></th>
					</thead>
					<tbody>
						<tr ng-repeat="tablerow in tippschuetze | filter:tippschuetzesearch">
							<td ng-bind="tablerow.platz"></td>
							<td ng-bind="tablerow.spieler" class="hidden-xs"></td>
							<td><a href="#" ng-click="openTeamModal(tablerow.id, 0)" ng-bind="tablerow.team"></a></td>
							<td ng-bind="tablerow.tore_ges"></td>
							<td ng-bind="tablerow.gegentore_ges" class="hidden-xs"></td>
							<td ng-bind="tablerow.dreier_ges" class="hidden-xs"></td>
							<td ng-bind="tablerow.einser_ges" class="hidden-xs"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>