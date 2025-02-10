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
    <title>ユーザー設定：パスワード変更</title>
    <link rel='stylesheet' href='user_passwd.css'>
</head>
<body>
    <?php
        if (isset($_POST['id'])) {
            
            echo <<<___EOF___
                <h2>パスワード変更</h2>
                <form method="POST" action="user_passwd_check.php">
                    <p>既存パスワード：<input type="password" name="ExPass"></p>
                    <p>新規パスワード：<input type="password" name="NewPass"></p>
                    <p>新規パスワード(確認)：<input type="password" name="NewPassCon"></p>
                    <input type="submit" value="パスワードを変更">
                </form>
                <div class="container">
                <a href="user_set.php" class="btn-border">戻る</a>
                </div>
            ___EOF___;
        } else {
            echo "<p>不正なアクセスです。</p>";
        }
    ?>
</body>
</html>