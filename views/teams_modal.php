<div class="modal fade" id="teamModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel" ng-bind="teamDetails.team"></h4>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <div class="team-logo-container">
                       
                        <img ng-if="!teamDetails.team_logo" src="../include/uploads/teams/placeholder.jpg" alt="avatar" class="img-responsive thumbnail team-logo">

                        <img ng-if="teamDetails.team_logo" src="../include/uploads/teams/{{teamDetails.id}}/{{teamDetails.team_logo}}" alt="avatar" class="img-responsive thumbnail team-logo">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-9">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><i class="fa fa-user"></i> Team Infos</div>
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <th>Liga</th>
                                    <td>
                                        <span ng-bind="teamDetails.liga_name"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Spieler</th>
                                    <td>
                                        <span ng-bind="teamDetails.spieler"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Trainer</th>
                                    <td><span ng-bind="teamDetails.vorname+' '+teamDetails.nachname"></span></td>
                                </tr>
                                <tr>
                                    <th>Stadion</th>
                                    <td>
                                        <span ng-bind="teamDetails.stadion"></span>
                                    </td>
                                </tr>
                               
                            </tbody>
                            </table>
                        </div>
                        

                   <?php /*<section>
                        <h3 class="section-title">Kommentare</h3>
                        <div class="list-group" ng-repeat="comments in teamComments">
                            <a href="#" class="list-group-item">
                                <h4 ng-bind="comments.Header"></h4>
                                <p ng-bind="comments.Comment"></p>
                            </a>
                        </div> <!--list-group -->
                    </section> */?>
                </div>
                <div class="col-xs-12 team-description">
                     <label for="team-desc-modal">Team Historie</label>
                     <div ng-bind-html="teamDetails.beschreibung">
                         
                     </div>
                </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-ar btn-default" data-dismiss="modal">Schließen</button>
          </div>
        </div>
    </div>
</div>