<?php

require 'db.php';
session_start();
/* Registration process, inserts user info into the database 
   and sends account confirmation email message */

// Set session variables to be used on profile.php page
$email = $mysqli->escape_string($_SESSION['email']);
// $email = 'tarkan.acur@live.de';
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
$result1 = mysqli_fetch_assoc($result);
$result_id = $result1['id'];
/*
$zugelassenedateitypen = array("image/png", "image/jpeg", "image/jpg", "image/gif");
if ( ! in_array( $_FILES['artikelbild']['type'] , $zugelassenedateitypen ))
{
          echo "<p>Dateitype ist NICHT zugelassen</p>";
} else {
*/
        $uploaddir = "Kunden/" . $result_id . "/" . "tagesmenu/";

        if (!file_exists($uploaddir)) {
          //Create our directory if it does not exist
          echo "Pfad nicht vorhanden! Pfad angelegt. \n";
          mkdir($uploaddir, 0755, true);
        }

        $tagesmenu = $uploaddir ; //. dateiname_bereinigen(basename($_FILES['speisekarte']['name']));
        $dateiname = "tagesmenu";
        if ( $_FILES['tagesmenu']['name'] <> '' ) 
        {
          $imageFileType = strtolower(pathinfo($_FILES['tagesmenu']['name'],PATHINFO_EXTENSION));
          // if (move_uploaded_file($_FILES['speisekarte']['tmp_name'], $speisekarte)) {
          switch ($imageFileType) {
              case "pdf":
                  $dateiname = $dateiname . ".pdf";
                  break;
              case "jpg":
                  $dateiname = $dateiname . ".jpg";
                  break;
              case "png":
                  $dateiname = $dateiname . ".png";
                  break;
              case "jpeg":
                  $dateiname = $dateiname . ".jpeg";
                  break;
              case "gif":
                  $dateiname = $dateiname . ".gif";
                  break;
            }
            $dateiname = $tagesmenu . $dateiname;
            if (move_uploaded_file($_FILES['tagesmenu']['tmp_name'], $dateiname)) {
              $mysqli->query("UPDATE users SET tagesmenu='1' WHERE id='$result_id'");
              $result = $mysqli->query("SELECT * FROM Tagesmenu WHERE Kunden_ID='$result_id'");
              $sql = "UPDATE Tagesmenu SET tagesmenu_PFAD='$dateiname' WHERE Kunden_ID='$result_id'"
              $mysqli->query($sql);
            echo "Tagesmenu ist valide und wurde erfolgreich angelegt. \n";
          } else {
              echo "Möglicherweise eine Dateiupload-Attacke! \n";
          }
        } 
        else{
          echo "<p>Keine Datei hochgeladen</p>";
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