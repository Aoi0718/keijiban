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
    <h2>ユーザー情報の編集</h2>
    <?php
        if (isset($_POST['id'])) {
            // SQL
            $login_id = $_SESSION['login_id'];
            $sql = "select * from user where login_id = '$login_id'";
            $sql_res = $dbh->query( $sql );
            $rec = $sql_res->fetch();

            echo <<<___EOF___
            <div class="center">
                <div class="contents">
                    <div class="border">
                        <form method="POST" action="user_update_check.php" enctype="multipart/form-data">
                            <p>　　ログインID：<input type="text" name="login_id" autocomplete="off"></p>
                            <p>ユーザーネーム：<input type="text" name="uname" autocomplete="off"></p>
                            <div>
                                <img src="images/icon.jpg" id="img" width="100" height="100" ><br>
                                <input type="file" name="icon" id="file">
                            </div>
                            <input type="hidden" name="id" value="$login_id">
                            <input type="submit" value="登録する" class="button">
                        </form>
                    </div>
                </div>
            </div>
            <div class="container">
                <a href="user_set.php" class="btn-border">戻る</a>
            </div>
            ___EOF___;
        } else {
            echo "<p>不正なアクセスです。</p>";
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