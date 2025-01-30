<?php
include "../db_open.php";
session_start();

if(empty($_SESSION['login_id'])){
    header('Location: login.php');
    exit();
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>投稿編集</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <h1>投稿編集</h1>
    <form method="POST" enctype="multipart/form-data" action="update.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($post['id'], ENT_QUOTES, 'UTF-8') ?>">
        <label for="title">タイトル:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>" maxlength="30">
        <br><br>
        <label for="content">投稿内容:</label>
        <textarea name="content" maxlength="200"><?= htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8') ?></textarea>
        <br><br>
        <label for="image">画像:</label>
        <input type="file" name="image">
        <br><br>
        <input type="submit" value="更新">
    </form>
    <div class="container">
        <a href="keijiban2.php" class="btn-border">戻る</a>
    </div>
</body>
</html>
