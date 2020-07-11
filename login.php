<?php
 require 'db.php';
 require_once 'config.php';
 session_start();
?>

<!doctype html>
<html lang="en" class="no-js">
<style>html {scroll-behavior: smooth; }</style>
<head>

<?php 
if($_SESSION['email'])
{
/*
$email = $mysqli->escape_string($_SESSION['email']);

$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
if (!isset($result)) {
  $_SESSION['message'] = "Dein Account wurde gelöscht.";
  header("location: error.php");
} else{*/
	header("Location: profile.php");
	exit;
// }

}
if(isSet($_POST['submit']))
{
$do_login = true;

include_once 'do_login.php';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { 
        require 'login-1.php';
    }
}
?>
	<meta charset="UTF-8">
	<meta name="theme-color" content="#8e793e">
	<link rel="icon" sizes="192x192" href="img/favicon.png">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, shrink-to-fit=no, maximum-scale=1.0, user-scalable=0'/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700|Merriweather:400italic,400' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<link rel="stylesheet" href="css/main.css"> <!-- Resource style -->
	<link rel="stylesheet" href="css/stylewarenkorb.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<script src="js/util.js"></script> <!-- util functions included in the CodyHouse framework -->
	<script src="js/jquery-2.1.4.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 	  <!-- jQuery library -->
 	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 	  <!-- Latest compiled JavaScript -->
 	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>LOCALMENU</title>
</head>
			
<body id="top" class="cd-about" >
	<section class="cd-intro" style="position: fixed; z-index: 10;">
	<div class="cd-intro-content scale">
		<div class="content-wrapper">
			<div>
				<h1></h1>
			</div>
		</div>
	</div>
</section>
	<main>
	<div id="snackbar"></div>
	<?php 
                    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ) {
                      echo '<div id="message" class="alert alert-danger" role="alert" style="position: absolute;top: 55px;width: 90%;">' . $_SESSION['message'] . '</div>'; 
                    }                           
    ?>
<div id="anmeldung" class="container-fluid " style="background: linear-gradient(
	rgb(255, 255, 255, 0.9),rgba(255, 255, 255, 0.9)) no-repeat center center; padding: 10px 0px 10px 0px">
	<div class="middle" style="text-align: center;">
	<img src="img/logo.png" style="max-width: 90%; max-height: 200px;margin: auto;display: block;">
<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#login">Anmeldung</a></li>
    <li><a data-toggle="tab" href="#registrierung">Registrierung</a></li>
  </ul>

  <div class="tab-content">
    <div id="login" class="tab-pane active">
			<div class="well">
				<h3>Anmeldung</h3>
					<form action="login.php" method="post" autocomplete="on">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="email" type="text" class="form-control" name="email" placeholder="Email">
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input id="password" type="password" class="form-control" name="password" placeholder="Password">
							</div>
							<br>
							<div class="col-50">
							<button type="submit" class="btn btn-success" name="login" />Anmelden</button>
							</div><br><br>
					</form>
					<br>
					<a href="forgot.php"><button class="btn btn-danger" />Passwort vergessen?</button></a>
			</div>
    </div>
    <div id="registrierung" class="tab-pane fade">
      <div class="well">
      <h3>Registrierung</h3>
	  <form class="register" id="register" enctype="multipart/form-data" method="post" action="register.php">
	  		<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input id="name_register" type="text" class="form-control" name="name" placeholder="Geschäftsname" required >
			</div>
			<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input id="firstname_register" type="text" class="form-control" name="firstname" placeholder="Vorname" required>
			</div>
			<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input id="lastname_register" type="text" class="form-control" name="lastname" placeholder="Nachname" required>
			</div>
			<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
					<input id="email_register" type="email" class="form-control" name="email" placeholder="E-Mail" required>
			</div>
			<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					<input id="password_register" type="password" class="form-control" name="password" placeholder="Passwort" required>
			</div>
			<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
					<input id="telefonnummer_register" type="text" class="form-control" name="telefonnummer" placeholder="Telefonnummer" required>
			</div>
			<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
					<input id="strasse_register" type="text" class="form-control" name="strasse" placeholder="Straße" required>
			</div>
			<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
					<input id="hausnummer_register" type="text" class="form-control" name="hausnummer" placeholder="Hausnummer" required>
			</div>
			<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
					<input id="ort_register" type="text" class="form-control" name="ort" placeholder="Ort" required>
			</div>
			<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
					<input id="postleitzahl_register" type="text" class="form-control" name="postleitzahl" placeholder="Postleitzahl" required>
			</div>
			<div class="input-group">
					<input type="checkbox" name="agbs" required> Ich akzeptiere die <a style="color: var(--grundfarbe)" href="agbs_datenschutz_impressum.html" target="_blank"> AGBs</a>
			</div>
			<br><button type="submit" class="btn btn-info" name="register">Registrieren</button>
 		</form>
      </div>
    </div>
  </div>
  <!--///////// FOOTER ///////////-->
<hr class="style-two">
<footer class="container-fluid text-center" style="background: linear-gradient(
	rgb(255, 255, 255, 0.9),rgba(255, 255, 255, 0.9)) no-repeat center center; color: var(--grundfarbe); padding: 0px;">
  <p style="margin: 20px 0 20px 0;max-width: unset;">Copyright © 2020 <a style="color: var(--grundfarbe)" href="agbs_datenschutz_impressum.html" target="_blank" title="LOCALMENU">LOCALMENU</a>. </br>Alle Rechte vorbehalten.</p>
</footer>
</div>
	</div>
</div>




</main>
<script>document.getElementsByTagName("html")[0].className += " js";</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="js/snap.svg-min.js"></script> 
<script src="js/main.js"></script> <!-- Resource jQuery -->
<script src="js/jquery-3.5.1.min.js"></script>
</body>
</html>

<!--///////// SCRIPTE ///////////-->
<script type="text/javascript">
/*
var frm = $('#register');
frm.submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);
    $.ajax({
        url: 'register.php',
        type: 'POST',
        data: formData,
        success: function (data) {
				  console.log("es folgt data aus register.php");
				  console.log(data);
                  var x = document.getElementById("snackbar");
                  // Add the "show" class to DIV
                  x.innerHTML = data;
                  x.className = "show";
                  // After 3 seconds, remove the show class from DIV
                  // alert("test");
                  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                  test();
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
*/
  async function test() {
      await Sleep(3000); 
      history.go(0);
    }
    function Sleep(milliseconds) {
      return new Promise(resolve => setTimeout(resolve, milliseconds));
    }
</script>