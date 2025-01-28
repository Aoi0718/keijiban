<?php
$pdo = new PDO('mysql:host=localhost;dbname=掲示板DB;charset=utf8', 'ユーザー名', 'パスワード');

include "../db_open.php";
session_start();
if(empty($_SESSION['login_id'])){
    header('Location: login.php');
    exit();
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM posts WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) {
    die("投稿が見つかりません");
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>投稿編集</title>
</head>
<body>
    <h1>投稿編集</h1>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        <label>タイトル: <input type="text" name="title" value="<?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?>"></label><br>
        <label>内容: <textarea name="content"><?php echo htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8'); ?></textarea></label><br>
        <button type="submit">更新</button>
    </form>
    <a href="keijiban2.php">戻る</a>
</body>
</html>
