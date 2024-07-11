<?php

include ("C:xampp\htdocs\LearnIA\LearnIA\backend\config\dbconnect.php");

$name=$_POST["username"];
$email=$_POST["email"];
$password=$_POST["password"];
$confirm_passowrd=$_POST["confirm_password"];


if($password==$confirm_passowrd){
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql="Insert into users(name, email, password) "
    ."values('$name','$email','$hashed_password');";
    mysqli_query($con,$sql);
    echo "Erfolgreich registriert";
}
    else{
        echo "Passwörter stimmen nicht überein";
        echo '<br><a href="https://learn-ia.com/frontend/views/register.html">zurück</a>';
    }

?>
