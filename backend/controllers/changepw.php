<?php
session_start();
include("../config/dbconnect.php");

$oldpw = $_POST['oldpw'];
$newpw = $_POST['newpw'];
$newpwc = $_POST['newpwc'];
$gesuchterName = $_SESSION['username'];

$sql = "SELECT password FROM users WHERE name = ?";
$stmt = $con->prepare($sql);

if ($stmt === false) {
    die("Fehler bei der Vorbereitung der SQL-Abfrage: " . $con->error);
}

$stmt->bind_param("s", $gesuchterName);
$stmt->execute();
$result = $stmt->get_result();

$pw = null;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pw = $row['password'];
} else {
    echo "Kein Ergebnis gefunden.";
    header("refresh:3;url=https://learn-ia.com/frontend/views/internal/changepassword.php");
    exit;
}
$stmt->close();

if ($newpw != $newpwc) {
    echo "Passwörter stimmen nicht überein, zurück in 3 Sek.";
    header("refresh:3;url=https://learn-ia.com/frontend/views/internal/changepassword.php");
    exit;
} else if (password_verify($oldpw, $pw)) {
    $newpw = password_hash($newpw, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password=? WHERE name=?";
    $stmt = $con->prepare($sql);

    if ($stmt === false) {
        die("Fehler bei der Vorbereitung der SQL-Abfrage: " . $con->error);
    }

    $stmt->bind_param("ss", $newpw, $gesuchterName);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Passwort geändert. Du wirst in 3 Sekunden weitergeleitet.";
        header("refresh:3;url=https://learn-ia.com/frontend/views/internal/profile.php");
    } else {
        echo "Passwortänderung fehlgeschlagen. Du wirst in 3 Sekunden zurückgeleitet.";
        header("refresh:3;url=https://learn-ia.com/frontend/views/internal/changepassword.php");
    }

    $stmt->close();
    $con->close();
} else {
    echo "Passwort nicht geändert - Altes Passwort nicht korrekt. Du wirst in 3 Sek. zurückgeleitet.";
    header("refresh:3;url=https://learn-ia.com/frontend/views/internal/changepassword.php");
    exit;
}
