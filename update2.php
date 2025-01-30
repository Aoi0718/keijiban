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
        <link rel="stylesheet" href="edit.css">
    </head>
    <body>
        <h2>記事の削除</h2>
        
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
                            if ($id) {
                                // **更新処理 (UPDATE)**
                                if ($image) {
                                    // 画像を新しくした場合、更新
                                    $sql = "UPDATE toukou SET date = ?, title = ?, content = ?, login_id = ?, image = ? WHERE id = ?";
                                    $stmt = $dbh->prepare($sql);
                                    $stmt->execute([$date, $title, $content, $login_id, $image, $id]);
                                }if (!empty($_POST["editnum"]) && !empty($_POST["editpass"]) && !empty($_POST["edit"])) {
                                    $editpass=$_POST["editpass"];
                                    $editnum=$_POST["editnum"];
                                    
                                    $sql="SELECT * FROM tb WHERE id=:id";
                                    $edit=$pdo->prepare($sql);
                                    $edit->bindParam(":id", $editnum, PDO::PARAM_INT);
                                    $edit->execute();
                                    
                                    $lines=$edit->fetchAll();
                                    foreach($lines as $line){
                                        if($line["pass"]==$_POST["editpass"]){//パスワード一致なら表示
                                            $newname=$line["name"];
                                            $newcomment=$line["comment"];
                                            $newnum=$line["id"];
                                        }
                                    }
                                
                                }
                            } else {
                                // 画像を変更しない場合
                                $sql = "UPDATE toukou SET date = ?, title = ?, content = ?, login_id = ? WHERE id = ?";
                                $stmt = $dbh->prepare($sql);
                                $stmt->execute([$date, $title, $content, $login_id, $id]);
                                echo "<h2>記事を編集しました。</h2>";
                            } 
                                echo "<h2>記事を投稿しました。</h2>";
                            }
                        }
                    }
                }
            }
        }
    

    
?>
<form action="" method="post">
<!-- 編集用 -->
<h3>【編集フォーム】</h3>
    <br>
    <label>投稿番号:</label>
    <input type="number" name="editnum" value="" placeholder="編集したい投稿番号">
    <br>
    <label>パスワード:</label>
    <input type="password" name="editpass" placeholder="パスワードを入力してください">
    <br>
    <input type="submit" name="edit" value="編集">
    <br>
    <input type="hidden" name="hiddenNum" value="<?php echo $selectEdit; ?>" >
</form>
    <div class="container">
        <a href="keijiban2.php" class="btn-border">戻る</a>
    </div>
    </body>
</html>