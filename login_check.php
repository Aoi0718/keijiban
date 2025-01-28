<?PHP
include "../db_open.php";
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='login_check.css'>
    <title>ログインチェック</title>
</head>
<body>
<?php
    include "../db_open.php";
    session_start();

 if(mb_strlen($id) > 30) {    
    echo "<p>IDが長すぎます。</p>";
}elseif(mb_strlen($passwd) > 30) {   
    echo "<p>パスワードが長すぎます。</p>";
}else{ while($rec = $sql_res->fetch()){
    if($rec['login_id'] == $id && $rec['passwd'] == $passwd){
        // セッション
        $_SESSION['id'] = $id;
        $_SESSION['login_id'] = $rec['login_id'];

        echo "<p>ログインが完了しました。</p>";
        echo "<a href='keijiban2.php'>掲示板へ</a>";
        exit;
    }
    }}
    echo "<p>IDまたはパスワードに誤りがあります。</p>";
    echo "<div>";
    echo "<a href='login.php' class='login'>ログイン画面に戻る</a>";
    echo "</div>";
?>
</body>
</html>