<!DOCTYPE html>
<html>
    <head>
        <title>掲示板</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="keijiban2.css">
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
    $sql = "select * from toukou left outer join user on toukou.login_id = user.login_id order by date desc";
    $sql_res = $dbh->query( $sql );
    
    echo "<h2>投稿一覧</h2>";

    $html_body = "";
    while( $rec = $sql_res->fetch() ){
        echo <<<___EOF___
        <div class="content"
            <div class="border">
                <h3>{$rec['title']}</h3>
                <p>{$rec['user_name']}</p>
                <p>{$rec['date']}</p>
                <p>{$rec['content']}</p>
            </div>
        </div>

        <style>
            .border {
                border: 1px solid #000;
                border-radius: 8px;
                margin: 16px auto;
                padding-left: 0;;
                list-style: none;
                display: inline-block;
                padding: 10px 100px;
            }

            .content {
                text-align: center;
                align-items: center;
            }
        </style>
        ___EOF___;
    }
    echo $html_body;
?>
    </body>
</html>