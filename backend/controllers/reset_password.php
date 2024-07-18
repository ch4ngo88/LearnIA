<?php
include("../config/dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["token"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if (empty($password) || empty($confirm_password)) {
        echo "Bitte alle Felder ausfüllen.";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "Passwörter stimmen nicht überein.";
        exit;
    }

    // Token überprüfen und Benutzer-ID abrufen
    $sql = "SELECT user_id FROM password_resets WHERE token = ?";
    $stmt = $con->prepare($sql);
    if ($stmt === false) {
        die("Fehler bei der Vorbereitung der SQL-Abfrage: " . $con->error);
    }
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id);
        $stmt->fetch();

        // Passwort aktualisieren
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ? WHERE user_id = ?";
        $stmt = $con->prepare($sql);
        if ($stmt === false) {
            die("Fehler bei der Vorbereitung der SQL-Abfrage: " . $con->error);
        }
        $stmt->bind_param("si", $hashed_password, $user_id);
        $stmt->execute();

        // Token löschen
        $sql = "DELETE FROM password_resets WHERE user_id = ?";
        $stmt = $con->prepare($sql);
        if ($stmt === false) {
            die("Fehler bei der Vorbereitung der SQL-Abfrage: " . $con->error);
        }
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $message = "Passwort erfolgreich zurückgesetzt. Du wirst in 3 Sekunden zum Login weitergeleitet.";
        $redirect_url = "https://learn-ia.com/frontend/views/login.html";

        echo <<<HTML
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="3;url=$redirect_url">
    <title>Weiterleitung</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: "Helvetica", sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .progress-bar {
            width: 100%;
            background-color: #f3f3f3;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 20px;
        }
        .progress {
            width: 0;
            height: 20px;
            background-color: #3498db;
            animation: progress-animation 3s linear forwards;
        }
        @keyframes progress-animation {
            from { width: 0; }
            to { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>$message</h1>
        <div class="progress-bar">
            <div class="progress"></div>
        </div>
    </div>
</body>
</html>
HTML;
    } else {
        echo "Ungültiger Token.";
    }

    $stmt->close();
    $con->close();
}
