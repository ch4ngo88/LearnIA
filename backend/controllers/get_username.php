<?php
session_start();
include("../config/dbconnect.php");

// Annahme: Benutzer ist eingeloggt und Benutzer-ID ist in der Session gespeichert
$user_id = $_SESSION['user_id'];

$sql = "SELECT name FROM users WHERE user_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name);
$stmt->fetch();
$stmt->close();
$con->close();

echo json_encode(['name' => $name]);
