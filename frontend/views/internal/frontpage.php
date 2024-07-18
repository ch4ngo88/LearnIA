<!DOCTYPE html>
<?php session_start() ?>
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
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <style>
    .flex-container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    @media (min-width: 768px) {
      .flex-container {
        flex-direction: row;
        justify-content: space-between;
      }
    }

    .menu-bar,
    .robot-container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .menu-bar .auth-buttons,
    .menu-bar .menu-button {
      margin-bottom: 10px;
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

    .tooltip {
      display: none;
      position: absolute;
      background-color: #333;
      color: #fff;
      padding: 5px;
      border-radius: 5px;
      font-size: 12px;
      z-index: 1000;
      white-space: nowrap;
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
    <article>
      <!-- Icon menu container -->
      <ul class="menu">
        <!-- Menu toggle button -->
        <div class="menuToggle">
          <ion-icon name="add-outline"></ion-icon>
        </div>
        <!-- Menu items with icons and colors -->
        <li style="--i: 0; --clr: rgb(248, 177, 242);" data-tooltip="Rede mit Lia">
          <a href="lia.html">
            <ion-icon name="home-outline"></ion-icon>
          </a>
        </li>
        <li style="--i: 1; --clr: white;" data-tooltip="Lia Technik">
          <a href="liainfo.html">
            <ion-icon name="settings-outline"></ion-icon>
          </a>
        </li>
        <li style="--i: 2; --clr: #ef60fc;" data-tooltip="under_construction">
          <a href="under_construction.html">
            <ion-icon name="mail-outline"></ion-icon>
          </a>
        </li>
        <li style="--i: 3; --clr: #70f6eb;" data-tooltip="Anschauen">
          <a href="https://learn-ia.com/frontend/views/internal/viewfiles.php">
            <ion-icon name="bookmarks-outline"></ion-icon>
          </a>
        </li>
        <li style="--i: 4; --clr: #6b5ef7;" data-tooltip="Hochladen">
          <a href="upload.php">
            <ion-icon name="camera-outline"></ion-icon>
          </a>
        </li>
        <li style="--i: 5; --clr: rgb(79, 215, 246);" data-tooltip="Quiz">
          <a href="quiz.php">
            <ion-icon name="game-controller-outline"></ion-icon>
          </a>
        </li>
        <li style="--i: 6; --clr: white;" data-tooltip="Profil">
          <a href="profile.php">
            <ion-icon name="person-outline"></ion-icon>
          </a>
        </li>
        <li style="--i: 7; --clr: #1eabd5;" data-tooltip="under_construction">
          <a href="under_construction.html">
            <ion-icon name="bulb-outline"></ion-icon>
          </a>
        </li>
      </ul>
      <div class="tooltip" id="tooltip"></div>

      <!-- Audio elements for sound effects -->
      <audio id="toggleSound">
        <source src="../../assets/audio/close.mp3" type="audio/mpeg" />
        <source src="../../assets/audio/close.ogg" type="audio/ogg" />
      </audio>

      <audio id="openSound">
        <source src="../../assets/audio/open.mp3" type="audio/mpeg" />
        <source src="../../assets/audio/open.ogg" type="audio/ogg" />
      </audio>

      <audio id="hoverSound">
        <source src="../../assets/audio/beep.mp3" type="audio/mpeg" />
        <source src="../../assets/audio/beep.ogg" type="audio/ogg" />
      </audio>
    </article>
    <div class="robot-container">
      <div class="speech-bubble" id="speechBubble">
        Hallo, Guten Tag!
      </div>
      <!-- <div class="nupsi"></div> -->
      <img src="../../assets/images/lia1.png" alt="Lia" class="lia" />
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

    $(document).ready(function() {
      var toggleSound = $("#toggleSound")[0];
      var openSound = $("#openSound")[0];
      var hoverSound = $("#hoverSound")[0];

      let menuToggle = document.querySelector(".menuToggle");
      let menu = document.querySelector(".menu");
      let speechBubble = document.getElementById("speechBubble");
      let tooltip = document.getElementById("tooltip");
      let hoverTimeout;

      // Überprüfe den gespeicherten Menüstatus und stelle ihn wieder her
      if (localStorage.getItem("menuActive") === "true") {
        menu.classList.add("active");
        speechBubble.innerHTML = "Was machen wir denn heute Schönes?";
      }

      $.ajax({
        url: "../../../backend/controllers/get_username.php",
        method: "GET",
        dataType: "json",
        success: function(data) {
          if (data.name) {
            let greeting = getGreeting();
            speechBubble.innerHTML = `Hallo ${data.name}, ${greeting}!`;
          }
        },
        error: function() {
          speechBubble.innerHTML = "Hallo, Guten Morgen!";
        },
      });

      function getGreeting() {
        let hour = new Date().getHours();
        if (hour < 12) {
          return "Guten Morgen";
        } else if (hour < 18) {
          return "Guten Tag";
        } else {
          return "Guten Abend";
        }
      }

      menuToggle.onclick = function() {
        menu.classList.toggle("active");
        if (menu.classList.contains("active")) {
          speechBubble.innerHTML = "Was machen wir denn heute Schönes?";
          localStorage.setItem("menuActive", "true");
          openSound.currentTime = 0; // Reset the audio to start from the beginning
          openSound.play();
        } else {
          speechBubble.innerHTML = "Bist Du etwa schon fertig?";
          localStorage.setItem("menuActive", "false");
        }
        toggleSound.currentTime = 0; // Reset the audio to start from the beginning
        toggleSound.play();
      };

      $("a").mouseenter(function() {
        hoverSound.currentTime = 0; // Reset the audio to start from the beginning
        hoverSound.play();
      });

      $("li")
        .mouseenter(function(event) {
          var $this = $(this);
          hoverTimeout = setTimeout(function() {
            var tooltipText = $this.attr("data-tooltip");
            var offset = $this.offset();
            tooltip.innerHTML = tooltipText;
            tooltip.style.top = offset.top - tooltip.offsetHeight - 10 + "px";
            tooltip.style.left =
              offset.left +
              $this.width() / 2 -
              tooltip.offsetWidth / 2 +
              "px";
            tooltip.style.display = "block";
          }, 2000); // 2 seconds delay
        })
        .mouseleave(function() {
          clearTimeout(hoverTimeout);
          tooltip.style.display = "none";
        });
    });
  </script>
</body>

</html>