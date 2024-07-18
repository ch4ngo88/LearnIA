<?php
// Setze die Zeitzone
date_default_timezone_set('Europe/Berlin');

// Erlaube URL fopen
ini_set('allow_url_fopen', '1');

$host = "sql213.infinityfree.com";
$user = "if0_36887906";
$password = "CBMLearnIA";
$database = "if0_36887906_learnia";
$port = "3306";

$con = mysqli_connect($host, $user, $password, $database, $port);

if (!$con) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}
