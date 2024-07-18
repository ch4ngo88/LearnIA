<!DOCTYPE html>
<html lang="de">
<?php session_start() ?>

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

  <style>
    .button-container {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
      max-width: 600px;
      width: 100%;
      text-align: center;
      margin: 20px auto;
    }

    label {
      font-size: 16px;
      color: #333;
      display: block;
      margin-top: 10px;
    }

    input[type="file"],
    input[type="text"],
    input[type="submit"] {
      padding: 10px;
      margin-top: 10px;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: calc(100% - 22px);
    }

    input[type="file"],
    input[type="text"] {
      background-color: #ecf0f1;
      color: #333;
    }

    input[type="submit"] {
      background-color: #3498db;
      color: #fff;
      transition: background-color 0.3s, transform 0.3s;
    }

    input[type="submit"]:hover {
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
  <main class="main-container">
    <div class="button-container">
      <h1>Was willst Du hochladen?</h1>
      <h1>Datei-Upload</h1>
      <form action="../../../backend/controllers/savefile.php" method="post" enctype="multipart/form-data">
        <label for="file">Datei auswählen(max 5MB): </label>
        <input type="file" name="file" id="file" required>
        <br>
        <label for="filename">Dateiname:</label>
        <input type="text" name="filename" id="filename" required>
        <br>
        <input type="submit" value="Hochladen">
      </form>
      <br>
      <form action="frontpage.php">
        <input type="submit" value="Zurück" />
      </form>
    </div>
    <div class="robot-container">
      <div class="speech-bubble" id="speechBubble">
        Hier hast du die Möglichkeit, deine Unterlagen hochzuladen, so dass ich sie mir später durchlesen kann.
      </div>
      <img src="../../assets/images/lia1.png" alt="Lia" class="lia">
    </div>
  </main>
  <footer>
    <div class="footer-content">
      <p>&copy; <span id="current-year"></span> LearnIA. Alle Rechte vorbehalten.</p>
    </div>
  </footer>
  <script>
    document.getElementById("current-year").textContent = new Date().getFullYear();
  </script>
</body>

</html>