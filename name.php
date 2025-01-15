<?php
include "../db_open.php";
$login_id = 1;
$sql="SELECT * FROM user";
$stmt=$dbh->prepare($sql);
//$sql_res = $dbh->query( $sql );
$stmt->execute();
// $record=$stmt->fetch();
?>
<form method="POST">
<h1>投稿者一覧</h1>
<?PHP
 while(  $record=$stmt->fetch() ){
            echo "<li><a href='ichiran.php'>{$record['user_name']}</a></li>";
        }
      // if( isset( $_GET['mode']) ){
        //     if ( $_GET['mode'] == 'select' ){
        //     echo "<p>リンクをクリックしました。</p>";
        //     }else{
        //     echo "<p>不正なリクエストです。</p>";
        //     }
        //     }else{
        //     echo "<p><a href='?mode=select'>リンク</a></p>";
        //     }
?>
</form>
<?PHP
$val1 = $_GET['val1'];
$val2 = $_GET['val2'];
echo $val1 . ":" . $val2;
?>

<!-- //include("./db_open_php.php");
//$id = 1; #例で$idに1を入れてるよ
//$sql = "SELECT * FROM user WHERE login_id = :login_id"; #どんなSQL文にするかを書くよ,変数を入れる部分は、:idのように :~ の形で配置してね
//$stmt = $dbh->prepare($sql); #$dbh->prepare($sql)で変数を当てはめる前のsqlを変数化するよ、今回は$stmtに入れてる
// $stmt-> bindParam(':id',$id,PDO::PARAM_STR); # $stmt->bindParam()で当てはめる部分に当てはめたい値を入れるよ bindParam(当てはめる場所,当てはめる値,型),例(:id,$id,:PDO::PARAM_STR)
// $stmt -> execute(); #当てはめたらexcuteでsqlを呼び出し
// $posts = $stmt->fetchAll();#結果をfetch()、またはfetchAll()で取り出して格納してる -->
