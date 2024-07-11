<?php

include ("C:xampp\htdocs\LearnIA\LearnIA\backend\config\dbconnect.php");

$name="Peter";
// $name=$_POST["username"];
// $password=$_POST["password"];
// $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $sql = "SELECT name, password\n"

    . "FROM `users` \n"

    . "WHERE name =\'$name\';";
    $userd=mysqli_query($con,$sql);
    var_dump($userd);
    

    // $sql="SELECT password \n"
    // . "FROM `users` \n"
    // . "WHERE name = \"$hashed_password\";";
    // $erg=mysqli_query($con,$sql);
    // echo $erg;


?>
