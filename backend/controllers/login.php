<?php
include("../config/dbconnect.php");

session_start();

$gesuchterName = $_POST["username"];
$password = $_POST["password"];

// SQL-Abfrage vorbereiten
$sql = "SELECT user_id, password FROM users WHERE name = ?";
$stmt = $con->prepare($sql);

if ($stmt === false) {
    die("Fehler bei der Vorbereitung der SQL-Abfrage: " . $con->error);
}

$stmt->bind_param("s", $gesuchterName);
$stmt->execute();
$result = $stmt->get_result();

$pw = null;
$user_id = null;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pw = $row['password'];
    $user_id = $row['user_id'];
} else {
    $message = 'Kein Benutzer gefunden. Du wirst in 3 Sekunden zurück zum Login weitergeleitet.';
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
            background-color: #8B0000;
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
    exit;
}

$stmt->close();
$con->close();

if (password_verify($password, $pw)) {
    $_SESSION['username'] = $gesuchterName;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['loggedin'] = true;
    header("Location: https://learn-ia.com/frontend/views/internal/frontpage.php");
    exit;
} else {
    $message = 'Passwort nicht korrekt. Du wirst in 3 Sekunden zurück zum Login weitergeleitet.';
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
            background-color: #8B0000;
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
    exit;
}
