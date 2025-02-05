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
    <title>ユーザー設定：編集チェック</title>
 </head>
 <body>
    <?php
 if( $_SERVER["REQUEST_METHOD"] != "POST" ) {
                echo "<p>不正なアクセスです。</p>";
            } else {
                // 値の取り出し
                $title = $_POST['title'];
                $content = $_POST['content'];
                date_default_timezone_set('Asia/Tokyo');
                $date = date("Y/m/d H:i:s");
                // セッション
                $login_id = $_SESSION['login_id'];
                // XSS対策
                $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
                $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');

                if(trim(str_replace('　','',$content)) === ''){
                echo "スペースまたは空欄での投稿はできません";
                echo "<p><a href='insert.php'>投稿画面に戻る</a></p>";
                }elseif(mb_strlen( $title, "UTF-8") > 30){
                    echo "<p>タイトルは30文字以内で入力してください。<p>";
                    echo "<p><a href='insert.php'>投稿画面に戻る</a></p>";
                }elseif(mb_strlen( $content, "UTF-8") > 200){
                    echo "<p>投稿内容は200文字以内で入力してください。<p>";
                    echo "<p><a href='insert.php'>投稿画面に戻る</a></p>";
                } else {
                    $image = uniqid(mt_rand(), true);
                    $image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);
                    $file = "images/$image";
                    $fileExt = $_FILES['image']['name'];     // ファイル名を取得
                    $tmpfile = $_FILES['image']['tmp_name'];
                    $Ext = pathinfo($fileExt, PATHINFO_EXTENSION);
                    $array = array("jpg", "jpeg" , "png", "gif");
                    $size = $_FILES["image"]["size"];
                    if(is_uploaded_file($tmpfile)) {
                        if(in_array($Ext, $array)) {
                            if($size < 2097152) {
                                if( !empty($_FILES['image']['name'])){
                                    move_uploaded_file($_FILES['image']['tmp_name'], './images/' . $image);
                                    if(exif_imagetype($file)) {
                                        // SQL
                                        $sql = "INSERT INTO toukou VALUES (null, '{$date}', '{$title}', '{$content}', '{$login_id}', '{$image}')";
                                        $sql_res = $dbh->query( $sql );
                                        echo "<h2>記事を編集しました。</h2>";
                                        echo "<p><a href='keijiban2.php'>投稿一覧に戻る</a></p>";
                                    } else {
                                        $message = '画像ファイルではありません。';
                                    }
                                }
                            } else {
                                echo "<h2>ファイルサイズが大きすぎます。</h2>";
                                echo "<p><a href='insert.php'>投稿画面に戻る</a></p>";
                            }
                        } else {
                            echo "<h2>許可されている拡張子ではありません。</h2>";
                            echo "<p><a href='insert.php'>投稿画面に戻る</a></p>";
                        }
                    } else {
                        echo "<h2>ファイルが選択されていません。</h2>";
                        echo "<p><a href='insert.php'>投稿画面に戻る</a></p>";
                    }
                }
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