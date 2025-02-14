<?php
    include "../db_open.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>登録画面</title>
    <link rel="stylesheet" href="touroku.css" >
</head>
<body>
    <div class="container">
        <h1>登録画面</h1>
        <p class="small">IDとパスワード、ユーザーネームを設定してください</p>
        <div class="border">
            <form method="POST" action="exec_touroku.php" enctype="multipart/form-data">
                <p>   ログインID:<input type="text" name="id" pattern="^[a-zA-Z0-9]+$"></p>
                <p>   パスワード:<input type="password" name="pass" pattern="^[a-zA-Z0-9]+$"></p>
                <p>ユーザーネーム:<input type="text" name="uname"></p>
                <div>
                    <img src="images/icon.jpg" id="img" width="100" height="100"><br>
                    <input type="file" name="icon" id="file">
                </div>
                <input type="submit" value="登録" class="button">
            </form>
        </div>
    </div>
    <div class="center">
        <a href='login.php' class='btn-border'>戻る</a>
    </div>

    <script>
        // 変数宣言
        const fileInput = document.getElementById('file');
        const profileImg =document.getElementById('img');
        // ファイルが選択されたら、changeイベントが発生
        fileInput.addEventListener('change', function(event) {
            // event.target.files[0] で配列の最初のファイルを指定(今回なら、自分で選んだファイル)
            const file = event.target.files[0];

            if(file) {
                // 選択されたファイル画像をURLとして読み込み、<img>のsrcに設定
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