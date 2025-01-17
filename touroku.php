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
                <p>ログインID:<input type="text" name="id"></p>
                <p>パスワード:<input type="text" name="pass"></p>
                <p>ユーザーネーム:<input type="text" name="uname"></p>
                <input type="submit" value="登録">
            </form>
        </div>
    </div>

    <style>
        body {
            background-image: url("okumono_mahjonggara10-1536x864.png");
        }
    </style>
    <?php
        include "../db_open.php";
        session_start();
    ?>
</body>
</html>