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
    <title>ログアウト</title>
    <link rel="stylesheet" href="logout.css">

</head>
<body>
    <?php
        if (isset($_POST['id'])) {
            // SQL
            $sql = "select * from toukou left outer join user on toukou.login_id = user.login_id order by date desc";
            $sql_res = $dbh->query($sql);
            $rec = $sql_res->fetch();
            
            echo <<<___EOF___
            <div class="center">
            <div class="border">
            <h2>ログアウトしますか？</h2>
            <div class="flex">
            <div class="container">
            <a href="keijiban2.php" class="btn-border">戻る</a>
            </div>
            <form action="logout_check.php" method="POST">
            <input type="hidden" name="logout" value="{$rec['login_id']}">
            <input type="submit" value="ログアウト" class="logout_button">
            </form>
            </div>
            </div>
            </div>
            ___EOF___;
        } else {
            echo "<p>不正なアクセスです。</p>";
        }
        ?>
<div class=footer_wave>
  <svg class="editorial"
     xmlns="http://www.w3.org/2000/svg"
   xmlns:xlink="http://www.w3.org/1999/xlink"
     viewBox="0 24 150 28"
     preserveAspectRatio="none">
 <defs>
 <path id="gentle-wave"
 d="M-160 44c30 0 
    58-18 88-18s
    58 18 88 18 
    58-18 88-18 
    58 18 88 18
    v44h-352z" />
  </defs>
  <g class="parallax">
   <use xlink:href="#gentle-wave" x="50" y="0" fill="#4579e2"/>
   <use xlink:href="#gentle-wave" x="50" y="3" fill="#3461c1"/>
   <use xlink:href="#gentle-wave" x="50" y="6" fill="#2d55aa"/>  
  </g>
</svg><div>
</body>
</html>