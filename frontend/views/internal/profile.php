<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['user_id'])) {
  die("Fehler: Benutzer nicht eingeloggt.");
}

$userid = $_SESSION["user_id"];

include("../../../backend/config/dbconnect.php");

if ($con->connect_error) {
  die("Verbindung zur Datenbank fehlgeschlagen: " . $con->connect_error);
}

$sql = "SELECT email, mitglied_seit FROM users WHERE user_id = ?";
$stmt = $con->prepare($sql);

if ($stmt === false) {
  die("Fehler bei der Vorbereitung der SQL-Abfrage: " . $con->error);
}

$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();
$con->close();
?>

<!DOCTYPE html>
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
  <style>
    .main-container {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 50px;
      flex: 1;
      width: 100%;
    }

    .profile-card {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
      max-width: 400px;
      width: 100%;
      text-align: center;
    }

    .profile-picture img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
    }

    .profile-info h2 {
      margin: 10px 0;
      font-size: 24px;
      color: #333;
    }

    .password-reset {
      margin-top: 20px;
    }

    .password-reset form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .password-reset label {
      margin-bottom: 10px;
      font-size: 16px;
      color: #333;
    }

    .password-reset input[type="file"],
    .password-reset button {
      padding: 10px;
      margin-top: 10px;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .password-reset input[type="file"] {
      background-color: #3498db;
      color: #fff;
    }

    .password-reset button {
      background-color: #e74c3c;
      color: #fff;
      transition: background-color 0.3s, transform 0.3s;
    }

    .password-reset button:hover {
      background-color: #c0392b;
      transform: scale(1.05);
    }

    .password-reset a {
      text-decoration: none;
      color: #3498db;
      transition: color 0.3s;
    }

    .password-reset a:hover {
      color: #2980b9;
    }

    .back-button {
      background-color: #3498db;
      color: #fff;
      padding: 10px 20px;
      margin-top: 20px;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s, transform 0.3s;
      display: inline-block;
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
    <div class="profile-card">
      <h2 id="profileName"><?php echo $_SESSION["username"]; ?></h2>
      <div class="profile-picture">
        <img src="../../assets/images/profpics/<?php echo $userid; ?>.jpg" alt="Profilbild">
        <br><br>
        <form action="../../../backend/controllers/profpic.php" method="post" enctype="multipart/form-data">
          <label for="image"><?php echo file_exists("../../frontend/assets/images/profpics/" . $userid . ".jpg") ? "Bild wechseln" : "Bild auswählen"; ?></label>
          <input type="file" name="profile_pic" id="image" accept="image/*" required>
          <br><br>
          <input type="submit" value="Bild hochladen">
        </form>
      </div>
      <div class="profile-info">
        <p>E-Mail: <?php echo $user['email']; ?></p>
        <p>Mitglied seit: <?php echo $user['mitglied_seit']; ?></p>
      </div>
      <div class="password-reset">
        <a href="changepassword.php">Passwort ändern</a><br>
        <a href="changeemail.php">E-Mail ändern</a>
      </div>
      <a href="frontpage.php" class="back-button">Zurück</a>
    </div>
    <div class="robot-container">
      <div class="speech-bubble" id="speechBubble">
        Hallo <?php echo $_SESSION["username"]; ?>! Hier kannst du deine Profileinstellungen ändern.
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