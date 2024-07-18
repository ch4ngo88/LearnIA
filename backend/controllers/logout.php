<?php
session_start();
session_unset();  // Entfernt alle Sitzungvariablen
session_destroy(); // Zerstört die Sitzung

header("Location: ../../index.html"); // Ersetzt '/path/to/your/startpage.html' durch den tatsächlichen Pfad zur Startseite
exit();
?>
