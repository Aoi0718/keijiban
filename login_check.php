<?php
 include "../db_open.php";
 session_start();

 $id = $_POST['id'];
 $passwd = $_POST['passwd'];

 $id = htmlspecialchars( $id, ENT_QUOTES, 'UTF-8' );
 $passwd = htmlspecialchars( $passwd, ENT_QUOTES, 'UTF-8' );
 
 $sql = "select * from user where login_id = '{$id}'";
 $sql_res = $dbh->query( $sql );

 while($rec = $sql_res->fetch()){
    if($rec['login_id'] == $id && $rec['passwd'] == $passwd){
        // セッション
        $_SESSION['id'] = $id;
        // $_SESSION['login_id'] = $rec['login_id'];
        var_dump($_SESSION['uname']);
        
        echo "<p>ログインが完了しました。</p>";
        echo "<a href='keijiban2.php'>掲示板へ</a>";
        exit;
    }

    }
    echo "error";
 
 