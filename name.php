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
$sql = "select * from user";
$sql_res = $dbh->query( $sql );

echo "<h2>投稿者一覧</h2>";
echo "<p><a class='back' href='keijiban2.php'>戻る</a></p>";
while( $record = $sql_res->fetch() ){
    echo "<p><a href='ichiran.php?login_id={$record['login_id']}&user_name={$record['user_name']}'>{$record['user_name']}</a></p>";
}
?>
</body>
</html>