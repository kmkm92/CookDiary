<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>kakunin.php</title>
    
  </head>
  <body>
<?php
 //接続
require 'connect.php';
session_start();

    $tablename = "member2";
   
//フォームが空でなかったら
  if(!empty($_POST['ninnsyou'])) {

    //変数を定義
   $password = $_POST['ninnsyou'];

    //同じものがあったら
      if ($password == $_SESSION['code']) {
     
        require 'passset_form.php';
        $test_alert = "<script type='text/javascript'>alert('メール認証が完了しました');</script>";
        echo $test_alert;

      }else{
       
        $test_alert = "<script type='text/javascript'>alert('コードが違います');</script>";
          echo $test_alert;
        require 'kakunin_form.php';
        
      }
  }else{

    $test_alert = "<script type='text/javascript'>alert('フォームが空です。');</script>";
          echo $test_alert;
        require 'kakunin_form.php';
  }    
  

?>  

  </body>
</html>