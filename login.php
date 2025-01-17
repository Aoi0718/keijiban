<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>ログインページ</title>
</head>
<body>
<h2>ログイン画面</h2>
<h6>設定したIDとパスワードを入力してログイン</h6>
<?php
include "../db_open.php";

    echo "<div>";
    echo "<form method='POST' action='login_check.php'>";
    echo "<p>　　　　ID:<input type='text' name='id'></p>";
    echo "<p>パスワード:<input type='text' name='passwd'></p>";
    echo "<a href='touroku.php'>新規登録</a>";
    echo "　　　　　　　　";
    echo "<input type='submit' value='ログイン'>";
    echo "</div>";
?>
</body>
</html>