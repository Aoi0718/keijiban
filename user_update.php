<?PHP
include "../db_open.php";
session_start();
if(empty($_SESSION['login_id'])){
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>ユーザー設定：編集</title>
    <link rel='stylesheet' href='user_update.css'>
</head>
<body>
    <h1>ユーザー情報の編集</h1>
    <?php
        include "../db_open.php";

        if( $_SERVER["REQUEST_METHOD"] != "POST" ) {
            echo "<p>不正なアクセスです。</p>";
        } else {
            // SQL
            $sql = "select * from toukou left outer join user on toukou.login_id = user.login_id order by date desc";
            $sql_res = $dbh->query( $sql );
            $rec = $sql_res->fetch();

            echo <<<___EOF___
            <div class="as">
                <form method="POST" action="user_update_check.php" enctype="multipart/form-data">
                    <p>ログインID：<input type="text" name="login_id"></p>
                    <p>ユーザーネーム：<input type="text" name="uname"</p>
                    <div>
                        <img src="images/icon.jpg" id="img" width="100" height="100"><br>
                        <input type="file" name="icon" id="file">
                    </div>
                    <input type="submit" value="登録する">
                </form>
            </div>
            <div class="container">
                <a href="user_set.php" class="btn-border">戻る</a>
            </div>
            ___EOF___;
        }
    ?>
    <script>
        const fileInput = document.getElementById('file');
        const profileImg =document.getElementById('img');
        
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if(file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    profileImg.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>