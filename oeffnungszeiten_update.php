<?php

require 'db.php';
session_start();
/* Registration process, inserts user info into the database 
   and sends account confirmation email message */

// Set session variables to be used on profile.php page
$email = $_SESSION['email'];
// $email = 'tarkan.acur@live.de';
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
$result1 = mysqli_fetch_assoc($result);
$result_id = $result1['id'];
$kundeid = $mysqli->escape_string($result_id);

$Time = time() + (2*60*60);
$artikelupdate = date('Y-m-d H:i:s', $Time);

$montagstart = $mysqli->escape_string($_POST['montagstart']);
$montagende = $mysqli->escape_string($_POST['montagende']);
$montaggeschlossen = $mysqli->escape_string($_POST['montagaktiv']);
$montagopenend =   $mysqli->escape_string($_POST['montagopenend']);
$dienstagstart = $mysqli->escape_string($_POST['dienstagstart']);
$dienstagende = $mysqli->escape_string($_POST['dienstagende']);
$dienstaggeschlossen = $mysqli->escape_string($_POST['dienstagaktiv']);
$dienstagopenend =   $mysqli->escape_string($_POST['dienstagopenend']);
$mittwochstart = $mysqli->escape_string($_POST['mittwochstart']);
$mittwochende = $mysqli->escape_string($_POST['mittwochende']);
$mittwochgeschlossen = $mysqli->escape_string($_POST['mittwochaktiv']);
$mittwochopenend =   $mysqli->escape_string($_POST['mittwochopenend']);
$donnerstagstart = $mysqli->escape_string($_POST['donnerstagstart']);
$donnerstagende = $mysqli->escape_string($_POST['donnerstagende']);
$donnerstaggeschlossen = $mysqli->escape_string($_POST['donnerstagaktiv']);
$donnerstagopenend =   $mysqli->escape_string($_POST['donnerstagopenend']);
$freitagstart = $mysqli->escape_string($_POST['freitagstart']);
$freitagende = $mysqli->escape_string($_POST['freitagende']);
$freitaggeschlossen = $mysqli->escape_string($_POST['freitagaktiv']);
$freitagopenend =   $mysqli->escape_string($_POST['freitagopenend']);
$samstagstart = $mysqli->escape_string($_POST['samstagstart']);
$samstagende = $mysqli->escape_string($_POST['samstagende']);
$samstaggeschlossen = $mysqli->escape_string($_POST['samstagaktiv']);
$samstagopenend =   $mysqli->escape_string($_POST['samstagopenend']);
$sonntagstart = $mysqli->escape_string($_POST['sonntagstart']);
$sonntagende = $mysqli->escape_string($_POST['sonntagende']);
$sonntaggeschlossen = $mysqli->escape_string($_POST['sonntagaktiv']);
$sonntagopenend =   $mysqli->escape_string($_POST['sonntagopenend']);
$mitteilung1 = $mysqli->escape_string($_POST['mitteilung1']);
$mitteilung2 = $mysqli->escape_string($_POST['mitteilung2']);

/* $artikelbild = $mysqli->escape_string($_POST['artikelbild']);
$artikelaktiv = $mysqli->escape_string($_POST['artikelaktiv_update']);
if ($artikelaktiv == "on") {
  $artikelaktiv = "1";
}else {
  $artikelaktiv = "0";
}
*/
// $artikelerstellt = $mysqli->escape_string($startzeit);
/*
$result0 = $mysqli->query("SELECT * FROM Kunden WHERE Kunde_ID='$kundeid'");
$result00 = mysqli_fetch_assoc($result0);
$result000 = $result00['Kunde_DATENBANKOEFFNUNGSZEITEN'];
*/
$sql = "UPDATE oeffnungszeiten SET MONTAG_GESCHLOSSEN='$montaggeschlossen',DIENSTAG_GESCHLOSSEN='$dienstaggeschlossen',MITTWOCH_GESCHLOSSEN='$mittwochgeschlossen',DONNERSTAG_GESCHLOSSEN='$montaggeschlossen',"
        . "FREITAG_GESCHLOSSEN='$freitaggeschlossen', SAMSTAG_GESCHLOSSEN='$samstaggeschlossen', SONNTAG_GESCHLOSSEN='$sonntaggeschlossen',"
        . "Mitteilung_1='$mitteilung1', Mitteilung_2='$mitteilung2', MONTAG_START='$montagstart', MONTAG_ENDE='$montagende', DIENSTAG_START='$dienstagstart', DIENSTAG_ENDE='$dienstagende',"
        . "MITTWOCH_START='$mittwochstart', MITTWOCH_ENDE='$mittwochende',DONNERSTAG_START='$donnerstagstart', DONNERSTAG_ENDE='$donnerstagende',FREITAG_START='$freitagstart', FREITAG_ENDE='$freitagende',"
        . "SAMSTAG_START='$samstagstart', SAMSTAG_ENDE='$samstagende',SONNTAG_START='$sonntagstart', SONNTAG_ENDE='$sonntagende', MONTAG_OPENEND='$montagopenend', DIENSTAG_OPENEND='$dienstagopenend',"
        . "MITTWOCH_OPENEND='$mittwochopenend', DONNERSTAG_OPENEND='$donnerstagopenend',FREITAG_OPENEND='$freitagopenend', SAMSTAG_OPENEND='$samstagopenend', SONNTAG_OPENEND='$sonntagopenend' WHERE Kunden_ID='$kundeid'";

// if ($mysqli->query($result)) {
    // Add user to the database
    echo $sql;
    if ( $mysqli->query($sql) ){
        
       // $_SESSION['active'] = 0; //0 until user activates their account with verify.php
      //  $_SESSION['logged_in'] = true; // So we know the user has logged in
      //  $_SESSION['message'] =
      //      "Bestätigungsmail für Deine Bestellung wurde an $email gesendet!";
        // Send registration confirmation link (verify.php)
        $to      = $email;
        $subject = 'Öffnungszeiten aktualisiert (LocalMenu)';
        $message_body = '
        Hallo shisha2you-Kunde,
        du hast soeben die ÖffnungsLieferzeiten im Shop geändert
        
        Drücke bitte auf den folgenden Link, um deine Änderungen zu begutachten:
        http://localmenu.de/login.php';  

        mail( $to, $subject, $message_body );
        
        // echo "Bestellung erfolgreich an WhatsApp gesendet! Bestätigungsmail an $email gesendet";
        echo "Öffnungszeiten erfolgreich aktualisiert!"; // $_SESSION['message']'';
        // header("location: index_hannover.php"); 
    }
    else {
        // $_SESSION['message'] = 'Bestellung fehlgeschlagen!';
        echo "Öffnungszeiten wurde nicht aktualisiert!"; //$_SESSION['message'];
        // header("location: index_hannover.php");
    }

    function dateiname_bereinigen($dateiname)
{
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