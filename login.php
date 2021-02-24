<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>login.php</title>
    
  </head>
  <body>
<?php
session_start();
//接続
require 'connect.php';

    $tablename = "member2";

//フォームが空でなかったら
  if(!empty($_POST['mail']) && !empty($_POST['password'])) {

   $mail = $_POST['mail'];
   $password = $_POST['password'];

    $sql = "SELECT * FROM $tablename WHERE mail = :mail";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':mail', $mail);
    $stmt->execute();
    $member = $stmt->fetch();

      //メアドがあり、パスワードがあっていたら
      if ($mail == $member['mail'] && $password == $member['password']) {
        $_SESSION['id'] = $member['id'];
        $_SESSION['name'] = $member['name'];
        $_SESSION['profile'] = $member['filepath'];
        $_SESSION['password'] = $member['password'];

        $test_alert = "<script type='text/javascript'>alert('ログインしました。');</script>";
          echo $test_alert;
          session_write_close();
          //header('Location: home.php');
         require 'home.php';
      }else{
  
        $test_alert = "<script type='text/javascript'>alert('メールアドレスもしくはパスワードが間違っています。');</script>";
          echo $test_alert;
        require 'login_form.php';
      }

  }else{
    
    $test_alert = "<script type='text/javascript'>alert('未入力の箇所があります。');</script>";
          echo $test_alert;
        require 'login_form.php';
  }  


?>  
  </body>
</html>