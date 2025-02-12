<?PHP
include "../db_open.php";
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
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
    echo "<div>";
    echo "<form method='POST' action='login_check.php'>";
    echo "<p>　　　　ID:<input type='text' name='id' pattern='^[a-zA-Z0-9]+$+@+.*\S+.*' required placeholder='30文字以内'></p>";
    echo "<p>パスワード:<input type='password' name='passwd' pattern='^[a-zA-Z0-9]+$+.*\S+.*'  required placeholder='30文字以内'></p>";
    echo "<a href='touroku.php'><input type='button' id='button' value='新規登録'></a>";
    echo "　　　　　　　　";
    echo "<input type='submit' value='ログイン'>";
    echo "</div>";
?>
</body>
</html>