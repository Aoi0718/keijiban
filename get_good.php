<?php
// get_good.php
include "../db_open.php";
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ログインチェック
if (empty($_SESSION['login_id'])) {
    echo json_encode(["success" => false, "message" => "ログインが必要です"]);
    exit();
}

$login_id = $_SESSION['login_id'];

// ユーザーが「いいね」した投稿のIDを取得
$sql = "SELECT toukou_id FROM good WHERE login_id = ?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$login_id]);
$likedPosts = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo json_encode(["success" => true, "likedPosts" => $likedPosts]);
?>
