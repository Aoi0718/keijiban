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
    <title>コメント</title>
</head>
<body>
    <?php
    $id = $_SESSION['id'];
    $toukou_id = $_SESSION['toukou_id'];
    $comment = $_POST['comment'];
    $sql = "insert into comment  values (null, '$toukou_id', '$id', '$comment')";
    $sql_res = $dbh->query( $sql );
    $rec = $sql_res->fetch();
    echo<<<___EOF___
    <div class="msb">
        <div class="hth">
            <h1>記事を追加しました</h1>
            <div class="container">
                <a href="keijiban2.php" class="btn-border">戻る</a>
            </div>


        </div>
    </div>




    ___EOF___;



    ?>
</body>
</html>