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
            echo "<p>不正なアクセスです。</p>";
        } else {
            session_destroy();
            echo "<p>ログアウトしました。</p>";
            echo "<div class='container'><a href='login.php' class='btn-border'>ログイン画面へ</a></div>";
        }
    ?>
</body>
</html>