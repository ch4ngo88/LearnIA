<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../phpmailer-master/src/Exception.php';
require '../../phpmailer-master/src/PHPMailer.php';
require '../../phpmailer-master/src/SMTP.php';

include("../config/dbconnect.php");

$messages = [];

$messages[] = "Script gestartet";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $messages[] = "POST-Anfrage erhalten";

    $email = trim($_POST["email"]);

    if (empty($email)) {
        $messages[] = "Bitte geben Sie Ihre E-Mail-Adresse ein.";
        showMessagesAndExit($messages);
    }

    $messages[] = "E-Mail-Adresse: $email";

    // Überprüfen, ob die E-Mail-Adresse existiert
    $sql = "SELECT user_id FROM users WHERE email = ?";
    $stmt = $con->prepare($sql);
    if ($stmt === false) {
        $messages[] = "Fehler bei der Vorbereitung der SQL-Abfrage: " . $con->error;
        showMessagesAndExit($messages);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $messages[] = "Benutzer gefunden";

        $token = bin2hex(random_bytes(50));
        $stmt->bind_result($user_id);
        $stmt->fetch();

        $messages[] = "User ID: $user_id";
        $messages[] = "Token: ****";

        // Token in der Datenbank speichern
        $sql = "INSERT INTO password_resets (user_id, token) VALUES (?, ?) ON DUPLICATE KEY UPDATE token = VALUES(token)";
        $stmt = $con->prepare($sql);
        if ($stmt === false) {
            $messages[] = "Fehler bei der Vorbereitung der SQL-Abfrage: " . $con->error;
            showMessagesAndExit($messages);
        }
        $stmt->bind_param("is", $user_id, $token);
        $stmt->execute();

        $messages[] = "Token gespeichert";

        // E-Mail senden mit PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.ionos.de'; // Set the SMTP server to send through
            $mail->SMTPAuth = true;
            $mail->Username = 'info@learn-ia.com'; // SMTP username
            $mail->Password = 'CBMlearnIA2024!'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $messages[] = "SMTP konfiguriert";

            // Recipients
            $mail->setFrom('info@learn-ia.com', 'LearnIA');
            $mail->addAddress($email);

            $messages[] = "Empfänger hinzugefügt";

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Passwort zurücksetzen';
            $reset_link = "https://learn-ia.com/frontend/views/reset_password.php?token=" . $token;
            $mail->Body = "Klicken Sie auf den folgenden Link, um Ihr Passwort zurückzusetzen: <a href='$reset_link'>$reset_link</a>";

            $messages[] = "E-Mail Inhalt konfiguriert";

            $mail->send();
            $messages[] = "E-Mail gesendet";

            // Ladebalken anzeigen und zur Login-Seite weiterleiten
            $message = "Ein Link zum Zurücksetzen Ihres Passworts wurde an Ihre E-Mail-Adresse gesendet. Du wirst in 3 Sekunden zum Login weitergeleitet.";
            $redirect_url = "https://learn-ia.com/frontend/views/login.html";

            showMessagesAndExit($messages, $message, $redirect_url);
        } catch (Exception $e) {
            $messages[] = "Fehler beim Senden der E-Mail: {$mail->ErrorInfo}";
            showMessagesAndExit($messages);
        }
    } else {
        $messages[] = "Keine Benutzer mit dieser E-Mail-Adresse gefunden.";
        showMessagesAndExit($messages);
    }

    $stmt->close();
    $con->close();
}

function showMessagesAndExit($messages, $finalMessage = null, $redirectUrl = null) {
    $messageScript = "<script>";
    foreach ($messages as $index => $message) {
        $delay = $index * 1000; // Delay each message by 1 second
        $messageScript .= "setTimeout(function() { document.getElementById('messages').innerHTML += '<p>$message</p>'; }, $delay);";
    }
    if ($finalMessage && $redirectUrl) {
        $delay = count($messages) * 1000;
        $messageScript .= "setTimeout(function() { document.getElementById('messages').innerHTML += '<h1>$finalMessage</h1>'; }, $delay);";
        $messageScript .= "setTimeout(function() { window.location.href = '$redirectUrl'; }, $delay + 3000);";
    }
    $messageScript .= "</script>";

    echo <<<HTML
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
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
        #messages p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="messages"></div>
        <div class="progress-bar">
            <div class="progress"></div>
        </div>
    </div>
    $messageScript
</body>
</html>
HTML;

    exit;
}
?>
