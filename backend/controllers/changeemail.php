<?php
session_start();
include("../config/dbconnect.php");

$newEmail = $_POST['newEmail'];
$gesuchterName = $_SESSION['username'];

$sql = "UPDATE users SET email=? WHERE name=?";
$stmt = $con->prepare($sql);

if ($stmt === false) {
    die("Fehler bei der Vorbereitung der SQL-Abfrage: " . $con->error);
}

$stmt->bind_param("ss", $newEmail, $gesuchterName);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "E-Mail geändert. Du wirst in 3 Sekunden weitergeleitet.";
    header("refresh:3;url=https://learn-ia.com/frontend/views/internal/profile.php");
} else {
    echo "E-Mail-Änderung fehlgeschlagen. Du wirst in 3 Sekunden zurückgeleitet.";
    header("refresh:3;url=https://learn-ia.com/frontend/views/internal/changeemail.php");
}

$stmt->close();
$con->close();
