<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>register.php</title>
    
  </head>
  <body>
<?php
session_start();
//接続
require 'connect.php';

    $tablename = "member2";
    
    //テーブルを作成
    $sql = "CREATE TABLE IF NOT EXISTS $tablename"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(128),"
  . "mail char(128),"
  . "password char(128),"
  . "filename char(128),"
  . "filepath char(128),"
  . "date TIMESTAMP"
	.");";
  $stmt = $pdo->query($sql);


//フォームが空でなかったら
  if(!empty($_POST['name']) && !empty($_POST['mail'])) {

    //変数を定義
      $name = $_POST['name'];
      $mail = $_POST['mail'];
      //認証コード作り
      $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLKMNOPQRSTUVWXYZ0123456789';
      $password = '';
        for ($i = 0; $i < 5; $i++) {
          $password .= $chars[mt_rand(0, 61)];
        }
      //正しいメールアドレスか調べる
    if(preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD', $mail)){
             
      $_SESSION['name'] = $name;
      $_SESSION['mail'] = $mail;
      $_SESSION['code'] = $password;


    //同じメールアドレスがないか調べる
      $sql = "SELECT * FROM $tablename WHERE mail = :mail";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':mail', $mail);
      $stmt->execute();
      $member = $stmt->fetch();

      $_SESSION['id'] = $member['id'];

    //同じものがあったら
      if ($member['mail'] === $mail) {

        $test_alert = "<script type='text/javascript'>alert('同じメールアドレスが存在します。');</script>";
          echo $test_alert;
        require 'register_form.php';

      }else{

        require 'send_test.php';
        $test_alert = "<script type='text/javascript'>alert('メールが送信されました！');</script>";
          echo $test_alert;
        require 'kakunin_form.php';
      }

    }else{

      $test_alert = "<script type='text/javascript'>alert('正しくないメールアドレスです。');</script>";
          echo $test_alert;
        require 'register_form.php';

    }

  }else{

    $test_alert = "<script type='text/javascript'>alert('未入力の箇所があります。');</script>";
          echo $test_alert;
    
    require 'register_form.php';
  }    
  

?>  
  </body>
</html>