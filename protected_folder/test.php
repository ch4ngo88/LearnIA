<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../phpmailer-master/src/Exception.php';
require '../../phpmailer-master/src/PHPMailer.php';
require '../../phpmailer-master/src/SMTP.php';

$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 2;                                  // Enable verbose debug output
    $mail->isSMTP();
    $mail->Host       = 'smtp.ionos.de';                   // Set the SMTP server to send through
    $mail->SMTPAuth   = true;
    $mail->Username   = 'info@learn-ia.com';               // SMTP username
    $mail->Password   = 'CBMlearnIA2024!';                 // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    // Enable TLS encryption
    $mail->Port       = 587;                               // TCP port to connect to

    //Recipients
    $mail->setFrom('info@learn-ia.com', 'LearnIA');
    $recipientEmail = 'marco.dacio@icloud.com';           // Zieladresse anpassen
    if (!PHPMailer::validateAddress($recipientEmail)) {
        throw new Exception('Invalid email address.');
    }
    $mail->addAddress($recipientEmail);

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Passwort zurücksetzen';
    $reset_link = "https://learn-ia.com/frontend/views/reset_password.php?token=" . $token;
    $mail->Body    = "Klicken Sie auf den folgenden Link, um Ihr Passwort zurückzusetzen: <a href='$reset_link'>$reset_link</a>";

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
