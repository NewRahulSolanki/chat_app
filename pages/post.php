<!-- pages/post.php -->
<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = trim($_POST['content']);
    if (!empty($content)) {
        $stmt = $pdo->prepare("INSERT INTO posts (user_id, content) VALUES (:user_id, :content)");
        $stmt->execute(['user_id' => $_SESSION['user_id'], 'content' => htmlspecialchars($content)]);
    }
    header("Location: homepage_after_login.php");
    exit();
}
?>
