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
    <title>ユーザー設定：パスワード変更チェック</title>
</head>
<body>
    <?php
        if( $_SERVER["REQUEST_METHOD"] != "POST" ) {
            echo "<p>不正なアクセスです。</p>";
        } else {
            
        }
    ?>
</body>
</html>