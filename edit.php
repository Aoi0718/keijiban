<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>簡易掲示板</title>
</head>
<body>
    <?php
          include "../db_open.php";
          /*ファイルの指定*/
          $filename = "exec_insert.php";
          
            /*POST送信があった時*/
            if (isset($_POST['name'])&&($_POST['comment'])&&!($_POST['edit'])){
            /*変数に代入*/
            $name = $_POST["name"];
            $comment = $_POST["comment"];
            /*日付データ取得*/
            $date = date("Y/m/d H:i:s");
            /*ファイルの存在がある場合は投稿番号+1、なかったら１を指定*/
            $lines=file($filename);
            foreach($lines as $line){
            $data=explode("<>",$line);
            $num = 0;
            if($num<$data[0]){
            $num=$data[0];
            }
            }
            $num++;
            $fp2=fopen($filename,'a');
            fwrite( $fp2 ,"$num<>$name<>$comment<>$date"."\n");
            fclose($fp2);
            }
            
            /*POST送信があったとき*/
          if(isset($_POST["delete"])){
          /*変数に代入*/
          $delete = $_POST["deleteno"];
          /*ファイル全体を読み込んで配列に格納する*/
          $delCon = file("mission_3-1.txt");
          for ($j = 0; $j < count($delCon) ; $j++){ 
          $delData = explode("<>", $delCon[$j]);

          if ($delData[0] == $delete) { 
          array_splice($delCon, $j, 1);
          file_put_contents($filename , $delCon);
          }}
          }
            
            /*フォームに元の内容を表示させる処理*/
          if(isset($_POST["edit"])){
          $number = $_POST["number"];
          $ediCon = file("mission_3-1.txt");
          for($i = 0; $i < count($ediCon); $i++){
          $ediData = explode("<>" , $ediCon[$i]);
          if ($ediData[0] == $number ){//投稿番号が編集対象番号の時、名前とコメントを定義
          $newname = $ediData[1];//編集用フォームに元の内容を表示
          $newcoment = $ediData[2];//編集用フォームに元の内容を表示
          var_dump($ediData);
          }
          }
          }//if終わり
         
          
          if(isset($_POST['name'])&&($_POST['comment'])&&($_POST['edit_n'])){
          $lines=file("mission_3-1.txt");
          $fp=fopen($filename,'w');
          $edit=$_POST['edit_n'];
          foreach($lines as $line){
          $ediData=explode("<>",$line);
          if($ediData[0]==$edit){//投稿番号と編集番号が一致したとき上書き
          fwrite($fp,"$edit<>$name<>$comment<>$date"."\n");
          }else{
            fwrite($fp,$line);
            }
            fclose($fp); 
            }
            }
          
    ?>
    
    <form action="m3-1.php" method="post">
        <!--名前の入力フォーム-->
        <input type="text" name="name" placeholder="名前" value="<?php echo $newname ; ?>">
        <!--コメントの入力フォーム-->
        <input type="text" name="comment" placeholder="コメント" value="<?php echo $newcoment; ?>">
        <input type="submit" name="submit">
        <!--消去の入力フォーム-->
        <input type="text" name="deleteno" value="">
        <input type="submit" name="delete" value="削除">
        </form>
        <form method="POST" action="m3-1.php">
        <!--編集番号指定用フォーム-->
        <input type="text" name="number" placeholder="編集対象番号">
        <input type="submit" name="edit" value="編集">
        <input type="hidden" name="edit_n" value="<?php echo $number;?>">
    </form>
    
    【 投稿一覧 】<br>
    <?php
            /*ファイル全体を読み込んで配列に格納する*/
            $ret_array = file( $filename);
            if(file_exists($filename)){
            foreach( $ret_array as $value ) {
            $result = explode("<>", $value);
            echo "$result[0] $result[1] $result[2] $result[3] ". "<br> \n" ;
            }
            }
            
    ?>
</body>
</html>