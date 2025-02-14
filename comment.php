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
    <link rel="stylesheet" href="comment.css">

</head>
<body>
    <h1>コメント</h1>
    <?php
        $_SESSION['toukou_id'] = $_POST['toukou_id'];
        $toukou_id = $_SESSION['toukou_id'];
        $sql = "select * from toukou left outer join user on toukou.login_id = user.login_id where id = $toukou_id";
        $sql_res = $dbh->query( $sql );
        $rec = $sql_res->fetch();
            echo<<<___EOF___
            <div class="content">
                <div class="border">
                    <p>{$rec['id']}</p>
                    <p>【{$rec['title']}】</p>
                    <p>名前：{$rec['user_name']}</p>
                    <p>({$rec['date']})</p><br>
                    <img src="images/{$rec['picture']}" width="300" height="400">
                    <div class="wrap" contenteditable="true">{$rec['content']}</div>
                </div>
            </div>
            <br>
            ___EOF___;
                $sql = "select * from comment where toukou_id = $toukou_id";
                $sql_res = $dbh->query( $sql );
             while( $rec = $sql_res->fetch() ){
            echo<<<___EOF___
            
                <div class="co">
                    <div class="do">
                        <h3>コメント</h3>
                        <p>{$rec['comment']}</p>
                    </div>
                </div>
            ___EOF___;
            }
            echo<<<___EOF___
                <div class="msb">
                    <div class="hth">
                        <h3>返信</h3>
                        <form method="POST" enctype="multipart/form-data" action="exec_comment.php">
                        <textarea name="comment" pattern=".*\S+.*" required placeholder="空白だけで投稿しないでください"></textarea><br>
                        <input type="submit" value="投稿" class="button">
                        </form>
                    </div>
                </div><br>
                <div class="container">
                    <a href="keijiban2.php" class="btn-border">戻る</a>
                </div>

            ___EOF___;
        
    ?>
</body>
</html>