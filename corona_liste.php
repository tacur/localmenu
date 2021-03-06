<?php 
require 'db.php';
session_start();

$email = $_SESSION['email'];
$kundeid = $_SESSION['kunde_id'];

$result3 = $mysqli->query("SELECT * FROM corona WHERE kundenid='$kundeid' ORDER BY startzeit ASC");
$result4 = $mysqli->query("SELECT * FROM corona WHERE kundenid='$kundeid' ORDER BY startzeit ASC");
// $result4 = $mysqli->query("SELECT DISTINCT * FROM corona WHERE kundenid='$kundeid' ORDER BY startzeit DESC");

?>

<?php
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "DU bist nicht eingeloggt!!";
  header("location: error.php");    
}
else {
  
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
    $admin = $_SESSION['admin'];
    $administrator = $_SESSION['administrator'];
    $id = $_SESSION['id'];
    $profilbild = $_SESSION['profilbild'];
    $monatsstunden = $_SESSION['monatsstunden'];
    $kundeid = $_SESSION['kunde_id'];
    $kundefahrten = $_SESSION['kunde_fahrten'];
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
    <!-- Latest compiled and minified CSS 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    -->
    <link rel="stylesheet" href="css/style_profile.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <!-- jQuery library -->
    <!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/myapp.js"></script>
    -->
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
          <a class="nav-item nav-link " href="oeffnungszeiten.php">Öffnungszeiten</a>
          <a class="nav-item nav-link " href="einstellungen.php">Einstellungen</a>
          <a class="nav-item nav-link active" href="corona_liste.php">Corona-Einträge</a>
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
<div class="cd-popup" id="cd-corona" role="alert">
	<div class="cd-popup-container">
      <p id="qrcode_success" style="max-width:unset;text-transform: uppercase;padding: 3em 0em 0em;">LocalMenu wird über den Abruf der 
        Daten benachrichtigt. Bitte reiche deinen Nachweis zur Datenerhebung vom Gesundheitsamt nach.</p>
        <p style="border: 1px solid;padding: 0em 2em;margin: 10px;"><input type="checkbox" class="form-check-input" id="coronaabholen">
          <label class="form-check-label" for="coronaabholen">Ich wurde aufgefordert die Corona-Daten dem Gesundheitsamt zu melden.</label></p>
          <p style="padding: 0em 2em;margin: 10px;color:red;" id="coronaabholenrot"></p>
	   <ul class="cd-buttons" style="padding-inline-start: unset;">
		  <li><a href="#0" onclick="hidePopup('corona','bestätigen')" id="download">Anfordern</a></li>
		  <li><a href="#0" onclick="hidePopup('corona','schließen')">Abbrechen</a></li>
	   </ul>
	   <a href="#0" class="cd-popup-close img-replace" onclick="hidePopup('corona','schließen')"></a>
  </div> <!-- cd-popup-container -->
</div>
<div class="container">
<!-- NACHRICHT WEGEN VERIFIKATION DES ACCOUNTS -->
              <?php
                 if ($active != 1){
                  echo '<div class="alert alert-warning"><strong>ACHTUNG!</strong><ul class="list-group">
                    <li class="list-group-item list-group-item-danger">Account nicht verifiziert</li>
                    <li class="list-group-item list-group-item-warning">Account Nutzung ist sehr eingeschränkt!</li>
                  </ul></div>
                  ';
                 }else{
                  echo '';
                 }
              ?>
</div>
<div class="container">
<h3><u>Corona-Einträge (letzten 30 Tage):</u></h3>
<div style="text-align:center;margin-bottom:10px;">
  <button onclick='corona_absenden()' class='btn btn-success' style="width: 100%;"  name='corona_daten_beauftragen'>Einträge anfordern</button>
</div>
<?php 
      if($result3->num_rows > 0){
          echo "<table id='example' class='table table-striped table-bordered' >
                    <thead>
                        <tr>
                            <th>Vorname</th>
                            <th>Name</th>
                            <th>Adresse</th>
                            <th>Telefonnummer</th>
                            <th>Startzeit</th>
                            <th>Dauer</th>
                        </tr>
                    </thead>
                    <tbody>";
                  while ( $row = $result3->fetch_assoc() ) {
                    echo "<td>". $row['first_name'] . "</td>" ;
                    echo "<td>". $row['last_name']  . "</td>" ;
                    echo "<td>*</td>" ;
                    echo "<td>*</td>" ;
                    echo "<td>". $row['startzeit'] . "</td>" ;
                    echo "<td>". $row['dauer'] . "</td>" ;
                    /*
                    echo "<td>". $row['adresse'] . "</td>" ;
                    echo "<td>". $row['telefonnummer'] . "</td>" ;
                    echo "<td>". $row['startzeit'] . "</td>" ;
                    echo "<td>". $row['dauer'] . "</td>" ;
                    */
                    echo "</tr>";
                  }
          echo "</tbody>
                  <tfoot>
                      <tr>
                        <th>Vorname</th>
                        <th>Name</th>
                        <th>Adresse</th>
                        <th>Telefonnummer</th>
                        <th>Startzeit</th>
                        <th>Dauer</th>
                      </tr>
                  </tfoot>
              </table>";
                }else{
                  echo 'Es stehen keine Daten zur Verfügung.';
                }
        
      
    ?>
</div>
<br>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS 

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> 
-->
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        "scrollY":        "500px",
        "scrollCollapse": true,
        "paging":         false
    } );
} );
  function corona_absenden() {
    document.getElementById("cd-corona").style.visibility = "visible";
    document.getElementById("cd-corona").style.opacity = 1;
    
  }

  document.querySelector("#download").onclick = function () {
  if(document.getElementById("coronaabholen").checked != 1) {
      document.getElementById("coronaabholenrot").innerHTML = 'Bitte Datenerhebung bestätigen!';
    } else {
      document.getElementById("cd-corona").style.visibility = "hidden";
      document.getElementById("cd-corona").style.opacity = 0;
      $.post("corona_absenden.php",{
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
    
  var pdf = new jsPDF("p", "mm", "a4");
  var img = new Image()
  img.src = 'img/logo.png'
  pdf.text ("Corona-Einträge der letzten 30 Tage", 20, 40);
  pdf.setProperties({
    title: 'PDF mit QR-Code erstellen',
    subject: 'PDF mit Javascript erstellt',
    author: 'Tarkan Acur',
    keywords: 'generated, javascript,jspdf',
    creator: 'Javascript jsPDF'
  });
  pdf.addImage(img, 'png', 20, 0, 70, 40);
  var pageHeight = pdf.internal.pageSize.height;
  <?php 
      if($result4->num_rows > 0){
        echo 'var abstand = 40;';
        while ( $row = $result4->fetch_assoc() ) {
          echo 'if ( abstand + 40 >= pageHeight){
                    pdf.addPage();
                    pdf.text ("Corona-Einträge der letzten 30 Tage", 20, 40);
                    pdf.addImage(img, "png", 20, 0, 70, 40);
                    abstand = 60;
                  }else{
                    abstand = abstand + 20;
                  }';
          echo 'pdf.text ("' . $row['startzeit'] .' ' . $row['first_name'] . ' ' . $row['last_name'] .'", 20, abstand);';
          echo 'pdf.text ("' . $row['adresse'] .'", 75, abstand + 6);';
          echo 'pdf.text ("' . $row['telefonnummer'] .' ' . $row['dauer'] .'", 75, abstand + 11);';
        }
        echo '
        var pages = pdf.internal.getNumberOfPages();
        var pageWidth = pdf.internal.pageSize.width;  //Optional
        var pageHeight = pdf.internal.pageSize.height;  //Optional
        for (let j = 1; j < pages + 1 ; j++) {
              let horizontalPos = pageWidth / 2;  //Can be fixed number
              let verticalPos = pageHeight - 10;  //Can be fixed number
              pdf.setPage(j);
              pdf.text("Seite " + j + " / " + pages, horizontalPos, verticalPos, {align: "center"});
        }';
      echo "pdf.save ('corona_eintraege.pdf');";
      }else{
        echo 'Du hast noch kein Corona-Beitrag erhalten.';
      }
      ?>
                var x = document.getElementById("snackbar");
                  // Add the "show" class to DIV
                  x.innerHTML = "Corona-Eintrag wurden exportiert. LocalMenu wurde darüber in Kenntnis gesetzt.";
                  x.className = "show";
                  // After 3 seconds, remove the show class from DIV
                  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 6000);
                  test();
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
			}
	}
</script>
</body>
</html>