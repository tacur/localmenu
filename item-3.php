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
		<h2>Kontakt</h2>
		<?php
		echo '<h2 style="text-align: center;font-size: 3rem;">'. $kunde_name . '</h2>
			<p style="text-align: center;"> '. $kunde_strasse . ' '. $kunde_hausnummer . ', '. $kunde_ort. ', '. $kunde_plz. ' </p>';
		
		?>
	</div>
</body>
<script src="js/jquery-2.1.4.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>