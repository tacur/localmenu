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
$tagesmenu = $result1['tagesmenu'];
// echo "KundenID = " . $kundenid;
//echo "ID: " . $kunde_id;
//echo "Vorname: " . $kunde_name;
$result_tagesmenu = $mysqli->query("SELECT * FROM Tagesmenu WHERE Kunden_ID='$kundenid'");
$result_TM = mysqli_fetch_assoc($result_tagesmenu);
$result_TM_Pfad = $result_TM['tagesmenu_PFAD'];
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
		<h2>Tagesmenu</h2>
		<div class="lds-ellipsis" id="loading2"><div></div><div></div><div></div><div></div></div>
		<?php
		if ($kundenid == "X") {
			echo '<iframe src="dateien/tagesmenu.pdf" width="100%" onload="frameload()" height="100%"> </iframe>';
		} else {
			if ($tagesmenu == "1"){
				// echo '<object data="Kunden/'. $kundenid.'/speisekarte/speisekarte.pdf" width="100%" height="100%"></object>';
				echo '<iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=http://localmenu.de/'. $result_TM_Pfad.'" onload="frameload()" width=100% height=100% type=application/pdf></iframe>';
			 	// echo '<iframe src="Kunden/'. $kundenid.'/speisekarte/speisekarte.pdf" width="100%" height="100%"> </iframe>';
			  }else{
				// echo '<embed src="https://drive.google.com/viewerng/viewer?embedded=true&url=http://localmenu.de/dateien/speisekarte.pdf" width=100% height=100% type=application/pdf>';
				echo '<iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=http://localmenu.de/tagesmenu/tagesmenu.pdf" onload="frameload()" width=100% height=100% type=application/pdf></iframe>';
			  }
		}
		
		?>
	</div>
</body>
<script src="js/jquery-2.1.4.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>