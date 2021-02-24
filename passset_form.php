<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>パスワード設定</title>
    <link rel="stylesheet" type="text/css" href="registerstyle.css" media="all" />
    
  </head>
  <body>

      <!-- ▼上の部分ここから -->
      <div class="cook__container">
    <!-- タイトル -->
    <div class="cook__title">
      <span class="cook-logo"></span>

        <a href="home.php" class="btn-square-shadow">ホームへ</a>
        <a href="login_form.php" class="btn-square-shadow">ログイン</a>
    </div>

<?php
 if(!isset($_SESSION)){
  session_start();
}

//接続
require 'connect.php';

$namae = $_SESSION['name'];
$mailad = $_SESSION['mail'];

?>

    <div id="form">
    <p class="form-title">パスワード設定</p>
    <form enctype="multipart/form-data" action="passset.php" method="POST">
        <p><?PHP echo "名前：".$namae;?></p>
        <p><?PHP echo "メールアドレス：".$mailad;?></p>
        <br>
        <p>パスワードを6文字以上10文字以下で設定してください</p>
        <p class="pass"><input type="password" name="password" placeholder="パスワード設定" /></p>
        <p>プロフィール画像を入れて下さい<font color="red">(2MB以内)</font></p>
        <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
        <input name="img" type="file" id="example" accept="image/*" /><br>
        
        <p class="submit"><input type="submit" value="OK" /></p>
    </form>
</div>

<p style="text-align:right">
    <a href="kakunin_form.php" class="btn-circle-3d">戻る</a>
  　</p>

  </body>
</html>