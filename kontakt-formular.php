<?php
ini_set('error_reporting', E_ALL ^ E_NOTICE);
$PFLICHTFELDER = "Pflichtfelder sind mit * gekennzeichnet und m&uuml;ssen ausgef&uuml;llt werden!";
$MAILTO = "floks.schmid@googlemail.com";
$ERRPFLICHT = "Bitte f&uuml;llen Sie alle Pflichtfelder aus!";
$ERREMAIL = "Ung&uuml;ltige E-Mail-Adresse!";
$TEXT = "";
$CC = "";
$BCC = "";
$MAILFROM = "#email#|".$MAILTO."|";
$BETREFF = "Tippliga24 - Kontakt";
$ANTWORT = "<p>Vielen Dank f&uuml;r Ihre Anfrage.<br />Wir setzen uns baldm&ouml;glichst mit Ihnen in Verbindung.</p>";
$VERSAND = "<p>Ihre Anfrage konnte leider nicht versendet werden!<br />Versuchen Sie es sp&auml;ter noch einmal oder nehmen Sie telefonisch Kontakt mit uns auf.<br />Vielen Dank f&uuml;r Ihr Verst&auml;ndnis.</p>";
$PFLICHTANZEIGE = "unten";

@session_start();
if($_REQUEST['formSended'] == "TRUE"){
	if(($_POST["youremail"] != "human@mail.com") || (!empty($_POST["yourcontact"]))) {
		$err_msg = "Achtung Bot - Verdacht";
    } else {
		$req = $_POST['req'];
		$req1 = $_POST['req1'];
		for($i = 0; $i < count($req); $i++){
			if(empty($_POST[$req[$i]])) {
				$err_msg .= "- ".str_replace(array(":", "*"),"", $req1[$i])."<br />";
				$errorClass[$req[$i]] = "has-error";
			} else {
				$errorClass[$req[$i]] = "";
			}
		}
		if(isset($err_msg)) {
			$err_msg = ($ERRPFLICHT)."<br />".$err_msg;	
		}
		if(isset($_POST['formEmail'])) {
			foreach($_POST['formEmail'] as $email){
				if(!preg_match("/^[a-z0-9\._-]+@+[a-z0-9\._-]+\.+[a-z]{2,4}$/", $_POST[$email]) && $_POST[$email] != "") {
					$err_msg .= "- ".($ERREMAIL)."<br />";	
					$errorClass[$email] = "has-error";
				}
			}
		}	
	}
	if(isset($err_msg)) {			
	} else {
	   $strpos1 = strpos($MAILFROM,"#");
		if($strpos1 === false){
			$mailfrom = substr($MAILFROM,0, strpos($MAILFROM,"|"));
		} else {
			if(preg_match('/^(#)([^#]*)(#)(\|)([^\|]*)(\|)$/',$MAILFROM)){
				$feld = preg_replace('/(#)([^#]*)(#)(\|)([^\|]*)(\|)/','$2',$MAILFROM);
				if(empty($_POST[$feld])){
					$mailfrom = preg_replace('/(#)([^#]*)(#)(\|)([^\|]*)(\|)/','$5',$MAILFROM);
				}else{
					$mailfrom =$_POST[$feld];
				}
			}
		}
		
		$strpos1 = strpos($MAILTO,"#");
		if($strpos1 === false){
			$mailto = $MAILTO;
		}else{
			 $feld = preg_replace('/([^#]*)(#)([^#]*)(#)([^#]*)/','$3',$MAILTO);
			 $mailto =preg_replace('/([^#]*)(#)([^#]*)(#)([^#]*)/',$_POST[$feld],$MAILTO);
		}
		
		$strpos1 = strpos($CC,"#");
		if($strpos1 === false){
			$cc = $CC;
		}else{
			 $feld = preg_replace('/([^#]*)(#)([^#]*)(#)([^#]*)/','$3',$CC);
			 $cc =preg_replace('/([^#]*)(#)([^#]*)(#)([^#]*)/',$_POST[$feld],$CC);
		}
		
		$strpos1 = strpos($BCC,"#");
		if($strpos1 === false){
			$bcc = $BCC;
		}else{
			 $feld = preg_replace('/([^#]*)(#)([^#]*)(#)([^#]*)/','$3',$BCC);
			 $bcc =preg_replace('/([^#]*)(#)([^#]*)(#)([^#]*)/',$_POST[$feld],$BCC);
		}
		
		$strpos1 = strpos($BETREFF,"#");
		if($strpos1 === false){
			$subject = $BETREFF;
		}else{
			 $feld = preg_replace('/([^#]*)(#)([^#]*)(#)([^#]*)/','$3',$BETREFF);
			 $subject =preg_replace('/([^#]*)(#)([^#]*)(#)([^#]*)/',$_POST[$feld],$BETREFF);
		}
		
		$mailbody = "<p>Folgende Anfrage wurde am #MG_DATUM# um #MG_ZEIT# gesendet:</p>
<p>&nbsp;</p>
<p>Name: #vorname# #name#</p>
<p>Team: #team#</p>
<p>Email: #email#</p>
<p>Was? #gehtwasnicht# </p>
<p>---------------------------------------------------------------</p>
<p>Nachricht:</p>
<p>#nachricht#</p>";
		$mailbody = preg_replace('/(#)(MG_DATUM)(#)/',strftime("%d.%m.%Y"),$mailbody);
		$mailbody = preg_replace('/(#)(MG_ZEIT)(#)/',strftime("%H:%M").' Uhr',$mailbody);
		$mailbody = preg_replace('/(#)(MG_IP)(#)/',$_SERVER['REMOTE_ADDR'],$mailbody);
		$count = preg_match_all('|(#)([^#]*)(#)|',$mailbody,$out, PREG_PATTERN_ORDER);
		for($i=0;$i<$count;$i++){
			$mailbody = preg_replace('/(#)('.$out[2][$i].')(#)/',(is_array($_POST[$out[2][$i]]) ? implode("<br />",$_POST[$out[2][$i]]) : nl2br($_POST[$out[2][$i]])), $mailbody);
		}
		$body = "<style> 
				table td, p {
					font-family: arial;
					font-size: 12px;
					vertical-align: top;
				}
				</style>".$mailbody;
		
		$head  = "Return-Path: <".$mailfrom.">\nFrom: <".$mailfrom.">\n";
		$head .= "cc:  ".$cc."\n";
		$head .= "Bcc:  ".$bcc."\n";
		/*$head .= "Content-Type: text/html; charset=".$_SERVER['HTTP_ACCEPT_CHARSET']."\n";	*/	
		$head .= "Content-Type: text/html; charset=utf-8\n";
		
		if (@mail($mailto,$subject,$body,$head)) {	
			echo "<div class=\"alert alert-success\">".$ANTWORT."</div>";
			ob_end_flush();
		} else {
			$err_mail = "<div class=\"err_msg\">".$VERSAND."</div>";	
		}	
		}
	}
?>
<?php if((isset($err_msg) && isset($_REQUEST["formSended"])) || !isset($_REQUEST["formSended"])  || isset($err_mail)) { ?>

	<script type='text/javascript'>
	function clear_form_elements() {
    	tags = document.getElementsByTagName('input');	
    	for(i = 0; i < tags.length; i++) {
			switch(tags[i].type) {
				case 'password':
				case 'text':				
					tags[i].value = '';
					break;
				case 'checkbox':
				case 'radio':
					tags[i].checked = false;
					break;
			}
		}   
		tags = document.getElementsByTagName('select');
		for(i = 0; i < tags.length; i++) {
			if(tags[i].type == 'select-one') {
				tags[i].selectedIndex = 0;
			}
			else {
				for(j = 0; j < tags[i].options.length; j++) {
					tags[i].options[j].selected = false;
				}
			}
		}
		tags = document.getElementsByTagName('textarea');
		for(i = 0; i < tags.length; i++) {
			tags[i].value = '';
		}	   
	}
	</script>

	   <div class="formText"><?php echo $TEXT; ?></div>
	   <?php echo $err_mail; ?>
	   <?php echo $captchaerr; ?><?php	   
	   if(isset($err_msg)) {
		   echo "<div class=\"alert alert-danger\" role=\"alert\">".$err_msg."</div>";			
		}?><?php if($PFLICHTANZEIGE == "oben") {?><div class="alert alert-warning" role="alert"><?php echo $PFLICHTFELDER; ?></div><?php } ?>
<div class='form well'><form class="form-horizontal" name="kontakt" action="" method="post">
<input type="hidden" name="formSended" value="TRUE" />

<div class="form-group <?php echo $errorClass['vorname']; ?>"><label class="control-label col-sm-2"><span class='required'>Vorname *</span></label><div class="col-sm-10"><input type="text" class="form-control input-sm text" name="vorname" value="<?php echo $_POST['vorname']; ?>" size="40"  /><input type="hidden" name="req[]" value="vorname" /><input type="hidden" name="req1[]" value="<span class='required'>Vorname *</span>" /></div></div>
<div class="form-group <?php echo $errorClass['name']; ?>"><label class="control-label col-sm-2"><span class='required'>Name *</span></label><div class="col-sm-10"><input type="text" class="form-control input-sm text" name="name" value="<?php echo $_POST['name']; ?>" size="40"  /><input type="hidden" name="req[]" value="name" /><input type="hidden" name="req1[]" value="<span class='required'>Name *</span>" /></div></div>
<div class="form-group <?php echo $errorClass['team']; ?>"><label class="control-label col-sm-2"><span class='required'>Teamname *</span></label><div class="col-sm-10"><input type="text" class="form-control input-sm text" name="team" value="<?php echo $_POST['team']; ?>" size="40"  /><input type="hidden" name="req[]" value="team" /><input type="hidden" name="req1[]" value="<span class='required'>Teamname *</span>" /></div></div>
<div class="form-group <?php echo $errorClass['email']; ?>"><label class="control-label col-sm-2"><span class='required'>E-Mail *</span></label><div class="col-sm-10"><input type="text" class="form-control input-sm text" name="email" value="<?php echo $_POST['email']; ?>" size="40"  /><input type="hidden" name="req[]" value="email" /><input type="hidden" name="req1[]" value="<span class='required'>E-Mail *</span>" /></div></div>
<div class="form-group <?php echo $errorClass['gehtwasnicht']; ?>"><label class="control-label col-sm-2"><span class='required'>Was ist los? *</span></label><div class="col-sm-10"><div class="radio"><label><input type="radio" name="gehtwasnicht" checked='checked' <?php echo $_POST['gehtwasnicht'] == "Ich bin eine Frau - und bei mir geht was nicht" ? "checked='checked'" : ""; ?> value="Ich bin eine Frau - und bei mir geht was nicht"  />Ich bin eine Frau - und bei mir geht was nicht</label></div><div class="radio"><label><input type="radio" name="gehtwasnicht"  <?php echo $_POST['gehtwasnicht'] == "Ich bin ein Mann - und bei mir geht was nicht" ? "checked='checked'" : ""; ?> value="Ich bin ein Mann - und bei mir geht was nicht"  />Ich bin ein Mann - und bei mir geht was nicht</label></div><div class="radio"><label><input type="radio" name="gehtwasnicht"  <?php echo $_POST['gehtwasnicht'] == "Hilfe!! Könnt ihr mir mal erklären wie das geht??" ? "checked='checked'" : ""; ?> value="Hilfe!! Könnt ihr mir mal erklären wie das geht??"  />Hilfe!! Könnt ihr mir mal erklären wie das geht??</label></div></div></div>
<div class="form-group <?php echo $errorClass['nachricht']; ?>"><label class="control-label col-sm-2"><span class='required'>Nachricht *</span></label><div class="col-sm-10"><textarea class="form-control" name="nachricht" rows="5" cols="40" ><?php echo $_POST['nachricht']; ?></textarea><input type="hidden" name="req[]" value="nachricht" /><input type="hidden" name="req1[]" value="<span class='required'>Nachricht *</span>" /></div></div>
<div class="form-group"><label class="control-label col-sm-12"><span>Wenn irgendwo ein Fehler auftritt, beschreibt bitte auch grob den Fehler (bzw. die Fehlermeldung, die erscheint) und wenn m&ouml;glich eure Vorraussetzungen (Browser, Einstellungen,...).</span></label></div>
<div class="form-group proof"><div class="col-sm-offset-2 col-sm-10">
<input type='text' name='yourcontact' value='' />
</div></div>
<div class="form-group proof"><div class="col-sm-offset-2 col-sm-10">
<input type='text' name='youremail' value='human@mail.com' />
</div></div>
<div class="form-group"><div class="col-sm-offset-2 col-sm-10"><br /><input class="button btn btn-primary" type="submit" value="senden" /></div></div>
</form></div>
<?php if($PFLICHTANZEIGE == "unten") {?><div class="alert alert-warning" role="alert"><?php echo $PFLICHTFELDER; ?></div><?php } ?>
<?php } ?>
