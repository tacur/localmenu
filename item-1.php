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

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>LocalMenu</title>
</head>
<body>
	<div class="cd-fold-content single-page">
		<h2>Speisekarte</h2>
		<?php
		if ($kundenid == "X") {
			echo '<iframe src="dateien/speisekarte.pdf" width="100%" height="100%"> </iframe>';
		} else {
			if ($speisekarte == "1"){
				echo '<iframe src="Kunden/'. $kundenid.'/speisekarte/speisekarte.pdf" width="100%" height="100%"> </iframe>';
			  }else{
				echo '<iframe src="dateien/speisekarte.pdf" width="100%" height="100%"> </iframe>';
			  }
		}
		
		?>
	</div>
</body>
<script src="js/jquery-2.1.4.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>