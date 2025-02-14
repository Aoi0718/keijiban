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
    <link href="honbun.css" rel="stylesheet">
    <title>一覧画面</title>
</head>
    <body>
    <div class="home">
<?php
$login_id = $_GET['login_id'];
$toukou_id = $_GET['id'];
$sql = "SELECT * FROM toukou LEFT JOIN user ON toukou.login_id = user.login_id where toukou.login_id = '{$login_id}' && id = '{$toukou_id}'";
$sql_res = $dbh->query( $sql );
$rec = $sql_res->fetch();
$contents = wordwrap($rec['content'], 30, '<br/>', true);
echo <<<___EOF___
<div class="container">
        <a href="keijiban2.php" class="btn-border">戻る</a>
</div>
<div class="content">
    <div class="border">
        <div class='flex'>
        <p>{$rec['id']}</p>
        <p>【{$rec['title']}】</p>
        <h4><img src='images/{$rec['icon']}' width='30' height='30' style='border-radius: 50%;'></h4>
        <p>名前：{$rec['user_name']}</p>
        <p>({$rec['date']})</p><br>
        </div>
        <img src='images/{$rec['picture']}' width='400' height='200'>
        <div class='wrap'>{$contents}</div>
    </div>
</div>
___EOF___;
?>
    </div>
    </body>
</html>