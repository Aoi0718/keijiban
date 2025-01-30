<?php
include "../db_open.php";
session_start();

if (empty($_SESSION['login_id'])) {
    header('Location: login.php');
    exit();
}

echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>データ管理</title>
    <link rel='stylesheet' href='edit.css'>
</head>
<body>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['title']) && isset($_POST['content'])) {
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        date_default_timezone_set('Asia/Tokyo');
        $date = date("Y/m/d H:i:s");
        $login_id = $_SESSION['login_id'];
        $post_id = isset($_POST['id']) ? intval($_POST['id']) : null;

        if ($content === '' || preg_replace('/\s+/u', '', $content) === '') {
            echo "<p>スペースまたは空欄での投稿はできません</p><a href='insert.php'>投稿画面に戻る</a>";
        } elseif (mb_strlen($title, "UTF-8") > 30) {
            echo "<p>タイトルは30文字以内で入力してください。</p><a href='insert.php'>投稿画面に戻る</a>";
        } elseif (mb_strlen($content, "UTF-8") > 200) {
            echo "<p>投稿内容は200文字以内で入力してください。</p><a href='insert.php'>投稿画面に戻る</a>";
        } else {
            $image = null;

            if (!empty($_FILES['image']['name'])) {
                $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $allowed_exts = ["jpg", "jpeg", "png", "gif"];
                
                if (in_array($ext, $allowed_exts) && $_FILES["image"]["size"] < 2097152) {
                    $image = uniqid(mt_rand(), true) . '.' . $ext;
                    $file = "images/$image";

                    if (is_uploaded_file($_FILES['image']['tmp_name']) && move_uploaded_file($_FILES['image']['tmp_name'], $file)) {
                        if (!exif_imagetype($file)) {
                            unlink($file);
                            echo "<p>画像ファイルが無効です。</p><a href='insert.php'>投稿画面に戻る</a>";
                            exit();
                        }
                    } else {
                        echo "<p>画像のアップロードに失敗しました。</p><a href='insert.php'>投稿画面に戻る</a>";
                        exit();
                    }
                } else {
                    echo "<p>許可されていない拡張子、またはサイズオーバーです。</p><a href='insert.php'>投稿画面に戻る</a>";
                    exit();
                }
            }

            if ($post_id) {
                // 投稿の更新処理
                if ($image) {
                    $stmt = $dbh->prepare("UPDATE toukou SET date = ?, title = ?, content = ?, image = ? WHERE id = ? AND login_id = ?" );
                    $stmt->execute([$date, $title, $content, $image, $post_id, $login_id]);
                } else {
                    $stmt = $dbh->prepare("UPDATE toukou SET date = ?, title = ?, content = ? WHERE id = ? AND login_id = ?");
                    $stmt->execute([$date, $title, $content, $post_id, $login_id]);
                }
                echo "<h2>記事を更新しました。</h2>";
            }
        }
    }
}

echo "<div class='container'><a href='keijiban2.php' class='btn-border'>戻る</a></div>
</body>
</html>";
