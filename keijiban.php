<!DOCTYPE html>
<html>
    <head>
        <title>掲示板</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>掲示板</h1>
    <form action="" method="POST">
        <input type="submit" value="投稿者一覧">
        <input type="submit" value="記事を投稿する">
    </form>
<?php
    include ".php";
    $sql = "select * from テーブル名";
    $sql_res = $dbh->query( $sql );
    $html_body = "";
    while( $rec = $sql_res->fetch() ){
        echo "{$rec['']}<br>";
        echo "{$rec['']}<br>";
        echo "<h2>{$rec['']}</h2>";
        echo "<p>{$rec['']}</p>";
        echo "<p>{$rec['']}</p>";
    }
    echo $html_body;