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
    <div class="middle">
        <div class="contents">
            <div class="border">
                <h2>ユーザーの設定変更</h2>
                <div class="flex">
                    <form method="POST" action="user_update.php">
                        <input type="hidden" name="id" value="{<?php $_SESSION['login_id']; ?>}">
                        <input type="submit" value="ユーザーの編集" class='update_button'>
                    </form>
                    <form method="POST" action="user_delete.php">
                        <input type="hidden" name="id" value="{<?php $_SESSION['login_id']; ?>}">
                        <input type="submit" value="ユーザーの削除" class='delete_button'>
                    </form>
                    <form method="POST" action="user_passwd.php">
                        <input type="hidden" name="id" value="{<?php $_SESSION['login_id']; ?>}">
                        <input type="submit" value="パスワードの変更" class="pass_button">
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <a href="keijiban2.php" class="btn-border">戻る</a>
        </div>
    </div>
</body>
</html>