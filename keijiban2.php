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
<<<<<<< HEAD
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

=======
    <header class="head">
    <div class="gg">
        <div class="ul">
            <form action="user_set.php" method="POST" class="li">
                <input type="hidden" name="id" value="{<?php $rec['login_id']; ?>}">
                <input type="submit" value="ユーザー設定">
            </form>
        </div>
    </div>
        <h1>掲示板</h1>
        <div class="gg">
            <div class="ul">
                <form action="name.php" method="POST" class="li">
                    <input type="submit" value="投稿者一覧">
                </form>
                <form action="insert.php" method="POST" class="li">
                    <input type="submit" value="記事を投稿する">
                </form>
                <form action="logout.php" method="POST" class="li">
                    <input type="hidden" name="id" value="{<?php $rec['login_id']; ?>}">
                    <input type="submit" value="ログアウト">
                </form>
            </div>
        </div>
    </header>
    <h2>投稿一覧</h2>
    <div class="home">  
    <?php
>>>>>>> origin/main
        $sql = "select * from toukou left outer join user on toukou.login_id = user.login_id order by date desc";
        $sql_res = $dbh->query( $sql );
        while( $rec = $sql_res->fetch() ){

        $_SESSION['toukou_id'] = $rec['id'];

        echo <<<___EOF___
            <div class="content">
                <div class="border">
                    <div class="flex">
                        <p>{$rec['id']}</p>
                        <p>【{$rec['title']}】</p>
                        <h4><img src="images/{$rec['icon']}" width="30" height="30" style="border-radius: 50%;"></h4>
                        <p>名前：{$rec['user_name']}</p>
                        <p>({$rec['date']})</p><br>
                    </div>
                    <img src="images/{$rec['picture']}" width="300" height="400">
                    <div class="wrap" contenteditable="true">{$rec['content']}</div>
                    
                    <button id="like-button" data-toukou-id="{$_SESSION['id']}" class="likeButton">👍 いいね</button>
                    <span id="like-status"></span>

                    <form action='delete.php' method='POST'>
                    <input type='hidden' name='id' value='{$rec['login_id']}'>
                    <input type='submit' value='削除'>
                    </form>
<<<<<<< HEAD
                    <form action='edit.php' method='POST'>
                        <input type='hidden' name='id' value='{$rec['login_id']}'>
                        <input type='submit' value='編集'>
=======
                    <form action='comment.php' method='GET'>
                    <input type='hidden' name='id' value='{$rec['login_id']}'>
                    <input type='submit' value='コメント'>
>>>>>>> origin/main
                    </form>
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
 </body>
</html>