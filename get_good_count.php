<?php
include "../db_open.php";
header('Content-Type: application/json');

if (!isset($_GET['toukou_id'])) {
    echo json_encode(['success' => false, 'message' => '投稿IDが指定されていません']);
    exit();
}

$toukou_id = intval($_GET['toukou_id']);
$sql = "SELECT COUNT(*) as count FROM good WHERE toukou_id = ?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$toukou_id]);
$result = $stmt->fetch();

echo json_encode(['success' => true, 'count' => $result['count']]);
?>
