<?php
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
    <title>新規登録</title>
    <link rel="stylesheet" href="insert.css">
</head>
<body>
    <h1>新規投稿画面</h1>
    <div class="content">
        <div class="border">
            <form method="POST" action="exec_insert.php">
                <p>タイトル：<input type="text" name="title" required>　　　　　　投稿内容：<textarea name="content" required></textarea></p>
                <input type="submit" value="投稿">
            </form>
            <a href="keijiban2.php"><input type="submit" value="戻る"></a>
        </div>
    </div>

    <style>
        body {
            background-image: url("okumono_mahjonggara10-1536x864.png");
        }
    </style>
</body>
</html>