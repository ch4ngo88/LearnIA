<?php
session_start();
// $_SESSION['user_id'] = 123; // Dummy user_id for testing, remove this line in production

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $upload_dir = __DIR__ . '/../../frontend/assets/images/profpics/';
    $user_id = $_SESSION['user_id'];
    $file_tmp = $_FILES['profile_pic']['tmp_name'];
    $file_ext = pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION);
    $new_filename = $upload_dir . $user_id . '.' . $file_ext;

    // Check if the directory exists, if not show an error
    if (!is_dir($upload_dir)) {
        echo "Fehler: Das Verzeichnis existiert nicht.";
        header("refresh:3;url=https://learn-ia.com/frontend/views/internal/profile.php");
        exit();
    }

    if ($file_tmp) {
        $image_info = getimagesize($file_tmp);
        if ($image_info) {
            list($width, $height) = $image_info;

            $src_img = null;
            switch ($image_info[2]) {
                case IMAGETYPE_JPEG:
                    $src_img = imagecreatefromjpeg($file_tmp);
                    break;
                case IMAGETYPE_PNG:
                    $src_img = imagecreatefrompng($file_tmp);
                    break;
                case IMAGETYPE_GIF:
                    $src_img = imagecreatefromgif($file_tmp);
                    break;
                default:
                    echo "Fehler: Nicht unterstützter Bildtyp.";
                    header("refresh:3;url=https://learn-ia.com/frontend/views/internal/profile.php");
                    exit();
            }

            $dst_img = imagecreatetruecolor(150, 150);
            if ($dst_img === false) {
                echo "Fehler: Konnte das neue Bild nicht erstellen.";
                header("refresh:3;url=https://learn-ia.com/frontend/views/internal/profile.php");
                exit();
            }

            if (!imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, 150, 150, $width, $height)) {
                echo "Fehler: Konnte das Bild nicht skalieren.";
                header("refresh:3;url=https://learn-ia.com/frontend/views/internal/profile.php");
                exit();
            }

            $upload_success = false;
            switch ($image_info[2]) {
                case IMAGETYPE_JPEG:
                    $upload_success = imagejpeg($dst_img, $new_filename);
                    break;
                case IMAGETYPE_PNG:
                    $upload_success = imagepng($dst_img, $new_filename);
                    break;
                case IMAGETYPE_GIF:
                    $upload_success = imagegif($dst_img, $new_filename);
                    break;
            }

            imagedestroy($src_img);
            imagedestroy($dst_img);

            if ($upload_success) {
                echo "Upload erfolgreich!";
                header("refresh:3;url=https://learn-ia.com/frontend/views/internal/profile.php");
            } else {
                echo "Fehler: Upload fehlgeschlagen!";
                header("refresh:3;url=https://learn-ia.com/frontend/views/internal/profile.php");
            }
        } else {
            echo "Fehler: Die Datei ist kein gültiges Bild.";
            header("refresh:3;url=https://learn-ia.com/frontend/views/internal/profile.php");
        }
    } else {
        echo "Fehler: Kein Bild zum Hochladen gefunden.";
        header("refresh:3;url=https://learn-ia.com/frontend/views/internal/profile.php");
    }
} else {
    echo "Fehler: Ungültige Anforderung.";
    header("refresh:3;url=https://learn-ia.com/frontend/views/internal/profile.php");
}
?>
