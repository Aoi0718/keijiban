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
    <link rel="stylesheet" href="delete.css">
    <title>記事の削除</title>
</head>
<body>
<?php

    if (isset($_POST['id'])) {
        $toukou_id = $_POST['toukou_id'];

        $sql = "SELECT * from toukou left outer join user on toukou.login_id = user.login_id where id = '{$toukou_id}'";
        $sql_res = $dbh->query($sql);
        $rec = $sql_res->fetch();
        $contents = wordwrap($rec['content'], 30, '<br/>', true);
        echo <<<___EOF___
        <h2>以下の記事を削除しますか？</h2>
        <div class="auto">
            <div class="in">
                <h2>{$rec['title']}</h2>
                <p>投稿者: {$rec['user_name']}</p><br>
                <p>{$contents}</p><br>
                <p>投稿日時: {$rec['date']}</p><br>
                <form action="delete2.php" method="POST">
                    <p>パスワード:<input type="password" name="passwd"></p><br>
                    <input type="hidden" name="login_id" value='{$rec['login_id']}'>
                    <input type="hidden" name="id" value='{$rec['id']}'>
                    <input type="hidden" name="toukou_id" value="{$toukou_id}">
                    <input type="submit" value="削除" class="button">
                </form>
            </div>
        </div>
        <div class="container">
            <a href="keijiban2.php" class="btn-border">戻る</a>
        </div>
        ___EOF___;
    } else {
        echo "<p>不正なアクセスです。</p>";
    }
    ?>
</body>
</html>