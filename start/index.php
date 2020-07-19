<?php 
require 'db.php';
session_start();


if ($kunde_id == ""){
	$kunde_id = "X";
	// header("Location: https://dev.localmenu.de/start");
} else {
	if (! isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$client_ip = $_SERVER['REMOTE_ADDR'];
	}
	else {
		$client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	$Time = time() + (2*60*60);
	$loggingtime = date('Y-m-d H:i:s', $Time);
	$sql2 = "INSERT INTO protokoll (Protokoll_TYP, Protokoll_TEXT, Protokoll_ZEIT, Protokoll_USER, Protokoll_IP) " 
			. "VALUES ('Seitenaufruf','Direktaufruf','$loggingtime', 'Startseite', '$client_ip')";
	$result_logging = $mysqli->query($sql2);	
}

?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Vollkorn|Open+Sans:400,700' rel='stylesheet' type='text/css'>
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="img/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
	<link rel="stylesheet" type="text/css" href="css/main_start.css">
<!--===============================================================================================-->
	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
	<link id="pagestyle" rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<script src="js/easy.qrcode.min.js"></script>
	<script data-ad-client="ca-pub-4646915547116269" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<title>LOCALMENU</title>
</head>
<body>
	
	<main class="cd-main" style="width:100%;">
	<div id="snackbar"></div>
	<nav class="navbar navbar-expand-lg navbar-light bg-light" style="width:100%;height: 50px;position:fixed;top: 0;left: 0;z-index: 1;box-shadow: 0 0 10px 0 black;background: var(--secondary)!important;">
			</nav>
			<img class="image3" src="img/logo.png" style="max-height: 50px;width:auto;position:fixed;top: .5rem;left: 0;margin:auto;z-index: 5;">
			<a class="btn_s" id="darkmode" tabindex="1" onclick="swapStyleSheet('css/dark.css')">
					<i class="fas fa-moon"></i>
			</a>

			<label class="input-container closed" id="suchbar" style="margin: auto;margin-bottom:200px;margin-top: 100px;left: 0;right: 0;display: block;box-sizing:unset;">
				<div class="shadow"></div>
				<div class="center">
					<input type="text" class="input" placeholder="Lokalität suchen">
				</div>
				<div class="sticks"></div>
			</label>
			<div id="vorschlagsliste" class="list-group" style="display:none;margin: auto;margin-top:-190px;margin-bottom:100px;color: var(--grundfarbe);position: relative;z-index: 1;font-size: large;max-height: 200px;overflow: auto;
									background: var(--secondary);border: 2px var(--grundfarbe) solid;padding:10px;"></div>
			


	<hr class="style-two">
	<footer class="container-fluid text-footer" style="text-align:center;">
	<!-- <p><a style="font-size: 12px;" href="#myModal2" class="links" id="modal-trigger2" data-toggle="modal">Allgemeine Geschäftsbedingungen</a></p> -->
	<p style="margin-bottom: 10px;"><a style="font-size: 16px;display: inline-block;background: var(--grundfarbe);color: var(--secondary);border-radius: 5px;padding: 5px;" href="login.php" class="links" target="_blank">Anmelden/Registrieren</a></p>
	<p><a style="font-size: 16px;margin-bottom:10px;" href="agbs_datenschutz_impressum.html" class="links" target="_blank">Allgemeine Geschäftsbedingungen</a></p>
	<p><a style="font-size: 16px;margin-bottom:10px;" href="agbs_datenschutz_impressum.html" class="links" target="_blank">Datenschutzerklärung</a></p>
	<p><a style="font-size: 16px;margin-bottom:10px;" href="agbs_datenschutz_impressum.html" class="links" target="_blank">Impressum</a></p>
	<hr class="style-two">
	<p style="margin-top: 20px;;">Copyright © 2020 <a style="color: var(--grundfarbe)" href="agbs_datenschutz_impressum.html" target="_blank" title="LOCALMENU">LOCALMENU</a>. </br>Alle Rechte vorbehalten.</p>
	</footer>
	<div id="cookieConsent">
			    <div id="closeCookieConsent"><i class="material-icons">close</i></div>
			    <b>Zustimmung zur Verwendung von Cookies.</b></br>Diese Website benutzt Cookies. <a href="agbs_datenschutz_impressum.html" target="_blank">Mehr Informationen</a>. <a class="cookieConsentOK">Zustimmen</a>
			</div>
	</main> <!-- .cd-main -->
		
<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
<script src="js/jquery-2.1.4.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>

<script type="text/javascript">
	// ##### COOKIE DARKMODE ######
	$(document).ready(function(){   
			// var cookie = decodeURIComponent(document.cookie);
			var cookies = document.cookie.match(new RegExp('(^| )' + "Darkmode" + '=([^;]+)'));
			if (cookies) {
				document.getElementById('darkmode').value = "dark";
				document.getElementById('darkmode').innerHTML = '<i class="fas fa-sun"></i>';
				document.getElementById('pagestyle').setAttribute('href', 'css/dark.css');
			}
			else {console.log("Darkmode wurde in der Vergangenheit nicht gesetzt");}
			 
	}); 
	// ##### Seitenaufruf ######
	$(document).ready(function(){
			var aufruf = 1;
			$.post("cookie.php", {
									seitenaufruf: aufruf
							}, function(data, status){
								console.log("Seitenaufruf");
							}
			)
	});
	function swapStyleSheet(sheet){
			// document.getElementById('pagestyle').setAttribute('href', sheet);
			if (document.getElementById('darkmode').value == null) {
				document.getElementById('darkmode').value = "dark";
				document.getElementById('darkmode').innerHTML = '<i class="fas fa-sun" ></i>';
				document.getElementById('pagestyle').setAttribute('href', sheet);
				$.post("cookie.php", {
					darkmode : 'yes'
				}, function(data, status){}
				);
			} else{
				document.getElementById('darkmode').value = null;
				document.getElementById('darkmode').innerHTML = '<i class="fas fa-moon" ></i>';
				document.getElementById('pagestyle').setAttribute('href', 'css/style.css');
				document.getElementById('darkmode').style.background = 'var(--third)';
				$.post("cookie.php", {
					darkmodeoff : 'no'
				}, function(data, status){});
			}
		}
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
<script>
	// Postleitzahl bei Eingabe 
	$(document).ready(function(){  
		$("input").keyup(function() {
			if ($("input").val().length > 0){
				var input = $("input").val();
				$.post("kundensuche.php", {
					datainput : input
				}, function(data, status){
					if (data.length >= 15){
						var list = new Array();
						var kunde = new Array();
						// alert(data);
						var list = data.split("%");
						x = 0;
						y = list.length;
						// alert(list);
						document.getElementById("vorschlagsliste").innerHTML = "";

						list.forEach(function(item){
							
							var kunde = list[x].split(",");
							if(item.length >= 15){
								document.getElementById("vorschlagsliste").innerHTML += "<a href='https://dev.localmenu.de/?kunde=" + kunde[4] + "' id='" + kunde[4] + "' class='list-group-item' style='background-color:unset;border:unset;text-decoration:none;color:var(--grundfarbe);margin:5px;'>" + kunde[0] + ", " + kunde[1] + " " + kunde[2] + " " + kunde[3] +"</a>";
							}
							x = x + 1 ;

						});
						// $("#vorschlagsliste").html(data);
						document.getElementById("vorschlagsliste").style.display = "flex";
					} else{
						document.getElementById("vorschlagsliste").innerHTML = "Kunde nicht auffindbar.";
						document.getElementById("vorschlagsliste").style.display = "flex";
						//document.getElementById("vorschlagsliste").style.display = "none";
					}
				});
			}else{
				document.getElementById("vorschlagsliste").style.display = "none";
			}

		});
	});
</script>
<script type="text/javascript">
	//#### COOKIE Meldung ######
		$(document).ready(function(){   
			// var cookie = decodeURIComponent(document.cookie);
			var cookies = document.cookie.match(new RegExp('(^| )' + "Cookies" + '=([^;]+)'))
			if (!cookies) {
				// console.log(cookies[2]);
				setTimeout(function () {
				$("#cookieConsent").fadeIn(200);
			 		}, 4000);
			 	$("#closeCookieConsent, .cookieConsentOK").click(function() {
					var cookieok = true;
					$.post("cookie.php", {
						cookies : cookieok
							}, function(data, status){}
					);
					$("#cookieConsent").fadeOut(200);
				});
				
			}
			else {console.log("Cookies wurden in der Vergangenheit akzeptiert!");}
			 
	}); 
</script>
<script type="text/javascript">
	$(document).ready(function(){ 
		Sleep(1000);  
		suchclick();
	});

	document.querySelector('.sticks').addEventListener('click',(e) =>
	{
		e.stopPropagation();
		e.preventDefault();
		document.querySelector('.input-container').blur();
		document.getElementById("vorschlagsliste").style.display = "none";
	});
</script>
<script type="text/javascript">
/*
	document.getElementById("qrcode_success").innerHTML = "QR-Code konnte nicht erstellt werden. Versuch es bitte nochmal.";
	document.getElementById("qrcode").style.backgroundImage = "url('img/img_fehler.png')";
	document.getElementById("cd-corona").style.visibility = "visible";
	document.getElementById("cd-corona").style.opacity = 1;
*/

  async function test() {
      await Sleep(3000); 
      history.go(0);
    }
    function Sleep(milliseconds) {
      return new Promise(resolve => setTimeout(resolve, milliseconds));
	}
	function suchclick() {
		document.getElementById("suchbar").click();
    }
</script>
<script>
	function hidePopup(typ, event) { 

			if(typ == 'corona') {
				if (event == 'bestätigen') {
					document.getElementById("cd-corona").style.visibility = "hidden";
					document.getElementById("cd-corona").style.opacity = 0;
				}
				if (event == 'schließen') {
					document.getElementById("cd-corona").style.visibility = "hidden";
					document.getElementById("cd-corona").style.opacity = 0;
				}
				if (event == 'plus') {

					document.getElementById("cd-corona").style.visibility = "hidden";
					document.getElementById("cd-corona").style.opacity = 0;
				}
			}
	}
</script>
<script type="text/javascript">
  function frameload(){
	document.getElementById('loading').style.display = 'none';
	document.getElementById('loading2').style.display = 'none';
  }
</script>
</body>
</html>