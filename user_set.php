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
</head>
<body>
    <h1>ユーザーの設定変更</h1>
    <a href="keijiban2.php">戻る</a>

    <form method="POST" action="user_update.php">
        <input type="hidden" name="id" value="{<?php $rec['login_id']; ?>}">
        <input type="submit" value="ユーザーの編集">
    </form>
    <form method="POST" action="user_delete.php">
        <input type="hidden" name="id" value="{<?php $rec['login_id']; ?>}">
        <input type="submit" value="ユーザーの削除">
    </form>
    <form method="POST" action="user_passwd.php">
        <input type="hidden" name="id" value="{<?php $rec['login_id']; ?>}">
        <input type="submit" value="パスワードの変更">
    </form>
</body>
</html>