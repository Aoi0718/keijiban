<!DOCTYPE html>
<html>
    <head>
        <title>掲示板</title>
        <meta charset="UTF-8">
    </head>
    <body>
        
        <?php
            include "../db_open.php";

            if( $_SERVER["REQUEST_METHOD"] != "POST" ) {
                echo "<p>不正なアクセスです。</p>";
            } else {
                // 値の取り出し
                $title = $_POST['title'];
                $content = $_POST['content'];
                date_default_timezone_set('Asia/Tokyo');
                $date = date("Y/m/d H:i:s");
                // XSS対策
                $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
                $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
                // SQL
                $sql = "INSERT INTO toukou VALUE (null, '{$date}', '{$title}', '{$content}', null)";
                $sql_res = $dbh->query( $sql );
                
                
                echo "<p>投稿一覧に戻る<a href='keijiban.php'></a></p>";
            }
        ?>
    </body>
</html>