<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="ichiran.css" rel="stylesheet">
    <title>一覧画面</title>
</head>
    <body>

<?php
include "../db_open.php";
$id = $_GET['id'];
$name = $_GET['user_name'];
$sql = "select * from toukou, user where id = '$id' && user_name = '$name'";
$sql_res = $dbh->query( $sql );


echo "<h2>「{$name}」の投稿一覧</h2>";
echo "<p><a href='name.php'>戻る</a></p>";
while( $record = $sql_res->fetch() ){
    echo "<div>";
    echo "{$record['id']}";
    echo "  {$record['title']}</br>";
    echo "           {$record['date']}</br>";
    echo "{$record['content']}";
}
?>
 <style>
        body {
            background-image: url("okumono_mahjonggara10-1536x864.png");
        }
    </style>
    </body>
</html>
