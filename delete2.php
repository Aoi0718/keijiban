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
        <h2>記事の削除</h2>
<?php

    if( $_SERVER["REQUEST_METHOD"] != "POST" ){
        echo "<p>不正なアクセスです。</p>";
    }else{
        $id = $_POST['id'];
        $id2 = $_POST['login_id'];
        $pass = $_POST['passwd'];
        $sql = "select * from toukou left outer join user on toukou.login_id = user.login_id order by date desc";
        $sql_res = $dbh->query( $sql );
        $rec = $sql_res->fetch();
        if( $rec && $rec['passwd'] === $pass ){
            $sql = "DELETE FROM toukou where id = '$id'";
            $sql_res = $dbh->query( $sql );
            echo "<p>記事を削除しました。</p>";
        }else{
            echo "<p>パスワードが違います。</p>";
        }
            }
?>
    <div class="container">
        <a href="keijiban2.php" class="btn-border">戻る</a>
    </div>
    </body>
</html>