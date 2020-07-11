<?php 
require 'db.php';
session_start();
/*
$kundenid = $_GET['kunde'];
$kundenid = intval($kundenid);
*/
$kundenid = $_SESSION['kunde_id'];
$kunde = $mysqli->query("SELECT * FROM users WHERE id='$kundenid'");
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

?>

<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

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
	</div>
</body>
<script src="js/jquery-2.1.4.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>