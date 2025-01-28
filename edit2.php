<?php
$pdo = new PDO('mysql:host=localhost;dbname=掲示板DB;charset=utf8', 'ユーザー名', 'パスワード');
include "../db_open.php";
session_start();
if(empty($_SESSION['login_id'])){
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (empty($title) || empty($content)) {
        die("タイトルと内容は必須です");
    }

    $sql = "UPDATE posts SET title = ?, content = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $content, $id]);

    header("Location: keijiban2.php");
    exit;
} else {
    die("不正なアクセスです");
}
?>
