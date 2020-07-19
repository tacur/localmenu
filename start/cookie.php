<?php 
require 'db.php';
session_start();

if ($_POST['postleitzahlcookie']) {
    $postleitzahl = $_POST['postleitzahlcookie'];
    setcookie("Postleitzahl", $postleitzahl, time()+(3600*24*30));
    echo $_COOKIE["Postleitzahl"];
}

if ($_POST['cookies']) {
$cookies = $_POST['cookies'];
setcookie("Cookies", $cookies, time()+(3600*24*30));
}

if ($_POST['darkmode']) {
    $dark = $_POST['darkmode'];
    setcookie("Darkmode", $dark, time()+(3600*24*30));
}
if ($_POST['darkmodeoff']) {
    $dark = $_POST['darkmode'];
    setcookie("Darkmode", $dark, 1);
}
if ($_POST['seitenaufruf']) {
    $kunde_id = $_SESSION['kunde_id'];
    $seitenaufruf_vorher = $mysqli->query("SELECT * FROM Seitenaufrufe WHERE Seitenaufruf_KUNDE='$kunde_id'");
    $seitenaufruf_vorher_wert = mysqli_fetch_assoc($seitenaufruf_vorher);
    $seitenaufruf_vorher_wert1 = $seitenaufruf_vorher_wert['Seitenaufruf_WERT'];
    $seitenaufruf_vorher_wert_neu = intval($seitenaufruf_vorher_wert1) + 1;
    $seitenaufruf = $mysqli->query("UPDATE Seitenaufrufe SET Seitenaufruf_WERT='$seitenaufruf_vorher_wert_neu' WHERE Seitenaufruf_KUNDE = '$kunde_id'");
}
?>