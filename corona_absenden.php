<?php
require 'db.php';
session_start();
// Set session variables to be used on profile.php page
$kundenid = $_SESSION['kunde_id'];
$email = $_SESSION['email'];
$name = $_SESSION['name'];
$vorname =$_SESSION['first_name'];
$nachname = $_SESSION['last_name'];
$telefonnummer = $_SESSION['telefonnummer'];


    $sql = "SELECT * FROM corona WHERE kundenid='$kundenid' ORDER BY startzeit DESC";
    
    // Add user to the database
    if ( $mysqli->query($sql) ){

        $to      ="info@localmenu.de";
        $subject = 'Datenanforderung Corona von '. $name;
        $from = "From: LOCALMENU <info@localmenu.de>";
        $message_body = 'Sehr geehrte Damen und Herren,

wie angefordert erhalten Sie die notwendigen Informationen für den gemeldeten Corona-Fall für unseren registrierten Kunden ' .
$vorname . ' '. $nachname . ' von der Lokalität '. $name .' als Anhang im PDF-Format. 
Bei weiteren Fragen wenden Sie sich per E-Mail an: ' . $email . ' oder per Telefonnumer an: ' . $telefonnummer . '
        
Mit freundlichen Grüßen
        
i. A. Team LocalMenu';

        $headers   = array();
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: text/plain; charset=utf-8";
        $headers[] = "From: LOCALMENU <info@localmenu.de>";
        $headers[] = "Subject: {$betreff}";

        mail( $to, $subject, $message_body, implode("\r\n",$headers) );
        echo "Daten erfolgreich abgesendet.";
       
    }
    else {
        echo 'Daten konnten nicht abgesendet werden.';
    }
