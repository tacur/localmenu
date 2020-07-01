<?php 
require 'db.php';
session_start();
/*
$kundenid = $_GET['kunde'];
$kundenid = intval($kundenid);
*/
$kundenid = $_SESSION['kunde_id'];
$result = $mysqli->query("SELECT * FROM users WHERE id='$kundenid'");
$result1 = mysqli_fetch_assoc($result);
$speisekarte = $result1['speisekarte'];
echo "KundenID = " . $kundenid;
//echo "ID: " . $kunde_id;
//echo "Vorname: " . $kunde_name;

?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>LocalMenu</title>
</head>
<body>
	<div class="cd-fold-content single-page">
	<h1 style="color: white;">Corona-Besuchereintrag</h1>
			<div class="bg-contact100" style="background-color: unset;">
				<div class="container-contact100">
					<div class="wrap-contact100">
						<div class="contact100-pic js-tilt" data-tilt>
						</div>
						<form class="contact100-form validate-form" id="corona" enctype="multipart/form-data" method="post">		
							<div class="wrap-input100 validate-input" data-validate = "Vorname muss ausgefüllt werden">
								<input class="input100" type="text" name="firstname" placeholder="Vorname" required>
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="fa fa-user" aria-hidden="true"></i>
								</span>
							</div>
							<div class="wrap-input100 validate-input" data-validate = "Name muss ausgefüllt werden">
								<input class="input100" type="text" name="lastname" placeholder="Name" required>
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="fa fa-user" aria-hidden="true"></i>
								</span>
							</div>
							<div class="wrap-input100 validate-input" data-validate = "Straße, PLZ und Ort müssen ausgefüllt werden">
								<input class="input100" type="text" name="adresse" placeholder="Adresse" required>
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="fa fa-address-card-o" aria-hidden="true"></i>
								</span>
							</div>
							<!--
							<div class="wrap-input100 validate-input" data-validate = "E-Mail muss ausgefüllt werden: ex@abc.xyz">
								<input class="input100" type="text" name="email" placeholder="E-Mail">
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="fa fa-envelope" aria-hidden="true"></i>
								</span>
							</div>
							-->
							<div class="wrap-input100 validate-input" data-validate = "Telefonnummer muss ausgefüllt werden">
								<input class="input100" type="text" name="telefonnummer" placeholder="Telefonnummer" required>
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="fa fa-phone" aria-hidden="true"></i>
								</span>
							</div>
							
							<div class="wrap-input100 validate-input" data-validate = "Die vor. Aufenthaltsdauer Ihres Besuches muss eingetragen werden.">
								<input class="input100" type="text" name="dauer" placeholder="Vor. Aufenthaltsdauer" required>
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="fa fa-clock-o" aria-hidden="true"></i>
								</span>
							</div>
							<input class="input100" type="text" name="kunden_id" value="<?php echo $kunde_id;?>" hidden>
							<!--
							<div class="wrap-input100 validate-input" data-validate = "Anfangszeit ihres besuches muss eingetragen werden.">
								<input class="input100" type="text" name="endzeit" placeholder="Besuchs-Endzeit">
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="fa fa-clock-o" aria-hidden="true"></i>
								</span>
							</div>		
							-->
							<div class="container-contact100-form-btn">
								<button class="contact100-form-btn" name="corona" type="submit">
									Absenden
								</button>
							</div>
						</form>
					</div>
				</div>
	</div>
<div class="cd-popup" id="cd-corona" role="alert">
	<div class="cd-popup-container">
			<p id="qrcode_success"></p>
			<input hidden id="qrcode_value">
			<div class="qrcode" id="qrcode" style="margin-bottom: 10px;width: 90%;margin: auto;" value=""></div>
		<ul class="cd-buttons"><a style="background: var(--grundfarbe);
    margin: 20px;" href="#0" onclick="hidePopup('corona','plus')">Weiteren Besucher eintragen</a>
	   </ul>
		
	   <ul class="cd-buttons">
		  <li><a href="#0" onclick="hidePopup('corona','bestätigen')">Okay</a></li>
		  <li><a href="#0" onclick="hidePopup('corona','schließen')">Schließen</a></li>
	   </ul>
	   <a href="#0" class="cd-popup-close img-replace" onclick="hidePopup('corona','bestätigen')"></a>
	</div> <!-- cd-popup-container -->
	
</div> <!-- cd-popup -->
     
</div>
</body>

<script src="js/jquery-2.1.4.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>