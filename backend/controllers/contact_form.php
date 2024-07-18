<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../phpmailer-master/src/Exception.php';
require '../../phpmailer-master/src/PHPMailer.php';
require '../../phpmailer-master/src/SMTP.php';

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
        $name = $_POST['name'];
        $email = $_POST['email'];
        $messageContent = $_POST['message'];

        // E-Mail an LearnIA senden
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.ionos.de';
            $mail->SMTPAuth = true;
            $mail->Username = 'info@learn-ia.com';
            $mail->Password = 'CBMlearnIA2024!';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('info@learn-ia.com', 'LearnIA');
            $mail->addAddress('info@learn-ia.com'); // Empfängeradresse

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Neue Nachricht vom Kontaktformular';
            $mail->Body = "Name: $name<br>Email: $email<br>Nachricht: $messageContent";

            $mail->send();

            // Bestätigungs-E-Mail an den Absender senden
            $confirmationMail = new PHPMailer(true);
            $confirmationMail->isSMTP();
            $confirmationMail->Host = 'smtp.ionos.de';
            $confirmationMail->SMTPAuth = true;
            $confirmationMail->Username = 'info@learn-ia.com';
            $confirmationMail->Password = 'CBMlearnIA2024!';
            $confirmationMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $confirmationMail->Port = 587;

            // Recipients
            $confirmationMail->setFrom('info@learn-ia.com', 'LearnIA');
            $confirmationMail->addAddress($email); // Absenderadresse

            // Content
            $confirmationMail->isHTML(true);
            $confirmationMail->Subject = 'Bestätigung Ihrer Nachricht';
            $confirmationMail->Body = "Vielen Dank für Ihre Nachricht! Dies ist eine automatisch generierte Nachricht. Bitte antworten Sie nicht auf diese E-Mail, da Ihr Anliegen nicht bearbeitet werden kann. Wenn Sie Unterstützung benötigen, wenden Sie sich bitte an unseren Kundenservice.<br><br>Hier ist eine Kopie Ihrer Nachricht:<br><br> $messageContent";

            $confirmationMail->send();

            // Ladebalken anzeigen und zur Kontakt-Seite weiterleiten
            $message = 'Vielen Dank für Ihre Nachricht! Du wirst in 3 Sekunden weitergeleitet.';
            $redirect_url = "https://learn-ia.com/frontend/views/contact.html";

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
        } catch (Exception $e) {
            echo "Fehler beim Senden der E-Mail: {$mail->ErrorInfo}";
        }
    } else {
        echo "reCAPTCHA-Überprüfung fehlgeschlagen. Bitte versuchen Sie es erneut.";
    }
} else {
    echo "Ungültige Anfrage.";
}
