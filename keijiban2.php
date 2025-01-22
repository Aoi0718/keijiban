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
        <h2>投稿一覧</h2>
    <?php
        $sql = "select * from toukou left outer join user on toukou.login_id = user.login_id order by date desc";
        $sql_res = $dbh->query( $sql );
        
        while( $rec = $sql_res->fetch() ){

            echo <<<___EOF___
            <div class="content">
                <div class="border">
                    <p>{$rec['id']}</p>
                    <p>【{$rec['title']}】</p>
                    <p>名前：{$rec['user_name']}</p>
                    <p>({$rec['date']})</p>
                    <div class="wrap" contenteditable="true">{$rec['content']}</div>
                </div>
            </div>

            <style>
                h2 {
                    text-align: center;
                }

                .border {
                    text-align: center;
                    color: black;
                }

                p {
                    display: inline-block;
                }

                p {
                    display: inline-block;
                }

                .content {
                    border: 1px solid #000;
                    border-radius: 8px;
                    margin: 16px auto;
                    list-style: none;
                    padding: 10px 100px;
                    background-color: white;
                }

                .home {
                    margin-right: 5%;
                    margin-left: 5%;
                }

                .warp {
                    text-wrap: balance;
                }
            </style>
            ___EOF___;
        }
    ?>
            </div>
        </div>
    </body>
</html>