<?php 
require 'db.php';
session_start();

$email = $_SESSION['email'];

$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
$result_kunde = mysqli_fetch_assoc($result);
$name = utf8_encode($result_kunde['name']);
$first_name = utf8_encode($result_kunde['first_name']);
$last_name = utf8_encode($result_kunde['last_name']);
$strasse = utf8_encode($result_kunde['strasse']);
$hausnummer = utf8_encode($result_kunde['hausnummer']);
$ort = utf8_encode($result_kunde['ort']);
$postleitzahl = $result_kunde['postleitzahl'];
$telefonnummer = utf8_encode($result_kunde['telefonnummer']);
$speisekarte_direkt = $result_kunde['speisekarte_direkt'];
/*
$facebook = utf8_encode($result_kunde['facebook']);
$instagram = utf8_encode($result_kunde['instagram']);
$kunde_lieferung = utf8_encode($result_kunde['Kunde_LIEFERUNG']);
$kunde_abholung = utf8_encode($result_kunde['Kunde_ABHOLUNG']);
$kunde_meldung = utf8_encode($result_kunde['Kunde_MELDUNG']);
*/

?>

<?php
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "DU bist nicht eingeloggt!!";
  header("location: error.php");    
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
    $admin = $_SESSION['admin'];
    $id = $_SESSION['id'];
    $kundeid = $_SESSION['kunde_id'];
  }
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
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/style_artikel.css"> <!--Resource style -->
    <!-- jQuery library -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
<img class="image3" src="img/logo.png" style="max-height: 50px;width:auto;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="myNavbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div class="collapse navbar-collapse" id="myNavbar">
          <a class="nav-item nav-link" href="profile.php">Startseite</a>
          <a class="nav-item nav-link" href="">QR-Code</a>
          <a class="nav-item nav-link" href="">Speisekarte</a>
          <a class="nav-item nav-link" href="oeffnungszeiten.php">Öffnungszeiten</a>
          <a class="nav-item nav-link   active" href="einstellungen.php">Einstellungen</a>
          <a class="nav-item nav-link" href="">Druckauftrag</a>
          <a class="nav-item nav-link" href="">AGBs</a>
          <a class="nav-item nav-link" href="corona_liste.php">Corona-Einträge</a>
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
<div class="wrapper">
  <h1 class="header__title">Daten ändern</h1>
    <form class="needs-validation" id="data" enctype="multipart/form-data" validate style="display: flex; flex-direction: column;border:unset;">
    <div class="form-row" >
          <div class="col-md-12 mb-3">
          <label for="speisekarte">Speisekarte-Direktaufruf aktivieren</label>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="speisekarte" id="speisekarte" <?php if($speisekarte_direkt =='on'){ echo "checked";} ?>>
                <label class="custom-control-label" for="speisekarte">aktivieren</label>
              </div>
          </div>
      </div>
      <div class="form-row" >
          <div class="col-md-4 mb-3">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" id="name" name="name" placeholder="Name eingeben" value="<?php echo "" . $name; ?>">
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="form-group">
                <label for="first_name">Vorname</label>
                <input class="form-control" type="text" id="first_name" name="first_name" placeholder="Vorname eingeben" value="<?php echo "" . $first_name; ?>">
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="form-group">
                <label for="last_name">Nachname</label>
                <input class="form-control" type="text" id="last_name" name="last_name" placeholder="Nachname eingeben" value="<?php echo "" . $last_name; ?>">
            </div>
        </div>
      </div>
      <div class="form-row" >
        <div class="col-md-5 mb-3">
            <div class="form-group">
                <label for="strasse">Strasse</label>
                <input class="form-control" type="text" id="strasse" name="strasse" placeholder="Straße eingeben" value="<?php echo "" . $strasse; ?>">
            </div>
        </div>
        <div class="col-md-1 mb-3">
            <div class="form-group">
                <label for="nummer">Nummer</label>
                <input class="form-control" type="text" id="nummer" name="nummer" placeholder="Nummer eingeben" value="<?php echo "" . $hausnummer; ?>">
            </div>
        </div>
        <div class="col-md-2 mb-3">
          <div class="form-group">
                  <label for="plz">Postleitzahl</label>
                  <input class="form-control" type="text" id="plz" name="plz" placeholder="Postleitzahl eingeben" value="<?php echo "" . $postleitzahl; ?>">
          </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="form-group">
                    <label for="ort">Ort</label>
                    <input class="form-control" type="text" id="ort" name="ort" placeholder="Ort eingeben" value="<?php echo "" . $ort; ?>">
            </div>
        </div>
      </div>
      <div class="form-row" >
        <div class="col-md-12 mb-3">
              <div class="form-group">
                  <label for="telefonnummer">Telefonnummer</label>
                  <input type="text" class="form-control" id="telefonnummer" name="telefonnummer" placeholder="Telefonnummer eingeben" value="<?php echo "" . $telefonnummer; ?>">
              </div>
          </div>
      </div>
      <!--
      <div class="form-row" >
        <div class="col-md-4 mb-3">
              <div class="form-group">
                  <label for="kunde_instagram">Instagram-Link</label>
                  <input type="text" class="form-control" id="kunde_instagram" name="kunde_instagram" placeholder="Instagram-Link eingeben" value="<?php// echo "" . $kunde_instagram; ?>">
              </div>
          </div>
        <div class="col-md-4 mb-3">
            <div class="form-group">
                <label for="kunde_facebook">Facebook-Link</label>
                <input class="form-control" type="text" id="kunde_facebook" name="kunde_facebook" placeholder="Facebook-Link eingeben" value="<?php// echo "" . $kunde_facebook; ?>">
            </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="form-group">
                  <label for="kunde_whatsapp">WhatsApp-Nummer</label>
                  <input class="form-control" type="text" id="kunde_whatsapp" name="kunde_whatsapp" placeholder="WhatsApp Nummer eingeben" value="<?php// echo "" . $kunde_whatsapp; ?>">
              </div>
          </div>
      </div>
      <div class="form-row" >
          <div class="col-md-6 mb-3">
            <label for="kunde_lieferkosten">Lieferkosten</label>
            <input class="form-control" type="text" id="kunde_lieferkosten" name="kunde_lieferkosten" placeholder="Lieferkosten eingeben" value="<?php// echo "" . $kunde_lieferkosten; ?>">
          </div>
          <div class="col-md-6 mb-3">
              <label for="kunde_plz_aufteilung">Lieferkosten nach PLZ</label>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="kunde_plz_aufteilung" id="kunde_plz_aufteilung" <?php// if($kunde_plz_aufteilung =='on'){ echo "checked";}; ?>>
                <label class="custom-control-label" for="kunde_plz_aufteilung">aktivieren</label>
              </div>
          </div>
      </div>

      <div class="form-row" >
            <div class="form-group" style="width:100%;">
                <label for="kunde_beschreibung">Beschreibung</label>
                <textarea class="form-control" id="kunde_beschreibung" name="kunde_beschreibung" rows="3" ><?php // echo "" . $kunde_beschreibung; ?></textarea>
            </div>
            <div class="form-group" style="width:100%;margin-bottom: 10px!important;">
                <label for="kunde_meldung">Info-Mitteilung</label>
                <textarea class="form-control" id="kunde_meldung" name="kunde_meldung" rows="3" ><?php// echo "" . $kunde_meldung; ?></textarea>
            </div>
      </div>
      -->
      <button class="btn btn-primary" id="absenden" type="submit" style=" max-width: 200px;margin: auto;display: block;left: 0;right: 0;">Daten speichern</button>
    </form>
  </div> <!-- Wrapper ende -->    
  </div> <!-- container Ende -->      
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script>
if (isEmpty($('#message'))) {
    $('#message').hide();
  }else{
    $('#message').show();
    $('#message').delay(3000).fadeOut('slow');
    setTimeout(function() {
      $('#message').empty();
    }, 3000);
  }
  function isEmpty( el ){
        return !$.trim(el.html())
  }
</script>

<script type="text/javascript">

$("form#data").submit(function(e) {
    e.preventDefault();    
    // var artikelklasse = document.getElementById("artikelklasse").value;
    var formData = new FormData(this);

    $.ajax({
        url: 'kundendaten_update.php',
        type: 'POST',
        data: formData,
        success: function (data) {
                  var x = document.getElementById("snackbar");
                  // Add the "show" class to DIV
                  x.innerHTML = data;
                  x.className = "show";
                  // After 3 seconds, remove the show class from DIV
                  // alert("test");
                  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                  test();
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