<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verzeichnis, in dem die Dateien gespeichert werden sollen
    $targetDirectory = "uploads/";
    
    // Sicherstellen, dass das Verzeichnis existiert
    if (!is_dir($targetDirectory)) {
        mkdir($targetDirectory, 0755, true);
    }

    // Temporäre Datei und neue Dateiinformationen
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $originalFileName = $_FILES['file']['name']; // Ursprünglicher Dateiname
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION); // Dateierweiterung

    // Neuen Dateinamen vom Benutzer erhalten
    $newFileName = $_POST['filename'];
    
    // Sicherstellen, dass der neue Dateiname keine Dateiendung enthält
    $newFileName = preg_replace("/\.[^\.]+$/", "", $newFileName);
    
    // Kompletten neuen Dateinamen erstellen, einschließlich der ursprünglichen Dateiendung
    $newFileNameWithExtension = $newFileName . '.' . $fileExtension;

    // Pfad zur Zieldatei
    $targetFilePath = $targetDirectory . basename($newFileNameWithExtension);

    // Überprüfen, ob eine Datei hochgeladen wurde
    if (is_uploaded_file($fileTmpPath)) {
        // Datei verschieben
        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
            echo "Die Datei wurde erfolgreich hochgeladen und als {$newFileNameWithExtension} gespeichert.";

        } else {
            echo "Fehler beim Speichern der Datei.";
        }
    } else {
        echo "Keine Datei hochgeladen oder Fehler beim Hochladen.";
    }
} else {
    // HTML-Formular
    ?>
    <!DOCTYPE html>
    <html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Datei hochladen</title>
    </head>
    <body>
        <h2>Datei hochladen und unter neuem Namen speichern</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="file">Datei auswählen:</label>
            <input type="file" id="file" name="file" required><br><br>
            <label for="filename">Neuer Dateiname (ohne Erweiterung):</label>
            <input type="text" id="filename" name="filename" required><br><br>
            <input type="submit" value="Hochladen">
        </form>
    </body>
    </html>
    <?php
}
?>
