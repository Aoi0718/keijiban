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
    <link href="ichiran.css" rel="stylesheet">
    <title>一覧画面</title>
</head>
    <body>
    <div class="home">
<?php
$name = $_GET['user_name'];
$id = $_GET['login_id'];
$sql = "select * from toukou, user where toukou.login_id = '$id' && user_name = '$name'";
$sql_res = $dbh->query( $sql );

    echo "<h2>「{$name}」の投稿一覧</h2>";
    echo "<div class='back'><p><a href='name.php'>戻る</a></p></div>";

    while( $record = $sql_res->fetch() ) {
        echo <<<___EOF___
            <div class="content">
                <div class="border">
                    <p>{$record['id']}</p>
                    <p>【{$record['title']}】</p>
                    <p>名前：{$record['user_name']}</p>
                    <p>({$record['date']})</p>
                    <div class="wrap" contenteditable="true">{$record['content']}</div>
                </div>
            </div>

            <style>
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
                    background-color:white;
                }

                .warp {
                    text-wrap: balance;
                }
            </style>
        ___EOF___;
    }
?>
    <style>
        body {
            background-image: url("okumono_mahjonggara10-1536x864.png");
        }

        .border {
                    text-align: center;
        }

        p {
            display: inline-block;
        }

        .back {
            text-align: center;
        }

        .content {
            border: 1px solid #000;
            border-radius: 8px;
            margin: 16px auto;
            list-style: none;
            padding: 10px 10px;
            background-color: white;
        }

        .home {
            margin-right: 5%;
            margin-left: 5%;
        }

        .warp {
            text-wrap: balance;
            padding: 0px 15px 10px 15px;
        }

        a {
            text-align:center;
            border: 1px solid #000;
            border-radius: 8px;
            text-decoration: none;
            padding: 2px 7px;
            color: red;
        }

        a:hover {
            background-color: skyblue;
        }

        @media screen and (max-width: 600px){
            p {
                font-size:larger;
            }

            .wrap {
                text-wrap: balance;
                font-size:larger;
            }

            .content {
                border: 1px solid #000;
                border-radius: 8px;
                margin: 16px auto;
                list-style: none;
            }
        }
    </style>
    </div>
    </body>
</html>
