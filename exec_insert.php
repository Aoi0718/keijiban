<!DOCTYPE html>
<html>
    <head>
        <title>掲示板</title>
        <meta charset="UTF-8">
    </head>
    <body>
        
        <?php
            include "../db_open.php";
            session_start();

            if( $_SERVER["REQUEST_METHOD"] != "POST" ) {
                echo "<p>不正なアクセスです。</p>";
            } else {
                // 値の取り出し
                $title = $_POST['title'];
                $content = $_POST['content'];
                $login_id = $_POST['login_id'];
                date_default_timezone_set('Asia/Tokyo');
                $date = date("Y/m/d H:i:s");
                // XSS対策
                $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
                $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
                // SQL
                $sql = "INSERT INTO toukou VALUE (null, '{$date}', '{$title}', '{$content}', '{$login_id}')";
                $sql_res = $dbh->query( $sql );
                
                echo "<h2>記事を追加しました。</h2>";
                echo "<p><a href='keijiban2.php'>投稿一覧に戻る</a></p>";
            }
        ?>
        <style>
            h2 {
                text-align: center;
            }

            p {
                text-align: center;
            }
            
            body {
                background-image: url("okumono_mahjonggara10-1536x864.png");
            }
        </style>
    </body>
</html>