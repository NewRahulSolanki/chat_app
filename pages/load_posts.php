<?php
// pages/load_posts.php
include '../includes/db.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5; // number of posts per page
$offset = ($page - 1) * $limit;

$stmt = $pdo->prepare("SELECT posts.id, posts.content, posts.created_at, users.username, 
                        (SELECT COUNT(*) FROM likes WHERE post_id = posts.id AND liked = 1) AS likes,
                        (SELECT COUNT(*) FROM likes WHERE post_id = posts.id AND liked = -1) AS dislikes
                        FROM posts 
                        JOIN users ON posts.user_id = users.id 
                        ORDER BY posts.created_at DESC 
                        LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($posts as $post) {
    echo "<div class='post' data-post-id='{$post['id']}'>
            <p>{$post['content']} <small>by {$post['username']} on {$post['created_at']}</small></p>
            <p>
                <button onclick='likePost({$post['id']})'>Like ({$post['likes']})</button>
                <button onclick='dislikePost({$post['id']})'>Dislike ({$post['dislikes']})</button>
            </p>
          </div>";
}
?>
