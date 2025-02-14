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
    <link href="ichiran.css" rel="stylesheet">
    <title>一覧画面</title>
</head>
    <body>
    <div class="home">
<?php
$name = $_POST['user_name'];
$login_id = $_POST['login_id'];
$sql = "SELECT * FROM toukou RIGHT JOIN user ON toukou.login_id = user.login_id where toukou.login_id = '$login_id' && user_name = '$name'";
$sql_res = $dbh->query( $sql );
#$rec = $sql_res->fetch();
echo <<<___EOF___
    <h2>「{$name}」の投稿一覧</h2>
    <div class="container">
        <a href="name.php" class="btn-border">戻る</a>
    </div>
___EOF___;

while( $record = $sql_res->fetch() ) {
    $contents = wordwrap($record['content'], 30, '<br/>', true);
    echo <<<___EOF___
        <div class="content">
            <div class="border">
                <p>{$record['id']}</p>
                <p>【{$record['title']}】</p>
                <p>名前：{$record['user_name']}</p>
                <p>({$record['date']})</p>
                <div class="wrap">{$contents}</div>
            </div>
        </div>
    ___EOF___;
}
?>
    </div>
    </body>
</html>