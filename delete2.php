<?PHP
include "../db_open.php";
session_start();
if(empty($_SESSION['login_id'])){
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>掲示板</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="delete.css">
    </head>
    <body>
    <?php
    if( $_SERVER["REQUEST_METHOD"] != "POST" ){
        echo "<p>不正なアクセスです。</p>";
    }else{
        $id = $_POST['id'];
        $id2 = $_POST['login_id'];
        $pass = $_POST['passwd'];
        $toukou_id = $_POST['toukou_id'];
        // SQL
        $sql = "select * from user where login_id = '{$id2}'";
        $sql_res = $dbh->query( $sql );
        $rec = $sql_res->fetch();
        // パスワード認証
        if($rec['passwd'] === $pass ) {
            $sql = "DELETE FROM toukou where id = '{$toukou_id}'";
            $sql_res = $dbh->query( $sql );
            echo <<<___EOF___
            <div class="contents">
                <div class="border">
                    <h2>記事を削除しました。</h2>
                    <div class="container">
                        <p><a href="keijiban2.php" class="btn-border">掲示板に戻る</a></p>
                    </div>
                </div>
            </div>
            ___EOF___;
        }else{
            echo <<<___EOF___
            <div class="contents">
                <div class="border">
                    <h2>パスワードが違います。</h2>
                    <div class="container">
                        <a href="keijiban2.php" class="btn-border">掲示板に戻る</a>
                    </div>
                </div>
            </div>
            ___EOF___;
        }
            }
    ?>
    </body>
</html>