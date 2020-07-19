<?php
/* Database connection settings */
$host   = 'localhost';
$user   = 'localmenu';
$pass   = 'Qb2ug9b3';
$db     = 'localmenu';


$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

?>