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
    <link rel="stylesheet" href="insert.css">   
    <title>記事の編集</title>
</head>
<body>
<h1>編集画面</h1>
    <div class="content">
        <div class="border">
            <form method="POST" enctype="multipart/form-data" action="edit2.php">
                <p>タイトル：<input type="text" name="title" pattern=".*\S+.*" required placeholder="30文字以内"></p>
                <div class='content'>
                <p class="toukou">編集内容：</p>
                <textarea name="content" pattern=".*\S+.*" required placeholder="200文字以内"></textarea>
                </div>
                <input type="file" name="image">
                <input type="submit" name="upload" value="投稿">
            </form>
            <p><a href="keijiban2.php">戻る</a></p>
        </div>
    </div>


</body>
</html>