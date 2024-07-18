<?php
session_start();

if (isset($_SESSION["profpic"])) {
    header("Content-Type: image/jpeg");
    echo $_SESSION["profpic"];
} else {
    echo "Kein Bild in der Session gefunden.";
}
?>
