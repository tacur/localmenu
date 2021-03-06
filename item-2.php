<?php 
require 'db.php';
session_start();
/*
$kundenid = $_GET['kunde'];
$kundenid = intval($kundenid);
*/
$kundenid = $_SESSION['kunde_id'];
$kunde= $mysqli->query("SELECT * FROM users WHERE id='$kundenid'");
$kunde_erg = mysqli_fetch_assoc($kunde);
$kunde_name = $kunde_erg['name'];
$kunde_strasse = $kunde_erg['strasse'];
$kunde_hausnummer = $kunde_erg['hausnummer'];
$kunde_ort = $kunde_erg['ort'];
$kunde_plz = $kunde_erg['postleitzahl'];
$kunde_telefon = $kunde_erg['telefonnummer'];
$kunde_email = $kunde_erg['email'];
//echo "ID: " . $kunde_id;
//echo "Vorname: " . $kunde_name;

$result_lieferzeiten = $mysqli->query("SELECT * FROM oeffnungszeiten WHERE Kunden_ID ='$kundenid'");
$result_LZ = mysqli_fetch_assoc($result_lieferzeiten);
$montagstart = $result_LZ['MONTAG_START'];
$montagende = $result_LZ['MONTAG_ENDE'];
$montaggeschlossen = $result_LZ['MONTAG_GESCHLOSSEN'];
$montagopenend = $result_LZ['MONTAG_OPENEND'];      
$dienstagstart = $result_LZ['DIENSTAG_START'];
$dienstagende = $result_LZ['DIENSTAG_ENDE'];
$dienstaggeschlossen = $result_LZ['DIENSTAG_GESCHLOSSEN'];
$dienstagopenend = $result_LZ['DIENSTAG_OPENEND'];          
$mittwochstart = $result_LZ['MITTWOCH_START'];
$mittwochende = $result_LZ['MITTWOCH_ENDE'];
$mittwochgeschlossen = $result_LZ['MITTWOCH_GESCHLOSSEN'];
$mittwochopenend = $result_LZ['MITTWOCH_OPENEND'];         
$donnerstagstart = $result_LZ['DONNERSTAG_START'];
$donnerstagende = $result_LZ['DONNERSTAG_ENDE'];
$donnerstaggeschlossen = $result_LZ['DONNERSTAG_GESCHLOSSEN'];
$donnerstagopenend = $result_LZ['DONNERSTAG_OPENEND'];        
$freitagstart = $result_LZ['FREITAG_START'];
$freitagende = $result_LZ['FREITAG_ENDE'];
$freitaggeschlossen = $result_LZ['FREITAG_GESCHLOSSEN'];
$freitagopenend = $result_LZ['FREITAG_OPENEND'];         
$samstagstart = $result_LZ['SAMSTAG_START'];
$samstagende = $result_LZ['SAMSTAG_ENDE'];
$samstaggeschlossen = $result_LZ['SAMSTAG_GESCHLOSSEN'];
$samstagopenend = $result_LZ['SAMSTAG_OPENEND'];        
$sonntagstart = $result_LZ['SONNTAG_START'];
$sonntagende = $result_LZ['SONNTAG_ENDE'];
$sonntaggeschlossen = $result_LZ['SONNTAG_GESCHLOSSEN'];
$sonntagopenend = $result_LZ['SONNTAG_OPENEND'];           
$mitteilung_1 = $result_LZ['Mitteilung_1'];
$mitteilung_2 = $result_LZ['Mitteilung_2'];

date_default_timezone_set('UTC');
// Gibt etwas aus wie: 'Monday'
$zeit  = time() + (2.5*60*60);
$aktuellezeit = time() + (2.5*60*60);
$abholzeit = date('H:i',  $aktuellezeit) ;
$tag = date("N");
switch ($tag) {
	case "1":
	   $startzeit = $montagstart;
	   $endzeit = $montagende;
	   $geschlossen = $montaggeschlossen;
		break;
	case  "2":
	   $startzeit = $dienstagstart;
	   $endzeit = $dienstagende;
	   $geschlossen = $dienstaggeschlossen;
		break;
	case  "3":
	   $startzeit = $mittwochstart;
	   $endzeit = $mittwochende;
	   $geschlossen = $mittwochgeschlossen;
		break;
	case  "4":
	   $startzeit = $donnerstagstart;
	   $endzeit = $donnerstagende;
	   $geschlossen = $donnerstaggeschlossen;
		break;
	case  "5":
	   $startzeit = $freitagstart;
	   $endzeit = $freitagende;
	   $geschlossen = $freitaggeschlossen;
		break;
	case  "6":
	   $startzeit = $samstagstart;
	   $endzeit = $samstagende;
	   $geschlossen = $samstaggeschlossen;
		break;
	case  "7":
	   $startzeit = $sonntagstart;
	   $endzeit = $sonntagende;
	   $geschlossen = $sonntaggeschlossen;
		break;
}
?>

<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>LocalMenu</title>
</head>
<body>
	<div class="cd-fold-content single-page">
		<?php
		echo '<h2 style="text-align: center;font-size: 3rem;">'. $kunde_name . '</h2>
			<p style="text-align: center;"> '. $kunde_strasse . ' '. $kunde_hausnummer . ', '. $kunde_ort. ', '. $kunde_plz. ' </p>';
		
		?>
		<div class="middle" style="padding: 10px;background: var(--secondary);">
			<div class="row">
					<div class="col-sm-12" style="padding-bottom: 5px;max-height:100px;margin-bottom: 15px;">
							<div class="card bg-dark" style="overflow: hidden;min-width: 100%;max-height:100%; border-radius: 2rem; background: var(--secondary); 
							box-shadow: 2px 3px 13px rgba(0,0,0,0.75), 0 10px 10px rgba(0,0,0,0.22);border:unset;">
								<a class="cd-item2" href="tel:<?php echo $kunde_telefon; ?>">
									<div class="row" style="display: flex;flex-flow: nowrap;max-width: 100%;">
										<div class="col-sm-3" style="padding-bottom: 5px;max-width:30%">
											<img src="img/telefon_icon.png" class="cd-item-logo"  style="height: 40%;"/>
										</div>
										<div class="col-sm-9" style="padding-bottom: 5px;">
											<?php echo '<p class="p_kontakt">Telefon:</br>'. $kunde_telefon . '</p>'; ?>
										</div> 
									</div>
								</a>
							</div>	
					</div>		
					<div class="col-sm-12" style="padding-bottom: 5px;max-height:100px;margin-bottom: 15px;">
							<div class="card bg-dark" style="overflow: hidden;min-width: 100%;max-height:100%; border-radius: 2rem; background: var(--secondary); 
							box-shadow: 2px 3px 13px rgba(0,0,0,0.75), 0 10px 10px rgba(0,0,0,0.22);border:unset;">
								<a class="cd-item2" href="mailto:<?php echo $kunde_email; ?>">
									<div class="row" style="display: flex;flex-flow: nowrap;max-width: 100%;">
										<div class="col-sm-3" style="padding-bottom: 5px;max-width:30%">
											<img src="img/mail_icon.png" class="cd-item-logo"   style="height: 40%;"/>
										</div>
										<div class="col-sm-9" style="padding-bottom: 5px;">
											<?php echo '<p class="p_kontakt">E-Mail:</br>'. $kunde_email . '</p>'; ?>
										</div> 
									</div>
								</a>
							</div>	
					</div>		
					<div class="col-sm-12" style="padding-bottom: 5px;max-height:100px;margin-bottom: 15px;">
							<div class="card bg-dark" style="overflow: hidden;min-width: 100%;max-height:100%; border-radius: 2rem; background: var(--secondary); 
							box-shadow: 2px 3px 13px rgba(0,0,0,0.75), 0 10px 10px rgba(0,0,0,0.22);border:unset;">
								<div class="cd-item2">

								</div>
							</div>	
					</div>		
					<div class="col-sm-12" style="padding-bottom: 5px;max-height:100px;margin-bottom: 15px;">
							<div class="card bg-dark" style="overflow: hidden;min-width: 100%;max-height:100%; border-radius: 2rem; background: var(--secondary); 
							box-shadow: 2px 3px 13px rgba(0,0,0,0.75), 0 10px 10px rgba(0,0,0,0.22);border:unset;">
								<div class="cd-item2">
									
								</div>
							</div>	
					</div>		
			</div>
		</div>
	<h2 style="text-align: center;font-size: 3rem;">Öffnungszeiten</h2>
	<div class="middle" style="padding: 10px;background: var(--secondary);">
		<div class="row">
				<div class="col-sm-12" style="padding-bottom: 5px;max-height:100px;margin-bottom: 15px;">
		<div class="card bg-dark" style="margin-top: 5px;width: 100%; border-radius: 2rem;box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);">
			<div class="card-body" style="padding: unset;">
				<?php if($mitteilung_1 != "") {
					echo "<div class='container'><div class='row'>"
							. "<div class='col-sm-2'><i style='font-size:30px;color:var(--grundfarbe);' class='material-icons'>info</i></div>"
							. "<div class='col-sm-10'><h4 style='text-align:center;'>" . $mitteilung_1 . "</h4></div>"
						."</div></div>";
						if($mitteilung_2 == "") {echo "<hr class='style-two'><br>";}
				}
				?>
				<?php if($mitteilung_2 != "") {
					echo "<div class='container'><div class='row'>"
							. "<div class='col-sm-2'><i style='font-size:30px;color:var(--grundfarbe);' class='material-icons'>info</i></div>"
							. "<div class='col-sm-10'><h4 style='text-align:center;'>" . $mitteilung_2 . "</h4></div>"
						."</div></div><hr class='style-two'><br>";
				}
				?>
				<ul class="list-group" style="max-width: 600px;margin:auto;border: 1px solid var(--grundfarbe); border-radius:2rem;">
						<li class="list-group-item novisible" style="padding-right: unset;">
							<div class="row rownowrap">
								<div class="col-sm-4 nomargin" style="padding-left: unset;"><h6>Montag</h6></div>
								<?php 
									if($montaggeschlossen == 'on'){
										echo "<div class='col-sm-8 nomargin'><h6>geschlossen</h6><div>";
									} else {
										echo "" . "<div class='col-sm-4 nomargin' style='padding-left: unset;'><h6>" . $montagstart . " Uhr</h6></div>";
										if($montagopenend == 'on'){
											echo "<div class='col-sm-4 nomargin'><h6>openend</h6></div>";
										} else {
											echo "<div class='col-sm-4 nomargin' style='padding-left: unset;'><h6>" .  $montagende . " Uhr</h6></div>";
										}
									}
								?>
							</div>
						</li>
						<li class="list-group-item novisible" style="padding-right: unset;">
							<div class="row rownowrap">
								<div class="col-sm-4 nomargin" style="padding-left: unset;"><h6>Dienstag</h6></div>
								<?php 
									if($dienstaggeschlossen == 'on'){
										echo "<div class='col-sm-8 nomargin'><h6>geschlossen</h6><div>";
									} else {
										echo "" . "<div class='col-sm-4 nomargin' style='padding-left: unset;'><h6>" . $dienstagstart . " Uhr</h6></div>";
										if($dienstagopenend == 'on'){
											echo "<div class='col-sm-4 nomargin'><h6>openend</h6></div>";
										} else {
											echo "<div class='col-sm-4 nomargin' style='padding-left: unset;'><h6>" .  $dienstagende . " Uhr</h6></div>";
										}
									}
								?>
							</div>
						</li>
						<li class="list-group-item novisible" style="padding-right: unset;">
							<div class="row rownowrap">
								<div class="col-sm-4 nomargin" style="padding-left: unset;"><h6>Mittwoch</h6></div>
								<?php 
									if($mittwochgeschlossen == 'on'){
										echo "<div class='col-sm-8 nomargin'><h6>geschlossen</h6><div>";
									} else {
										echo "" . "<div class='col-sm-4 nomargin' style='padding-left: unset;'><h6>" . $mittwochstart . " Uhr</h6></div>";
										if($mittwochopenend == 'on'){
											echo "<div class='col-sm-4 nomargin'><h6>openend</h6></div>";
										} else {
											echo "<div class='col-sm-4 nomargin' style='padding-left: unset;'><h6>" .  $mittwochende . " Uhr</h6></div>";
										}
									}
								?>
							</div>
						</li>
						<li class="list-group-item novisible" style="padding-right: unset;">
							<div class="row rownowrap">
								<div class="col-sm-4 nomargin" style="padding-left: unset;"><h6>Donnerstag</h6></div>
								<?php 
									if($donnerstaggeschlossen == 'on'){
										echo "<div class='col-sm-8 nomargin'><h6>geschlossen</h6><div>";
									} else {
										echo "" . "<div class='col-sm-4 nomargin' style='padding-left: unset;'><h6>" . $donnerstagstart . " Uhr</h6></div>";
										if($donnerstagopenend == 'on'){
											echo "<div class='col-sm-4 nomargin'><h6>openend</h6></div>";
										} else {
											echo "<div class='col-sm-4 nomargin' style='padding-left: unset;'><h6>" .  $donnerstagende . " Uhr</h6></div>";
										}
									}
								?>
							</div>
						</li>
						<li class="list-group-item novisible" style="padding-right: unset;">
							<div class="row rownowrap">
								<div class="col-sm-4 nomargin" style="padding-left: unset;"><h6>Freitag</h6></div>
								<?php 
									if($freitaggeschlossen == 'on'){
										echo "<div class='col-sm-8 nomargin'><h6>geschlossen</h6><div>";
									} else {
										echo "" . "<div class='col-sm-4 nomargin' style='padding-left: unset;'><h6>" . $freitagstart . " Uhr</h6></div>";
										if($freitagopenend == 'on'){
											echo "<div class='col-sm-4 nomargin'><h6>openend</h6></div>";
										} else {
											echo "<div class='col-sm-4 nomargin' style='padding-left: unset;'><h6>" .  $freitagende . " Uhr</h6></div>";
										}
									}
								?>
							</div>
						</li>
						<li class="list-group-item novisible" style="padding-right: unset;">
							<div class="row rownowrap">
								<div class="col-sm-4 nomargin" style="padding-left: unset;"><h6>Samstag</h6></div>
								<?php 
									if($samstaggeschlossen == 'on'){
										echo "<div class='col-sm-8 nomargin'><h6>geschlossen</h6><div>";
									} else {
										echo "" . "<div class='col-sm-4 nomargin' style='padding-left: unset;'><h6>" . $samstagstart . " Uhr</h6></div>";
										if($samstagopenend == 'on'){
											echo "<div class='col-sm-4 nomargin'><h6>openend</h6></div>";
										} else {
											echo "<div class='col-sm-4 nomargin' style='padding-left: unset;'><h6>" .  $samstagende . " Uhr</h6></div>";
										}
									}
								?>
							</div>
						</li>
						<li class="list-group-item novisible" style="padding-right: unset;">
							<div class="row rownowrap">
								<div class="col-sm-4 nomargin" style="padding-left: unset;"><h6>Sonntag</h6></div>
								<?php 
									if($sonntaggeschlossen == 'on'){
										echo "<div class='col-sm-8 nomargin'><h6>geschlossen</h6><div>";
									} else {
										echo "" . "<div class='col-sm-4 nomargin' style='padding-left: unset;'><h6>" . $sonntagstart . " Uhr</h6></div>";
										if($sonntagopenend == 'on'){
											echo "<div class='col-sm-4 nomargin'><h6>openend</h6></div>";
										} else {
											echo "<div class='col-sm-4 nomargin' style='padding-left: unset;'><h6>" .  $sonntagende . " Uhr</h6></div>";
										}
											
									}
								?>
							</div>
						</li>
				</ul>
			</div>
		</div>
		<div class="card bg-dark" style="margin-top: 5px;margin-bottom: 15px;width: 100%; border-radius: 2rem;box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);">
			<div class="card-body" style="padding: unset;">
				<div class='container' style="padding: 15px;">
					<div class='row'>
							<div class='col-sm-12'>
								<h4 style='text-align:center;'>Vielen	Dank,	dass	Sie	LocalMenu	nutzen	und	so	uns	helfen	die	Hygienevorschriften	einzuhalten.</h4>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
</div>
</body>
<script src="js/jquery-2.1.4.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>