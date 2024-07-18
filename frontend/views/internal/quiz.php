<?php
session_start();

// Der vollständige Pool von 50 Fragen
$questionPool = [
    ["question" => "Was bedeutet HTML?", "options" => ["a" => "Hypertext Markup Language", "b" => "Hyperlink Text Markup Language", "c" => "Home Tool Markup Language"], "answer" => "a"],
    ["question" => "Was ist ein Array?", "options" => ["a" => "Ein einzelner Wert", "b" => "Eine Funktion", "c" => "Eine Sammlung von Werten"], "answer" => "c"],
    ["question" => "Was ist der Standardport für HTTP?", "options" => ["a" => "21", "b" => "80", "c" => "443"], "answer" => "b"],
    ["question" => "Welches Unternehmen entwickelte das Betriebssystem Windows?", "options" => ["a" => "Apple", "b" => "Google", "c" => "Microsoft"], "answer" => "c"],
    ["question" => "Was bedeutet CSS?", "options" => ["a" => "Computer Style Sheets", "b" => "Creative Style Sheets", "c" => "Cascading Style Sheets"], "answer" => "c"],
    ["question" => "Welches dieser Programmiersprachen ist keine objektorientierte Sprache?", "options" => ["a" => "Java", "b" => "Python", "c" => "C"], "answer" => "c"],
    ["question" => "Welche dieser Datenstrukturen ist FIFO?", "options" => ["a" => "Stack", "b" => "Queue", "c" => "Linked List"], "answer" => "b"],
    ["question" => "Was ist die Funktion von DNS?", "options" => ["a" => "E-Mail Versand", "b" => "Namensauflösung", "c" => "Netzwerküberwachung"], "answer" => "b"],
    ["question" => "Was ist der Zweck von Git?", "options" => ["a" => "Textverarbeitung", "b" => "Versionskontrolle", "c" => "Webdesign"], "answer" => "b"],
    ["question" => "Welches dieser Protokolle wird für sichere Webverbindungen verwendet?", "options" => ["a" => "HTTP", "b" => "FTP", "c" => "HTTPS"], "answer" => "c"],
    ["question" => "In welcher Programmiersprache ist die `print_r`-Funktion verfügbar?", "options" => ["a" => "JavaScript", "b" => "Python", "c" => "PHP"], "answer" => "c"],
    ["question" => "Was bedeutet SQL?", "options" => ["a" => "Structured Query Language", "b" => "Simple Query Language", "c" => "Standard Question Language"], "answer" => "a"],
    ["question" => "Welche dieser Programmiersprachen ist typischerweise für die Backend-Entwicklung verwendet?", "options" => ["a" => "HTML", "b" => "CSS", "c" => "PHP"], "answer" => "c"],
    ["question" => "Was ist eine IP-Adresse?", "options" => ["a" => "Ein Netzwerkprotokoll", "b" => "Eine eindeutige Kennung für ein Gerät im Netzwerk", "c" => "Ein Webserver-Dienst"], "answer" => "b"],
    ["question" => "Was ist eine API?", "options" => ["a" => "Application Programming Interface", "b" => "Applied Programming Interface", "c" => "Advanced Programming Integration"], "answer" => "a"],
    ["question" => "Welche dieser Technologien wird verwendet, um Webseiten zu gestalten?", "options" => ["a" => "JavaScript", "b" => "CSS", "c" => "SQL"], "answer" => "b"],
    ["question" => "Was ist ein SQL JOIN?", "options" => ["a" => "Eine Datenbankstruktur", "b" => "Ein Typ von Datenbankabfrage", "c" => "Ein Netzwerkprotokoll"], "answer" => "b"],
    ["question" => "Was beschreibt der Begriff 'Cloud Computing'?", "options" => ["a" => "Lokale Speicherung von Daten", "b" => "Verwendung von externen Servern über das Internet", "c" => "Entwicklung von Desktop-Anwendungen"], "answer" => "b"],
    ["question" => "Was bedeutet UI?", "options" => ["a" => "Universal Interface", "b" => "User Interface", "c" => "Unified Integration"], "answer" => "b"],
    ["question" => "Welche Programmiersprache wird oft für die Entwicklung von iOS-Anwendungen verwendet?", "options" => ["a" => "Java", "b" => "Swift", "c" => "C#"], "answer" => "b"],
    ["question" => "Was ist ein CMS?", "options" => ["a" => "Content Management System", "b" => "Custom Management Software", "c" => "Certified Management Standard"], "answer" => "a"],
    ["question" => "Welche der folgenden ist keine relationalen Datenbank?", "options" => ["a" => "MySQL", "b" => "MongoDB", "c" => "PostgreSQL"], "answer" => "b"],
    ["question" => "Was ist ein Cookie in Bezug auf Web-Technologie?", "options" => ["a" => "Ein Browser-Plugin", "b" => "Ein kleines Stück Daten, das vom Webserver an den Browser gesendet wird", "c" => "Ein Sicherheitsprotokoll"], "answer" => "b"],
    ["question" => "Welche Technologie wird oft für das Erstellen von Webanwendungen verwendet?", "options" => ["a" => "PHP", "b" => "Excel", "c" => "Word"], "answer" => "a"],
    ["question" => "Was bedeutet die Abkürzung API?", "options" => ["a" => "Application Programming Interface", "b" => "Advanced Programming Instruction", "c" => "Application Performance Index"], "answer" => "a"],
    ["question" => "Was ist ein Framework?", "options" => ["a" => "Ein Code, der das Verhalten einer Software definiert", "b" => "Ein System zur Datenbankverwaltung", "c" => "Ein Werkzeug zur Programmierung, das eine Struktur bietet"], "answer" => "c"],
    ["question" => "Was ist ein Bug in der Softwareentwicklung?", "options" => ["a" => "Ein Fehler im Code", "b" => "Ein Typ von Software", "c" => "Ein Programmierwerkzeug"], "answer" => "a"],
    ["question" => "Was ist ein Server?", "options" => ["a" => "Ein Gerät, das Anfragen von Clients verarbeitet", "b" => "Ein Typ von Datenbank", "c" => "Ein Programm zur Textverarbeitung"], "answer" => "a"],
    ["question" => "Welche Programmiersprache wird hauptsächlich für die Webentwicklung verwendet?", "options" => ["a" => "Java", "b" => "C++", "c" => "JavaScript"], "answer" => "c"],
    ["question" => "Was ist ein Algorithmus?", "options" => ["a" => "Ein mathematisches Modell", "b" => "Eine Schritt-für-Schritt-Anleitung zur Problemlösung", "c" => "Ein Datentyp"], "answer" => "b"],
    ["question" => "Was bedeutet der Begriff 'Big Data'?", "options" => ["a" => "Kleine Datenmengen", "b" => "Große Mengen an Daten, die analysiert werden", "c" => "Ein Programm zur Datenverwaltung"], "answer" => "b"],
    ["question" => "Was ist ein IDE?", "options" => ["a" => "Integrated Development Environment", "b" => "Internet Development Entity", "c" => "Interactive Design Editor"], "answer" => "a"],
    ["question" => "Was bezeichnet der Begriff 'Virtualisierung'?", "options" => ["a" => "Erstellung von virtuellen Maschinen und Ressourcen", "b" => "Datenverschlüsselung", "c" => "Netzwerkoptimierung"], "answer" => "a"],
    ["question" => "Was ist eine Blockchain?", "options" => ["a" => "Ein Datenbankformat", "b" => "Eine Kette von verschlüsselten Dateneinträgen", "c" => "Ein Typ von Datenprotokoll"], "answer" => "b"],
    ["question" => "Welche der folgenden Technologien ist für die Datenanalyse bekannt?", "options" => ["a" => "Python", "b" => "HTML", "c" => "CSS"], "answer" => "a"],
    ["question" => "Was ist eine SSL-Zertifizierung?", "options" => ["a" => "Ein Sicherheitsprotokoll für Websites", "b" => "Ein Typ von Datenbank", "c" => "Ein Webdesign-Framework"], "answer" => "a"],
    ["question" => "Was ist eine Variable in der Programmierung?", "options" => ["a" => "Ein Speicherort für Daten", "b" => "Ein Algorithmus", "c" => "Ein Programmiersprachenbefehl"], "answer" => "a"],
    ["question" => "Welche der folgenden Aussagen ist eine Programmiersprache?", "options" => ["a" => "Python", "b" => "SQL", "c" => "HTML"], "answer" => "a"],
    ["question" => "Was bedeutet GUI?", "options" => ["a" => "Graphical User Interface", "b" => "Global User Interaction", "c" => "General User Input"], "answer" => "a"],
    ["question" => "Was ist eine Datenbank?", "options" => ["a" => "Ein System zur Speicherung und Verwaltung von Daten", "b" => "Ein Texteditor", "c" => "Ein Webbrowser"], "answer" => "a"],
    ["question" => "Was ist der Unterschied zwischen HTTP und HTTPS?", "options" => ["a" => "HTTPS ist die sichere Version von HTTP", "b" => "HTTP ist schneller als HTTPS", "c" => "HTTPS ist ein Webserver"], "answer" => "a"],
    ["question" => "Was bedeutet API?", "options" => ["a" => "Application Programming Interface", "b" => "Application Performance Indicator", "c" => "Applied Programming Instruction"], "answer" => "a"],
    ["question" => "Was ist ein Cloud-Service?", "options" => ["a" => "Ein Service, der Ressourcen über das Internet bereitstellt", "b" => "Ein lokales Speichergerät", "c" => "Eine Netzwerkhardware"], "answer" => "a"],
    ["question" => "Welche Technologie wird verwendet, um Webseiten zu erstellen?", "options" => ["a" => "HTML", "b" => "JavaScript", "c" => "CSS"], "answer" => "a"],
    ["question" => "Was ist ein Framework?", "options" => ["a" => "Ein strukturiertes Set von Regeln und Tools zur Softwareentwicklung", "b" => "Ein Serverbetriebssystem", "c" => "Ein Algorithmus"], "answer" => "a"],
    ["question" => "Was ist ein Compiler?", "options" => ["a" => "Ein Programm, das Code in Maschinensprache übersetzt", "b" => "Ein Editor für Code", "c" => "Ein Datenbank-Management-System"], "answer" => "a"],
    ["question" => "Was ist die Aufgabe eines Webservers?", "options" => ["a" => "Bereitstellung von Webseiten über das Internet", "b" => "Verarbeitung von Datenbankabfragen", "c" => "Speicherung von E-Mails"], "answer" => "a"],
    ["question" => "Welches Protokoll wird für die E-Mail-Kommunikation verwendet?", "options" => ["a" => "SMTP", "b" => "HTTP", "c" => "FTP"], "answer" => "a"],
    ["question" => "Was bedeutet 'Backend' in der Softwareentwicklung?", "options" => ["a" => "Der Serverseitige Teil einer Anwendung", "b" => "Der benutzerseitige Teil einer Anwendung", "c" => "Ein Netzwerkprotokoll"], "answer" => "a"],
    ["question" => "Was ist eine Datenstruktur?", "options" => ["a" => "Eine Methode zur Organisation und Speicherung von Daten", "b" => "Ein Code zur Verschlüsselung von Daten", "c" => "Ein Programm zur Datenanalyse"], "answer" => "a"],
    ["question" => "Welches der folgenden ist ein Versionskontrollsystem?", "options" => ["a" => "Git", "b" => "MySQL", "c" => "Apache"], "answer" => "a"],
    ["question" => "Was ist ein ORM?", "options" => ["a" => "Object-Relational Mapping", "b" => "Object-Relative Management", "c" => "Open Resource Management"], "answer" => "a"],
    ["question" => "Was ist eine API-Rate-Limiting?", "options" => ["a" => "Begrenzung der Anzahl von Anfragen an eine API", "b" => "Ein Mechanismus zur Datenverschlüsselung", "c" => "Ein Webserver-Konfigurationstool"], "answer" => "a"],
    ["question" => "Was bedeutet OOP?", "options" => ["a" => "Object-Oriented Programming", "b" => "Object-Oriented Procedure", "c" => "Open Operating Platform"], "answer" => "a"],
    ["question" => "Was ist eine Session in der Webentwicklung?", "options" => ["a" => "Eine Benutzerinteraktion während eines Zeitraums", "b" => "Ein Datenbank-Management-Tool", "c" => "Ein Sicherheitsprotokoll"], "answer" => "a"],
    ["question" => "Welche Technologie wird verwendet, um Echtzeit-Datenkommunikation zu ermöglichen?", "options" => ["a" => "WebSocket", "b" => "HTTP", "c" => "FTP"], "answer" => "a"],
    ["question" => "Was ist ein Cache?", "options" => ["a" => "Ein schneller Speicher für häufig verwendete Daten", "b" => "Ein Programm zur Datenbankabfrage", "c" => "Ein System zur Verschlüsselung von Daten"], "answer" => "a"],
    ["question" => "Was bedeutet REST?", "options" => ["a" => "Representational State Transfer", "b" => "Remote State Transfer", "c" => "Regular State Transfer"], "answer" => "a"],
    ["question" => "Was ist ein Mock-Test?", "options" => ["a" => "Ein Test, der auf simulierten Daten basiert", "b" => "Ein Test für Software-Sicherheit", "c" => "Ein Test für die Benutzeroberfläche"], "answer" => "a"],
    ["question" => "Was ist ein Algorithmus?", "options" => ["a" => "Eine Schritt-für-Schritt-Anleitung zur Problemlösung", "b" => "Eine Programmiersprache", "c" => "Ein Datenbank-Modell"], "answer" => "a"],
    ["question" => "Was ist ein Virtual Private Network (VPN)?", "options" => ["a" => "Ein Netzwerk zur sicheren Verbindung über das Internet", "b" => "Ein öffentliches Netzwerk", "c" => "Ein lokales Netzwerk"], "answer" => "a"],
    ["question" => "Was ist ein Build-Tool?", "options" => ["a" => "Ein Werkzeug zur Automatisierung des Software-Bauprozesses", "b" => "Ein Programm zum Erstellen von Webseiten", "c" => "Ein Sicherheitswerkzeug"], "answer" => "a"],
    ["question" => "Was ist eine IDE?", "options" => ["a" => "Integrated Development Environment", "b" => "Integrated Data Environment", "c" => "Integrated Design Environment"], "answer" => "a"],
    ["question" => "Was beschreibt der Begriff 'Data Mining'?", "options" => ["a" => "Der Prozess des Entdeckens von Mustern in großen Datenmengen", "b" => "Ein Tool zum Datenmanagement", "c" => "Ein Sicherheitsprotokoll"], "answer" => "a"],
    ["question" => "Was ist ein Proxy-Server?", "options" => ["a" => "Ein Server, der Anfragen im Namen eines Clients weiterleitet", "b" => "Ein Webserver", "c" => "Ein Netzwerkprotokoll"], "answer" => "a"],
    ["question" => "Was bedeutet 'DevOps'?", "options" => ["a" => "Die Integration von Softwareentwicklung und IT-Betrieb", "b" => "Ein Datenbank-Management-System", "c" => "Ein Sicherheitsprotokoll"], "answer" => "a"],
    ["question" => "Was ist ein Microservice?", "options" => ["a" => "Ein kleiner, unabhängiger Dienst in einer verteilten Architektur", "b" => "Ein großes Monolithisches System", "c" => "Ein Sicherheitsdienst"], "answer" => "a"],
    ["question" => "Welche Programmiersprache wird häufig für die Web-Front-End-Entwicklung verwendet?", "options" => ["a" => "JavaScript", "b" => "Python", "c" => "PHP"], "answer" => "a"],
    ["question" => "Was ist ein Commit in der Versionskontrolle?", "options" => ["a" => "Eine dauerhafte Speicherung von Änderungen im Code", "b" => "Eine Art von Fehlerbericht", "c" => "Ein Datensicherungsprozess"], "answer" => "a"],
    ["question" => "Was ist der Zweck von Unit-Tests?", "options" => ["a" => "Die Überprüfung einzelner Teile eines Programms auf Korrektheit", "b" => "Die Analyse von Sicherheitsrisiken", "c" => "Die Performance-Optimierung eines Systems"], "answer" => "a"],
    ["question" => "Was ist ein Dependency Manager?", "options" => ["a" => "Ein Tool zur Verwaltung von Software-Abhängigkeiten", "b" => "Ein Sicherheitswerkzeug", "c" => "Ein Typ von Webserver"], "answer" => "a"],
    ["question" => "Was beschreibt der Begriff 'Continuous Integration'?", "options" => ["a" => "Der Prozess des regelmäßigen Zusammenführens und Testens von Codeänderungen", "b" => "Ein Datenbank-Management-System", "c" => "Ein Netzwerksicherheitsprotokoll"], "answer" => "a"],
    ["question" => "Was ist ein Algorithmus?", "options" => ["a" => "Ein Schritt-für-Schritt-Verfahren zur Lösung eines Problems", "b" => "Ein Datenbank-Typ", "c" => "Ein Programm zur Netzwerksicherheit"], "answer" => "a"],
    ["question" => "Was ist ein Versionskontrollsystem?", "options" => ["a" => "Ein System zur Nachverfolgung von Änderungen am Code", "b" => "Ein Netzwerkprotokoll", "c" => "Ein Typ von Datenbank"], "answer" => "a"]
];

// Funktion zur Auswahl von 5 zufälligen Fragen aus dem Pool
function getRandomQuestions($questions, $numQuestions = 5)
{
    $keys = array_rand($questions, $numQuestions);
    $randomQuestions = [];
    foreach ($keys as $key) {
        $randomQuestions[] = $questions[$key];
    }
    return $randomQuestions;
}

// Initialisierung der Fragen
if (!isset($_SESSION['questions'])) {
    $_SESSION['questions'] = getRandomQuestions($questionPool);
}

// Benutzerantworten verarbeiten
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $score = 0;
    foreach ($_SESSION['questions'] as $index => $question) {
        if (isset($_POST['question' . $index]) && $_POST['question' . $index] == $question['answer']) {
            $score++;
        }
    }
    $_SESSION['score'] = $score;
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<<html lang="de">

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
                color: #fff;
                /* Weißer Text */
            }

            .button-container {
                background-color: #2c3e50;
                border-radius: 10px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                padding: 20px;
                max-width: 600px;
                width: 100%;
                text-align: center;
            }

            .button-container h1 {
                color: #3498db;
                /* Blaue Überschrift */
            }

            .button-container p {
                color: #ecf0f1;
                /* Heller Text */
            }

            .button-container input[type="submit"] {
                padding: 10px 20px;
                font-size: 16px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                background-color: #3498db;
                color: #fff;
                transition: background-color 0.3s, transform 0.3s;
            }

            .button-container input[type="submit"]:hover {
                background-color: #2980b9;
                transform: scale(1.05);
            }

            .button-container a {
                text-decoration: none;
                color: white;
                transition: color 0.3s;
            }

            .button-container a:hover {
                color: #2980b9;
            }

            .back-button {
                background-color: #3498db;
                color: #fff;
                padding: 10px 20px;
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
                <?php if (isset($_SESSION['score'])) : ?>
                    <h1>Ergebnis</h1>
                    <p>Du hast <?php echo $_SESSION['score']; ?> von <?php echo count($_SESSION['questions']); ?> Fragen richtig beantwortet.</p>
                    <br><br>
                    <a href="https://learn-ia.com/frontend/views/internal/frontpage.php" class="cta-button">Zurück zur Hauptseite</a>
                    <?php session_destroy(); ?>
                <?php else : ?>
                    <h1>IT Quiz</h1>
                    <form method="post" action="">
                        <?php foreach ($_SESSION['questions'] as $index => $question) : ?>
                            <p><?php echo $question['question']; ?><br></p>
                            <?php foreach ($question['options'] as $key => $option) : ?>
                                <input type="radio" name="question<?php echo $index; ?>" value="<?php echo $key; ?>" required> <?php echo $option; ?><br>
                            <?php endforeach; ?>
                            <br>
                        <?php endforeach; ?>
                        <br><input type="submit" value="Absenden" class="cta-button">
                    </form>
                    <br>
                    <a href="https://learn-ia.com/frontend/views/internal/frontpage.php" class="back-button">Zurück zur Hauptseite</a>
                <?php endif; ?>
            </div>
            <div class="robot-container">
                <div class="speech-bubble">
                    Lass uns zusammen spielen!
                </div>
                <img src="../../../frontend/assets/images/lia1.png" alt="Lia" class="lia">
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