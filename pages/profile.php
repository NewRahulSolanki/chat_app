<!-- pages/profile.php -->
<?php include '../includes/db.php'; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Profile</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Your Profile</h1>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user = $stmt->fetch();
    ?>
    <p>Username: <?= htmlspecialchars($user['username']); ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
