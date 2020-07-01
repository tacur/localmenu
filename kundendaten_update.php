<?php

require 'db.php';
session_start();


$email = $_SESSION['email'];
// $email = 'tarkan.acur@live.de';
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
$result1 = mysqli_fetch_assoc($result);
$result_id = $result1['id'];

$kunde_name = $mysqli->escape_string($_POST['name']);
$kunde_firstname = $mysqli->escape_string($_POST['first_name']);
$kunde_lastname = $mysqli->escape_string($_POST['last_name']);
$kunde_strasse = $mysqli->escape_string($_POST['strasse']);
$kunde_nummer = $mysqli->escape_string($_POST['nummer']);
$kunde_ort = $mysqli->escape_string($_POST['ort']);
$kunde_plz = $mysqli->escape_string($_POST['plz']);
$kunde_telefonnummer = $mysqli->escape_string($_POST['telefonnummer']);
$kunde_speisekarte = $mysqli->escape_string($_POST['speisekarte']);
/*
$kunde_facebook = $mysqli->escape_string($_POST['kunde_facebook']);
$kunde_instagram = $mysqli->escape_string($_POST['kunde_instagram']);
*/

$sql = "UPDATE users SET name='$kunde_name',first_name='$kunde_ort',last_name='$kunde_plz',"
        . "strasse='$kunde_strasse', hausnummer='$kunde_nummer',"
        . "ort='$kunde_ort',postleitzahl='$kunde_plz',"
        . "speisekarte_direkt='$kunde_speisekarte' "
        . "WHERE id='$result_id'";

    // echo $sql;
    if ( $mysqli->query($sql) ){

        $to      = $email;
        $subject = 'Kundendaten aktualisiert (LOCALMENU)';
        $message_body = '
        Hallo,
        du hast soeben deine Kundendaten im Shop geändert.
        
        Drücke bitte auf den folgenden Link, um deine Änderungen zu begutachten:
        http://localmenu.de/login.php';  

        mail( $to, $subject, $message_body );
        echo "Kundendaten erfolgreich aktualisiert!"; 
    }
    else {
        echo "Kundendaten wurden nicht aktualisiert!"; 
    }
