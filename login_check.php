<?php
 include "../db_open.php";
 session_start();
<<<<<<< HEAD
 $sql = "select * from user";
 $sql_res = $dbh->query( $sql );
=======

>>>>>>> origin/komatsu
 $id = $_POST['id'];
 $passwd = $_POST['passwd'];

 $id = htmlspecialchars( $id, ENT_QUOTES, 'UTF-8' );
 $passwd = htmlspecialchars( $passwd, ENT_QUOTES, 'UTF-8' );
 
<<<<<<< HEAD
<<<<<<< HEAD
=======
 echo " <link rel='stylesheet' href='login_check.css'>";
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
        echo "<p>ログインが完了しました。</p>";
        echo "<a href='keijiban2.php'>掲示板へ</a>";
        exit;
    }

    }
    echo "<p>IDまたはパスワードに誤りがあります。</p>";
    echo "<a href='login.php' class='login' style='text-align: center;'>ログイン画面に戻る</a>";

    
 
 