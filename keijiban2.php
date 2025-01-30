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
            <header class="head">
                <h1>掲示板</h1>
                <div class="gg">
                    <div class="ul">
                        <form action="name.php" method="POST" class="li">
                            <input type="submit" value="投稿者一覧">
                        </form>
                        <form action="insert.php" method="POST" class="li">
                            <input type="submit" value="記事を投稿する">
                        </form>
                    </div>
                </div>
            </header>
            <h2>投稿一覧</h2>
        <div class="home">  
    <?PHP         
        // いいねボタンがクリックされたときの処理
    if (isset($_POST['like'])) {
    $sql = "UPDATE good SET count = count + 1 WHERE id = 1"; // idが1のレコードのいいね数を増加
    $dbh->query($sql);
    }
    // 現在のいいね数を取得
    //$sql = "SELECT count FROM good WHERE id = 1";
    //$result = $dbh->query($sql);
    //$row = $result->fetch_assoc();
    //$likeCount = $row['count'];
    //$dbh->close();

        $sql = "select * from toukou left outer join user on toukou.login_id = user.login_id order by date desc";
        $sql_res = $dbh->query( $sql );
        
        while( $rec = $sql_res->fetch() ){

        echo <<<___EOF___
            <div class="content">
                <div class="border">
                    <p>{$rec['id']}</p>
                    <p>【{$rec['title']}】</p>
                    <p>名前：{$rec['user_name']}</p>
                    <p>({$rec['date']})</p><br>
                    <img src="images/{$rec['picture']}" width="300" height="400">
                    <div class="wrap" contenteditable="true">{$rec['content']}</div>
                    <button type="submit" name="like">
                   <svg class="likeButton__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M91.6 13A28.7 28.7 0 0 0 51 13l-1 1-1-1A28.7 28.7 0 0 0 8.4 53.8l1 1L50 95.3l40.5-40.6 1-1a28.6 28.6 0 0 0 0-40.6z"/></svg>
                    </button>
                    
                        
                    <div id = "number" id="number">0</div>

                    <form action='delete.php' method='POST'>
                    <input type='hidden' name='id' value='{$rec['login_id']}'>
                    <input type='submit' value='削除'></form>
                    <input type='submit' onclick="location.href='edit.php'" value='編集'></form>
                </div>
            </div>
            ___EOF___;
        }
    ?>
            </div>
        </div>
        <?php

$sql = "SELECT * FROM posts ORDER BY created_at DESC";

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>掲示板</title>
</head>
<body>
    <h1>掲示板</h1>
    <a href="new.php">新規投稿</a>
    <ul>
        <?php foreach ($posts as $post): ?>
            <li>
                <strong><?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></strong><br>
                <?php echo nl2br(htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8')); ?><br>
                <a href="edit.php?id=<?php echo $post['id']; ?>">編集</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>

    </body>
</html>
