<?PHP
include "../db_open.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='login_check.css'>
    <title>ログインチェック</title>
</head>
<body>
<?php
    // 値の取り出し
    $id = $_POST['id'];
    $passwd = $_POST['passwd'];
    // XSS対策
    $id = htmlspecialchars( $id, ENT_QUOTES, 'UTF-8' );
    $passwd = htmlspecialchars( $passwd, ENT_QUOTES, 'UTF-8' );
    // SQL
    $sql = "select * from user where login_id = '{$id}'";
    $sql_res = $dbh->query( $sql );
    while($rec = $sql_res->fetch()) {
        if($rec['login_id'] == $id && $rec['passwd'] == $passwd){
            // セッション
            $_SESSION['id'] = $id;
            $_SESSION['login_id'] = $rec['login_id'];
            $_SESSION['icon']  = $rec['icon'];
            echo <<<___EOF___
            <div class="contents">
                <div class="border">
                    <h2>ログインが完了しました。</h2>
                    <div class='container'>
                        <a href='keijiban2.php' class='btn-border'>掲示板へ</a>
                    </div>
                </div>
            </div>
            ___EOF___;
            exit;
        }
    }
    echo "<p>IDまたはパスワードに誤りがあります。</p>";
    echo "<div>";
    echo "<div class='container'><a href='login.php' class='btn-border'>ログイン画面へ</a>";
    echo "</div>";
?>
</body>
</html>