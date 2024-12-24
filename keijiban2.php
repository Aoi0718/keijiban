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
<?php
    include "../db_open.php";

    $sql = "SELECT * FROM toukou ORDER BY date desc";
    $sql_res = $dbh->query( $sql );

    $html_body = "";
    while( $rec = $sql_res->fetch() ){
        echo "<h2>{$rec['title']}</h2>";
        echo "<p>{$rec['date']}</p>";
        echo "<p>{$rec['content']}</p>";
        echo "<p>{$rec['login_id']}</p>";
    }
    echo $html_body;