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
        if ( $_SERVER["REQUEST_METHOD"] == "POST") {
            $loginID = $_SESSION['login_id'];
            $ExPass = $_POST["ExPass"];         // 既存パスワード
            $NewPass = $_POST["NewPass"];       // 新規パスワード 
            $NewPassCon = $_POST["NewPassCon"]; // 新規パスワード(確認)
            // SQL
            $sql = "SELECT * FROM user WHERE login_id = '{$loginID}'";
            $sql_res = $dbh->query( $sql );
            $rec = $sql_res->fetch();

            if($rec['passwd'] === $ExPass) {
                if($NewPass === $NewPassCon) {
                    // SQL
                    $sql ="UPDATE user SET passwd = '{$NewPass}' WHERE login_id = '{$loginID}'";
                    $sql_res = $dbh->query( $sql );
                    $rec = $sql_res->fetch();

                    echo <<<___EOF___
                    <div class="contents">
                        <div class="border">
                            <h2>パスワードが変更されました。</h2>
                            <div class='container'><a href='keijiban2.php' class='btn-border'>掲示板に戻る</a></div>
                        </div>
                    </div>
                    ___EOF___;
                } else {
                    echo <<<___EOF___
                    <div class="contents">
                        <div class="border">
                            <h2>新規パスワードの入力に誤りがあります。</h2>
                            <div class='container'><a href='user_set.php' class='btn-border'>ユーザー編集画面に戻る</a></div>
                        </div>
                    </div>
                    ___EOF___;
                }
            } else {
                echo <<<___EOF___
                <div class="contents">
                    <div class="border">
                        <h2>既存パスワードが間違っています。</h2>
                        <div class='container'><a href='user_set.php' class='btn-border'>ユーザー編集画面に戻る</a></div>
                    </div>
                </div>
                ___EOF___;
            }
        } else {
            echo <<<___EOF___
            <div class="contents">
                <div class="border">
                    <h2>不正なアクセスです。</h2>
                </div>
            </div>
            ___EOF___;
        }
    ?>
</body>
</html>