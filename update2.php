<?PHP
include "../db_open.php";
session_start();
if(empty($_SESSION['login_id'])){
    header('Location: login.php');
    exit();
}
?>
<?php
$HTML_HEADER =<<<___EOF___
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>データの変更</title>
</head>
<body>
___EOF___;
$HTML_FOOTER =<<<___EOF___
</body>
</html>
___EOF___;
if( $_SERVER["REQUEST_METHOD"] != "POST" ){
    $body =<<<___EOF___
<form method="POST">
<p>対象のID：<input type="text" name="id"></p>
<p>作品名：<input type="text" name="name"></p>
<p>メディア：<input type="radio" name="media" value="DVD">DVD
 <input type="radio" name="media" value="Blue-ray">Blue-ray</p>
<p>価格：<input type="text" name="price">円</p>
<p><input type="submit" name="登録"></p>
</form>
___EOF___;


}else{
$fid = $_POST['id'];
$fdate = $_POST['date'];
$ftitle = $_POST['title'];
$fcontent = $_POST['content'];
$flogin_id = $_POST['login_id'];
$fpicture = $_POST['picture'];
$sql ="UPDATE toukou SET date='{$fdate}', title='{$ftitle}',
content='{$fcontent}', login_id={'$flogin_id'}, picture='{$fpicture}' WHERE ID={$fid}";
$sql_res = $dbh->query( $sql );
$sql = 'SELECT * FROM toukou';
$sql_res = $dbh->query( $sql );
$body = "";
while( $record = $sql_res->fetch() ){
$body .= "<p>{$record['ID']}, {$record['name']},
{$record['media']}, {$record['price']}</p>";
}

}
echo $HTML_HEADER;
echo $body;
echo $HTML_FOOTER;