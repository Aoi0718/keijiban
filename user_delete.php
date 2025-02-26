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
    <title>ユーザー設定：削除</title>
    <link rel='stylesheet' href='user_delete.css'>
</head>
<body>
    <?php
        if (isset($_POST['id'])) {
            $login_id = $_SESSION['login_id'];
            $sql = "select * from user where login_id = '$login_id'";
            $sql_res = $dbh->query($sql);
            $rec = $sql_res->fetch();

            echo <<<___EOF___
            <h2>このユーザーを削除しますか？</h2>
            <div class="contents">
                <div class="border">
                    <form method="POST" action="user_delete_check.php">
                        <div class="xl">
                            <h1><img src="images/{$rec['icon']}" width="200" height="200" style="border-radius: 50%;"></h1>
                        </div>
                        <div class="nz">
                            <h3>{$rec['user_name']}</h3>
                            <p>パスワード:<input type="password" name="passwd"><br>
                            <input type="hidden" name="login_id" value='{$rec['login_id']}'>
                            <input type="submit" value="削除する" class="delete_button">
                        </div>
                    </form>
                </div>
            </div>
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