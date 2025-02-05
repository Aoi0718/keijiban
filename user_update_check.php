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
    <title>ユーザー設定：編集チェック</title>
</head>
<body>
    <?php
        include "../db_open.php";

        if( $_SERVER["REQUEST_METHOD"] != "POST" ) {
            echo "<p>不正なアクセスです。</p>";
        } else {
            // 値の取り出し
            $loginID = $_POST['login_id'];
            $userName = $_POST['uname'];
            // XSS対策
            $loginID = htmlspecialchars($loginID, ENT_QUOTES, 'UTF-8');
            $userName = htmlspecialchars($userName, ENT_QUOTES, 'UTF-8');
            $icon = uniqid(mt_rand(), true);
            $icon .= '.' . substr(strrchr($_FILES['icon']['name'], '.'), 1);
            $file = "images/$icon";
            $fileExt = $_FILES['icon']['name'];     // ファイル名を取得
            $tmpfile = $_FILES['icon']['tmp_name'];
            $Ext = pathinfo($fileExt, PATHINFO_EXTENSION);
            $array = array("jpg", "jpeg" , "png", "gif");
            $size = $_FILES["icon"]["size"];
            if(is_uploaded_file($tmpfile)) {
                if(in_array($Ext, $array)) {
                    if($size < 2097152) {
                        if( !empty($_FILES['icon']['name'])){
                            move_uploaded_file($_FILES['icon']['tmp_name'], './images/' . $icon);
                            if(exif_imagetype($file)) {
                                // SQL
                                $sql = "SELECT * FROM user WHERE login_id = '{$loginID}'";
                                $sql_res = $dbh->query( $sql );
                                $rec = $sql_res->fetch();
                                $sql = "UPDATE user SET login_id = '{$loginID}', user_name = '{$userName}', icon = '{$icon}' WHERE login_id = '{$loginID}'";
                                $sql_res = $dbh->query( $sql );
                                $sql = "SELECT * FROM toukou WHERE login_id = '{$loginID}'";
                                $sql_res = $dbh->query( $sql );
                                $rec = $sql_res->fetch();
                                $sql = "UPDATE toukou SET login_id = '{$loginID}' WHERE login_id = '{$loginID}'";
                                $sql_res = $dbh->query( $sql );

                                echo "<h2>ユーザーの再登録が完了しました。</h2>";
                                echo "<a href='keijiban2.php'>掲示板に戻る</a>";
                            } else {
                                $message = '画像ファイルではありません。';
                                echo "<p><a href='user_update.php'>編集画面に戻る</a></p>";
                            }
                        }
                    } else {
                        echo "<h2>ファイルサイズが大きすぎます。</h2>";
                        echo "<p><a href='user_update.php'>編集画面に戻る</a></p>";
                    }
                } else {
                    echo "<h2>許可されている拡張子ではありません。</h2>";
                    echo "<p><a href='user_update.php'>編集画面に戻る</a></p>";
                }
            } else {
                echo "<h2>ファイルが選択されていません。</h2>";
                echo "<p><a href='user_update.php'>編集画面に戻る</a></p>";
            }
        }
    ?>
</body>
</html>