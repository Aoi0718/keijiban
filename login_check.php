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

    // 値の取り出し
    $id = $_POST['id'];
    $passwd = $_POST['passwd'];
    // XSS対策
    $id = htmlspecialchars( $id, ENT_QUOTES, 'UTF-8' );
    $passwd = htmlspecialchars( $passwd, ENT_QUOTES, 'UTF-8' );
    // SQL
    $sql = "select * from user where login_id = '{$id}'";
    $sql_res = $dbh->query( $sql );

        echo "<p>ログインが完了しました。</p>";
        echo "<div>";
        echo "<a href='keijiban2.php'>掲示板へ</a>";
        echo "</div>"; 
        exit;
    }

    }
    echo "<p>IDまたはパスワードに誤りがあります。</p>";
    echo "<div>";
    echo "<a href='login.php' class='login'>ログイン画面に戻る</a>";
    echo "</div>";
?>
</body>
</html>
    
 
 