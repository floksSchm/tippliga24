angular.module('tladmin', []).
	controller('customersCtrl', function($scope, $http) {
	$http.get("http://p272377.mittwaldserver.info/tladmin/include/angular/customer_mysql.php")
	.success(function (response) {
		$scope.user = response.customer;
	});
	$scope.userActivate = function(id, aktiv) {
		$('#userActivate-modal').find('input[name="activateID"]').val(id);
		$('#userActivate-modal').find('input[name="activateAktiv"]').val(aktiv);
		$('#userActivate-modal').modal('show');
	};
	$scope.insertData = function(startSpieltag, anzahlSpieltag, saisonJahr, ligaKuerzel, tblDaten) {
		if(this.startSpieltag != '' && this.anzahlSpieltag != '' && this.saisonJahr != '' && this.ligaKuerzel != '' && this.tblDaten != '') {
			$('#insertData-modal').find('input[name="startSpieltag"]').val(this.startSpieltag);
			$('#insertData-modal').find('input[name="anzahlSpieltag"]').val(this.anzahlSpieltag);
			$('#insertData-modal').find('input[name="saisonJahr"]').val(this.saisonJahr);
			$('#insertData-modal').find('input[name="ligaKuerzel"]').val(this.ligaKuerzel);
			$('#insertData-modal').find('input[name="tblDaten"]').val(this.tblDaten);
			$('#insertData-modal').modal('show');
		} else {
			$('#insertData-modal').find('#variablesFail').show();
		}
		
	};
	$scope.createMatchup = function(ligaID, tblmatchup) {
		if(this.ligaID != '' && this.tblmatchup != '') {
			$('#matchup-modal').find('input[name="ligaid"]').val(this.ligaID);
			$('#matchup-modal').find('input[name="tblmatchup"]').val(this.tblmatchup);
			$('#matchup-modal').modal('show');
		} else {
			$('#matchup-modal').find('#variablesFail').show();
		}
	};

	$scope.createUser = function(vorname,nachname,email,passwort,team,ligaid) {
		if(this.vorname != '' || this.nachname != '' || this.email != '' || this.passwort != '' || this.team != '' || this.ligaid != '') {
			$('#user-modal').find('input[name="vorname"]').val(this.vorname);
			$('#user-modal').find('input[name="nachname"]').val(this.nachname);
			$('#user-modal').find('input[name="email"]').val(this.email);
			$('#user-modal').find('input[name="passwort"]').val(this.passwort);
			$('#user-modal').find('input[name="team"]').val(this.team);
			$('#user-modal').find('input[name="ligaid"]').val(this.ligaid);
			$('#user-modal').modal('show');
		} else {
			$('#matchup-modal').find('#userFail').show();
		}
	};

	$scope.createPokalMatchup = function(pokalid, pokalmatchup) {
		if(this.pokalid != '' || this.pokalmatchup != '') {
			$('#pokal-modal').find('input[name="pokalid"]').val(this.pokalid);
			$('#pokal-modal').find('input[name="pokalmatchup"]').val(this.pokalmatchup);
			$('#pokal-modal').modal('show');
		} else {
			$('#pokal-modal').find('#pokalFail').show();
		}
	};
});