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
<<<<<<< HEAD
<div class="snow">●</div>
<div class="snow snow2nd">●</div>
=======
<h2>投稿者一覧</h2>
<div class="container">
    <a href="keijiban2.php" class="btn-border">戻る</a>
</div>
>>>>>>> origin/main
<?php
// SQL
$sql = "select * from user";
$sql_res = $dbh->query( $sql );
while( $record = $sql_res->fetch() ){
    echo "<form action='ichiran.php' method='POST'>";
    echo "<input type='hidden' name='login_id' value='{$record['login_id']}'>";
    echo "<input type='hidden' name='user_name' value='{$record['user_name']}'>";
    echo "<input type='submit' value='{$record['user_name']}' class='button'>";
    echo "</form>";
}
?>
</body>
</html>