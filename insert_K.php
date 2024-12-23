<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規登録</title>
</head>
<body>
    <h1>新規登録画面</h1>
    <form method="POST" action="insert_K.php">
        <p>タイトル：<input type="text" name="title"></p>
        <p>投稿内容：<textarea name="content"></textarea></p>
        <input type="submit" value="投稿">
    </form>
    <?php
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
        $sql = "INSERT INTO toukou VALUE (null, '{$date}', '{$title}', '{$content}')";
        $sql_res = $dbh->query( $sql );
        
        echo "<p>投稿一覧に戻る<a href='keijiban.php'></a></p>";
    }
    ?>
</body>
</html>