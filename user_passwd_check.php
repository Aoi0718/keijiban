<?PHP
include "../db_open.php";
session_start();
if(empty($_SESSION['login_id'])){
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>ユーザー設定：パスワード変更チェック</title>
    <link rel="stylesheet" href="user_update_check.css">
</head>
<body>
    <?php
        if (isset($_POST['login_id'])) {
            $loginID = $_POST["login_id"];
            $ExPass = $_POST["ExPass"];         // 既存パスワード
            $NewPass = $_POST["NewPass"];       // 新規パスワード 
            $NewPassCon = $_POST["NewPassCon"]; // 新規パスワード(確認)
            // SQL
            $sql = "SELECT * FROM user WHERE login_id = '{$loginID}'";
            $sql_res = $dbh->query( $sql );
            $rec = $sql_res->fetch();

            if($rec && $rec['passwd'] === $ExPass) {
                if($NewPass === $NewPassCon) {
                    // SQL
                    $sql ="UPDATE user SET passwd = '{$NewPass}' WHERE login_id = '{$loginID}'";
                    $sql_res = $dbh->query( $sql );
                    $rec = $sql_res->fetch();

                    echo "<h2>パスワードが変更されました。</h2>";
                    echo "<div class='container'><a href='keijiban2.php' class='btn-border'>掲示板戻る</a></div>";

                } else {
                    echo "<p>新規パスワードに誤りがあります。</p>";
                    echo "<div class='container'><a href='user_set.php'>戻る</a></div>";
                }
            } else {
                echo "<p>既存パスワードが間違っています。</p>";
                echo "<div class='container'><a href='user_set.php' class='btn-border'>戻る</a></div>";
            }
        } else {
            echo "<p>不正なアクセスです。</p>";
        }
    ?>
</body>
</html>