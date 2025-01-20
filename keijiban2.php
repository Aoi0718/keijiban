<!DOCTYPE html>
<html>
    <head>
        <title>掲示板</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="keijiban2.css">
    </head>
    <body>
        <div class="home">
            <h1>掲示板</h1>
        <form action="name.php" method="POST">
            <input type="submit" value="投稿者一覧">
        </form>
        <form action="insert.php" method="POST">
            <input type="submit" value="記事を投稿する">
        </form>
    <?php
        include "../db_open.php";
        session_start();
        if(empty($_SESSION['login_id'])){
            header('Location: .login.php');
            exit();
        }else{
        $sql = "select * from toukou left outer join user on toukou.login_id = user.login_id order by date desc";
        $sql_res = $dbh->query( $sql );
        
        echo "<h2>投稿一覧</h2>";

        $html_body = "";
        while( $rec = $sql_res->fetch() ){
            $content = $rec['content'];
            $container = wordwrap($content,70,'<br/>',true);

            echo <<<___EOF___
            <div class="content">
                <div class="border">
                    <p>{$rec['id']} 【{$rec['title']}】 名前：{$rec['user_name']}　({$rec['date']})<br>{$container}
                </div>
            </div>

            <style>
                h2 {
                    text-align: center;
                }

                .border {
                    text-align: center;
                }

                .content {
                    border: 1px solid #000;
                    border-radius: 8px;
                    margin: 16px auto;
                    0;;
                    list-style: none;
                    padding: 10px 100px;
                }

                .home {
                    margin-right: 20%;
                    margin-left: 20%;
                }
            </style>
            ___EOF___;
        }
        echo $html_body;
    }
    ?>
            </div>
        </div>
    </body>
</html>