<?php
include "../db_open.php";
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
if( $_SERVER["REQUEST_METHOD"] != "POST" ) {
    $FORM_BODY =<<<___EOF___
    <form method="POST">
    <ul style="list-style:none;">
        <!--RECORD_LIST-->
    </ul>
        <input type="hidden" name="mode" value="select">
        <div><input type="submit" value="変更"></div>
    </form>
___EOF___;
$sql = 'SELECT * FROM toukou';       // テーブルの読み出し(表示)
$sql_res = $dbh->query( $sql );     // SQL実行文
$rlist = "";
while( $record = $sql_res->fetch() ){
    $tid = $record['ID'];
    $tname = $record['name'];
    $rlist .= "<li><input type='radio' name='target' value='{$tid}'>
    {$tid}. {$tname}</li>";     // レコードごとのフォームを作成
}
$body = str_replace('<!--RECORD_LIST-->', $rlist, $FORM_BODY ); // 作成したフォームを差し込む
} else {
    if( $_POST["mode"] == "select" ) {
        $target = $_POST['target'];     // レコードのIDを取得
        $sql = "SELECT * FROM toukou WHERE ID={$target}";    // 対象のレコードを取り出す
        $sql_res = $dbh->query( $sql );     // SQLを実行
        $record = $sql_res->fetch();        // レコードの内容を取得
        $body =<<<___EOF___
        <form method="POST">
            <input type="hidden" name="id" value="{$target}">
            <input type="hidden" name="mode" value="update">
            <p>作品名：<input type="text" name="name" value="{$record['name']}"></p>
            <p>メディア：<input type="radio" name="media" value="DVD" <!--DVD-->>DVD
                        <input type="radio" name="media" value="Blue-ray"
                        <!--BR-->>Blue-ray</p>
            <p>価格：<input type="text" name="price" value="{$record['price']}">円</p>
            <p><input type="submit" name="登録"></p>
        </form>
___EOF___;
// {$record['name']}は名前を入れる所
// <!--DVD-->はcheckedを入れる所
// {$record['price']}は価格を入れる所
if ( $record['media'] == "DVD" ){
    $body = str_replace('<!--DVD-->', "checked", $body );
    $body = str_replace('<!--BR-->', "", $body );
} else {
    $body = str_replace('<!--DVD-->', "", $body );
    $body = str_replace('<!--BR-->', "checked", $body );
}
    } else {
        // 変数宣言
        $fid = $_POST['id'];
        $fdate = $_POST['date'];
        $title = $_POST['title'];
        $fcontent = $_POST['content'];
        $flogin_id = $_POST['login_id'];
        $fpicture = $_POST['picture'];

        // SQLの実行1
        $sql ="UPDATE toukou SET name='{$fname}', media='{$fmedia}',price={$fprice} WHERE ID={$fid}";
        $sql_res = $dbh->query( $sql );
        // SQLの実行2
        $sql = 'SELECT * FROM toukou';
        $sql_res = $dbh->query( $sql );
        // whileとfetchでレコードの数分表示
        $body = "";
        while( $record = $sql_res->fetch() ){
            $body .= "<p>{$record['ID']}, {$record['name']},
                         {$record['media']}, {$record['price']}</p>";
        }
    }
}
echo $HTML_HEADER;
echo $body;
echo $HTML_FOOTER;