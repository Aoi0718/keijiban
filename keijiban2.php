<!DOCTYPE html>
<html>
    <head>
        <title>掲示板</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>掲示板</h1>
    <form action="name.php" method="POST">
        <input type="submit" value="投稿者一覧">
    </form>
    <form action="insert.php" method="POST">
        <input type="submit" value="記事を投稿する">
    </form>
    <style>
        h1 {
            text-align: center;
        }
        form{
            text-align: center;
        }
        h2{
            text-align: center;
        }
        h3{
            text-align: center;    
        }
        p{
            text-align: center;
        }
    </style>
<?php
    include "../open.php";
    $sql = "select * from toukou left outer join user on toukou.login_id = user.login_id";
    $sql_res = $dbh->query( $sql );

    $html_body = "";
    while( $rec = $sql_res->fetch() ){
        echo "<h2>投稿一覧</h2>";
        echo "<h3>{$rec['title']}</h3>";
        echo "<p>{$rec['user_name']}</p>";
        echo "<p>{$rec['date']}</p>";
        echo "<p>{$rec['content']}</p>";
        echo "<p>{$rec['login_id']}</p>";
    }
    echo $html_body;
?>
    </body>
</html>