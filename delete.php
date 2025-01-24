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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>記事の削除</title>
</head>
<body>
<?php
    include "../db_open.php";
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $sql = "SELECT * FROM sougou WHERE id = $id";
        $sql_res = $dbh->query($sql);
        $rec = $sql_res->fetch();
        echo <<<___EOF___
        <p>以下の記事を削除しますか？</p>
        <div>
        <h3>{$rec['title']}</h3>
        <p>投稿者: {$rec['toukou']}</p>
        <p>{$rec['naiyo']}</p>
        <p>投稿日時: {$rec['nitiji']}</p>
        </div>
        <form action="exec_del.php" method="POST">
            <p>削除パスワード:<input type="password" name="pass">
            <input type="submit" value="削除"></p>
            <input type="hidden" name="id" value="{$id}">
        </form>
        ___EOF___;
    } else {
        echo "<p>不正なアクセスです。</p>";
    }
    ?>
</body>
</html>