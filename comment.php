<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>コメント</title>
</head>
<body>
    <h1>コメント</h1>
    <?php
        $sql = "select * from toukou left outer join user on toukou.login_id = user.login_id order by date desc";
        $sql_res = $dbh->query( $sql );
    echo<<<___EOF___
            <div class="content">
                <div class="border">
                    <p>{$rec['id']}</p>
                    <p>【{$rec['title']}】</p>
                    <p>名前：{$rec['user_name']}</p>
                    <p>({$rec['date']})</p><br>
                    <img src="images/{$rec['picture']}" width="300" height="400">
                    <div class="wrap" contenteditable="true">{$rec['content']}</div>
                    <button type="button" class="likeButton">
                    <svg class="likeButton__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M91.6 13A28.7 28.7 0 0 0 51 13l-1 1-1-1A28.7 28.7 0 0 0 8.4 53.8l1 1L50 95.3l40.5-40.6 1-1a28.6 28.6 0 0 0 0-40.6z"/></svg>
                    いいね
                    </button>
                    <p class = number><p>
                    <form action='delete.php' method='POST'>
                    <input type='hidden' name='id' value='{$rec['login_id']}'>
                    <input type='submit' value='削除'></form>
                </div>
            </div>

    ___EOF___;
    ?>
</body>
</html>