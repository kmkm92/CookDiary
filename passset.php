<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>passset.php</title>
    
  </head>
  <body>

<?php
session_start();
//接続
require 'connect.php';

    $tablename = "member2";

    //ファイル系以外の変数を定義
    $password = $_POST['password'];
    $mail = $_SESSION['mail'];
    $name = $_SESSION['name'];

    //ファイル系の変数を定義
    $file = $_FILES['img'];
    $filename = basename($file['name']);
    $tmp_path = $file['tmp_name'];
    $file_err = $file['error'];
    $filesize = $file['size'];
    $upload_dir = 'profileimages/';
    $save_filename = date('YmdHis') . $filename;
    $err_msgs = array();
    $save_path = $upload_dir.$save_filename;
  
    $Max = 10;
    $Min = 6;
    $passLength = strlen($password);
    //フォームが空か
    if(empty($_POST['password'])) {
      array_push($err_msgs, 'パスワードを設定してください');

      //パスワードの長さ
    }elseif ($passLength > $Max ||  $Min > $passLength) {
      array_push($err_msgs, 'パスワードが6文字以上10文字以下ではありません。');

    }

    

    
    //ファイルサイズ確認
    if($filesize > 2097152 || $file_err==2){
      array_push($err_msgs, 'ファイルサイズは2MB未満にしてください。');
    }
    
    //拡張子は？
    $allow_ext = array('jpg','jpeg','png');
    $file_ext = pathinfo($filename,PATHINFO_EXTENSION);
    if(!in_array(strtolower($file_ext),$allow_ext)){
      array_push($err_msgs, '画像ファイルを添付してください。');
    }

  

    //問題なかったらDBに入れる
    if(count($err_msgs) === 0){
      if(move_uploaded_file($tmp_path, $save_path)){

      $password = $_POST['password'];
      $mail = $_SESSION['mail'];
      $name = $_SESSION['name'];

        $sql = $pdo -> prepare("INSERT INTO $tablename (name, mail, password, filename, filepath, date) VALUES (:name, :mail, :password, :filename, :filepath, :date)");
	      $sql -> bindValue(':name', $name, PDO::PARAM_STR);
        $sql -> bindValue(':mail', $mail, PDO::PARAM_STR);
        $sql -> bindValue(':password', $password, PDO::PARAM_STR);
        $sql -> bindValue(':filename', $filename, PDO::PARAM_STR);
        $sql -> bindValue(':filepath', $save_path, PDO::PARAM_STR);
        $sql -> bindValue(':date', date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $sql -> execute();

      $test_alert = "<script type='text/javascript'>alert(' 新規登録が完了しました');</script>";
          echo $test_alert;
        require 'login_form.php';
      
      }else{
        echo '画像を2MB以内にしてください。';
        echo '<a href="passset_form.php">戻る</a>';
      }

       
    }else{
      foreach($err_msgs as $msg){
         //echo $msg."<br>";
         $test_alert = "<script type='text/javascript'>alert('".$msg."');</script>";
          echo $test_alert;
    }
      require 'passset_form.php';
    }
    
      
      
     
  

?>  

  </body>
</html>