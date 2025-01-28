<?php
    include "../db_open.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>登録画面</title>
    <link rel="stylesheet" href="touroku.css">
</head>
<body>
    <div class="container">
        <h1>登録画面</h1>
        <p class="small">IDとパスワード、ユーザーネームを設定してください</p>
        <div class="border">
            <form method="POST" action="exec_touroku.php">
                <p>ログインID:<input type="text" name="id" pattern="^[a-zA-Z0-9]+$"></p>
                <p>パスワード:<input type="text" name="pass" pattern="^[a-zA-Z0-9]+$"></p>
                <p>ユーザーネーム:<input type="text" name="uname"></p>

                
                <input type="submit" value="登録">
            </form>
            <p><a class='back' href='login.php'>戻る</a></p>
        </div>
    </div>
</body>
</html>