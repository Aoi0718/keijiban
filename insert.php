<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規登録</title>
    <link rel="stylesheet" href="insert.css">
</head>
<body>
    <h1>新規投稿画面</h1>
    <div class="content">
        <div class="border">
            <form method="POST" action="exec_insert.php">
                <p>タイトル：<input type="text" name="title"></p>
                <p>投稿内容：<textarea name="content"></textarea></p>
                <input type="hidden" name="login_id" value="test">
                <input type="submit" value="投稿">
            </form>
        </div>
    </div>
    <?php
        include "../db_open.php";
    ?>
</body>
</html>