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
    <title>記事の編集</title>
</head>
<body>
<?php

    if (isset($_POST['id'])) {
        $sql = "select * from toukou left outer join user on toukou.login_id = user.login_id order by edit desc";
        $sql_res = $dbh->query($sql);
        $rec = $sql_res->fetch();
        echo <<<___EOF___

        <p>以下の記事を編集しますか？</p>
        <div class="auto">
        <div class="in">
        <h3>{$rec['title']}</h3>
        <p>投稿者: {$rec['user_name']}</p>
        <p>{$rec['content']}</p>
        <p>投稿日時: {$rec['edit']}</p>
        <form action="edit2.php" method="POST">
            <p>パスワード:<input type="password" name="passwd">
            <input type="submit" value="編集"></p>
            <input type="hidden" name="login_id" value='{$rec['login_id']}'>
            <input type="hidden" name="id" value='{$rec['id']}'>
        </form>
        </div>
        </div>
        ___EOF___;
    } else {
        echo "<p>不正なアクセスです。</p>";
    }
    ?>
</body>
</html>