<?php
// require_once '../config/db.php';
echo "drin";

function benutzerExistiert($benutzername, $mailadresse, $dateiInhalt) {
    foreach ($dateiInhalt as $zeile) {
        list($gespeicherterBenutzername, , $gespeicherteMailadresse) = explode(' - ', $zeile);
        if (trim($gespeicherterBenutzername) == $benutzername || trim($gespeicherteMailadresse) == $mailadresse) {
            return true;
        }
    }
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $benutzername = isset($_POST['username']) ? trim($_POST['username']) : '';
    $passwort = isset($_POST['password']) ? trim($_POST['password']) : '';
    $passwortWiederholen = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';
    $mailadresse = isset($_POST['email']) ? trim($_POST['email']) : '';

    if ($passwort === $passwortWiederholen) {
        $datei = 'P:\LearnIA\LearnIA\backend\controllers\registrierung.txt';
        $dateiInhalt = file_exists($datei) ? file($datei) : [];

        if (!benutzerExistiert($benutzername, $mailadresse, $dateiInhalt)) {
            $daten = $benutzername . ' - ' . $passwort . ' - ' . $mailadresse . PHP_EOL;

            $dateiHandle = fopen($datei, 'a');
            if ($dateiHandle) {
                fwrite($dateiHandle, $daten);
                fclose($dateiHandle);
                echo "Registrierung erfolgreich.";
            } else {
                echo "Fehler beim Öffnen der Datei.";
            }
        } else {
            echo "Benutzername oder Mailadresse existiert bereits.";
        }
    } else {
        echo "Die Passwörter stimmen nicht überein.";
    }
} else {
    echo "Keine Daten gesendet.";
}
?>
