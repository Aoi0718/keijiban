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
    <link rel="stylesheet" href="user_update_check.css">
</head>
<body>
    <?php
        include "../db_open.php";

        if (isset($_POST['id'])) {
            // 値の取り出し
            $loginID = $_POST['login_id'];
            $userName = $_POST['uname'];
            $id = $_POST['id'];
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
                                $sql = "SELECT * FROM user WHERE login_id = '{$id}'";
                                $sql_res = $dbh->query( $sql );
                                $sql = "UPDATE user SET login_id = '{$loginID}', user_name = '{$userName}', icon = '{$icon}' WHERE login_id = '{$id}'";
                                $sql_res = $dbh->query( $sql );
                                $rec = $sql_res->fetch();
                                $sql = "SELECT * FROM toukou WHERE login_id = '{$id}'";
                                $sql_res = $dbh->query( $sql );
                                $sql = "UPDATE toukou SET login_id = '{$loginID}' WHERE login_id = '{$id}'";
                                $sql_res = $dbh->query( $sql );
                                $rec = $sql_res->fetch();

                                echo "<h2>ユーザーの再登録が完了しました。</h2>";
                                echo "<div class='container'><a href='keijiban2.php' class='btn-border'>掲示板に戻る</a></div>";
                            } else {
                                $message = '画像ファイルではありません。';
                                echo "<div class='container'><a href='user_set.php' class='btn-border'>ユーザー編集画面に戻る</a></div>";
                            }
                        }
                    } else {
                        echo "<h2>ファイルサイズが大きすぎます。</h2>";
                        echo "<div class='container'><a href='user_set.php' class='btn-border'>ユーザー編集画面に戻る</a></div>";
                    }
                } else {
                    echo "<h2>許可されている拡張子ではありません。</h2>";
                    echo "<div class='container'><a href='user_set.php' class='btn-border'>ユーザー編集画面に戻る</a></div>";
                }
            } else {
                echo "<h2>ファイルが選択されていません。</h2>";
                echo "<div class='container'><a href='user_set.php' class='btn-border'>ユーザー編集画面に戻る</a></div>";
            }
        } else {
            echo "<p>不正なアクセスです。</p>";
        }
    ?>
</body>
</html>