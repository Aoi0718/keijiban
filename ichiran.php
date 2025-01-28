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

    while( $record = $sql_res->fetch() ) {
        echo <<<___EOF___
            <div class="content">
                <div class="border">
                    <p>{$record['id']}</p>
                    <p>【{$record['title']}】</p>
                    <p>名前：{$record['user_name']}</p>
                    <p>({$record['date']})</p>
                    <div class="wrap" contenteditable="true">{$record['content']}</div>
                </div>
            </div>

        ___EOF___;
    }
?>
    </div>
    </body>
</html>
