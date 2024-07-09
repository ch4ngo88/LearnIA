<?php
require_once '../config/db.php';

function saveComment($date, $comment)
{
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO calendar_comments (date, comment) VALUES (:date, :comment)");
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':comment', $comment);

    return $stmt->execute();
}

function getComments($date)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT comment FROM calendar_comments WHERE date = :date");
    $stmt->bindParam(':date', $date);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['date']) && isset($_POST['comment'])) {
        $date = $_POST['date'];
        $comment = $_POST['comment'];

        if (saveComment($date, $comment)) {
            echo "Comment saved successfully!";
        } else {
            echo "Failed to save comment.";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['date'])) {
        $date = $_GET['date'];

        $comments = getComments($date);

        echo json_encode($comments);
    }
}
