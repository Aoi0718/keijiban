<?PHP
include "../db_open.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="exec_toukou.css" rel="stylesheet">
    <title>登録完了画面</title>
</head>
<body>
    <?php
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
            $sql = "SELECT * FROM user";
            $sql_res = $dbh->query( $sql );
            $ids = [];

            while($rec = $sql_res->fetch()){$ids[] = $rec['login_id'];}
            
            if( $_SERVER["REQUEST_METHOD"] != "POST" ) {
                echo "<p>不正なアクセスです。</p>";
            } elseif($LoginID == null || $pass == null || $uname == null) {
                echo "<p>入力されていない欄があります。</p>";
                echo "<p><a href='touroku.php'>登録画面に戻る</a></p>";
            } elseif(mb_strlen( $LoginID, "UTF-8") > 30) {
                    echo "<p>30文字以内で入力してください。<p>";
                    echo "<p><a href='touroku.php'>登録画面に戻る</a></p>";
            } elseif(mb_strlen( $pass, "UTF-8") > 30) {
                echo "<p>30文字以内で入力してください。<p>";
                echo "<p><a href='touroku.php'>登録画面に戻る</a></p>";
            } elseif(mb_strlen( $uname, "UTF-8") > 30) {
                echo "<p>30文字以内で入力してください。<p>";
                echo "<p><a href='touroku.php'>登録画面に戻る</a></p>";
            } else { 
                foreach($ids as $id) {
                    if($LoginID == $id) {
                        echo "<p>すでに使われているIDです。</p>";
                        echo "<p><a href='touroku.php'>登録画面に戻る</a></p>";
                        exit;
                    }
                }
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
                                    $sql = "INSERT INTO user VALUES ('{$LoginID}', '{$pass}', '{$uname}', '{$icon}')";
                                    $sql_res = $dbh->query( $sql );
                                    echo "<h2>ユーザーの登録が完了しました。</h2>";
                                    echo "<p><a href='login.php'>ログイン画面に戻る</a></p>";
                                } else {
                                    $message = '画像ファイルではありません。';
                                    echo "<p><a href='touroku.php'>登録画面に戻る</a></p>";
                                }
                            }
                        } else {
                            echo "<h2>ファイルサイズが大きすぎます。</h2>";
                            echo "<p><a href='touroku.php'>登録画面に戻る</a></p>";
                        }
                    } else {
                        echo "<h2>許可されている拡張子ではありません。</h2>";
                        echo "<p><a href='touroku.php'>登録画面に戻る</a></p>";
                    }
                } else {
                    echo "<h2>ファイルが選択されていません。</h2>";
                    echo "<p><a href='touroku.php'>登録画面に戻る</a></p>";
                }
            }
        }
    ?>

</body>
</html>