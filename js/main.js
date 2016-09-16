$(document).ready(function(){
	/************* ALLGEMEINE FUNKTIONEN *******************/
	function encode_utf8(s) {
	  return unescape(encodeURIComponent(s));
	}

	function decode_utf8(s) {
	  return decodeURIComponent(escape(s));
	}

	/******** TIPPEN POKAL & LIGA *****************/

	$(document).on('click', "button[name='pokalsubmit']", function(e){
		var inputs = $('.pokal-spiele').find('input.spiel_p');
		var dat = JSON.stringify(inputs.serializeArray());
		var target = '/include/writedata/tipps_pokal.php';

		$.ajax({ 
		    type: "POST", 
		    url: target, 
		    dataType: 'json',
		    data: dat
		}).success(function(data) {
			$('#tippSuccess').show();
			$('#tippFail').hide();
			
		}).fail(function(data){
			$('#tippFail').show();
			$('#tippSuccess').hide();
		});
		
	});

	$(document).on('click', "button[name='tippsubmit']", function(e){
		var inputs = $('.liga-spiele').find('input.spiel_b');
		var dat = JSON.stringify(inputs.serializeArray());
		var target = '/include/writedata/tipps_buli.php';

		$.ajax({ 
		    type: "POST", 
		    url: target, 
		    dataType: 'json',
		    data: dat
		}).success(function(data) {
			$('#tippSuccess').show();
			$('#tippFail').hide();
			
		}).fail(function(data){
			$('#tippFail').show();
			$('#tippSuccess').hide();
			
		});
		
	});

	if($('.masonry-container').length) {
		var $container = $('.masonry-container');
		$container.imagesLoaded( function () {
		    $container.masonry({
		      columnWidth: '.item',
		      itemSelector: '.item'
		    });
		  });

		
		$("a.fancybox_gal_item").fancybox({
			
		});
		

	}
	
	if($('.slick-slider').length) {
		$('.slick-slider').slick({
			dots: false,
			arrows: false,
			infinite: true,
			speed: 300,
			lazyLoad: 'progressive',
			autoplay: true,
  			autoplaySpeed: 5000,
	  		slidesToShow: 3,
	  		slidesToScroll: 1,
			centerMode: true,
			variableWidth: true
		});
	}
	
	
	if($('#loginFailTrigger').length) {
		$('#loginFail').modal();
	}
		

	/*********************************************************************
	**************************ADMIN PAGE ************************/
 
	$(document).on('hidden', "#userEdit-modal", function(){
		$("#userEdit-modal").removeData("userEdit-modal");
	});

	$(document).on('hidden', "#userActivate-modal", function(){
		$("#userActivate-modal").removeData("userActivate-modal");
	});

	$(document).on('click', "button[data-toggle=editModal]", function(e){

		var id = $(this).data("id");
		var vorname = $(this).data("vorname");
		var name = $(this).data("name");
		var email = $(this).data("email");
		var team = $(this).data("team");

		$('#userEdit-modal').find('input[name="id"]').val(id);
		$('#userEdit-modal').find('input[name="vorname"]').val(vorname);
		$('#userEdit-modal').find('input[name="name"]').val(name);
		$('#userEdit-modal').find('input[name="email"]').val(email);
		$('#userEdit-modal').find('p[name="team"]').text(team);

		$('#userEdit-modal').modal('show');

		return false;

	});

	$(document).on('click', '#editModalSubmit', function() {

		var udId = $('#userEdit-modal').find('input[name="id"]').val();
		var udVorname = $('#userEdit-modal').find('input[name="vorname"]').val();
		var udName = $('#userEdit-modal').find('input[name="name"]').val();
		var udEmail = $('#userEdit-modal').find('input[name="email"]').val();

		var target = '/tladmin/include/angular/customer_mysql_write.php';

		$.ajax({ 
		    type: "POST", 
		    url: target, 
		    data: {postId: udId, postVorname: udVorname, postName: udName, postEmail: udEmail}
		}).done(function(data) {
		  	if (data) {
		  		$('#userEdit-modal').find('#userSaveSuccess').toggle();
		  	} else {
		  		$('#userEdit-modal').find('#userSaveFail').toggle();
		  	}
		});
	});

	$('#userEdit-modal').on('hidden.bs.modal', function () {
		window.location.reload();
	});

	$('#userActivate-modal').on('hidden.bs.modal', function () {
		window.location.reload();
	});

	$(document).on('click', '#activateModalSubmit', function() {

    	var id = $('#userActivate-modal').find('input[name="activateID"]').val();
    	var aktiv = $('#userActivate-modal').find('input[name="activateAktiv"]').val();
    	var target = '/tladmin/include/angular/customer_mysql_write.php';
	 	$.ajax({ 
	        type: "POST", 
	        url: target, 
	        data: {activateId: id, activate: aktiv}
	    }).done(function(data) {
	      	if (data) {
	      		$('#userActivate-modal').find('#userActivateSuccess').toggle();
	      		$('#userActivate-modal').find('#activateModalSubmit').toggle();
	      		$('#userActivate-modal').find('#activateModalDeny').toggle();
	      		$('#userActivate-modal').find('#activateModalClose').toggle();
	      	} else {
	      		$('#userActivate-modal').find('#userActivateFail').toggle();
	      		$('#userActivate-modal').find('#activateModalSubmit').toggle();
	      		$('#userActivate-modal').find('#activateModalDeny').toggle();
	      		$('#userActivate-modal').find('#activateModalClose').toggle();
	      	}
	    });

    });

	$(document).on('click', '#insertDataSubmit', function() {
		var startSpieltag = $('#insertData-modal').find('input[name="startSpieltag"]').val();
		var anzahlSpieltag = $('#insertData-modal').find('input[name="anzahlSpieltag"]').val();
		var saisonJahr = $('#insertData-modal').find('input[name="saisonJahr"]').val();
		var ligaKuerzel = $('#insertData-modal').find('input[name="ligaKuerzel"]').val();
		var tblDaten = $('#insertData-modal').find('input[name="tblDaten"]').val();
		
		var target = '/tladmin/include/angular/insert_data.php';

		$.ajax({ 
		    type: "POST", 
		    url: target, 
		    data: {poststartSpieltag: startSpieltag, postanzahlSpieltag: anzahlSpieltag, postsaisonJahr: saisonJahr, postligaKuerzel: ligaKuerzel, posttblDaten: tblDaten}
		}).done(function(data) {
			if (data) {
		  		$('#insertData-modal').find('#insertDataSuccess').toggle();
		  		$('#datenInputForm').find('input[name="startSpieltag"]').val();
				$('#datenInputForm').find('input[name="anzahlSpieltag"]').val();
				$('#datenInputForm').find('input[name="saisonJahr"]').val();
				$('#datenInputForm').find('input[name="ligaKuerzel"]').val();
				$('#datenInputForm').find('input[name="tblDaten"]').val();
		  		setTimeout(
					function() 
					{
						$('#insertData-modal').modal('hide');
					}, 2000);
		  		
		  	} else {
		  		$('#insertData-modal').find('#insertDataFail').toggle();
		  		setTimeout(
					function() 
					{
						$('#insertData-modal').modal('hide');
					}, 2000);
		  	}  	
		});
	});    

	$(document).on('click', '#matchupSubmit', function() {
		var ligaID = $('#matchup-modal').find('input[name="ligaid"]').val();
		var tblmatchup = $('#matchup-modal').find('input[name="tblmatchup"]').val();
		
		var target = '/tladmin/include/angular/create_matchups.php';

		$.ajax({ 
		    type: "POST", 
		    url: target, 
		    data: {ligaid: ligaID, tblmatchup: tblmatchup}
		}).done(function(data) {
			if (data) {
		  		$('#matchup-modal').find('#matchupSuccess').toggle();
		  	} else {
		  		$('#matchup-modal').find('#matchupFail').toggle();
		  	}  	
		});
	});

	$(document).on('click', '#pokalMatchupsSubmit', function() {
		var pokalid = $('#pokal-modal').find('input[name="pokalid"]').val();
		var pokalmatchup = $('#pokal-modal').find('input[name="pokalmatchup"]').val();
		
		var target = '/tladmin/include/angular/create_pokal_matchups.php';

		$.ajax({ 
		    type: "POST", 
		    url: target, 
		    data: {pokalid: pokalid, pokalmatchup: pokalmatchup}
		}).done(function(data) {
			if (data) {
		  		$('#pokal-modal').find('#pokalSuccess').toggle();
		  	} else {
		  		$('#pokal-modal').find('#pokalInsertFail').toggle();
		  	}  	
		});
	});

	$(document).on('click', '#userSubmit', function() {
		var vorname = $('#user-modal').find('input[name="vorname"]').val();
		var nachname = $('#user-modal').find('input[name="nachname"]').val();
		var email = $('#user-modal').find('input[name="email"]').val();
		var passwort = $('#user-modal').find('input[name="passwort"]').val();
		var team = $('#user-modal').find('input[name="team"]').val();
		var ligaid = $('#user-modal').find('input[name="ligaid"]').val();
		
		var target = '/tladmin/include/angular/insert_user.php';

		$.ajax({ 
		    type: "POST", 
		    url: target, 
		    data: {vorname: vorname, nachname: nachname, email: email, passwort: passwort, team: team, ligaid: ligaid}
		}).done(function(data) {
			if (data) {
		  		$('#user-modal').find('#userSuccess').toggle();
		  		setTimeout(
					function() 
					{
						$('#user-modal').modal('hide');
					}, 2000);
		  	} else {
		  		$('#user-modal').find('#userCreateFail').toggle();
		  	}  	
		});
	});

	/****************************************************************************
	*************************** MAIN PAGE ***************************************/
	/*console.log($('#profilModal').find('input[name="maxUploads"]').val());
	var maxUploads =  $('#profilModal').find('input[name="maxuploads"]').val();
	maxUploads = 5 - parseInt(maxUploads);
	Dropzone.options.myAwesomeDropzone = {
		acceptedFiles: '.jpg,.png,.gif',
		uploadMultiple : true,
		addRemoveLinks: true,
		autoProcessQueue: false,
		maxFiles: maxUploads
	};

	console.log(Dropzone.options.myAwesomeDropzone);*/
});

