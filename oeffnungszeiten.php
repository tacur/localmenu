<?php 
require 'db.php';
session_start();

$kundeid = $_SESSION['id'];

$result = $mysqli->query("SELECT * FROM oeffnungszeiten WHERE Kunden_ID ='$kundeid'");
$result1 = mysqli_fetch_assoc($result);
$montagstart = $result1['MONTAG_START'];
$montagende = $result1['MONTAG_ENDE'];
$montaggeschlossen = $result1['MONTAG_GESCHLOSSEN'];
$montagopenend = $result1['MONTAG_OPENEND'];      
$dienstagstart = $result1['DIENSTAG_START'];
$dienstagende = $result1['DIENSTAG_ENDE'];
$dienstaggeschlossen = $result1['DIENSTAG_GESCHLOSSEN'];
$dienstagopenend = $result1['DIENSTAG_OPENEND'];        
$mittwochstart = $result1['MITTWOCH_START'];
$mittwochende = $result1['MITTWOCH_ENDE'];
$mittwochgeschlossen = $result1['MITTWOCH_GESCHLOSSEN'];
$mittwochopenend = $result1['MITTWOCH_OPENEND'];        
$donnerstagstart = $result1['DONNERSTAG_START'];
$donnerstagende = $result1['DONNERSTAG_ENDE'];
$donnerstaggeschlossen = $result1['DONNERSTAG_GESCHLOSSEN'];
$donnerstagopenend = $result1['DONNERSTAG_OPENEND'];        
$freitagstart = $result1['FREITAG_START'];
$freitagende = $result1['FREITAG_ENDE'];
$freitaggeschlossen = $result1['FREITAG_GESCHLOSSEN'];
$freitagopenend = $result1['FREITAG_OPENEND'];         
$samstagstart = $result1['SAMSTAG_START'];
$samstagende = $result1['SAMSTAG_ENDE'];
$samstaggeschlossen = $result1['SAMSTAG_GESCHLOSSEN'];
$samstagopenend = $result1['SAMSTAG_OPENEND'];      
$sonntagstart = $result1['SONNTAG_START'];
$sonntagende = $result1['SONNTAG_ENDE'];
$sonntaggeschlossen = $result1['SONNTAG_GESCHLOSSEN'];
$sonntagopenend = $result1['SONNTAG_OPENEND'];           

$mitteilung1 = $result1['Mitteilung_1'];
$mitteilung2 = $result1['Mitteilung_2'];
/*
$resultw = $mysqli->query("SELECT * FROM users WHERE active = '1'");
$results = $mysqli->query("SELECT * FROM users WHERE active = '0'");
$result1 = $mysqli->query("SELECT * FROM aufgaben WHERE auftragnehmer = '$email' AND DATE(deadline) >= DATE(NOW()) ORDER BY deadline ASC");
$result2 = $mysqli->query("SELECT * FROM aufgaben WHERE auftraggeber = '$email' ORDER BY deadline");
$result21 = $mysqli->query("SELECT * FROM aufgaben, announcement");
$result3 = $mysqli->query("SELECT * FROM zeit WHERE email1 ='$email'");
$result5 = $mysqli->query("SELECT * FROM announcement WHERE DATE(datum) >= DATE(NOW()) ORDER BY datum ASC");
$result51 = $mysqli->query("SELECT * FROM announcement WHERE DATE(datum) >= DATE(NOW()) ORDER BY datum ASC");
$querypie = $mysqli->query("SELECT * FROM aufgaben WHERE auftragnehmer = 'tarkan.acur@live.de'")->num_rows;
$querypie1 = $mysqli->query("SELECT * FROM aufgaben WHERE auftragnehmer = 'acur@baubetrieb.uni-hannover.de'")->num_rows;
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
    $kundeid = $_SESSION['kunde_id'];}
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
          <a class="nav-item nav-link  " href="profile.php">Startseite</a>
          <a class="nav-item nav-link" href="tagesmenu.php">Tagesmenu</a>
          <a class="nav-item nav-link active" href="oeffnungszeiten.php">Öffnungszeiten</a>
          <a class="nav-item nav-link " href="einstellungen.php">Einstellungen</a>
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
<div class="wrapper">
  <h1 class="header__title">Öffnungszeiten ändern</h1>
    <form class="needs-validation" id="data" enctype="multipart/form-data" validate style="display: flex; flex-direction: column;border:unset;">
    <!--  
    <div class="form-row" style="display:flex;margin: 0!important;padding: 5px 0px;">
        <div class="col-md-2 mb-3"><label >Tag</label></div>
        <div class="col-md-4 mb-3"> <label >Startzeit</label></div>
        <div class="col-md-4 mb-3"> <label >Endzeit</label></div>
        <div class="col-md-2 mb-3"> <label ></label></div>
      </div>
    -->
      <div class="form-row" >
        <div class="col-md-2 mb-3" style="max-width: 40%!important;">
          <label for="artikelname">Montag</label>
        </div>
        <div class="col-md-6 mb-3" style="display:flex;margin: 0!important;padding: 5px 0px;">
          <input type="time" class="form-control" id="montagstart" placeholder="Startzeit" value="<?php echo "" . $montagstart; ?>" name="montagstart" required>
          <input type="time" class="form-control" id="montagende" placeholder="Endzeit" value="<?php echo "" . $montagende; ?>" name="montagende" required>
        </div>
        <div class="col-md-2 mb-3">
          <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="montagaktiv" id="montagaktiv" <?php if($montaggeschlossen =='on'){ echo "checked";}?>>
              <label class="custom-control-label" for="montagaktiv">Geschlossen</label>
            </div>
        </div>
        <div class="col-md-2 mb-3">
          <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="montagopenend" id="montagopenend" <?php if($montagopenend =='on'){ echo "checked";}?>>
              <label class="custom-control-label" for="montagopenend">OpenEnd</label>
            </div>
        </div>
      </div>
      <div class="form-row" >
        <div class="col-md-2 mb-3" style="max-width: 40%!important;">
          <label for="artikelname">Dienstag</label>
        </div>
        <div class="col-md-6 mb-3" style="display:flex;margin: 0!important;padding: 5px 0px;">
          <input type="time" class="form-control" id="dienstagstart" placeholder="Startzeit" value="<?php echo "" . $dienstagstart; ?>" name="dienstagstart" required>
          <input type="time" class="form-control" id="dienstagende" placeholder="Endzeit" value="<?php echo "" . $dienstagende; ?>" name="dienstagende" required>
        </div>
        <div class="col-md-2 mb-3">
          <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="dienstagaktiv" id="dienstagaktiv" <?php if($dienstaggeschlossen =='on'){ echo "checked";}?>>
              <label class="custom-control-label" for="dienstagaktiv">Geschlossen</label>
          </div>
        </div>
        <div class="col-md-2 mb-3">
          <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="dienstagopenend" id="dienstagopenend" <?php if($dienstagopenend =='on'){ echo "checked";}?>>
              <label class="custom-control-label" for="dienstagopenend">OpenEnd</label>
            </div>
        </div>
      </div>
      <div class="form-row" >
        <div class="col-md-2 mb-3" style="max-width: 40%!important;">
          <label for="artikelname">Mittwoch</label>
        </div>
        <div class="col-md-6 mb-3" style="display:flex;margin: 0!important;padding: 5px 0px;">
          <input type="time" class="form-control" id="mittwochstart" placeholder="Startzeit" value="<?php echo "" . $mittwochstart; ?>" name="mittwochstart" required>
          <input type="time" class="form-control" id="mittwochende" placeholder="Endzeit" value="<?php echo "" . $mittwochende; ?>" name="mittwochende" required>
        </div>
        <div class="col-md-2 mb-3">
          <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="mittwochaktiv" id="mittwochaktiv" <?php if($mittwochgeschlossen =='on'){ echo "checked";}?>>
              <label class="custom-control-label" for="mittwochaktiv">Geschlossen</label>
            </div>
        </div>
        <div class="col-md-2 mb-3">
          <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="mittwochopenend" id="mittwochopenend" <?php if($mittwochopenend =='on'){ echo "checked";}?>>
              <label class="custom-control-label" for="mittwochopenend">OpenEnd</label>
            </div>
        </div>
      </div>
      <div class="form-row" >
        <div class="col-md-2 mb-3" style="max-width: 40%!important;">
          <label for="artikelname">Donnerstag</label>
        </div>
        <div class="col-md-6 mb-3" style="display:flex;margin: 0!important;padding: 5px 0px;">
          <input type="time" class="form-control" id="donnerstagstart" placeholder="Startzeit" value="<?php echo "" . $donnerstagstart; ?>" name="donnerstagstart" required>
          <input type="time" class="form-control" id="donnerstagende" placeholder="Endzeit" value="<?php echo "" . $donnerstagende; ?>" name="donnerstagende" required>
        </div>
        <div class="col-md-2 mb-3">
          <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="donnerstagaktiv" id="donnerstagaktiv" <?php if($donnerstaggeschlossen =='on'){ echo "checked";}?>>
              <label class="custom-control-label" for="donnerstagaktiv">Geschlossen</label>
            </div>
        </div>
        <div class="col-md-2 mb-3">
          <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="donnerstagopenend" id="donnerstagopenend" <?php if($donnerstagopenend =='on'){ echo "checked";}?>>
              <label class="custom-control-label" for="donnerstagopenend">OpenEnd</label>
            </div>
        </div>
      </div>
      <div class="form-row" >
        <div class="col-md-2 mb-3" style="max-width: 40%!important;">
          <label for="artikelname">Freitag</label>
        </div>
        <div class="col-md-6 mb-3" style="display:flex;margin: 0!important;padding: 5px 0px;margin: 0!important;padding: 5px 0px;">
          <input type="time" class="form-control" id="freitagstart" placeholder="Startzeit" value="<?php echo "" . $freitagstart; ?>" name="freitagstart" required>
          <input type="time" class="form-control" id="freitagende" placeholder="Endzeit" value="<?php echo "" . $freitagende; ?>" name="freitagende" required>
        </div>
        <div class="col-md-2 mb-3">
          <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="freitagaktiv" id="freitagaktiv" <?php if($freitaggeschlossen =='on'){ echo "checked";}?>>
              <label class="custom-control-label" for="freitagaktiv">Geschlossen</label>
            </div>
        </div>
        <div class="col-md-2 mb-3">
          <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="freitagopenend" id="freitagopenend" <?php if($freitagopenend =='on'){ echo "checked";}?>>
              <label class="custom-control-label" for="freitagopenend">OpenEnd</label>
            </div>
        </div>
      </div>
      <div class="form-row" >
        <div class="col-md-2 mb-3" style="max-width: 40%!important;">
          <label for="artikelname">Samstag</label>
        </div>
        <div class="col-md-6 mb-3" style="display:flex;margin: 0!important;padding: 5px 0px;">
          <input type="time" class="form-control" id="samstagstart" placeholder="Startzeit" value="<?php echo "" . $samstagstart; ?>" name="samstagstart" required>
          <input type="time" class="form-control" id="samstagende" placeholder="Endzeit" value="<?php echo "" . $samstagende; ?>" name="samstagende" required>
        </div>
        <div class="col-md-2 mb-3">
          <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="samstagaktiv" id="samstagaktiv" <?php if($samstaggeschlossen =='on'){ echo "checked";}?>>
              <label class="custom-control-label" for="samstagaktiv">Geschlossen</label>
            </div>
        </div>
        <div class="col-md-2 mb-3">
          <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="samstagopenend" id="samstagopenend" <?php if($samstagopenend =='on'){ echo "checked";}?>>
              <label class="custom-control-label" for="samstagopenend">OpenEnd</label>
            </div>
        </div>
      </div>
      <div class="form-row" >
        <div class="col-md-2 mb-3" style="max-width: 40%!important;">
          <label for="artikelname">Sonntag</label>
        </div>
        <div class="col-md-6 mb-3" style="display:flex;margin: 0!important;padding: 5px 0px;">
          <input type="time" class="form-control" id="sonntagstart" placeholder="Startzeit" value="<?php echo "" . $sonntagstart; ?>" name="sonntagstart" required>
          <input type="time" class="form-control" id="sonntagende" placeholder="Endzeit" value="<?php echo "" . $sonntagende; ?>" name="sonntagende" required>
        </div>
        <div class="col-md-2 mb-3">
          <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="sonntagaktiv" id="sonntagaktiv" <?php if($sonntaggeschlossen =='on'){ echo "checked";}?>>
              <label class="custom-control-label" for="sonntagaktiv">Geschlossen</label>
            </div>
        </div>
        <div class="col-md-2 mb-3">
          <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="sonntagopenend" id="sonntagopenend" <?php if($sonntagopenend =='on'){ echo "checked";}?>>
              <label class="custom-control-label" for="sonntagopenend">OpenEnd</label>
            </div>
        </div>
      </div>
      <div class="form-row" >
        <div class="form-group" style="width:100%;">
          <label for="exampleFormControlTextarea1">Mitteilung 1</label>
          <textarea style="margin: 10px 0px!important;" class="form-control" id="mitteilung1" name="mitteilung1" rows="3" ><?php echo "" . $mitteilung1; ?></textarea>
        </div>
      </div>
      <div class="form-row" >
        <div class="form-group" style="width:100%;">
          <label for="exampleFormControlTextarea1">Mitteilung 2</label>
          <textarea style="margin: 10px 0px!important;" class="form-control" id="mitteilung2" name="mitteilung2" rows="3" ><?php echo "" . $mitteilung2; ?></textarea>
        </div>
      </div>
      <button class="btn btn-primary" type="submit" style=" max-width: 200px;margin: auto;display: block;left: 0;right: 0;">Öffnungszeiten speichern</button>
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
        url: 'oeffnungszeiten_update.php',
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

  function bestellung() {
    if (event.srcElement.name == 'abbrechen'){
      $.post("bestellung_abbrechen.php",{
                  bestellung: event.srcElement.value
                } , function(data,status) {  
                  // Get the snackbar DIV
                  var x = document.getElementById("snackbar");
                  // Add the "show" class to DIV
                  x.innerHTML = data;
                  x.className = "show";
                  // After 3 seconds, remove the show class from DIV
                  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                  test();
      }); 
    }
    if (event.srcElement.name == 'stornieren') {
      $.post("bestellung_stornieren.php",{
                  bestellung: event.srcElement.value
                } , function(data,status) {
                  // Get the snackbar DIV
                  var x = document.getElementById("snackbar");
                  // Add the "show" class to DIV
                  x.innerHTML = data;
                  x.className = "show";
                  // After 3 seconds, remove the show class from DIV
                  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                  test();
      }); 
    }
    if (event.srcElement.name == 'beenden') {
      $.post("bestellung_beenden.php",{
                    bestellung: event.srcElement.value
                } , function(data,status) {
                  // Get the snackbar DIV
                  var x = document.getElementById("snackbar");
                  // Add the "show" class to DIV
                  x.innerHTML = data;
                  x.className = "show";
                  // After 3 seconds, remove the show class from DIV
                  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                  test();
      }); 
    }
    if (event.srcElement.name == 'aufnehmen') {
      $.post("bestellung_aufnehmen.php",{
                    bestellung: event.srcElement.value
                } , function(data,status) {                  
                  // Get the snackbar DIV
                  var x = document.getElementById("snackbar");
                  // Add the "show" class to DIV
                  x.innerHTML = data;
                  x.className = "show";
                  // After 3 seconds, remove the show class from DIV
                  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                  test();
      }); 
    }
    async function test() {
      await Sleep(3000); 
      history.go(0);
    }
    function Sleep(milliseconds) {
      return new Promise(resolve => setTimeout(resolve, milliseconds));
    }
  }
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