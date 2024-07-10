<?php
require_once '../config/db.php';

echo "droin";
//   session_cache_expire(1);
//   session_start();
//   $usr=$_POST["username"];
//   $pass=$_POST["password"];
//   if($usr=="james" && $pass=="oo7"){
//      $_SESSION["name"]=$usr;
//      $_SESSION["uhrzeit"]=date("d.m.Y H:i:s");
//      $_SESSION["eingeloggt"]=true;
//      header("Location: sessSeite1b.php");
//   }
//   else
//      header("Location: login.html");




// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
//     $stmt->bindParam(':username', $username);
//     $stmt->execute();

//     $user = $stmt->fetch(PDO::FETCH_ASSOC);

//     if ($user && password_verify($password, $user['password'])) {
//         session_start();
//         $_SESSION['user_id'] = $user['id'];
//         $_SESSION['username'] = $user['username'];
//         echo "Login successful!";
//     } else {
//         echo "Login failed!";
//     }

?>
