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
    <link href="name.css" rel="stylesheet">
    <title>一覧画面</title>
</head>
<body>
<?php
$sql = "select * from toukou left outer join user on toukou.login_id = user.login_id";
$sql_res = $dbh->query( $sql );

echo "<h2>投稿者一覧</h2>";
echo "<p><a class='back' href='keijiban2.php'>戻る</a></p>";
while( $record = $sql_res->fetch() ){
    echo "<p>{$record['id']}.<a href='ichiran.php?id={$record['id']}&user_name={$record['user_name']}'>{$record['user_name']}</a></p>";
}
?>
 <style>
        body {
            background-image: url("okumono_mahjonggara10-1536x864.png");
        }
        .back {
            text-align:center;
            border: 1px solid #000;
            border-radius: 8px;
            text-decoration: none;
            padding: 2px 7px;
            color: blue;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            background-color: skyblue;
        }
    </style>
</body>
</html>