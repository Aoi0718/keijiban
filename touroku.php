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
                <p>ログインID:<input type="text" name="id" pattern="^[a-zA-Z0-9]+$+@+.*\S+.*" required  placeholder="30文字以内"></p>
                <p>パスワード:<input type="password" name="pass" pattern="^[a-zA-Z0-9]+$+.*\S+.*" required  placeholder="30文字以内"></p>
                <p>ユーザーネーム:<input type="text" name="uname" pattern=".*\S+.*" required placeholder="30文字以内"></p>
                <input type="submit" value="登録">
            </form>
            <p><a class='back' href='login.php'>戻る</a></p>
        </div>
    </div>

    <style>
        body {
            background-image: url("okumono_mahjonggara10-1536x864.png");
        }
        .border{
            background-color: white;
        }
        a{
            text-decoration: none;
            color:black;
        }
    </style>
</body>
</html>