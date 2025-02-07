<?PHP
include "../db_open.php";
session_start();
if(empty($_SESSION['login_id'])){
    header('Location: login.php');
    exit();
}
$login_id = $_SESSION['id'];
$sql = "select * from good";
$sql_res = $dbh->query( $sql );
$goods = [];
while($rec = $sql_res->fetch()){$goods[] = $rec['toukou_id'];}
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
            <form action="user_set.php" method="POST" class="li">
                <input type="hidden" name="id" value="{<?php $_SESSION['login_id']; ?>}">
                <input type="submit" value="ユーザー設定">
            </form>
        </div>
    </div>
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
    <form method="GET" action="">
    <label for="sort">並び替え：</label>
    <select name="sort" id="sort" onchange="this.form.submit()">
    <option value="date_desc" <?= ($_GET['sort'] ?? '') === 'date_desc' ? 'selected' : '' ?>>新着順</option>
        <option value="good_desc" <?= ($_GET['sort'] ?? '') === 'good_desc' ? 'selected' : '' ?>>いいねが多い順</option>
        </select>
</form>
    <div class="home">  
    <?php
        $sort = $_GET['sort'] ?? 'date_desc';

        $orderBy = match ($sort) {
            'date_desc' => 'toukou.date DESC',
            'good_desc' => 'good_count DESC, toukou.date DESC',
            default     => 'toukou.date DESC',
        };
        
        $sql = "SELECT toukou.*, user.user_name, user.icon, 
                (SELECT COUNT(*) FROM good WHERE good.toukou_id = toukou.id) AS good_count 
                FROM toukou 
                LEFT JOIN user ON toukou.login_id = user.login_id 
                ORDER BY $orderBy";
        
        $sql_res = $dbh->query($sql);
        while( $rec = $sql_res->fetch() ){
            $sql2 = "select count(*) as total from good where toukou_id = {$rec['id']} and login_id = '$login_id'";
            $sql_res2 = $dbh->query( $sql2 );
            $record = $sql_res2->fetch();
        $_SESSION['total'] = $record['total'];
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
                    <img src="images/{$rec['picture']}" width="400" height="200">
                    <div class="wrap" contenteditable="true">{$rec['content']}</div>
                    
                    <button id="like-button" data-toukou-id="{$rec['id']}" class="likeButton">
                    <svg class="likeButton__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M91.6 13A28.7 28.7 0 0 0 51 13l-1 1-1-1A28.7 28.7 0 0 0 8.4 53.8l1 1L50 95.3l40.5-40.6 1-1a28.6 28.6 0 0 0 0-40.6z"/></svg>
                    </button>
                    <span id="like-status"></span>
                    <p class='count' data-toukou-id="{$rec['id']}">{$rec['good_count']}</p>

                    <form action='delete.php' method='POST'>
                        <input type='hidden' name='id' value='{$rec['login_id']}'>
                        <input type='hidden' name='toukou_id' value="{$rec['id']}">
                        <input type='submit' value='削除'>
                    </form>
                    <form action='update.php' method='POST'>
                        <input type='hidden' name='id' value='{$rec['login_id']}'>
                        <input type='submit' value='編集'>
                    </form>

                    <form action='comment.php' method='POST'>
                    <input type='hidden' name='id' value='{$rec['login_id']}'>
                    <input type='hidden' name='toukou_id' value='{$rec['id']}'>
                    <input type='submit' value='コメント'>
                    </form>

                </div>
            </div>
            ___EOF___;
        }
        
    ?>
            </div>
        </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    const login_id = "<?= $_SESSION['login_id'] ?>";
    const likeButtons = document.querySelectorAll('.likeButton');

    console.log("ログインID:", login_id);

    // ページロード時に「いいね」済みの投稿IDを取得して反映
    fetch('get_good.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const likedPosts = data.likedPosts.map(String);
                console.log("いいね済み投稿:", likedPosts);

                likeButtons.forEach(button => {
                    const toukou_id = button.dataset.toukouId;
                    if (likedPosts.includes(toukou_id)) {
                        button.classList.add('liked');
                    }
                });
            } else {
                console.error("取得エラー:", data.message);
            }
        })
        .catch(error => console.error('いいね状態の取得エラー:', error));

    // いいねボタンのクリック処理
    likeButtons.forEach(button => {
        button.addEventListener('click', function () {
            const toukou_id = this.dataset.toukouId;
            this.classList.toggle('liked');

            console.log(`投稿ID ${toukou_id}: ${this.classList.contains('liked') ? "いいね追加" : "いいね解除"}`);

            sendLikeData(toukou_id, login_id);
        });
    });

    // いいね数をリアルタイムで更新
    function updateLikeCounts() {
        document.querySelectorAll('.count').forEach(countElement => {
            const toukouId = countElement.dataset.toukouId;
            if (!toukouId) return;

            fetch(`get_good_count.php?toukou_id=${toukouId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        countElement.textContent = data.count;
                    }
                })
                .catch(error => console.error('いいね数の取得エラー:', error));
        });
    }

    // 5秒ごとに「いいね」数を更新
    setInterval(updateLikeCounts, 5000);

    // サーバーに「いいね」状態を送信する関数
    function sendLikeData(toukouId, loginId) {
        console.log(`送信データ: toukou_id=${toukouId}, login_id=${loginId}`);

        fetch('good.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `toukou_id=${encodeURIComponent(toukouId)}&login_id=${encodeURIComponent(loginId)}`
        })
        .then(response => response.json())
        .then(data => {
            console.log("サーバーレスポンス:", data);
            if (!data.success) {
                console.error("エラー:", data.message);
            }
            updateLikeCounts(); // いいね送信後にリアルタイム更新
        })
        .catch(error => console.error('通信エラー:', error));
    }
});

</script>
</body>
</html>