<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>editselect</title>
    <link rel='stylesheet' href='stylepost.css'  type='text/css' media='all' />
  </head>
  <body>
<?php
//接続
require "connect.php";
session_start();
  
//ログインしているか
if(isset($_SESSION['id']) || (isset($_POST['btn']) && isset($_SESSION['id']))){

     //編集フォームの送信の有無で処理を分岐
  if (!empty($_POST['editnum']) && !empty($_POST['editpass']) && isset($_POST['btn'])) {
      
    $id = $_POST['editnum'];
    $edipass = $_POST['editpass'];

    $sql = 'SELECT * FROM toukou2 WHERE id=:id ';
    $stmt = $pdo->prepare($sql);                  
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute();                             
    $result = $stmt->fetchAll(); 
	    foreach ($result as $rows){
        //パスワードがあっていたら
        if ($id == $rows['id'] && $edipass == $rows['passwd']) {
          $_SESSION['editnumber'] = $rows['id'];
          $_SESSION['editdishname'] = $rows['dishname'];
          $_SESSION['editcomment'] = $rows['comment'];
          $_SESSION['editpass'] = $rows['passwd'];
          $_SESSION['editday'] = $rows['day'];
          $_SESSION['edittime'] = $rows['time'];

          //echo $rows['id']. "を編集中です。<br>";
          $msg = $rows['id']. "を編集します。";
            $alert = "<script type='text/javascript'>alert('". $msg. "');</script>";
            echo $alert;
            header('Location: edit2.php');


        }elseif($id == $rows['id'] || $edipass !== $rows['passwd']){
          //echo "パスワードが違います。<br>";
          $msg = "パスワードが違います。";
            $alert = "<script type='text/javascript'>alert('". $msg. "');</script>";
            echo $alert;
        }
      }
  }elseif(empty($_POST['edit']) && isset($_POST['btn']) || empty($_POST['edipass']) && isset($_POST['btn'])){
    //echo "編集対象番号、パスワードを入力してください。<br>";
    $msg = "編集対象番号、パスワードを入力してください。";
            $alert = "<script type='text/javascript'>alert('". $msg. "');</script>";
            echo $alert;
  }

}else{
  $alert = "<script type='text/javascript'>alert('ログインしてください。');</script>";
  echo $alert;
  }




?>     


      <!-- ▼上の部分ここから -->
  <div class="cook__container">
    <!-- タイトル -->
    <div class="cook__title">
      <span class="cook-logo"></span>
      <?PHP
      if(!isset($_SESSION)){
        session_start();
      }
      if (isset($_SESSION['id'])) {//ログインしているとき
        echo '<a href="logout.php" class="btn-square-shadow">ログアウト</a>';

    } else {//ログインしていない時
      echo '<a href="register_form.php" class="btn-square-shadow">新規登録</a>
      <a href="login_form.php" class="btn-square-shadow">ログイン</a>';
    }
      
      ?>
    </div>
  </div>

    <!-- フォームここから -->
    <form enctype="multipart/form-data" action="edit1.php" method="POST">
        <div class="Form">
            <div class="Form-Item">
                <p class="Form-Item-Label"><span class="Form-Item-Label-Required"></span>No.</p>
                <input type="text" name="editnum" class="Form-Item-Input" placeholder="例）1">
                
            </div>
            
            <div class="Form-Item">
                <p class="Form-Item-Label"><span class="Form-Item-Label-Required"></span>パスワード</p>
                <input type="text" name="editpass" class="Form-Item-Input" placeholder="例）abcd　　※10字以内">
            </div>
            
                <input type="submit" name = "btn" class="Form-Btn" value="編集する">
        </div>
    </form>

    <p style="text-align:right">
    <a href="home.php" class="btn-circle-3d">戻る</a>
  　</p>

  </body>
</html>