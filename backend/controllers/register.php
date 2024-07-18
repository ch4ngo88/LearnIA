<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recaptchaSecret = '6Lew4BEqAAAAAC4WRYxGdoDHwLkaFfPOwUJt_NrV';  // Dein neuer Secret Key hier
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $recaptchaSecret,
        'response' => $recaptchaResponse
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $result = json_decode($response);

    if ($result->success) {
        // Erfolgreiche reCAPTCHA-Überprüfung
        include '../config/dbconnect.php';  // Verbindung zur Datenbank herstellen

        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Passwort verschlüsseln
        $mitglied_seit = date("Y-m-d"); // Heutiges Datum

        // Überprüfen, ob der Benutzername bereits existiert
        $stmt = $con->prepare("SELECT * FROM users WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $stmt->close();
            $con->close();
            $message = 'Benutzername ist bereits vergeben. Bitte wähle einen anderen Benutzernamen.';
            $redirect_url = "https://learn-ia.com/frontend/views/register.html";

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

        // Überprüfen, ob die E-Mail-Adresse bereits existiert
        $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $stmt->close();
            $con->close();
            $message = 'Diese E-Mail-Adresse ist bereits registriert. Bitte wähle eine andere E-Mail-Adresse.';
            $redirect_url = "https://learn-ia.com/frontend/views/register.html";

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

        // Benutzer registrieren
        $sql = "INSERT INTO users (name, email, password, mitglied_seit) VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $password, $mitglied_seit);

        if ($stmt->execute()) {
            $message = 'Registrierung erfolgreich! Du wirst in 3 Sekunden zum Login weitergeleitet.';
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
            echo "Fehler bei der Registrierung: " . $stmt->error;
        }

        $stmt->close();
        $con->close();
    } else {
        echo "reCAPTCHA-Überprüfung fehlgeschlagen. Bitte versuchen Sie es erneut.";
    }
} else {
    echo "Ungültige Anfrage.";
}
