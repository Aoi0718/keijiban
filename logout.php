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
    <title>ログアウト</title>
</head>
<body>
    <?php
        if (isset($_POST['id'])) {
            // SQL
            $sql = "select * from toukou left outer join user on toukou.login_id = user.login_id order by date desc";
            $sql_res = $dbh->query($sql);
            $rec = $sql_res->fetch();

            echo <<<___EOF___
                <h1>確認</h1>
                <h2>ログアウトしますか？</h2>
                <a href="keijiban2.php">戻る</a>
                <form action="logout_check.php" method="POST">
                    <input type="hidden" name="logout" value="{$rec['login_id']}">
                    <input type="submit" value="ログアウト">
                </form>
            ___EOF___;
        } else {
            echo "<p>不正なアクセスです。</p>";
        }
    ?>
</body>
</html>