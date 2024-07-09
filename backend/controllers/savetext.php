<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <form action="#" method="post">
        <label for="description">Beschreibung:</label><br>
        <input type="text" id="description" name="description" required><br><br>
        <label for="text">Text:</label><br>
        <textarea id="text" name="text" rows="20" cols="100" required></textarea><br><br>
        <input type="submit" value="Speichern">
    </form> 
   <div class="button-container">
        <button onclick="location.href='washochladen.html'">Zurück</button>
    </div>




<?php
// Funktion zum Speichern der Daten
function saveData($description, $text) {
    // Dateipfad zum Speichern der Daten
    $filePath = 'saved_data.txt';

    // Formatierte Daten
    $data = "Beschreibung: " . $description . "\nText: " . $text . "\n\n";

    // Daten in die Datei schreiben
    file_put_contents($filePath, $data, FILE_APPEND | LOCK_EX);
}

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];
    $text = $_POST['text'];

    // Daten speichern
    saveData($description, $text);

    echo "Daten erfolgreich gespeichert!";
} else {
    echo "";
}
?>

</body>
</html>