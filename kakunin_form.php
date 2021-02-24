<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>メール認証</title>
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

    <div id="form">
        <p class="form-title">メール認証</p>
        <form action="kakunin.php" method="post">
          <p>メールに記載されている五文字の英数字列を入力してください。</p>
          <p class="pass"><input type="text" name="ninnsyou" placeholder="XXXXX" /></p>
          
          <p class="submit"><input type="submit"  value="認証" /></p>
        </form>
        
        <form action="kakunin_form.php" method="post">
              <p class="resubmit"><input type="submit" name="resubmit" value="メールを再送信" /></p>
        </form>
    </div>

    <?php
     if(!isset($_SESSION)){
      session_start();
    }

    //サーバーに接続
    require 'connect.php';

   $tablename = "member";

   if(isset($_POST['resubmit'])){

    require 'send_test.php';
    $test_alert = "<script type='text/javascript'>alert('メールが送信されました！');</script>";
      echo $test_alert;
    }

     //echo $_SESSION['code'];
    ?>

    <p style="text-align:right">
    <a href="register_form.php" class="btn-circle-3d">戻る</a>
  　</p>

  </body>
</html>