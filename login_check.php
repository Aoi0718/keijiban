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
<<<<<<< HEAD
<<<<<<< HEAD
 $sql = "select * from user";
 $sql_res = $dbh->query( $sql );
=======

>>>>>>> origin/komatsu
=======
 // 値の取り出し
>>>>>>> origin/komatsu
 $id = $_POST['id'];
 $passwd = $_POST['passwd'];
 // XSS対策
 $id = htmlspecialchars( $id, ENT_QUOTES, 'UTF-8' );
 $passwd = htmlspecialchars( $passwd, ENT_QUOTES, 'UTF-8' );
<<<<<<< HEAD
<<<<<<< HEAD
 
<<<<<<< HEAD
<<<<<<< HEAD
=======
 echo " <link rel='stylesheet' href='login_check.css'>";
>>>>>>> origin/main
=======

 $sql = "select * from user where login_id = '{$id}'";
 $sql_res = $dbh->query( $sql );
>>>>>>> origin/main
 while($rec = $sql_res->fetch()){
    if($rec['login_id'] == $id && $rec['passwd'] == $passwd){
        $_SESSION['login_id'] = $id;
=======
 $sql = "select * from user where login_id = '{$id}'";
 $sql_res = $dbh->query( $sql );

 while($rec = $sql_res->fetch()){
    if($rec['login_id'] == $id && $rec['passwd'] == $passwd){
        // セッション
        $_SESSION['id'] = $id;
        $_SESSION['login_id'] = $rec['login_id'];
        $_SESSION['uname'] = $rec['user_name'];
        var_dump($_SESSION['uname']);
        
>>>>>>> origin/komatsu
=======

 $sql = "select * from user where login_id = '{$id}'";
 $sql_res = $dbh->query( $sql );
 while($rec = $sql_res->fetch()){
    if($rec['login_id'] == $id && $rec['passwd'] == $passwd){
        $_SESSION['login_id'] = $id;
>>>>>>> origin/komatsu
        echo "<p>ログインが完了しました。</p>";
        echo "<a href='keijiban2.php'>掲示板へ</a>";
        exit;
    }

    }
    echo "<p>IDまたはパスワードに誤りがあります。</p>";
<<<<<<< HEAD
<<<<<<< HEAD
    echo "<a href='login.php' class='login' style='text-align: center;'>ログイン画面に戻る</a>";

=======
=======
    echo "<div>";
>>>>>>> origin/main
    echo "<a href='login.php' class='login'>ログイン画面に戻る</a>";
    echo "</div>";
?>
</body>
</html>
<<<<<<< HEAD
>>>>>>> origin/komatsu
=======
>>>>>>> origin/main
    
 
 