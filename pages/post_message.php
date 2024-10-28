<?php
// pages/post_message.php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO posts (user_id, content) VALUES (:user_id, :content)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':content', $content);

    try {
        $stmt->execute();
        header("Location: homepage_after_login.php");
        exit();
    } catch (PDOException $e) {
        echo "Error posting message: " . $e->getMessage();
    }
}
?>
