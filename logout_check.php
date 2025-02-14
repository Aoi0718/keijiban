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
    <title>ログアウトチェック</title>
    <link rel="stylesheet" href="logout_check.css">
</head>
<body>
    <?php
        if( $_SERVER["REQUEST_METHOD"] != "POST" ) {
            echo <<<___EOF___
            <div class="contents">
                <div class="border">
                    <h2>不正なアクセスです。</h2>
                </div>
            </div>
            ___EOF___;
        } else {
            session_destroy();
            echo <<<___EOF___
            <div class="contents">
                <div class="border">
                    <h2>ログアウトしました。</h2>
                    <div class='container'><a href='login.php' class='btn-border'>ログイン画面へ</a></div>
                </div>
            </div>
            ___EOF___;
        }
    ?>
</body>
</html>