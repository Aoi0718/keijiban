<?PHP
include "../db_open.php";
session_start();
        if(empty($_SESSION['login_id'])){
            header('Location: login.php');
            exit();
        }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="name.css" rel="stylesheet">
    <title>一覧画面</title>
</head>
<body>
<?php
// SQL
$sql = "select * from user";
$sql_res = $dbh->query( $sql );

echo "<h2>投稿者一覧</h2>";
while( $record = $sql_res->fetch() ){
    echo "<p><a href='ichiran.php?user_name={$record['user_name']}'>{$record['user_name']}</a></p>";
}
?>
<div class="container">
    <a href="keijiban2.php" class="btn-border">戻る</a>
</div>
</body>
</html>