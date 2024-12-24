<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規登録</title>
</head>
<body>
    <h1>新規投稿画面</h1>
    <form method="POST" action="exec_insert.php">
        <p>タイトル：<input type="text" name="title"></p>
        <p>投稿内容：<textarea name="content"></textarea></p>
        <input type="hidden" name="login_id" value="test">
        <input type="submit" value="投稿">
    </form>
    <?php
        include "../db_open.php";
    ?>
</body>
</html>