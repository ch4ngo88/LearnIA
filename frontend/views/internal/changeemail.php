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
        .cardStyle {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
            margin: 50px auto;
            text-align: center;
        }

        .logoImage {
            width: 150px;
            margin-bottom: 20px;
        }

        .formTitle {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .inputDiv {
            margin-bottom: 15px;
            text-align: left;
        }

        .inputLabel {
            display: block;
            margin-bottom: 5px;
            font-size: 16px;
            color: #333;
        }

        .inputDiv input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .buttonWrapper {
            margin-top: 20px;
        }

        .submitButton {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        .submitButton:hover {
            background-color: #2980b9;
            transform: scale(1.05);
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

        .lia {
            width: 150px;
        }

        footer {
            background-color: #2c3e50;
            color: #fff;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>

<body>
    <div class="cardStyle">

        <form action="../../../backend/controllers/changeemail.php" method="post" name="emailForm" id="emailForm">
            <img src="../../assets/images/logo.png" id="loginLogo" class="logoImage" alt="LearnIA Logo" />
            <h2 class="formTitle">E-Mail ändern</h2>
            <div class="inputDiv">
                <label class="inputLabel" for="newEmail">Neue E-Mail-Adresse</label>
                <input type="email" id="newEmail" name="newEmail" required>
            </div>
            <div class="buttonWrapper">
                <button type="submit" id="submitButton" class="submitButton pure-button pure-button-primary">
                    <span>Weiter</span>
                </button>

            </div>
        </form>
        <a href="profile.php" class="back-button">Zurück</a>
    </div>
    <div class="robot-container">
        <div class="speech-bubble">
            Hier kannst du deine E-Mail ändern.
        </div>
        <img src="../../../frontend/assets/images/lia1.png" alt="Lia" class="lia">
    </div>
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