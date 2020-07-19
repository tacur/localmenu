<?php 
require 'db.php';
session_start();

$kundenid = $_GET['kunde'];
$kundenid = intval($kundenid);
$kunde = $mysqli->query("SELECT * FROM users WHERE id='$kundenid'");
$kunde_erg = mysqli_fetch_assoc($kunde);
$kunde_id = $kunde_erg['id'];
$kunde_name = $kunde_erg['name'];
$kunde_strasse = $kunde_erg['strasse'];
$kunde_hausnummer = utf8_encode($kunde_erg['hausnummer']);
$kunde_ort = $kunde_erg['ort'];
$kunde_plz = utf8_encode($kunde_erg['postleitzahl']);
$speisekarte_direkt= $kunde_erg['speisekarte_direkt'];
$profilbild= $kunde_erg['profilbild'];

$result_tagesmenu = $mysqli->query("SELECT * FROM Tagesmenu WHERE Kunden_ID='$kundenid'");
$result_TM = mysqli_fetch_assoc($result_tagesmenu);
$result_TM_Pfad = $result_TM['tagesmenu_PFAD'];

if ($kunde_id == ""){
	$kunde_id = "X";
	header("Location: https://dev.localmenu.de/start");
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
			. "VALUES ('Seitenaufruf','QR-Code oder Direktaufruf','$loggingtime', '$kunde_name', '$client_ip')";
	$result_logging = $mysqli->query($sql2);	
}

 $_SESSION['kunde_id'] = $kunde_id;

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
	<link rel="stylesheet" type="text/css" href="css/main.css">
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
	
	<main class="cd-main">
	<div id="snackbar"></div>
	<nav class="navbar navbar-expand-lg navbar-light bg-light" style="width:100%;height: 60px;position:fixed;top: 0;z-index: 1;box-shadow: 0 0 10px 0 black;background: var(--secondary)!important;">
			</nav>
			<img class="image3" src="img/logo.png" style="max-height: 50px;width:auto;position:fixed;top: .5rem;left: 0;margin:auto;z-index: 5;">
			<a class="btn_s" id="darkmode" tabindex="1" onclick="swapStyleSheet('css/dark.css')">
					<i class="fas fa-moon"></i>
			</a>
		<div style="margin-top: 70px;background: var(--secondary);">
	<?php 
		if ($kunde_id != "X"){
                  if ($profilbild == "1"){
                    echo '<img src="Kunden/'.$kunde_id.'/logo/logo.png" class="headshot">';
                  }else{
                    echo '<img src="img/profilbild.png" class="headshot">';
                  }
			echo '
			<br>
			<h2 style="text-align: center;font-size: 3rem;">'. $kunde_name . '</h2>
			<p style="text-align: center;"> '. $kunde_strasse . ' '. $kunde_hausnummer . ', '. $kunde_ort. ', '. $kunde_plz. ' </p>';
		}else {
		echo '
		<div class="headshot" ></div>
		<br>
		<h2 style="text-align: center;font-size: 3rem;">BITTE QR-Code scannen.</h2>
		<p style="text-align: center;">Per QR-Code identifizieren wir das Restaurant.</p>';
		}
		?>
			</div>
			<input id='speisekarte_direktaufruf' value='0' hidden>
				<!--<a href="#0" class="card cd-btn cd-modal-trigger" style="padding: 5px 10px;">Corona-Eintrag</a>-->
		<div class="middle" style="padding: 10px;background: var(--secondary);">
			<div class="row">
					<div class="col-sm-6" style="padding-bottom: 5px;">
							<div class="card bg-dark" style="overflow: hidden;min-width: 100%; border-radius: 2rem; background: var(--secondary); 
							box-shadow: 2px 3px 13px rgba(0,0,0,0.75), 0 10px 10px rgba(0,0,0,0.22);border:unset;">
								<ul class="cd-gallery">
									<li class="cd-item" >
										<a href="item-1.php/?kunde=<?php echo $kunde_id;?>" id="speisekarte_direkt">
											<div>
												<img src="img/menu_icon.png" class="cd-item-logo" />
												<br>
												<h2 >Speisekarte</h2>
											</div>
										</a>
									</li>
								</ul>
							</div>	
					</div>
			<?php
				if (strlen($result_TM_Pfad) > 5 ) {
					echo "<div class='col-sm-6' style='padding-bottom: 5px;'>
							<div class='card bg-dark' style='overflow: hidden;min-width: 100%; border-radius: 2rem; background: var(--secondary); 
								box-shadow: 2px 3px 13px rgba(0,0,0,0.75), 0 10px 10px rgba(0,0,0,0.22);border:unset;'>
								<ul class='cd-gallery'>
									<li class='cd-item' >
										<a href='item-5.php/?kunde=" .  $kunde_id . "'>
											<div>
												<img src='img/tagesmenu_icon.png' class='cd-item-logo' />
												<br>
												<h2 >Tagesmenu</h2>
											</div>
										</a>
									</li>
								</ul>
							</div>	
						</div>";
				}
					
			?>	
					<div class="col-sm-6" style="padding-bottom: 5px;">
							<div class="card bg-dark" style="overflow: hidden;min-width: 100%; border-radius: 2rem; background: var(--secondary); 
							box-shadow: 2px 3px 13px rgba(0,0,0,0.75), 0 10px 10px rgba(0,0,0,0.22);border:unset;">
								<ul class="cd-gallery">
									<!--<li class="cd-item" style="background-image: linear-gradient(to bottom right, black, #92D050);">-->
									<li class="cd-item">		
									<a href="item-2.php/?kunde=<?php echo $kunde_id;?>" >
											<div>
												<img src="img/uhrzeit_icon_neu.png" class="cd-item-logo" />
												<br>
												<h2 >Kontakt/Öffnungszeiten</h2>
											</div>
										</a>
									</li>
								</ul>
							</div>	
					</div>		
					<div class="col-sm-6" style="padding-bottom: 5px;">
							<div class="card bg-dark" style="overflow: hidden;min-width: 100%; border-radius: 2rem; background: var(--secondary); 
							box-shadow: 2px 3px 13px rgba(0,0,0,0.75), 0 10px 10px rgba(0,0,0,0.22);border:unset;">
								<ul class="cd-gallery">
								<!--
									<li class="cd-item">
										<a href="item-4.php/?kunde=<?php // echo $kunde_id;?>" >
											<div>
											<img src="img/corona_icon.png" class="cd-item-logo"  />
											<h2 >Corona-Eintrag</h2>
											</div>
										</a>
									</li> 
									-->
									
									<li class="cd-item cd-modal-trigger" >
										<div class="corona" style="display:unset;">
											<div>
												
												<img src="img/corona_icon.png" class="cd-item-logo" />
												<br>
												<h2 >Corona-Eintrag</h2>
												
											</div>
										</div>
									</li>
									
									
								</ul>
							</div>	
					</div>		
			</div>
		</div>
		<!--<div id="qrcode"></div>-->
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
	

	<div class="cd-transition-layer"> 
		<div class="bg-layer"></div>
	</div> <!-- .cd-transition-layer -->

	<div class="cd-folding-panel">
		
		<div class="fold-left"></div> <!-- this is the left fold -->
		
		<div class="fold-right"></div> <!-- this is the right fold -->
		
		<div class="cd-fold-content">
			<!-- content will be loaded using javascript -->
		</div>

		<a class="cd-close" href="#0"></a>
	</div> <!-- .cd-folding-panel -->
	<div class="cd-popup" id="cd-corona" role="alert">
	<div class="cd-popup-container">
			<p id="qrcode_success" style="max-width:unset;text-transform: uppercase;"></p>
			<input hidden id="qrcode_value">
			<div class="qrcode" id="qrcode" style="margin-bottom: 10px;width: 90%;margin: 16px;" value=""></div>
		<ul class="cd-buttons"><a style="background: var(--third);
			margin: 0 40px 20px 40px;border-radius: 5px;" href="#0" onclick="hidePopup('corona','plus')">Weiteren Besucher eintragen</a>
	   </ul>
		
	   <ul class="cd-buttons">
		  <li><a href="#0" onclick="hidePopup('corona','bestätigen')">Okay</a></li>
		  <li><a href="#0" onclick="hidePopup('corona','schließen')">Schließen</a></li>
	   </ul>
	   <a href="#0" class="cd-popup-close img-replace" onclick="hidePopup('corona','bestätigen')"></a>
	</div> <!-- cd-popup-container -->
	
 </div> <!-- cd-popup -->
	<div class="success-box fade_in_fade_out" id="success-box">
	<div class="success-checkmark">
		<div class="check-icon">
			<span class="icon-line line-tip"></span>
			<span class="icon-line line-long"></span>
			<div class="icon-circle"></div>
			<div class="icon-fix"></div>
		</div>
		<h5 style="margin: 30px auto;text-align: center;">Corona-Eintrag erfolgreich!</h5>
	</div>
</div>
	<div class="cd-modal">
		<div class="modal-content" style="background-color: unset;">
			<h1 style="color: white;">Corona-Besuchereintrag</h1>
			<div class="bg-contact100" style="background-color: unset;">
				<div class="container-contact100">
					<div class="wrap-contact100">
						<div class="contact100-pic js-tilt" data-tilt style="background: url(img/corona_icon.png) center center no-repeat;">
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
								<input class="input100" type="number" name="dauer" placeholder="Aufenthalt in Stunden" required>
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
		</div> <!-- .modal-content -->

		<a href="#0" class="modal-close">Schließen</a>
	</div> <!-- .cd-modal -->
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
<?php 
if ($speisekarte_direkt != ""){
		echo "<script> 	$(document).ready(function(){   
			document.getElementById('speisekarte_direkt').click();
		});
		</script>";
	
	}
?>
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
	function processUser(){
					var id = "Direkt-Link benutzt.";
					var parameters = location.search.substring(1).split("&");
					var temp = parameters[0].split("=");
					var id = unescape(temp[1]);
					if (id.length >= 0 ) {
						return id
					}
					else {
						return false
					}
		}
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
var frm = $('#corona');
frm.submit(function(e) {
	
    e.preventDefault();    
    var formData = new FormData(this);
    $.ajax({
        url: 'corona.php',
        type: 'POST',
        data: formData,
        success: function (data_neu) {
				  console.log("es folgt data aus corona.php");
				 if (data_neu != "0"){
							document.getElementById("qrcode").innerHTML = "";
					 		console.log("Daten: " + data_neu);
					 		// var data_start = document.getElementById("qrcode").value;
							 var data_start = document.getElementById("qrcode_value").value;
							 console.log("Daten_Start: " + data_start);
							document.getElementById("qrcode_success").innerHTML = "Bitte zeige der Bedienung die folgenden Daten:";
							data_start.split("%").forEach(function (item) {
								if (item != ""){
									document.getElementById("qrcode").innerHTML += "<h1 style='padding: 10px;'><b>" + item  + "</b></h1>";
								}
								
							});
							document.getElementById("qrcode").innerHTML += "<h1 style='padding: 10px;'><b>" + data_neu  + "</b></h1>";;
							$("#qrcode_value").val(data_start + "%" + data_neu);
							/*
							var qrcode = new QRCode(document.getElementById("qrcode"), {
								text: data,
								logo: "img/qrcode_logo.png",
								logoWidth: undefined,
								logoHeight: undefined,
								logoBackgroundColor: '#ffffff',
								logoBackgroundTransparent: false
							});
							*/
							document.getElementById("cd-corona").style.visibility = "visible";
							document.getElementById("cd-corona").style.opacity = 1;
				 } else {
							document.getElementById("qrcode_success").innerHTML = "QR-Code konnte nicht erstellt werden. Versuch es bitte nochmal.";
							document.getElementById("qrcode").style.backgroundImage = "url('img/img_fehler.png')";
							document.getElementById("cd-corona").style.visibility = "visible";
							document.getElementById("cd-corona").style.opacity = 1;
				 }
				 /*
				  var x = document.getElementById("corona");
                  // Add the "show" class to DIV
                  x.innerHTML = data;
                  x.className = "show";
                  // After 3 seconds, remove the show class from DIV
                  // alert("test");
                  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
				  // test();
				  */
        },
        error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            },
        cache: false,
        contentType: false,
        processData: false
    });
});

  async function test() {
      await Sleep(3000); 
      history.go(0);
    }
    function Sleep(milliseconds) {
      return new Promise(resolve => setTimeout(resolve, milliseconds));
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
	  if(document.getElementById('loading')) {
		document.getElementById('loading').style.display = 'none';
	  }else {
		document.getElementById('loading2').style.display = 'none';
	  }
  }
</script>
</body>
</html>