<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登録完了画面</title>
</head>
<body>
    
    <?php
        include "../db_open.php";

        if( $_SERVER["REQUEST_METHOD"] != "POST" ) {
            echo "<p>不正なアクセスです。</p>";
        } else {
            // 値の取り出し
            $LoginID = $_POST['id'];
            $pass = $_POST['pass'];
            $uname = $_POST['uname'];
            // XSS対策
            $LoginID = htmlspecialchars($LoginID, ENT_QUOTES, 'UTF-8');
            $pass = htmlspecialchars($pass, ENT_QUOTES, 'UTF-8');
            $uname = htmlspecialchars($uname, ENT_QUOTES, 'UTF-8');
            // SQL
            $sql = "SELECT * FROM toukou LEFT outer join user on toukou.login_id = user.login_id";
            $sql_res = $dbh->query( $sql );
            $sql = "INSERT INTO user VALUE ('{$LoginID}','{$pass}','{$uname}')";
            $sql_res = $dbh->query( $sql );

            echo "<p>ユーザーの登録が完了しました。</p>";
            echo "<p>ログイン画面に戻る</p>";
        }
    ?>
    <style>
        body {
            background-image: url("okumono_mahjonggara10-1536x864.png");
        }
        p {
            text-align: center;
        }
    </style>
</body>
</html>