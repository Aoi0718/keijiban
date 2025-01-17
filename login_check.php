<?php
 include "../db_open.php";
 session_start();
 $sql = "select * from user";
 $sql_res = $dbh->query( $sql );
 $id = $_POST['id'];
 $passwd = $_POST['passwd'];
 $id = htmlspecialchars( $id, ENT_QUOTES, 'UTF-8' );
 $passwd = htmlspecialchars( $passwd, ENT_QUOTES, 'UTF-8' );
 
 while($rec = $sql_res->fetch()){
    if($rec['login_id'] == $id && $rec['passwd'] == $passwd){
        $_SESSION['login_id'] = $id;
        echo "<p>ログインが完了しました。</p>";
        echo "<a href='keijiban2.php'>掲示板へ</a>";
        exit;
    }

    }
    echo "error";
    
 
 