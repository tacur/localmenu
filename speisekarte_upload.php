<?php

require 'db.php';
session_start();
/* Registration process, inserts user info into the database 
   and sends account confirmation email message */

// Set session variables to be used on profile.php page
$email = $mysqli->escape_string($_SESSION['email']);

$speisedirekt = $mysqli->escape_string($_POST['speisedirekt']);
// $email = 'tarkan.acur@live.de';
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
$result1 = mysqli_fetch_assoc($result);
$result_id = $result1['id'];
echo "email: " . $email;
echo "Kundenid: " . $result_id;
/*
$zugelassenedateitypen = array("image/png", "image/jpeg", "image/jpg", "image/gif");
if ( ! in_array( $_FILES['artikelbild']['type'] , $zugelassenedateitypen ))
{
          echo "<p>Dateitype ist NICHT zugelassen</p>";
} else {
*/
        $uploaddir = "Kunden/" . $result_id . "/" . "speisekarte/" . "/";

        if (!file_exists($uploaddir)) {
          //Create our directory if it does not exist
          echo "Pfad nicht vorhanden! Pfad angelegt. \n";
          mkdir($uploaddir, 0755, true);
        }

        $speisekarte = $uploaddir ; //. dateiname_bereinigen(basename($_FILES['speisekarte']['name']));
        $dateiname = "speisekarte.pdf";
        if ( $_FILES['speisekarte']['name'] <> '' ) 
        {
          // if (move_uploaded_file($_FILES['speisekarte']['tmp_name'], $speisekarte)) {
            if (move_uploaded_file($_FILES['speisekarte']['tmp_name'], $speisekarte . $dateiname)) {
              $bilddateivorschlag = "1";
              $mysqli->query("UPDATE users SET speisekarte='1' WHERE id='$result_id'");
            echo "Speisekarte ist valide und wurde erfolgreich angelegt. \n";
          } else {
              echo "Möglicherweise eine Dateiupload-Attacke! \n";
          }
        } 
        else{
          echo "<p>Keine Datei hochgeladen</p>";
        }

        $sql = "UPDATE users SET speisekarte_direkt='$speisedirekt' WHERE Kunden_ID='$result_id'";
        if ( $mysqli->query($sql) ){
          echo "Änderung Speisekarte-Direktlink gespeichert.";
        }

function dateiname_bereinigen($dateiname){
    // erwünschte Zeichen erhalten bzw. umschreiben
    // aus allen ä wird ae, ü -> ue, ß -> ss (je nach Sprache mehr Aufwand)
    // und sonst noch ein paar Dinge (ist schätzungsweise mein persönlicher Geschmack ;)
    $dateiname = strtolower ( $dateiname );
    $dateiname = str_replace ('"', "-", $dateiname );
    $dateiname = str_replace ("'", "-", $dateiname );
    $dateiname = str_replace ("*", "-", $dateiname );
    $dateiname = str_replace ("ß", "ss", $dateiname );
    $dateiname = str_replace ("ß", "ss", $dateiname );
    $dateiname = str_replace ("ä", "ae", $dateiname );
    $dateiname = str_replace ("ä", "ae", $dateiname );
    $dateiname = str_replace ("ö", "oe", $dateiname );
    $dateiname = str_replace ("ö", "oe", $dateiname );
    $dateiname = str_replace ("ü", "ue", $dateiname );
    $dateiname = str_replace ("ü", "ue", $dateiname );
    $dateiname = str_replace ("Ä", "ae", $dateiname );
    $dateiname = str_replace ("Ö", "oe", $dateiname );
    $dateiname = str_replace ("Ü", "ue", $dateiname );
    $dateiname = htmlentities ( $dateiname );
    $dateiname = str_replace ("&", "und", $dateiname );
    $dateiname = str_replace ("+", "und", $dateiname );
    $dateiname = str_replace ("(", "-", $dateiname );
    $dateiname = str_replace (")", "-", $dateiname );
    $dateiname = str_replace (" ", "-", $dateiname );
    $dateiname = str_replace ("\'", "-", $dateiname );
    $dateiname = str_replace ("/", "-", $dateiname );
    $dateiname = str_replace ("?", "-", $dateiname );
    $dateiname = str_replace ("!", "-", $dateiname );
    $dateiname = str_replace (":", "-", $dateiname );
    $dateiname = str_replace (";", "-", $dateiname );
    $dateiname = str_replace (",", "-", $dateiname );
    $dateiname = str_replace ("--", "-", $dateiname );
 
    // und nun jagen wir noch die Heilfunktion darüber
    $dateiname = filter_var($dateiname, FILTER_SANITIZE_URL);
    return ($dateiname);
}