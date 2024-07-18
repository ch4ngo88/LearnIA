<?php

session_start();

// Überprüfen, ob der Benutzer eingeloggt ist und eine user_id in der Session gespeichert ist
if (!isset($_SESSION['user_id'])) {
    die("Benutzer nicht eingeloggt.");
}

// Die user_id aus der Session holen
$userId = $_SESSION['user_id'];

// Verzeichnis, in das die Datei hochgeladen werden soll
$baseDir = '../userdata/';
$userDir = $baseDir . $userId . '/';

// Überprüfen, ob das Verzeichnis für den Benutzer existiert, ansonsten erstellen
if (!is_dir($userDir)) {
    if (!mkdir($userDir, 0777, true)) {
        die("Fehler beim Erstellen des Benutzerverzeichnisses.");
    }
}

// Funktion zum Redirigieren nach 3 Sekunden
function redirectTo($url) {
    echo "<script>
        setTimeout(function() {
            window.location.href = '$url';
        }, 3000);
    </script>";
    exit;
}

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Überprüfen, ob eine Datei hochgeladen wurde
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Maximal erlaubte Dateigröße in Bytes (5 MB)
        $maxFileSize = 5 * 1024 * 1024;

        // Dateigröße überprüfen
        if ($_FILES['file']['size'] > $maxFileSize) {
            echo "Die Datei ist zu groß. Maximale Dateigröße ist 5 MB.";
            redirectTo("https://learn-ia.com/frontend/views/internal/upload.php");
        }

        // Den ursprünglichen Dateinamen bekommen
        $originalFilename = $_FILES['file']['name'];
        // Die Dateiendung extrahieren
        $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);

        // Den gewünschten Dateinamen aus dem Formular holen
        $filename = basename($_POST['filename']);
        // Dateiname sicherstellen (keine unerwünschten Zeichen)
        $filename = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $filename);
        // Den Dateinamen mit der ursprünglichen Endung kombinieren
        $newFilename = $filename . '.' . $extension;

        // Temporäre Datei und Dateipfad festlegen
        $tmpFile = $_FILES['file']['tmp_name'];
        $destination = $userDir . $newFilename;

        // Versuchen, die Datei zu verschieben
        if (move_uploaded_file($tmpFile, $destination)) {
            echo "Datei erfolgreich hochgeladen!";
        } else {
            echo "Fehler beim Hochladen der Datei.";
        }
        redirectTo("https://learn-ia.com/frontend/views/internal/upload.php");
    } else {
        echo "Keine Datei hochgeladen oder Fehler beim Hochladen.";
        redirectTo("https://learn-ia.com/frontend/views/internal/upload.php");
    }
} else {
    echo "Ungültige Anfrage.";
    redirectTo("https://learn-ia.com/frontend/views/internal/upload.php");
}





// // Verzeichnis, in das die Datei hochgeladen werden soll
// $uploadDir = '../userdata/';


// // Überprüfen, ob das Formular abgeschickt wurde
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Überprüfen, ob eine Datei hochgeladen wurde
//     if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
//         // Den ursprünglichen Dateinamen bekommen
//         $originalFilename = $_FILES['file']['name'];
//         // Die Dateiendung extrahieren
//         $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);

//         // Den gewünschten Dateinamen aus dem Formular holen
//         $filename = basename($_POST['filename']);
//         // Dateiname sicherstellen (keine unerwünschten Zeichen)
//         $filename = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $filename);
//         // Den Dateinamen mit der ursprünglichen Endung kombinieren
//         $newFilename = $filename . '.' . $extension;

//         // Temporäre Datei und Dateipfad festlegen
//         $tmpFile = $_FILES['file']['tmp_name'];
//         $destination = $uploadDir . $newFilename;

//         // Versuchen, die Datei zu verschieben
//         if (move_uploaded_file($tmpFile, $destination)) {
//             echo "Datei erfolgreich hochgeladen!";
//         } else {
//             echo "Fehler beim Hochladen der Datei.";
//         }
//     } else {
//         echo "Keine Datei hochgeladen oder Fehler beim Hochladen.";
//     }
// } else {
//     echo "Ungültige Anfrage.";
// }
?>
