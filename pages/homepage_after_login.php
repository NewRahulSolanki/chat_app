<!-- pages/homepage_after_login.php -->
<?php 
session_start(); 
include '../includes/db.php'; 
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/scripts.js"></script>
</head>
<body>
    <h1>Posts from Friends</h1>
    <form id="post-form" action="post_message.php" method="POST">
        <textarea name="content" placeholder="What's on your mind?" required></textarea>
        <button type="submit">Post</button>
    </form>
    <div id="posts"></div>
    <div id="loading">Loading more posts...</div>
</body>
</html>
