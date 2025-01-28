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
    <link href="ichiran.css" rel="stylesheet">
    <title>一覧画面</title>
</head>
    <body>
    <div class="home">
<?php
$name = $_GET['user_name'];
$id = $_GET['login_id'];
$sql = "select * from toukou, user where toukou.login_id = '$id' && user_name = '$name'";
$sql_res = $dbh->query( $sql );

    echo "<h2>「{$name}」の投稿一覧</h2>";
    echo "<div class='back'><p><a href='name.php'>戻る</a></p></div>";


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
    </div>
    </body>
</html>
