<?php
require 'db.php';
session_start();
// Set session variables to be used on profile.php page
$kundenid = $mysqli->escape_string($_POST['kunden_id']);
$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$adresse = $mysqli->escape_string($_POST['adresse']);
$telefonnummer = $mysqli->escape_string($_POST['telefonnummer']);
$dauer = $mysqli->escape_string($_POST['dauer']);
$Time = time() + (2*60*60);
$anfangszeit = date('Y-m-d H:i:s', $Time);

    $sql = "INSERT INTO corona (kundenid,first_name, last_name,adresse,telefonnummer, startzeit, dauer, sichtbar) " 
            . "VALUES ('$kundenid','$first_name','$last_name','$adresse','$telefonnummer', '$anfangszeit', '$dauer', '0')";
    
    // Add user to the database
    if ( $mysqli->query($sql) ){
        
        $kunde = $mysqli->query("SELECT * FROM corona WHERE telefonnummer='$telefonnummer' AND first_name='$first_name' AND last_name='$last_name' AND startzeit='$anfangszeit'");
        $kunde_erg = mysqli_fetch_assoc($kunde);
        $kunde_id = $kunde_erg['id'];
        $kunde_vorname = $kunde_erg['first_name'];
        $kunde_name = $kunde_erg['last_name'];
        echo $anfangszeit . ":   [" . $kunde_vorname . "  " . $kunde_name. "  ]";
    }
    else {
        echo '0';
    }
