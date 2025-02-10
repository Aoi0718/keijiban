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
    <title>ユーザー設定：削除チェック</title>
    <link rel="stylesheet" href="user_update_check.css">
</head>
<body>
    <?php
        if (isset($_POST['login_id'])) {
            $loginID = $_POST['login_id'];
            $pass = $_POST['passwd'];
            $sql = "select * from user where login_id = '{$loginID}'";
            $sql_res = $dbh->query( $sql );
            $rec = $sql_res->fetch();
            if($rec['passwd'] === $pass ){
                $sql = "DELETE FROM toukou where login_id = '{$loginID}'";
                $sql_res = $dbh->query( $sql );
                $sql = "DELETE FROM user where login_id = '{$loginID}'";
                $sql_res = $dbh->query( $sql );
                
                echo "<p>ユーザーが削除されました。</p>";
                echo "<div='container'><a href='login.php' class='btn-border'>ログイン画面に戻る</a></div>";
            }else{
                echo "<p>パスワードが違います。</p>";
                echo "<div='container'><a href='user_set.php' class='btn-border'>ユーザー編集画面に戻る</a></div>";
            }
        } else {
            echo "<p>不正なアクセスです。</p>";
        }
    ?>
</body>
</html>