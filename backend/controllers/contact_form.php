<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6Len-gsqAAAAAOqzemtHBur-5YTSj2OLHr3C8LNC'; // Dein geheimer Schlüssel
    $recaptcha_response = $_POST['g-recaptcha-response'];

    // reCAPTCHA-Token verifizieren
    $response = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $response_keys = json_decode($response, true);

    if ($response_keys["success"]) {
        // reCAPTCHA-Verifikation erfolgreich
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // Hier den Code einfügen, der die Nachricht verarbeitet und speichert oder versendet
        // Beispiel: Nachricht per E-Mail senden
        $to = 'deine_email@domain.de';
        $subject = 'Neue Kontaktanfrage von ' . $name;
        $headers = 'From: ' . $email . "\r\n" .
            'Reply-To: ' . $email . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        $body = "Name: $name\nE-Mail: $email\nNachricht:\n$message";
        if (mail($to, $subject, $body, $headers)) {
            echo 'Nachricht erfolgreich gesendet!';
        } else {
            echo 'Fehler beim Senden der Nachricht. Bitte versuchen Sie es später erneut.';
        }
    } else {
        // reCAPTCHA-Verifikation fehlgeschlagen
        echo 'reCAPTCHA-Verifikation fehlgeschlagen. Bitte versuchen Sie es erneut.';
    }
} else {
    echo 'Ungültige Anfrage.';
}
