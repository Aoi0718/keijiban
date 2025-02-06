<?PHP
 include "../db_open.php";
 session_start();
 if(empty($_SESSION['login_id'])){
    header('Location: login.php');
    exit();
 }
 ?>
 <!DOCTYPE html>
 <html lang="ja">
 <head>
    <meta charset="UTF-8">
    <title>ユーザー設定：編集チェック</title>
    <link rel="stylesheet" href="edit.css">
 </head>
 <body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        echo "<p>不正なアクセスです。</p>";
    } else {
        // 値の取り出し
        $id = $_POST['id']; // 更新対象の投稿ID
        $title = $_POST['title'];
        $content = $_POST['content'];
        date_default_timezone_set('Asia/Tokyo');
        $date = date("Y/m/d H:i:s");
        
        // セッション
        $login_id = $_SESSION['login_id'];

        // XSS対策
        $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');

        if (trim(str_replace('　','',$content)) === '') {
            echo "スペースまたは空欄での投稿はできません";
            echo "<p><a href='insert.php'>編集画面に戻る</a></p>";
        } elseif (mb_strlen($title, "UTF-8") > 30) {
            echo "<p>タイトルは30文字以内で入力してください。</p>";
            echo "<p><a href='insert.php'>編集画面に戻る</a></p>";
        } elseif (mb_strlen($content, "UTF-8") > 8192) {
            echo "<p>投稿内容は8192文字以内で入力してください。</p>";
            echo "<p><a href='insert.php'>編集画面に戻る</a></p>";
        } else {
            // 画像処理
            $image = null;
            if (!empty($_FILES['image']['name'])) {
                $image = uniqid(mt_rand(), true) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $file = "images/$image";
                $allowedExts = array("jpg", "jpeg", "png", "gif");
                $size = $_FILES["image"]["size"];
                $tmpfile = $_FILES['image']['tmp_name'];
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

                if (is_uploaded_file($tmpfile)) {
                    if (in_array($ext, $allowedExts)) {
                        if ($size < 2097152) {
                            move_uploaded_file($tmpfile, './images/' . $image);
                            if (!exif_imagetype($file)) {
                                echo "<h2>画像ファイルではありません。</h2>";
                                echo "<p><a href='insert.php'>編集画面に戻る</a></p>";
                                exit();
                            }
                        } else {
                            echo "<h2>ファイルサイズが大きすぎます。</h2>";
                            echo "<p><a href='insert.php'>編集画面に戻る</a></p>";
                            exit();
                        }
                    } else {
                        echo "<h2>許可されている拡張子ではありません。</h2>";
                        echo "<p><a href='insert.php'>編集画面に戻る</a></p>";
                        exit();
                    }
                }
            }

            // SQL (UPDATE文)
            if ($image) {
                $sql = "UPDATE toukou SET date = ?, title = ?, content = ?, picture = ? WHERE id = ? AND login_id = ?";
                $stmt = $dbh->prepare($sql);
                $stmt->execute([$date, $title, $content, $image, $id, $login_id]);
            } else {
                $sql = "UPDATE toukou SET date = ?, title = ?, content = ? WHERE id = ? AND user_id = ?";
                $stmt = $dbh->prepare($sql);
                $stmt->execute([$date, $title, $content, $id, $login_id]);
            }
            if ($stmt->rowCount() > 0) {
                echo "<h2>記事を更新しました。</h2>";
            } else {
                echo "<h2>更新に失敗しました。</h2>";
            }
            echo "<p><a href='keijiban2.php'>投稿一覧に戻る</a></p>";
        }
    }
    ?>
 </body>
</html>
