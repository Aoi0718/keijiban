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
    <link rel="stylesheet" href="user_update_check.css">
</head>
<body>
    <h1>    投稿の編集</h1>
    <?php
        include "../db_open.php";

        if( $_SERVER["REQUEST_METHOD"] != "POST" ) {
            echo "<p>不正なアクセスです。</p>";
        } else {
            $toukou_id = $_POST['toukou_id'];
            // SQL
            $sql = "select * from toukou where id = $toukou_id";
            $sql_res = $dbh->query( $sql );
            $rec = $sql_res->fetch();
            echo <<<___EOF____
    <div class="content">
        <div class="border">
            <form method="POST" enctype="multipart/form-data" action="update_check.php">
                <p>タイトル：<input type="text" name="title" pattern=".*\S+.*" required placeholder="30文字以内"></p>
            <div class='content'>
              <p class="toukou">編集内容：</p>
             <textarea name="content" pattern=".*\S+.*" required placeholder="200文字以内"></textarea>
            </div>
              <input type="file" name="image">
              
              <input type="submit" value="編集して投稿する" class="sub"></p>
              <input type="hidden" name="login_id" value='{$rec['login_id']}'>
              <input type="hidden" name="toukou_id" value='{$toukou_id}'>
            </form>
            <div class="container">
                <a href="keijiban2.php" class="btn-border">戻る</a>
            </div>

        </div>
    </div>
    ___EOF____;
            
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