<?php
// good.php
include "../db_open.php";
session_start();
if(empty($_SESSION['login_id'])){
    header('Location: login.php');
    exit();
}

header('Content-Type: application/json');

$login_id = $_SESSION['login_id'];
$toukou_id = $_POST['toukou_id'] ?? null;

if (!$toukou_id) {
    echo json_encode(["success" => false, "message" => "投稿IDが指定されていません"]);
    exit();
}

// 既に「いいね」しているか確認
$sql = "SELECT * FROM good WHERE login_id = ? AND toukou_id = ?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$login_id, $toukou_id]);
$exists = $stmt->fetch();

if ($exists) {
    // いいね解除
    $delete_sql = "DELETE FROM good WHERE login_id = ? AND toukou_id = ?";
    $stmt = $dbh->prepare($delete_sql);
    $stmt->execute([$login_id, $toukou_id]);
    echo json_encode(["success" => true, "liked" => false, "message" => "いいねを解除しました"]);
} else {
    // いいね登録
    $insert_sql = "INSERT INTO good (login_id, toukou_id) VALUES (?, ?)";
    $stmt = $dbh->prepare($insert_sql);
    $stmt->execute([$login_id, $toukou_id]);
    echo json_encode(["success" => true, "liked" => true, "message" => "いいねしました"]);
}
?>