<?php 
require 'db.php';
session_start();
$email = $mysqli->escape_string($_SESSION['email']);
// $email = 'tarkan.acur@live.de';
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
if (!isset($result)) {
  $_SESSION['message'] = "Dein Account wurde gelöscht.";
  header("location: error.php");
}
$result1 = mysqli_fetch_assoc($result);
$result_id = $result1['id'];
$profilbild = $result1['profilbild'];
$tagesmenu = $result1['tagesmenu'];

$result_tagesmenu = $mysqli->query("SELECT * FROM Tagesmenu WHERE Kunden_ID='$result_id'");
$result_TM = mysqli_fetch_assoc($result_tagesmenu);
$result_TM_Pfad = $result_TM['tagesmenu_PFAD'];
?>

<?php
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "DU bist nicht eingeloggt!!";
  header("location: error.php");    
}
else {
    // Makes it easier to read
    $name = $_SESSION['name'];
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
    $admin = $_SESSION['admin'];
    $id = $_SESSION['id'];
    echo "<input id='kundenid' value='" .  $id . "' hidden>";
    $profilbild = $_SESSION['profilbild'];
    $kundeid = utf8_decode($_SESSION['kunde_id']);}
?>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['logout'])) { require 'logout.php';}

} 
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <title>Willkommen <?= $first_name.' '.$last_name ?></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/style_profile.css"> <!--Resource style -->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link  href="css/cropper.css" rel="stylesheet">
    <script src="js/cropper.js"></script>
    <script src="js/jquery-cropper.js"></script>
    <script src="js/myapp.js"></script>
    <script src="js/easy.qrcode.min.js"></script>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
<img class="image3" src="img/logo.png" style="max-height: 50px;width:auto;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="myNavbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div class="collapse navbar-collapse" id="myNavbar">
          <a class="nav-item nav-link  " href="profile.php">Startseite</a>
          <a class="nav-item nav-link active" href="tagesmenu.php">Tagesmenu</a>
          <a class="nav-item nav-link" href="oeffnungszeiten.php">Öffnungszeiten</a>
          <a class="nav-item nav-link" href="einstellungen.php">Einstellungen</a>
          <a class="nav-item nav-link" href="corona_liste.php">Corona-Einträge</a>
          <!--<a class="nav-item nav-link" href="">QR-Code</a>
          <a class="nav-item nav-link" href="">Speisekarte</a>
          <a class="nav-item nav-link" href="">Druckauftrag</a>
          -->
          <?php if ($administrator == '1315'){
          echo '<a class="nav-item nav-link" href="kundenmanagement.php">Kundenmanagement</a>';
            }
          ?>
      <ul class="nav navbar-nav navbar navbar-right ">
        <li><a href="logout.php" class="btn btn-danger btn-lg btn-block" method="post" name="logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div id="snackbar"></div>

<div class="container">
<!-- NACHRICHT WEGEN VERIFIKATION DES ACCOUNTS -->
              <?php
                 if ($active != 1){
                  echo '<div class="alert alert-warning"><strong>ACHTUNG!</strong><ul class="list-group">
                    <li class="list-group-item list-group-item-danger">Account nicht verifiziert</li>
                    <li class="list-group-item list-group-item-warning">Account Nutzung ist eingeschränkt!</li>
                  </ul></div>
                  ';
                 }else{
                  echo '';
                 }
              ?>
              
              <?php 
                    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ) {
                      echo '<div id="message" class="alert alert-danger" role="alert" style="position: absolute;top: 55px;width: 90%;">' . $_SESSION['message'] . '</div>'; 
                    }                           
                ?>
              
</div>
<div class="container">
<!--
<div class="card text-white bg-dark mb-3" style="overflow: hidden;min-width: 100%;border-radius: 2rem;background: var(--secondary);
  box-shadow: 2px 3px 13px rgba(0,0,0,0.75), 0 10px 10px rgba(0,0,0,0.22);border: unset;">
    <div class="card-header">Tagesmenu Tagesauswahl</div>
    <div class="card-body">
      <form class="was-validated" id="tagesmenu_update" enctype="multipart/form-data" method="post">
        <div class="form-check">
            <input id="montag" class="form-check-input" type="checkbox" name="montag"/><label for="montag">Montag</label>
        </div>
        <div class="form-check">
            <input id="dienstag" class="form-check-input" type="checkbox" name="dienstag"/><label for="dienstag">Dienstag</label>
        </div>
        <div class="form-check">
            <input id="mittwoch" class="form-check-input" type="checkbox" name="mittwoch"/><label for="mittwoch">Mittwoch</label>
        </div>
        <div class="form-check">
            <input id="donnerstag" class="form-check-input" type="checkbox" name="donnerstag"/><label for="donnerstag">Donnerstag</label>
        </div>
        <div class="form-check">
            <input id="freitag" class="form-check-input" type="checkbox" name="freitag"/><label for="freitag">Freitag</label>
        </div>
        <div class="form-check">
            <input id="samstag" class="form-check-input" type="checkbox" name="samstag"/><label for="samstag">Samstag</label>
        </div>
        <div class="form-check">
            <input id="sonntag" class="form-check-input" type="checkbox" name="sonntag"/><label for="sonntag">Sonntag</label>
        </div>
        <br>
        <button class="btn btn-primary" type="submit">Einstellungen speichern</button>
      </form>       
  </div>
</div>
-->
  <div class="card text-white bg-dark mb-3" style="overflow: hidden;min-width: 100%;border-radius: 2rem;background: var(--secondary);
  box-shadow: 2px 3px 13px rgba(0,0,0,0.75), 0 10px 10px rgba(0,0,0,0.22);border: unset;">
    <div class="card-header">Tagesmenu</div>
    <div class="card-body">
    <h6 class="card-subtitle mb-2 text-muted">Dateigröße unter	5	MB empfohlen.	Komprimieren	Sie	Ihre	Datei	und	Fragen	Sie	bei	uns	nach.</h6>
      <div class="custom-file">
      <form class="was-validated" id="tagesmenu" enctype="multipart/form-data" method="post">
        <div class="form-row">
            <input type="file" class="custom-file-input" id="validatedCustomFile" name="tagesmenu" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" required>
            <label class="custom-file-label" for="validatedCustomFile">Tagesmenu auswählen</label>
            <div class="invalid-feedback">Datei muss augewählt werden</div>
          </div>
        </div>
        <br>
        <br>
        <button class="btn btn-primary" type="submit">Tagesmenu aktualisieren</button>
        <h3>Aktuelles Tagesmenu</h3>
        <?php 
                if ($tagesmenu == "1"){
                  echo '<iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=http://dev.localmenu.de/'. $result_TM_Pfad.'" width="100%" height="500px"> </iframe>';
                }else{
                  echo '<iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=http://dev.localmenu.de/dateien/tagesmenu.pdf" width="100%" height="500px"> </iframe>';
                }
        ?>
        <br>
        <?php 
                if ($tagesmenu == "1"){
                  echo '<a class="btn btn-primary" href="'. $result_TM_Pfad.'" download>Tagesmenu herunterladen</a>';
                }else{
                  echo '<a class="btn btn-primary" href="Kunden/tagesmenu/tagesmenu.pdf" download>Tagesmenu herunterladen</a>';
                }
        ?>
        <br>
      </form> 
      <br>
      <!--<button type="button" id="download_speisekarte" class="btn btn-primary btn-lg btn-block">Speisekarte herunterladen</button>--></p>
    </div>
  </div>
</div>
<hr class="style-two">
	<footer class="container-fluid text-footer" style="text-align:center;">
	<!-- <p><a style="font-size: 12px;" href="#myModal2" class="links" id="modal-trigger2" data-toggle="modal">Allgemeine Geschäftsbedingungen</a></p> -->
	<p><a style="font-size: 12px;" href="agbs_datenschutz_impressum.html" class="links" target="_blank">Allgemeine Geschäftsbedingungen</a></p>
	<p><a style="font-size: 12px;" href="agbs_datenschutz_impressum.html" class="links" target="_blank">Datenschutzerklärung</a></p>
	<p><a style="font-size: 12px;" href="agbs_datenschutz_impressum.html" class="links" target="_blank">Impressum</a></p>
	<hr class="style-two">
	<p style="margin-top: 20px;;">Copyright © 2020 <a style="color: var(--grundfarbe)" href="agbs_datenschutz_impressum.html" target="_blank" title="LOCALMENU">LOCALMENU</a>. </br>Alle Rechte vorbehalten.</p>
	</footer>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>


<script type="text/javascript">
var frm = $('#tagesmenu');
frm.submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);
    $.ajax({
        url: 'tagesmenu_upload.php',
        type: 'POST',
        data: formData,
        success: function (data) {
                  console.log("es folgt data aus tagesmenu_upload.php");
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
var frm = $('#tagesmenu_update');
frm.submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);
    $.ajax({
        url: 'tagesmenu_update.php',
        type: 'POST',
        data: formData,
        success: function (data) {
                  console.log("es folgt data aus tagesmenu_update.php");
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

  async function test() {
      await Sleep(3000); 
      history.go(0);
    }
    function Sleep(milliseconds) {
      return new Promise(resolve => setTimeout(resolve, milliseconds));
    }
</script>
</body>
</html>