<?PHP
include "../db_open.php";
session_start();
if(empty($_SESSION['login_id'])){
    header('Location: login.php');
    exit();
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $date = $_POST['date'];   
    $title = $_POST['title'];
    $content = $_POST['content'];
    $login_id = $_POST['login_id'];
    $picture = $_POST['picture'];
    

    $stmt = $pdo->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
    $stmt->execute([$title, $content, $id]);

    echo '記事を更新しました。<a href="edit.php?id=' . $id . '">戻る</a>';
}
?>
