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
    <link rel="stylesheet" href="logout.css">

</head>
<body>

    <?php
        if (isset($_POST['id'])) {
            // SQL
            $sql = "select * from toukou left outer join user on toukou.login_id = user.login_id order by date desc";
            $sql_res = $dbh->query($sql);
            $rec = $sql_res->fetch();

            echo <<<___EOF___
            <div class="center">
                <div class="border">
                    <h2>ログアウトしますか？</h2>
                    <div class="flex">
                        <div class="container">
                            <a href="keijiban2.php" class="btn-border">戻る</a>
                        </div>
                        <form action="logout_check.php" method="POST">
                            <input type="hidden" name="logout" value="{$rec['login_id']}">
                            <input type="submit" value="ログアウト" class="logout_button">
                        </form>
                    </div>
                </div>
            </div>
            ___EOF___;
        } else {
            echo "<p>不正なアクセスです。</p>";
        }
    ?>
</body>
</html>