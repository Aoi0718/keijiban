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
        <link rel="stylesheet" href="exec_insert.css">
    </head>
    <body>
        <?php
            if( $_SERVER["REQUEST_METHOD"] != "POST" ) {
                echo "<p>不正なアクセスです。</p>";
            } else {
                // 値の取り出し
                $title = $_POST['title'];
                $content = $_POST['content'];
                date_default_timezone_set('Asia/Tokyo');
                $date = date("Y/m/d H:i:s");
                // セッション
                $login_id = $_SESSION['login_id'];
                // XSS対策
                $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
                $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
                if(trim(str_replace('　','',$content)) === ''){
                echo "スペースまたは空欄での投稿はできません";
                echo "<p><a href='insert.php'>投稿画面に戻る</a></p>";
                }elseif(mb_strlen( $title, "UTF-8") > 30){
                    echo "<p>タイトルは30文字以内で入力してください。<p>";
                    echo "<p><a href='insert.php'>投稿画面に戻る</a></p>";
                }elseif(mb_strlen( $content, "UTF-8") > 200){
                    echo "<p>投稿内容は200文字以内で入力してください。<p>";
                    echo "<p><a href='insert.php'>投稿画面に戻る</a></p>";
                } else {
                    // SQL
                    $sql = "INSERT INTO toukou VALUES (null, '{$date}', '{$title}', '{$content}', '{$login_id}')";
                    $sql_res = $dbh->query( $sql );
                    echo "<h2>記事を追加しました。</h2>";
                    echo "<p><a href='keijiban2.php'>投稿一覧に戻る</a></p>";
                }
            }
        ?>
    </body>
</html>