<?php
require_once '../config/db.php';

function getUserById($id)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateUser($id, $username, $email)
{
    global $pdo;

    $stmt = $pdo->prepare("UPDATE users SET username = :username, email = :email WHERE id = :id");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $id);

    return $stmt->execute();
}

function changePassword($id, $newPassword)
{
    global $pdo;
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':id', $id);

    return $stmt->execute();
}
