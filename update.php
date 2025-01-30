<?php
include "../db_open.php";
session_start();

if(empty($_SESSION['login_id'])){
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    date_default_timezone_set('Asia/Tokyo');
    $date = date("Y/m/d H:i:s");
    $login_id = $_SESSION['login_id'];

    // XSS対策
    $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');

    if(trim(str_replace('  ','',$content)) === '') {
        echo "スペースまたは空欄での投稿はできません";
        echo "<p><a href='edit.php?id={$id}'>編集画面に戻る</a></p>";
    } elseif (mb_strlen($title, "UTF-8") > 30) {
        echo "<p>タイトルは30文字以内で入力してください。</p>";
        echo "<p><a href='edit.php?id={$id}'>編集画面に戻る</a></p>";
    } elseif (mb_strlen($content, "UTF-8") > 200) {
        echo "<p>投稿内容は200文字以内で入力してください。</p>";
        echo "<p><a href='edit.php?id={$id}'>編集画面に戻る</a></p>";
    } else {
        // 画像処理
        $image = '';
        if (!empty($_FILES['image']['name'])) {
            $image = uniqid(mt_rand(), true);
            $image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);
            $file = "images/$image";
            $tmpfile = $_FILES['image']['tmp_name'];
            $Ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $array = array("jpg", "jpeg", "png", "gif");
            $size = $_FILES["image"]["size"];

            if (is_uploaded_file($tmpfile)) {
                if (in_array($Ext, $array)) {
                    if ($size < 2097152) {
                        move_uploaded_file($_FILES['image']['tmp_name'], './images/' . $image);
                    } else {
                        echo "ファイルサイズが大きすぎます。";
                    }
                } else {
                    echo "許可されている拡張子ではありません。";
                }
            } else {
                echo "画像が選択されていません。";
            }
        } else {
            // 画像が更新されなければ、元の画像を使用
            $sql = "SELECT image FROM toukou WHERE id = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $post = $stmt->fetch(PDO::FETCH_ASSOC);
            $image = $post['image'];
        }

        // SQL更新処理
        $sql = "UPDATE toukou SET title = :title, content = :content, date = :date, image = :image WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        echo "<h2>記事を更新しました。</h2>";
        echo "<p><a href='edit4.php'>掲示板に戻る</a></p>";
    }
} else {
    echo "<p>不正なアクセスです。</p>";
}
?>
