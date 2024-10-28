<?php
// pages/like_post.php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];
$action = $_POST['action']; // 'like' or 'dislike'

$liked = $action === 'like' ? 1 : -1;

// Check if already liked or disliked
$stmt = $pdo->prepare("SELECT * FROM likes WHERE user_id = :user_id AND post_id = :post_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':post_id', $post_id);
$stmt->execute();
$existing_like = $stmt->fetch(PDO::FETCH_ASSOC);

if ($existing_like) {
    // If already liked, update the existing entry
    $stmt = $pdo->prepare("UPDATE likes SET liked = :liked WHERE user_id = :user_id AND post_id = :post_id");
    $stmt->bindParam(':liked', $liked);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':post_id', $post_id);
    $stmt->execute();
} else {
    // If not liked, insert new entry
    $stmt = $pdo->prepare("INSERT INTO likes (user_id, post_id, liked) VALUES (:user_id, :post_id, :liked)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':post_id', $post_id);
    $stmt->bindParam(':liked', $liked);
    $stmt->execute();
}

echo json_encode(['success' => true]);
?>
