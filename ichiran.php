<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>

<?php
include "../db_open.php";
$id = $_GET['id'];
$name = $_GET['name'];
$sql = "select * from toukou where id = '$id'";
$sql_res = $dbh->query( $sql );


echo "<h2>$nameの投稿一覧</h2>";
echo "<a href='name.php'>戻る</a>";
while( $record = $sql_res->fetch() ){
    echo "{$record['id']}";
    echo "　{$record['title']}</br>";
    echo "　　　　　　{$record['date']}</br>";
    echo "{$record['content']}";
}
?>
    </body>




</html>
