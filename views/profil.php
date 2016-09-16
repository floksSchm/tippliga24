<div class="modal fade" id="profilModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel"><span class="green-marked"><?php echo $_SESSION['team'];?></h4>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">

                    <div class="team-logo-container">
                        <div ng-if="!user.Teamlogo">
                             <img src="../include/uploads/teams/placeholder.jpg" alt="avatar" class="img-responsive thumbnail team-logo">
                        </div>
                       <div ng-if="user.Teamlogo">
                           <img src="../include/uploads/teams/<?php echo $_SESSION['id'];?>/{{user.Teamlogo}}" alt="avatar" class="img-responsive thumbnail team-logo">
                       </div>
                        
                    </div>
                   
                    
                </div>
                <div class="col-xs-12 col-sm-8 col-md-9">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><i class="fa fa-user"></i> Team Infos</span></div>
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <th>Liga</th>
                                    <td>
                                        <?php echo $_SESSION['liga_name'];?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Spieler</th>
                                    <td>
                                        <span ng-if="!user.$profiledit">{{user.Spieler}}</span>
                                        <div ng-if="user.$profiledit"><input class="form-control profil-edit-input" type="text" ng-model="user.Spieler" /></div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Trainer</th>
                                    <td><?php echo $_SESSION['vorname'].' '.$_SESSION['name'];?></td>
                                </tr>
                                <tr>
                                    <th>Stadion</th>
                                    <td>
                                        <span ng-if="!user.$profiledit">{{user.Stadion}}</span>
                                        <div ng-if="user.$profiledit"><input class="form-control profil-edit-input" type="text" ng-model="user.Stadion" /></div>
                                    </td>
                                </tr>

                                <tr>
                                    <th ng-if="user.$profiledit">Passwort ändern</th>
                                    <td ng-if="user.$profiledit">
                                        <input class="form-control pass-edit-input" type="password" ng-model="passwortAlt" placeholder="Altes Passwort"/>
                                        <input class="form-control pass-edit-input" type="password" ng-model="passwortNeu1" placeholder="Neues Passwort"/>
                                        <input class="form-control pass-edit-input" type="password" ng-model="passwortNeu2" placeholder="Passwort wiederholen"/>
                                        <a id="passwordSubmit" href="#" class="btn btn-ar btn-primary" ng-click="userEditPassword(passwortAlt,passwortNeu1,passwortNeu2)">Passwort ändern</a>
                                    </td>
                                    
                                </tr>
                                
                            </tbody></table>
                        </div>
                    <?php /*
                     <section>
                        <h3 class="section-title">Kommentare</h3>
                        <div class="list-group" ng-repeat="comment in comments">
                            <a href="#" class="list-group-item">
                                <h4 ng-bind="comment.Header"></h4>
                                <p ng-bind="comment.Comment"></p>
                            </a>
                        </div> <!--list-group -->
                    </section>*/
                    ?>
                </div>
                <div class="col-xs-12" ng-show="passEditFail">
                    <div class="bg-danger editPassFail">
                        <p>Beim Ändern des Passworts ist ein Fehler aufgetreten!</p>
                    </div>
                    
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label>Team Historie</label>
                        <div class="historie-container" ng-if="!user.$profiledit" ng-bind-html="user.Beschreibung"></div>
                        <div ng-if="user.$profiledit">
                            <textarea ckeditor="editorOptions" class="profil-edit-input" name="editor1" id="editor1" ng-model="user.Beschreibung" rows="10" cols="80" ></textarea>
                        </div>
                         
                        
                    </div>
                    
                </div>
                <div class="col-xs-12 team-logo-upload" ng-if="user.$profiledit">
                    <form action="../include/writedata/upload.php" class="form-inline" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Team-Logo auswählen</label>
                            <input type="file" class="file form-control" name="datei">
                            <p class="help-block">Nur folgende Dateiformate erlaubt: .jpg, .png, .gif (max. 500kB)</p>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="Hochladen">
                        </div>
                        
                    </form>
                </div>

            </div>
          </div>
          <div class="modal-footer">
            <a ng-if="!user.$profiledit" href="" class="btn btn-ar btn-primary" ng-click="user.$profiledit = true">Profil bearbeiten</a>
            <a id="profilSubmit" ng-if="user.$profiledit" href="" class="btn btn-ar btn-success" ng-click="userSave(user)">Änderungen speichern</a>
            <button type="button" class="btn btn-ar btn-default" data-dismiss="modal">Schließen</button>
          </div>
        </div>
    </div>
</div>