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
</head>
<body>
    <?php
        include "../db_open.php";
        if( $_SERVER["REQUEST_METHOD"] != "POST" ) {
            echo "<p>不正なアクセスです。</p>";
        } else {
            $loginID = $_POST['login_id'];
            $pass = $_POST['passwd'];
            $sql = "select * from toukou left outer join user on toukou.login_id = user.login_id";
            $sql_res = $dbh->query( $sql );
            $rec = $sql_res->fetch();
            if( $rec && $rec['passwd'] === $pass ){
                // SQL
                $sql = "DELETE FROM toukou where login_id = '{$loginID}'";
                $sql_res = $dbh->query( $sql );
                $sql = "DELETE FROM user where login_id = '{$loginID}'";
                $sql_res = $dbh->query( $sql );
                
                echo "<p>ユーザーが削除されました。</p>";
                echo "<a href='login.php'>ログイン画面に戻る</a>";
            }else{
                echo "<p>パスワードが違います。</p>";
                echo "<a href='user_delete.php'>戻る</a>";
            }
        }
    ?>
</body>
</html>