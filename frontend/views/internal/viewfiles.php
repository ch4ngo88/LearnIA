<!DOCTYPE html>
<?php session_start();
$userid = $_SESSION["user_id"];
?>
<html lang="de">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="language" content="de" />
  <meta name="language" content="en" />
  <meta http-equiv="Content-Security-Policy" content="
    default-src 'self'; 
    script-src 'self' 'unsafe-inline' 'unsafe-eval' https://code.jquery.com https://unpkg.com https://cdnjs.cloudflare.com https://www.google.com https://www.gstatic.com https://www.google-analytics.com; 
    style-src 'self' 'unsafe-inline' https://unpkg.com https://fonts.googleapis.com; 
    img-src 'self' data: https://raw.githubusercontent.com https://unpkg.com https://www.google-analytics.com https://errors.infinityfree.net https://*.infinityfree.net https://*.ionos.com https://*.cloudshare.com https://filemanager.ai https://php-myadmin.net; 
    font-src 'self' data: https://unpkg.com https://fonts.gstatic.com https://www.learn-ia.com https://learn-ia.com https://www.learn-ia.de https://learn-ia.de https://www.learn-ia.info https://learn-ia.info https://*.infinityfree.net https://*.ionos.com https://*.cloudshare.com; 
    frame-src 'self' https://www.google.com https://recaptcha.google.com https://filemanager.ai https://php-myadmin.net; 
    child-src 'self' https://www.google.com;
    connect-src 'self' https://unpkg.com https://www.google-analytics.com https://www.learn-ia.com https://learn-ia.com https://www.learn-ia.de https://learn-ia.de https://www.learn-ia.info https://learn-ia.info https://*.infinityfree.net https://*.ionos.com https://*.cloudshare.com https://filemanager.ai https://php-myadmin.net;" />
  <meta http-equiv="Permissions-Policy" content="usb=*, battery=*" />
  <meta property="og:image" content="https://learn-ia.com/frontend/assets/images/logo.png" />
  <link rel="stylesheet" href="../../../frontend/css/normalize.css" />
  <link rel="stylesheet" href="../../../frontend/css/sanitize.css" />
  <link rel="stylesheet" href="../../../frontend/css/styles.css" />
  <link rel="stylesheet" href="../../../frontend/css/menu.css" />
  <title>LearnIA</title>
  <meta name="description" content="Intelligente, personalisierte Lernplattform" />
  <meta name="keywords" content="Lernplattform, intelligente Lernplattform, personalisierte Lernplattform, Bildung, E-Learning, Individuelle Assistenz" />
  <meta name="author" content="Marco da Silva, Clara Rosenhahn, Sascha Kalnins, Stephanie Ong" />
  <link rel="canonical" href="https://www.learn-ia.com" />
  <meta name="robots" content="index, follow" />
  <meta property="og:title" content="LearnIA, Intelligente personalisierte Lernplattform - Lia" />
  <meta property="og:description" content="LearnIA" />

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    .flex-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      text-align: center;
    }

    .notice {
      background-color: #ffffff;
      border: 2px solid #00aabb;
      border-radius: 10px;
      padding: 20px;
      color: #333;
      max-width: 400px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .notice h1 {
      font-size: 36px;
      margin-bottom: 20px;
    }

    .notice p {
      font-size: 18px;
      margin-bottom: 20px;
    }

    .back-button {
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      background-color: #3498db;
      color: #fff;
      transition: background-color 0.3s, transform 0.3s;
    }

    .back-button:hover {
      background-color: #2980b9;
      transform: scale(1.05);
    }

    .robot-container {
      text-align: center;
      margin-top: 20px;
    }

    .speech-bubble {
      display: inline-block;
      position: relative;
      background: #ffffff;
      border: 2px solid #00aabb;
      border-radius: 5px;
      padding: 10px;
      color: #333;
      margin-bottom: 10px;
      max-width: 300px;
      word-wrap: break-word;
    }

    .speech-bubble:after {
      content: "";
      position: absolute;
      bottom: -20px;
      left: 50%;
      transform: translateX(-50%);
      border-width: 10px;
      border-style: solid;
      border-color: #ffffff transparent transparent transparent;
    }

    .lia {
      width: 150px;
    }
  </style>
</head>

<body>
  <header>
    <nav class="menu-bar">
      <div class="auth-buttons">
        <form action="../../../backend/controllers/logout.php" method="POST">
          <button type="submit">Logout</button>
        </form>
      </div>
    </nav>
  </header>
  <main class="flex-container">
    <div class="notice">
      <h1>Deine Dateien:</h1>
      <ul>
        <?php
        // Ordnerpfad
        $ordner = '../../../backend/userdata/' . $userid;

        // Prüfen, ob der Ordner existiert
        if (is_dir($ordner)) {
          // Ordnerinhalt einlesen
          $dateien = scandir($ordner);

          // Dateien auflisten
          foreach ($dateien as $datei) {
            // "." und ".." ignorieren
            if ($datei !== '.' && $datei !== '..') {
              echo "<li><a href='$ordner/$datei' target='_blank'>$datei</a></li>";
            }
          }
        } else {
          echo "<li>Du hast noch keine Dateien hochgeladen</li>";
        }
        ?>
      </ul>
      <br>
      <form action="frontpage.php">
        <button type="submit" class="back-button">
          Zurück zur Startseite
        </button>
      </form>
    </div>
    <div class="robot-container">
      <div class="speech-bubble">
        Hier können wir uns deine Dateien zusammen anschauen.
      </div>
      <img src="../../../frontend/assets/images/lia1.png" alt="Lia" class="lia">
    </div>
  </main>
  <footer>
    <div class="footer-content">
      <p>
        &copy; <span id="current-year"></span> LearnIA. Alle Rechte
        vorbehalten.
      </p>
    </div>
  </footer>

  <script>
    document.getElementById(
      "current-year"
    ).textContent = new Date().getFullYear();
  </script>
</body>

</html>