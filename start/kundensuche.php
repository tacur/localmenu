<?php
require 'db.php';
session_start();

$input = $mysqli->escape_string($_POST['datainput']);

$result = $mysqli->query("SELECT * FROM users WHERE postleitzahl LIKE '%$input%' OR name LIKE '%$input%' OR ort LIKE '%$input%'");
if($result->num_rows > 0){
    while ( $row = $result->fetch_assoc() ) {
        $kundendaten = mysqli_fetch_assoc($result);
        $kundename = $kundendaten['name'];
        $kundestr = $kundendaten['strasse'];
        $kundenummer = $kundendaten['hausnummer'];
        $kundeplz = $kundendaten['postleitzahl'];
        $kundeort = $kundendaten['ort'];
        $kundenid = $kundendaten['id'];
        echo $kundename; 
        echo ",";
        echo $kundestr; 
        echo $kundenummer;
        echo ",";
        echo $kundeplz; 
        echo ",";
        echo $kundeort; 
        echo ",";
        echo $kundenid;
        echo "%";
    }
}else{
    echo "X";
}
/*
if($mysqli->query($sql)){
    $sqlplzkunde = mysqli_fetch_assoc($result);
    $kunden = $sqlplzkunde['Postleitzahl_KUNDE'];
    // $kunden = explode(",", $kunden);
    foreach($kunden as $kunde) {
        
        $sqlkunde = $mysqli->query("SELECT * FROM Kunden WHERE Kunde_ID='$kunde'");
        $kundendaten = mysqli_fetch_assoc($sqlkunde);

        $kundename = $kundendaten['Kunde_NAME'];
        $kundelogo = $kundendaten['Kunde_LOGO'];
        $kundebeschreibung = $kundendaten['Kunde_BESCHREIBUNG'];
        $kundetelefonnummer = $kundendaten['Kunde_TELEFONNUMMER'];
        $kundelink = $kundendaten['Kunde_LINK'];
        $kundegebiet = $kundendaten['Kunde_LIEFERGEBIET'];
        $kundetheme = $kundendaten['Kunde_THEME'];
        echo utf8_encode($kundename); 
        echo ",";
        echo utf8_encode($kundebeschreibung); 
        echo ",";
        echo $kundetelefonnummer; 
        echo ",";
        echo $kundelogo;
        echo ",";
        echo $kundelink;
        echo ",";
        echo $kundegebiet;
        echo ",";
        echo $kundetheme;
        echo "%";
       
    }
} else {
    echo "Postleitzahl nicht zugeordnet";
}


?>
*/