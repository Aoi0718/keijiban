<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='login_check.css'>
    <title>ログインチェック</title>
</head>
<body>
<?php
 include "../db_open.php";
 session_start();
 
 $id = $_POST['id'];
 $passwd = $_POST['passwd'];
 $id = htmlspecialchars( $id, ENT_QUOTES, 'UTF-8' );
 $passwd = htmlspecialchars( $passwd, ENT_QUOTES, 'UTF-8' );
<<<<<<< HEAD
 
 echo " <link rel='stylesheet' href='login_check.css'>";
=======

 $sql = "select * from user where login_id = '{$id}'";
 $sql_res = $dbh->query( $sql );
>>>>>>> origin/ishidaaoi
 while($rec = $sql_res->fetch()){
    if($rec['login_id'] == $id && $rec['passwd'] == $passwd){
        $_SESSION['login_id'] = $id;
        echo "<p>ログインが完了しました。</p>";
        echo "<a href='keijiban2.php'>掲示板へ</a>";
        exit;
    }

    }
    echo "<p>IDまたはパスワードに誤りがあります。</p>";
<<<<<<< HEAD
    echo "<a href='login.php' class='login' style='text-align: center;'>ログイン画面に戻る</a>";

=======
    echo "<a href='login.php' class='login'>ログイン画面に戻る</a>";
?>
</body>
</html>
>>>>>>> origin/ishidaaoi
    
 
 