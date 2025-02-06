<?PHP
include "../db_open.php";
session_start();
if(empty($_SESSION['login_id'])){
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>ユーザー設定</title>
    <link rel='stylesheet' href='user_set.css'>
</head>
<body>
    <h1>ユーザーの設定変更</h1>
    <div class="sa">
        <div class="ys">
            <form method="POST" action="user_update.php">
                <input type="hidden" name="id" value="{<?php $_SESSION['login_id']; ?>}">
                <input type="submit" value="ユーザーの編集">
            </form>
        </div>
        <div class="nz">
            <form method="POST" action="user_delete.php">
                <input type="hidden" name="id" value="{<?php $_SESSION['login_id']; ?>}">
                <input type="submit" value="ユーザーの削除">
            </form>
        </div>
        <div class="ct">
            <form method="POST" action="user_passwd.php">
                <input type="hidden" name="id" value="{<?php $_SESSION['login_id']; ?>}">
                <input type="submit" value="パスワードの変更">
            </form>
        </div>
    </div>
    <div class="container">
    <a href="keijiban2.php" class="btn-border">戻る</a>
    </div>
</body>
</html>