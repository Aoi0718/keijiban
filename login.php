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
<h5>設定したIDとパスワードを入力してログイン</h5>
<?php
    echo <<<___EOF___
    <div class="container">
        <div class="border">
            <form method='POST' action='login_check.php'>
                <p>　　　　ID:<input type='text' name='id' pattern='^[a-zA-Z0-9]+$+@+.*\S+.*' required placeholder='30文字以内'></p>
                <p>パスワード:<input type='password' name='passwd' pattern='^[a-zA-Z0-9]+$+.*\S+.*'  required placeholder='30文字以内'></p>
                <a href='touroku.php' class='btn-border'>新規登録</a>
                <input type='submit' value='ログイン' class='button'>
            </form>
        </div>
    </div>
    ___EOF___;
?>
</body>
</html>