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
        <link rel="stylesheet" href="exec_insert.css">
    </head>
    <body>
        <?php
            
            if( $_SERVER["REQUEST_METHOD"] != "POST" ) {
                echo <<<___EOF___
                <div class="contents">
                    <div class="border">
                        <h2>不正なアクセスです。</h2>
                    </div>
                </div>
                ___EOF___;
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
                echo <<< ___EOF___
                <div class="contents">
                    <div class="border">
                        <h2>スペースまたは空欄での投稿はできません</h2>
                        <div class='container'><a href='insert.php' class='btn-border'>投稿画面に戻る</a></div>
                    </div>
                </div>
                ___EOF___;
                }elseif(mb_strlen( $title, "UTF-8") > 30){
                    echo <<< ___EOF___
                    <div class="contents">
                        <div class="border">
                            <h2>タイトルは30文字以内で入力してください。</h2>
                            <div class='container'><a href='insert.php' class='btn-border'>投稿画面に戻る</a></div>
                        </div>
                    </div>
                    ___EOF___;
                }elseif(mb_strlen( $content, "UTF-8") > 8192){
                    echo <<< ___EOF___
                    <div class="contents">
                        <div class="border">
                            <h2>投稿内容は8192文字以内で入力してください。</h2>
                            <div class='container'><a href='insert.php' class='btn-border'>投稿画面に戻る</a></div>
                        </div>
                    </div>
                    ___EOF___;
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
                                        echo <<< ___EOF___
                                        <div class="contents">
                                            <div class="border">
                                                <h2>記事を追加しました。</h2>
                                                <p><a href='keijiban2.php' class='btn-border'>掲示板に戻る</a></p>
                                            </div>
                                        </div>
                                        ___EOF___;
                                    } else {
                                        echo <<<___EOF___
                                        <div class="contents">
                                            <div class="border">
                                                <h2>画像ファイルではありません。</h2>
                                                <div class='container'><a href='insert.php' class='btn-border'>投稿画面に戻る</a></div>
                                            </div>
                                        </div>
                                        ___EOF___;
                                    }
                                }
                            } else {
                                echo <<<___EOF___
                                <div class="contents">
                                    <div class="border">
                                        <h2>ファイルサイズが大きすぎます。</h2>
                                        <div class='container'><a href='insert.php' class='btn-border'>投稿画面に戻る</a></div>
                                    </div>
                                </div>
                                ___EOF___;
                            }
                        } else {
                            echo <<<___EOF___
                            <div class="contents">
                                <div class="border">
                                    <h2>許可されている拡張子ではありません。</h2>
                                    <div class='container'><a href='insert.php' class='btn-border'>投稿画面に戻る</a></div>
                                </div>
                            </div>
                            ___EOF___;
                        }
                    } else {
                        echo <<<___EOF___
                        <div class="contents">
                            <div class="border">
                                <h2>ファイルが選択されていません。</h2>
                                <div class='container'><a href='insert.php' class='btn-border'>投稿画面に戻る</a></div>
                            </div>
                        </div>
                        ___EOF___;
                    }
                }
            }
        ?>
    </body>
</html>