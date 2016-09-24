angular.module('tl', ['ngTable','ngCkeditor'])
	.run(function($rootScope,$http,$sce) {
	    $rootScope.test = new Date();
		$rootScope.editorOptions = {
		    language: 'de',
		    uiColor: '#000000'
		};
		$rootScope.passEditFail = false;
		$http.get("/include/getdata/user_details.php")
		.success(function (response) {
			$rootScope.user = response[0];
			
			if($rootScope.user!= undefined) {
				$rootScope.user.Beschreibung = $sce.trustAsHtml($rootScope.user.Beschreibung);
				$rootScope.cntPics = $rootScope.user.cntPics;
			}
			
			$rootScope.comments = response[1];
		});
		

		$rootScope.userSave = function(obj) {
			$rootScope.user.$profiledit = false;
			var target = '/include/writedata/user_details.php';
			var obj = $rootScope.user;
			$http.post(target,obj).
			  success(function(data, status, headers, config) {
			  	//$rootScope.user.Beschreibung = $sce.trustAsHtml($rootScope.user.Beschreibung);
			  	location.reload();
			  }).
			  error(function(data, status, headers, config) {
			  }).then(function(data){

			  });
			  
		}

		$rootScope.userEditPassword = function(passAlt, passNeu1, passNeu2) {
			if(passNeu1 != passNeu2) {
				$rootScope.passEditFail = true;
			}
			$rootScope.user.Beschreibung = $sce.trustAsHtml($rootScope.user.Beschreibung);

			var obj = {
				'passAlt':passAlt,
				'passNeu1':passNeu1,
				'passNeu2':passNeu2
			}
			$rootScope.user.$profiledit = false;
			var target = '/include/writedata/user_edit_pass.php';
			$http.post(target,obj).
			  success(function(data, status, headers, config) {

			  	//$rootScope.user.Beschreibung = $sce.trustAsHtml($rootScope.user.Beschreibung);
			  	location.reload();
			  }).
			  error(function(data, status, headers, config) {
			  }).then(function(data){
			  	$rootScope.passEditFail = true;
			  });
			  
		}

		

		$rootScope.openTeamModal = function(id, self) {
			if(self != 1) {
				var url = "/include/getdata/team.php?id="+id;
				$http.get(url)
				.success(function (response) {

					$rootScope.teamDetails = response[0];
					$rootScope.teamDetails.beschreibung = $sce.trustAsHtml($rootScope.teamDetails.beschreibung);
					$rootScope.teamComments = response[1];
					$('#teamModal').modal('show');
				});
			} else {
				$('#profilModal').modal('show');
			}
		}

		

		

		$rootScope.sortTeams = function(key) {
			if(key == 0) {
				if($rootScope.sortTeamsVar == 1) {
					//SORT ASC
					var length = $rootScope.teams.length;
					$rootScope.teams.sort(function(a,b){
						var textA = a.Team.toUpperCase();
					    var textB = b.Team.toUpperCase();
					    return (textA < textB) ? -1 : (textA > textB) ? 1 : 0;
					});
					for(var i =  0; i < length; i++) {
						if($rootScope.teams[i].LigaName) {
							$rootScope.teams[i].nameShow = 0;
						}
					}
					$rootScope.sortTeamsVar = 0;
				} else {
					//SORT DESC
					var length = $rootScope.teams.length;
					$rootScope.teams.sort(function(a,b){
						var textA = a.Team.toUpperCase();
					    var textB = b.Team.toUpperCase();
					    return (textA > textB) ? -1 : (textA < textB) ? 1 : 0;
					});
					for(var i =  0; i < length; i++) {
						if($rootScope.teams[i].LigaName && $rootScope.teams[i].nameShow == 1) {
							$rootScope.teams[i].nameShow = 0;
						}
					}
					$rootScope.sortTeamsVar = 1;
				}
			} else if(key == 1) {
				if($rootScope.sortTeamsTVar == 1) {
					//SORT ASC
					var length = $rootScope.teams.length;
					$rootScope.teams.sort(function(a,b){
						var textA = a.Nachname.toUpperCase();
					    var textB = b.Nachname.toUpperCase();
					    return (textA < textB) ? -1 : (textA > textB) ? 1 : 0;
					});
					for(var i =  0; i < length; i++) {
						if($rootScope.teams[i].LigaName) {
							$rootScope.teams[i].nameShow = 0;
						}
					}
					$rootScope.sortTeamsTVar = 0;
				} else {
					//SORT DESC
					var length = $rootScope.teams.length;
					$rootScope.teams.sort(function(a,b){
						var textA = a.Nachname.toUpperCase();
					    var textB = b.Nachname.toUpperCase();
					    return (textA > textB) ? -1 : (textA < textB) ? 1 : 0;
					});
					for(var i =  0; i < length; i++) {
						if($rootScope.teams[i].LigaName && $rootScope.teams[i].nameShow == 1) {
							$rootScope.teams[i].nameShow = 0;
						}
					}
					$rootScope.sortTeamsTVar = 1;
				}
			} else if(key == 2) {
				var length = $rootScope.teams.length;
				for(var i =  0; i < length; i++) {
					if($rootScope.teams[i].LigaName) {
						$rootScope.teams[i].nameShow = 1;
					}
				}
				$rootScope.teams.sort(function(a,b){
					return parseFloat(b.nameShow) - parseFloat(a.nameShow);
				});
				$rootScope.teams.sort(function(a,b){
					return parseFloat(a.LigaID) - parseFloat(b.LigaID);
				});
				$rootScope.sortTeamsTVar = 1;
				$rootScope.sortTeamsVar = 1;
			}
		}
	})
	.controller('teamCtrl', function($scope, $http, $rootScope, $sce) {
		$http.get("/include/getdata/all_teams.php")
		.success(function (response) {
			$scope.teams = response;
			var lengthteams = $scope.teams.length;
			var liga = 0;
			for(var x = 0; x < lengthteams; x++) {
				if($scope.teams[x].LigaID != liga) {
					liga = $scope.teams[x].LigaID;
					$scope.teams[x].nameShow = 1;
					switch(liga) {
						case '1':
							$scope.teams[x].LigaName = 'Premiere League';
							break;
						case '2':
							$scope.teams[x].LigaName = 'Liga 2A';
							break;
						case '3':
							$scope.teams[x].LigaName = 'Liga 2B';
							break;
					}
					
				}
			}
			$scope.sortTeamsVar = 1;
			$scope.sortTeamsTVar = 1;
		});
	})
		
	.controller('ligaCtrl', function($scope, $http, $rootScope, $sce) {
		
		$http.get("/include/getdata/spieltag.php")
			.success(function (response) {
				$scope.spieltag_liga = response[0].Spieltag;
				$scope.selectedItem  = response[0].Spieltag;
				$scope.ligaItem  = response[0].Liga ? response[0].Liga : 1;
				$scope.spieltage_liga = [1,2,3,4,5,6,7,8,9];
				$scope.ligen = [{"value": 1, "text": "Premiere League"},{"value": 2, "text": "Liga 2A"},{"value": 11, "text": "Qualiliga"}];
				$scope.ligaItemSelected = response[0].Liga ? {"value": response[0].Liga} : {"value": 1};
			}).then(function(){
				$http.get('/include/getdata/liga/reload_spiele_buli.php').
				then(function() {
					$http.get("/include/getdata/liga/spiele_buli.php")
					.success(function (response) {
						$scope.spieleb = response;
						$scope.spieleb.forEach(function(element, index, array){  
						    if(element.Spieltag ==  $scope.spieltag_liga) {
						    	element.Akt = 1;
						    } else {
						    	element.Akt = 0;
						    }
						});
					}).then(function() {
						$http.get('/include/getdata/liga/reload_spiele_tipper.php').
						then(function(){
							$http.get("/include/getdata/liga/spiele_tipper.php")
							.success(function (response) {
								$scope.spielet = response;
								$scope.spielet.forEach(function(match, index, array){  
								    if(match.Spieltag ==  $scope.spieltag_liga) {
								    	match.Akt = 1;
								    } else {
								    	match.Akt = 0;
								    }
								    if(match.LigaID ==  $scope.ligaItem) {
								    	match.Aktl = 1;
								    } else {
								    	match.Aktl = 0;
								    }

								});
								}).then(function() {
								$http.get('/include/getdata/liga/reload_buli_tabelle.php').
								then(function(){
									$http.get("/include/getdata/liga/buli_tabelle.php")
									.success(function (response) {
										$scope.tabelleliga = response;
										var pointsbefore;
										var goalsbefore;
										var agoalsbefore;
										var platzbefore;
										var liga;
										var spieltag;
										//var beforeAddTop = 0;
										//var beforeAddBottom = 0;
										var row;

										$scope.tabelleliga.forEach(function(element, index, array){  
										    if(element.spieltag ==  $scope.spieltag_liga) {
										    	element.Akt = 1;
										    } else {
										    	element.Akt = 0;
										    }
										    if(element.ligaID ==  $scope.ligaItem) {
										    	element.Aktl = 1;
										    } else {
										    	element.Aktl = 0;
										    }
										    if(liga == 'undefined' || liga != element.ligaID || spieltag != element.spieltag) {
										    	row = 1;
										    	liga = element.ligaID;
										    	spieltag = element.spieltag;
										    	pointsbefore = element.punkte;
												goalsbefore = element.tore;
												agoalsbefore = element.gegentore;
												element.platz = 1;
												platzbefore = 1;
										    } else if(liga == element.ligaID) {
										    	if(pointsbefore == element.punkte && goalsbefore == element.tore && agoalsbefore == element.gegentore) {
										    		element.platz = '';
										    		platzbefore = ++platzbefore
										    	} else {
										    		element.platz = ++platzbefore;
										    		platzbefore = element.platz;
										    	}
										    	pointsbefore = element.punkte;
												goalsbefore = element.tore;
												agoalsbefore = element.gegentore;

										    }
										    
										    element.topLiga = 0;
										    element.bottomLiga = 0;
										    
										    if(element.ligaID == "1") {
									    		switch(row) {
									    			case 1:
									    				element.topLiga = 1;
									    				break;
											    	case 5:
											    	case 6:
											    	case 7:
											    	case 8:
											    	case 9:
											    	case 10:
											    		element.bottomLiga = 1;
											    		
											    		break;
											    
											    }
										    		
										    	
										    	
										    }
										    if(element.ligaID == "2") {
										    	switch(row) {
											    	case 1:
											    	case 2:
											    	case 3:
											    		element.topLiga = 1;
											    		
											    		break;
											    	
											    	case 5:
											    	case 6:
											    	case 7:
											    	case 8:
											    	case 9:
											    	case 10:
											    		element.bottomLiga = 1;
											    		
											    		break;
											    }
										    }
										    if(element.ligaID == "3") {
										    	switch(row) {
											    	case 1:
											    	case 2:
											    	case 3:
											    	case 4:
											    		element.topLiga = 1;
											    		
											    		break;
											    	
											    	case 7:
											    	case 8:
											    	case 9:
											    	case 10:
											    		element.bottomLiga = 1;
											    		
											    		break;
											    }
										    }
										    if(element.ligaID == "4") {
										    	switch(row) {
											    	case 1:
											    	case 2:
											    	case 3:
											    		element.topLiga = 1;
											    		
											    		break;
											    	
											    }
										    }
										    row++;
										  
										    
										});
									});
								});
							});
						});
					});
				});
			});

		$scope.getSpieltag = function() {		
			$scope.spieleb.forEach(function(element, index, array){  
			    if(element.Spieltag ==  $scope.selectedItem) {
			    	element.Akt = 1;
			    } else {
			    	element.Akt = 0;
			    }
			});
			$scope.spielet.forEach(function(match, index, array){  
			    if(match.Spieltag ==  $scope.selectedItem) {
			    	match.Akt = 1;
			    } else {
			    	match.Akt = 0;
			    }

			    if(match.LigaID ==  $scope.ligaItemSelected.value) {
			    	match.Aktl = 1;
			    } else {
			    	match.Aktl = 0;
			    }
			   
			});

			$scope.tabelleliga.forEach(function(row, index, array){  

			    if(row.spieltag ==  $scope.selectedItem && $scope.spieltag_liga >= $scope.selectedItem) {
			    	row.Akt = 1;
			    } else if(row.spieltag ==  $scope.spieltag_liga && $scope.spieltag_liga < $scope.selectedItem) {
			    	row.Akt = 1;
			    } else {
			    	row.Akt = 0;
			    }

			    if(row.ligaID == $scope.ligaItemSelected.value) {
			    	row.Aktl = 1;
			    } else {
			    	row.Aktl = 0;
			    }
			});
			
		}

		
		
	})
	
	.controller('tippschuetzeCtrl', function($scope, $http, $rootScope, $sce) {
		$scope.selectedTippschuetzeTbl = '1';
		$http.get("/include/getdata/tippschuetze.php")
		.success(function (response) {
			$scope.tippschuetze = response;
			var length = $scope.tippschuetze.length;
			$scope.tippschuetze.sort(function(a, b) {
			    return parseFloat(b.tore_akt) - parseFloat(a.tore_akt);
			});
			var n = 1;
			var before = null;
			for(var i =  0; i < length; i++) {
				if(before != null && before == $scope.tippschuetze[i].tore_akt) {
					//$scope.tippschuetze[i].platz = n;
					$scope.tippschuetze[i].platz = '';
				} else if(before != null && before != $scope.tippschuetze[i].tore_akt) {
					$scope.tippschuetze[i].platz = ++n;
				} else {
					$scope.tippschuetze[i].platz = n;
				}		
				before = $scope.tippschuetze[i].tore_akt;
			}
			$scope.sortToreAType = 1;
			$scope.sortToreGType = 1;
		});

		$scope.getTippschuetzeTbl = function() {
			if($scope.selectedTippschuetzeTbl == '1') {

				//SORT DESC
				var length = $scope.tippschuetze.length;
				$scope.tippschuetze.sort(function(a, b) {
					a.platz = '';
					b.platz = '';
				    return parseFloat(b.tore_akt) - parseFloat(a.tore_akt);
				});
				var n = 1;
				var before = null;
				for(var i =  0; i < length; i++) {
					if(before != null & before == $scope.tippschuetze[i].tore_akt) {
						//$rootScope.tippschuetze[i].platz = n;
					} else if(before != null & before != $scope.tippschuetze[i].tore_akt) {
						$scope.tippschuetze[i].platz = ++n;
					} else {
						$scope.tippschuetze[i].platz = n;
					}		
					before = $scope.tippschuetze[i].tore_akt;
				}

			} else {
				//SORT DESC
				var length = $scope.tippschuetze.length;
				$scope.tippschuetze.sort(function(a, b) {
					a.platz = '';
					b.platz = '';
				    return parseFloat(b.tore_ges) - parseFloat(a.tore_ges);
				});
				var n = 1;
				var before = null;
				for(var i =  0; i < length; i++) {
					if(before != null & before == $scope.tippschuetze[i].tore_ges) {
						//$rootScope.tippschuetze[i].platz = n;
					} else if(before != null & before != $scope.tippschuetze[i].tore_ges) {
						$scope.tippschuetze[i].platz = ++n;
					} else {
						$scope.tippschuetze[i].platz = n;
					}		
					before = $scope.tippschuetze[i].tore_ges;
				}
				
			}

			$('.tippschuetze-akt-tbl').toggle();
			$('.tippschuetze-ewig-tbl').toggle();
			$('#tbl-akt').toggle();
			$('#tbl-ewig').toggle();

		}

		$scope.sortGoals = function(key) {
			if(key == 0) {
				if($scope.sortToreAType == 1) {
					//SORT ASC
					var length = $scope.tippschuetze.length;
					$scope.tippschuetze.sort(function(a, b) {
						a.platz = '';
						b.platz = '';
					    return parseFloat(a.tore_akt) - parseFloat(b.tore_akt);
					});
					var n = 1;
					var before = null;
					for(var i =  0; i < length; i++) {
						if(before != null & before == $scope.tippschuetze[i].tore_akt) {
							//$scope.tippschuetze[i].platz = n;
						} else if(before != null & before != $scope.tippschuetze[i].tore_akt) {
							$scope.tippschuetze[i].platz = ++n;
						} else {
							$scope.tippschuetze[i].platz = n;
						}		
						before = $scope.tippschuetze[i].tore_akt;
					}
					$scope.sortToreAType = 0;
				} else {
					//SORT DESC
					var length = $scope.tippschuetze.length;
					$scope.tippschuetze.sort(function(a, b) {
						a.platz = '';
						b.platz = '';
					    return parseFloat(b.tore_akt) - parseFloat(a.tore_akt);
					});
					var n = 1;
					var before = null;
					for(var i =  0; i < length; i++) {
						if(before != null & before == $scope.tippschuetze[i].tore_akt) {
							//$scope.tippschuetze[i].platz = n;
						} else if(before != null & before != $scope.tippschuetze[i].tore_akt) {
							$scope.tippschuetze[i].platz = ++n;
						} else {
							$scope.tippschuetze[i].platz = n;
						}		
						before = $scope.tippschuetze[i].tore_akt;
					}
					$scope.sortToreAType = 1;
				}
				$('.tippschuetze-akt-tbl .fa-arrow-down').toggle();
				$('.tippschuetze-akt-tbl .fa-arrow-up').toggle();
			} else if(key == 1) {
				if($scope.sortToreGType == 1) {
					//SORT ASC
					var length = $scope.tippschuetze.length;
					$scope.tippschuetze.sort(function(a, b) {
						a.platz = '';
						b.platz = '';
					    return parseFloat(a.tore_ges) - parseFloat(b.tore_ges);
					});
					var n = 1;
					var before = null;
					for(var i =  0; i < length; i++) {
						if(before != null & before == $scope.tippschuetze[i].tore_ges) {
							//$scope.tippschuetze[i].platz = n;
						} else if(before != null & before != $scope.tippschuetze[i].tore_ges) {
							$scope.tippschuetze[i].platz = ++n;
						} else {
							$scope.tippschuetze[i].platz = n;
						}		
						before = $scope.tippschuetze[i].tore_ges;
					}
					$scope.sortToreGType = 0;
				} else {
					//SORT DESC
					var length = $scope.tippschuetze.length;
					$scope.tippschuetze.sort(function(a, b) {
						a.platz = '';
						b.platz = '';
					    return parseFloat(b.tore_ges) - parseFloat(a.tore_ges);
					});
					var n = 1;
					var before = null;
					for(var i =  0; i < length; i++) {
						if(before != null & before == $scope.tippschuetze[i].tore_ges) {
							//$scope.tippschuetze[i].platz = n;
						} else if(before != null & before != $scope.tippschuetze[i].tore_ges) {
							$scope.tippschuetze[i].platz = ++n;
						} else {
							$scope.tippschuetze[i].platz = n;
						}		
						before = $scope.tippschuetze[i].tore_ges;
					}
					$scope.sortToreGType = 1;
				}
				$('.tippschuetze-ewig-tbl .fa-arrow-down').toggle();
				$('.tippschuetze-ewig-tbl .fa-arrow-up').toggle();
			}

		}
	})
	.controller('pokalCtrl', function($scope, $http, $rootScope, $sce) {
		$http.get("/include/getdata/spieltag.php")
			.success(function (response) {
				$scope.spieltag_pokal = response[1].Spieltag;
				$scope.selectedPokal =  response[1].Spieltag ? {"value": response[1].Spieltag} : {"value": 1};;
				$scope.spieltage_pokal = [];
				var spieltage_pokal_data = [{"value": 1, "text": "1. Runde"},{"value": 2, "text": "2. Runde"},{"value": 3, "text": "Achtelfinale"},{"value": 4, "text": "Viertelfinale"},{"value": 5, "text": "Halbfinale"},{"value": 6, "text": "Finale"}];
				var length = parseInt(response[1].Spieltag);
				for(var n = 0; n  < length; n++) {
					$scope.spieltage_pokal.push(spieltage_pokal_data[n]);
				}
			}).then(function(){
				$http.get('/include/getdata/pokal/reload_spiele_pokal.php').
				then(function() {
					$http.get("/include/getdata/pokal/spiele_pokal.php")
					.success(function (response) {
						$scope.spielepokal = response;
						$scope.spielepokal.forEach(function(element, index, array){  
						    if(element.Spieltag ==  $scope.spieltag_pokal) {
						    	element.Akt = 1;
						    } else {
						    	element.Akt = 0;
						    }
						});
					}).then(function(){
						$http.get("/include/getdata/pokal/reload_spiele_tipper.php")
						.then(function(){
							$http.get("/include/getdata/pokal/spiele_tipper.php")
							.success(function (response) {
								$scope.pokalt = response;
								$scope.pokalt.forEach(function(match, index, array){  
								    if(match.Spieltag ==  $scope.spieltag_pokal) {
								    	match.Akt = 1;
								    } else {
								    	match.Akt = 0;
								    }
								});
							});
						});
					});
				});
			});

		$scope.getPokal = function() {
			$scope.spielepokal.forEach(function(element, index, array){  
			    if(element.Spieltag ==  $scope.selectedPokal.value) {
			    	element.Akt = 1;
			    } else {
			    	element.Akt = 0;
			    }
			});
			$scope.pokalt.forEach(function(match, index, array){  
			    if(match.Spieltag ==  $scope.selectedPokal.value) {
			    	match.Akt = 1;
			    } else {
			    	match.Akt = 0;
			    }
			});
		}
		
	})
	.filter('unsafe', function($sce) { 
		return $sce.trustAsHtml; 
	});


