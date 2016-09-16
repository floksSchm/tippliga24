<div class="modal fade" id="tinyProfilModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Profil</h4>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-xs-12">
                    <section>
                        <img src="" alt="avatar" class="img-responsive team-logo">
                    </section>
                </div>
                <div class="col-xs-12">
                    <section>
                        <div class="panel panel-primary">
                            <div class="panel-heading"><i class="fa fa-user"></i> Team Infos  <span class="green-marked">{{oneteam.Team}}</span></div>
                            <table class="table table-striped">
                                <tbody ng-repeat="userDetails in user">
                                    <tr>
                                        <th>Trainer</th>
                                        <td>
                                            <span>{{oneteam.Vorname}} {{oneteam.Nachname}}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-ar btn-primary" ng-click="openProfilModal(oneteam.ID)">Ganzes Profil anzeigen</button>
            <button type="button" class="btn btn-ar btn-default" data-dismiss="modal">Schließen</button>
          </div>
        </div>
    </div>
</div>