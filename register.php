<?php
require 'db.php';
session_start();
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */
// Set session variables to be used on profile.php page
$_SESSION['email'] = $_POST['email'];
$_SESSION['name'] = $_POST['name'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];
// $_SESSION['studiengang'] = $_POST['studiengang'];
$_SESSION['telefonnummer'] = $_POST['telefonnummer'];
// $_SESSION['verantwortlicher'] = $_POST['verantwortlicher'];
$_SESSION['profilbild'] = "/img/users/0.png";

$profilbild = $mysqli->escape_string("/img/users/0.png");
// Escape all $_POST variables to protect against SQL injections
$name = $mysqli->escape_string($_POST['name']);
$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$email = $mysqli->escape_string($_POST['email']);
// $studiengang = $mysqli->escape_string($_POST['studiengang']);
$telefonnummer = $mysqli->escape_string($_POST['telefonnummer']);
$strasse = $mysqli->escape_string($_POST['strasse']);
$hausnummer = $mysqli->escape_string($_POST['hausnummer']);
$ort = $mysqli->escape_string($_POST['ort']);
$postleitzahl = $mysqli->escape_string($_POST['postleitzahl']);
// $verantwortlicher = $mysqli->escape_string($_POST['verantwortlicher']);
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
//$password = password_hash($_POST['password_reg'], PASSWORD_BCRYPT);
$hash = $mysqli->escape_string( md5( rand(0,1000) ) );

// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());
// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    $_SESSION['message'] = 'Diese E-Mail Adresse wird bereits verwendet!';
    header("location: error.php");
}
else { // Email doesn't already exist in a database, proceed...

    // active is 0 by DEFAULT (no need to include it here)
    // $sql = "INSERT INTO users (first_name, last_name, email, studiengang, telefonnummer, verantwortlicher, password, hash) " 
    //       . "VALUES ('$first_name','$last_name','$email','$studiengang','$telefonnummer','$verantwortlicher','$password', '$hash')";
    $sql = "INSERT INTO users (name, profilbild, speisekarte,speisekarte_direkt, first_name, last_name, email, active, telefonnummer, password, hash, strasse, hausnummer, ort, postleitzahl) " 
            . "VALUES ('$name','0','0','on','$first_name','$last_name','$email','1','$telefonnummer','$password', '$hash', '$strasse', '$hausnummer', '$ort', '$postleitzahl')";
    
    // Add user to the database
    if ( $mysqli->query($sql) ){
        
        $_SESSION['active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = 1; // So we know the user has logged in
        // Send registration confirmation link (verify.php)
        $to      = $email;
        $subject = 'Willkommen bei LOCALMENU - Account Verifikation (LOCALMENU)';
        $from = "From: LOCALMENU <info@localmenu.de>";
        $message_body = '
        Herzlich Willkommen liebe/r '.$last_name.',

        Vielen Dank für deine Registrierung!

        Klicke bitte auf den folgenden Link, um dein Account zu aktivieren:

        http://localmenu.de/verify.php?email='.$email.'&hash='.$hash;  

        mail( $to, $subject, $message_body, $from );
        echo "Account mit der E-Mail: " . $email . " erfolgreich angelegt. Verifikations-Mail ist raus.";
        
        $kunde = $mysqli->query("SELECT * FROM users WHERE email='$email'");
        $kunde_erg = mysqli_fetch_assoc($kunde);
        $kunde_id = $kunde_erg['id'];
        if ( $kunde_id != "") {
            $sql2 = "INSERT INTO `oeffnungszeiten` (`MONTAG_START`, `DIENSTAG_START`, `MITTWOCH_START`, `DONNERSTAG_START`, `FREITAG_START`, `SAMSTAG_START`, `SONNTAG_START`, 
                    `Kunden_ID`, 
                    `MONTAG_ENDE`, `DIENSTAG_ENDE`, `MITTWOCH_ENDE`, `DONNERSTAG_ENDE`, `FREITAG_ENDE`, `SAMSTAG_ENDE`, `SONNTAG_ENDE`, 
                    `Mitteilung_1`, `Mitteilung_2`, 
                    `MONTAG_GESCHLOSSEN`, `DIENSTAG_GESCHLOSSEN`, `MITTWOCH_GESCHLOSSEN`, `DONNERSTAG_GESCHLOSSEN`, `FREITAG_GESCHLOSSEN`, `SAMSTAG_GESCHLOSSEN`, `SONNTAG_GESCHLOSSEN`,
                    `MONTAG_OPENEND`, `DIENSTAG_OPENEND`, `MITTWOCH_OPENEND`, `DONNERSTAG_OPENEND`, `FREITAG_OPENEND`, `SAMSTAG_OPENEND`, `SONNTAG_OPENEND`) VALUES 
                    ('00:00','00:00','00:00','00:00','00:00','00:00','00:00',
                    '$kunde_id',
                    '00:00','00:00','00:00','00:00','00:00','00:00','00:00',
                    'Text1','Text2',
                    '','','','','','','','','','','','','','')";
            if ($mysqli->query($sql2)) {
                echo "Öffnungszeiten erstellt";
            }else {
                echo "Öffnungszeiten - SQL Statement Fehler";
            }
            
            $_SESSION['message'] = "Account mit der E-Mail: " . $email . " erfolgreich angelegt. Verifikations-Mail ist raus.";
            header("location: profile.php");
        }else {
            echo "kunden ID != ''";
        }
    }
    else {
        $_SESSION['message'] = "Registrierung fehlgeschlagen!";
        header("location: profile.php");
    }

}