<?php 

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

?>