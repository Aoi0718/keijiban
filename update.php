<?PHP
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit.css">
    <title>記事の編集</title>
</head>
<body>
<div class="content">
        <div class="border">
            <form method="POST" enctype="multipart/form-data" action="exec_insert.php">
                <p>タイトル：<input type="text" name="title" pattern=".*\S+.*" required placeholder="30文字以内"></p>
                <div class='content'>
                <p class="toukou">投稿内容：</p>
                <textarea name="content" pattern=".*\S+.*" required placeholder="200文字以内"></textarea>
                </div>
                <input type="file" name="image">
                <input type="submit" name="upload" value="投稿">
            </form>
            <div class="container">
                <a href="keijiban2.php" class="btn-border">戻る</a>
            </div>

        </div>
    </div>
</body>
</html>