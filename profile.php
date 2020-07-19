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
$speisekarte = $result1['speisekarte'];
$speisekarte_direkt = $result1['speisekarte_direkt'];
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
    /*
    if (isset($_POST['stornieren'])) { require 'bestellung_stornieren.php';}
    if (isset($_POST['aufnehmen'])) { require 'bestellung_aufnehmen.php';}
    if (isset($_POST['beenden'])) { require 'bestellungen_beenden.php';}
    if (isset($_POST['abbrechen'])) { require 'bestellungen_abbrechen.php';}
    */
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
          <a class="nav-item nav-link  active" href="profile.php">Startseite</a>
          <a class="nav-item nav-link" href="tagesmenu.php">Tagesmenu</a>
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
<div class="well">
<div class="container">
              <table>
                <tbody>
                  <tr>
                  <th><?php echo '<img class="image1" src="img/profilbild.png" class="rounded float-left" alt="...">'; ?></th>
                  <th><h2><?php echo $name; ?></h2><h6><?php echo $first_name.' '.$last_name; ?></h6><h6><?= $email ?></h6>
                    <?php if (!$admin){
                            echo '<h5><ins>Status</ins>: <b>Free-Account</b></h5>';
                    }else{  echo '<h5><ins>Status</ins>: <b>Premium-Account</b></h5>';} ?>
                  </th>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
</div>
</div>

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
  <div class="card bg-light mb-3" style="margin-top:10px;overflow: hidden;min-width: 100%;border-radius: 2rem;background: var(--secondary);
  box-shadow: 2px 3px 13px rgba(0,0,0,0.75), 0 10px 10px rgba(0,0,0,0.22);border: unset;">
    <div class="card-header">QR-Code</div>
    <div class="card-body">
      <p class="card-text" >
          <div id="qrcode" style="text-align: center;"></div>
          <br>
          <button type="button" id="download" class="btn btn-primary btn-lg btn-block">Als PDF herunterladen</button>
      </p>
    </div>
  </div>
  <div class="card text-white bg-dark mb-3" style="overflow: hidden;min-width: 100%;border-radius: 2rem;background: var(--secondary);
  box-shadow: 2px 3px 13px rgba(0,0,0,0.75), 0 10px 10px rgba(0,0,0,0.22);border: unset;">
    <div class="card-header">Speisekarte</div>
    <div class="card-body">
    <h6 class="card-subtitle mb-2 text-muted">Dateigröße unter	5	MB empfohlen.	Komprimieren	Sie	Ihre	Datei	und	Fragen	Sie	bei	uns	nach.</h6>
      <div class="custom-file">
      <form class="was-validated" id="speisekarte" enctype="multipart/form-data" method="post">
        <div class="form-row">
            <input type="file" class="custom-file-input" id="validatedCustomFile" name="speisekarte" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" required>
            <label class="custom-file-label" for="validatedCustomFile">Speisekarte auswählen</label>
            <div class="invalid-feedback">Datei muss augewählt werden</div>
          </div>
        </div>
        <br>
        <br>
        <button class="btn btn-primary" type="submit">Speisekarte aktualisieren</button>
        <h3>Aktuelle Speisekarte</h3>
        <?php 
                if ($speisekarte == "1"){
                  echo '<iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=http://localmenu.de/Kunden/'. $result_id.'/speisekarte/speisekarte.pdf" width="100%" height="500px"> </iframe>';
                }else{
                  echo '<iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=http://localmenu.de/dateien/speisekarte.pdf" width="100%" height="500px"> </iframe>';
                }
        ?>
        <br>
        <?php 
                if ($speisekarte == "1"){
                  echo '<a class="btn btn-primary" href="Kunden/'. $result_id.'/speisekarte/speisekarte.pdf" download>Speisekarte herunterladen</a>';
                }else{
                  echo '<a class="btn btn-primary" href="Kunden/speisekarte/speisekarte.pdf" download>Speisekarte herunterladen</a>';
                }
        ?>
        <br>
      </form> 
      <br>
      <!--<button type="button" id="download_speisekarte" class="btn btn-primary btn-lg btn-block">Speisekarte herunterladen</button>--></p>
    </div>
  </div>
  <div class="card text-white bg-dark mb-3" style="overflow: hidden;min-width: 100%;border-radius: 2rem;background: var(--secondary);
  box-shadow: 2px 3px 13px rgba(0,0,0,0.75), 0 10px 10px rgba(0,0,0,0.22);border: unset;">
    <div class="card-body">
    <h2>Aktuelles Logo</h2>
    <?php
                  if ($profilbild == "1"){
                    echo '<img src="Kunden/'.$result_id.'/logo/logo.png" class="headshot">';
                  }else{
                    echo '<img src="img/profilbild.png" class="headshot">';
                  }
          ?>
      <h5 class="card-title">Neues Logo hochladen</h5>
      <div class="custom-file">
      
      <form class="was-validated" id="logo" enctype="multipart/form-data" method="post">
        <div class="form-row">
            <input type="file" class="custom-file-input" id="validatedCustomFile2" name="logo" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" required>
            <label class="custom-file-label" for="validatedCustomFile">Logo auswählen</label>
            <div class="invalid-feedback">Datei muss augewählt werden</div>
          </div>
        </div>
        <br>
        <br>
        <button class="btn btn-primary" type="submit">Logo hochladen</button>
        </form> 
        <h2>Logo zuschneiden</h2>
        <!-- Wrap the image or canvas element with a block element (container) -->
        <div style="overflow: hidden;margin-bottom: 20px;">
          <?php
                  if ($profilbild == "1"){
                    echo '<img id="logocropp" src="Kunden/'.$result_id.'/logo/logo.png" style="display: block;max-width: 100%;">';
                  }else{
                    echo '<img id="logocropp" src="img/profilbild.png" style="display: block;max-width: 100%;">';
                  }
          ?>
          
        </div>
        <h2>Vorschau Logo</h2>
        <!--<iframe src="Kunden/<?php //echo $kundeid; ?>/logo/logo.png" width="100%" height="700px"> </iframe>-->
        <div class="img-preview headshot">
        </div>
        <br>
        <button class="btn btn-primary" onclick="crop();">Logo speichern</button>
      
      <br>
      <!--<button type="button" id="download_speisekarte" class="btn btn-primary btn-lg btn-block">Speisekarte herunterladen</button>--></p>
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

<script>
  $(function () {
        $("#logocropp").cropper({
            zoomable: true,
            aspectRatio: 1 / 1,
            cropBoxResizable: true,
            preview: '.img-preview'
        });
    });
  // QR-Code Generator
	$(document).ready(function(){ 
	 	var id = document.getElementById("kundenid").value;
		 if (id) {
			console.log("ID = " + id);
		 }
		 var qrcode = new QRCode(document.getElementById("qrcode"), {
			text: "https://localmenu.de/?kunde=<?php echo $result_id; ?>",
      logo: "img/qrcode_logo.png",
      PO: '#000000',
      PI: '#209850',
			logoWidth: undefined,
			logoHeight: undefined,
			logoBackgroundColor: '#ffffff',
			logoBackgroundTransparent: false
		});
  });

  //PDF Generator
  document.querySelector("#download").onclick = function () {
  var img = new Image();
  img.src = $("#qrcode");
  var pdf = new jsPDF("p", "mm", "a4");
  var canvas = document.getElementsByTagName("canvas");
  var imgSrc = canvas[0].toDataURL("image/png");
  pdf.text ("Dein QR-Code zum Ausschneiden", 20, 30);
  pdf.text ("Wetterfeste Sticker? Individuelles Logo? Sprechen Sie uns an!", 20, 35);
  pdf.setProperties({
    title: 'PDF mit QR-Code erstellen',
    subject: 'PDF mit Javascript erstellt',
    author: 'LocalMenu',
    keywords: 'generated, javascript,jspdf',
    creator: 'Javascript jsPDF'
  });
  pdf.addImage(imgSrc, 'png', 20, 40, 50, 50);
  pdf.addImage(imgSrc, 'png', 20, 100, 50, 50);
  pdf.addImage(imgSrc, 'png', 20, 160, 50, 50);
  pdf.addImage(imgSrc, 'png', 20, 220, 50, 50);
  pdf.addImage(imgSrc, 'png', 80, 40, 50, 50);
  pdf.addImage(imgSrc, 'png', 80, 100, 50, 50);
  pdf.addImage(imgSrc, 'png', 80, 160, 50, 50);
  pdf.addImage(imgSrc, 'png', 80, 220, 50, 50);
  pdf.addImage(imgSrc, 'png', 140, 40, 50, 50);
  pdf.addImage(imgSrc, 'png', 140, 100, 50, 50);
  pdf.addImage(imgSrc, 'png', 140, 160, 50, 50);
  pdf.addImage(imgSrc, 'png', 140, 220, 50, 50);
  pdf.text ("www.localmenu.de", 80, 280);
  pdf.save ("qrcode.pdf");
}
/*
download.addEventListener("click", function() {
  // only jpeg is supported by jsPDF
  var canvas = document.getElementById('qrcode');
  var imgData = canvas.toDataURL("image/jpeg", 1.0);
  var pdf = new jsPDF();

  pdf.addImage(imgData, 'JPEG', 0, 0);
  pdf.save("qrcode.pdf");
}, false);
*/
</script>
<script type="text/javascript">
var frm = $('#speisekarte');
frm.submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);
    $.ajax({
        url: 'speisekarte_upload.php',
        type: 'POST',
        data: formData,
        success: function (data) {
                  console.log("es folgt data aus register.php");
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

function crop() {
    // Blob is a textual form of an image which will be obtained from <img> tag
    $("#logocropp").cropper("getCroppedCanvas").toBlob(function (blob) {
              // FormData is a built-in javascript object
        var formData = new FormData();
        formData.append("croppedImage", blob);
 
        $.ajax({
            url: "logocropped_upload.php", // name of the file which we will be creating soon
            method: "POST",
            data: formData,
            processData: false, // necessary for sending image data
            contentType: false, // necessary for sending image data
            success: function (data) {
                  console.log("es folgt data aus register.php");
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
}

var frml = $('#logo');
frml.submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);
    $.ajax({
        url: 'logo_upload.php',
        type: 'POST',
        data: formData,
        success: function (data) {
                  console.log("es folgt data aus register.php");
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